function loadLaporanSaya() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillTableLaporanSaya(data);
    }
  };
  xhr.open("GET", "index.php?action=laporan-saya", true);
  xhr.send();
}

function fillTableLaporanSaya(data) {
  var table = document.getElementById("laporan-saya-table");
  var tableHTML = `<tr class="font-semibold border-b-2 border-gray-200">
                        <th class="py-2">No</th>
                        <th >Nama Ruangan</th>
                        <th>Jenis Barang</th>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="w-52">Aksi</th>
                     </tr>`;

  data.forEach(function (item, index) {
    // Cek jika Status_Masalah adalah Selesai atau Disetujui
    var actionDiv =
      item.Status_Masalah === "Selesai" || item.Status_Masalah === "Disetujui"
        ? `
      <div class="cursor-pointer" title="Laporan telah di terima">
        <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="currentColor" d="m10 10.2l4-4l3.8 3.8l-4 4l-1.4-1.4L15 9.9l-.9-.9l-2.6 2.6zm10.7-4.6l-2.3-2.3c-.2-.2-.5-.3-.7-.3c-.2 0-.5.1-.7.3l-1.8 1.8L19 8.9L20.7 7c.4-.3.4-1 0-1.4M19 21.7L17.7 23l-6.5-6.5L6.8 21H3v-3.8l4.5-4.5L1 6.3L2.3 5zm-9.2-6.6l-.9-.9L5 18.1v.9h.9z"/></svg></div>
        <p class="text-xs">Edit</p>
      </div>`
        : `
      <div class="cursor-pointer" onclick="showPopup(); loadDetailLaporanSayaByIdEdit(${item.ID_Masalah}); loadJenisBarang(); loadNamaLab(); event.preventDefault();">
        <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
            <path fill="black" d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"/>
        </svg></div>
        <p class="text-xs">Edit</p>
      </div>`;
    tableHTML += `<tr class="border-b-2">
                        <td class="py-2">${index + 1}</td>
                        <td>${item.Nama_Lab}</td>
                        <td>${item.Nama_Aset}</td>
                        <td>${item.Nomor_Unit}</td>
                        <td>${item.Tanggal_Pelaporan}</td>
                        <td>${item.Status_Masalah}</td>
                        <td class="flex items-center justify-center w-52 ">
                                    <div class="flex">
                                        ${actionDiv}
                                        <div class="px-6 cursor-pointer" onclick="showPopup(); loadDetailLaporanSayaById(${
                                          item.ID_Masalah
                                        });  event.preventDefault();">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    viewBox="0 0 24 24">
                                                    <path fill="black"
                                                        d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                                    <path fill="black" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" /></svg>
                                            </div>
                                            <p class="text-xs" >Detail</p>
                                        </div>
                                        <div class="cursor-pointer">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    viewBox="0 0 24 24">
                                                    <path fill="black"
                                                        d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs">Hapus</p>
                                        </div>

                                    </div>
                                </td>
                      </tr>`;
  });

  table.innerHTML = tableHTML;
}

// detail
function loadDetailLaporanSayaById(id_masalah) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillPopUpDetailLaporanSaya(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=laporan-saya-by-id&id_masalah=" + id_masalah,
    true
  );
  xhr.send();
}
function fillPopUpDetailLaporanSaya(data) {
  if (data && data.hasOwnProperty("Nama_Lab")) {
    let statusText;
    if (data.Status_Masalah === "Selesai") {
      statusText = "Selesai";
    } else if (data.Status_Masalah === "Disetujui") {
      statusText = "Dikerjakan";
    } else {
      statusText = data.Status_Masalah;
    }

    var table = document.getElementById("detailTable");
    let htmlContent = `
        <tr><td class="font-semibold md:pr-40 py-4">Nama Ruangan</td><td>: ${
          data.Nama_Lab || ""
        }</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Jenis Barang</td><td>: ${
          data.Nama_Aset || ""
        }</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Nomor</td><td>: ${
          data.Nomor_Unit || ""
        }</td></tr>
        <tr>
        <td class="font-semibold md:pr-40 py-4 w-48">Deskripsi Masalah</td>
        <td>: ${data.Deskripsi_Masalah || ""}</td>
        </tr>
        <tr><td class="font-semibold md:pr-40 py-4">Status</td><td>: ${
          statusText || ""
        }</td></tr>
      `;

    // Jika status masalah adalah Selesai, tambahkan foto (jika ada) dan komentar
    if (data.Status_Masalah === "Selesai") {
      // Tambahkan row untuk foto jika ada path foto
      if (data.Foto_Path) {
        htmlContent += `
            <tr><td class="font-semibold md:pr-40 py-4">Foto</td>
            <td>: <img src="${data.Foto_Path}" alt="Foto Masalah" style="width:100px;height:auto;"/></td></tr>
          `;
      }

      // Tambahkan row untuk komentar jika ada komentar
      if (data.Komentar) {
        htmlContent += `
            <tr><td class="font-semibold md:pr-40 py-4">Komentar</td>
            <td>: ${data.Komentar}</td></tr>
          `;
      }
    }

    table.innerHTML = htmlContent;
  } else {
    console.log("Data tidak ditemukan");
  }
}

