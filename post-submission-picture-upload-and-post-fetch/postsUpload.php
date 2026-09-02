<?php
// Source - https://codereview.stackexchange.com/q/243457
// Posted by user13477176, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-01, License - CC BY-SA 4.0

error_reporting(-1);

require 'config/connect.php';
require 'auth_login.php';
require 'includes/header.php';

// just define at the top of the script index.php
$username = $_SESSION['username'] ?? '';

//Initializing variable
//"" When you want to append stuff later
//0  When you want to add numbers later
//isset()
$body = !empty($_POST['body']) ? $_POST['body'] : '';

if (isset($_POST['bts'])) {
    if (empty($body)) {
        echo "You didn't enter anything . <a href= profile.php>Try again</a>";
    } else {
        $sql = "INSERT INTO posts (username, body ) VALUES ('" . $username . "', '" . $body . "')";

        if (mysqli_query($conn, $sql)) {
            header('Location: profile.php');
            die();
        } else {
            echo "<br>error posting . <br> <a href= profile.php>Try again</a> " .
            mysqli_error($conn);
        }
    }
}
