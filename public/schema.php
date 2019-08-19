<?php

$data = json_decode(file_get_contents('data.json'));

$link = mysqli_connect('localhost', $data->user, $data->pass);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_selected = mysqli_select_db($link, $data->dbname);

if (!$db_selected) {
    // If we couldn't, then it either doesn't exist, or we can't see it.
    $sql = "CREATE DATABASE $data->dbname";
  
    if (mysqli_query($link, $sql)) {
        echo "Database my_db created successfully\n";
    } else {
        echo 'Error creating database: ' . mysqli_error($link) . "\n";
    }
}
  
  mysqli_close($link);

if ($argv[1] === "delete-schema") {
    try {
        $db = new \PDO("mysql:host=$data->host;dbname=$data->dbname", $data->user, $data->pass);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $deleteStatement = "DROP TABLE IF EXISTS User";
        $STH = $db->prepare($deleteStatement);
        $STH->execute();
        
        $db = null;
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}

if ($argv[1] === "create-schema") {
    try {
        $db = new \PDO("mysql:host=$data->host;dbname=$data->dbname", $data->user, $data->pass);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $deleteStatement = "DROP TABLE IF EXISTS User";
        $STH = $db->prepare($deleteStatement);
        $STH->execute();

        $createStatement = "CREATE TABLE User (
            id INT PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(100) NOT NULL UNIQUE,
            fullName VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            passwd VARCHAR(150) NOT NULL,
            phone VARCHAR(13) NOT NULL,
            gender ENUM('m','f','o'),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $STH = $db->prepare($createStatement);
        $STH->execute();
        
        $db = null;
    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}
