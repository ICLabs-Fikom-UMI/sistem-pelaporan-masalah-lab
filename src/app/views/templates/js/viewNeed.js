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
// filter data table
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase(); // Konversi filter ke huruf besar
  table = document.getElementById("beranda-table"); // Ganti 'beranda-table' dengan ID tabel yang benar
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    // Asumsi status berada di kolom ke-5 (indeks 4)
    td = tr[i].getElementsByTagName("td")[5]; // Sesuaikan indeks dengan posisi kolom "Status"
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (filter === "SEMUA" || txtValue.toUpperCase() === filter) {
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
  document
    .getElementById("berandaBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("berandaBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("laporanBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("laporanBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("laporanSayaBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("laporanSayaBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("buatLaporanBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("buatLaporanBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("tugasBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("tugasBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("beriAksesBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("beriAksesBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("tambahPenggunaBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("tambahPenggunaBtn").classList.add("bg-[#F9F9FB]");
  document
    .getElementById("profileBtn")
    .classList.remove("bg-[#375679]", "text-white");
  document.getElementById("profileBtn").classList.add("bg-[#F9F9FB]");

  // Ulangi untuk tombol lainnya jika ada
}

document.getElementById("berandaBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("berandaForm");
});

document.getElementById("laporanBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("laporanForm");
});

document
  .getElementById("laporanSayaBtn")
  .addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("laporanSayaForm");
  });

document.querySelectorAll(".buatLaporanBtn").forEach(function (button) {
  button.addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("buatLaporanForm");
  });
});

document.getElementById("tugasBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("tugasForm");
});

document.getElementById("beriAksesBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("beriAksesForm");
});

document
  .getElementById("tambahPenggunaBtn")
  .addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("tambahPenggunaForm");
  });

document.getElementById("profileBtn").addEventListener("click", function () {
  resetButtons(); // Mengatur ulang semua tombol ke state default
  this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
  this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
  showForm("profileForm");
});
document
  .getElementById("kembaliProfile")
  .addEventListener("click", function () {
    resetButtons(); // Mengatur ulang semua tombol ke state default
    this.classList.remove("bg-[#F9F9FB]"); // Menghapus kelas untuk background default
    this.classList.add("bg-[#375679]", "text-white"); // Menambahkan kelas untuk background aktif
    showForm("profileForm");
  });

function showForm(formId) {
  var forms = document.getElementsByClassName("form");
  for (var i = 0; i < forms.length; i++) {
    forms[i].classList.add("hidden");
  }
  document.getElementById(formId).classList.remove("hidden");
}

// ubah data profile untuk foto
document.getElementById("uploadButton").addEventListener("click", function () {
  document.getElementById("fileInput").click(); // Memicu klik pada input file
});
