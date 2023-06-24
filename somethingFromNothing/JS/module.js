var openBtnDescription = document.querySelector('.open-modal-btn-description');
var modalDescription = document.getElementById('modal-description');
var closeBtnDescription = document.getElementsByClassName('close')[0];
var description = document.querySelector('.addToAdd-btn');
var body = document.body.style;
function openModal() {
  body.overflowY="hidden";
  setTimeout(function() {
    modalDescription.style.display = 'block';
  }, 300);
}

function closeModal() {
  body.overflowY="auto";
  setTimeout(function() {
    modalDescription.style.display = 'none';
  }, 300);
}

openBtnDescription.addEventListener('click', openModal);
document.querySelector('.addToAddDescription').addEventListener('click', openModal);
closeBtnDescription.addEventListener('click', closeModal);

description.addEventListener('click', () => {
  closeModal();
  openBtnDescription.innerHTML = "Edytuj opis";
  document.querySelector('.addToAddDescription').innerHTML = modalDescription.querySelector('textarea').value;
});

var setChecked = () =>{
  [...modalIngridient.querySelectorAll('input[type=checkbox]')].forEach(el=>{
      if(el.checked) el.parentNode.classList.add('checked');
      else el.parentNode.classList.remove('checked');
  });
  console.log("ok");
};

var openBtnIngridient = document.querySelector('#addIngridient');
var modalIngridient = document.getElementById('modalIngredients');
var closeBtnIngridient = document.getElementsByClassName('close')[1];
var ingridient = document.querySelector('.addToAdd');
var inputText=`
  <label>
    <div class='ingredient-tile'>
      <input type='text' placeholder='wprowadz składnik'>
    </div>
  </label>`;
var input = modalIngridient.querySelector('.ingredients-grid');

var checkInput = (e) =>{
  console.log(e.target.value);
  if(e.target.value.trim()=='')
  {
    if(list.length != 1)
    {
      e.target.parentNode.parentNode.parentNode.remove();
    }
  }
  if([...input.querySelectorAll('input[type="text"]')].pop().value != '')
  {
    var div = document.createElement('div');
    div.classList.add('ingredient-box');
    div.innerHTML=inputText;
    div.addEventListener('input',(e)=>checkInput(e));
    input.appendChild(div);
  }

};

function openModalI() {
  body.overflowY="hidden";
  setTimeout(function() {
    modalIngridient.style.display = 'block';
      modalIngridient.querySelector('.ingredients-grid').innerHTML+="<div class='ingredient-box'>"+inputText+"</div>";
      modalIngridient.querySelector('.ingredients-grid input[type="text"]').addEventListener('input',(e)=>checkInput(e));
      document.querySelectorAll('input[type=checkbox]').forEach(el=>{
      el.addEventListener('change',setChecked);
      });
    
  }, 300);
}

function closeModalI() {
  body.overflowY="auto";
  setTimeout(function() {
    modalIngridient.style.display = 'none';
  }, 300);
}

openBtnIngridient.addEventListener('click', openModalI);
closeBtnIngridient.addEventListener('click', closeModalI);

ingridient.addEventListener('click', getUnite);
var setIngrident =(getSection) => {
  closeModalI();
  openBtnIngridient.innerHTML = "Edytuj składniki";
  var checkbox = [...modalIngridient.querySelectorAll('input[type="checkbox"]')].filter(el=>el.checked==true);
  var input = [...modalIngridient.querySelectorAll('input[type="text"')].filter(el=>el.value != '');
  var data = [...checkbox,...input];
  console.log(checkbox);
  var section="";
  getSection.forEach(el=>section+="<option value='"+el.id+"'>"+el.name+"</option>");
  var html = "";
  data.forEach(el=>{
    console.log(el.dataset.name);
    html +=
    `<div class="ingredient-row"><div><span>`+(el.dataset.name ? el.dataset.name : el.value)+`</span></div>
      <div><input name='unite'></div>
      <div>
        <select>
          `+section+`
        </select>
      </div>
    </div>`});
  document.querySelector('.ingredient').innerHTML = html;
};

var openBtnPreparation = document.querySelector('#addPreparation');
var modalPreparation = document.getElementById('modalPreparation');
var closeBtnPreparation = document.getElementsByClassName('close')[2];
var preparation = document.querySelector('#modalPreparation .addToAdd-btn');

function openModalP() {
  body.overflowY="hidden";
  setTimeout(function() {
    modalPreparation.style.display = 'block';
  }, 300);
}

function closeModalP() {
  body.overflowY="auto";
  setTimeout(function() {
    modalPreparation.style.display = 'none';
  }, 300);
}

openBtnPreparation.addEventListener('click', openModalP);
closeBtnPreparation.addEventListener('click', closeModalP);

preparation.addEventListener('click', () => {
  closeModalP();
  console.log("przygotowanie");
  openBtnPreparation.innerHTML = "Edytuj składniki";
  var input = [...modalPreparation.querySelectorAll('li')].filter(el=>el.querySelector('textarea').value != '' && el.querySelector('input').value != '');
  var html = "";
  input.forEach(el=>html +="<li><p>"+el.querySelector('textarea').value+"</p><span>"+el.querySelector('input').value+"</span> min</li>");
  console.log(document.querySelector('.instruction'),html);
  document.querySelector('ul.instruction').innerHTML = html;
});


var list = modalPreparation.querySelector('ol');
var checkEmpty = (e) => {
  if(e.target.nodeName.toLowerCase() === 'input')return;
  if(e.target.value.trim()=='')
  {
    if(list.length != 1)
    {
      e.target.parentNode.remove();
    }
  }
  
  if(list.querySelector('li:last-child textarea').value != '')
  {
    var li = document.createElement('li');
    li.innerHTML = '<span>Czas przygotowania: <input type="number" type="time">min</span><textarea placeholder="Podaj opis" class="content"></textarea>';
    e.target.addEventListener('input',(e)=>checkEmpty(e));
    e.target.parentNode.parentNode.appendChild(li);
  }
}
console.log(modalPreparation.querySelectorAll('ol li textarea'));
modalPreparation.querySelectorAll('ol li textarea').forEach(el=>addEventListener('input',(e)=>checkEmpty(e)));