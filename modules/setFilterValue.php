<?php
session_start();
$_SESSION['filterBy'] = $_POST['selected_type'];
echo $_SESSION['filterBy'];
?>