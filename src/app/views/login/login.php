
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
    </style>
  </head>
  <body>
  <?php
        include('/var/www/html/app/includes/navbar.php');
    ?>
    <!-- isi -->
    <div
      class="flex justify-center items-center h-screen flex-col w-full lg:mt-10"
    >
      <h1 class="text-center font-bold text-2xl mb-5">
        <span class="text-[#EFEEEE]">Sistem Pelaporan LAB</span>
      </h1>
      <div
        class="bg-gray-200 w-5/6 h-2/4 md:w-3/4 md:h-2/4 lg:w-[544px] lg:h-[620px] rounded-t-3xl p-14 shadow-2xl flex flex-wrap"
        style="background-color: rgba(235, 232, 232, 0.68)"
      >
        <div class="flex justify-center items-center w-full">
          <div class="flex justify-between items-center w-full">
            <div class="mr-4 invisible">Placeholder</div>
            <h1 class="font-bold lg:text-3xl text-xl text-[#0B1741]">LOGIN</h1>
            <div class="mr-4 invisible">Placeholder</div>
            <!-- Placeholder untuk menyelaraskan -->
          </div>
        </div>
        <div class="text-xs text-gray-800">
        <form action="?action=processLogin" method="post">
            <input
              type="text"
              name="emailNim"
              id=""
              placeholder="Masukkan Email atau Nim"
              class="md:p-6 p-4 my-6 rounded-lg w-full shadow-xl"
              required
            />
            <input
              type="password"
              name="password"
              id=""
              placeholder="Masukkan Password"
              class="md:p-6 p-4 lg:mb-12 mb-8 rounded-lg w-full shadow-xl"
              required
            />
            <div class="flex justify-center">
              <button
                type="submit"
                class="bg-white lg:p-4 p-3 rounded-full lg:px-14 px-8 lg:text-lg text-sm shadow-xl font-bold transition duration-300 ease-in-out hover:bg-[#AFD0BC] text-[#0B1741]"
                id="button-login"
              >
                Login
              </button>
            </div>
            <div class="flex justify-center lg:mt-20 md:mt-12 mt-12">
              <p class="text-sm md:text-lg">
                Lupa Password Anda?
                <a href="/" class="text-blue-600 underline hover:text-blue-800"
                  >klik disini</a
                >
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>


  </body>
</html>
