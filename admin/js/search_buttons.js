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
    /*
    localStorage.setItem("op_type", JSON.stringify("edit"));
    localStorage.setItem("item_id", JSON.stringify(itemID));
    localStorage.setItem("item_type", JSON.stringify(itemType));
    window.location.href = "modify.php";
    */
}


function remItem(element, itemID, itemType) {
    console.log(element);
    console.log(itemType);
    console.log(itemID);

    window.location.href = "modify.php";
}