<?php
// record count every time page loads (to display top viewed articles in main page)
session_start();
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$articleId = null;
if (isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
}

$user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/article.css">
    <style>
        div#right img#profile {
            height: 7em;
            width: 7em;
            border-radius: 50%;
            padding-left: 0em;
            margin-left: 0em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#comment-form').submit(function (event) {
                event.preventDefault();

                var comment = $('#comment').val(); // Get the value of the comment field
                var username = $('input[name="username"]').val(); // Get the value of the username field
                var articleId = $('input[name="articleId"]').val(); // Get the value of the articleId field
                // alert("Comment is" + comment);
                // alert("articleId is "+ articleId);
                $('#showcomments').load("processComment.php", {
                    articleId: articleId,
                    comment: comment,
                    username: username
                })
                    .done(function (response) {
                        console.log(response);
                        // Handle the response from the server here
                    })
                    .fail(function (xhr, status, error) {
                        console.error(error);
                    });
            });
        });
    </script>

    <script>

        setInterval(function () {
            var articleId = <?php echo $articleId; ?>;
            $.ajax({
                url: 'comments.php',
                type: 'GET',
                data: {
                    articleId: articleId
                },
                success: function (response) {
                    $('#showcomments').html(response);

                }
            });
        }, 5000); // Update every 5 seconds
    </script>
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='article.php?articleId=<?php echo $articleId; ?>'>Article Page</a>
        </p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>

    <div id="right">
        <?php
        if (isset($_GET['articleId'])) {
            $categoryId = "";
            $artDisabled = "";
            $authorUsername = "";
            $artBody = "<h3>This article is disabled by administrator</h3>";

            // Article 
            $sql1 = "SELECT * FROM Articles WHERE articleId =  '$articleId'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo "<h2>" . $row["articleTitle"] . "</h2>
                        <h3>Author: " . $row['username'] . "</h3>
                        Category ID: " . $row['categoryId'] . " <br>
                        Tag ID: " . $row['tagId'] . "<br>";

                    $categoryId = $row['categoryId'];
                    $authorUsername = $row['username'];

                    if ($row['isDisabled'] === '1') {
                        $artDisabled = '1';
                    } else {
                        $artBody = "<p>" . $row["articleBody"] . "</p>";
                    }
                }
            }

            // author profile image
            $sql2 = "SELECT fileType, fileContent FROM Images WHERE username=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql2);
            mysqli_stmt_bind_param($stmt, "s", $authorUsername);
            $result6 = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
            mysqli_stmt_bind_result($stmt, $type, $image);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            echo '<img id="profile" src="data:image/' . $type . ';base64,' . base64_encode($image) . '"/>';

            include "include/ad_long.php";
            echo $artBody;


            // //follow button
            // $sql2 = "SELECT following FROM Users WHERE username = ?";
            // $result2 = mysqli_query($conn, $sql2, array());
            // $sql3 = "INSERT INTO Users (following) VALUES (?) WHERE username = ?";
        
            // //comments
            // $sql4 = "SELECT username, commentBody FROM Comments WHERE articleId = ?";
            // $result4 = mysqli_query($conn, $sql4, array());
        
            if ($artDisabled !== '1') {
                // Show Comments
        
                $sql4 = "SELECT * FROM Comments WHERE articleId = '$articleId'";
                $result4 = mysqli_query($conn, $sql4);
                echo ("<br><h2>Comments</h2>");
                echo ("<div id = 'showcomments'>");
                //echo ("<h3><a href='write_comment.php?articleId=" . $articleId . "'>[Post new comment]</a></h3>");
                if (mysqli_num_rows($result4) > 0) {
                    while ($row = mysqli_fetch_assoc($result4)) {
                        echo ('<h3>' . $row["username"] . ' - ' . $row["commentBody"] . '</h3>');
                    }
                } else {
                    echo "No comments yet";
                }
                echo ("</div>");


                // Write Comment
                $userDisabled = null;
                $sql5 = "SELECT * FROM users WHERE username='$user'";
                $result5 = mysqli_query($conn, $sql5);
                if (mysqli_num_rows($result5) > 0) {
                    while ($row = mysqli_fetch_assoc($result5)) {
                        $userDisabled = $row['isDisabled'];
                    }
                }
                if (isset($user) && $userDisabled !== '1') {
                    $articleId = $_GET['articleId'];
                    // if logged in
                    echo '<form id="comment-form">
                      <input type="text" id="comment" name="comment" placeholder="Write comment here" required>
                      <input type = "hidden" name = "username" value = echo $user >
                      <input type = "hidden" name = "articleId" value = "' . $articleId . '" >
                      <br>
                      <br>
                      <input type="submit" value="Comment">
                      </form>';
                }

            }
            // Related articles
            $sql6 = "SELECT * FROM Articles WHERE categoryId = '$categoryId' ORDER BY commentNum LIMIT 3";
            $result6 = mysqli_query($conn, $sql6);
            echo ("<br><h2>Related Articles</h2>");
            if (mysqli_num_rows($result6) > 0) {
                while ($row = mysqli_fetch_assoc($result6)) {
                    echo ('<h3><a href="article.php?articleId=' . $row["articleId"] . '">' . $row["articleTitle"] . '</a></h3>');
                }
            }

        } else {
            echo "Article not found";
        }
        mysqli_close($conn);
        ?>
    </div>

    <?php
    include "include/footer.php";
    ?>

</body>

</html>