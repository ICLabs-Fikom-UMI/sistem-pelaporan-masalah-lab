<?php
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
    <title>Home</title>
    <style>

      .border-spacing-2 {
        border-collapse: separate;
        border-spacing: 0.2rem;
      }
      .border-spacing-1 {
        border-collapse: separate !important;
        border-spacing: 0.1rem;
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
        font-size: 0.75rem;
        line-height: 1rem;
      }
    </style>
  </head>
  <body>
    <?php
        include('/var/www/html/app/includes/navbar.php');
    ?>
<!-- Detail laporan status -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div id="popup" class="popup fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="content <?php echo isset($_SESSION['bad_message']) ? 'bg-red-500' : 'bg-[#78B992]'; ?> p-8 rounded text-center text-xl">
            <p><?php echo $_SESSION['success_message']; ?></p>
            <p><?php echo isset($_SESSION['bad_message']) ? 'Laporan anda akan di cek oleh koordinator Lab' : ''; ?></p>
            <p id="countdown" class="text-lg font-bold">3</p>
        </div>
    </div>
    <?php
    unset($_SESSION['success_message']);
    unset($_SESSION['bad_message']);
endif;
?>

    <!-- isi -->
    <div class="flex lg:mx-16 lg:my-7 flex-col justify-center md:flex-row">
      <div
        class="bg-[#B2B2B2] mt-20 me-4 lg:w-[1080px] lg:min-h-[738px] min-h-[300px] rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class="text-xl md:text-2xl font-semibold">Permasalahan Lab</p>
        </div>
        <div class="bg-[#D9D9D9] rounded-t-md mt-4 flex-grow pt-2">
          <table
            class="min-w-full table-auto w-full text-left whitespace-no-wrap border-spacing-1 md:border-spacing-2"
          >
            <tr
              class=" font-semibold tracking-wide uppercase border-b bg-[#C2B8B8]"
            >
              <th
              class="md:px-4 md:py-2  rounded-xl text-center align-middle font-semibold text-md md:text-lg shadow-xl md:w-16"
              >
                No
              </th>
              <th
              class="md:x-4 md:py-2 rounded-xl text-center align-middle font-semibold text-md md:text-lg shadow-xl md:w-96 "
              >
                Permasalahan
              </th>
              <th
              class="md:x-4 md:py-2 rounded-xl text-center align-middle font-semibold text-md md:text-lg shadow-xl md:w-52"
              >
                Batas Waktu
              </th>
              <th
              class="md:x-4 md:py-2 rounded-xl text-center align-middle font-semibold text-md md:text-lg shadow-xl md:min-w-28 md:max-w-52"
              >
                Teknisi
              </th>
              <th
              class="px-2 md:px-4 md:py-2 py-0 rounded-xl text-center align-middle font-semibold text-md md:text-lg shadow-xl md:w-40 "
              >
                Status
              </th>
            </tr>
            <?php
                $counter = 1; // Inisialisasi counter

                if (empty($permasalahanLab)) {
                    echo '<tr class="text-xs md:text-lg">';
                    echo '<td colspan="5" class="bg-[#E6E6E6] text-center">Tidak ada Laporan yang diterima</td>';
                    echo '</tr>';
                } else {
                    foreach ($permasalahanLab as $permasalahan):
                ?>
                    <tr class="text-xs md:text-lg">
                        <td class="rounded-xl shadow-md hover:shadow-xl text-center align-middle bg-[#E6E6E6]">
                            <?= $counter; ?>
                        </td>
                        <td class="rounded-xl shadow-md hover:shadow-xl ps-2 md:px-4 md:py-2 bg-[#E6E6E6] text-sm text-justify">
                            <div class="flex flex-col">
                                <span class="font-bold text-lg">Permasalahan:</span>
                                <p class="font-semibold text-md">Lab: <?= $permasalahan['Nama_Lab'] ?></p>
                                <p class="font-semibold text-md">Aset: <?= $permasalahan['Nama_Aset'] ?></p>
                                <p class="font-semibold text-md">Nomor Unit:<?= $permasalahan['Nomor_Unit'] ?></p>
                                <span class="font-bold text-lg">Deskripsi:</span>
                                <p class="text-md"><?= $permasalahan['Deskripsi_Masalah'] ?></p>
                            </div>
                        </td>
                        <td class="rounded-xl shadow-md hover:shadow-xl ps-2 md:px-4 md:py-2  bg-[#E6E6E6] text-center text-sm">
                            <?= $permasalahan['Batas_Waktu'] ?>
                        </td>
                        <td class="rounded-xl shadow-md hover:shadow-xl ps-2 md:px-4 md:py-2 bg-[#E6E6E6] text-center text-sm font-semibold">
                        <?php foreach ($permasalahan['teknisi'] as $teknisi): ?>
                            <?= htmlspecialchars($teknisi); ?>
                        <?php endforeach; ?>
                        </td>
                        <td class="rounded-xl shadow-md hover:shadow-xl ps-2 md:px-4 md:py-2  bg-[#E6E6E6] text-center text-sm">
                            <?php
                            if ($permasalahan['Status_Masalah'] == 'Disetujui') {
                                echo 'Sedang Dikerjakan';
                            } else {
                                echo $permasalahan['Status_Masalah'];
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    $counter++; // Tingkatkan nilai counter setelah setiap perulangan
                    endforeach;
                }
                ?>
          </table>
        </div>
      </div>
      <div>
      <div
        class="bg-[#B2B2B2] mt-2 lg:w-[497px] min-h-[593px] mb-12 md:mb-2 md:mt-20 rounded-md shadow-xl flex flex-col"
      >
        <div class="flex justify-center mt-7 mb-2">
          <p class="text-xl md:text-2xl font-semibold">Laporan Cepat</p>
        </div>
        <div
          class="flex-grow bg-[#D9D9D9] rounded-t-md mt-4 pt-2 flex flex-col items-center"
        >
          <div class="w-full max-w-xs">

            <form action="?action=laporan-cepat" method="post">
            <div class="flex flex-col items-center mb-2 md:mb-4">

              <label for="lab" class="mt-4 font-semibold text-lg">Nama Lab</label>
              <select
                name="id_lab"
                id="lab"
                class="w-full bg-[#B2B2B2] p-4 rounded-t-lg text-md text-center align-middle"
                required
              >
              <option value="" disabled selected>Pilih Lab</option>
                <?php foreach ($labs as $lab): ?>
                    <option value="<?= $lab['ID_Lab'] ?>"><?= $lab['Nama_Lab'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="flex flex-col items-center mb-2 md:mb-4">
              <label for="aset" class="font-semibold text-lg">Aset</label>
              <select
                name="id_aset"
                id="aset"
                class="w-full bg-[#B2B2B2] p-3 rounded-t-lg  text-center align-middle text-md"
                required
              >
              <option value="" disabled selected>Pilih Lab</option>
                <?php foreach ($asets as $aset): ?>
                    <option value="<?= $aset['ID_Aset'] ?>"><?= $aset['Nama_Aset'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="flex flex-col items-center mb-2 md:mb-4">
              <label for="no" class="font-semibold text-lg">NO</label>
              <input
                type="text"
                name="no_unit"
                id="no"
                class="w-full bg-[#B2B2B2] text-xs p-4 rounded-t-lg text-center align-middle"
                placeholder="gunakan koma jika lebih dari 1. dan 0 jika tidak ada"

              />
            </div>
            <div class="flex flex-col items-center mb-5 md:mb-4">
              <label for="deskripsi" class="font-semibold">Deskripsi</label>
              <textarea
                name="deskripsi"
                id="deskripsi"
                class="w-full p-3 rounded-t-lg bg-[#B2B2B2] text-center text-black align-middle"
                rows="3"
                placeholder="Detail permasalahan"
                required
              ></textarea>
            </div>
            <div class="flex flex-col items-center mb-4">
              <button class="p-2 bg-[#E6E6E6] px-8 rounded-lg border border-black hover:bg-[#AFD0BC]">Kirim</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="hidden lg:flex bg-[#B2B2B2] p-2  lg:w-[497px] lg:h-[140px] rounded-md shadow-xl items-center justify-center">
        <img src="app/includes/img/LogoFikom_Putih.png" alt="" class="w-56">
      </div>
    </div>
</div>
<div class="lg:hidden mx-auto p-2 w-full bg-[#B2B2B2] flex items-center justify-center fixed inset-x-0 bottom-0 shadow-2xl">
    <img src="app/includes/img/LogoFikom_Putih.png" alt="" class="w-56 shadow-inner">
</div>

<script>
     //   pop up
     window.onload = function () {
        var countdownElement = document.getElementById("countdown");
        var countdown = 3; // 3 detik countdown
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
