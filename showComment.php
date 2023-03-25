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
    $sql = "SELECT username, commentBody FROM Comments WHERE articleId = '$articleId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>". $row["username"] .": ". $row["commentBody"] "</p>";
           
        }
    } else {
        echo "No comments. Comment!!";
    }
    mysqli_close($conn);
    
?>