function loadNamaLab() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var data = JSON.parse(xhr.responseText);
      fillSelectNamaLab(data);
    }
  };
  xhr.open("GET", "index.php?action=nama-lab", true);
  xhr.send();
}

function fillSelectNamaLab(data) {
  var select = document.getElementById("nama-lab");
  var selectHTML = `<option value="" disabled selected>Pilih Lab </option>`;
  data.forEach(function (item, index) {
    selectHTML += `
        <option value="${item.ID_Lab}">${item.Nama_Lab}</option>`;
  });

  select.innerHTML = selectHTML;
}
