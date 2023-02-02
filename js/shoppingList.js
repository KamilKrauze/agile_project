if (!localStorage.shoppingList) {
    localStorage.shoppingList = JSON.stringify(new Object());
}

// console.log("Shopping List ids: ", localStorage.shoppingList);

function refreshCounter() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    document.getElementById("shoppingListIcon").innerHTML = "Shopping List: " + Object.keys(shoppingList).length;
}

refreshCounter();

var url = new URL(window.location.href);
var id = url.searchParams.get("id");
// console.log("Current page recipe id: ", id);

function refreshButton() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    var button = document.getElementById("recipeAddButton");
    if (button) {
        if (id && id in shoppingList) {
            button.innerHTML = "Remove recipe from the shopping list";
            button.classList.add('remove-button')
        } else {
            button.innerHTML = "Add recipe to the shopping list";
            button.classList.remove('remove-button')
        }
    }
}

function addRecipeToList() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    if (id in shoppingList) {
        delete shoppingList[id];
    } else {
        var ingredientItems = Array.from(document.getElementsByClassName("ingredientItems"));
        var ingredients = (ingredientItems.map(function(x){
            return {
                "id": x.getAttribute("ingredient-id"),
                "name": x.getAttribute("ingredient-name"),
                "defaultvalue": x.getAttribute("defaultvalue"),
                "type": x.getAttribute("measurement-type"),
            };
        }))

        shoppingList[id] = {
            "name": document.getElementById("recipeName").innerText,
            "serves": document.getElementById("servingsNumber").value,
            "ingredients": ingredients,
        };
    }

    localStorage.shoppingList = JSON.stringify(shoppingList);
    // console.log("New shopping list: ", localStorage.shoppingList);

    refreshCounter();
    refreshButton();
}

function refreshList() {
    // create a new div element
    const recipes_div = document.createElement("div");
    const body = document.getElementById("main-body");
    
    shoppingList = JSON.parse(localStorage.shoppingList);
    ingredient_table = new Object();

    for (var id in shoppingList) {
        // Add recipe link and title
        var recipe_link = document.createElement("a");
        recipe_link.href = "./recipe.php?id=" + id;
        var recipe_name = document.createElement("h4");
        
        recipe_name.innerText = shoppingList[id].name;
        recipe_link.appendChild(recipe_name);
        
        recipes_div.appendChild(recipe_link);
        var ingrs = shoppingList[id].ingredients;

        // Compile ingredients table
        for (var ing in ingrs) {
            var ing = ingrs[ing];
            
            if (!(ing.id in ingredient_table)) {
                ingredient_table[ing.id] = {"name": ing.name};
            }

            if (ing.type in ingredient_table[ing.id]) {
                ingredient_table[ing.id][ing.type] += Number(ing.defaultvalue);
            } else {
                ingredient_table[ing.id][ing.type] = Number(ing.defaultvalue)
            }
        }
    }
    
    // console.log(ingredient_table)
    const ingredients_div = document.createElement("div");

    for (var id in ingredient_table) {
        var ingredient_link = document.createElement("a");
        // ingredient_link.href = "./recipe.php?id=" + id;
        var ingredient_name = document.createElement("h4");
        ingredient_name.innerText = ingredient_table[id].name + " - ";
        for (var ing_type in ingredient_table[id]) {
            if (ing_type != "name") {
                ingredient_name.innerText += ingredient_table[id][ing_type] + " " + ing_type + " ";
            }
        }
        ingredient_link.appendChild(ingredient_name);
        
        ingredients_div.appendChild(ingredient_link);
    }
    
    body.insertBefore(recipes_div, document.getElementById("ingredients-header"));
    body.appendChild(ingredients_div);
}