function loadBeriAkses() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillTableBeriAkses(data);
    }
  };
  xhr.open("GET", "index.php?action=beri-akses", true);
  xhr.send();
}

function fillTableBeriAkses(data) {
  var table = document.getElementById("beri-akses-table");
  var tableHTML = `<tr class="font-semibold border-b-2 border-gray-200 bg-gray-50 sticky top-0">
                            <th class="py-2 border-r-2">No</th>
                            <th class="border-r-2">Foto</th>
                            <th class="border-r-2">Nama Pengguna</th>
                            <th class="border-r-2">Akses</th>
                            <th class="w-96">Aksi</th>
                         </tr>`;
  // Cek apakah data kosong
  if (data.length === 0) {
    // Tambahkan baris dengan pesan "Tidak ada tugas"
    tableHTML += `<tr class="border-b-2">
                    <td class="py-2 text-center" colspan="6">Tidak ada pengguna</td>
                  </tr>`;
  } else {
    data.forEach(function (item, index) {
      var namaBelakang = item.Nama_Belakang || "";
      tableHTML += `<tr class="border-b-2 w-full">
                                <td class="py-2 border-r-2">${index + 1}</td>
                                <td class="border-r-2">
                                    <div class="w-full flex justify-center" onclick="showFullSizeImage('${
                                      item.Foto_Path
                                    }')">
                                        <img src="${
                                          item.Foto_Path
                                            ? item.Foto_Path
                                            : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973461_960_720.png"
                                        }"
                                        alt="" class="h-24 w-24 rounded-sm ">
                                    </div>
                                </td>
                                <td class="border-r-2">${
                                  item.Nama_Depan
                                }  ${namaBelakang}</td>
                                <td class="border-r-2">${item.Nama_Peran}</td>
                                <td class="">
                                        <div class="flex h-full justify-center">
                                            <div class="flex flex-col items-center justify-center px-2 cursor-pointer" onclick="showPopup(); loadUbahDataAsistenById(${
                                              item.ID_Pengguna
                                            }) ;   event.preventDefault();">
                                                <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="black" d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"/></svg>
                                                </div>
                                                <p class="text-xs">Ubah</p>
                                            </div>
                                        </div>
                                </td>

                          </tr>`;
    });
  }
  table.innerHTML = tableHTML;
}

// detail data beranda
function loadUbahDataAsistenById(id_pengguna) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillPopUpDataAsistenById(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=detailPengguna&id_pengguna=" + id_pengguna,
    true
  );
  xhr.send();
}
function fillPopUpDataAsistenById(data) {
  // Langsung gunakan 'data' tanpa mengasumsikan sebagai array
  const detailData = data; // Tidak perlu mengambil data[0]

  var table = document.getElementById("detailTable");
  if (table) {
    // Pastikan elemen 'table' ditemukan
    table.innerHTML = `
                      <tr><td class="w-full font-semibold md:pr-32 py-4">Nama Pengguna</td><td>: ${
                        (detailData.Nama_Depan || "") +
                        " " +
                        (detailData.Nama_Belakang || "")
                      }</td></tr>
                      <tr><td class="w-full font-semibold md:pr-32 py-4">Email</td><td>: ${
                        detailData.Email || ""
                      }</td></tr>
                      <tr><td class="w-full font-semibold md:pr-32 py-4">Nim</td><td>: ${
                        detailData.Nim || ""
                      }</td></tr>
                      <tr><td class="w-full font-semibold md:pr-32 py-4">Hak Akses</td><td>: ${
                        detailData.Nama_Peran || ""
                      }</td></tr>
                      <tr >
                          <td class="w-full font-semibold md:pr-32 py-4">Hak Akses Baru</td>
                          <td class=" flex justify-center items-center">:
                              <select name="id_peran" id="id_peran" class="rounded-md text-center bg-[#C2C2C2] border p-3  text-xs">
                                  <option value="" disabled selected>Pilih peran Baru</option>
                                  <option value="1" ${
                                    detailData.ID_Peran === "1"
                                      ? "selected"
                                      : ""
                                  }>Asisten</option>
                                  <option value="2" ${
                                    detailData.ID_Peran === "2"
                                      ? "selected"
                                      : ""
                                  }>Laboran</option>
                                  <option value="3" ${
                                    detailData.ID_Peran === "3"
                                      ? "selected"
                                      : ""
                                  }>Korlab</option>
                              </select>
                          </td>
                      </tr>
                      <tr>
                        <td colspan="2" class="mt-10 w-full text-center">
                            <button  class="mt-6 px-5 py-3 rounded-md bg-[#C2C2C2] text-black hover:bg-[#8A8888]" type="button" onclick="confirmResetPassword(${
                              detailData.ID_Pengguna
                            })">Reset Password</button>
                            <button  class="mt-6 px-5 py-3 rounded-md bg-[#375679] text-white hover:bg-[#2D4764]" type="button" onclick="saveChanges(${
                              detailData.ID_Pengguna
                            })">Simpan</button>
                        </td>
                      </tr>
              `;
  } else {
    console.error("Elemen 'detailTable' tidak ditemukan");
  }
}

