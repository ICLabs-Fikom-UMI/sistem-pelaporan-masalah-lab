function submitFotoProfile(id_pengguna) {
  console.log("id_pengguna ubah profile:", id_pengguna);
  var xhr = new XMLHttpRequest();
  var formData = new FormData();
  var foto = document.getElementById("foto_profile").files[0];

  if (!foto) {
    console.log("Tidak ada file yang dipilih.");
    alert("Silakan pilih file terlebih dahulu.");
    return; // Hentikan eksekusi jika tidak ada file
  }

  // Log info file jika ada
  console.log("File yang diupload:", foto.name, "ukuran:", foto.size);

  // Pastikan id ini sesuai dengan HTML Anda
  formData.append("id_pengguna", id_pengguna);
  formData.append("foto_input", foto);

  // Debugging FormData (hanya bekerja di beberapa browser, seperti Firefox)
  for (var pair of formData.entries()) {
    console.log(pair[0] + ", " + pair[1]);
  }

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      try {
        var data = JSON.parse(xhr.responseText);
        if (data.success) {
          alert(data.message);
          loadTugas(); // Pastikan fungsi ini terdefinisi dan melakukan apa yang diharapkan
          closePopup(); // Pastikan ini ada dan berfungsi seperti yang diharapkan
        } else {
          alert(data.message);
        }
      } catch (e) {
        console.error("Error parsing JSON:", e);
        alert("Terjadi kesalahan dalam memproses data.");
      }
    }
  };

  xhr.open("POST", "index.php?action=uploadFotoProfile", true);
  xhr.send(formData);
}
