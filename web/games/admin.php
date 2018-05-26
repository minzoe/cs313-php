<?php

session_start();
$current = 'user';

try
{
    $dbUrl = getenv('DATABASE_URL');
    $dbJSON = parse_url($dbUrl);
    
    $dbHost = $dbJSON["host"];
    $dbPort = $dbJSON["port"];
    $dbUser = $dbJSON["user"];
    $dbPassword = $dbJSON["pass"];
    $dbName = ltrim($dbJSON["path"],'/');
    
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}

if (isset($_SESSION['usersID'])) {
    $id = $_SESSION['usersId'];
    $userQ = "SELECT username, email FROM users WHERE u.userId = :id";
    $stmt = $db->prepare($userQ);
    $stmt->bindValue(":id", $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
}

if (isset($_POST['Submit'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
    $query = "SELECT usersId FROM users WHERE email = :email AND password = :password limit 1";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->bindValue(":password", $password, PDO::PARAM_STR);
    $stmt->execute();
    $_SESSION['usersId'] = $stmt->fetch(PDO::FETCH_ASSOC);
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
                if (isset($_SESSION['usersId'])) {
                    echo "<h2>Users</h2> <p>Username: $user[username]</p> <p>Email: $user[email]</p>";
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
                if (isset($_SESSION['usersId'])) {
                    echo "<h2>Made Games</h2>";
                    echo "<p>$user[title]</p>";
                }
            ?>
        </div>
        
    </body>
</html>