const menuToggle = document.getElementById('menu-toggle');
const menuCheckbox = document.getElementById('menu-checkbox');

menuToggle.addEventListener('click', () => {
  menuCheckbox.checked = !menuCheckbox.checked;
});
var prevScrollPos = window.pageYOffset;


window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;

  if (prevScrollPos > currentScrollPos || currentScrollPos>window.innerHeight) {
    document.getElementById("main-nav").classList.remove("hiden");
  } else {
    document.getElementById("main-nav").classList.add("hiden");
  }

  prevScrollPos = currentScrollPos;
};
var displayRecipe=(el)=>
{
  fetch('config/config.json')
  .then(response => response.json())
  .then(data => {
    window.location.href = data.path.display+"?id_recipe="+el.dataset.id;
  })
  .catch(error => {
    console.error('Błąd pobierania pliku JSON:', error);
  });
  
}
var getRecipes = () =>{
  fetch('./service/getRecipes.php')
  .then(response => response.json())
  .then(data => {
    var templateSource = document.getElementById("recipe-template").innerHTML;
    if(typeof Handlebars == 'undefined')
    {
       document.querySelector("#recipes").innerHTML = "Błąd Servera 500";
       return;
    }
    data.map((el)=>{
      console.log(el);
      el.rating='★'.repeat(el.rating).padEnd(5, '☆').split('');
      el.time = el.time === null ? 0 : el.time;
    });
    var template = Handlebars.compile(templateSource);
    var html = "";
    data.forEach(function(recipe) {
      html += template(recipe);
    });
    document.querySelector("#recipes").innerHTML += html;
    document.querySelectorAll('.recipe').forEach((el)=>{
      el.addEventListener('click',()=>displayRecipe(el));
    })
  })
  .catch(error => {
    console.error('Błąd pobierania danych:', error);
  });
}

var getRecipesForId = (id) =>{
  fetch('../service/getRecipeId.php?'+id)
  .then(response => response.json())
  .then(data => {
    if(typeof Handlebars == 'undefined')
    {
       document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
       return;
    }
    data.rating='★'.repeat(data.rating).padEnd(5, '☆').split('');
    var recipeTemplateSource = document.getElementById("recipe-template").innerHTML;
    var recipeTemplate = Handlebars.compile(recipeTemplateSource);

    var recipeContainer = document.getElementById("recipe");
    var recipeHTML = recipeTemplate(data);
    recipeContainer.innerHTML = recipeHTML;
  })
  .catch(error => {
    console.error('Błąd pobierania danych:', error);
  });
}
var getData=()=>{
  var currentURL = window.location.href;
  var [currentURL,id]=currentURL.split('/').pop().split('?');
  switch (currentURL)
  {
    case '':
    case 'index.php':
      getRecipes();
      break;
    case 'recipe.php':
    {
      getRecipesForId(id);
    }
  }
}

window.addEventListener('load',getData);












const toggleCheckbox = document.querySelector('.toggle-checkbox');

window.addEventListener('load', function() {
  const darkModeEnabled = localStorage.getItem('darkModeEnabled');

  if (darkModeEnabled === 'true') {
    toggleCheckbox.checked = true;
    document.body.classList.add('dark-mode');
  }
});

toggleCheckbox.addEventListener('change', function() {
  if (this.checked) {
    localStorage.setItem('darkModeEnabled', 'true');
    document.body.classList.add('dark-mode');
  } else {
    localStorage.setItem('darkModeEnabled', 'false');
    document.body.classList.remove('dark-mode');
  }
});


var openBtn = document.querySelector('.open-modal-btn');
var modal = document.getElementById('modalDescription');
var closeBtn = document.getElementsByClassName('close')[0];
var description = document.querySelector('.addToAdd');


function openModal() {
    setTimeout(function () {
      modal.style.display = 'block';
    }, 300);
  }


function closeModal() {
  setTimeout(function () {
    modal.style.display = 'none';
  }, 300);
}


//openBtn.addEventListener('click', openModal);

/*closeBtn.addEventListener('click', closeModal);

description.addEventListener('click',()=>{
  closeModal();
  openBtn.innerHTML="Edytuj opis";
  document.querySelector('.description').innerHTML=modal.querySelector('textarea').value;
});








var openBtnI = document.querySelector('#addIngridient');
var modalI = document.getElementById('modalIngredients');
var closeBtnI = document.getElementsByClassName('close')[1];
var descriptionI = document.querySelector('.addToAdd');


function openModalI() {
  setTimeout(function () {
    modalI.style.display = 'block';
  }, 300);
}

// Funkcja zamykająca moduł
function closeModalI() {
setTimeout(function () {
  modalI.style.display = 'none';
}, 300);
}


openBtnI.addEventListener('click', openModalI);

closeBtnI.addEventListener('click', closeModalI);

descriptionI.addEventListener('click',()=>{
closeModalI();
openBtnI.innerHTML="Edytuj opis";
document.querySelector('.description').innerHTML=modalI.querySelector('textarea').value;
});





*/










var getIngridient = () =>{
  fetch('../service/getIngridient.php')
  .then(response => response.json())
  .then(data => {
    if(typeof Handlebars == 'undefined')
    {
       document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
       return;
    }
    var recipeTemplateSource = document.getElementById("ingredient-template").innerHTML;
    var recipeTemplate = Handlebars.compile(recipeTemplateSource);
    console.log(data);
    var recipeContainer = document.getElementById("addIng");
    var html ="";
    data.forEach(el=>{
      html+=recipeTemplate(el);
    })
    console.log(html);
    recipeContainer.innerHTML += html;
  })
  .catch(error => {
    console.error('Błąd pobierania danych:', error);
  });
}



//document.querySelector('#addIngridient').addEventListener('click',getIngridient);