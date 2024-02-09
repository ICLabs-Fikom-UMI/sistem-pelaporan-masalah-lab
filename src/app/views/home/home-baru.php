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
<body class="tracking-wide bg-[#F3F4F8]">
    <!-- navbar -->
    <?php
        include('/var/www/html/app/views/templates/navbar.php');
    ?>
    <div class="flex">
        <!-- sidebar -->
        <?php
            include('/var/www/html/app//views/templates/sidebar.php');
        ?>
        <!-- main -->
        <div>
            <!-- beranda -->
            <?php
                include('/var/www/html/app/views/templates/beranda.php');
            ?>
            <!-- Laporan -->
            <!-- Laporan Masuk -->
            <?php
                include('/var/www/html/app/views/templates/laporan-masuk.php');
            ?>
            <!-- Laporan saya -->
            <?php
                include('/var/www/html/app/views/templates/laporan-saya.php');
            ?>
            <!-- Buat laporan -->
            <?php
                include('/var/www/html/app/views/templates/buat-laporan.php');
            ?>
            <!-- Tugas -->
            <?php
                include('/var/www/html/app/views/templates/tugas.php');
            ?>
            <!-- akses -->
            <!-- beri akses -->
            <?php
                include('/var/www/html/app/views/templates/beri-akses.php');
            ?>
            <!-- Tambah Pengguna -->
            <?php
                include('/var/www/html/app/views/templates/tambah-pengguna.php');
            ?>
            <!-- ubah data profile -->
            <?php
                include('/var/www/html/app/views/templates/ubah-data-profile.php');
            ?>
            <!-- profile -->
            <?php
                include('/var/www/html/app/views/templates/profile.php');
            ?>

        </div>
    </div>
    </div>

    <!-- script js -->
    <script src="app/views/templates/js/viewNeed.js"></script>
</body>
