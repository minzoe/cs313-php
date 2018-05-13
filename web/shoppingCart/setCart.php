<?php
session_start();
$item = $_POST["item"];

array_push($_SESSION['cart'], $item);
//$_SESSION['cart'][] = $item;
?>