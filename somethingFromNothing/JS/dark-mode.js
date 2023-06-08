var toggleCheckbox = document.querySelector('.toggle-checkbox');

window.addEventListener('load', function() {
  const darkModeEnabled = localStorage.getItem('darkModeEnabled');

  if (darkModeEnabled === 'true') {
    toggleCheckbox.checked = true;
    document.body.classList.add('dark-mode');
  }
});

toggleCheckbox.addEventListener('change', function() {
  if (this.checked) {
    localStorage.setItem('darkModeEnabled', 'true');
    document.body.classList.add('dark-mode');
  } else {
    localStorage.setItem('darkModeEnabled', 'false');
    document.body.classList.remove('dark-mode');
  }
});
