function editItem(element, itemID, itemType) {
    console.log(element);
    console.log(itemType);
    console.log(itemID);
    $.ajax({
        url: 'modify.php',
        type: 'POST',
        async: false,
        data: {
        op_type: "edit",
        item_type : itemType,
        item_id : String(itemID)},
        success: (response) => {localStorage.setItem("modifyHTML", JSON.stringify(response));
            window.location.href = "modify.php";}
    });
}

window.onbeforeunload = () => {
    console.log("Changing page!");
}
window.onload = function clearLocalStorage(){
    localStorage.clear();
}

function applyFilter() {
    let select = document.getElementById('select_item_type');
    console.log( select.options[select.selectedIndex].value);
   $.ajax({
        url: '../modules/setFilterValue.php',
        type: 'POST',
        async: false,
        data: {selected_type: select.options[select.selectedIndex].value},
        success : (response) => {
            console.log(response);
        }
   });

}