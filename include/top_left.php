
<?php
session_start();

echo ('
<div id=top>
');

if (isset($_SESSION['username'])) {
    echo ('<a href="profile.php?username=' . $_SESSION['username'] . '">' . $_SESSION['username'] . '</a>');
} else {
    echo ('<a href="login.php">Log in</a>');
}

echo ('
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
</ul>'
);

echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');

echo ('</div>');
?>