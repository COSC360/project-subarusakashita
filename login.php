<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Login Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="login.php">Login Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>




    <!-- <div id=top>
        <a href=" login.php">Log in</a>
        <form action="search.php" method="get">
            <fieldset>
                <input type="search" id="searchKeyword" name="searchKeyword" placeholder="Search Users and Articles">
                <input type="submit" value="Search" />
            </fieldset>
        </form>
    </div>
    <div id="left">
        <h2>Categories</h2>
        <ul>
            <li><a href="category.php?categoryId=1&categoryName=Academic">Academic</a></li>
            <li><a href="category.php?categoryId=2&categoryName=Lifestyle">Lifestyle</a></li>
        </ul>
        <a href="#"><img src="ads/short/1.png" alt="Advertisement"></a>
        <a href="#"><img src="ads/short/1.png" alt="Advertisement"></a>
    </div> -->






    <div id="right">
        <h2>Log in</h2>
        <div id="login">
            <form action="signin.php" method="post">
                <fieldset>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="username" name="username" placeholder="Enter email" required>
                    <br>
                    <br>
                    <label for="password">Password: </label>
                    <br>
                    <input type="password" id="password" name="password" placeholder="Enter password" required>
                    <br>
                    <br>
                    <input type="submit" value="Log in" />
                </fieldset>
            </form>
            <a href="reset_password.php" id="forgot">Forgot Password</a>
        </div>
        <?php include "include/ad_long.php"; ?>
        <h2>Sign up</h2>
        <div id="signup">
            <form action="register.php" action="get">
                <fieldset>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="rUsername" name="rUsername" placeholder="Enter username" required>
                    <br>
                    <br>
                    <label for="email">Email:</label>
                    <br>
                    <input type="email" id="rEmail" name='rEmail' placeholder="Enter email" required>
                    <br>
                    <br>
                    <label for="password">Password: </label>
                    <br>
                    <input type="password" id="rPassword" name="rPassword" placeholder="Enter password" required>
                    <br>
                    <br>
                    <label for="password_conf">Re-enter Password: </label>
                    <br>
                    <input type="password" id="password_conf" name="password_conf" placeholder="Re-enter password"
                        required>
                    <br>
                    <br>
                    <input type="submit" value="Sign up" />
                    <input type="reset" value="Reset" />
                </fieldset>
            </form>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>

</html>