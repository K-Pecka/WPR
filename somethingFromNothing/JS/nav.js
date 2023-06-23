if(document.getElementById('menu-toggle'))
{
  var menuToggle = document.getElementById('menu-toggle');
  menuToggle.addEventListener('click', () => {
  menuCheckbox.checked = !menuCheckbox.checked;
  });

  document.addEventListener('DOMContentLoaded', function() {
    var checkbox = document.getElementById('menu-checkbox');
    checkbox.addEventListener('click', function() {
      var dropdownMenu = document.getElementById('dropdown-menu');
      dropdownMenu.style.display = checkbox.checked ? 'block' : 'none';
    });
  });
}

var menuCheckbox = document.getElementById('menu-checkbox');



var prevScrollPos = window.pageYOffset;

window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollPos > currentScrollPos || currentScrollPos < window.innerHeight) {
    document.getElementById("main-nav").classList.remove("hiden");
  } else {
    document.getElementById("main-nav").classList.add("hiden");
  }

  prevScrollPos = currentScrollPos;
};

function showLoginPopup() {
  document.getElementById('login-popup').style.display = 'block';
    getLoginForm();
    setTimeout(
    ()=>{
      document.getElementById("change").addEventListener("click", function() {
        var buttonText = this.innerText;
        var message = document.querySelector(".message");
      
        if (buttonText === "Sign Up") {
          this.innerText = "Login";
          message.style.transform = "translateX(0)";
          message.classList.remove("signup");
          message.classList.add("login");
        } else {
          this.innerText = "Sign Up";
          message.style.transform = "translateX(100%)";
          message.classList.remove("login");
          message.classList.add("signup");
        }
      });
    document.querySelector('.closeLog').addEventListener('click',()=>{
      document.querySelector('#login-content .container').innerHTML = "";
      document.getElementById('login-popup').style.display = 'none';
    });
    document.querySelector('.container .form--signup form').addEventListener('submit',(e)=>{
      e.preventDefault();
      signUp(e);
    });
    document.querySelector('.container .form--login form').addEventListener('submit',(e)=>{
      e.preventDefault();
      logged(e);
    });
  },1000);
    
}

function hideLoginPopup() {
  document.getElementById('login-popup').style.display = 'none';
}

  var banner = document.querySelector('#banner');
  banner.addEventListener('click',displayIndex);





function toggleUserMenu() {
  var dropdown = document.querySelector('.user-dropdown');
  dropdown.classList.toggle('show');
}
if(document.querySelector('.userMenu'))
{
  var userImage = document.querySelector('.user-image');
  document.querySelector('.user-image').addEventListener('click',toggleUserMenu);
  document.addEventListener('scroll', function(event) {
    var userDropdown = document.querySelector('.user-dropdown');
    var targetElement = event.target;
    
    if (userDropdown && !userDropdown.contains(targetElement) && !userImage.contains(targetElement)) {
      userDropdown.classList.remove('show');
    }
  });
  document.addEventListener('click', function(event) {
  var userDropdown = document.querySelector('.user-dropdown');
  var targetElement = event.target;
  
  if (userDropdown && !userDropdown.contains(targetElement) && !userImage.contains(targetElement)) {
    userDropdown.classList.remove('show');
  }
});
document.querySelector('.LogOut').addEventListener('click',logOut);
document.querySelector('.user-dropdown select').addEventListener('change',(e)=>
  {
    const params = new URLSearchParams();
    params.append('lang', e.target.value);
    setLang(params);
  });
}
if(document.querySelector('.nav-search-btn'))
{
  document.querySelector('.nav-search-btn').addEventListener('click',
()=>getRecipes('phrase='+document.querySelector('#nav-search').value));
}
