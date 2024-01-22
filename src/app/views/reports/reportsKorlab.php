<?php session_start();
 if(!isset($_SESSION['user_id'])){
    header('Location: index.php');
    exit;
}
?>
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
  <?php
        include('/var/www/html/app/includes/navbar.php');
    ?>

    <!-- isi -->
    <div class="flex lg:mx-16 lg:my-7 justify-center md:flex-row flex-col">
      <div
        class="bg-[#B2B2B2] mt-24 mx-2 md:mx-4 lg:w-[1080px] lg:h-[738px] rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class="text-xl md:text-2xl font-semibold">Laporan</p>
        </div>
        <div
          class="bg-[#D9D9D9] rounded-t-md mt-4 min-h-[300px] flex-grow pt-2"
        >
          <form action="?action=berikanTugas" method="post" class="flex justify-center"  >
            <table
              class="table-auto whitespace-no-wrap border-spacing-1 md:border-spacing-2"
            >
              <tr
                class="md:text-lg text-xs font-semibold tracking-wide uppercase border-b bg-[#C2B8B8]"
              >
                <th
                  class="md:px-1 md:py-0 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  No
                </th>
                <th
                  class="md:px-2 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl md:w-96"
                >
                  Laporan
                </th>
                <th
                  class="md:px-2 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl w-20"
                >
                  Batas Waktu
                </th>
                <th
                  class="md:px-2 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Teknisi
                </th>
                <th rowspan="100" class="bg-black">
                  <div class="border-l h-full"></div>
                </th>
                <th
                  class="md:px-2 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl"
                >
                  Aksi
                </th>
              </tr>
                <?php
                    $counter = 1;
                    foreach ($dataLaporan as $data):
                ?>
              <tr class="text-xs md:text-lg">
                <td
                  class="rounded-xl shadow-xl text-center align-middle bg-[#E6E6E6] w-10"
                >
                    <?= $counter; ?>
                </td>
                <td class="rounded-xl shadow-xl ps-2 md:px-4 md:py-2 bg-[#E6E6E6] text-sm text-justify">
                    <div class="flex flex-col">
                        <span class="font-bold text-lg">Permasalahan:</span>
                        <p class="font-semibold text-md">Lab: <?= $data['Nama_Lab'] ?></p>
                        <p class="font-semibold text-md">Aset: <?= $data['Nama_Aset'] ?></p>
                        <p class="font-semibold text-md">Nomor Unit:<?= $data['Nomor_Unit'] ?></p>
                        <span class="font-bold text-lg">Deskripsi:</span>
                        <p class="text-md"><?= $data['Deskripsi_Masalah'] ?></p>
                    </div>
                </td>
                <td
                  class="rounded-xl shadow-xl md:px-2 md:py-2 py-1 bg-[#E6E6E6]"
                >
                  <input
                    type="date"
                    name="batas_waktu"
                    id="batas_waktu"
                    class="text-center bg-[#E6E6E6] w-32 text-sm"
                  />
                </td>
                <td
                  class="rounded-xl shadow-xl md:px-2 md:py-2 py-1 bg-[#E6E6E6] text-center align-middle"
                >
                <select name="id_teknisi" id="teknisi" class="text-center text-sm bg-[#E6E6E6]">
                    <option value="" disabled selected>Pilih Teknisi</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['ID_Pengguna'] ?>"><?= $user['Nama_Depan'] ?></option>
                    <?php endforeach; ?>
                </select>

                </td>
                <td
                  class="rounded-xl shadow-xl md:px-2 md:py-2 py-1 bg-[#E6E6E6] text-center align-middle text-sm"
                >
                <input type="hidden" name="id_masalah" value="<?= $data['ID_Masalah'] ?>" />
                <div class="flex items-center justify-center">
                    <button name="action" value="tolak_<?= $data['ID_Masalah'] ?>"  class="bg-[#9F5858] hover:bg-[#8A5151] rounded-md ms-1 p-2 w-full hover:shadow-xl">Tolak</button>
                    <button name="action" value="setuju_<?= $data['ID_Masalah'] ?>" type="submit" class="bg-[#AFD0BC] hover:bg-[#98BCA7] rounded-md ms-1 w-full p-2 hover:shadow-xl">Setuju</button>
                </div>
                </td>
              </tr>
              <?php
                    $counter++;
                    endforeach;
                ?>
            </table>
          </form>
        </div>
      </div>
      <div>
        <div
          class="bg-[#B2B2B2] mt-2 md:mt-24 lg:w-[497px] lg:min-h-[583px] mb-24 md:mb-0 rounded-md shadow-xl flex flex-col"
        >
          <div class="flex justify-center mt-7 mb-4">
            <p class="text-xl md:text-2xl font-semibold">Detail Laporan</p>
          </div>

          <form action="">
            <table
              class="ml-6 border-collapse border-separate"
              style="border-spacing: 0 10px"
            >
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">ID Laporan</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">-</td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Tanggal Dibuat</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">-</td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Nama Lab</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">-</td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Aset</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">-</td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Aset No</th>
                <td class="w-96 bg-[#C8BEBE] rounded-l-md ps-4 p-0">-</td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Deskripsi</th>
                <td>
                  <textarea
                    name=""
                    id=""
                    cols="20"
                    rows="4"
                    class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-0"
                  ></textarea>
                </td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Batas Waktu</th>
                <td>
                  <input
                    type="date"
                    name="date"
                    id="date"
                    class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-0"
                  />
                </td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-left w-44">Pilih Teknisi</th>
                <td
                  class="w-full bg-[#D9D9D9] rounded-l-md ps-4 p-2 flex flex-wrap items-center justify-center"
                >
                  <div class="flex items-center mr-2">
                    <input type="checkbox" name="akbar1" id="akbar1" />
                    <label for="akbar1" class="ml-2 text-xs">Akbar</label>
                  </div>
                  <div class="flex items-center mr-2">
                    <input type="checkbox" name="2" id="akbar2" />
                    <label for="akbar2" class="ml-2 text-xs">Akbar</label>
                  </div>
                  <div class="flex items-center mr-2">
                    <input type="checkbox" name="akbar3" id="akbar3" />
                    <label for="akbar3" class="ml-2 text-xs">Akbar</label>
                  </div>
                </td>
              </tr>
              <tr class="md:text-base text-sm">
                <th class="font-semibold text-center w-full" colspan="2">
                  <div class="mt-4">
                    <button
                      type="submit"
                      class="bg-[#9F5858] hover:bg-[#8A5151] md:px-2 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Tolak
                    </button>
                    <button
                      type="reset"
                      class="bg-[#D9D9D9] hover:bg-[#CACACA] md:px-2 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Reset
                    </button>
                    <button
                      type="submit"
                      class="bg-[#AFD0BC] hover:bg-[#98BCA7] md:px-2 md:py-1 px-4 py-2 rounded-sm hover:border hover:border-black m-2"
                    >
                      Setuju
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

  </body>
</html>
