// dropdown profile navbar
function toggleDropdown() {
  var dropdown = document.getElementById("profileDropdown");
  dropdown.classList.toggle("hidden");
}
// dropdown sidebar
function toggleDropdownMenu(menuId) {
  const dropdownMenu = document.getElementById(menuId);
  if (dropdownMenu.classList.contains("hidden")) {
    // Hapus kelas 'hidden' dan tambahkan kelas untuk animasi muncul
    dropdownMenu.classList.remove("hidden", "-translate-y-5", "opacity-0");
    dropdownMenu.classList.add("translate-y-0", "opacity-100");
  } else {
    // Tambahkan transisi untuk menghilang dengan timeout
    dropdownMenu.classList.replace("translate-y-0", "-translate-y-5");
    dropdownMenu.classList.replace("opacity-100", "opacity-0");
    setTimeout(() => {
      dropdownMenu.classList.add("hidden");
    }, 300); // Waktu sesuai durasi transisi
  }
}

// dropdown pilih teknisi
function toggleDropdownPilihTeknisi() {
  const dropdown = document.getElementById("dropdownPilihTeknisi");
  dropdown.classList.toggle("hidden");
}
// filter data table
function myFunction(selectElement) {
  var filter = selectElement.value.toUpperCase(); // Ambil nilai filter
  var tableId = selectElement.getAttribute("data-table-id"); // Ambil ID tabel dari data attribute
  var table = document.getElementById(tableId);

  var tr = table.getElementsByTagName("tr");

  for (var i = 1; i < tr.length; i++) {
    var td = tr[i].getElementsByTagName("td")[5]; // Anggap kolom status adalah kolom ke-6
    if (td) {
      var txtValue = td.textContent || td.innerText;
      if (filter === "SEMUA" || txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

// spa
// Mendefinisikan fungsi untuk mengatur semua tombol ke state default
function resetButtons() {
  // Daftar ID tombol
  const buttons = [
    "berandaBtn",
    "laporanBtn",
    "laporanSayaBtn",
    "buatLaporanBtn",
    "tugasBtn",
    "beriAksesBtn",
    "tambahPenggunaBtn",
    "profileBtn",
    // Tambahkan ID tombol lain jika ada
  ];

  // Melakukan iterasi untuk setiap ID dan mengubah kelasnya jika elemen ada
  buttons.forEach((id) => {
    const button = document.getElementById(id);
    if (button) {
      button.classList.remove("bg-[#375679]", "text-white");
      button.classList.add("bg-[#F9F9FB]");
    }
  });
}

document.getElementById("berandaBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  loadDataBeranda();
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("berandaForm");
});

if (document.getElementById("laporanBtn")) {
  document.getElementById("laporanBtn").addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    loadLaporanMasuk();
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("laporanForm");
  });
}
if (document.getElementById("laporanSayaBtn")) {
  document
    .getElementById("laporanSayaBtn")
    .addEventListener("click", function () {
      resetButtons(); // Mengatur ulang semua tombol ke state default
      loadLaporanSaya();
      this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
      this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
      showForm("laporanSayaForm");
    });
}
if (document.querySelectorAll(".buatLaporanBtn")) {
  document.querySelectorAll(".buatLaporanBtn").forEach(function (button) {
    button.addEventListener("click", function () {
      var form = document.getElementById("formBuatLaporan");
      form.reset();
      resetButtons();
      loadJenisBarang();
      loadNamaLab();
      this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
      this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
      showForm("buatLaporanForm");
    });
  });
}
if (document.getElementById("tugasBtn")) {
  document.getElementById("tugasBtn").addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    loadTugas();
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("tugasForm");
  });
}

if (document.getElementById("beriAksesBtn")) {
  document
    .getElementById("beriAksesBtn")
    .addEventListener("click", function () {
      resetButtons(); // Mengatur ulang semua tombol ke state default
      loadBeriAkses();
      this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
      this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
      showForm("beriAksesForm");
    });
}

if (document.getElementById("tambahPenggunaBtn")) {
  document
    .getElementById("tambahPenggunaBtn")
    .addEventListener("click", function () {
      var form = document.getElementById("formTambahPengguna");
      form.reset();
      resetButtons(); // Mengatur ulang semua tombol ke state default
      this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
      this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
      showForm("tambahPenggunaForm");
    });
}

if (document.getElementById("profileBtn")) {
  document.getElementById("profileBtn").addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    loadData(idUser);
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("profileForm");
  });
}
if (document.getElementById("kembaliProfile")) {
  document
    .getElementById("kembaliProfile")
    .addEventListener("click", function () {
      resetButtons(); // Mengatur ulang semua tombol ke state default
      loadData(idUser);
      this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
      this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
      showForm("profileForm");
    });
}

function showForm(formId) {
  var forms = document.getElementsByClassName("form");
  for (var i = 0; i < forms.length; i++) {
    forms[i].classList.add("hidden");
  }
  document.getElementById(formId).classList.remove("hidden");
}

// fitur search di table
function searchTable(tableId) {
  var input, filter, table, tr, td, i, j, txtValue, found;
  input = document.querySelector(`input[data-table='${tableId}']`); // Pastikan ini mencocokkan dengan ID tabel yang sesuai
  filter = input.value.toUpperCase();
  table = document.getElementById(tableId);
  tr = table.getElementsByTagName("tr");

  // Loop melalui semua baris dan sembunyikan yang tidak sesuai dengan query pencarian
  for (i = 1; i < tr.length; i++) {
    // Mulai dari 1 untuk mengabaikan baris header
    td = tr[i].getElementsByTagName("td");
    found = false; // Flag untuk menandai jika teks ditemukan dalam baris ini

    // Periksa setiap kolom dalam baris
    for (j = 1; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          found = true; // Teks ditemukan dalam salah satu kolom, tandai baris sebagai ditemukan
          break; // Keluar dari loop kolom jika sudah menemukan
        }
      }
    }

    // Tampilkan atau sembunyikan baris berdasarkan apakah teks pencarian ditemukan
    tr[i].style.display = found ? "" : "none";
  }
}
