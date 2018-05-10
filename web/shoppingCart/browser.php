<?php
session_start();
?>
<!DOCUMENT html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Browse Items</title>
        <script>
            function addToCart($item) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    alert($item + "added to Cart");
                };
                xmlhttp.open("POST", "setCart.php?q=" + $item, true);
                xmlhttp.send();
            }
        </script>
    </head>
    
    <body>
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