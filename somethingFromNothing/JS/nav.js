var menuToggle = document.getElementById('menu-toggle');
var menuCheckbox = document.getElementById('menu-checkbox');
var banner = document.querySelector('#banner');

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

function showLoginPopup() {
  document.getElementById('login-popup').style.display = 'block';
  console.log(document.querySelector('#login-content').innerHTML);
    getLoginForm();
    setTimeout(
    ()=>{
      document.getElementById("signup").addEventListener("click", function() {
      var message = document.querySelector(".message");
      message.style.transform = "translateX(100%)";

      if (message.classList.contains("login")) {
        message.classList.remove("login");
      }

      message.classList.add("signup");
    });

    document.getElementById("login").addEventListener("click", function() {
      var message = document.querySelector(".message");
      message.style.transform = "translateX(0)";

      if (message.classList.contains("signup")) {
        message.classList.remove("signup");
      }

      message.classList.add("login");
    })},1000);
}

function hideLoginPopup() {
  document.getElementById('login-popup').style.display = 'none';
}



banner.addEventListener('click',displayIndex);


document.addEventListener('DOMContentLoaded', function() {
  var checkbox = document.getElementById('menu-checkbox');
  checkbox.addEventListener('click', function() {
    var dropdownMenu = document.getElementById('dropdown-menu');
    dropdownMenu.style.display = checkbox.checked ? 'block' : 'none';
  });
});
