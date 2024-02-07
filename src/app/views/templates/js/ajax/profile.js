function loadData(id_pengguna) {
  var xhr = new XMLHttpRequest();
  console.log(id_pengguna);
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
  console.log(data);
  var tableHTML = `
        <tr class="flex justify-start items-center">
            <th class="font-semibold w-80 p-5 mb-2 text-start">Nama Pengguna</th>
            <td class="font-normal w-full"><p>${data.Nama_Depan}  ${data.Nama_Belakang}</p></td>
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
                <button class="py-3 px-8 bg-[#C2C2C2] rounded-md me-5 hover:bg-[#8A8888] hover:text-white" type="reset">Ubah Password</button>
                <a href="#" class="py-4 px-8 bg-[#375679] hover:bg-[#273C54] text-white rounded-md" id="ubahDataBtn">Ubah data</a>
            </th>
        </tr>
    `;

  // Memperbarui konten tabel dengan data baru
  const tableProfile = document.getElementById("tableProfile");
  if (tableProfile) {
    tableProfile.innerHTML = tableHTML;
  } else {
    console.error("Tabel tidak ditemukan");
  }
}

// document.addEventListener("DOMContentLoaded", function () {
//   document.getElementById("profileBtn").addEventListener("click", function (e) {
//     e.preventDefault(); // Mencegah link melakukan navigasi

//   });
// });
