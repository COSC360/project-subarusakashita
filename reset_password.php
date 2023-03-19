<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Reset Password Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a> > <a href="login.html">Login Page</a> > <a href="reset_password.html">Reset
                Password Page</a></p>
    </div>
    <div id=top>
        <a href="login.html">Log in</a>
        <form>
            <fieldset>
                <input type="type" id="search" placeholder="Search Users and Articles">
                <input type="submit" value="Search" />
            </fieldset>
        </form>
    </div>
    <div id="left">
        <h2>Categories</h2>
        <ul>
            <li><a href="category/academic.html">Academic</a></li>
            <li><a href="category/lifestyle.html">Lifestyle</a></li>
            <li><a href="category/relationship.html">Relationship</a></li>
            <li><a href="category/extracurricular.html">Extracurricular</a></li>
            <li><a href="category/hobby.html">Hobby</a></li>
            <li><a href="category/random_chat.html">Random Chatting Platform</a></li>
        </ul>
    </div>
    <div id="right">
        <h2>Reset Password</h2>
        <div id="reset">
            <form method="post" action="reset_password.php">
                <fieldset>
                    <label for="recoverUser">Username:</label>
                    <input type="text" id="recoverUser" placeholder="Enter username" required>
                    <br>
                    <br>
                    <input type="submit" value="Reset Password" />
                </fieldset>
            </form>
        </div>
        <a href="#"><img src="ads/long/Orinthego.png" alt="Orinthego Ad"></a>
    <?php
        if(isset($_GET['recoverUser'])){
            //connect

            $passwordParts = ["a","b","c","d","e","f","g","h","i","j","k","l",
            "m","n","o","p","q","r","s","t","u","v","w","x","y","z",
            "!","@","#","$","%","^","&","*","(",")"];

            $newPassword = strtoupper($passwordParts[rand(0,26)]) . strtoupper($passwordParts[rand(0,26)])
             . $passwordParts[rand(0,26)] . $passwordParts[rand(0,26)] . $passwordParts[rand(0,26)]
             . $passwordParts[rand(0,26)] . rand(0,10) . rand(0,10) . $passwordParts[rand(26,36)];
            //auto decide new password using $passwordParts, format: AAaaaa11!

            $recoverUser = $_GET['recoverUser'];
            $sql1 = "SELECT email FROM Users WHERE username = " . $recoverUser;
            $sql2 = "UPDATE Users SET password = " . $newPassword . "WHERE username = " . $recoverUser;
            
            // run sql statements
            // send email of new password


            //disconnect
        }
    ?>
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>