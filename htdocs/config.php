
<?php
    $servername = "localhost";
    $username = "root";
    $dbname = "maindata";
    $password = "123";
    $connection = new mysqli($servername, $username, $password);
    if ($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
    }
    $sql = "CREATE DATABASE $dbname";
    if ($connection->query($sql) === TRUE){
        echo "Database created successfully";
    }
    else{
        echo "Error creating database: " . $connection->error;
    }
    try{
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE user_data (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    username VARCHAR(255) NOT NULL,
                                    email VARCHAR(255) NOT NULL,
                                    verified TINYINT(1) NOT NULL DEFAULT '0',
                                    notif TINYINT(1) NOT NULL DEFAULT '1',
                                    token VARCHAR(255) DEFAULT NULL,
                                    password VARCHAR(255))";
        $connection->exec($sql);
        echo "Userdata TABLE CREATED [X] <br>";

        $sql = "CREATE TABLE images (id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                    username VARCHAR(255) NOT NULL,
                                    likes INT(1) NOT NULL DEFAULT '0',
                                    data LONGTEXT DEFAULT NULL,
                                    crdate DATETIME)";
        $connection->exec($sql);
        echo "images TABLE CREATED [X] <br>";

        $sql = "CREATE TABLE comment (id INT(11) NOT NULL,
                                    comment VARCHAR(255) NOT NULL)";
            
        $connection->exec($sql);
        echo "Comment TABLE CREATED [X] <br>";
    }
    catch(PDOException $e)
    {
      echo "Error";
    }
    ?>
