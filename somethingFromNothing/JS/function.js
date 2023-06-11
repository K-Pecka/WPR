var parseHTML = (temp) => {
    var templateContainer = document.createElement('template');
    templateContainer.innerHTML = temp;
    return templateContainer;
}
var signUp = (e) =>
{
    console.log(e.target);
    const formData = new FormData(e.target);
    const data = {};
    for (let [name, value] of formData) {
        data[name] = value;
    }
    console.log(formData);
    console.log(data);
}