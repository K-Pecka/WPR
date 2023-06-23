var displayRecipe = (el) => {
    fetch('../config/config.json')
      .then(response => response.json())
      .then(data => {
        window.location.href = data.path.display + "?id_recipe=" + el.dataset.id;
      })
      .catch(error => {
        console.error('Błąd pobierania pliku JSON:', error);
      });
  };
  var displayIndex = () => {
    var URL = window.location.href.split('/').pop().split('?')[0];
    console.log(URL);
    if( URL == "" || URL == "index.php")return;
    fetch('../config/config.json')
      .then(response => response.json())
      .then(data => {
        window.location.href = data.path.index;
      })
      .catch(error => {
        console.error('Błąd pobierania pliku JSON:', error);
      });
  }; 
  var getTemp = (temp) => {
    return fetch('../template/' + temp)
      .then(response => response.text());
  }
  
  var getRecipes = async (status,temp,element,follow=true) => {
    try {
      var templateSource = await getTemp(temp);
      var templateElement = parseHTML(templateSource);
      var response = await fetch('../service/recipe/getRecipes.php?'+status);
      var data = await response.json();
      if(data == "")
      {
        var response = await fetch('../service/config/error.php?noData=true');
        var data = await response.json();
        document.querySelector(element).innerHTML = 
        `<div class='errorServer'>
        <h2>`+data.error.h2+`</h2>
        <p>`+data.error.p+`</p>
        </div>`;
        return;
      }
      if (typeof Handlebars === 'undefined') {
        
        var response = await fetch('../service/config/error.php?errorServer=true');
        var data = await response.json();
        document.querySelector(element).innerHTML = 
        `<div class='errorServer'>
          <h2>`+data.error.h2+`</h2>
        </div>`;
        return;
      }
      data.map((el) => {
        el.rating = '★'.repeat(el.rating).padEnd(5, '☆').split('');
        el.time = el.time === null ? 0 : el.time;
        el.review=el.review == null ? 0:el.review ;
      });
  
      var template = Handlebars.compile(templateElement.innerHTML);
      var html = "";
      data.forEach(function (recipe) {
        html += template(recipe);
      });
      
      document.querySelector(element).innerHTML = html;
      if( document.querySelector('.recipe') && follow)
      {
        document.querySelectorAll('.recipe').forEach((el) => {
        el.addEventListener('click', () => displayRecipe(el));
        });
      }
      
    } catch (error) {
      console.error('Błąd pobierania danych:', error);
    }
  };
  
  
  var getRecipesForId = async (id) => {
    try {
      var response = await fetch('../service/recipe/getRecipeId.php?' + id);
      var data = await response.json();
      if(data.error)
      {
        var response = await fetch('../service/config/error.php?notFound=true');
        var data = await response.json();
        document.querySelector("#recipe").innerHTML = 
        `<div class='errorServer'>
        <h2>`+data.error.h2+`</h2>
        <p><a href="`+data.error.a.href+`">`+data.error.a.content+`</a></p>
        </div>`;
        document.querySelector("#comment").remove();
        document.querySelector("#recommended").remove();
        return;
      }
      if (typeof Handlebars === 'undefined') {
        var response = await fetch('../service/config/error.php?errorServer=true');
        var data = await response.json();
        document.querySelector("#recipe").innerHTML = 
        `<div class='errorServer'>
          <h2>`+data.error.h2+`</h2>
        </div>`;
        return;
      }
      console.log(data);
      data.rating = '★'.repeat(data.rating).padEnd(5, '☆').split('');
      var templateSource = await getTemp('recipeById.html');
      var templateElement = parseHTML(templateSource);
      var recipeTemplate = Handlebars.compile(templateElement.innerHTML);
      var recipeContainer = document.getElementById("recipe");
      var recipeHTML = recipeTemplate(data);
      
      recipeContainer.innerHTML = recipeHTML;
    } catch (error) {
      console.error('Błąd pobierania danych:', error);
    }
  };
  

  var getIngredient = () => {
    fetch('../service/recipe/getIngridient.php')
      .then(response => response.json())
      .then(data => {
        if (typeof Handlebars == 'undefined') {
          document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
          return;
        }
        var recipeTemplateSource = document.getElementById("ingredient-template").innerHTML;
        var recipeTemplate = Handlebars.compile(recipeTemplateSource);
        var recipeContainer = document.getElementById("addIng");
        var html = "";
        data.forEach(el => {
          html += recipeTemplate(el);
        });
        recipeContainer.innerHTML = html;
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
        console.log(error);
      });
  };
  var getLoginForm = () => {
    fetch('../template/login.html')
    .then(response => response.text())
      .then(html => {
        document.querySelector('#login-content').innerHTML = html;
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
        console.log(error);
      });
  };
  
   var register = (formData,feedBack) =>{
    console.log(formData);
    fetch("../service/user/register.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      if(json.error)
      {
        console.log(json.error);
        feedBack.textContent = json.error;
      }
      else
      {
        location.reload();
        console.log(json.success);
      }
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  };
  var logIn = (formData) =>{
    console.log(formData);
    fetch("../service/user/login.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      if(json.error)
      {
        console.log(json.error);
      }
      else
      {
        location.reload();
        console.log(json.success);
      }
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  };
  var logOut = () =>
  {
    fetch("../service/user/logOut.php");
    window.location.href='./';
  }
  var getRecipesComments = async (id) => {
    try {
      var response = await fetch('../service/recipe/getRecipeComments.php?' + id);
      var data = await response.json();
  
      if (typeof Handlebars === 'undefined') {
        document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
        return;
      }
      var templateSource = await getTemp('comment.html');
      var templateElement = parseHTML(templateSource);
      var recipeTemplate = Handlebars.compile(templateElement.innerHTML);
      var recipeContainer = document.getElementById("comments");
      var comments ="";
      data.forEach(el=>comments+=recipeTemplate(el));
      recipeContainer.innerHTML = comments;
    } catch (error) {
      console.error('Błąd pobierania danych:', error);
    }
  };
  var setLang = (param) =>{
    fetch("../service/user/setLang.php?"+param.toString())
    .then(json => {
      if(!json.error)
      {
        location.reload();
      }
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  }
  var deleteFavorite = (id)=>
  {
    fetch("../service/recipe/deleteFavorite.php?recipe="+id)
    .then(response => response.text())
    .then(json => {
      if(!json.error)
      {
        console.log(json);
      }
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  }
  var getUser = (id) =>
  {
    commentForm(id);
    fetch("../service/user/user.php")
    .then(response => response.json())
    .then(json => {
      if(!json.error)
      {
        console.log(json);
        document.querySelector('.comment-author h4').innerHTML=json.user.nickName;
        document.querySelector('.comment-author img').src='../image/public/user/'+json.image;
      }
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  }
  var addComment = (formData) =>
  {
    fetch("../service/recipe/addRecipeComment.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      getRecipesComments(json.id);
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  }
  var addRecipe = (formData) =>
  {
    console.log(formData);
    fetch("../service/recipe/addRecipe.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      if(!document.querySelector('body #error-banner'))
      {
        document.querySelector('body').innerHTML+='<div id="error-banner"><span>'+json.message+'</span><div>';
      }
      if(json.status)document.querySelector('#error-banner').classList.toggle("sucessfullMess");
      
      document.querySelector('#error-banner').innerHTML='<span>'+json.message+'</span>';
      respnsMess();
      setTimeout(()=>window.location.href="./",5000);
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
  }











if(document.getElementById('cookie-accept'))
{
  document.addEventListener('DOMContentLoaded', function() {
    const cookieBanner = document.getElementById('cookie-banner');
    const cookieAcceptButton = document.getElementById('cookie-accept');
  
    // Funkcja do ukrywania banera
    function hideCookieBanner() {
      cookieBanner.classList.remove('show');
    }
  
    // Funkcja do pokazywania banera
    function showCookieBanner() {
      cookieBanner.classList.add('show');
    }
  
    // Funkcja do obsługi kliknięcia przycisku zaakceptowania plików cookie
    function handleCookieAccept() {
      // Wykonaj żądanie Fetch, aby zaktualizować stan zaakceptowania plików cookie na serwerze
      fetch('../service/config/setCookies.php')
      .then(function(response) {
        if (response.ok) {
          // Pomyślnie zaktualizowano stan zaakceptowania plików cookie
          // Ukryj baner
          hideCookieBanner();
        } else {
          console.error('Error:', response.status);
        }
      })
      .catch(function(error) {
        console.error('Error:', error);
      });
    }
  
    // Dodaj obsługę kliknięcia przycisku zaakceptowania plików cookie
    cookieAcceptButton.addEventListener('click', handleCookieAccept);
  
    // Sprawdź, czy użytkownik już zaakceptował pliki cookie
    const cookieAccepted = document.cookie.indexOf('cookie_accepted') !== -1;
    if (cookieAccepted) {
      // Ukryj baner, jeśli pliki cookie zostały zaakceptowane
      hideCookieBanner();
    } else {
      // Pokaż baner z animacją, jeśli pliki cookie nie zostały jeszcze zaakceptowane
      showCookieBanner();
    }
  });
}
var respnsMess = () =>{
  const errorBanner = document.getElementById('error-banner');
  errorBanner.style.display = 'block';
  // Pokaż div i uruchom animację zjeżdżania
  errorBanner.classList.add('slide-in');

  // Znikanie po 5 sekundach
  setTimeout(function() {
    errorBanner.classList.add('slide-out');
  }, 5000);

  // Usuń div po zakończeniu animacji znikania
  errorBanner.addEventListener('transitionend', function(event) {
    if (event.propertyName === 'top' && errorBanner.classList.contains('slide-out')) {
      errorBanner.style.display = 'none';
    }
  });
}
if(errorBanner = document.getElementById('error-banner'))
{
document.addEventListener('DOMContentLoaded',respnsMess );
}

var setUpdateData=async ()=>{
  try {
    var templateSource = await getTemp("userData.html");
    var templateElement = parseHTML(templateSource);
    var response = await fetch('../service/user/getUserData.php');
    var data = await response.json();

    if (typeof Handlebars === 'undefined') {
      document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
      return;
    }
    var templateElement = parseHTML(templateSource);
    var updateData = Handlebars.compile(templateElement.innerHTML);
    var updateDataContainer = document.getElementById("user-section-updateData");
    updateDataContainer.innerHTML = updateData(data);
    document.querySelector('#updateData').addEventListener('submit',(e)=>sendUpdate(e));
  } catch (error) {
    console.error('Błąd pobierania danych:', error);
  }
}
var upadateData = (formData) =>
{
  console.log(formData);
    fetch("../service/user/updateDate.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(json => {
      console.log(json);
    })
    .catch(error => {
      console.error('Błąd pobierania danych:', error);
      console.log(error);
    });
}