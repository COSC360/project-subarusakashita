
<?php
  mb_internal_encoding("UTF-8");
  $to = $_POST['to'];
  $title = $_POST['title'];
  $content = "Content: ".$_POST['content'];
  if (!empty($_POST["name"])) {
    echo '<script>alert("Here?!!");</script>';
    $name = strip_tags($_POST["name"]);
    $email = strip_tags($_POST["email"]);
    $content = $content."\nFrom Name: ".$name."\nEmail: ".$email;
}
else{
      session_start();
      $content = $content."\nFrom username: ".$_SESSION['username'];
  }

  
  if(mb_send_mail($to, $title, $content)){
    echo "Mail successfully sent";
    echo '<script>window.location.href = "main.php"; </script>';
  } else {
    echo "Sending failed";
  };
?>
