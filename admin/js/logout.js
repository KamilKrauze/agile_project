function logout() {
    $.post('../../modules/logout.php', () => {
        window.location.href = "index.php";
    });

}