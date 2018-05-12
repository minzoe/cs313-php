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
            function addToCart($item) {
                var xmlhttp = new XMLHttpRequest();
                
                xmlhttp.open("GET", "setCart.php?q=" + $item, true);
                xmlhttp.send();
                alert(item + " has been added to the cart");
            }
        </script>
    </head>
    
    <body>
        <nav>
            
        </nav>
         <section>
            <div>
                <h3>Ladle</h3>
                <p>Ladle Description</p>
                <button onclick="addToCart('Ladle')">Add to Cart</button>
            </div>
             
             <div>
                <h3>Spoon</h3>
                <p>Spoon Description</p>
                <button>Add to Cart</button>
            </div>
        </section>
    </body>
</html>