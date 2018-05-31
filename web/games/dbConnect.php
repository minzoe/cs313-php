<?php

function dbConnect() {
    $db = NULL;
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
    return $db;
}