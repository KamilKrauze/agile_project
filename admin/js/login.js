function login() {

    usernameField = document.getElementById("username");
    passwordField = document.getElementById("password");
    
    // Check if fields are not empty
    if(usernameField.value == "") {
        alert("Username field is empty!");
        return;
    }
    else if (String(usernameField.value).length < 8) {
        alert("Username is too short");
        return;
    }

    if (passwordField.value == "") {
        alert("Password field is emtpy!");
        return;
    }

    $.ajax({
        url: "../modules/login_user.php",
        async: false,
        data : {
            username: String(usernameField.value),
            password: String(passwordField.value)
        },
        success: (response) => {
            console.log(response)

            // if (response == "match") {
            //     window.location.href = "../search.php";
            // }
            // else {alert("Invalid login credentials");}
        }
    });


    // $.post('../modules/login_user.php', {
    //     username: String(usernameField.value),
    //     password: String(passwordField.value)
    // }, (response) => {
    //         if (response == "match") {window.location.href = "./search.php";}
    //         else {alert("Invalid login credentials");}
    //     });

}