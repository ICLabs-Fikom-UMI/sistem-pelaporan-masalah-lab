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
    tableHTML += `<tr class="border-b-2">
                        <td class="py-2">${index + 1}</td>
                        <td>${item.Nama_Lab}</td>
                        <td>${item.Nama_Aset}</td>
                        <td>${item.Nomor_Unit}</td>
                        <td>${item.Tanggal_Pelaporan}</td>
                        <td>${item.Status_Masalah}</td>
                        <td class="flex items-center justify-center w-52 ">
                                    <div class="flex">
                                        <div class="cursor-pointer" onclick="showPopup();  event.preventDefault();">
                                            <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                    viewBox="0 0 24 24">
                                                    <path fill="black"
                                                        d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs">Edit</p>
                                        </div>
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
    console.log("Data tidak ditemukan"); // Jika tidak ada data yang ditemukan
  }
}
