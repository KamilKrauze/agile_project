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

    $.post('../../modules/login_user.php', {
        username: String(usernameField.value),
        password: String(passwordField.value)
    }, (response) => {
            message = String(response);
            if (message = "match") {window.location.href = "search.php";}
        });

}