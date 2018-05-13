<?php
session_start();
$item = $_POST["item"];

$_SESSION['cart'][] = $item;
?>