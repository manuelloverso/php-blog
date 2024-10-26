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
$sql = "SELECT title, content, categories.name AS category_name
FROM posts
LEFT JOIN categories ON categories.id = posts.category_id";
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

    <?php if (isset($_GET['message'])) : ?>
        <p class="text-success"><?= $_GET['message'] ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['error'])) : ?>
        <p class="text-success"><?= $_GET['error'] ?></p>
    <?php endif; ?>

    <div class="actions d-flex justify-content-end gap-3 mb-4">
        <a class="btn btn-success" href="./create-post.php">Add post</a>
        <a class="btn btn-warning" href="./create-category.php">Add category</a>
    </div>

    <div class="posts">
        <?php foreach ($posts as $post) : ?>
            <div class="card p-3 mb-4">
                <h3 class="text-center"><?= $post['title'] ?></h3>
                <p><?= $post['content'] ?></p>
                <p class="fs-3"><?= $post['category_name'] ?? 'no category associated' ?></p>

            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php include '../layout/footer.php'; ?>