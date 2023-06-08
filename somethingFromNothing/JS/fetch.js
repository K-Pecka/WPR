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
  var getRecipes = () => {
    fetch('../service/getRecipes.php')
      .then(response => response.json())
      .then(data => {
        var templateSource = document.getElementById("recipe-template").innerHTML;
        if (typeof Handlebars == 'undefined') {
          document.querySelector("#recipes").innerHTML = "Błąd Servera 500";
          return;
        }
        data.map((el) => {
          console.log(el);
          el.rating = '★'.repeat(el.rating).padEnd(5, '☆').split('');
          el.time = el.time === null ? 0 : el.time;
        });
        var template = Handlebars.compile(templateSource);
        var html = "";
        data.forEach(function(recipe) {
          html += template(recipe);
        });
        document.querySelector("#recipes").innerHTML += html;
        document.querySelectorAll('.recipe').forEach((el) => {
          el.addEventListener('click', () => displayRecipe(el));
        });
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
      });
  };
  
  var getRecipesForId = (id) => {
    fetch('../service/getRecipeId.php?' + id)
      .then(response => response.json())
      .then(data => {
        if (typeof Handlebars == 'undefined') {
          document.querySelector("#recipe").innerHTML = "Błąd Servera 500";
          return;
        }
        data.rating = '★'.repeat(data.rating).padEnd(5, '☆').split('');
        var recipeTemplateSource = document.getElementById("recipe-template").innerHTML;
        var recipeTemplate = Handlebars.compile(recipeTemplateSource);
        console.log(data);
        var recipeContainer = document.getElementById("recipe");
        var recipeHTML = recipeTemplate(data);
        recipeContainer.innerHTML = recipeHTML;
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
      });
  };

  var getIngredient = () => {
    fetch('../service/getIngridient.php')
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
        console.log(html);
        recipeContainer.innerHTML = html;
      })
      .catch(error => {
        console.error('Błąd pobierania danych:', error);
        console.log(error);
      });
  };
  
 document.querySelector('#addIngridient').addEventListener('click', getIngredient);
  
  