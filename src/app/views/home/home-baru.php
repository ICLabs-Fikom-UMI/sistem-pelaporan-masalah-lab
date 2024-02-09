<?php
        include('/var/www/html/app/views/templates/header.php');
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

    <!-- navbar -->
    <?php
        include('app/views/templates/navbar.php');
    ?>
    <div class="flex">
        <!-- sidebar -->
        <?php
            include('app//views/templates/sidebar.php');
        ?>
        <!-- main -->
        <div>
            <!-- beranda -->
            <?php
                include('app/views/templates/beranda.php');
            ?>
            <!-- profile -->
            <!-- lihat profile -->
            <?php
                include('app/views/templates/profile.php');
            ?>
            <!-- ubah data profile -->
            <?php
                include('app/views/templates/ubah-data-profile.php');
            ?>
            <!-- Laporan -->
            <!-- Laporan Masuk -->
            <?php
                include('app/views/templates/laporan-masuk.php');
            ?>
            <!-- Laporan saya -->
            <?php
                include('app/views/templates/laporan-saya.php');
            ?>
            <!-- Buat laporan -->
            <?php
                include('app/views/templates/buat-laporan.php');
            ?>
            <!-- Tugas -->
            <?php
                include('app/views/templates/tugas.php');
            ?>
            <!-- akses -->
            <!-- beri akses -->
            <?php
                include('app/views/templates/beri-akses.php');
            ?>
            <!-- Tambah Pengguna -->
            <?php
                include('app/views/templates/tambah-pengguna.php');
            ?>
        </div>
    </div>
    </div>

    <!-- script js -->
    <?php
        include('app/views/templates/script-js.php');
    ?>
</body>
