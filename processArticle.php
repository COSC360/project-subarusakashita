<?php
session_start();
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

// Create connection
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
else{
echo "Connected successfully";
}

$title = $_POST["newArticleTitle"];
if($_POST["category"]==="Academic"){
    $category = 1;
}
else if($_POST["category"]==="Lifestyle"){
    $category = 2;
}

$tag=$_POST["tag"];
if($_POST["tag"] === "Professor"){
    $tag = 1;
}else if($_POST["tag"]==="Course"){
    $tag = 2;
}else if($_POST["tag"]==="Study"){
    $tag = 3;
}else if($_POST["tag"]==="Laundry"){
    $tag = 4;
}else if($_POST["tag"]==="Emergencies"){
    $tag = 5;
}else if($_POST["tag"]==="Cooking"){
    $tag = 6;
}else if($_POST["tag"]==="Grocery"){
    $tag = 7;
}

$body = $_POST["newArticleBody"];
$username = $_SESSION['username'];
// $sql = "INSERT INTO Articles(articleTitle, username, categoryId, tagId, articleBody) VALUES ('$title','$username','$category','$tag','$body')";
// if (mysqli_query($conn, $sql)) {
//     header("Location: main.php");
//     exit;
// }
// else{
//     $error = "Article Upload failed";
// }


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
    $sql = "INSERT INTO Articles(articleTitle, username, categoryId, tagId, articleBody) VALUES (?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $title);
    $statement->bindValue(2, $username);
    $statement->bindValue(3, $category);
    $statement->bindValue(4, $tag);
    $statement->bindValue(5, $body);
    $statement->execute();
    echo '<script>alert("Article Published");</script>';
} catch (Exception $e) {
    echo '<script>alert("Error publishing article");</script>';
}


mysqli_close($conn);
?>
