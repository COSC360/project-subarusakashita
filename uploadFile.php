<script>
function validateForm() {
  var imageField = document.getElementById("image");
  var file = imageField.files[0];
  if (!file || !file.type.match('image.*')) {
    alert("Please select an image file.");
    return false;
  }
  return true;
}
</script>

<form action="processFile.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
  <label for="image">Select an image:</label>
  <input type="file" id="image" name="image" accept="image/*">
  <br>
  <input type="submit" value="Submit">
</form>
