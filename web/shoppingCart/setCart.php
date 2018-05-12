<?php

$item = filter_input(INPUT_REQUEST, 'item', FILTER_SANITIZE_STRING);

array_push($_SESSION['cart'], $item);
?>