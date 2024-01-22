var isMenuOpen = false;
function toggleMenu() {
  var menuIcon = document.getElementById("menuIcon");
  var closeIcon = document.getElementById("closeIcon");
  var mobileMenu = document.getElementById("mobileMenu");
  isMenuOpen = !isMenuOpen;
  if (isMenuOpen) {
    menuIcon.classList.add("hidden");
    closeIcon.classList.remove("hidden");
    mobileMenu.classList.remove("hidden");
  } else {
    menuIcon.classList.remove("hidden");
    closeIcon.classList.add("hidden");
    mobileMenu.classList.add("hidden");
  }
}
