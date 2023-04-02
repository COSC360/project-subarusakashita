<?php
session_start();

$username = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$sql = "SELECT * FROM users WHERE username = '$username'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($row['isAdmin'] !== 31) {
            echo '<script>alert("Admin page is restricted to admin users");</script>';
            header("Location: main.php");
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Admin Control Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        div#right img {
            height: 10em;
            width: auto;
        }
    </style>
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="profile.php? <?php echo ($username) ?>">Profile Page</a> > <a
                href="admin_control.php">Admin Control Page</a> </p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>

    <div id="right">
        <?php
        // connect to server
        $servername = "cosc360.ok.ubc.ca";
        $server_username = "83395822";
        $server_password = "83395822";
        $dbname = "db_83395822";
        $conn = new mysqli($servername, $server_username, $server_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        $sql1 = "SELECT * FROM users";
        $result1 = mysqli_query($conn, $sql1);

        echo ("<h2>Users</h2>");
        echo ("
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Admin</th>
                    <th>Disabled</th>
                </tr>");

        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $disabled = "false";
                if (isset($_POST['userDisabled'])) {
                    $disabled = $_POST['userDisabled'];
                } else {
                    $disabled = $row['isDisabled'];
                }
                echo ("
                <tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phoneNum'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['postalCode'] . "</td>
                    <td>" . $row['isAdmin'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='checkbox' id='userDisabled' name='userDisabled' checked='" . $disabled . "'>
                            <input type='submit' value='Save'>
                        </form>
                    </td>
                </tr>
            ");
            }
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $sql2 = "SELECT * FROM Articles";
        $result2 = mysqli_query($conn, $sql2);

        $disabled = "false";
        if (isset($_POST['artDisabled'])) {
            $disabled = $_POST['artDisabled'];
        } else {
            $disabled = $row['isDisabled'];
        }

        echo ("<h2>Articles</h2>");
        echo ("
            <table>
                <tr>
                    <th>Article ID</th>
                    <th>Article Title</th>
                    <th>Author</th>
                    <th>Category ID</th>
                    <th>Views</th>
                    <th>Disabled</th>
                </tr>");

        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo ("
                <tr>
                    <td>" . $row['articleId'] . "</td>
                    <td>" . $row['articleTitle'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['categoryId'] . "</td>
                    <td>" . $row['views'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='checkbox' id='artDisabled' name='artDisabled' checked='" . $disabled . "'>
                            <input type='submit' value='Save'>
                        </form>
                    </td>
                </tr>
            ");
            }
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $sql3 = "SELECT * FROM Ads";
        $result3 = mysqli_query($conn, $sql3);

        $disabled = "false";
        if (isset($_POST['userDisabled'])) {
            $disabled = $_POST['userDisabled'];
        } else {
            $disabled = $row['isDisabled'];
        }

        echo ("<h2>Advertisements</h2>");

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                echo ("<img src='" . $row['adPath'] . "' alt='Ads'>");
                echo ("
            <form method='post' action='admin_control.php'>
                <input type='checkbox' id='adDisabled' name='adDisabled' checked='" . $disabled . "'>
                <input type='submit' value='Save'>
            </form>");
            }
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        

        mysqli_close($conn);
        ?>

    </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>