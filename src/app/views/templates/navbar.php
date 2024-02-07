<nav
        class="h-[66px] w-full bg-[#F9F9FB] border shadow-inner rounded-b-lg flex items-center justify-between ps-24 pe-10">
        <!-- Container 1 (Sisi Kiri) -->
        <div class="flex" id="container1">
            <div class="flex">
                <img src="app/views/templates/img/laporan-lab-biru.png" alt="" class="w-12 h-12" />
                <img src="app/views/templates/img/iconiclabsbaru.png" alt="" class="w-12 h-12" />
            </div>
        </div>
        <!-- Spasi Antara Container 1 dan Container 2 -->
        <div class="flex-1"></div>
        <!-- Container 2 (Sisi Kanan) -->
        <div id="container2 relative">
            <div class="bg-gray-300 rounded-full h-12 w-12 flex items-center justify-center mr-4"
                onclick="toggleDropdown()"">
                <!-- Gambar Profil -->
                <img src=" https://th.bing.com/th/id/OIP.iwQwh6xaDNpS2519HlwV8gHaKg?rs=1&pid=ImgDetMain"
                alt="Profile Image" class="rounded-full h-10 w-10" />

            <div id="profileDropdown"
                class="hidden border border-gray-400 absolute right-0 mt-36 py-2 mr-4 w-40 bg-[#F9F9FB] rounded-md ">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#375679] hover:text-white"
                    id="profileBtn">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#375679] hover:text-white">Logout</a>
            </div>
        </div>
        </div>
    </nav>