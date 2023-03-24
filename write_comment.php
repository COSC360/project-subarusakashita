<?php
        if (isset($_SESSION['username'])) {

            echo "<form method = processComment.php action='post'>
                <fieldset>
                    <label for='comment'>Comment</label>
                <textarea id='comment' name='comment' rows='15' placeholder='Write acomment here'
                    required></textarea>
                <br>
                <input type='submit' value='Post Comment'>
                </fieldset> 
            ";
        }
?>