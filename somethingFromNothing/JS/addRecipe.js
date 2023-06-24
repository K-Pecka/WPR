var fileInput = document.querySelector('input[type="file"]');
fileInput.addEventListener('change', function(event) {
  var file = event.target.files[0];
  
  // Utwórz obiekt FileReader
  var reader = new FileReader();
  reader.onload = function(e) {
    var img = new Image();
    img.src = e.target.result;
    
    // Po załadowaniu obrazu
    img.onload = function() {
      var MAX_WIDTH = 800; // Maksymalna szerokość podglądu
      var MAX_HEIGHT = 400; // Maksymalna wysokość podglądu
      
      var width = img.width;
      var height = img.height;
      
      // Sprawdź, czy konieczne jest skalowanie
      if (width > MAX_WIDTH || height > MAX_HEIGHT) {
        var ratio = Math.min(MAX_WIDTH / width, MAX_HEIGHT / height);
        width *= ratio;
        height *= ratio;
      }
      
      // Utwórz element <img> dla podglądu i ustaw odpowiednie rozmiary
      var previewImg = document.createElement('img');
      previewImg.src = img.src;
      previewImg.width = width;
      previewImg.height = height;
      
      // Wstaw podgląd do kontenera
      var imageContainer = document.querySelector('.image div');
      imageContainer.innerHTML = '';
      imageContainer.appendChild(previewImg);
    };
  };
  
  // Odczytaj zawartość pliku jako dane URL
  reader.readAsDataURL(file);
});

document.querySelector('#addRecipe').addEventListener('click',()=>{
  var formData = new FormData();
  var file = document.querySelector('input[type="file"]').files[0];
  if(file === undefined) file='';
  var title = document.querySelector('input[name="title"]').value;
  var description = document.querySelector('.addToAddDescription').innerHTML;
  var ingridents=[];
  var preparations=[];
  var div = [...document.querySelectorAll('.ingredient .ingredient-row')];
  var li = [...document.querySelectorAll('ul.instruction li')];
  for(i=0;i<div.length;i++)
  {
    var el = [...div[i].querySelectorAll('div')];
    console.log(el);
    var ingredient = {};
    ingredient.name = el[0].querySelector('div span').innerHTML;
    ingredient.value= el[1].querySelector('div input').value;
    ingredient.unite = el[2].querySelector('div select').value;
    ingridents.push(ingredient);
  }
  for(i=0;i<li.length;i++)
  {
    var preparation = {
      "description":li[i].querySelector('p').innerHTML,
      "time":li[i].querySelector('span').innerHTML
    }
    preparations.push(preparation);
  }

  if(title == '' || description=='' || ingridents.length == 0)
  {
    console.log("blocked");
  }
  data = 
  {
    "title":title,
    "description":description,
    "ingridents":ingridents,
    "preparations":preparations,
    "file":file
  }
  formData.append('data',JSON.stringify(data));
  formData.append('file',file);
  addRecipe(formData);
});