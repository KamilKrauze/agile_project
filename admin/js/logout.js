function logout() {
    $.post('../../modules/logout.php', () => {
        localStorage.clear();
        window.location.href = "index.php";
    });

}