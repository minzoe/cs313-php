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
        <h1><?php $game['title'];?></h1>
        <p>Minimum Number of Players: <?php $game['numOfPlayers'];?></p>
        <p>Maximum Time Length: <?php $game['timeLength'];?></p>
        <p>Max Number of Decks: <?php $game['numOfDecks'];?></p>
        <p>Relaxed?: <?php $game['relaxed'];?></p>
        <p>Description: <?php $game['description'];?></p>
        <p>Instructions: <?php $game['instructions'];?></p>
        </div>
    </body>
</html>

