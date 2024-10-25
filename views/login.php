<?php
// start the session
session_start();

//check for errors
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

// early redirect if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/dashboard.php");
    die;
}

include '../layout/header.php';


?>


<div class="container mx-auto">

    <?php if (isset($_GET['message'])) : ?>
        <h3><?= $_GET['message'] ?></h3>
    <?php endif; ?>


    <form class="col-6 mx-auto" method="post" action="../controllers/login-controller.php">
        <?php if ($logged): ?>
            <p class="text-success">Sei correttamente loggato</p>
        <?php endif; ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                aria-describedby="helpId"
                placeholder="Iserisci il tuo username" />
            <?php if (isset($errors['username'])): ?>
                <p class="text-danger"><?= $errors['username'] ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="text"
                class="form-control"
                name="password"
                id="password"
                aria-describedby="helpId"
                placeholder="Iserisci la tua password" />
            <?php if (isset($errors['password'])): ?>
                <p class="text-danger"><?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>

        <button
            type="submit"
            class="btn btn-primary">
            Accedi
        </button>


    </form>
</div>

<?php
include './layout/footer.php';
?>