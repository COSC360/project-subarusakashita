<?php
// Database configuration
$servername = "cosc360.ok.ubc.ca";
$username = "83395822";
$password = "83395822";
$dbname = "db_83395822";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle image upload
if (isset($_POST['submit'])) {
  $image = $_FILES['image'];
  
  // Check if file is an image
  $fileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
  if (!in_array($fileType, array('jpg', 'jpeg', 'png', 'gif'))) {
    die("File is not an image.");
  }
  
  // Generate unique file name
  $fileName = uniqid() . '.' . $fileType;
  
  // Move file to server
  $uploadDir = "uploads/";
  $uploadPath = $uploadDir . $fileName;
  move_uploaded_file($image['tmp_name'], $uploadPath);
  
  // Insert file name and path into database
  $sql = "INSERT INTO images (file_name, file_path) VALUES ('$fileName', '$uploadPath')";
  $conn->query($sql);
}

// Display uploaded images from database
$sql = "SELECT file_name, file_path FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $fileName = $row['file_name'];
    $filePath = $row['file_path'];
    echo "<img src=\"$filePath\" alt=\"$fileName\" />";
  }
} else {
  echo "No images found";
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Image Uploader</title>
</head>
<body>
  <h1>Image Uploader</h1>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="image" />
    <button type="submit" name="submit">Upload</button>
  </form>
</body>
</html>
