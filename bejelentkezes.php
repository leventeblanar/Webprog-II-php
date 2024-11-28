<?php
session_start();
include_once 'db.php'; // Adatbázis kapcsolat
include_once 'bejelentkezes.php';

$welcome_message = "";

// Ha be van jelentkezve, írjunk üzenetet a `bejelentkezes.php` oldalon, és ne irányítsuk át automatikusan
if (isset($_SESSION['user_id'])) {
    $welcome_message = "Már be vagy jelentkezve, " . htmlspecialchars($_SESSION['username']) . "!";
}

// Bejelentkezési folyamat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Sikeres bejelentkezés után irányítás a főoldalra
            header("Location: index.php");
            exit();
        } else {
            $error = "Hibás jelszó!";
        }
    } else {
        $error = "Hibás felhasználónév!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Bejelentkezés</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="starter-page-page">


<?php include 'header.php'; ?> <!-- Fejléc beillesztése -->

<main class="main">
  <!-- Üzenetek megjelenítése -->
  <div class="page-title" data-aos="fade">
    <div class="container">
      <nav class="breadcrumbs">
        <ol>
          <li><a href="index.php">Főoldal</a></li>
          <li class="current">Bejelentkezés</li>
        </ol>
      </nav>
      <h1>Bejelentkezés</h1>
    </div>
  </div>

  <section id="starter-section" class="starter-section section">
    <div class="container" data-aos="fade-up">
      <?php if (!empty($welcome_message)): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $welcome_message; ?>
        </div>
      <?php elseif (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <?php if (empty($welcome_message)): ?>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="username" class="form-label">Felhasználónév</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Jelszó</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
      </form>

      <p class="mt-3">Nincs még felhasználója? <a href="regisztracio.php">Regisztráljon itt</a>.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

  
