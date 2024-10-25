<?php
//start the session
session_start();

// early redirect if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/login.php?message=Login to access the dashboard page.");
    die;
}

include '../layout/header.php';


?>

<h2>Hello <?= $_SESSION['username'] ?></h2>
<?php include './layout/footer.php'; ?>