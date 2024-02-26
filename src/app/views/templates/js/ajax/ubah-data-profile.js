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

// ubah data profile
document.addEventListener("DOMContentLoaded", function () {
  // Simpan nilai awal input
  window.initialValues = {
    namaDepan: document.querySelector(".namaDepan").value,
    namaBelakang: document.querySelector(".namaBelakang").value,
    email: document.querySelector(".email").value,
    nim: document.querySelector(".nim").value,
  };
});

document
  .getElementById("simpanBtnUbahProfile")
  .addEventListener("click", function (event) {
    event.preventDefault(); // Menghentikan perilaku default link

    var userId = document.body.getAttribute("data-user-id");

    var namaDepan = document.querySelector(".namaDepan").value;
    var namaBelakang = document.querySelector(".namaBelakang").value;
    var email = document.querySelector(".email").value;
    var nim = document.querySelector(".nim").value;

    // Periksa apakah ada perubahan pada input teks saja
    var isChanged =
      namaDepan !== window.initialValues.namaDepan ||
      namaBelakang !== window.initialValues.namaBelakang ||
      email !== window.initialValues.email ||
      nim !== window.initialValues.nim;

    if (!isChanged) {
      // Menggunakan SweetAlert untuk memberitahu tidak ada perubahan
      swal({
        title: "Informasi",
        text: "Tidak ada perubahan yang dilakukan pada data.",
        icon: "info",
      });
      return; // Keluar dari fungsi jika tidak ada perubahan pada input teks
    }

    // Jika ada perubahan pada input teks, lanjutkan dengan logika pengiriman data
    var formData = new FormData();
    formData.append("nama_depan", namaDepan);
    formData.append("nama_belakang", namaBelakang);
    formData.append("email", email);
    formData.append("nim", nim);

    // Kirim formData ke server dengan XMLHttpRequest...
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?action=ubah-data-profile-submit", true); // Sesuaikan dengan endpoint server Anda
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Menggunakan SweetAlert untuk sukses
          swal({
            title: "Berhasil!",
            text: response.message,
            icon: "success",
          }).then(() => {
            // Opsional: lakukan tindakan lanjutan, seperti memperbarui UI
            loadDataUntukUbahData(userId); // Pastikan fungsi ini terdefinisi dan melakukan apa yang diharapkan
          });
        } else {
          // Menggunakan SweetAlert untuk gagal
          swal({
            title: "Gagal!",
            text: response.message,
            icon: "error",
          });
        }
      } else {
        console.error("Error status:", xhr.status);
      }
    };
    xhr.onerror = function () {
      console.error("Request error.");
      // Menggunakan SweetAlert untuk error request
      swal({
        title: "Error!",
        text: "Terjadi kesalahan dalam permintaan.",
        icon: "error",
      });
    };
    xhr.send(formData);
  });
