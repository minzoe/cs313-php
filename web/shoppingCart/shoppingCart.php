<?php
session_start();
$cart[] = $_SESSION['cart'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel='stylesheet' href='../main.css'>
        <title>Shopping Cart</title>
    </head>
    
    <body>
       <?php 
       foreach ($cart as $item) {
           echo $item."<br>";
       }
       ?>
    </body>
    
</html>