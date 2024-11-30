<?php
$db = new mysqli("localhost", "root", "", "mindentudas", 3308);

if ($db->connect_error) {
    die("Adatbázis kapcsolat hiba: " . $db->connect_error);
} else {
    echo "Sikeres adatbázis kapcsolat!";
}
?>