<?php
$servername = "mysql.omega"; // Az adatbázis szerver neve vagy IP címe
$username = "mindentudas"; // Adatbázis felhasználóneve
$password = "Brutal.shred01"; // Adatbázis felhasználó jelszava
$database = "mindentudas"; // Adatbázis neve

// Adatbázis kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $database);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

// Karakterkészlet beállítása (UTF-8)
$conn->set_charset("utf8");

?>
