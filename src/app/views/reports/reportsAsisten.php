<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reports</title>
    <style>

    .border-spacing-2 {
        border-collapse: separate;
        border-spacing: 0.2rem; /* Atur nilai sesuai kebutuhan */
      }
      .border-spacing-1 {
        border-collapse: separate;
        border-spacing: 0.1rem; /* Atur nilai sesuai kebutuhan */
      }
      #no::placeholder {
        color: #977878;
        font-size: 0.75rem; /* 12px */
        line-height: 1rem; /* 16px */
      }
      #deskripsi::placeholder {
        color: #977878;
        display: flex;
        align-items: center;
        height: 100%;
        font-size: 0.75rem; /* 12px */
        line-height: 1rem; /* 16px */
      }
    </style>
  </head>
  <body>
    <!-- navbar -->
    <?php
        include('/var/www/html/app/includes/navbar.php');
    ?>

  <!-- pop up -->
<?php
if (isset($_SESSION['setuju_message']) || isset($_SESSION['tolak_message'])):
    $message = isset($_SESSION['setuju_message']) ? $_SESSION['setuju_message'] : $_SESSION['tolak_message'];
?>
    <div id="popup" class="popup fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="content bg-[#78B992] p-8 rounded text-center text-xl">
            <p><?php echo $message; ?></p>
            <p id="countdown" class="text-lg font-bold">3</p>
        </div>
    </div>
<?php
    unset($_SESSION['setuju_message']);
    unset($_SESSION['tolak_message']);
endif;
?>

    <!-- isi -->
    <div class="flex lg:mx-16 lg:my-7 justify-center md:flex-row flex-col">
      <div
        class="bg-[#B2B2B2] mt-24 mx-2 md:mx-4 lg:w-[1080px] lg:h-[738px] rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class="text-xl md:text-2xl font-semibold">Laporan Saya</p>
        </div>
        <div
          class="bg-[#D9D9D9] rounded-md mt-4 min-h-[300px] overflow-y-auto flex-grow pt-2 "
        >
            <table
              class="min-w-full table-auto w-full text-left whitespace-no-wrap border-spacing-1 md:border-spacing-2 "
            >
              <tr
                class="text-md md:text-lg font-semibold tracking-wide uppercase border-b bg-[#C2B8B8]"
              >
                <th
                  class="md:px-4 md:py-2 px-1 rounded-collapsexl text-center align-middle font-semibold shadow-xl"
                >
                  No
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Laporan
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Lab
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Tanggal
                </th>
                <th rowspan="100" class="bg-black">
                  <div class="border-l h-full"></div>
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Aksi/Status
                </th>
              </tr>

              <?php foreach ($allLaporanSaya as $index => $laporan): ?>
              <tr class="text-xs md:text-lg">
                <td
                  class="rounded-xl shadow-md md:shadow-xl text-center align-middle bg-[#E6E6E6]"
                >
                    <?= $index + 1; ?>
                </td>
                <td
                  class="rounded-xl shadow-md md:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6]"
                >
                    <span class="font-bold">Aset:</span> <?= $laporan['Nama_Aset']; ?><br>
                    <span class="font-bold">Masalah:</span> <?= $laporan['Deskripsi_Masalah']; ?>
                </td>
                <td
                  class="rounded-xl shadow-md md:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center"
                >
                  <div><?= $laporan['Nama_Lab']; ?></div>
                </td>
                <td
                  class="rounded-xl shadow-md md:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center align-middle"
                >
                  <div><?= date("d/m/Y", strtotime($laporan['Tanggal_Pelaporan'])); ?></div>
                </td>
                <td
                    class="rounded-xl shadow-md md:shadow-xl md:px-2 md:py-2 py-1 bg-[#E6E6E6] text-center align-middle text-sm"
                >
                <?php
                    $statusMasalah = $laporan['Status_Masalah'];
                    if ($statusMasalah === 'Disetujui') {
                        echo 'Sedang dikerjakan';
                    } elseif ($statusMasalah === 'Selesai') {
                        echo 'Telah diselesaikan';
                        $id_masalah = $laporan['ID_Masalah'];
                        echo '<p class="cursor-pointer underline font-semibold text-blue-400" onclick="showPopup(); loadData(' . $id_masalah . '); event.preventDefault();">Detail</p>';

                    } else {
                        ?>
                        <form action="index.php" method="get">
                            <input type="hidden" name="action" value="getEditLaporan">
                            <input type="hidden" name="id_masalah" value="<?= $laporan['ID_Masalah']; ?>">
                            <button type="submit" class="bg-[#AFD0BC] hover:bg-[#98BCA7] rounded-sm hover:border hover:border-black ms-1 w-full p-2 shadow-md md:shadow-xl">
                                Edit
                            </button>
                        </form>
                    <?php } ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>
        </div>
      </div>
      <!-- pop up -->
      <?php
        include('/var/www/html/app/includes/pop-up.php');
        ?>
      <!-- pop up end -->
      <div>
        <div
          class="bg-[#B2B2B2] mt-2 md:mt-24 lg:w-[497px] lg:min-h-[583px] mb-24 md:mb-0 rounded-md shadow-xl flex flex-col"
        >
          <div class="flex justify-center mt-7 mb-4">
            <p class="text-xl md:text-2xl font-semibold">Detail Laporan</p>
          </div>

          <form action="?action=editLaporan" method="post">
            <table
              class="ml-6  border-separate"
              style="border-spacing: 0 10px"
            >
              <tr class="text-md">
                <th class="font-semibold text-left w-44">ID Laporan</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0 md:p-2">
                    <?= $dataDetailLaporan['ID_Masalah'] ?? '-' ?>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Tanggal Dibuat</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0"><?= $dataDetailLaporan['Tanggal_Pelaporan'] ?? '-' ?></td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Nama Lab</th>
                <td class="w-96 bg-[#D9D9D9] rounded-l-md p-0 md:p-2">
                  <select
                    name="lab"
                    id="lab"
                    class="w-full bg-[#D9D9D9] text-md text-center align-middle rounded-l-md"
                  >
                  <?php if (isset($labs) && !empty($labs)): ?>
                    <?php foreach ($labs as $lab): ?>
                        <option value="<?= $lab['ID_Lab'] ?>"
                            <?php if (isset($dataDetailLaporan['ID_Lab']) && $dataDetailLaporan['ID_Lab'] == $lab['ID_Lab']) {
                                echo 'selected';
                            } ?>>
                            <?= $lab['Nama_Lab'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">-</option>
                <?php endif; ?>

                  </select>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Aset</th>
                <td class="w-96 bg-[#D9D9D9] rounded-l-md p-0 md:p-2">
                  <select
                    name="aset"
                    id="aset"
                    class="w-full bg-[#D9D9D9] rounded-l-md text-center align-middle text-md"
                  >
                  <?php if (isset($asets) && !empty($asets)): ?>
                    <?php foreach ($asets as $aset): ?>
                        <option value="<?= $aset['ID_Aset'] ?>"
                            <?php if (isset($dataDetailLaporan['ID_Aset']) && $dataDetailLaporan['ID_Aset'] == $aset['ID_Aset']) {
                                echo 'selected';
                            } ?>>
                            <?= $aset['Nama_Aset'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">-</option>
                <?php endif; ?>
                  </select>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Aset No</th>
                <td class="w-96 bg-[#D9D9D9] rounded-l-md p-0 md:p-2">
                  <input
                    name="aset_no"
                    type="text"
                    class="w-full ps-4 bg-[#D9D9D9] rounded-l-md"
                    value="<?= $dataDetailLaporan['Nomor_Unit'] ?? '-' ?>"
                  />
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Deskripsi</th>
                <td>
                  <textarea
                    name="deskripsi_masalah"
                    id=""
                    cols="20"
                    rows="4"
                    class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-0 md:p-2"
                  ><?= $dataDetailLaporan['Deskripsi_Masalah'] ?? '-' ?></textarea>
                </td>
              </tr>

              <tr class="text-md">
                <th class="font-semibold text-center w-full" colspan="2">
                <input type="hidden" name="id_Masalah" value="<?= $dataDetailLaporan['ID_Masalah'] ?? '' ?>">
                  <div class="mt-4">
                    <button
                      type="reset"
                      class="bg-[#9F5858] hover:bg-[#8A5151] md:px-2 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Batal
                    </button>

                    <button
                      type="submit"
                      class="bg-[#AFD0BC] hover:bg-[#98BCA7] md:px-4 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Kirim
                    </button>
                  </div>
                </th>
              </tr>
            </table>
          </form>
        </div>
        <div
          class="hidden lg:flex bg-[#B2B2B2] p-2 mt-4 lg:w-[497px] lg:h-[140px] rounded-md shadow-xl items-center justify-center"
        >
          <img src="app/includes/img/LogoFikom_Putih.png" alt="" class="w-56" />
        </div>
      </div>
    </div>
    <div
      class="lg:hidden mx-auto p-2 w-full bg-[#B2B2B2] flex items-center justify-center fixed inset-x-0 bottom-0 shadow-2xl"
    >
      <img src="app/includes/img/LogoFikom_Putih.png" alt="" class="w-56 shadow-inner" />
    </div>

    <script>
      //   pop up
      window.onload = function () {
        var countdownElement = document.getElementById("countdown");
        var countdown = 3;
        var popup = document.getElementById("popup");

        popup.classList.remove("hidden");

        var interval = setInterval(function () {
          countdown--;
          countdownElement.innerHTML = countdown;

          if (countdown <= 0) {
            clearInterval(interval);
            popup.classList.add("hidden");
          }
        }, 1000);
      };

          // ajax detail
        function loadData(id_masalah) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    fillTable(data);
                }
            };
            xhr.open("GET", "index.php?action=DetailSelesai&id_masalah=" + id_masalah, true);
            xhr.send();
        }
        function fillTable(data) {
            var table = document.getElementById("detailTable");
            table.innerHTML = `
                <tr><td colspan="2" class="font-bold text-center">Permasalahan</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Nama Lab:</td><td> ${data.Nama_Lab || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Nama Aset:</td><td> ${data.Nama_Aset || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Nomor Unit:</td><td> ${data.Nomor_Unit || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Nama Teknisi:</td><td> ${data.Nama_Teknisi || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Deskripsi Masalah:</td><td> ${data.Deskripsi_Masalah || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Waktu diselesaikan:</td><td> ${data.Tanggal_Pelaporan || ''}</td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Foto:</td><td> <img src="${data.Foto_Path || ''}" alt="Foto Masalah" class="w-32 h-32 rounded-md shadow-xl" id="fotoView" onclick="showFullSizeImage('${data.Foto_Path || ''}')"  /></td></tr>
                <tr><td class="font-semibold md:pr-24 py-2">Komentar:</td><td> ${data.Komentar || ''}</td></tr>
            `;
        }
        function showFullSizeImage(imageSrc) {
        if (imageSrc) {
            // Open a new window
            var imageWindow = window.open('', '_blank');

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

    </script>
  </body>
</html>
