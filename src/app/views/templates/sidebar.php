<div class="w-[80px] md:w-[300px] h-[calc(100vh-66px)] bg-[#F9F9FB] border-white shadow-xl text-xl   border-e-2 font-semibold tracking-wide flex  flex-col"
            id="sidebar">
            <div id="beranda" class="flex items-center  py-2 md:pl-14 mt-16">
                <div id="berandaBtn"
                    class="flex  justify-center md:justify-start bg-[#375679] text-white  hover:bg-[#375679] hover:text-white rounded-s-md py-0 px-0  md:py-2 md:px-4 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" class="me-3">
                        <path fill="currentColor"
                            d="M20 10a1 1 0 1 0-2 0zM6 10a1 1 0 0 0-2 0zm14.293 2.707a1 1 0 0 0 1.414-1.414zM12 3l.707-.707a1 1 0 0 0-1.414 0zm-9.707 8.293a1 1 0 1 0 1.414 1.414zM7 22h10v-2H7zm13-3v-9h-2v9zM6 19v-9H4v9zm15.707-7.707l-9-9l-1.414 1.414l9 9zm-10.414-9l-9 9l1.414 1.414l9-9zM17 22a3 3 0 0 0 3-3h-2a1 1 0 0 1-1 1zM7 20a1 1 0 0 1-1-1H4a3 3 0 0 0 3 3z" />
                    </svg>
                    <a href="#" class="hidden md:inline-block " id="">Beranda</a>
                </div>
            </div>
            <div id="laporanDropdown" class="cursor-pointer   flex flex-col justify-center"
                onclick="toggleDropdownMenu('laporanDropdownMenu')">
                <div class="flex items-center  py-2 md:pl-14   justify-start" id="laporanText">
                    <div
                        class="flex text-black justify-center  md:justify-start items-center  hover:bg-[#375679] hover:text-white rounded-s-md py-0 px-0 md:py-2 md:px-4 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-3 w-7 h-7">
                            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2" />
                        </svg>
                        <p class="hidden md:inline-block ">Laporan</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            class="ms-0 md:ms-2 flex justify-center items-center  hidden md:inline-block ">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor"
                                    d="M13.06 16.06a1.5 1.5 0 0 1-2.12 0l-5.658-5.656a1.5 1.5 0 1 1 2.122-2.121L12 12.879l4.596-4.596a1.5 1.5 0 0 1 2.122 2.12l-5.657 5.658Z" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div id="laporanDropdownMenu"
                    class="hidden flex text-lg flex-col ps-1 md:ps-20   transition-all duration-300 transform -translate-y-5 opacity-0 bg-gray-100">
                    <!-- Dropdown items -->
                    <a href="#"
                        class="buatLaporanBtn block py-2 border border-gray-100  hover:bg-[#375679] hover:text-white rounded-s-sm text-sm md:text-xl"
                        id="buatLaporanBtn" onclick="loadJenisBarang(); loadNamaLab(); ">Buat
                        Laporan</a>
                    <a href="#" class="block py-2   hover:bg-[#375679] hover:text-white rounded-s-sm text-sm md:text-xl"
                        id="laporanSayaBtn" onclick="loadLaporanSaya()">Laporan
                        Saya</a>
                    <!-- Tampilkan link ini hanya jika role adalah Korlab -->
   <!-- Tampilkan link ini hanya jika role adalah Korlab -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Korlab'): ?>
                    <a href="#" class="block py-2 hover:bg-[#375679] hover:text-white rounded-s-sm text-sm md:text-xl"
                    id="laporanBtn" onclick="loadLaporanMasuk()">Laporan Masuk</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!(isset($_SESSION['role']) && ($_SESSION['role'] == 'Korlab' || $_SESSION['role'] == 'Laboran'))): ?>
                <div id="tugas" class="flex items-center py-2 md:pl-14">
                    <div class="flex text-black items-center justify-center md:justify-start hover:bg-[#375679] hover:text-white rounded-s-md py-0 px-0 md:py-2 md:px-4 w-full"
                        id="tugasBtn" onclick="loadTugas()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" class="me-3">
                            <g fill="none" fill-rule="evenodd">
                                <path d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036c-.01-.003-.019 0-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor" d="M15 2a2 2 0 0 1 1.732 1H18a2 2 0 0 1 2 2v12a5 5 0 0 1-5 5H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1.268A2 2 0 0 1 9 2zM7 5H6v15h9a3 3 0 0 0 3-3V5h-1a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2m9.238 4.379a1 1 0 0 1 0 1.414l-4.95 4.95a1 1 0 0 1-1.414 0l-2.12-2.122a1 1 0 0 1 1.413-1.414l1.415 1.414l4.242-4.242a1 1 0 0 1 1.414 0M15 4H9v1h6z" />
                            </g>
                        </svg>
                        <a href="#" class="hidden md:inline-block">Tugas</a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Laboran'): ?>
                <div id="aksesDropdown" class="cursor-pointer flex flex-col">
                    <div class="flex py-2 md:pl-14">
                        <div class="flex text-black items-center justify-center md:justify-start hover:bg-[#375679] hover:text-white rounded-s-md py-0 px-0 md:py-2 md:px-4 w-full"
                            id="tugasBtn" onclick="loadTugas()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 20 20" class="me-3">
                                <!-- SVG content -->
                            </svg>
                            <p class="hidden md:inline-block">Akses</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="ms-2 hidden md:inline-block">
                                <!-- SVG content -->
                            </svg>
                        </div>
                    </div>
                    <div id="aksesDropdownMenu" class="hidden flex flex-col border border-gray-100 ps-1 md:ps-20 text-lg transition-all duration-300 transform -translate-y-5 opacity-0">
                        <a href="#" class="block py-2 hover:bg-[#375679] hover:text-white rounded-s-sm text-sm md:text-xl" id="beriAksesBtn" onclick="loadBeriAkses()">Beri Akses</a>
                        <a href="#" class="block py-2 hover:bg-[#375679] hover:text-white rounded-s-sm text-sm md:text-xl" id="tambahPenggunaBtn">Tambah Pengguna</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
