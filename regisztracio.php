<?php
session_start();
include_once 'db.php'; // Adatbázis kapcsolat

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms_accepted = isset($_POST['terms']); // Ellenőrzés, hogy elfogadta-e az Adatfelhasználási tájékoztatót

    if (!$terms_accepted) {
        $error = "Az Adatfelhasználási tájékoztatót el kell fogadni!";
    } elseif ($password !== $confirm_password) {
        $error = "A jelszavak nem egyeznek!";
    } else {
        $query = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Ez a felhasználónév már foglalt!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Beszúrás, regisztrált látogató szerepkörrel
            $insert_query = "INSERT INTO users (username, password, role) VALUES (?, ?, 'regisztrált látogató')";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'regisztrált látogató';

                header("Location: index.php");
                exit();
            } else {
                $error = "Hiba történt a regisztráció során. Kérjük, próbálja újra!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Regisztráció</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
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
          <li class="current">Regisztráció</li>
        </ol>
      </nav>
      <h1>Regisztráció</h1>
    </div>
  </div>

  <section id="starter-section" class="starter-section section">
    <div class="container" data-aos="fade-up">
      <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label for="username" class="form-label">Felhasználónév</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Jelszó</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Jelszó megerősítése</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
          <label for="terms" class="form-check-label">
            Elfogadom az <a href="adatfelhasznalasi_tajekoztato.php" target="_blank">Adatfelhasználási tájékoztatót</a>
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Regisztráció</button>
      </form>

      <p class="mt-3">Már van felhasználója? <a href="bejelentkezes.php">Jelentkezzen be itt</a>.</p>
    </div>
  </section>
</main>

<footer id="footer" class="footer">
  <!-- Footer tartalom -->
</footer>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
