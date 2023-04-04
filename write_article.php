<?php
session_start();
$username = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $server_username, $server_password, $dbname);
$txtOne = "";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql1 = "SELECT * FROM users WHERE username='$username'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($row['isDisabled' === '1']) {
            // if user account is disabled
            echo '<script>alert("Account is disabled");</script>';
            header("Location: main.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p>
            <a href="main.php">Main Page</a> >
            <a href="profile.php? <?php echo ($username) ?>">Profile Page</a> >
            <a href="write_article.php">Write Article Page</a>
        </p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('</div>');
    ?>

    <div id="right">
        <h2>Write new article</h2>
        <div id="article">
            <form method="post" action="processArticle.php">
                <fieldset>
                    <label for="newArticleTitle">Article title</label>
                    <input type="text" id="newArticleTitle" name="newArticleTitle" placeholder="Write article title"
                        required>
                    <br>
                    <br>

                    <label for="category">Choose Category</label>
                    <select name="category" id="category" onchange="showTags()" required>
                        <option value="">-- Select Category --</option>
                        <option value="Academic">Academic</option>
                        <option value="Lifestyle">Lifestyle</option>
                    </select>
                    <br>
                    <br>
                    <label for="tag">Choose Tag</label>
                    <select name="tag" id="tag" required>
                        <option value="">-- Select Tag --</option>
                    </select>
                    <br>
                    <br>

                    <?php include "include/ad_long.php"; ?>
                    <br>
                    <br>

                    <label for="newArticleBody">Article body</label>
                    <textarea id="newArticleBody" name="newArticleBody" rows="5" cols="100"
                        placeholder="Write article body here" required></textarea>
                    <br>
                    <br>

                    <input type="submit" value="Post article">
                </fieldset>
            </form>
            <script>
                function showTags() {
                    let category = document.getElementById("category").value;
                    let tagDropdown = document.getElementById("tag");
                    tagDropdown.innerHTML = "";

                    let tags = [];
                    if (category === "Academic") {
                        tags = ["COSC360", "Prof", "Course", "Study"];
                    } else if (category === "Lifestyle") {
                        tags = ["Dog", "UBC", "Subway", "Laundry", "Emergency", "Cooking", "Grocery", "Event"];
                    }
                    for (let i = 0; i < tags.length; i++) {
                        let option = document.createElement("option");
                        option.value = tags[i];
                        option.text = tags[i];
                        tagDropdown.appendChild(option);
                    }
                }
            </script>

        </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>