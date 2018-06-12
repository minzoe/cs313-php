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
    $query = "SELECT title, description, gamesid FROM games WHERE numOfPlayers = :players AND timeLength = :time AND numOfDecks = :decks AND relaxed = :relaxed";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":players", $players, PDO::PARAM_INT);
    $stmt->bindValue(":time", $time, PDO::PARAM_INT);
    $stmt->bindValue(":decks", $decks, PDO::PARAM_INT);
    $stmt->bindValue(":relaxed", $relaxed, PDO::PARAM_BOOL);
    $stmt->execute();
    $searched = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} else {
    $query = "SELECT title, description, gamesid FROM games";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $allGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
}

if (isset($_POST['addGame'])) {
    $gameId = filter_input(INPUT_POST, 'gameId', FILTER_SANITIZE_EMAIL);
    $userId = $_SESSION['user']['usersid'];
    $query = "INSERT INTO savedGames (usersid, gamesid) VALUES (:usersId, :gamesId)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":usersId", $userId, PDO::PARAM_STR);
    $stmt->bindValue(":gamesId", $gameId, PDO::PARAM_STR);
    $stmt->execute();
    $rowChange = $stmt->rowCount();
    if($rowChange === 1) {
        $message = "Game Added";
    }
    $stmt->closeCursor();
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
        <form method="POST" action="index.php" class="col-sm-8">
            <label>Search by: </label><br>
            <div>
                <label class="pull-left">Max Number of Players: </label><input name="players" type="number" required class="pull-right"><br>
            </div>
            <div>
            <label class="pull-left">Max Time to Play: </label><input name="time" type="number" required class="pull-right"><br></div>
            <div>
            <label class="pull-left">Max Number of Decks Needed: </label><input name="decks" type="number" required class="pull-right"><br></div>
            <div>
            <label class="pull-left">Is Game Relaxed?: </label><input name="relax" type="checkbox" class="pull-right"><br>
            </div>
            <input type="submit" name="Search" class="btn btn-primary">
        </form>
        <p><?php if(isset($message)){echo $message;}?></p>
        <div>
            <?php 
                if(isset($_POST['Search'])) {
                    forEach ($searched as $game) {
                        echo "<div class='panel panel-default'><div class='panel-heading'>$game[title] ";
                        if($_SESSION['user']) {
                            echo "<form method='POST' action='index.php'>"
                            . "<input type='hidden' name='gameId' value='$game[gamesid]'><input type='submit' name='addGame' value='Save Game'>"
                            . "</form>";
                        };
                        echo "</div> <div class='panel-body'>$game[description]</div> </div>";
                        }
                } else {
                    forEach ($allGames as $game) {
                        echo "<div class='panel panel-default'><div class='panel-heading'>$game[title]";
                        if($_SESSION['user']) {
                            echo "<form method='POST' action='index.php'>"
                            . "<input type='hidden' name='gameId' value='$game[gamesid]'><input type='submit' name='addGame' value='Save Game'>"
                            . "</form>";
                        };
                        echo "</div> <div class='panel-body'>$game[description]</div> </div>";
                        }
                }
            ?>
        </div>
        </div>
    </body>
</html>