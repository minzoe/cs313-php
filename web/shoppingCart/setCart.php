<?php

$item = $_REQUEST["item"];

array_push($_SESSION['cart'], $item);
?>