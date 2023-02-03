function onclickAdd(){
    var placeholder;
    var ingredient = document.getElementById('ingredient').value;
    var quantity = document.getElementById('quantity').value;
    var measurementSelect = document.getElementById('measurementType');
    var measurementType = measurementSelect.options[measurementSelect.selectedIndex].text;
    var allergenTypeSelect = document.getElementById('allergenType');
    var allergenType = allergenTypeSelect.options[allergenTypeSelect.selectedIndex].text;

    if(ingredient == "" || quantity == "" || allergenType == ""){
        alert("You haven't provided sufficient information to add an ingredient.");
        return;
    }
        var exists;
        $.ajax({
            url: '../modules/fetchIngredient.php',
            type: 'POST',
            data: {ingredient_name: ingredient},
            async: false,
            success: (response) => {
                console.log(response);
                exists  = $.parseJSON(response);
            }
        });
        if(exists.exists == "true"){
            var index;
            $.ajax({
                url: '../modules/fetchIndex.php',
                type: 'POST',
                async: false,
                success: (session) => {
                    console.log(session);
                    index = session;
                }
            });
            alert(index);
            var newingredientPart1 = `<tr id="ingredient-${index}" class="ingredient">
                <th class="property"><input type="hidden" name="ingredientID-${index}" value="${exists.id}">${ingredient}</th>
                <th>
                    <input class="quantity-input property" type="number" min="1" name="ingredientQuantity-${index}" onkeypress="return event.keyCode != 13;" style="width:50%" value="${quantity}">
                </th>
                <th>
                    <div class="input-group">
                        <select name = "ingredientMeasurement-${index}" class = "form-select property">
                            <option hidden = "true" value = "${measurementType}">${measurementType}</option>`;
            var newingredientPart2;
            $.ajax({
                url: '../modules/fetchmeasurements.php',
                type: 'POST',
                async: false,
                success: (measurements) => {
                    newingredientPart2 = String(measurements);
                }
            });
        
            var newingredientPart3 = `</select>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select name="ingredientAllergen-${index}" class = "form-select property" style="max-width:20vw;">
                        <option hidden = "true" value="${allergenType}" >${allergenType}</option>
                        `;
            var newingredientPart4;
            $.ajax({
                url: '../modules/fetchallergens.php',
                type: 'POST',
                async: false,
                success: (allergens) => {
                    newingredientPart4 = String(allergens);
                }
            });
            var newingredientPart5 = `</select>           
                    </div>
                </th>
                <th>
                    <button aria-label="" name="ingredient-${index}" onclick="remIngredient(this)"class="btn btn-danger" type="button">
                        X
                    </button>
                </th>
            </tr>`; 
        $.ajax({
            url: '../modules/session_incrementIndex.php',
            type: 'POST',
            async: false
        });
        var newingredient = newingredientPart1+newingredientPart2+newingredientPart3+newingredientPart4+newingredientPart5;
        var ingredientList = document.getElementById('ingredientList');
        ingredientList.insertAdjacentHTML('beforeend', newingredient);
        }else{
            alert("This ingredient does not exist in the database.");
        }
        
}
window.onbeforeunload = function retainProgress(){
    var documentProgress = "<!DOCTYPE html>\n" + document.documentElement.outerHTML;
    var description = document.getElementById('Description');
    localStorage.setItem("Description", JSON.stringify(description.value));
    localStorage.setItem("modifyHTML", JSON.stringify(documentProgress));
    var ingredients = document.getElementsByClassName('ingredient');
    var ingredientProperties = [];
    var oneingredientProperties = [];
    var measurementSelect;
    var allergenTypeSelect;
    for(var i = 0; i<ingredients.length; i++){
        oneingredientProperties = ingredients[i].getElementsByClassName('property');
        ingredientProperties[i] = [];
        ingredientProperties[i][0] = oneingredientProperties[0].innerHTML;
        ingredientProperties[i][1] = oneingredientProperties[1].value;
        measurementSelect = oneingredientProperties[2];
        ingredientProperties[i][2] = measurementSelect.options[measurementSelect.selectedIndex].text;
        allergenTypeSelect = oneingredientProperties[3];
        ingredientProperties[i][3] = allergenTypeSelect.options[allergenTypeSelect.selectedIndex].text;
    }
    localStorage.setItem("ingredientProperties",JSON.stringify(ingredientProperties));
    localStorage.setItem("saveProgress",JSON.stringify(true));
}
function remIngredient(element){
    var toDelete = document.getElementById(element.name);
    console.log(toDelete);
    toDelete.remove();

}