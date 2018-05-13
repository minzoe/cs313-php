<?php
session_start();
$item = $_POST["item"];

$cart = $_SESSION['cart'];
foreach ($cart as $list) {
           if ($list === $item) {
               unset($_SESSION['cart'][$list]);
           }
       }
?>