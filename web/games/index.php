<?php

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


if (isset($_POST['Search'])) {
    $players = filter_input(INPUT_POST, 'players', FILTER_SANITIZE_NUMBER_INT);
    $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT);
    $decks = filter_input(INPUT_POST, 'decks', FILTER_SANITIZE_NUMBER_INT);
    $relaxed = filter_input(INPUT_POST, 'relax', FILTER_VALIDATE_BOOLEAN);
    $query = "SELECT title, description FROM games WHERE numOfPlayers = :players AND timeLength = :time OR IS NULL";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":players", $players, PDO::PARAM_INT);
    $stmt->bindValue(":time", $time, PDO::PARAM_INT);
//    $stmt->bindValue(":decks", $decks, PDO::PARAM_INT);
//    $stmt->bindValue(":relaxed", $relaxed, PDO::PARAM_BOOL);
    $stmt->execute();
    $searched = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($searched);
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
    </head>
    
    <body>
        <h1>Card Games</h1>
        <form method="POST" action="index.php">
            <label>Search by:</label>
            <label>Number of Players:</label><input name="players" type="number">
            <label>Time to Play:</label><input name="time" type="number">
            <label>Number of Decks Needed</label><input name="decks" type="number">
            <label>Relaxed:</label><input name="relax" type="checkbox">
            <input type="submit" name="Search">
        </form>
        
        <div>
            <?php 
                if(isset($_POST['Search'])) {
                    forEach ($searched as $game) {
                        echo "<div> <h2>$game[title]</h2> <p>$game[description]</p>";
                        }
                } else {
                    forEach ($allGames as $game) {
                        echo "<div> <h2>$game[title]</h2> <p>$game[description]</p>";
                        }
                }
            ?>
        </div>
        
    </body>
</html>