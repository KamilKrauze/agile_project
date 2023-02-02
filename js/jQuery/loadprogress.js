window.onload = () => {
    //localStorage.setItem("saveProgress",JSON.stringify(false));
    document.querySelector('html').innerHTML = JSON.parse(localStorage.getItem("modifyHTML"));
    //console.log(JSON.parse(localStorage.getItem("saveProgress")));
    if(JSON.parse(localStorage.getItem("saveProgress"))){
        console.log("in load");
        var descriptionC = document.getElementById('Description');
        var description = JSON.parse(localStorage.getItem("Description"));
        $(descriptionC).val(description);
        var ingredientProperties = JSON.parse(localStorage.getItem("ingredientProperties"));

        var ingredients = document.getElementsByClassName('ingredient');
        var oneingredientProperties = [];
        var measurementSelect;
        var allergenTypeSelect;
        for(var i = 0; i<ingredients.length; i++){
            oneingredientProperties = ingredients[i].getElementsByClassName('property');
            oneingredientProperties[0].innerHTML = ingredientProperties[i][0];
            oneingredientProperties[1].value = ingredientProperties[i][1];
            measurementSelect = oneingredientProperties[2];
            measurementSelect.options[measurementSelect.selectedIndex].text = ingredientProperties[i][2];
            allergenTypeSelect = oneingredientProperties[3];
            allergenTypeSelect.options[allergenTypeSelect.selectedIndex].text = ingredientProperties[i][3];
        }
        localStorage.setItem("saveProgress",JSON.stringify(false));
    }
    
    //$('html').html(JSON.parse(localStorage.getItem("modifyHTML")));
    
    //console.log(description);
    //$(descriptionC).val(description);
    
}