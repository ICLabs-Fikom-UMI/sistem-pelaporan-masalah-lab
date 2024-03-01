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
        try {
          // Coba parse respons dan asumsikan tipe kontennya adalah JSON
          var contentType = xhr.getResponseHeader("Content-Type");
          if (contentType.includes("application/json")) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
              // Sukses, tampilkan SweetAlert
              swal({
                title: "Berhasil!",
                text: response.message,
                icon: "success",
              }).then(() => {
                form.reset(); // Reset form setelah sukses
                document.getElementById("beriAksesBtn").click();
              });
            } else {
              // Respons mengindikasikan gagal, tampilkan pesan error
              swal({
                title: "Gagal!",
                text: response.message,
                icon: "error",
              });
            }
          } else {
            throw new Error("Response was not JSON");
          }
        } catch (e) {
          // Parsing JSON gagal atau respons bukan JSON, tampilkan error
          swal({
            title: "Error",
            text: "Could not parse response as JSON",
            icon: "error",
          });
        }
      } else {
        // Request gagal, tampilkan SweetAlert
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
