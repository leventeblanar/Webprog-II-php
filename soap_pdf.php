<?php
require_once 'vendor/autoload.php'; // TCPDF betöltése

header('Content-Type: application/json');

try {
    // SOAP kliens inicializálása
    $options = [
        'location' => 'http://www.mindentudas.nhely.hu/soap-server.php',
        'uri' => 'http://www.mindentudas.nhely.hu/',
        'trace' => 1,
        'connection_timeout' => 30,
        'default_socket_timeout' => 30
    ];

    $client = new SoapClient(null, $options);

    // Keresési paraméterek beolvasása
    $searchParams = file_get_contents('php://input');
    if (empty($searchParams)) {
        throw new Exception("Nem érkezett keresési paraméter.");
    }

    // PDF generálása
    $filePath = $client->generatePdf($searchParams);

    // PDF fájl letöltése
    if (file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="eloadasok.pdf"');
        readfile($filePath);
        unlink($filePath); // Törlés a szerverről a letöltés után
    } else {
        throw new Exception("A PDF fájl nem található.");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
