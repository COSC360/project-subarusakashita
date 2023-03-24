<?php
session_start();
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $server_username, $server_password, $dbname);
$txtOne="";
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <h2>Write new article</h2>
        <div id="article">
            <form method="post" action="processArticle.php">
                <fieldset>
                    <label for="newArticleTitle">Article title</label>
                    <input type="text" id="newArticleTitle" name="newArticleTitle" placeholder="Write article title"
                        required>
                    <br>
                    <br>

                    <label for="category">Choose Category</label>
                    <select name="category" id="category" onchange="showTags()" required>
                    <option value="">-- Select Category --</option>
                    <option value="Academic">Academic</option>
                    <option value="Lifestyle">Lifestyle</option>
                    </select>
                    <br>
                    <br>
                    <label for="tag">Choose Tag</label>
                    <select name="tag" id="tag" required>
                    <option value="">-- Select Tag --</option>
                    </select> 
                    <br>
                    <br>

                    <?php include "include/ad_long.php"; ?>
                    
                    <label for="newArticleBody">Article body</label>
                    <textarea id="newArticleBody" name="newArticleBody" rows="15" placeholder="Write article body here"
                        required></textarea>
                    <br>
                    <br>

                    <input type="submit" value="Post article">
                </fieldset>
            </form>
            <script>
		        function showTags() {
			    let category = document.getElementById("category").value;
			    let tagDropdown = document.getElementById("tag");
			    tagDropdown.innerHTML = "";

			    let tags = [];
			    if (category === "Academic") {
				tags = ["Professor", "Course","Study"];
			    } else if( category === "Lifestyle"){
                    tags = ["Laundry","Emergencies","Cooking", "Grocery"]
                } 
			    for (let i = 0; i < tags.length; i++) {
				let option = document.createElement("option");
				option.value = tags[i];
				option.text = tags[i];
				tagDropdown.appendChild(option);
			    }
		    }
	        </script>

            <?php
            if (isset($_POST['newArticleTitle']) and isset($_POST['newArticleCategory']) and isset($_POST['newArticleTag']) and isset($_POST['newArticleBody'])) {
                $sql = "INSERT INTO Articles (articleTitle, username, categoryId, tagId, articleBody, views) VALUES (?, ?, ?, ?, ?, 0)";
                // leave out commentId because it is auto increment
                // run sql2
                while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($_POST['newArticleTitle'], $_SESSION['username'], $_POST['newArticleCategory'], $_POST['newArticleTag'], $_POST['newArticleBody']))) {
                    // run sql?
                }
            }
            ?>


        </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>
