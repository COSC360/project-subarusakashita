<?php
    $servername = "cosc360.ok.ubc.ca";
    $server_username = "83395822";
    $server_password = "83395822";
    $dbname = "db_83395822";

// Create connection
    $conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo($_POST['articleId']);
    echo($_POST['comment']);
?>