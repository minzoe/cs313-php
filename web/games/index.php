<?php

session_start();
$current = 'home';

require_once 'dbConnect.php';

$db = dbConnect();


if (isset($_POST['Search'])) {
    $players = filter_input(INPUT_POST, 'players', FILTER_SANITIZE_NUMBER_INT);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT);
    $decks = filter_input(INPUT_POST, 'decks', FILTER_SANITIZE_NUMBER_INT);
    $relaxed = filter_input(INPUT_POST, 'relax', FILTER_VALIDATE_BOOLEAN);
    $query = "SELECT title, description FROM games WHERE numOfPlayers = :players AND timeLength = :time AND numOfDecks = :decks AND relaxed = :relaxed";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":players", $players, PDO::PARAM_INT);
    $stmt->bindValue(":time", $time, PDO::PARAM_INT);
    $stmt->bindValue(":decks", $decks, PDO::PARAM_INT);
    $stmt->bindValue(":relaxed", $relaxed, PDO::PARAM_BOOL);
    $stmt->execute();
    $searched = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = "SELECT title, description FROM games";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $allGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Card Games</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel='stylesheet' href='main.css'>
    </head>
    
    <body>
        <?php include 'header.php' ?>
        <div class="container">
        <h1>Card Games</h1>
        <form method="POST" action="index.php">
            <label>Search by: </label><br>
            <label>Max Number of Players:</label><input name="players" type="number" required><br>
            <label>Time to Play: </label><input name="time" type="number" required><br>
            <label>Number of Decks Needed: </label><input name="decks" type="number" required><br>
            <label>Relaxed: </label><input name="relax" type="checkbox">
            <input type="submit" name="Search">
        </form>
        
        <div>
            <?php 
                if(isset($_POST['Search'])) {
                    forEach ($searched as $game) {
                        echo "<div class='panel panel-default'> <h2 class='panel-heading'>$game[title]</h2> <p class='panel-body'>$game[description]</p>";
                        }
                } else {
                    forEach ($allGames as $game) {
                        echo "<div class='panel panel-default'> <h2 class='panel-heading'>$game[title]</h2> <p class='panel-body'>$game[description]</p>";
                        }
                }
            ?>
        </div>
        </div>
    </body>
</html>