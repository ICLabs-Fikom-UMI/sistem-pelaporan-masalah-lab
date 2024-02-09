//   pop up
function showPopup() {
  var popupDiv = document.getElementById("popupDiv");
  var overlay = document.getElementById("overlay");

  if (popupDiv.style.display === "none") {
    popupDiv.style.display = "block";
    overlay.style.display = "block";
  } else {
    popupDiv.style.display = "none";
    overlay.style.display = "none";
  }
}
function closePopup() {
  var popupDiv = document.getElementById("popupDiv");
  var overlay = document.getElementById("overlay");
  popupDiv.style.display = "none";
  overlay.style.display = "none";
}
