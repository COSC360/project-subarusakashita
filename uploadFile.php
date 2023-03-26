<?php
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $formName = $_POST['formName'];
  $formPath = $_FILES['formFile']['tmp_name'];
  $formType = $_FILES['formFile']['type'];
  
  // Check if file is an image
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (!in_array($formType, $allowedTypes)) {
    die('Error: File must be an image (JPEG, PNG, or GIF)');
  }
  
  // Insert form name and path into database
  $servername = "cosc360.ok.ubc.ca";
  $username = "83395822";
  $password = "83395822";
  $dbname = "db_83395822";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "INSERT INTO images (file_name, file_path) VALUES ('$formName', '$formPath')";
  if ($conn->query($sql) === TRUE) {
    echo "Form submitted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Form</title>
</head>
<body>
  <h1>Upload Form</h1>
  <form method="post" enctype="multipart/form-data">
    <label for="formName">Form Name:</label>
    <input type="text" name="formName" required>
    <br>
    <label for="formFile">Select an image file:</label>
    <input type="file" name="formFile" accept="image/*" required>
    <br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