// edit
// GET request untuk mengambil data laporan yang akan diedit

function loadDetailLaporanSayaByIdEdit(id_masalah) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillPopUpDetailLaporanSayaDetail(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=laporan-saya-get-edit&id_masalah=" + id_masalah,
    true
  );
  xhr.send();
}

function fillPopUpDetailLaporanSayaDetail(data) {
  if (data && data.hasOwnProperty("Nama_Lab")) {
    var table = document.getElementById("detailTable");
    let htmlContent = `
           <tr>
            <td class="font-semibold md:pr-40 py-4">Nama Ruangan</td>
            <td><select id="id_lab" class="w-full border border-gray-300 p-3 rounded-md">
                <option value="${data.ID_Lab}">${data.Nama_Lab}</option>
                <option value="1">Start Up</option>
                <option value="2">IoT</option>
                <option value="3">Computer Network</option>
                <option value="4">Multimedia</option>
                <option value="5">Data Science</option>
                <option value="6">Computer Vision</option>
                <option value="7">Microcontroller</option>
            </select>
            </td>
          </tr>
          <tr>
            <td class="font-semibold md:pr-40 py-4">Jenis Barang</td>
            <td><select id="id_aset" class="w-full border border-gray-300 p-3 rounded-md">
                <option value="${data.ID_Aset}">${data.Nama_Aset}</option>
                <option value="1">Monitor</option>
                <option value="2">PC</option>
                <option value="3">Mouse</option>
                <option value="4">TV</option>
                <option value="5">Mousepad</option>
                <option value="6">Keyboard</option>
                <option value="7">Label</option>
                <option value="8">Kursi</option>
                <option value="9">Sound System</option>
                <option value="10">Ac</option>
            </select>
            </td>
          </tr>
          <tr>
            <td class="font-semibold md:pr-40 py-4">Nomor</td>
            <td><input class="border border-gray-300 p-3 rounded-md" type="text" id="nomor_unit" value="${
              data.Nomor_Unit || ""
            }" class="input-detail"></td>
          </tr>
          <tr>
            <td class="font-semibold md:pr-40 py-4 w-48">Deskripsi Masalah</td>
            <td><textarea id="deskripsi_masalah" class="border border-gray-300 p-3 rounded-md">${
              data.Deskripsi_Masalah || ""
            }</textarea></td>
          </tr>
          <tr>
            <td class="font-semibold md:pr-40 py-4">Status</td>
            <td>
                <p>${data.Status_Masalah || ""}</p>
                <p>${data.ID_Aset || "tidak ada"}</p>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center py-4">
              <button onclick="submitEditLaporanSaya(${
                data.ID_Masalah
              })" class="mt-6 px-5 py-3 rounded-md bg-[#375679] text-white hover:bg-[#2D4764]">Kirim</button>
            </td>
          </tr>
        `;

    table.innerHTML = htmlContent;
  } else {
    console.log("Data tidak ditemukan");
  }
}

// POST request untuk mengirim data laporan yang telah diedit

function submitEditLaporanSaya(idMasalah) {
  var idLab = document.getElementById("id_lab").value;
  var idAset = document.getElementById("id_aset").value;
  var nomorUnit = document.getElementById("nomor_unit").value;
  var deskripsiMasalah = document.getElementById("deskripsi_masalah").value;
  console.log(idMasalah, idLab, idAset, nomorUnit, deskripsiMasalah);
  console.log("ID Lab: ", document.getElementById("id_lab").value);
  console.log("ID Aset: ", document.getElementById("id_aset").value);
  console.log("Nomor Unit: ", document.getElementById("nomor_unit").value);
  console.log(
    "Deskripsi Masalah: ",
    document.getElementById("deskripsi_masalah").value
  );

  var formData = new FormData();
  formData.append("id_masalah", idMasalah);
  formData.append("id_lab", idLab);
  formData.append("id_aset", idAset);
  formData.append("nomor_unit", nomorUnit);
  formData.append("deskripsi_masalah", deskripsiMasalah);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "index.php?action=laporan-saya-submit-edit", true);
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // Parse respons JSON dari server
      var response = JSON.parse(xhr.responseText); // Menambahkan parsing JSON

      // Cek apakah operasi berhasil
      if (response.success) {
        // Operasi berhasil, tampilkan pesan sukses
        alert(response.message);
        loadLaporanSaya(); // Memuat ulang data
        // Opsional: lakukan tindakan lanjutan, seperti memperbarui UI
      } else {
        // Operasi gagal, tampilkan pesan error
        alert(response.message);
      }
    } else {
      // Terjadi kesalahan pada request HTTP, tampilkan pesan error
      console.error("Request failed. Returned status of " + xhr.status);
    }
  };
  xhr.onerror = function () {
    alert("Gagal mengirimkan request");
  };
  xhr.send(formData);
  closePopup();
}
