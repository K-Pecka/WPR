var parseHTML = (temp) => {
    var templateContainer = document.createElement('template');
    templateContainer.innerHTML = temp;
    return templateContainer;
}
var setFavorite = () =>
{
    console.log(document.querySelectorAll('.recipe'));

    document.querySelectorAll('.recipe').forEach(recipe=>{
        var contextMenu = document.getElementById("context-menu");
        recipe.addEventListener('contextmenu', function(event) {
        
        event.preventDefault();
        
        contextMenu.querySelector('.delete').dataset.id=recipe.dataset.id;
        contextMenu.style.display = "block";
        contextMenu.style.left = event.pageX + "px";
        contextMenu.style.top = event.pageY + "px";
        });
        contextMenu.querySelector('.delete').addEventListener('click',(e)=>{
            console.log("remove");
            deleteFavorite(e.target.dataset.id);
        });

        document.addEventListener("click", function (event) {
            var contextMenu = document.getElementById("context-menu");
            contextMenu.style.display = "none";
        });
    });
};
var commentForm = (id) =>
{
    var form = document.querySelector('#comment-form');
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        var comment = form.querySelector('textarea').value;
        var recipe = id.split('=')[1];
        var formData = new FormData();
        formData.append('comment',comment);
        formData.append('id_recipe',recipe);
        addComment(formData);
    });
    console.log(form);
}