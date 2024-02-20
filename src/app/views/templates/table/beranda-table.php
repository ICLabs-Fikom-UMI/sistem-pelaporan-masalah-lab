<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beranda table</title>
    <link rel="stylesheet" href="../../asset/bootstrap/css/bootstrap.css">

</head>

<body>
    <table id="beranda-table" class="table table-hover" style="width:100%; ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Jenis Barang</th>
                <th>Nomor</th>
                <th>Batas Waktu</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>


        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Jenis Barang</th>
                <th>Nomor</th>
                <th>Batas Waktu</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </tfoot>
    </table>



    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <!-- <script>
        $(document).ready(function() {
        $('#beranda-table').DataTable(); // Memperbaiki ID tabel di sini
    });
    </script> -->
  <script>
$(document).ready(function() {
    // Hapus event listener DOMContentLoaded karena sudah dalam jQuery ready function
    fetch("http://localhost:8001/index.php?action=beranda")
    .then((response) => response.json())
    .then((responseData) => {
        const tableBody = $("#beranda-table tbody");
        let tableHTML = "";
        responseData.data.forEach((item, index) => {
            let statusText = item.Status_Masalah === "Selesai" ? "Selesai" : item.Status_Masalah === "Disetujui" ? "Dikerjakan" : item.Status_Masalah;
            tableHTML += `<tr class="border-b-2">
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
                                            d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />                                        <path fill="black" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" /></svg>
                                        </td>
            </tr>`;
        });
        tableBody.html(tableHTML);
        if ($.fn.dataTable.isDataTable('#beranda-table')) {
            $('#beranda-table').DataTable().clear().destroy();
        }

        // Inisialisasi ulang DataTable
        $('#beranda-table').DataTable();
    })
    .catch((error) => console.error("Error loading the table data:", error));
});
</script>

</body>

</html>
