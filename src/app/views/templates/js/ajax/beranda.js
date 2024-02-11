document.addEventListener("DOMContentLoaded", function () {
  fetch("index.php?action=beranda") // Sesuaikan URL sesuai dengan setup Anda
    .then((response) => response.json())
    .then((data) => {
      const table = document.getElementById("beranda-table");
      let tableHTML = "";
      data.forEach((item, index) => {
        let statusText;
        if (item.Status_Masalah === "Selesai") {
          statusText = "Selesai";
        } else if (item.Status_Masalah === "Disetujui") {
          statusText = "Dikerjakan";
        } else {
          statusText = item.Status_Masalah;
        }
        tableHTML += `
                <tr class="border-b-2">
                    <td class="py-2">${index + 1}</td>
                    <td>${item.Nama_Lab}</td>
                    <td>${item.Nama_Aset}</td>
                    <td>${item.Nomor_Unit}</td>
                    <td>${item.Batas_Waktu}</td>
                    <td>${statusText}</td>
                    <td class="flex items-center justify-center"><svg onclick="showPopup(); loadDetailDataBeranda(${
                      item.ID_Masalah
                    });  event.preventDefault();" xmlns="http://www.w3.org/2000/svg"
                                        width="28" height="28" viewBox="0 0 24 24" class="cursor-pointer">
                                        <path fill="black"
                                            d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                        <path fill="black" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" /></svg>
                                        </td>
                </tr>
            `;
      });
      table.innerHTML += tableHTML;
    })
    .catch((error) => console.error("Error loading the table data:", error));
});

// detail data beranda
function loadDetailDataBeranda(id_masalah) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillPopUpDetailBeranda(data);
    }
  };
  xhr.open(
    "GET",
    "index.php?action=beranda-detail&id_masalah=" + id_masalah,
    true
  );
  xhr.send();
}

function fillPopUpDetailBeranda(data) {
  if (data.length > 0) {
    const detailData = data[0]; // Mengambil objek pertama dari array
    let statusText;
    if (detailData.Status_Masalah === "Selesai") {
      statusText = "Selesai";
    } else if (detailData.Status_Masalah === "Disetujui") {
      statusText = "Dikerjakan";
    } else {
      statusText = detailData.Status_Masalah;
    }
    var table = document.getElementById("detailTable");
    table.innerHTML = `
            <tr><td class="font-semibold md:pr-40 py-4">Nama Ruangan</td><td>: ${
              (detailData.Nama_Lab || "") +
              " " +
              (detailData.Nama_Belakang || "")
            }</td></tr>
            <tr><td class="font-semibold md:pr-40 py-4">Jenis Barang</td><td>: ${
              detailData.Nama_Aset || ""
            }</td></tr>
            <tr><td class="font-semibold md:pr-40 py-4">Nomor</td><td>: ${
              detailData.Nomor_Unit || ""
            }</td></tr>
            <tr>
            <td class="font-semibold md:pr-40 py-4 w-48">Deskripsi Masalah</td>
            <td>: ${detailData.Deskripsi_Masalah || ""}</td>
            </tr>
            <tr><td class="font-semibold md:pr-40 py-4">Teknisi</td><td>: ${
              detailData.teknisi || ""
            }</td></tr>
            <tr><td class="font-semibold md:pr-40 py-4">Status</td><td>: ${
              statusText || ""
            }</td></tr>
            <tr><td class="font-semibold md:pr-40 py-4">Batas Waktu</td><td>: ${
              detailData.Batas_Waktu || ""
            }</td></tr>
            `;
  } else {
    console.log("Data tidak ditemukan"); // Jika tidak ada data yang ditemukan
  }
}
