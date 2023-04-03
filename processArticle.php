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
    if (!isset($_POST["newArticleBody"]) || !isset($_SESSION['username'])) {
        header("Location: main.php");
        exit;
    }
    $body = $_POST["newArticleBody"];
    $username = $_SESSION['username'];

    $sql1 = "SELECT * FROM users WHERE username='$username'";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row = mysqli_fetch_assoc($result1)) {
            if ($row['isDisabled === 1']) {
                // if user account is disabled
                echo '<script>alert("Account is disabled");</script>';
                header("Location: main.php");
                exit;
            }
        }
    }
    // user account is not disabled

    $title = $_POST["newArticleTitle"];
    if ($_POST["category"] === "Academic") {
        $category = 1;
    } else if ($_POST["category"] === "Lifestyle") {
        $category = 2;
    }

    $tag = $_POST["tag"];
    if ($_POST["tag"] === "Professor") {
        $tag = 1;
    } else if ($_POST["tag"] === "Course") {
        $tag = 2;
    } else if ($_POST["tag"] === "Study") {
        $tag = 3;
    } else if ($_POST["tag"] === "Laundry") {
        $tag = 4;
    } else if ($_POST["tag"] === "Emergencies") {
        $tag = 5;
    } else if ($_POST["tag"] === "Cooking") {
        $tag = 6;
    } else if ($_POST["tag"] === "Grocery") {
        $tag = 7;
    }

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);

        $sql2 = "INSERT INTO Articles(articleTitle, username, categoryId, tagId, articleBody, commentNum) VALUES (?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(1, $title);
        $statement->bindValue(2, $username);
        $statement->bindValue(3, $category);
        $statement->bindValue(4, $tag);
        $statement->bindValue(5, $body);
        $statement->bindValue(6, 0);
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