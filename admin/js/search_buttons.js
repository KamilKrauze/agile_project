function editItem(element, itemID, itemType) {
    console.log(element);
    console.log(itemType);
    console.log(itemID);

    $.post("modify.php", {
        op_type: "edit",
        item_type : itemType,
        item_id : String(itemID),
    } , (response) => {localStorage.setItem("modifyHTML", JSON.stringify(response));
            window.location.href = "modify.php";}
    );
}
window.onbeforeunload = () => {
    console.log("Changing page!");
}
function remItem(element, itemID, itemType) {
    console.log(element);
    console.log(itemType);
    console.log(itemID);

    window.location.href = "modify.php";
}