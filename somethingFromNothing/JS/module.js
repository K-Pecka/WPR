var openBtn = document.querySelector('.open-modal-btn');
var modal = document.getElementById('modalDescription');
var closeBtn = document.getElementsByClassName('close')[0];
var description = document.querySelector('.addToAdd');

function openModal() {
  setTimeout(function() {
    modal.style.display = 'block';
  }, 300);
}

function closeModal() {
  setTimeout(function() {
    modal.style.display = 'none';
  }, 300);
}

openBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);

description.addEventListener('click', () => {
  closeModal();
  openBtn.innerHTML = "Edytuj opis";
  document.querySelector('.description').innerHTML = modal.querySelector('textarea').value;
});

var openBtnI = document.querySelector('#addIngridient');
var modalI = document.getElementById('modalIngredients');
var closeBtnI = document.getElementsByClassName('close')[1];
var descriptionI = document.querySelector('.addToAdd');

function openModalI() {
  setTimeout(function() {
    modalI.style.display = 'block';
  }, 300);
}

function closeModalI() {
  setTimeout(function() {
    modalI.style.display = 'none';
  }, 300);
}

openBtnI.addEventListener('click', openModalI);
closeBtnI.addEventListener('click', closeModalI);

descriptionI.addEventListener('click', () => {
  closeModalI();
  openBtnI.innerHTML = "Edytuj opis";
  document.querySelector('.description').innerHTML = modalI.querySelector('textarea').value;
});
