function loadJenisBarang() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillSelectJenisBarang(data);
    }
  };
  xhr.open("GET", "index.php?action=jenis-barang", true);
  xhr.send();
}

function fillSelectJenisBarang(data) {
  var select = document.getElementById("jenis-barang");
  var selectHTML = `<option value="" disabled selected>Pilih Jenis Barang</option>`;
  data.forEach(function (item, index) {
    selectHTML += `
      <option value="${item.ID_Aset}">${item.Nama_Aset}</option>`;
  });

  select.innerHTML = selectHTML;
}
