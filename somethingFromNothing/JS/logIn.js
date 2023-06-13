
var logged = (e) => {
    e.preventDefault();
    console.log(e);
    var login = e.target.querySelector('input[name="login"]').value;
    var pass = e.target.querySelector('input[name="pass"]').value;
    var formData = new FormData();
    formData.append('login', login);
    formData.append('pass', pass);
    logIn(formData);
}