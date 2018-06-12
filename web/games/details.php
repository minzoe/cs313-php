<?php
session_start();

require_once 'dbConnect.php';
$db = dbConnect();

$id = filter_input(INPUT_GET, 'gameId', FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT title, description, instructions, numofplayers, timelength, numofdecks, relaxed FROM games WHERE gamesid = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
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
        <h1><?php echo $game['title'];?></h1>
        <p><strong>Minimum Number of Players:</strong> <?php echo $game['numOfPlayers'];?></p>
        <p><strong>Maximum Time Length:</strong> <?php echo $game['timeLength'];?></p>
        <p><strong>Max Number of Decks:</strong> <?php echo $game['numOfDecks'];?></p>
        <p><strong>Relaxed?:</strong> <?php echo $game['relaxed'];?></p>
        <p><strong>Description:</strong> <?php echo $game['description'];?></p>
        <p><strong>Instructions:</strong> <?php echo $game['instructions'];?></p>
        </div>
    </body>
</html>

