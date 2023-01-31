

var ingredients = document.getElementById('ingredientList');

function onclickAdd(){
    var placeholder;
    var ingredient = document.getElementById('ingredient').value;
    var quantity = document.getElementById('quantity').value;
    var measurementType = document.getElementById('measurementType').value;
    var allergenType = document.getElementById('allergenType').value;
    console.log(ingredient+" "+quantity+" "+measurementType+" "+allergenType);
    switch(event.target.id){
        case'addIngredient':
           var ingredientPart1 = `<tr>
                    <th>${ingredient}</th>
                    <th>
                        <input class="quantity-input" type="number" min="1" onkeypress="return event.keyCode != 13;" style="width:50%" value="${quantity}">
                    </th>
                    <th>
                        <div class="input-group">
                            <select id="measurementType" class = "form-select">
                                <option selected hidden = "true" value = "${measurementType}">${measurementType}</option>`;
            $.post('../../modules/fetchmeasurements.php',
            function(measurements){
                console.log(measurements);
            });
    //                        </select>
    //                        <select id="allergenType" class = "form-select" style="max-width:20vw;">
    //                        <option selected disabled = "true" hidden = "true" value="None" >Allergen Tag</option>
    //                    <?php 
    //                    fetchallergens();
    //                    ?>
    //                    </select>
    //        echo    '        
                   
    //            </div>
    //        </th>
    //        <th>
    //            <button aria-label="${json[i].id}" class="btn btn-danger" type="button">
    //                X
    //            </button>
    //        </th>
    //    </tr>" 
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