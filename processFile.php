<?php
// Check if file was uploaded
if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
  // Get file information
  $file_name = $_FILES["image"]["name"];
  $file_tmp_name = $_FILES["image"]["tmp_name"];
  $file_size = $_FILES["image"]["size"];
  $file_type = $_FILES["image"]["type"];

  // Connect to database
  $servername = "cosc360.ok.ubc.ca";
  $username = "83395822";
  $password = "83395822";
  $dbname = "db_83395822";
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute SQL statement to insert file info
  $stmt = $conn->prepare("INSERT INTO images (file_name, file_path) VALUES (?, ?)");
  $stmt->bind_param("siss", $file_name, $file_path);
  $file_path = "uploads/" . $file_name;
  $stmt->execute();

  // Move uploaded file to desired location
  move_uploaded_file($file_tmp_name, $file_path);

  // Close database connection
  $stmt->close();
  $conn->close();

  // Return success message to user
  echo "File uploaded successfully.";
} else {
  // Return error message to user
  echo "Error uploading file: " . $_FILES["image"]["error"];
}
?>

