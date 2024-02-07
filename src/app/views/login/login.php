<!-- include header -->
<?php
        include('/var/www/html/app/includes/header.php');
?>
<div class="flex justify-center lg:justify-between items-center h-screen px-2 lg:px-20" id="container">
        <div class="hidden lg:flex flex-col justify-center items-center ps-44" id="container-child1">
            <div class="text-center mb-10 font-bold text-2xl z-10 tracking-wider" style="margin-top: -60px">
                <p class="p-3">"Improve productivity</p>
                <p>with a system."</p>
            </div>
            <div>
                <img src="app/includes/img/login-illustrations.png" alt="" class="h-[332px]" />
            </div>
        </div>
        <div id="container-child2">
            <div
                class="w-full lg:w-[544px] h-[514px] lg:h-[414px] bg-[#F9F9FB] border-4 border-white rounded-xl pt-10 p-5 lg:pt-10 lg:p-8">
                <div class="flex justify-between items-center font-semibold text-2xl lg:text-xl tracking-wide">
                    <p>Selamat Datang!</p>
                    <img src="app/includes/img/laporan-lab-biru.png" alt="logo-web" class="w-20 h-20 lg:w-16 lg:h-16" />
                </div>
                <div class="font-semibold text-lg">
                    <form action="?action=processLogin" method="post">
                        <p>Silahkan Login terlebih dahulu..</p>
                        <div class="font-normal mt-6">
                            <input type="text" name="emailNim" placeholder="Masukkan Nim atau Email anda"
                                class="w-full rounded-lg p-3 mt-2 mb-8 border border-black opacity-50 placeholder-opacity-100" />
                            <input type="password" name="password" placeholder="Masukkan Password anda"
                                class="w-full rounded-lg p-3 mt-1 mb-8 border border-black opacity-50 placeholder-opacity-100" />
                        </div>
                        <div class="flex justify-center">
                            <button class="p-3 px-5 bg-[#0C2C67] rounded-md text-white hover:bg-[#071939]">
                                MASUK
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
