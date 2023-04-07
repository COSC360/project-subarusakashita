
<?php
  mb_internal_encoding("UTF-8");
  $to = $_POST['to'];
  $title = $_POST['title'];
  $content = "Content: ".$_POST['content'];
  if (!empty($_POST["name"])) {
    $name = strip_tags($_POST["name"]);
    $email = strip_tags($_POST["email"]);
    $content = $content."\nFrom Name: ".$name."\nEmail: ".$email;
}
else{
  echo '<script>alert("Checking!!");</script>';
  $username = $_POST["username"];
  $sql = "SELECT email FROM users WHERE username = '$username' ";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      $row = mysqli_fetch_assoc($result);
      $email = $row['email'];
      $content = $content."\nFrom Name: ".$username."\nEmail: ".$email;
  }
}
  
  if(mb_send_mail($to, $title, $content)){
    echo "Mail successfully sent";
    header ("Location: main.php");
  } else {
    echo "Sending failed";
  };
?>
