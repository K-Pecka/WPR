var getData = () => {
    var currentURL = window.location.href;
    var [currentURL, id] = currentURL.split('/').pop().split('?');
    currentURL=currentURL.split('#')[0];
    console.log(currentURL);
    switch (currentURL) {
      case '':
      case 'index.php':
        getRecipes('','recipe.html','#recipes');
        break;
      case 'userRecipe.php':
        getRecipes('status','userRecipe.html','#UserRecipes',false);
        break;
      case 'favorite.php':
        getRecipes('favorite','recipe.html','#recipes');
        setTimeout(() => {
         setFavorite();
        }, 1000);
        break;
      case 'recipe.php':
        getRecipesForId(id);
        getRecipesComments(id);
        getUser(id);
        break;
      case 'addRecipe.php':
        document.querySelector('#addIngridient').addEventListener('click', getIngredient);
        break;
      case 'userPanel.php':
        setUpdateData();
        break;
            
    }
  };
  
  window.addEventListener('load', getData);