// mengubah peran pengguna
function saveChanges(idPengguna) {
  var idPeran = document.getElementById("id_peran").value;
  var formData = new FormData();
  formData.append("id_pengguna", idPengguna);
  formData.append("id_peran", idPeran);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php?action=peranBaru", true);
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // Parse respons JSON dari server
      var response = JSON.parse(xhr.responseText); // Menambahkan parsing JSON

      // Cek apakah operasi berhasil
      if (response.success) {
        // Menggunakan SweetAlert untuk sukses
        swal({
          title: "Berhasil!",
          text: response.message,
          icon: "success",
        }).then(() => {
          loadBeriAkses(); // Memuat ulang data
          // Opsional: lakukan tindakan lanjutan, seperti memperbarui UI
          closePopup(); // Menutup popup setelah konfirmasi SweetAlert
        });
      } else {
        // Menggunakan SweetAlert untuk error
        swal({
          title: "Error!",
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
  xhr.onerror = function () {
    // Menggunakan SweetAlert untuk kesalahan jaringan atau server
    swal({
      title: "Gagal!",
      text: "Gagal mengirimkan request",
      icon: "error",
    });
  };
  xhr.send(formData);
}

// reset password pengguna
function resetPasswordPengguna(idPengguna) {
  var formData = new FormData();
  formData.append("id_pengguna", idPengguna);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php?action=resetPassword", true);
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // Parse respons JSON dari server
      var response = JSON.parse(xhr.responseText); // Menambahkan parsing JSON

      // Cek apakah operasi berhasil
      if (response.success) {
        // Menggunakan SweetAlert untuk sukses
        swal({
          title: "Berhasil!",
          text: response.message,
          icon: "success",
        }).then(() => {
          loadBeriTugas(); // Memuat ulang data
          // Opsional: lakukan tindakan lanjutan, seperti memperbarui UI
          closePopup(); // Menutup popup setelah konfirmasi SweetAlert
        });
      } else {
        // Menggunakan SweetAlert untuk error
        swal({
          title: "Error!",
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
  xhr.onerror = function () {
    // Menggunakan SweetAlert untuk kesalahan jaringan atau server
    swal({
      title: "Gagal!",
      text: "Gagal mengirimkan request",
      icon: "error",
    });
  };
  xhr.send(formData);
}

// confirm reset password
function confirmResetPassword(idPengguna) {
  // Menggunakan SweetAlert untuk tampilkan dialog konfirmasi
  swal({
    title: "Apakah Anda yakin?",
    text: "Apakah Anda yakin ingin mereset password pengguna ini?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  }).then((willReset) => {
    if (willReset) {
      // Jika pengguna mengklik "OK", lanjutkan dengan reset password
      resetPasswordPengguna(idPengguna);
    } else {
      // Jika pengguna mengklik "Batal", tampilkan pemberitahuan
      swal("Operasi dibatalkan", {
        icon: "info",
      });
    }
  });
}
