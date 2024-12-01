<?php
// Adatbázis kapcsolat
$host = 'mysql.omega';
$port = '3308'; // 3308-as port megadása
$dbname = 'mindentudas';
$username = 'mindentudas';
$password = 'Brutal.shred01';


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Adatbázis kapcsolat hiba: ' . $e->getMessage()]);
    exit();
}

// HTTP-módszer és URL feldolgozása
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$resource = $request[0] ?? null; // Pl. "eloadas"
$id = $request[1] ?? null;       // Pl. "1"

header('Content-Type: application/json');

// CRUD funkciók
switch ($resource) {
    case 'eloadas':
        handleEloadas($method, $id, $conn);
        break;

    case 'tudos':
        handleTudos($method, $id, $conn);
        break;

    case 'kapcsolo':
        handleKapcsolo($method, $id, $conn);
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Resource not found']);
        break;
}

// Előadások kezelése
function handleEloadas($method, $id, $conn) {
    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $conn->prepare('
                    SELECT e.id, e.cim, e.ido, GROUP_CONCAT(t.nev SEPARATOR ", ") AS tudosok
                    FROM eloadas e
                    LEFT JOIN kapcsolo k ON e.id = k.eloadasid
                    LEFT JOIN tudos t ON k.tudosid = t.id
                    WHERE e.id = :id
                    GROUP BY e.id
                ');
                $stmt->execute(['id' => $id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = $conn->query('
                    SELECT e.id, e.cim, e.ido, GROUP_CONCAT(t.nev SEPARATOR ", ") AS tudosok
                    FROM eloadas e
                    LEFT JOIN kapcsolo k ON e.id = k.eloadasid
                    LEFT JOIN tudos t ON k.tudosid = t.id
                    GROUP BY e.id
                ');
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            echo json_encode($result);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);

            try {
                $conn->beginTransaction();

                // Előadás hozzáadása
                $stmt = $conn->prepare('INSERT INTO eloadas (cim, ido) VALUES (:cim, :ido)');
                $stmt->execute(['cim' => $data['cim'], 'ido' => $data['ido']]);
                $eloadasid = $conn->lastInsertId();

                // Kapcsolo tábla frissítése
                if (isset($data['tudosid']) && $data['tudosid'] !== "") {
                    $stmt = $conn->prepare('INSERT INTO kapcsolo (eloadasid, tudosid) VALUES (:eloadasid, :tudosid)');
                    $stmt->execute(['eloadasid' => $eloadasid, 'tudosid' => $data['tudosid']]);
                }

                $conn->commit();
                echo json_encode(['status' => 'success', 'id' => $eloadasid]);
            } catch (Exception $e) {
                $conn->rollBack();
                http_response_code(500);
                echo json_encode(['error' => 'Hiba történt: ' . $e->getMessage()]);
            }
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID required for update']);
                break;
            }
            $data = json_decode(file_get_contents('php://input'), true);

            try {
                $conn->beginTransaction();

                // Előadás frissítése
                $stmt = $conn->prepare('UPDATE eloadas SET cim = :cim, ido = :ido WHERE id = :id');
                $stmt->execute(['cim' => $data['cim'], 'ido' => $data['ido'], 'id' => $id]);

                // Kapcsolo tábla frissítése
                if (isset($data['tudosid'])) {
                    $stmt = $conn->prepare('DELETE FROM kapcsolo WHERE eloadasid = :eloadasid');
                    $stmt->execute(['eloadasid' => $id]);

                    $stmt = $conn->prepare('INSERT INTO kapcsolo (eloadasid, tudosid) VALUES (:eloadasid, :tudosid)');
                    $stmt->execute(['eloadasid' => $id, 'tudosid' => $data['tudosid']]);
                }

                $conn->commit();
                echo json_encode(['status' => 'success']);
            } catch (Exception $e) {
                $conn->rollBack();
                http_response_code(500);
                echo json_encode(['error' => 'Hiba történt: ' . $e->getMessage()]);
            }
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID required for delete']);
                break;
            }

            try {
                $conn->beginTransaction();

                $stmt = $conn->prepare('DELETE FROM kapcsolo WHERE eloadasid = :id');
                $stmt->execute(['id' => $id]);

                $stmt = $conn->prepare('DELETE FROM eloadas WHERE id = :id');
                $stmt->execute(['id' => $id]);

                $conn->commit();
                echo json_encode(['status' => 'success']);
            } catch (Exception $e) {
                $conn->rollBack();
                http_response_code(500);
                echo json_encode(['error' => 'Hiba történt a törlés során: ' . $e->getMessage()]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
}

// Tudósok kezelése
function handleTudos($method, $id, $conn) {
    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $conn->prepare('SELECT * FROM tudos WHERE id = :id');
                $stmt->execute(['id' => $id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $stmt = $conn->query('SELECT * FROM tudos');
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            echo json_encode($result);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
}

// Kapcsolo kezelése
function handleKapcsolo($method, $id, $conn) {
    switch ($method) {
        case 'GET':
            if ($id) {
                $stmt = $conn->prepare('SELECT * FROM kapcsolo WHERE eloadasid = :id');
                $stmt->execute(['id' => $id]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $stmt = $conn->query('SELECT * FROM kapcsolo');
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            echo json_encode($result);
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $conn->prepare('INSERT INTO kapcsolo (eloadasid, tudosid) VALUES (:eloadasid, :tudosid)');
            $stmt->execute(['eloadasid' => $data['eloadasid'], 'tudosid' => $data['tudosid']]);
            echo json_encode(['status' => 'success']);
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID required for delete']);
                break;
            }
            $stmt = $conn->prepare('DELETE FROM kapcsolo WHERE eloadasid = :id');
            $stmt->execute(['id' => $id]);
            echo json_encode(['status' => 'success']);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
}
