<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Előadások</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- JS Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <style>
    #success-message {
      margin-top: 60px;
      z-index: 9999;
    }
  </style>
</head>

<body>
  <?php include 'header.php'; ?>

  <main class="main">
    <div class="container my-4">
      <h1>Előadások kezelése</h1>

      <!-- Sikerüzenet -->
      <div id="success-message" class="alert alert-success d-none" role="alert">
        Az előadás sikeresen hozzáadva/módosítva!
      </div>

      <!-- Új előadás hozzáadása gomb -->
      <button class="btn btn-success my-3" onclick="showAddModal()">Új előadás hozzáadása</button>

      <!-- Keresőmező -->
      <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="Keresés cím vagy tudós neve alapján...">
      </div>

      <!-- Táblázat -->
      <table class="table table-bordered" id="eloadasok-table">
        <thead>
          <tr>
            <th>Cím</th>
            <th>Időpont</th>
            <th>Tudós</th>
            <th>Műveletek</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>

    <!-- Új előadás hozzáadása modal -->
    <div id="add-eloadas-modal" class="modal fade" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Új előadás hozzáadása</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezár"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="add-eloadas-cim">Cím</label>
              <input type="text" class="form-control" id="add-eloadas-cim">
            </div>
            <div class="form-group mb-3">
              <label for="add-eloadas-ido">Időpont</label>
              <input type="text" class="form-control datepicker" id="add-eloadas-ido">
            </div>
            <div class="form-group">
              <label for="add-eloadas-tudos">Tudós</label>
              <select class="form-control" id="add-eloadas-tudos">
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" onclick="addNewEloadas()">Hozzáadás</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Módosítás modal -->
    <div id="edit-eloadas-modal" class="modal fade" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Előadás módosítása</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezár"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="edit-eloadas-cim">Cím</label>
              <input type="text" class="form-control" id="edit-eloadas-cim">
            </div>
            <div class="form-group mb-3">
              <label for="edit-eloadas-ido">Időpont</label>
              <input type="text" class="form-control datepicker" id="edit-eloadas-ido">
            </div>
            <div class="form-group">
              <label for="edit-eloadas-tudos">Tudós</label>
              <select class="form-control" id="edit-eloadas-tudos">
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success" onclick="saveEditedEloadas()">Mentés</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script>
    const API_URL = './restful_api.php/eloadas';
    const TUDOS_API_URL = './restful_api.php/tudos';
    let currentEloadasId = null;

    function loadEloadasok() {
      axios.get(API_URL)
        .then(response => {
          const eloadasok = response.data;
          const tableBody = document.querySelector('#eloadasok-table tbody');
          tableBody.innerHTML = '';

          eloadasok.forEach(eloadas => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${eloadas.cim}</td>
              <td>${eloadas.ido}</td>
              <td>${eloadas.tudosok || 'Nincs hozzárendelve'}</td>
              <td>
                <button class="btn btn-primary btn-sm" onclick="showEditModal(${eloadas.id}, '${eloadas.cim}', '${eloadas.ido}', '${eloadas.tudosok || ''}')">Módosítás</button>
                <button class="btn btn-danger btn-sm" onclick="deleteEloadas(${eloadas.id})">Törlés</button>
              </td>
            `;
            tableBody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Hiba az előadások betöltése során:', error);
        });
    }

    function showAddModal() {
      const modal = new bootstrap.Modal(document.getElementById('add-eloadas-modal'));
      modal.show();
      loadTudosokDropdown('add-eloadas-tudos');
    }

    function addNewEloadas() {
      const cim = document.getElementById('add-eloadas-cim').value;
      const ido = document.getElementById('add-eloadas-ido').value;
      const tudosId = document.getElementById('add-eloadas-tudos').value;

      axios.post(API_URL, { cim, ido, tudosid: tudosId })
        .then(() => {
          const modal = bootstrap.Modal.getInstance(document.getElementById('add-eloadas-modal'));
          modal.hide();
          showSuccessMessage();
          loadEloadasok();
        })
        .catch(error => {
          console.error('Hiba az új előadás hozzáadása során:', error);
        });
    }

    function showEditModal(id, cim, ido, tudos) {
      currentEloadasId = id;
      document.getElementById('edit-eloadas-cim').value = cim;
      document.getElementById('edit-eloadas-ido').value = ido;
      loadTudosokDropdown('edit-eloadas-tudos', tudos);
      const modal = new bootstrap.Modal(document.getElementById('edit-eloadas-modal'));
      modal.show();
    }

    function saveEditedEloadas() {
      const cim = document.getElementById('edit-eloadas-cim').value;
      const ido = document.getElementById('edit-eloadas-ido').value;
      const tudosId = document.getElementById('edit-eloadas-tudos').value;

      axios.put(`${API_URL}/${currentEloadasId}`, { cim, ido, tudosid: tudosId })
        .then(() => {
          const modal = bootstrap.Modal.getInstance(document.getElementById('edit-eloadas-modal'));
          modal.hide();
          showSuccessMessage();
          loadEloadasok();
        })
        .catch(error => {
          console.error('Hiba az előadás módosítása során:', error);
        });
    }

    function deleteEloadas(id) {
      if (confirm("Biztosan törli az előadást?")) {
        axios.delete(`${API_URL}/${id}`)
          .then(() => {
            loadEloadasok();
          })
          .catch(error => {
            console.error('Hiba az előadás törlése során:', error);
          });
      }
    }

    function loadTudosokDropdown(selectElementId, selectedTudos = '') {
      axios.get(TUDOS_API_URL)
        .then(response => {
          const tudosok = response.data;
          const tudosSelect = document.getElementById(selectElementId);
          tudosSelect.innerHTML = '<option value="">Válasszon egy tudóst</option>';
          tudosok.forEach(tudos => {
            const option = document.createElement('option');
            option.value = tudos.id;
            option.textContent = tudos.nev;
            if (tudos.nev === selectedTudos) option.selected = true;
            tudosSelect.appendChild(option);
          });
        })
        .catch(error => {
          console.error('Hiba a tudósok betöltése során:', error);
        });
    }

    function showSuccessMessage() {
      const successMessage = document.getElementById('success-message');
      successMessage.classList.remove('d-none');
      setTimeout(() => {
        successMessage.classList.add('d-none');
      }, 3000);
    }

    $(document).ready(function () {
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
      });

      $('#search').on('keyup', function () {
        const query = $(this).val().toLowerCase();
        $('#eloadasok-table tbody tr').filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
      });

      loadEloadasok();
    });
  </script>
</body>

</html>
