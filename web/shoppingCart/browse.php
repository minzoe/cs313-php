<?php
session_start();
?>
<!DOCUMENT html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel='stylesheet' href='../main.css'>
        <title>Browse Items</title>
        <script>
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4) {
                    document.getElementById('content').innerHTML = xmlhttp.responseText;
                }
            }
            function addToCart($item) {
                xmlhttp.open("POST", "setCart.php");
                xmlhttp.send('item='.$item);
                alert($item + " has been added to the cart");
            }
        </script>
    </head>
    
    <body>
        <nav>
            <ul>
                <li><a href="shoppingCart.php">Cart</a></li>
            </ul>
        </nav>
         <section>
            <div>
                <h3>Ladle</h3>
                <p>Ladle Description</p>
                <button onclick="addToCart('Ladle');">Add to Cart</button>
            </div>
             
             <div>
                <h3>Spoon</h3>
                <p>Spoon Description</p>
                <button onclick="addToCart('Spoon');">Add to Cart</button>
            </div>
        </section>
    </body>
</html>