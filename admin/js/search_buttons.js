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
function remItem(element, itemID, itemType) {
    console.log(element);
    console.log(itemType);
    console.log(itemID);

    window.location.href = "modify.php";
}