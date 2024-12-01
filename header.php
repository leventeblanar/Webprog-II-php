<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'db.php'; // Adatbázis kapcsolat

// Menüpontok definiálása
$menu_items = [
    ['name' => 'Főoldal', 'url' => 'index.php'],
    ['name' => 'Rólunk', 'url' => 'index.php#about'],
    ['name' => 'Előadások', 'url' => 'eloadasok.php'],
    ['name' => 'MNB', 'url' => '#team'],
    ['name' => 'Kapcsolat', 'url' => 'index.php#contact'],
];

// Frissítés az adatbázisban
foreach ($menu_items as $item) {
    $query = "SELECT * FROM menu WHERE name = ? AND url = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $item['name'], $item['url']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Ha nincs ilyen menüpont, hozzáadjuk az adatbázishoz
        $insert_query = "INSERT INTO menu (name, url) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ss", $item['name'], $item['url']);
        $insert_stmt->execute();
    }
}
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="index.php" class="logo d-flex align-items-center me-auto">
            <img src="assets/img/logo.jpg" alt="">
            <h1 class="sitename">Mindentudás Egyeteme</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <?php
                // Az adatbázisban tárolt menüpontok betöltése
                $query = "SELECT name, url FROM menu ORDER BY id ASC";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo '<li><a href="' . htmlspecialchars($row['url']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
                }

                // Admin menüpont dinamikus hozzáadása
                if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
                    echo '<li><a href="admin.php">Admin</a></li>';
                }
                ?>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <!-- Dinamikus bejelentkezés állapot kijelzése -->
        <div class="user-status" style="display: flex; flex-direction: column; align-items: flex-end;">
            <?php if (isset($_SESSION['user_id'])): ?>
                <p class="welcome-message" style="color: #fff; margin: 0 0 5px 0; text-align: right;">Üdv, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                <a class="btn-getstarted" href="kijelentkezes.php" style="text-align: right;">Kijelentkezés</a>
            <?php else: ?>
                <a class="btn-getstarted" href="bejelentkezes.php">Bejelentkezés</a>
            <?php endif; ?>
        </div>
    </div>
</header>

