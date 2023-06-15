var emailVerification = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) && email.length > 0;
var somePasswords = (passOne, passTwo) => passOne === passTwo && passOne.length >= 8 && passOne.length <= 30;
var nickName = (nick) => /^[a-zA-Z0-9_-]+$/.test(nick) && nick.length >= 3 && nick.length <= 20;

var signUp = (e) => {

  var formData = new FormData(e.target);
  var nickname = e.target.querySelector('input[name="nickname"]').value;
  var email = e.target.querySelector('input[name="email"]').value;
  var password = e.target.querySelector('input[name="password"]').value;
  var verification = e.target.querySelector('input[name="passwordVerification"]').value;
  
  var formFeedback = e.target.nextElementSibling;
  var message = '';

  if (!emailVerification(email)) {
    message = "Nieprawidłowy adres e-mail.";
  } else if (!somePasswords(password, verification)) {
    message = "Hasła nie są zgodne lub puste.";
  } else if (!nickName(nickname)) {
    message = "Nieprawidłowy nick.";
  }

  if (message !== '') {
    formFeedback.textContent = message;
    return;
  }

  formData.append('nickName', nickname);
  formData.append('email', email);
  formData.append('password', password);
  formData.append('passwordVerification', verification);
  formData.append('url',window.href);

  console.log(formData);
  register(formData,formFeedback);
}