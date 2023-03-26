<?php
    $sqlcomment = "SELECT username, commentBody FROM Comments";
    $resultcomment = mysqli_query($conn, $sqlcomment);
    var_dump($resultcomment);
    if (mysqli_num_rows($resultcomment) > 0) {
        while($row = mysqli_fetch_assoc($resultcomment)) {
            echo "<p>". $row["username"] .": ". $row["commentBody"] ."</p>";
           
        }
    } else {
        echo "No comments. Comment!!";
        echo $articleId;
    }
    
?>