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
      #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        z-index: 99;
    }
      .popup-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        z-index: 100;
        border: 1px solid #000;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
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
      <div class="flex flex-col items-center justify-center mb-2">
            <?php if (isset($_SESSION['success_message']) || isset($_SESSION['failed_message'])): ?>
                <p id="messageBox" class="w-full flex justify-center bg-[#81A55E] p-5">
                    <?= $_SESSION['success_message'] ?? $_SESSION['failed_message'] ?>
                </p>
            <?php
                unset($_SESSION['success_message']);
                unset($_SESSION['failed_message']);
            endif; ?>
            <p class=" text-lg  md:text-2xl font-semibold">Data Asisten</p>
        </div>
        <div
          class="bg-[#D9D9D9] rounded-t-md mt-4 min-h-[300px] flex-grow pt-2"
        >
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
                <th rowspan="100" class="bg-black w-1">
                  <div class="border-l h-full"></div>
                </th>
                <th
                  class="md:px-4 md:py-2 py-1 rounded-xl text-center align-middle font-semibold shadow-xl md:w-48"
                >
                  Aksi
                </th>
              </tr>
              <?php foreach ($dataAsisten as $index => $asisten): ?>
                    <form action="?action=peranBaru" method="post">
                        <tr class="text-xs md:text-lg">
                            <td class="rounded-xl shadow-md hover:shadow-xl text-center align-middle bg-[#E6E6E6]">
                                <?php echo $index + 1; ?>
                            </td>
                            <td class="rounded-xl shadow-md hover:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6]">
                                <?php echo $asisten['Nama_Depan'] . " " . $asisten['Nama_Belakang']; ?>
                            </td>
                            <td class="rounded-xl shadow-md hover:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center">
                                <div><?php echo $asisten['Nama_Peran']; ?></div>
                            </td>
                            <td class="rounded-xl shadow-md hover:shadow-xl md:px-4 md:py-2 py-1 ps-2 bg-[#E6E6E6] text-center align-middle">
                                <select name="id_peran" class="w-full text-center bg-[#E6E6E6] text-xs">
                                    <option value="" disabled selected>Pilih peran Baru</option>
                                    <option value="2">Laboran</option>
                                    <option value="3">Korlab</option>
                                    <option value="1">Asisten</option>
                                </select>
                                <input type="hidden" name="id_pengguna" value="<?= $asisten['ID_Pengguna']; ?>">
                            </td>
                            <td class="rounded-xl shadow-md hover:shadow-xl bg-[#E6E6E6] flex justify-center">
                                <button type="submit" class="bg-[#AFD0BC] hover:bg-[#98BCA7] rounded-sm hover:border hover:border-black ms-1 p-2 shadow-xl">
                                    Simpan
                                </button>
                                <div class="border-l-2 border-black mx-2 h-11"></div>
                                <p class="cursor-pointer p-2 bg-[#A69B9B] hover:border hover:border-black" onclick="showPopup(); loadData(<?= $asisten['ID_Pengguna']; ?>);  event.preventDefault();">Detail</p>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </table>
        </div>
      </div>
      </div>
      <!-- pop up detail -->
      <div id="overlay" style="display: none;"></div>
      <div id="popupDiv" class="popup-container w-11/12  md:w-[40%] h-[70%]" style="display: none;">
        <!-- x mark -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 384 512" onclick="closePopup()"><path fill="currentColor" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7L86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256L41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256z"/></svg>
        <!-- Popup Content Here -->
        <div class="flex justify-center mt-16">
            <table id="detailTable">
            <!-- Tabel akan diisi dengan data di sini -->
            </table>
        </div>
    </div>

      <!-- Tambah user section -->
      <div class="flex justify-center mb-10">
        <div
        class="bg-[#B2B2B2] mt-2 mx-2 md:mx-4 lg:w-[1180px] lg:h-[700px] h-[550px] rounded-md shadow-xl flex flex-col"
        >
          <div class="flex justify-center mt-7 mb-2">
            <p class="text-lg md:text-2xl font-semibold hover:shadow-sm">Tambah User</p>
          </div>
          <div
          class=" bg-[url('app/includes/img/akses.png')]  rounded-t-md mt-4 min-h-[300px] flex-grow pt-2 flex justify-center items-center"
        >
          <form action="?action=tambahUser" method="post"  class=" p-20 md:p-28 rounded-lg" style="background-color: rgba(217, 217, 217, 0.60);" >
            <div class="my-8 ">
                <input name="nama_depan" class="p-3 md:p-4 rounded-2xl shadow-md hover:shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="text" placeholder="Masukkan Nama depan" required>
            </div>
            <div class="my-8 ">
                <input name="email" class="p-3 md:p-4 rounded-2xl shadow-md hover:shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="email" placeholder="Masukkan Email" required>
            </div>
            <div class="my-8 ">
                <input name="nim" class="p-3 md:p-4 rounded-2xl shadow-md hover:shadow-xl text-center text-gray-500 md:font-semibold text-sm" type="text" placeholder="Masukkan Nim" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="p-3 px-6 bg-[#AFD0BC] rounded-xl hover:shadow-xl focus:bg-green-700 font-semibold">Simpan</button>
            </div>
          </form>
        </div>
        </div><div id="overlay" style="display: none;"></div>
      </div>

    </div>
    <div
      class="lg:hidden mx-auto p-2 w-full bg-[#B2B2B2] flex items-center justify-center fixed inset-x-0 bottom-0 shadow-2xl"
    >
      <img src="app/includes/img/LogoFikom_Putih.png" alt="" class="w-56 shadow-inner" />
    </div>


    <!-- js -->
    <script>
        setTimeout(function() {
            var messageBox = document.getElementById('messageBox');
            if (messageBox) {
                messageBox.style.display = 'none';
            }
        }, 5000);

    //   pop up
    function showPopup() {
        var popupDiv = document.getElementById("popupDiv");
        var overlay = document.getElementById("overlay");

        if (popupDiv.style.display === "none") {
            popupDiv.style.display = "block";
            overlay.style.display = "block";
        } else {
            popupDiv.style.display = "none";
            overlay.style.display = "none";
        }
    }
    function closePopup() {
        var popupDiv = document.getElementById("popupDiv");
        var overlay = document.getElementById("overlay");
        popupDiv.style.display = "none";
        overlay.style.display = "none";
    }

    // ajax for detail user
    function loadData(id_pengguna) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var data = JSON.parse(xhr.responseText);
                fillTable(data);
            }
        };
        xhr.open("GET", "index.php?action=detailPengguna&id_pengguna=" + id_pengguna,  true);
        xhr.send();
    }
    function fillTable(data) {
        var table = document.getElementById("detailTable");
        table.innerHTML = `
        <tr><td class="font-semibold md:pr-40 py-4">Id Pengguna</td><td>: ${data.ID_Pengguna || ''}</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Nama Lengkap</td><td>: ${(data.Nama_Depan || '') + ' ' + (data.Nama_Belakang || '')}</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Nim</td><td>: ${data.Nim || ''}</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Email</td><td>: ${data.Email || ''}</td></tr>
        <tr><td class="font-semibold md:pr-40 py-4">Peran</td><td>: ${data.Nama_Peran || ''}</td></tr>
        <tr>
        <td colspan="2" class="text-center pt-16">
            <a href="#" class="bg-red-700 p-3 rounded-lg hover:shadow-xl" onclick="return confirmAction('delete', ${data.ID_Pengguna});">Hapus</a>
            <a href="#" class="bg-neutral-400 p-3 rounded-lg hover:shadow-xl" onclick="return confirmAction('reset', ${data.ID_Pengguna});">Reset Password</a>
        </td>
        </tr>
        `;
    }
    // confirmm for detail user
    function confirmAction(actionType, id_pengguna) {
    let message = '';
    let actionURL = '';

    if (actionType === 'delete') {
        message = 'Apakah Anda yakin ingin menghapus data ini?';
        actionURL = 'index.php?action=deletePengguna&id_pengguna=' + id_pengguna;
    } else if (actionType === 'reset') {
        message = 'Apakah Anda yakin ingin mereset password pengguna ini?';
        actionURL = 'index.php?action=resetPassword&id_pengguna=' + id_pengguna;
    }

    if (confirm(message)) {
        window.location = actionURL;
        return true;
    } else {
        return false;
    }
}

// // pesan
    window.onload = function() {
        const params = new URLSearchParams(window.location.search);
        const message = params.get('message');

        if (message === 'resetSuccess') {
            alert('Pengaturan ulang password berhasil!');
        } else if (message === 'resetFail') {
            alert('Gagal mengatur ulang password.');
        } else if (message === 'deleteSuccess') {
            alert('Data berhasil di hapus.');
        } else if (message === 'deleteFail') {
            alert('Gagal Menghapus data.');
        } else if(message === 'nimInvalidLength'){
            alert('Nim harus 11 Karakter!.');
        }else if(message === 'addUserSuccess'){
            alert('Berhasil Menambahkan Pengguna.');
        }else if(message === 'addUserFail'){
            alert('!!Gagal Menambahkan Pengguna.!!');
        }
    }

    </script>

  </body>
</html>
