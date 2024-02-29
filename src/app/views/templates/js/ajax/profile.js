function loadData(id_pengguna) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillTable(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=detailPengguna&id_pengguna=" + id_pengguna,
    true
  );
  xhr.send();
}

function fillTable(data) {
  var tableHTML = `
        <tr class="flex justify-start items-center">
            <th class="font-semibold w-80 p-5 mb-2 text-start">Nama Pengguna</th>
            <td class="font-normal w-full"><p>${data.Nama_Depan}  ${
    data.Nama_Belakang || ""
  }</p></td>
        </tr>
        <tr class="flex justify-start items-center mb-2">
            <th class="font-semibold w-80 p-5 text-start">Email</th>
            <td class="font-normal w-full text-start"><p>${data.Email}</p></td>
        </tr>
        <tr class="flex justify-start items-center mb-3">
            <th class="font-semibold w-80 p-5 text-start">Nim</th>
            <td class="font-normal w-full"><p>${data.Nim}</p></td>
        </tr>
        <tr class="flex justify-start items-center mb-3">
            <th class="font-semibold w-80 p-5 text-start">Hak Akses</th>
            <td class="font-normal w-full"><p>${data.Nama_Peran}</p></td>
        </tr>
        <tr class="flex justify-start items-center mt-10">
            <th class="font-semibold  p-5 text-center  w-full" colspan="2">
                <button class="py-3 px-8 bg-[#C2C2C2] rounded-md me-5 hover:bg-[#8A8888] hover:text-white"onclick="showPopup(); fillPopUpUbahPassword(${
                  data.ID_Pengguna
                });  event.preventDefault();">Ubah Password</button>
                <a href="#" class="py-4 px-8 bg-[#375679] hover:bg-[#273C54] text-white rounded-md" id="ubahDataBtn" onclick="loadDataUntukUbahData(${
                  data.ID_Pengguna
                });"n>Ubah data</a>
            </th>
        </tr>
    `;

  // Memperbarui konten tabel dengan data baru
  const tableProfile = document.getElementById("tableProfile");
  if (tableProfile) {
    tableProfile.innerHTML = tableHTML;
    // Set Foto_Path jika ada
    if (data.Foto_Path) {
      document.getElementById("foto-profile").src = data.Foto_Path;
    } else {
      // Jika tidak ada Foto_Path, gunakan placeholder atau sembunyikan gambar
      document.getElementById("foto-profile").src =
        "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973461_960_720.png"; // Ganti dengan path ke gambar default Anda atau kosongkan
    }

    // Tambahkan listener untuk tombol "Ubah data"
    document
      .getElementById("ubahDataBtn")
      .addEventListener("click", function () {
        showForm("ubahDataForm");
      });
  } else {
    console.error("Tabel tidak ditemukan");
  }
}

// lihat data untuk ubah data
function loadDataUntukUbahData(id_pengguna) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillFormWithData(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=detailPengguna&id_pengguna=" + id_pengguna,
    true
  );
  xhr.send();
}

// ubah password
function fillPopUpUbahPassword(idMasalah) {
  var table = document.getElementById("detailTable");
  let htmlContent = `
            <tr>
                <td colspan="2" class="text-center py-4">
                   <p class="font-bold text-2xl">Masukkan password baru</p>
                </td>
            </tr>
            <tr>
              <td><input type="password" id="passwordBaru" class="mt-14 bg-[#F9F9FB] border py-6 px-2 w-full rounded-md " placeholder="Masukkan password baru"></td>
            </tr>
            <tr>
              <td><input type="password" id="konfirmasiPassword" class="mt-10 bg-[#F9F9FB] border py-6 px-2 w-full rounded-md" placeholder="Konfirmasi password baru"></td>
            </tr>
            <tr>
              <td colspan="2" class="text-center py-4">
                <input type="hidden" id="idMasalah" value="${idMasalah}">
                <button type="button" id="btnKirim" class="mt-6 font-semibold py-4 px-8 bg-[#375679] hover:bg-[#273C54] text-white rounded-md" onclick="submitUbahPassword()">Kirim</button>
              </td>
            </tr>
          `;

  table.innerHTML = htmlContent;
}

function fillFormWithData(data) {
  // Menetapkan nilai ke dalam input form
  document.querySelector(".namaDepan").value = data.Nama_Depan || "";
  document.querySelector(".namaBelakang").value = data.Nama_Belakang || "";
  document.querySelector(".email").value = data.Email || "";
  document.querySelector(".nim").value = data.Nim || "";
  document.getElementById("hak-akses").textContent = data.Nama_Peran || "";

  // Menampilkan foto profil jika ada
  var fotoProfileEl = document.querySelector(".foto-profile");
  if (data.Foto_Path) {
    fotoProfileEl.src = data.Foto_Path;
  } else {
    // Jika tidak ada Foto_Path, gunakan placeholder atau sembunyikan gambar
    fotoProfileEl.src =
      "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973461_960_720.png"; // Path ke gambar default atau placeholder
  }
}

// ubah password
function submitUbahPassword() {
  event.preventDefault(); // Menghentikan perilaku default form submit

  var idMasalah = document.getElementById("idMasalah").value;
  var passwordBaru = document.getElementById("passwordBaru").value;
  var konfirmasiPassword = document.getElementById("konfirmasiPassword").value;

  // Periksa kesesuaian password baru dan konfirmasi password
  if (passwordBaru !== konfirmasiPassword) {
    // Menggunakan SweetAlert atau alert biasa untuk memberitahu user
    swal({
      title: "Peringatan!",
      text: "Password baru dan konfirmasi password tidak cocok.",
      icon: "warning",
    });
    return; // Keluar dari fungsi jika password tidak cocok
  }

  // Jika password cocok, lanjutkan dengan logika pengiriman data
  var formData = new FormData();
  formData.append("id_masalah", idMasalah);
  formData.append("password_baru", passwordBaru);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php?action=profile-ubah-password", true); // Sesuaikan dengan endpoint server Anda
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      var response = JSON.parse(xhr.responseText);
      if (response.success) {
        // Menggunakan SweetAlert atau alert biasa untuk sukses
        swal({
          title: "Berhasil!",
          text: response.message,
          icon: "success",
        }).then(() => {
          closePopup();
        });
      } else {
        // Menggunakan SweetAlert atau alert biasa untuk gagal
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
    swal({
      title: "Error!",
      text: "Terjadi kesalahan dalam permintaan.",
      icon: "error",
    });
  };
  xhr.send(formData);
}
