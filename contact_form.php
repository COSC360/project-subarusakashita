<?php
session_start();
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <script type="text/javascript" charset="UTF-8"></script>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }
    
    h2 {
      color: #333333;
    }
    
    form {
      background-color: #ffffff;
      border-radius: 5px;
      padding: 20px;
      width: 50%;
      margin: 0 auto;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    input[type="text"], textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
      resize: vertical;
    }
    
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
  </head>
  <body>
    <p>
      <h2>Contact Form</h2>
      <a href = "main.php">Go Back </a>
    </p>
    <form action="./confirm.php" method="post">
      <p>
        <?php 
          if (!isset($_SESSION['username'])) {
            echo '<script>alert("Currently, you are not logged in. Do you want to login first? Please ignore this message
            if you do not have an account");</script>';
            echo "<p> Your Name </p> <input type='text' name = 'name' required>";
            echo "<p> Email </p> <input type='text' name = 'email' required>";
        }
        else{
          echo "<p> Username is ".$_SESSION['username']."</p> <input type='hidden' name='username' value=".$_SESSION['username'];
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