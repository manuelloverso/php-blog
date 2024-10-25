<?php
//start the session
session_start();

// early redirect if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/login.php?message=Login to access the dashboard page.");
    die;
}

// Connect to the DB
$conn = new mysqli('localhost', 'root', 'root', 'php-blog');

// Check connection
if ($conn->connect_error) {
    exit('Failed to connect to the DB ' . $conn->connect_error);
}

// Prepare the query to get the posts
$sql = "SELECT * FROM `posts`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch all rows as an associative array
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($posts);
} else {
    echo "No posts found.";
}

?>

<?php include '../layout/header.php'; ?>

<div class="container">
    <h2>Hello <?= $_SESSION['username'] ?></h2>


</div>



<?php include './layout/footer.php'; ?>