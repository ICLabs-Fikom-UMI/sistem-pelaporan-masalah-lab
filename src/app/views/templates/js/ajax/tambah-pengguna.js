document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("formTambahPengguna");

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Mencegah pengiriman formulir secara default

    // Membuat FormData dari form yang disubmit
    var formData = new FormData(form);

    // Membuat XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Konfigurasi request
    xhr.open("POST", "index.php?action=tambahUser", true);

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
          }).then(() => {
            // Opsional: lakukan tindakan lanjutan setelah dialog ditutup, seperti memperbarui UI atau navigasi
            form.reset();
          });
        } else {
          // Menggunakan SweetAlert untuk menampilkan pesan error
          swal({
            title: "Gagal!",
            text: response.message,
            icon: "error",
          });
        }
      } else {
        // Menggunakan SweetAlert untuk kesalahan request
        swal({
          title: "Gagal!",
          text: "Request failed. Returned status of " + xhr.status,
          icon: "error",
        });
      }
    };
    // Mengirimkan request dengan data
    xhr.send(formData);
  });
});
