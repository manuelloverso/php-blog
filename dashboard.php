<?php
//start the session
session_start();

include './layout/header.php';


?>

<h2>Hello <?= $_SESSION['username'] ?></h2>
<?php include './layout/footer.php'; ?>