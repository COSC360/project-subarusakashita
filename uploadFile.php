<!DOCTYPE html>
<html>
<head>
  <title>Image Gallery</title>
</head>
<body>
  <h1>Image Gallery</h1>
  
  <?php
  // Connect to database
  $servername = "cosc360.ok.ubc.ca";
  $username = "83395822";
  $password = "83395822";
  $dbname = "db_83395822";
  
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  // Insert form data into database
  if (isset($_POST['submit'])) {
    $filename = $_FILES['image']['name'];
    $filepath = $_FILES['image']['tmp_name'];
    $destination = "uploads/" . $filename;
    
    if (!empty($filename)) {
      if (move_uploaded_file($filepath, $destination)) {
        $sql = "INSERT INTO images (file_name, file_path) VALUES ('$filename', '$destination')";
        if ($conn->query($sql) === TRUE) {
          echo "<p>Image uploaded successfully</p>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      } else {
        echo "<p>There was an error uploading the file</p>";
      }
    } else {
      echo "<p>Please select an image to upload</p>";
    }
  }
  
  // Display images from database
  $sql = "SELECT id, file_name, file_path FROM images";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $id = $row['id'];
      $filename = $row['file_name'];
      $filepath = $row['file_path'];
      echo "<div>";
      echo "<img src=\"$filepath\" alt=\"$filename\">";
      echo "<p>$filename</p>";
      echo "</div>";
    }
  } else {
    echo "<p>No images found</p>";
  }
  
  $conn->close();
  ?>
  
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
  </form>
</body>
</html>
