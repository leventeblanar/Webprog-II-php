<?php
session_start();
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Előadások</title>

  <!-- Fonts and CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
<?php include 'header.php'; ?> <!-- Fejléc -->

<main class="main">
    <div class="page-title">
        <div class="container">
            <h1>Előadások</h1>
        </div>
    </div>

    <section class="content-section">
        <div class="container">
            <?php
            $options = [
                'location' => 'http://www.mindentudas.nhely.hu/soap-server.php',
                'uri' => 'http://www.mindentudas.nhely.hu/',
                'trace' => 1,
                'connection_timeout' => 30,
            ];

             try {
                $client = new SoapClient(null, $options);

                // Előadások és tudósok adatai
                $eloadasok = $client->getEloadasok();
                $tudosok = $client->getTudosok(); // Tudósok területtel együtt
                $eloadas_tudos = [];
               
                foreach ($eloadasok as $eloadas) {
                    try {
                        if (!isset($eloadas['id'])) {
                            //throw new Exception("Előadás ID hiányzik!");
                        } else {
                            $eloadas_tudos[$eloadas['id']] = $client->getTudosokByEloadas($eloadas['id']);
                        }
                    } catch (Exception $e) {
                        //echo "<div class='alert alert-warning'>Hiba történt előadás ID: {$eloadas['id']}: " . $e->getMessage() . "</div>";
                    }
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>Hiba történt: " . $e->getMessage() . "</div>";
                exit();
            }

            

            ?>

            <div class="my-4">
                <h2 class="text-center">Előadások és Tudósok</h2>

                <!-- Keresési mezők -->
                <form id="search-form" method="GET" action="">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="search">Keresés cím alapján:</label>
                            <input type="text" id="search" name="kereses" class="form-control"
                                   placeholder="Előadás címe"
                                   value="<?php echo htmlspecialchars($_GET['kereses'] ?? ''); ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="datum">Dátum:</label>
                            <input type="date" id="datum" name="datum" class="form-control"
                                   value="<?php echo htmlspecialchars($_GET['datum'] ?? ''); ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="tudos">Tudós:</label>
                            <select id="tudos" name="tudos" class="form-control">
                                <option value="">Válassz tudóst</option>
                                <?php foreach ($tudosok as $tudos): ?>
                                    <option value="<?php echo htmlspecialchars($tudos['nev']); ?>"
                                        <?php echo ($_GET['tudos'] ?? '') === $tudos['nev'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($tudos['nev']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="terulet">Terület:</label>
                            <select id="terulet" name="terulet" class="form-control">
                                <option value="">Válassz típust</option>
                                <?php
                                $teruletek = array_unique(array_column($tudosok, 'terulet'));
                                foreach ($teruletek as $terulet): ?>
                                    <option value="<?php echo htmlspecialchars($terulet); ?>"
                                        <?php echo ($_GET['terulet'] ?? '') === $terulet ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($terulet); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Keresés</button>
                        <button type="button" class="btn btn-success" onclick="exportPdf()">PDF Export</button>
                    </div>
                </form>

                <!-- Táblázat -->
                <table class="table table-bordered mt-4" id="data-table">
                    <thead>
                    <tr>
                        <th>Előadás címe</th>
                        <th>Idő</th>
                        <th>Tudós(ok)</th>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <th>Jegyvásárlás</th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($eloadasok as $eloadas): ?>
                        <?php
                        // Keresési feltételek ellenőrzése
                        $datumFilter = empty($_GET['datum']) || $_GET['datum'] === substr($eloadas['ido'], 0, 10);
                        $tudosFilter = empty($_GET['tudos']) || in_array($_GET['tudos'], array_column($eloadas_tudos[$eloadas['id']], 'nev'));
                        $teruletFilter = empty($_GET['terulet']) || in_array($_GET['terulet'], array_column($eloadas_tudos[$eloadas['id']], 'terulet'));
                        $keresesFilter = empty($_GET['kereses']) || stripos($eloadas['cim'], $_GET['kereses']) !== false;

                        if ($datumFilter && $tudosFilter && $keresesFilter && $teruletFilter):
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($eloadas['cim']); ?></td>
                                <td><?php echo htmlspecialchars($eloadas['ido']); ?></td>
                                <td>
                                    <?php
                                    $tudos_list = [];
                                    foreach ($eloadas_tudos[$eloadas['id']] as $tudos) {
                                        $tudos_list[] = htmlspecialchars($tudos['nev']);
                                    }
                                    echo implode(", ", $tudos_list);
                                    ?>
                                </td>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <td>
                                        <a href="jegyvásárlás.php?eloadas_id=<?php echo $eloadas['id']; ?>"
                                           class="btn btn-primary btn-sm">Vásárlás</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<footer id="footer" class="footer">
    <!-- Footer tartalom -->
</footer>

<script>
    function exportPdf() {
        const params = new URLSearchParams(window.location.search);

        fetch('http://www.mindentudas.nhely.hu/soap_pdf.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(params))
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Hiba történt a PDF letöltése során.');
                }
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'eloadasok.pdf';
                document.body.appendChild(a);
                a.click();
                a.remove();
            })
            .catch(error => {
                console.error('Hiba:', error);
                alert('Hiba történt a PDF letöltése során.');
            });
    }
</script>
<?php include 'footer.php'; ?>
</body>
</html>
