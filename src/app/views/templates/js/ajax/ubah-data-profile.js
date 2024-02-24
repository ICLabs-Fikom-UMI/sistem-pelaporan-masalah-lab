function submitFotoProfile() {
  var xhr = new XMLHttpRequest();
  var formData = new FormData();
  var foto = document.getElementById("foto_profile").files[0];

  if (!foto) {
    console.log("Tidak ada file yang dipilih.");
    // Menggunakan SweetAlert untuk meminta pengguna memilih file
    swal({
      title: "Peringatan!",
      text: "Silakan pilih file terlebih dahulu.",
      icon: "warning",
    });
    return; // Hentikan eksekusi jika tidak ada file
  }

  // Log info file jika ada
  console.log("File yang diupload:", foto.name, "ukuran:", foto.size);

  formData.append("foto_input", foto);

  // Debugging FormData
  for (var pair of formData.entries()) {
    console.log(pair[0] + ", " + pair[1]);
  }

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      try {
        var data = JSON.parse(xhr.responseText);
        if (data.success) {
          // Menggunakan SweetAlert untuk sukses
          swal({
            title: "Berhasil!",
            text: data.message,
            icon: "success",
          }).then(() => {
            loadTugas(); // Pastikan fungsi ini terdefinisi dan melakukan apa yang diharapkan
            closePopup(); // Pastikan ini ada dan berfungsi seperti yang diharapkan
          });
        } else {
          // Menggunakan SweetAlert untuk gagal
          swal({
            title: "Gagal!",
            text: data.message,
            icon: "error",
          });
        }
      } catch (e) {
        console.error("Error parsing JSON:", e);
        // Menggunakan SweetAlert untuk error parsing
        swal({
          title: "Error!",
          text: "Terjadi kesalahan dalam mengolah data.",
          icon: "error",
        });
      }
    }
  };

  xhr.open("POST", "index.php?action=uploadFotoProfile", true);
  xhr.send(formData);
}
