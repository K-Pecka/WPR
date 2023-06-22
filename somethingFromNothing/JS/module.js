var openBtnDescription = document.querySelector('.open-modal-btn-description');
var modalDescription = document.getElementById('modal-description');
var closeBtnDescription = document.getElementsByClassName('close')[0];
var description = document.querySelector('.addToAdd-btn');

function openModal() {
  setTimeout(function() {
    modalDescription.style.display = 'block';
  }, 300);
}

function closeModal() {
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
var inputText="<input type='text' placeholder='wprowadz składnik'>";
var input = modalIngridient.querySelector('.ingredients-grid');

var checkInput = (e) =>{
  console.log(e.target.value);

  if(input.querySelector('input[type="text"]:last-child').value != '')
  {
    console.log(input.querySelector('input[type="text"]:last-child').value);
    input.innerHTML+=inputText;
    input.querySelector('input[type="text"]:last-child').addEventListener('input',(e)=>checkInput(e));
  }
};

function openModalI() {
  setTimeout(function() {
    modalIngridient.style.display = 'block';
      modalIngridient.querySelector('.ingredients-grid').innerHTML+=inputText;
      modalIngridient.querySelector('.ingredients-grid input[type="text"]').addEventListener('input',(e)=>checkInput(e));
      document.querySelectorAll('input[type=checkbox]').forEach(el=>{
      el.addEventListener('change',setChecked);
      });
    
  }, 300);
}

function closeModalI() {
  setTimeout(function() {
    modalIngridient.style.display = 'none';
  }, 300);
}

openBtnIngridient.addEventListener('click', openModalI);
closeBtnIngridient.addEventListener('click', closeModalI);

ingridient.addEventListener('click', () => {
  closeModalI();
  openBtnIngridient.innerHTML = "Edytuj składniki";
  var checkbox = [...modalIngridient.querySelectorAll('input[type="checkbox"]')].filter(el=>el.checked);
  var input = [...modalIngridient.querySelectorAll('input[type="text"')].filter(el=>el.value != '');
  var data = [...checkbox,...input];
  var html = "";
  data.forEach(el=>html +=
    `<div class="ingredient-row"><div><span>`+(el.dataset.name == true ? el.dataset.name : el.value)+`</span></div>
      <div><input name='unite'></div>
      <div>
        <select>
        </select>
      </div>
    </div>`);
  document.querySelector('.ingredient').innerHTML = html;
});

var openBtnPreparation = document.querySelector('#addPreparation');
var modalPreparation = document.getElementById('modalPreparation');
var closeBtnPreparation = document.getElementsByClassName('close')[2];
var preparation = document.querySelector('#modalPreparation .addToAdd-btn');

function openModalP() {
  setTimeout(function() {
    modalPreparation.style.display = 'block';
  }, 300);
}

function closeModalP() {
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