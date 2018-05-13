<?php
session_start();
$cart = $_SESSION['cart'];
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
        <script>
            function removeItem(item) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4) {
                        alert(item + " has been removed from the cart");
                        location.reload();
                    }
                };                
                xmlhttp.open("POST", "removeCart.php", true);
                xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xmlhttp.send('item=' + item);
            }
        </script>
    </head>
    
    <body>
       <?php 
       foreach ($cart as $item) {
           echo $item;
           echo ' <button onclick="removeItem(';
           echo "'".$item."')".'">Remove</button><br>';
       }
       ?>
    </body>
    
</html>