function loadLaporanMasuk() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillTableLaporanMasuk(data);
    }
  };
  xhr.open("GET", "index.php?action=laporan-masuk", true);
  xhr.send();
}

function fillTableLaporanMasuk(data) {
  var table = document.getElementById("laporan-masuk-table");
  var tableHTML = `<tr class="font-semibold border-b-2 border-gray-200">
                          <th class="py-2">No</th>
                          <th>Nama Ruangan</th>
                          <th>Jenis Barang</th>
                          <th>Nomor</th>
                          <th>Tanggal</th>
                          <th class="w-52">Aksi</th>
                       </tr>`;

  data.forEach(function (item, index) {
    tableHTML += `<tr class="border-b-2">
                          <td class="py-2">${index + 1}</td>
                          <td>${item.Nama_Lab}</td>
                          <td>${item.Nama_Aset}</td>
                          <td>${item.Nomor_Unit}</td>
                          <td>${item.Tanggal_Laporan}</td>
                          <td class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="28" height="28" viewBox="0 0 24 24" onclick="showPopup(); loadDataLaporanMasukById(${
                                              item.ID_Masalah
                                            })">
                                            <path fill="black"
                                                d="M15.25 18.75q.3 0 .525-.225T16 18q0-.3-.225-.525t-.525-.225q-.3 0-.525.225T14.5 18q0 .3.225.525t.525.225m2.75 0q.3 0 .525-.225T18.75 18q0-.3-.225-.525T18 17.25q-.3 0-.525.225T17.25 18q0 .3.225.525t.525.225m2.75 0q.3 0 .525-.225T21.5 18q0-.3-.225-.525t-.525-.225q-.3 0-.525.225T20 18q0 .3.225.525t.525.225M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h14q.825 0 1.413.588T21 5v6.7q-.475-.225-.975-.387T19 11.075V5H5v14h6.05q.075.55.238 1.05t.387.95zm0-3v1V5v6.075V11zm2-1h4.075q.075-.525.238-1.025t.362-.975H7zm0-4h6.1q.8-.75 1.788-1.25T17 11.075V11H7zm0-4h10V7H7zm11 14q-2.075 0-3.537-1.463T13 18q0-2.075 1.463-3.537T18 13q2.075 0 3.538 1.463T23 18q0 2.075-1.463 3.538T18 23" />
                                        </svg></td>
                        </tr>`;
  });

  table.innerHTML = tableHTML;
}

function loadDataLaporanMasukById(id_masalah) {
  var xhr = new XMLHttpRequest();
  console.log("id_masalah:", id_masalah);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      console.log("data:", data);
      fillPopUpDataLaporanMasuk(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=detailLaporanMasuk&id_masalah=" + id_masalah,
    true
  );
  xhr.send();
}
function fillPopUpDataLaporanMasuk(data) {
  if (data && data.dataDetailLaporan.hasOwnProperty("Nama_Lab")) {
    let detailLaporan = data.dataDetailLaporan;
    let users = data.dataUser;

    console.log("detailLaporan:", detailLaporan);
    console.log("di fungsi fillPopUpDataLaporanMasuk:");
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
          <tr><td class="font-semibold md:pr-28 py-4">Nama Ruangan</td><td>: ${
            detailLaporan.Nama_Lab || ""
          }</td></tr>
          <tr><td class="font-semibold md:pr-28 py-4">Jenis Barang</td><td>: ${
            detailLaporan.Nama_Aset || ""
          }</td></tr>
          <tr><td class="font-semibold pr-12 md:pr-24 py-4">Nomor</td><td>: ${
            detailLaporan.Nomor_Unit || ""
          }</td></tr>
          <tr>
          <td class="font-semibold md:pr-28 py-4">Deskripsi Masalah</td>
          <td>: ${detailLaporan.Deskripsi_Masalah || ""}</td>
          </tr>
          <tr><td class="font-semibold md:pr-28 py-4">Tanggal Laporan</td><td>: ${
            detailLaporan.Tanggal_Pelaporan || ""
          }</td></tr>
          <tr ><td class="font-semibold md:pr-28 py-4">Pilih Teknisi</td><td> <select multiple id="teknisiDropdown" class="w-full border border-gray-300 p-2 rounded-md">
        `;

    // Menambahkan options ke dropdown dari dataUser
    users.forEach((user) => {
      htmlContent += `<option value="${user.ID}">${user.Nama_Depan}</option>`;
    });

    htmlContent += `</select></td></tr>`;

    // Baris baru untuk input "Batas Waktu"
    htmlContent += `<tr><td class="font-semibold md:pr-28 py-4">Batas Waktu</td><td><input id="batas_waktu" type="date" class="w-full border border-gray-300 p-2 rounded-md"></td></tr>`;

    // Baris baru untuk input "Deskripsi Tambahan"
    htmlContent += `<tr><td class="font-semibold md:pr-28 py-4">Deskripsi Tambahan</td><td><textarea class="w-full border border-gray-300 p-2 rounded-md"></textarea></td></tr>`;

    table.innerHTML = htmlContent;
  } else {
    console.log("Data tidak ditemukan");
  }
}
