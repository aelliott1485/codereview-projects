<?php
// Source - https://codereview.stackexchange.com/q/243457
// Posted by user13477176, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-01, License - CC BY-SA 4.0

$username = trim($_GET['username'] ?? ($_SESSION['username'] ?? ''));

//Write the query
$sql = "SELECT * FROM posts WHERE username = '" . $username . "'  ORDER BY post_id DESC ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div id="rcorners2">';

        echo '<p id="p2">' . $row['username'] . '</p>';

        echo '<p id="p4">' . $row['date_time'] . '</p>';

        echo '<hr id="hr2">';

        echo '<p id="p3">' . $row['body'] . '</p>';

        echo '<div class="test"> <a href="#" class="fill-div"></a></div>';

        echo '</div>';
        echo '</br>';
    }
} else {
    echo '<center><b><p style="font-size: 30px; color: #262626;"> Write your first post</p></b></center>';
}
