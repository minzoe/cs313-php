<!DOCTYPE html>
<?php
session_start();
$current = 'projects';
?>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel='stylesheet' href='main.css'>
        <title>Projects</title>
    </head>

    <body>
        <?php include 'header.php' ?>
        <div class="container-fluid text-center">
            <div class="row content">
                <div class="col-sm-2 sidenav">
                </div>
                <div class="col-sm-8 text-left">
                    <h2>Projects</h2>
                    <ul>
                        <li><a href="shoppingCart/browse.php">Shopping</a></li>
                        <li><a href="games/index.php">Final Project</a></li>
                    </ul>
                </div>
                <div class="col-sm-2 sidenav">
                </div>
            </div>
            <footer class="container-fluid text-center">
            </footer>
        </div>
    </body>

    </html>