function loadDataBeranda() {
  fetch("index.php?action=beranda") // Sesuaikan URL sesuai dengan setup Anda
    .then((response) => response.json())
    .then((responseData) => {
      const table = document.getElementById("beranda-table");
      let tableHTML = "";
      table.innerHTML = `
      <tr class="font-semibold border-b-2 border-gray-200 bg-gray-50 sticky top-0">
          <th class="border-r-2 py-2">No</th>
          <th class="border-r-2">Nama Ruangan</th>
          <th class="border-r-2">Jenis Barang</th>
          <th class="border-r-2">Nomor</th>
          <th class="border-r-2">Batas Waktu</th>
          <th class="border-r-2">Status</th>
          <th class="border-r-2">Detail</th>
      </tr>
    `; // Menambahkan kembali header tabel
      if (responseData.data && responseData.data.length > 0) {
        responseData.data.forEach((item, index) => {
          let statusText;
          if (item.Status_Masalah === "Selesai") {
            statusText = "Selesai";
          } else if (item.Status_Masalah === "Disetujui") {
            statusText = "Dikerjakan";
          } else {
            statusText = item.Status_Masalah;
          }

          // Tambahkan "New" pada nama ruangan untuk data dengan indeks 1-3
          let namaLab =
            index < 3
              ? `${item.Nama_Lab} - <span class="italic font-semibold text-red-400">New</span>`
              : item.Nama_Lab;
          tableHTML += `
                <tr class="border-b-2">
                    <td class="py-2 border-r-2">${index + 1}</td>
                    <td class="border-r-2">${namaLab}</td>
                    <td class="border-r-2">${item.Nama_Aset}</td>
                    <td class="border-r-2">${item.Nomor_Unit}</td>
                    <td class="border-r-2">${item.Batas_Waktu}</td>
                    <td class="border-r-2">${statusText}</td>
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
      } else {
        // Jika tidak ada data, tampilkan pesan "Tidak ada data laporan"
        tableHTML += `
        <tr>
          <td colspan="7" class="text-center py-2">Tidak ada data laporan</td>
        </tr>
        `;
      }
      // Opsional: Tampilkan jumlahData jika diperlukan
      tableHTML += `
      <tfoot class="sticky bottom-0 bg-white">
      <tr class="border-t-2 sticky bottom-0 bg-white">
        <td colspan="7" class="py-2 text-center font-semibold">Total Data: ${responseData.jumlahData}</td>
     </tr>
     </tfoot>
    `;
      table.innerHTML += tableHTML;
    })
    .catch((error) => console.error("Error loading the table data:", error));
}
// Memanggil fungsi saat DOMContentLoaded
document.addEventListener("DOMContentLoaded", loadDataBeranda);

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

    let fotoRow = ""; // Inisialisasi string kosong untuk baris foto
    let komentarRow = ""; // Inisialisasi string kosong untuk baris komentar

    // Menambahkan baris foto jika Foto_Path tidak kosong atau Status_Masalah adalah "Selesai"
    if (detailData.Foto_Path || detailData.Status_Masalah === "Selesai") {
      fotoRow = `<tr><td class="font-semibold md:pr-40 py-4">Foto</td><td class="flex items-center">: <img src="${
        detailData.Foto_Path || "#"
      }" alt="Foto Masalah" class="w-36 h-36" onclick="showFullSizeImage('${
        detailData.Foto_Path
      }')"></td></tr>`;
    }

    // Menambahkan baris komentar jika Status_Masalah adalah "Selesai"
    if (detailData.Status_Masalah === "Selesai") {
      komentarRow = `<tr><td class="font-semibold md:pr-40 py-4">Komentar</td><td>: ${
        detailData.Komentar || "Tidak ada komentar"
      }</td></tr>`;
    }

    table.innerHTML = `
              <tr><td class="font-semibold md:pr-40 py-4">Nama Ruangan</td><td>: ${
                detailData.Nama_Lab || ""
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
              ${fotoRow}
              ${komentarRow}
              `;
  } else {
    swal("Data tidak ditemukan", {
      icon: "error",
    });
    // Jika tidak ada data yang ditemukan
  }
}

// fullscreen image
function showFullSizeImage(imageSrc) {
  if (imageSrc) {
    // Open a new window
    var imageWindow = window.open("", "_blank");

    // Add HTML content to the new window
    imageWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Full Size Image</title>
            </head>
            <body style="background-color: rgba(0, 0, 0, 0.5); ">
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <button onclick="window.close();">Close</button>
                    <img src="${imageSrc}" style="max-width: 100%; height: 90vh;">
                </div>
            </body>
            </html>
        `);
  }
}
