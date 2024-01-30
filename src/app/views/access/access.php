<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Access</title>
    <style>
      .border-spacing-2 {
        border-collapse: separate;
        border-spacing: 0.2rem; /* Atur nilai sesuai kebutuhan */
      }
      .border-spacing-1 {
        border-collapse: separate;
        border-spacing: 0.1rem; /* Atur nilai sesuai kebutuhan */
      }
    </style>
  </head>
  <body>
    <!-- navbar -->
  <?php
        include('/var/www/html/app/includes/navbar.php');
    ?>
    <!-- isi -->
    <div class="flex lg:mx-16 lg:my-7 justify-center md:flex-row flex-col">
      <div
        class="bg-[#B2B2B2] mt-24 md:mx-4 lg:w-[1180px] lg:h-[738px] rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class=" text-lg  md:text-2xl font-semibold">Data Asisten</p>
        </div>
        <div
          class="bg-[#D9D9D9] rounded-t-md mt-4 min-h-[300px] flex-grow pt-2"
        >
          <form action="">
            <table
              class="min-w-full table-auto w-full text-left whitespace-no-wrap border-spacing-1 md:border-spacing-2"
            >
              <tr
                class="text-sm md:text-lg font-semibold tracking-wide uppercase border-b bg-[#C2B8B8]"
              >
                <th
                  class="md:px-4 md:py-2 px-1 rounded-xl text-center align-middle font-semibold shadow-xl w-10"
                >
                  No
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl "
                >
                  Asisten
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl w-40"
                >
                  Peran
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl w-40 "
                >
                  Edit
                </th>
                <th rowspan="100" class="bg-black">
                  <div class="border-l h-full"></div>
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl w-48"
                >
                  Aksi
                </th>
              </tr>
<?php foreach ($dataAsisten as $index => $asisten): ?>
              <tr class="text-xs md:text-lg">
                <td
                  class="rounded-xl shadow-xl text-center align-middle bg-[#E6E6E6]"
                >
                    <?php echo $index + 1;  ?>
                </td>
                <td
                  class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6]"
                >
                    <?php echo $asisten['Nama_Depan'] . " " . $asisten['Nama_Belakang'];  ?>
                </td>
                <td
                  class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center"
                >
                    <div><?php echo $asisten['Nama_Peran']; // Displaying the role ?></div>
                </td>
                <td
                  class="rounded-xl shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center align-middle"
                >
                <select
                name="teknisi"
                id="teknisi"
                class="w-full text-center bg-[#E6E6E6] text-xs"
              >
                <option value="" disabled selected>Pilih peran Baru</option>
                <option value="akbar">Laboran</option>
                <option value="akbar">Korlab</option>
                <option value="akbar">Asisten</option>
              </select>
                </td>
                <td
                  class="rounded-xl shadow-xlbg-[#E6E6E6] flex justify-center"
                >
                  <button
                    type="submit"
                    class="bg-[#AFD0BC] hover:bg-[#98BCA7] rounded-sm hover:border hover:border-black ms-1 w-full p-2 shadow-xl"
                  >
                    Simpan
                  </button>
                </td>
              </tr>
<?php endforeach; ?>
            </table>
          </form>
        </div>
      </div>
      </div>
      <div class="flex justify-center mb-10">
        <div
        class="bg-[#B2B2B2] mt-2 mx-2 md:mx-4 lg:w-[1180px] lg:h-[700px] h-[550px] rounded-md shadow-xl flex flex-col"
        >
          <div class="flex justify-center mt-7 mb-2">
            <p class="text-lg md:text-2xl font-semibold">Tambah User</p>
          </div>
          <div
          class=" bg-[url('app/includes/img/akses.png')]  rounded-t-md mt-4 min-h-[300px] flex-grow pt-2 flex justify-center items-center"
        >
          <form action="" class=" p-52 md:p-28 rounded-lg" style="background-color: rgba(217, 217, 217, 0.60);" >
            <div class="my-8 ">
                <input class="p-3 md:p-4 rounded-2xl shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="text" placeholder="Masukkan Nama depan">
            </div>
            <div class="my-8 ">
                <input class="p-3 md:p-4 rounded-2xl shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="email" placeholder="Masukkan Email">
            </div>
            <div class="my-8 ">
                <input class="p-3 md:p-4 rounded-2xl shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="text" placeholder="Masukkan Nim">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="p-3 px-6 bg-[#AFD0BC] rounded-xl hover:shadow-xl focus:bg-green-700 font-semibold">Simpan</button>
            </div>
          </form>
        </div>
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
