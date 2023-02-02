

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
    document.querySelector('html').innerHTML = JSON.parse(localStorage.getItem("modifyHTML"));
    //console.log(JSON.parse(localStorage.getItem("modifyHTML")));
    $(ingredients).val(JSON.parse(localStorage.getItem("ingredientList")));
    var op_type = JSON.parse(localStorage.getItem("op_type"));
    var item_Id = JSON.parse(localStorage.getItem("item_id"));
    var item_Type = JSON.parse(localStorage.getItem("item_type"));
/*
    $.post(document.title, {
        op_type: op_type,
        item_type : item_Type,
        item_id : String(item_Id),
    } , (response) => { console.log(response); }
    );

    console.log("this is test 1 " + op_type);
    console.log("this is test 1 " + item_Type);
    console.log("this is test 1 " + item_Id);
*/
}