<?php
if (isset($_POST['submit'])) {
  $image = $_FILES['image'];

  // Check if file is an image
  $fileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
  if (!in_array($fileType, array('jpg', 'jpeg', 'png', 'gif'))) {
    die("File is not an image.");
  }
  
  // Generate unique file name
  $fileName = uniqid() . '.' . $fileType;

  // Set upload directory
  $uploadDir = "uploads/";
  
  // Move file to upload directory
  if (!move_uploaded_file($image['tmp_name'], $uploadDir . $fileName)) {
    die("Error uploading file.");
  }
  
  echo "File uploaded successfully!";
}
?>

<form method="post" enctype="multipart/form-data">
  <label>Select image to upload:</label>
  <input type="file" name="image">
  <button type="submit" name="submit">Upload</button>
</form>
