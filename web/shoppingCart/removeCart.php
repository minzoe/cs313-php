<?php
session_start();
$item = $_POST["item"];

unset($_SESSION['cart'][$item]);
    
?>