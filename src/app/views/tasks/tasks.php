<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tasks</title>
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
if (isset($_SESSION['Success_Message']) || isset($_SESSION['Erorr_Message'])):
    $message = isset($_SESSION['Success_Message']) ? $_SESSION['Success_Message'] : $_SESSION['Error_Message'];
?>
    <div id="popup" class="popup fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="content bg-[#78B992] p-8 rounded text-center text-xl">
            <p><?php echo $message; ?></p>
            <p id="countdown" class="text-lg font-bold">3</p>
        </div>
    </div>
<?php
    // Clear the messages after use
    unset($_SESSION['Success_Message']);
    unset($_SESSION['Erorr_Message']);
endif;
?>
    <!-- isi -->
    <div class="flex lg:mx-16 lg:my-7 justify-center md:flex-row flex-col">
      <div
        class="bg-[#B2B2B2] mt-28 lg:mt-24 mx-0 md:mx-4 lg:w-[1080px] lg:h-[738px] rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class="text-xl md:text-2xl font-semibold">Tugas Saya</p>
        </div>
        <div
          class="bg-[#D9D9D9] rounded-t-md mt-4 min-h-[300px] flex-grow pt-2"
        >
          <div class="overflow-x-auto">
            <table
              class="min-w-full table-auto w-full text-left whitespace-no-wrap border-spacing-1 md:border-spacing-2"
            >
              <!-- Table header -->
              <thead
                class="text-xs md:text-lg font-semibold tracking-wide uppercase border-b bg-[#C2B8B8]"
              >
                <tr>
                  <th
                    class="md:px-2 rounded-xl text-center align-middle font-semibold shadow-xl md:w-8"
                  >
                    No
                  </th>
                  <th
                    class="rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-0 lg:w-44 w-full"
                  >
                    Lab
                  </th>
                  <th
                    class="md:px-2 rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-0 lg:w-36 w-full"
                  >
                    Aset
                  </th>
                  <th
                    class="md:px-4 md:py-2 rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-0 lg:w-28 w-full"
                  >
                    No Aset
                  </th>
                  <th
                    class="md:px-4 md:py-2 rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-48 lg:w-56 w-full"
                  >
                    Deskripsi
                  </th>
                  <th
                    class="md:px-4 md:py-2 rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-0 lg:w-36 text-base w-full"
                  >
                    Batas Waktu
                  </th>
                  <th
                    class="md:px-4 md:py-2 rounded-xl text-center align-middle font-semibold shadow-xl lg:min-w-0 lg:w-32 w-full"
                  >
                    Aksi
                  </th>
                </tr>
              </thead>
              <!-- Table body -->
              <tbody class="text-xs md:text-lg">
              <?php foreach ($reports as $index => $report): ?>
                <tr>
                    <td class="rounded-xl shadow-xl text-center font-semibold align-middle bg-[#E6E6E6]"><p class=""><?= $index + 1 ?></p></td>
                    <td class="rounded-xl shadow-xl bg-[#E6E6E6] font-semibold uppercase text-center text-sm"><?= $report['Nama_Lab'] ?></td>
                    <td class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center font-semibold text-sm"><div><?= $report['Nama_Aset'] ?></div></td>
                    <td class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center align-middle font-semibold text-sm"><p><?= $report['Nomor_Unit'] ?></p></td>
                    <td class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-left text-sm align-middle"><div><?= $report['Deskripsi_Masalah'] ?></div></td>
                    <td class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center text-sm align-middle font-semibold"><div><?= date('m/d/Y', strtotime($report['Batas_Waktu'])) ?></div></td>
                    <td class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-left text-sm align-middle">
                        <button onclick="window.location.href='?action=tasksDetail&id_masalah=<?= $report['ID_Masalah'] ?>';"  type="submit" class="bg-[#AFD0BC] hover:bg-[#98BCA7] rounded-sm hover:border hover:border-black ms-1 w-full p-2 shadow-xl h-full">Detail</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
      <div>
        <div
          class="bg-[#B2B2B2] mt-2 md:mt-24 lg:w-[497px] lg:min-h-[583px] mb-24 md:mb-0 rounded-md shadow-xl flex flex-col"
        >
          <div class="flex justify-center mt-7 mb-4">
            <p class="text-xl md:text-2xl font-semibold">Detail Laporan</p>
          </div>
            <table
              class="ml-6 border-collapse border-separate"
              style="border-spacing: 0 10px"
            >
              <tr class="text-md">
                <th class="font-semibold text-left w-44">ID Laporan</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0 md:p-2">
                  <div class="ps-3"><?= $reportsById['ID_Masalah'] ?? '-' ?></div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Tanggal Dibuat</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">
                    <?= !empty($reportsById['Tanggal_Pelaporan']) && strtotime($reportsById['Tanggal_Pelaporan']) ? date('m/d/Y', strtotime($reportsById['Tanggal_Pelaporan'])) : '-' ?>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Nama Lab</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md p-0 md:p-2">
                  <div class="ps-3"><?= $reportsById['Nama_Lab'] ?? '-' ?></div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Aset</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md p-0 md:p-2">
                  <div class="ps-3"><?= $reportsById['Nama_Aset'] ?? '-' ?></div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Aset No</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md p-0 md:p-2">
                  <div class="ps-3"><?= $reportsById['Nomor_Unit'] ?? '-' ?></div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Deskripsi</th>
                <td
                  class="w-96 bg-[#C8BEBE] rounded-l-md p-0 md:p-2 text-xs text-justify"
                >
                  <div class="ps-3">
                    <?= $reportsById['Deskripsi_Masalah'] ?? '-' ?>
                  </div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Batas Waktu</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md p-0 md:p-2">
                  <div class="ps-3"><?= !empty($reportsById['Batas_Waktu']) ? date('m/d/Y', strtotime($reportsById['Batas_Waktu'])) : '-' ?></div>
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Teknisi</th>
                <td
                  class="w-full bg-[#C8BEBE] rounded-l-md ps-4 p-2 flex flex-wrap"
                >
                  <div class=""><?= $reportsById['Teknisi'] ?? '-' ?></div>
                </td>
              </tr>
              <form action="?action=tasksPenyelesaian" method="POST" enctype="multipart/form-data">
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Foto</th>
                <td
                  class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-2 flex flex-wrap"
                >
                  <input
                    type="file"
                    name="foto"
                    id=""
                    class="w-full h-full text-xs"
                  />
                </td>
              </tr>
              <tr class="text-md">
                <th class="font-semibold text-left w-44">Komentar</th>
                <td
                  class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-2 flex flex-wrap"
                >
                  <input
                    type="text"
                    name="komentar"
                    id="komentar"
                    class="w-full h-full bg-[#D9D9D9] text-xs"
                    placeholder="Opsional Boleh Kosong"
                  />
                </td>
              </tr>

              <tr class="text-md">
                <th class="font-semibold text-center w-full" colspan="2">
                  <div class="mt-4">
                  <input type="hidden" name="id_masalah" value="<?= $reportsById['ID_Masalah'] ?? '-' ?>" />
                    <button
                      type="reset"
                      class="bg-[#9F5858] hover:bg-[#8A5151] md:px-2 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Reset
                    </button>

                    <button
                      type="submit"
                      name="submit"
                      class="bg-[#AFD0BC] hover:bg-[#98BCA7] md:px-4 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Selesaikan
                    </button>
                  </div>
                </th>
              </tr>
              </form>
            </table>
        </div>

        <!-- footer -->
          <?php
            include('/var/www/html/app/includes/footer.php');
        ?>
  <script>
      //   pop up
      window.onload = function () {
        var countdownElement = document.getElementById("countdown");
        var countdown = 5; // 3 detik countdown
        var popup = document.getElementById("popup");

        popup.classList.remove("hidden"); // Menampilkan popup

        var interval = setInterval(function () {
          countdown--;
          countdownElement.innerHTML = countdown;

          if (countdown <= 0) {
            clearInterval(interval);
            popup.classList.add("hidden"); // Menghilangkan popup
          }
        }, 1000);
      };
    </script>

  </body>
</html>
