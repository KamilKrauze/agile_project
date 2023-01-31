<?php
$_SESSION['op_type'] = $_POST['op_type'];
$_SESSION['item_type'] = $_POST['item_type'];
$_SESSION['item_id'] = $_POST['item_id'];

echo "store item " . $_SESSION['item_id'];
?>