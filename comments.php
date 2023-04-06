<?php
if (isset($_GET["articleId"])) {
    $articleId = $_GET["articleId"];
    // rest of the code
    $sql4 = "SELECT * FROM Comments WHERE articleId = '$articleId'";
    $result4 = mysqli_query($conn, $sql4);
    echo ("<br><h2>Comments</h2>");
    echo("<div id = 'showcomments'>");
    //echo ("<h3><a href='write_comment.php?articleId=" . $articleId . "'>[Post new comment]</a></h3>");
    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            echo ('<h3>' . $row["username"] . ' - ' . $row["commentBody"] . '</h3>');
        }
    } else {
        echo "No comments yet";
    }
    echo("</div>");
  } else {
    echo "articleId is not set";
  }

?>