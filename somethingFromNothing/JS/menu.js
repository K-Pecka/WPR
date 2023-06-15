var getData = () => {
    var currentURL = window.location.href;
    var [currentURL, id] = currentURL.split('/').pop().split('?');
    currentURL=currentURL.split('#').join('');
    switch (currentURL) {
      case '':
      case 'index.php':
        getRecipes();
        break;
      case 'recipe.php':
        getRecipesForId(id);
        getRecipesComments(id);
        break;
      case 'addRecipe.php':
        document.querySelector('#addIngridient').addEventListener('click', getIngredient);
        break;
    }
  };
  
  window.addEventListener('load', getData);