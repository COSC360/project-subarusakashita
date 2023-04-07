<?php
session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" charset="UTF-8"></script>
  </head>
  <body>
    <p>
      <h2>Contact Form</h2>
    </p>
    <form action="./confirm.php" method="post">
      <p>
        <?php 
          if (!isset($_SESSION['username'])) {

            echo "<p> Your Name </p> <input type='text' name = 'name'";
        }
        else{
          echo "<p> Username is ".$_SESSION['username']."</p>";
        }
        ?>
      </p>
      <input type="hidden" name= "to" value="baruchan@student.ubc.ca">
      <p>
        Title 
      </p>
      <input type="text" name="title">
      <p>
        Content
      </p>
      <textarea name="content" cols="50" rows="5"></textarea>
      <p>
        <input type="submit" name="send" value="Send">
      </p>
    </form>
  </body>
</html>