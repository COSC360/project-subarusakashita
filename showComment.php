<?php
    $sql = "SELECT username, commentBody FROM Comments WHERE articleId = '$articleId'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<p>". $row["username"] .": ". $row["commentBody"] ."</p>";
           
        }
    } else {
        echo "No comments. Comment!!";
    }
    
?>