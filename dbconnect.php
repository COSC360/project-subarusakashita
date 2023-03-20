<?php
    // $dsn = 'mysql:host=localhost;dname=user;charset=utf8';
    // $user = 'subaru';
    // $pass = 'password';
    // $dbh = new PDO($dsn, $user, $pass);
    
    // var_dump($dbh);
    $servername = "s129.ok.ubc.ca";
    $username = "83395822";
    $password = "83395822";
    $dbname = "user";

Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// $sql = "SELECT * FROM user";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
//     }
// } else {
//     echo "0 results";
// }

// $conn->close();

?>