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

function openModalI() {
  setTimeout(function() {
    modalIngridient.style.display = 'block';
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
  var input = [...modalIngridient.querySelectorAll('input')].filter(el=>el.checked);
  var html = "";
  input.forEach(el=>html +=
    `<tr><td>`+el.dataset.name+`</td>
      <td><input></td>
      <td>
        <select>
          <option>KG</option>
          <option>MIL</option>
        </select>
      </td>
    </tr>`);
  document.querySelector('.ingredients table').innerHTML = html;
});

var openBtnPreparation = document.querySelector('#addPreparation');
var modalPreparation = document.getElementById('modalPreparation');
var closeBtnPreparation = document.getElementsByClassName('close')[2];
var preparation = document.querySelector('.addToAdd');

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
  openBtnPreparation.innerHTML = "Edytuj składniki";
  var input = [...modalPreparation.querySelectorAll('input')].filter(el=>el.checked);
  var html = "";
  input.forEach(el=>html +=``);
  document.querySelector('.instruction').innerHTML = html;
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
    console.log(e.target.parentNode.parentNode);
    e.target.addEventListener('input',(e)=>checkEmpty(e));
    e.target.parentNode.parentNode.appendChild(li);
  }
}
console.log(modalPreparation.querySelectorAll('ol li textarea'));
modalPreparation.querySelectorAll('ol li textarea').forEach(el=>addEventListener('input',(e)=>checkEmpty(e)));