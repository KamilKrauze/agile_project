<?php
session_start();

if (isset($_SESSION['index'])) {
    echo $_SESSION['index'];
}

?>