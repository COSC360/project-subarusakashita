<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <?php
      mb_internal_encoding("UTF-8");
      $to = $_POST['to'];
      $title = $_POST['title'];
      $content = $_POST['content'];
      if (!empty($_POST["name"])) {
        $content = $content."<br> From username: ".$name;
    } 
     
      if(mb_send_mail($to, $title, $content)){
        echo "Mail successfully sent";
        header ("Location: main.php");
      } else {
        echo "Sending failed";
      };
    ?>
  </body>
</html>