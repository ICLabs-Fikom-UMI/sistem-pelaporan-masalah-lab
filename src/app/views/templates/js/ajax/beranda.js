document.addEventListener("DOMContentLoaded", function () {
  fetch("index.php?action=beranda") // Sesuaikan URL sesuai dengan setup Anda
    .then((response) => response.json())
    .then((data) => {
      const table = document.getElementById("myTable");
      let tableHTML = "";
      data.forEach((item, index) => {
        tableHTML += `
                <tr class="border-b-2">
                    <td class="py-2">${index + 1}</td>
                    <td>${item.Nama_Lab}</td>
                    <td>${item.Nama_Aset}</td>
                    <td>${item.Nomor_Unit}</td>
                    <td>${item.Batas_Waktu}</td>
                    <td>${item.Status_Masalah}</td>
                    <td class="flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="28" height="28" viewBox="0 0 24 24" class="cursor-pointer">
                                        <path fill="black"
                                            d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                        <path fill="black" d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" /></svg></td>
                </tr>
            `;
      });
      table.innerHTML += tableHTML;
    })
    .catch((error) => console.error("Error loading the table data:", error));
});
