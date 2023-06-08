var parseHTML = (temp) => {
    var templateContainer = document.createElement('template');
    templateContainer.innerHTML = temp;
    return templateContainer;
}