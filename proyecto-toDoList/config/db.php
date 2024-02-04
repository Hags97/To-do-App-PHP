<?php

    $host = "localhost";
    $dbname = "toDoApp";
    $user = "root";
    $pass = "";

    try{
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user,$pass);
    }
    catch(PDOException $error)
    {
        echo "Error: " . $error->getMessage();
        die();
    }
?>


