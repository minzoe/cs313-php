<?php

session_start();
$current = 'user';

require_once 'dbConnect.php';

$db = dbConnect();

if (isset($_POST['Submit'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $query = "SELECT usersId, username, email FROM users WHERE email = :email AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->execute();
    $_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SESSION['user'] != NULL) {
    $id = $_SESSION['user']['usersid'];
    
    $query = "SELECT title FROM games WHERE usersid = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_STR);
    $stmt->execute();
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $savedQuery = "SELECT title FROM users u INNER JOIN savedGames s ON u.usersid = s.usersid INNER JOIN games g ON s.gamesid = g.gamesid WHERE u.usersid = :id";
    $state = $db->prepare($savedQuery);
    $state->bindValue(":id", $id);
    $state->execute();
    $saved = $state->fetchAll(PDO::FETCH_ASSOC);
}


   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin | Card Games</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel='stylesheet' href='main.css'>
    </head>
    
    <body>
        <?php include 'header.php' ?>
        <h1>User Admin</h1>
        
        <div>
            <?php 
                if (isset($_SESSION['user'])) {
                    echo "<h2>Users</h2> <p>Username: ".$_SESSION[user][username]."</p> <p>Email: ".$_SESSION[user][email]."</p>";
                } else {
                    echo "<form method='post' action='admin.php'>"
                    . "<label>Email:</lable><input type='email' name='email'>"
                            . "<label>Password:</label><input type='password' name='pass'>"
                            . "<input type='submit' name='Submit'>"
                            . "</form>";
                }
            ?>
        </div>
        
        <div>
            <?php
                if (isset($_SESSION['user'])) {
                    echo "<h2>Made Games</h2>";
                    foreach ($games as $game) {
                        echo "<h3>$game[title]</h3>";
                    }
                }
            ?>
        </div>
        
        <div>
            <?php
                if (isset($_SESSION['user'])) {
                    echo "<h2>Saved Games</h2>";
                    foreach ($saved as $sgame) {
                        echo "<h3>$sgame[title]</h3>";
                    }
                }
            ?>
        </div>
        
    </body>
</html>