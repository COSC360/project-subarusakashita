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
        if ($row['isAdmin'] !== '1') {
            header("Location: main.php");
            exit;
        }
    }
} else {
    header("Location: main.php");
    exit;
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
            height: 7em;
            width: auto;
        }

        div#right table,
        div#right th,
        div#right td {
            border: 1px solid black;
            font-weight: bold;
            border-collapse: collapse;
        }

        .red {
            background-color: rgb(245, 162, 164);
        }

        .green {
            background-color: rgb(192, 242, 165);
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
                    <th>isAdmin (0/1)</th>
                    <th>isDisabled (0/1)</th>
                    <th>Change status</th>
                </tr>");

        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $disabled1 = null;
                $name = "User" . $row['username'];

                if (!empty($_POST[$name])) {
                    $disabled1 = $_POST[$name];
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
                    $sql2 = "UPDATE users SET isDisabled=? WHERE username=?";
                    $statement = $pdo->prepare($sql2);
                    $statement->bindValue(1, $disabled1);
                    $statement->bindValue(2, $row['username']);
                    $statement->execute();
                } else {
                    $disabled1 = $row['isDisabled'];
                }

                if ($disabled1 === '1') {
                    echo ("
                <tr class='red'>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phoneNum'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['postalCode'] . "</td>
                    <td>" . $row['isAdmin'] . "</td>
                    <td>" . $row['isDisabled'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='hidden' id='$name' name='$name' value='00'>
                            <input type='submit' value='Enable'>");
                } else {
                    echo ("
                <tr class='green'>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phoneNum'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['postalCode'] . "</td>
                    <td>" . $row['isAdmin'] . "</td>
                    <td>" . $row['isDisabled'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='hidden' id='$name' name='$name' value='1'>
                            <input type='submit' value='Disable'>");
                }
                echo (" 
                        </form>
                    </td>
                </tr>
            ");
            }
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $sql3 = "SELECT * FROM Articles";
        $result3 = mysqli_query($conn, $sql3);

        echo ("<h2>Articles</h2>");
        echo ("
            <table>
                <tr>
                    <th>Article ID</th>
                    <th>Article Title</th>
                    <th>Author</th>
                    <th>Tag ID</th>
                    <th>Category ID</th>
                    <th>Comment Count</th>
                    <th>isDisabled (0/1)</th>
                    <th>Change status</th>
                </tr>");

        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                $disabled2 = null;
                $name = "Art" . $row['articleId'];

                if (!empty($_POST[$name])) {
                    $disabled2 = $_POST[$name];
                    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
                    $sql4 = "UPDATE Articles SET isDisabled=? WHERE articleId=?";
                    $statement = $pdo->prepare($sql4);
                    $statement->bindValue(1, $disabled2);
                    $statement->bindValue(2, $row['articleId']);
                    $statement->execute();
                } else {
                    $disabled2 = $row['isDisabled'];
                }

                if ($disabled2 === '1') {
                    echo ("
                <tr class='red'>
                    <td>" . $row['articleId'] . "</td>
                    <td>" . $row['articleTitle'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['categoryId'] . "</td>
                    <td>" . $row['tagId'] . "</td>
                    <td>" . $row['commentNum'] . "</td>
                    <td>" . $row['isDisabled'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='hidden' id='$name' name='$name' value='00'>
                            <input type='submit' value='Enable'>");
                } else {
                    echo ("
                <tr class='green'>
                    <td>" . $row['articleId'] . "</td>
                    <td>" . $row['articleTitle'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['categoryId'] . "</td>
                    <td>" . $row['tagId'] . "</td>
                    <td>" . $row['commentNum'] . "</td>
                    <td>" . $row['isDisabled'] . "</td>
                    <td>
                        <form method='post' action='admin_control.php'>
                            <input type='hidden' id='$name' name='$name' value='1'>
                            <input type='submit' value='Disable'>");
                }
                echo (" 
                        </form>
                    </td>
                </tr>
            ");
            }
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        // echo ("<h2>Advertisements</h2>");

        // $sql5 = "SELECT * FROM Ads";
        // $result5 = mysqli_query($conn, $sql5);
        // echo ("
        //     <table>
        //         <tr>
        //             <th>Ad ID</th>    
        //             <th>Advertisement Image</th>
        //             <th>isDisabled (0/1)</th>
        //             <th>Change status</th>
        //         </tr>");

        // if (mysqli_num_rows($result5) > 0) {
        //     while ($row = mysqli_fetch_assoc($result5)) {
        //         $disabled3 = null;
        //         $name = "Ad" . $row['adId'];

        //         if (!empty($_POST[$name])) {
        //             $disabled3 = $_POST[$name];
        //             $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
        //             $sql6 = "UPDATE Ads SET isDisabled=? WHERE adId=?";
        //             $statement = $pdo->prepare($sql6);
        //             $statement->bindValue(1, $disabled3);
        //             $statement->bindValue(2, $row['adId']);
        //             $statement->execute();
        //         } else {
        //             $disabled3 = $row['isDisabled'];
        //         }

        //         if ($disabled3 === '1') {
        //             echo ("
        //                 <tr class='red'>
        //                     <td>" . $row['adId'] . "</td>
        //                     <td><img src='" . $row['adPath'] . "' alt='Ads'></td>
        //                     <td>" . $row['isDisabled'] . "</td>
        //                     <td>
        //                         <form method='post' action='admin_control.php'>
        //                             <input type='hidden' id='$name' name='$name' value='00'>
        //                             <input type='submit' value='Enable'>");
        //         } else {
        //             echo ("
        //                 <tr class='green'>
        //                 <td>" . $row['adId'] . "</td>
        //                 <td><img src='" . $row['adPath'] . "' alt='Ads'></td>
        //                 <td>" . $row['isDisabled'] . "</td>
        //                 <td>");
        //             if ($row['adId'] === '3' || $row['adId'] === '6'){
        //                 echo ("Cannot disable");
        //             }
        //             else{
        //                 echo("
        //                         <form method='post' action='admin_control.php'>
        //                             <input type='hidden' id='$name' name='$name' value='1'>
        //                             <input type='submit' value='Disable'>
        //                         </form>");
        //             }
        //         }
        //         echo (" 
        //                     </td>
        //                 </tr>
        //             ");
        //     }
        // }
        // echo ("</table>");


        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        

        mysqli_close($conn);
        ?>

    </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>