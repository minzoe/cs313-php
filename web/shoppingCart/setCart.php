<?php

$q = filter_input(INPUT_REQUEST, 'q', FILTER_SANITIZE_STRING);

array_push($_SESSION['cart'], $item);

$message = item + " has been added to the cart";
echo "<script type='text/javascript'>alert('$message');</script>";
?>