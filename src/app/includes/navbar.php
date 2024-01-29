
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,400;0,500;0,600;0,700;1,100;1,200;1,400;1,600&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background-image: url(app/includes/img/<?php echo isset($_SESSION['user_id']) ? 'home.png' : 'bg-login1.png'; ?>);
        background-size: cover;
         background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
      }
    </style>
  </head>
  <body>
  <nav
      class="md:px-8 p-4 mx-auto text-blue-200 fixed top-0 right-0 left-0 rounded-b-md shadow-2xl"
      style="background-color: #0b1740"
    >
      <div
        class="text-lg container mx-auto flex justify-between items-center font-medium"
      >
        <div class="flex space-x-14 items-center">
          <a
            href="/"
            class="text-2xl font-semibold flex items-center space-x-3 text-primary"
          >
            <img
            src="app/includes/img/laporan-lab-text-1.png"
              alt="logo image"
              class="w-16 inline-block items-center"
            />
            <img src="app/includes/img/iclabs-icon.png" alt="" class="w-12" />
          </a>
        </div>
        <div
          class="space-x-12 hidden md:flex items-center text-white font-semibold"
        >
          <a href="?action=home" class="hidden lg:flex items-center hover:text-secondary">
            Home
          </a>
          <a href="<?= isset($_SESSION['user_id']) ? '?action=labs' : '?action=showLoginForm'; ?>"  class="hidden lg:flex items-center hover:text-secondary">
            Labs
          </a>
          <a href="<?= isset($_SESSION['user_id']) ? '?action=reports' : '?action=showLoginForm'; ?>"  class="hidden lg:flex items-center hover:text-secondary">
            Reports
          </a>
          <a href="<?= isset($_SESSION['user_id']) ? '?action=tasks' : '?action=showLoginForm'; ?>"  class="hidden lg:flex items-center hover:text-secondary">
            Tasks
          </a>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Laboran'): ?>
          <a href="/" class="hidden lg:flex items-center hover:text-secondary">
            access
          </a>
          <?php endif; ?>
          <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Tombol Logout -->
                <button
                onclick="window.location.href='?action=logout';"
                class="py-3 px-4 transition-all duration-300 rounded hover:text-red-400 hover:bg-indigo-600 text-black"
                style="background-color: #d9d9d9"
                >
                Logout
                </button>
            <?php else: ?>
                <!-- Tombol Login -->
                <button
                onclick="window.location.href='?action=showLoginForm';"
                class="py-3 px-4 transition-all duration-300 rounded hover:text-white hover:bg-indigo-600 text-black"
                style="background-color: #d9d9d9"
                >
                Login
                </button>
        <?php endif; ?>

        </div>
        <div class="md:hidden">
          <button
            onclick="toggleMenu()"
            class="text-white focus:outline-none focus:text-gray-300"
          >
            <svg
              id="menuIcon"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              class="w-6 h-6 text-primary"
            >
              <!-- Ikon menu -->
              <path
                fill="currentColor"
                d="M3 16h18v2H3zm0-5h18v2H3zm0-5h18v2H3z"
              />
            </svg>
            <!-- Ikon silang baru -->
            <svg
              id="closeIcon"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              class="w-6 h-6 text-primary hidden"
            >
              <path
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243"
              />
            </svg>
          </button>
        </div>
      </div>
    </nav>
    <div
      id="mobileMenu"
      class="space-y-4 pt-24 bg-secondary text-xl text-center hidden"
      style="background-color: rgba(11, 23, 64, 0.27)"
    >
      <a href="/" class="block hover:text-white">Home</a>
      <a href="/labs" class="block hover:text-white">Labs</a>
      <a href="/reports" class="block hover:text-white">Reports</a>
      <a href="/tasks" class="block hover:text-white">Tasks</a>
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
