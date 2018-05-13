<?php
session_start();
$item = $_POST["item"];

foreach ($_SESSION['cart'] as $value) {
    if ($value === $item) {
        unset($_SESSION['cart'][$item]);
    }
}
?>