<?php
//start the session
session_start();

// early redirect if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/login.php?message=Login to access this page.");
    die;
}
?>

<?php include '../layout/header.php'; ?>

<div class="container">
    <form class="col-8 mx-auto" action="../controllers/dashboard-controller.php" method="post">
        <h2>Add a new category</h2>
        <input type="hidden" name="action" value="create_category">
        <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                placeholder="Category name"
                aria-describedby="helpId" />
        </div>

        <button
            type="submit"
            class="btn btn-primary">
            Create
        </button>

    </form>
</div>

<?php include '../layout/footer.php'; ?>