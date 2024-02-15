document.getElementById("fileInput").addEventListener("change", function (e) {
  var file = e.target.files[0]; // Ambil file yang dipilih
  if (!file) {
    return; // Jika tidak ada file, hentikan fungsi
  }

  var formData = new FormData();
  formData.append("foto", file); // 'foto' adalah kunci yang akan digunakan di sisi server untuk mengakses file

  // Menunjukkan loading
  var uploadButton = document.getElementById("uploadButton");
  var loadingText = document.getElementById("loadingText");
  uploadButton.disabled = true; // Disable tombol saat loading
  loadingText.textContent = "...Mengunggah"; // Tambahkan teks loading

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index?action=uploadFotoProfile", true); // Ganti dengan URL endpoint Anda

  xhr.onload = function () {
    if (xhr.status == 200) {
      alert("File berhasil diunggah");
      // Reset tombol
      loadingText.textContent = ""; // Hapus teks loading
      uploadButton.disabled = false; // Enable tombol kembali
    } else {
      alert("Gagal mengunggah file");
      // Reset tombol
      loadingText.textContent = ""; // Hapus teks loading
      uploadButton.disabled = false; // Enable tombol kembali
    }
  };

  xhr.onerror = function () {
    // Handle error jika request gagal
    alert("Terjadi kesalahan saat mengunggah file");
    // Reset tombol
    loadingText.textContent = ""; // Hapus teks loading
    uploadButton.disabled = false; // Enable tombol kembali
  };

  xhr.send(formData); // Kirim form data ke server
});
