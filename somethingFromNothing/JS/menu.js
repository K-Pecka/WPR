var getData = () => {
    var currentURL = window.location.href;
    var [currentURL, id] = currentURL.split('/').pop().split('?');
    console.log(currentURL);
    switch (currentURL) {
      case '':
      case 'index.php':
        getRecipes();
        break;
      case 'recipe.php':
        getRecipesForId(id);
        break;
    }
  };
  
  window.addEventListener('load', getData);