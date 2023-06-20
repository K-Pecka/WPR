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
  
  var getRecipes = async (status) => {
    try {
      var templateSource = await getTemp('recipe.html');
      var templateElement = parseHTML(templateSource);
      if (typeof Handlebars === 'undefined') {
        
        var response = await fetch('../service/config/error.php?errorServer=true');
        var data = await response.json();
        document.querySelector("#recipes").innerHTML = 
        `<div class='errorServer'>
          <h2>`+data.error.h2+`</h2>
        </div>`;
        return;
      }
      var response = await fetch('../service/recipe/getRecipes.php?'+status);
      var data = await response.json();
      data.map((el) => {
        el.rating = '★'.repeat(el.rating).padEnd(5, '☆').split('');
        el.time = el.time === null ? 0 : el.time;
      });
  
      var template = Handlebars.compile(templateElement.innerHTML);
      var html = "";
      data.forEach(function (recipe) {
        html += template(recipe);
      });
      if(html == "")
      {
        var response = await fetch('../service/config/error.php?noData=true');
        var data = await response.json();
        document.querySelector("#recipes").innerHTML = 
        `<div class='errorServer'>
        <h2>`+data.error.h2+`</h2>
        <p>`+data.error.p+`</p>
        </div>`;
        return;
      }
      document.querySelector("#recipes").innerHTML = html;
      document.querySelectorAll('.recipe').forEach((el) => {
        el.addEventListener('click', () => displayRecipe(el));
      });
    } catch (error) {
      console.error('Błąd pobierania danych:', error);
    }
  };
  
  
  var getRecipesForId = async (id) => {
    try {
      var response = await fetch('../service/recipe/getRecipeId.php?' + id);
      var data = await response.json();
      if (typeof Handlebars === 'undefined') {
        document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
        return;
      }
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
    location.reload();
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