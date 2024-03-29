<?php
session_start();
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchKeyword = "%";
if (isset($_GET['searchKeyword'])) {
    $searchKeyword = "%" . $_GET['searchKeyword'] . "%";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Search Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        div#right img#profile {
            height: 3em;
            width: 3em;
            border-radius: 50%;
            padding-left: 0em;
            margin-left: 0em;
        }

        table#userTable {
            border: none;
        }

        table#userTable td {
            padding: 0em;
        }
    </style>
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p>
            <a href="main.php">Main Page</a> >
            <a href="search.php?searchKeyword= <?php $_GET['searchKeyword'] ?>">Search Page</a>
        </p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>


    <div id="right">
        <?php
        echo ("<h2>Search Result in Articles</h2>");

        $sql1 = "SELECT * FROM Articles WHERE articleTitle LIKE '$searchKeyword'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                echo ("<h3><a href='article.php?articleId=" . $row['articleId'] . "'>" . $row['articleTitle'] . "</a></h3>");
            }
        } else {
            echo ("<h3>No results found for Articles</h3>");
        }

        include "include/ad_long.php";
        echo ("<h2>Search Result in Users</h2>");

        $sql2 = "SELECT * FROM users WHERE username LIKE '$searchKeyword'";
        $result2 = mysqli_query($conn, $sql2);
        echo "<table id='userTable'>";
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo "<tr>";
                $image = null;
                $type = null;
                $sql6 = "SELECT fileType, fileContent FROM Images WHERE username=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $sql6);
                mysqli_stmt_bind_param($stmt, "s", $row['username']);
                $result6 = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                mysqli_stmt_bind_result($stmt, $type, $image);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
                if ($image !== null) {
                    echo '<td><img id="profile" src="data:image/' . $type . ';base64,' . base64_encode($image) . '"></td>';
                } else {
                    echo "<td></td>";
                }
                echo ("
                    <td>
                        <h3 id='nameFloatRight'>" . $row['username'] . "</h3>
                    </td>
                </tr>");
            }
            echo "</table>";
        } else {
            echo ("</table><h3>No results found for Users</h3>");
        }

        include "include/ad_long.php";

        echo ("<h2>Search Result in Tags</h2>");

        $sql3 = "SELECT * FROM Tags WHERE tagName LIKE '$searchKeyword'";
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                echo ("<h3><a href='tag.php?tagId=" . $row['tagId'] . "'>" . $row['tagName'] . "</a></h3>");
            }
        } else {
            echo ("<h3>No results found for Tags</h3>");
        }
        mysqli_close($conn);
        ?>

    </div>
    <?php include "include/footer.php" ?>
</body>

</html>