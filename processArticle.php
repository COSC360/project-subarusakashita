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
} else {
    if (isset($_POST["newArticleBody"])) {
        $body = $_POST["newArticleBody"];
    } else {
        header("Location: main.php");
        exit;
    }

    $username = null;
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header("Location: login.php");
        exit;
    }

    $sql1 = "SELECT * FROM users WHERE username='$username'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            if ($row['isDisabled'] === '1') {
                // if user account is disabled
                echo '<script>alert("Account is disabled");</script>';
                header("Location: main.php");
                exit;
            }
        }
    }
    // user account is not disabled

    $title = null;
    if ($_POST["category"] === "Academic") {
        $category = 1;
    } else if ($_POST["category"] === "Lifestyle") {
        $category = 2;
    }

    $tag = null;
    if ($_POST["tag"] === "COSC360") {
        $tag = 1;
    } else if ($_POST["tag"] === "Dog") {
        $tag = 2;
    } else if ($_POST["tag"] === "UBC") {
        $tag = 3;
    } else if ($_POST["tag"] === "Subway") {
        $tag = 4;
    } else if ($_POST["tag"] === "Prof") {
        $tag = 5;
    } else if ($_POST["tag"] === "Course") {
        $tag = 6;
    } else if ($_POST["tag"] === "Study") {
        $tag = 7;
    } else if ($_POST["tag"] === "Laundry") {
        $tag = 8;
    } else if ($_POST["tag"] === "Emergency") {
        $tag = 9;
    } else if ($_POST["tag"] === "Cooking") {
        $tag = 10;
    } else if ($_POST["tag"] === "Grocery") {
        $tag = 11;
    } else if ($_POST["tag"] === "Event") {
        $tag = 12;
    }

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);

        $sql2 = "INSERT INTO Articles(articleTitle, username, categoryId, tagId, articleBody, commentNum, isDisabled) VALUES (?,?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(1, $title);
        $statement->bindValue(2, $username);
        $statement->bindValue(3, $category);
        $statement->bindValue(4, $tag);
        $statement->bindValue(5, $body);
        $statement->bindValue(6, 0);
        $statement->bindValue(7, 0);
        $statement->execute();

        $sql3 = "UPDATE Tags SET articleNumber = articleNumber+1 WHERE tagId=?";
        $statement = $pdo->prepare($sql3);
        $statement->bindValue(1, $tag);
        $statement->execute();

        echo '<script>alert("Article Published");</script>';
    } catch (Exception $e) {
        echo '<script>alert("Error publishing article");</script>';
    }

    mysqli_close($conn);
}
echo "Back to <a href='profile.php?username=" . $username . "'>Profile Page</a>";

?>