<?php
// Source - https://codereview.stackexchange.com/q/243457
// Posted by user13477176, modified by community. See post 'Timeline' for change history
// Retrieved 2026-09-01, License - CC BY-SA 4.0

$username = trim(isset($_SESSION['username']) ? $_SESSION['username'] : "");
$userPic = isset($_SESSION['userPic']) ? $_SESSION['userPic'] : "";

$info = date('Y-m-d_H-i-s');

if (!empty($username)) {
    if (isset($_FILES['fileToUpload'])) {
        $errors = array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $width = 1500;
        $height = 1500;
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $tmp = explode('.', $_FILES['fileToUpload']['name']);
        $file_ext = strtolower(end($tmp));

        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 8097152) {
            $errors[] = 'File size must be 2 MB';
        }

        if ($width > 1500 || $height > 1500) {
            echo "File is to large";
        }

        if (empty($errors) == true) {
            $userPic = date('Y-m-d_H-i-s') . $file_name;
            move_uploaded_file($file_tmp, "uploads/" . $userPic);

            $stmt = $conn->prepare("UPDATE users SET userPic=?, date_time=? WHERE username = ?");
            $date_time = date("Y-m-d H:i:s");
            $stmt->bind_param('sss', $userPic, $date_time, $username);

            /* execute prepared statement */
            $stmt->execute();

            printf("", $conn->affected_rows);
            /* close statement and connection */
        }
    }
} else {
    echo "Invalid Username";
}

?>

<?php
$getimg = mysqli_query(
$conn,
"SELECT userPic, date_time FROM users WHERE
    username='" . mysqli_real_escape_string($conn, $username) . "'"
);

$rows = mysqli_fetch_array($getimg);
$img = $rows['userPic'];
?>
