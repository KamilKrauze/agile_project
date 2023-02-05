function logout() {
    $.ajax({
        url: '../modules/logout.php',
        type: 'POST',
        async: false,
        success: () => {
        localStorage.clear();
        window.location.assign("./index.php");
        }
    });

}