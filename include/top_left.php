<?php
session_start();
echo '

<div id=top>
';
if (isset($_SESSION['username'])) {
    echo ('<a href="profile.php?username=' . $_SESSION['username'] . '>' . $_SESSION['username'] . '</a>');
} else {
    echo ('<a href="login.php">Log in</a>');
}
echo '
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
    <li><a href="category.php?categoryId=3&categoryName=Relationship">Relationship</a></li>
    <li><a href="category.php?categoryId=4&categoryName=Extracurricular">Extracurricular</a></li>
    <li><a href="category.php?categoryId=5&categoryName=Hobby">Hobby</a></li>
    <li><a href="category.php?categoryId=6&categoryName=Random%20Chatting%20Platform">Random Chatting Platform</a></li>
</ul>
<?php
    echo ("<a href=\"#\"><img src=\"ads/short/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
    echo ("<a href=\"#\"><img src=\"ads/short/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
?>
</div>';
?>