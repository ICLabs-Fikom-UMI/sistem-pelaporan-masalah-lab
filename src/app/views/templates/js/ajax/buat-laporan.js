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
          // Menggunakan SweetAlert untuk sukses
          swal({
            title: "Berhasil!",
            text: response.message,
            icon: "success",
            button: "Oke",
          }).then(() => {
            // Opsional: Redirect atau update UI
          });
        } else {
          // Menggunakan SweetAlert untuk error
          swal({
            title: "Gagal!",
            text: response.message,
            icon: "error",
            button: "Oke",
          });
        }
      } else {
        console.error("Request failed. Returned status of " + xhr.status);
        // Opsional: Gunakan SweetAlert untuk menampilkan error request
        swal({
          title: "Gagal!",
          text: "Request failed. Returned status of " + xhr.status,
          icon: "error",
          button: "Oke",
        });
      }
    };

    // Mengirimkan request dengan data
    xhr.send(formData);
  });
});
