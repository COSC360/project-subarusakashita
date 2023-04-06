<?php
use PHPUnit\Framework\TestCase;

class UserLoginTest extends TestCase {

    public function testUserLogin() {
        $db = new mysqli("cosc360.ok.ubc.ca", "83395822", "83395822", "db_83395822");
        $username = "yie";
        $password = "root";
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND passwords = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->assertEquals(1, $result->num_rows);
        $stmt->close();
        $db->close();
    }

}

?>