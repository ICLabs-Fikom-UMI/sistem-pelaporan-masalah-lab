function loadTugas() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillTableTugas(data);
    }
  };
  xhr.open("GET", "index.php?action=tugas", true);
  xhr.send();
}

function fillTableTugas(data) {
  console.log(data);
  var table = document.getElementById("tugas-table");
  var tableHTML = `<tr class="font-semibold border-b-2 border-gray-200">
                            <th class="py-2">No</th>
                            <th>Nama Ruangan</th>
                            <th>Jenis Barang</th>
                            <th>Nomor</th>
                            <th>Batas Waktu</th>
                            <th class="w-52">Aksi</th>
                         </tr>`;

  // Cek apakah data kosong
  if (data.length === 0) {
    // Tambahkan baris dengan pesan "Tidak ada tugas"
    tableHTML += `<tr class="border-b-2">
                    <td class="py-2 text-center" colspan="6">Tidak ada tugas</td>
                  </tr>`;
  } else {
    data.forEach(function (item, index) {
      tableHTML += `<tr class="border-b-2">
                            <td class="py-2">${index + 1}</td>
                            <td>${item.Nama_Lab}</td>
                            <td>${item.Nama_Aset}</td>
                            <td>${item.Nomor_Unit}</td>
                            <td>${item.Batas_Waktu}</td>
                            <td class="flex items-center justify-center">
                                        <div class="flex">
                                            <div class="flex flex-col items-center justify-center px-2 cursor-pointer">
                                                <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        viewBox="0 0 24 24">
                                                        <path fill="black"
                                                            d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                                        <path fill="black" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" />
                                                    </svg>
                                                </div>
                                                <p class="text-xs">Detail</p>
                                            </div>
                                            <div class="flex flex-col items-center justify-center px-2 cursor-pointer">
                                                <div><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                                        viewBox="0 0 16 16">
                                                        <path fill="black" fill-rule="evenodd"
                                                            d="M3 13.5a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h9.25a.75.75 0 0 0 0-1.5H3a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9.75a.75.75 0 0 0-1.5 0V13a.5.5 0 0 1-.5.5zm12.78-8.82a.75.75 0 0 0-1.06-1.06L9.162 9.177L7.289 7.241a.75.75 0 1 0-1.078 1.043l2.403 2.484a.75.75 0 0 0 1.07.01z"
                                                            clip-rule="evenodd" /></svg>
                                                </div>
                                                <p class="text-xs">Selesai</p>
                                            </div>
                                        </div>
                                    </td>
                          </tr>`;
    });
  }
  table.innerHTML = tableHTML;
}
