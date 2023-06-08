const menuToggle = document.getElementById('menu-toggle');
const menuCheckbox = document.getElementById('menu-checkbox');
const banner = document.querySelector('#banner');

menuToggle.addEventListener('click', () => {
  menuCheckbox.checked = !menuCheckbox.checked;
});

var prevScrollPos = window.pageYOffset;

window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;

  if (prevScrollPos > currentScrollPos || currentScrollPos > window.innerHeight) {
    document.getElementById("main-nav").classList.remove("hiden");
  } else {
    document.getElementById("main-nav").classList.add("hiden");
  }

  prevScrollPos = currentScrollPos;
};

banner.addEventListener('click',displayIndex);