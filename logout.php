<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Logged Out Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
    <style>
        div#right,
        div#left {
            height: 80em;
        }
    </style>
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="logout.php">Logged Out Page</a></p>
    </div>
    
    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>


    <div id="right">
        <h2>Successfully Logged Out</h2>
        <?php
        include "include/ad_long.php"; 
        session_destroy();
        header("Location: main.php");
        ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>