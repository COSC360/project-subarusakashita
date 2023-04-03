<?php
session_start();

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



$username = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (!$row['isAdmin']) {
            header("Location: main.php");
            exit;
        }
    }
} else {
    echo '<script>alert("user not found");</script>';

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

        div#right table,
        div#right th,
        div#right td {
            border: 1px solid black;
            font-weight: bold;
            border-collapse: collapse;
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
                $disabled = null;
                if (!empty($_POST['userDisabled'])) {
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
                            <input type='text' id='userDisabled' name='userDisabled' placeholder='$disabled'>
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
                            <input type='text' id='artDisabled' name='artDisabled' placeholder='$disabled'>
                            <input type='submit' value='Save'>
                        </form>
                    </td>
                </tr>
            ");
            }
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        echo ("<h2>Advertisements</h2>");

        $sql3 = "SELECT * FROM Ads";
        $result3 = mysqli_query($conn, $sql3);
        while ($row = mysqli_fetch_assoc($result3)) {
            $adName = 'adDisabled' . $row['adPath'];

            echo $adName;

            $disabled = null;
            if (!empty($_POST['adName'])) {
                $disabled = $_POST['adName'];
            } else {
                $disabled = $row['isDisabled'];
            }

            echo "Ad is disabled? " . $disabled;

            echo ("<img src='" . $row['adPath'] . "' alt='Ads'>");
            echo ("
            <form method='post' action='admin_control.php'>
                <input type='text' id='$adName' name='$adName' placeholder='$disabled'>
                <input type='submit' value='Save'>
            </form>");
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        

        mysqli_close($conn);
        ?>

    </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>