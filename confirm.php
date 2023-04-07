
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
  $username = $_POST["username"];
  $sql = "SELECT email FROM users WHERE username = '$username' ";
  $result = mysqli_query($conn, $sql);
  echo '<script>alert('.$username.');</script>';
  if ($result) {
    echo '<script>alert("Checking!!");</script>';
      $row = mysqli_fetch_assoc($result);
      $email = $row['email'];
      $content = $content."\nFrom Name: ".$username."\nEmail: ".$email;
  }
}
  
  if(mb_send_mail($to, $title, $content)){
    echo "Mail successfully sent";
    echo '<script>window.location.href = "main.php"; </script>';
  } else {
    echo "Sending failed";
  };
?>
