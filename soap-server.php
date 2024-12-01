<?php
require_once 'vendor/autoload.php'; // TCPDF használatához (Composer-rel telepítve)

// SOAP-szerver inicializálása
class MindentudasSoapServer
{
    private $db;

    public function __construct()
    {
        
        // Adatbázis kapcsolat
        $this->db = new mysqli("mysql.omega", "mindentudas", "Brutal.shred01", "mindentudas");
        if ($this->db->connect_error) {
            throw new Exception("Adatbázis kapcsolat hiba: " . $this->db->connect_error);
        }
    }

    // Előadások listázása
    public function getEloadasok()
    {
        $query = "SELECT id, cim, ido FROM eloadas";
        $result = $this->db->query($query);

        if (!$result) {
            throw new Exception("Lekérdezési hiba: " . $this->db->error);
        }

        $eloadasok = [];
        while ($row = $result->fetch_assoc()) {
            $eloadasok[] = $row;
        }

        return $eloadasok;
    }

    // Tudósok listázása (területtel együtt)
    public function getTudosok()
    {
        $query = "SELECT id, nev, terulet FROM tudos";
        $result = $this->db->query($query);

        if (!$result) {
            throw new Exception("Lekérdezési hiba: " . $this->db->error);
        }

        $tudosok = [];
        while ($row = $result->fetch_assoc()) {
            $tudosok[] = $row;
        }

        return $tudosok;
    }

    // Egyedi tudós területek listázása
    public function getTudosTeruletek()
    {
        $query = "SELECT DISTINCT terulet FROM tudos WHERE terulet IS NOT NULL AND terulet != ''";
        $result = $this->db->query($query);

        if (!$result) {
            throw new Exception("Lekérdezési hiba: " . $this->db->error);
        }

        $teruletek = [];
        while ($row = $result->fetch_assoc()) {
            $teruletek[] = $row['terulet'];
        }

        return $teruletek;
    }

    // Tudósok előadása alapján
    public function getTudosokByEloadas($eloadas_id)
    {
        $query = "
            SELECT t.id, t.nev, t.terulet 
            FROM tudos t 
            INNER JOIN kapcsolo k ON t.id = k.tudosid 
            WHERE k.eloadasid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $eloadas_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Lekérdezési hiba: " . $this->db->error);
        }

        $tudosok = [];
        while ($row = $result->fetch_assoc()) {
            $tudosok[] = $row;
        }

        return $tudosok;
    }

    // Keresési funkció: cím, dátum, tudós vagy terület alapján
    public function searchEloadasok($searchParams)
    {
        $params = json_decode($searchParams, true);
        $query = "
            SELECT e.id, e.cim, e.ido, GROUP_CONCAT(t.nev SEPARATOR ', ') AS tudosok
            FROM eloadas e
            LEFT JOIN kapcsolo k ON e.id = k.eloadasid
            LEFT JOIN tudos t ON k.tudosid = t.id
            WHERE 1=1
        ";

        $conditions = [];
        $values = [];

        if (!empty($params['cim'])) {
            $conditions[] = "e.cim LIKE ?";
            $values[] = "%" . $params['cim'] . "%";
        }

        if (!empty($params['datum'])) {
            $conditions[] = "DATE(e.ido) = ?";
            $values[] = $params['datum'];
        }

        if (!empty($params['tudos'])) {
            $conditions[] = "t.nev LIKE ?";
            $values[] = "%" . $params['tudos'] . "%";
        }

        if (!empty($params['terulet'])) {
            $conditions[] = "t.terulet = ?";
            $values[] = $params['terulet'];
        }

        if ($conditions) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        $query .= " GROUP BY e.id";

        $stmt = $this->db->prepare($query);
        if ($values) {
            $types = str_repeat("s", count($values));
            $stmt->bind_param($types, ...$values);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            throw new Exception("Lekérdezési hiba: " . $this->db->error);
        }

        $eloadasok = [];
        while ($row = $result->fetch_assoc()) {
            $eloadasok[] = $row;
        }

        return $eloadasok;
    }

    // PDF generálása
    public function generatePdf($searchParams)
    {
        $eloadasok = $this->searchEloadasok($searchParams);

        if (empty($eloadasok)) {
            throw new Exception("Nincs találat a megadott keresésre.");
        }

        // PDF létrehozása
        $pdf = new \TCPDF();
        $pdf->SetCreator('Mindentudas Egyeteme');
        $pdf->SetTitle('Előadások listája');
        $pdf->AddPage();

        // Unicode-támogatású betűkészlet
        $pdf->SetFont('dejavusans', '', 12); 

        // PDF tartalom
        $html = "<h1>Előadások listája</h1>";
        $html .= "<table border=\"1\" cellpadding=\"5\">";
        $html .= "<thead>
                    <tr>
                        <th>Cím</th>
                        <th>Időpont</th>
                        <th>Tudós(ok)</th>
                    </tr>
                  </thead><tbody>";

        foreach ($eloadasok as $eloadas) {
            $html .= "<tr>
                        <td>{$eloadas['cim']}</td>
                        <td>{$eloadas['ido']}</td>
                        <td>{$eloadas['tudosok']}</td>
                      </tr>";
        }

        $html .= "</tbody></table>";

        $pdf->writeHTML($html);
        $filePath = __DIR__ . "/exported/eloadasok.pdf";
        $pdf->Output($filePath, 'F'); // F: fájlba mentés

        return $filePath; // PDF fájl útvonalát adja vissza
    }
}

// SOAP szerver indítása
$options = ['uri' => 'http://www.mindentudas.nhely.hu/'];
$server = new SoapServer(null, $options);
$server->setClass('MindentudasSoapServer');
$server->handle();
