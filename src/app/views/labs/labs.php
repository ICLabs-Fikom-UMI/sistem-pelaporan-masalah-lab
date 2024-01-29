<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>labs</title>

  </head>
  <body>
    <!-- navbar -->
 <?php
    include('/var/www/html/app/includes/navbar.php');
?>
    <div class="mt-28 md:mt-36">
      <div class="flex flex-col mx-5 md:mx-28">
        <div>
          <h1>Jumlah Lab: 7</h1>
        </div>
        <div class="mt-5">
          <div class="flex flex-wrap grow justify-center">
            <div
              class="bg-[#B6B6B6] flex md:flex-row flex-col md:mr-7 md:mb-6 mb-4 shadow-xl md:rounded-r-xl rounded-b-xl"
            >
              <div>
                <img
                  src="https://fikom.umi.ac.id/wp-content/uploads/2019/05/labmultimedia-800x430.jpg"
                  alt=""
                  class="w-full md:w-64 h-full"
                />
              </div>
              <div
                class="bg-[#D9D9D9] md:w-[492px] w-full shadow-2xl md:rounded-r-xl rounded-b-xl"
              >
                <h1 class="font-semibold ps-2 mt-2 md:mt-0">start Lab</h1>
                <div class="flex text-xs text-[#9B9292]">
                  <p class="ps-2">Jumlah Kursi</p>
                  <p class="ps-2">Jumlah Tv</p>
                </div>
                <div class="text-xs mt-3 ps-2 pr-1 text-justify">
                  <div class="text-content">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry’s
                    standard dummy text ever since the 1500s, when an unknown
                    printer took a galley of type and scrambled it to make a
                    type specimen book.
                  </div>
                </div>
              </div>
            </div>
            <!-- Tambahkan konten lab lainnya di sini -->
          </div>
        </div>
      </div>
    </div>

    <script>
      var isMenuOpen = false;
      function toggleMenu() {
        var menuIcon = document.getElementById("menuIcon");
        var closeIcon = document.getElementById("closeIcon");
        var mobileMenu = document.getElementById("mobileMenu");
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
          menuIcon.classList.add("hidden");
          closeIcon.classList.remove("hidden");
          mobileMenu.classList.remove("hidden");
        } else {
          menuIcon.classList.remove("hidden");
          closeIcon.classList.add("hidden");
          mobileMenu.classList.add("hidden");
        }
      }
    </script>
  </body>
</html>
