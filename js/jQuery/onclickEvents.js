

var ingredients = document.getElementById('ingredientList');

function onclickAdd(){
    var placeholder;
    var ingredient = document.getElementById('ingredient').value;
    var quantity = document.getElementById('quantity').value;
    var measurementSelect = document.getElementById('measurementType');
    var measurementType = measurementSelect.options[measurementSelect.selectedIndex].text;
    var allergenTypeSelect = document.getElementById('allergenType');
    var allergenType = allergenTypeSelect.options[allergenTypeSelect.selectedIndex].text;
    console.log(ingredient+" "+quantity+" "+measurementType+" "+allergenType);

    if(ingredient == "" || quantity == "" || allergenType == ""){
        alert("You haven't provided sufficient information to add an ingredient.");
        return;
    }

        var newingredientPart1 = `<tr id="${ingredient}">
                <th>${ingredient}</th>
                <th>
                    <input class="quantity-input" type="number" min="1" onkeypress="return event.keyCode != 13;" style="width:50%" value="${quantity}">
                </th>
                <th>
                    <div class="input-group">
                        <select class = "form-select">
                            <option hidden = "true" value = "${measurementType}">${measurementType}</option>`;
            var newingredientPart2;
            $.ajax({
                url: '../modules/fetchmeasurements.php',
                type: 'POST',
                async: false,
                success: (measurements) => {
                    newingredientPart2 = String(measurements);
                }
            })
        
            var newingredientPart3 = `</select>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select class = "form-select" style="max-width:20vw;">
                        <option hidden = "true" value="${allergenType}" >${allergenType}</option>
                        `;
            var newingredientPart4;
            $.ajax({
                url: '../modules/fetchallergens.php',
                type: 'POST',
                async: false,
                success: (allergens) => {
                    newingredientPart4 = String(allergens);
                    console.log(newingredientPart4);
                }
            })
            var newingredientPart5 = `</select>           
                    </div>
                </th>
                <th>
                    <button aria-label="" class="btn btn-danger" type="button">
                        X
                    </button>
                </th>
            </tr>`; 
        var newingredient = newingredientPart1+newingredientPart2+newingredientPart3+newingredientPart4+newingredientPart5;
        var ingredientList = document.getElementById('ingredientList');
        ingredientList.insertAdjacentHTML('beforeend', newingredient);
}
window.onbeforeunload = function retainProgress(){
    var documentProgress = "<!DOCTYPE html>\n" + document.documentElement.outerHTML;
    var description = document.getElementById('Description');
    localStorage.setItem("Description", JSON.stringify(description.value));
    localStorage.setItem("modifyHTML", JSON.stringify(documentProgress));
}