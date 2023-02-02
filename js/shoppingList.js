if (!localStorage.shoppingList) {
    localStorage.shoppingList = JSON.stringify([]);
}

console.log("Shopping List ids: ", localStorage.shoppingList);

function refreshCounter() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    document.getElementById("shoppingListIcon").innerHTML = "Shopping List: " + shoppingList.length;
}

refreshCounter();

var url = new URL(window.location.href);
var id = url.searchParams.get("id");
console.log("Current page recipe id: ", id);

function refreshButton() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    var button = document.getElementById("recipeAddButton");
    if (id && shoppingList.includes(id)) {
        button.innerHTML = "Remove recipe from the shopping list";
        button.classList.add('remove-button')
    } else {
        button.innerHTML = "Add recipe to the shopping list";
        button.classList.remove('remove-button')
    }
}

function addRecipeToList() {
    shoppingList = JSON.parse(localStorage.shoppingList);
    if (!shoppingList.includes(id)) {
        shoppingList.push(id);
    } else {
        shoppingList.splice(shoppingList.indexOf(id), 1);
    }

    console.log("New shopping list: ", shoppingList);

    localStorage.shoppingList = JSON.stringify(shoppingList);
    refreshCounter();
    refreshButton();
}