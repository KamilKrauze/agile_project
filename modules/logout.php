<?php
$_SESSION['loggedIn'] = "false";
unset($_POST['selectedType']);
session_destroy();
?>