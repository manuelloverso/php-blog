<?php
//start the session
session_start();

// early redirect if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/login.php?message=Login to access this page.");
    die;
}

$categories = getCategories();

function getCategories()
{
    // Connect to the DB
    $conn = new mysqli('localhost', 'root', 'root', 'php-blog');

    // Check connection
    if ($conn->connect_error) {
        exit('Failed to connect to the DB ' . $conn->connect_error);
    }

    // Prepare the query to get the categories
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch all rows as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    $conn->close();
}
?>

<?php include '../layout/header.php'; ?>

<div class="container">
    <form class="col-8 mx-auto" action="../controllers/dashboard-controller.php" method="post">
        <h2>Add a new post</h2>
        <input type="hidden" name="action" value="create_post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                class="form-control"
                placeholder="Post title"
                aria-describedby="helpId" />
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <input
                type="text"
                name="content"
                id="content"
                class="form-control"
                placeholder="Post content"
                aria-describedby="helpId" />
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Choose category</label>
            <select
                class="form-select"
                name="category"
                id="category">
                <option value="" disabled selected>Choose a category</option>
                <?php foreach ($categories as $c) : ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endforeach; ?>

            </select>
        </div>


        <button
            type="submit"
            class="btn btn-primary">
            Create
        </button>
    </form>
</div>

<?php include '../layout/footer.php'; ?>