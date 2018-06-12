<?php

session_start();
$current = 'user';

require_once 'dbConnect.php';

$db = dbConnect();

if (isset($_POST['Login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $query = "SELECT usersid, username, email, password FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    $hashCheck = password_verify($password, $user['password']);
    if ($hashCheck) {
        $_SESSION['user'] = $user;
    } else {
        $message = "Username or password is wrong";
        exit;
    }    
}

if (isset($_POST['newUser'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":username", $username, PDO::PARAM_STR);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->execute();
    $rowChange = $stmt->rowCount();
    if ($rowChange == 1) {
        $message = "User added please now login.";
    } else {
        $message = "There was an error please try again.";
    }
    $stmt->closeCursor();
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
    $stmt->closeCursor();
}


   
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin | Card Games</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel='stylesheet' href='main.css'>
        <script src="main.js"></script>
    </head>
    
    <body>
        <?php include 'header.php' ?>
        <div class="container">
        <h1>User Admin</h1>
        <p><?php if(isset($message)){echo $message;} ?></p>
        <div>
            <?php 
                if (isset($_SESSION['user'])) {
                    echo "<h2>Users</h2> <p>Username: ".$_SESSION[user][username]."</p> <p>Email: ".$_SESSION[user][email]."</p>";
                } else {
                    echo "<form method='post' action='admin.php' id='loginUser'>"
                    . "<label>Email:</label><input type='email' name='email'><br>"
                            . "<label>Password:</label><input type='password' name='pass'><br>"
                            . "<input type='submit' name='Login' value='Login' class='btn btn-primary'>"
                            . "</form>";
                    echo "<button id='showsignUpUser' onclick='showSignup()' class='btn btn-primary'>Sign Up</button>";
                    echo "<form method='post' action='admin.php' class='hide' id='signUpUser'>"
                            . "<label>Username:</label><input type='text' name='username'><br>"
                            . "<label>Email:</lable><input type='email' name='email'><br>"
                            . "<label>Password:</label><input type='password' name='pass'><br>"
                            . "<input type='submit' name='newUser' value='Create User' class='btn btn-primary'>"
                            . "</form>";
                    echo "<br><button id='showLoginUser' onclick='showLogin()' class='btn btn-primary'>Login Instead</button>";
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
        </div>
    </body>
</html>