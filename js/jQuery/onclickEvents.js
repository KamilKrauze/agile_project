

var ingredients = document.getElementById('ingredientList');

function onclickAdd(){
    var placeholder;
    switch(event.target.id){
        case'addIngredient':
           placeholder = document.getElementById('ingredient').value; 
           ingredients = document.getElementById('ingredientList');
           $(ingredients).val($(ingredients).val()+placeholder+"\n");
           break;
        case'addDietaryTag':
           placeholder = document.getElementById('DietaryTag').value; 
           break; 
        case'addAllergen':
           placeholder = document.getElementById('Allergen').value; 
           break;  
    }
}
window.onbeforeunload = function retainProgress(){
    var ingredientList = ingredients.value;
    localStorage.setItem("ingredientList", JSON.stringify(ingredientList));
}
window.onload = function loadProgress(){
    $(ingredients).val(JSON.parse(localStorage.getItem("ingredientList")));
}