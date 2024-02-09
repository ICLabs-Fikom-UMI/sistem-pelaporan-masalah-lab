document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("formBuatLaporan");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman formulir secara default

    // Membuat FormData dari form yang disubmit
    var formData = new FormData(form);

    // Membuat XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Konfigurasi request
    xhr.open("POST", "index.php?action=laporan-cepat", true); // Ganti 'path_ke_server_anda.php' dengan endpoint yang benar

    // Set up a handler for when the request finishes
    xhr.onload = function () {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          alert(response.message);
          // Opsional: Redirect atau update UI
        } else {
          alert(response.message);
          // Opsional: Tampilkan error di UI
        }
      } else {
        console.error("Request failed. Returned status of " + xhr.status);
      }
    };
    // Mengirimkan request dengan data
    xhr.send(formData);
  });
});
