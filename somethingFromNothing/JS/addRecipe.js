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
  var title = document.querySelector('input[name="title"]').value;
  var description = document.querySelector('.addToAddDescription').innerHTML;
  var ingridents=[];
  var tr = [...document.querySelectorAll('table.ingredients tr')];
  var li = [...document.querySelectorAll('ul.instruction li')];
  console.log(tr);
  for(i=0;i<tr.length;i++)
  {
    var td = [...tr[i].querySelectorAll('td')];
    var ingredient = {};
    ingredient.name = td[0].innerHTML;
    ingredient.unite= td[1].querySelector('input').value;
    ingredient.value = td[2].querySelector('select').value;
    ingridents.push(ingredient);
  }

  if(title == '' || description=='' || ingridents.length == 0)
  {
    console.log("blocked");
  }  
    console.log(title,description,ingridents);
});