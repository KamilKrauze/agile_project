<?php
session_start();

if (isset($_SESSION['index'])) {
    $_SESSION['index']++;
}
?>