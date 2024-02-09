function loadBeriTugas() {
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
  var tableHTML = `<tr class="font-semibold border-b-2 border-gray-200">
                            <th class="py-2">No</th>
                            <th>Foto</th>
                            <th>Nama Pengguna</th>
                            <th>Akses</th>
                            <th class="w-96">Aksi</th>
                         </tr>`;

  data.forEach(function (item, index) {
    var namaBelakang = item.Nama_Belakang || "";
    tableHTML += `<tr class="border-b-2 w-full">
                                <td class="py-2">${index + 1}</td>
                                <td>
                                    <div class="w-full flex justify-center">
                                        <img src="https://codigoespagueti.com/wp-content/uploads/2022/08/anya-spy-x-family-otros-animes.jpg"
                                        alt="" class="h-24 w-24 rounded-sm ">
                                    </div>
                                </td>
                                <td>${item.Nama_Depan}  ${namaBelakang}</td>
                                <td>${item.Nama_Peran}</td>
                                <td class="">
                                        <div class="flex h-full justify-center">
                                            <div class="flex flex-col items-center justify-center px-2 cursor-pointer" onclick="showPopup();  event.preventDefault();">
                                                <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="black" d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"/></svg>
                                                </div>
                                                <p class="text-xs">Ubah</p>
                                            </div>
                                        </div>
                                </td>

                          </tr>`;
  });

  table.innerHTML = tableHTML;
}
