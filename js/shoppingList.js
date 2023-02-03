if (!localStorage.shoppingList) {
    localStorage.shoppingList = JSON.stringify(new Object());
}

// console.log("Shopping List ids: ", localStorage.shoppingList);

function refreshCounter() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    document.getElementById("shoppingListIcon").innerHTML = "Shopping List: " + Object.keys(shoppingList).length;
}

refreshCounter();
addEventListener('storage', refreshCounter);

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

function removeRecipe(recipe_id) {
    console.log("removing", recipe_id);
    shoppingList = JSON.parse(localStorage.shoppingList);
    delete shoppingList[recipe_id];
    localStorage.shoppingList = JSON.stringify(shoppingList);
    location.reload();
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
                "ing-link": x.getAttribute("ingredient-link"),
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

function calculateRow(shoppingList, ingredient_table, recipeid, input_element) {
    // Compile ingredients table
    // console.log(recipeid, shoppingList);
    var ingrs = shoppingList[recipeid].ingredients;
    for (var ing in ingrs) {
        var ing = ingrs[ing];
        
        if (!(ing.id in ingredient_table)) {
            ingredient_table[ing.id] = {"name": ing.name, "ing-link": ing["ing-link"]};
        }

        if (ing.type in ingredient_table[ing.id]) {
            ingredient_table[ing.id][ing.type] += Number(ing.defaultvalue) * input_element.value / shoppingList[recipeid].serves;
        } else {
            ingredient_table[ing.id][ing.type] = Number(ing.defaultvalue) * input_element.value / shoppingList[recipeid].serves;
        }
    }
}

function recalculateIngredients() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    ingredient_table = new Object();

    for (var id in shoppingList) {
        const input_element = document.getElementById("recipe" + id);
        calculateRow(shoppingList, ingredient_table, id, input_element);
    }

    for (var id in ingredient_table) {
        const input_element = document.getElementById("ingredient" + id);
        input_element.innerText = ingredient_table[id].name + " - ";
        for (var ing_type in ingredient_table[id]) {
            if (ing_type != "name" && ing_type != "ing-link") {
                input_element.innerText += " " + parseFloat(ingredient_table[id][ing_type].toFixed(2)) + " " + ing_type + " ";
            }
        }
    }
}

function refreshList() {
    const body = document.getElementById("main-body");
    body.innerHTML = '';

    if (Object.keys(shoppingList).length === 0) {
        var empty = document.createElement("h1");
        empty.id = "empty-header";
        empty.innerHTML = "Your shopping list is empty";
        body.appendChild(empty);
        return 0;
    }

    var recipes_div = document.getElementById("recipes-div")
    if (recipes_div) {
        recipes_div.innerHTML = '';
    } else {
        recipes_div = document.createElement("div");
        recipes_div.id = "recipes-div";
        recipes_div.classList.add("recipes-div");
        body.appendChild(recipes_div);
    }

    var recipes_title = document.createElement("h1");
    recipes_title.innerHTML = "Selected recipes:";
    recipes_div.appendChild(recipes_title);
    
    shoppingList = JSON.parse(localStorage.shoppingList);
    ingredient_table = new Object();

    for (var id in shoppingList) {
        // Add recipe link and title
        var recipe_link = document.createElement("a");
        recipe_link.href = "./recipe.php?id=" + id;
        recipe_link.classList.add("recipe-name");
        
        var recipe_name = document.createElement("h4");
        recipe_name.innerText = shoppingList[id].name;

        var servings_input = document.createElement("input");
        servings_input.type = "number";
        servings_input.min = "1";
        servings_input.max = "1000";
        servings_input.value = shoppingList[id].serves;
        servings_input.id = "recipe" + id;
        servings_input.onchange = recalculateIngredients;

        var servings_label = document.createElement("h4");
        servings_label.innerText = "servings";

        var remove_button = document.createElement("button");
        remove_button.innerText = "Remove recipe";
        remove_button.setAttribute("onclick", "removeRecipe(" + id + ")");

        var row_div = document.createElement("div");
        row_div.classList.add("flex-container");

        var button_div = document.createElement("div");
        button_div.classList.add("button-container");

        var input_div = document.createElement("div");
        input_div.classList.add("flex-container");
        
        recipe_link.appendChild(recipe_name);
        row_div.appendChild(recipe_link);
        input_div.appendChild(servings_input);
        input_div.appendChild(servings_label);
        button_div.appendChild(input_div);
        button_div.appendChild(remove_button);
        row_div.appendChild(button_div);
        recipes_div.appendChild(row_div);

        calculateRow(shoppingList, ingredient_table, id, servings_input);
    }
    
    // console.log(ingredient_table)
    var ingredients_div = document.getElementById("ingredients-div")
    if (ingredients_div) {
        ingredients_div.innerHTML = '';
    } else {
        ingredients_div = document.createElement("div");
        ingredients_div.id = "ingredients-div";
        body.appendChild(ingredients_div);
    }
    
    ingredients_title = document.createElement("h1");
    ingredients_title.innerHTML = "Combined shopping list:";
    ingredients_div.appendChild(ingredients_title);

    for (var id in ingredient_table) {
        var ingredient_link = document.createElement("a");
        if (ingredient_table[id]["ing-link"] != "") {
            ingredient_link.href = ingredient_table[id]["ing-link"];
        }
        var ingredient_name = document.createElement("h4");
        ingredient_name.id = "ingredient" + id;
        ingredient_name.innerText = ingredient_table[id].name + " - ";
        for (var ing_type in ingredient_table[id]) {
            if (ing_type != "name" && ing_type != "ing-link") {
                ingredient_name.innerText += parseFloat(ingredient_table[id][ing_type].toFixed(2)) + " " + ing_type + " ";
            }
        }
        ingredient_link.appendChild(ingredient_name);
        
        ingredients_div.appendChild(ingredient_link);
    }
}