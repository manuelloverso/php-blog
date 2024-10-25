<?php
// start the session
session_start();

// early redirect if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    die;
}

include './layout/header.php';

// Connect to the DB
$conn = new mysqli('localhost', 'root', 'root', 'php-blog');

// Check connection
if ($conn->connect_error) {
    exit('Failed to connect to the DB ' . $conn->connect_error);
}

//initial status
$logged = false;
$errors = [];

// Get the form parameters if form have been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Prepare the query
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? ");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    // Get the result
    $result = $stmt->get_result();

    //fetch into an assoc array the first returned row
    if ($user = $result->fetch_assoc()) {

        // Check if the passwords match
        // password_verify($password, $user['password']) ? $logged = true : $errors['password'] = "Invalid password";
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $logged = true;

            header('Location: dashboard.php');
            die;
        } else {
            $errors['password'] = "Invalid password";
        }
    } else {
        $errors['username'] = 'User not found';
    }

    //close the statement
    $stmt->close();
}



// close the connection
$conn->close();
?>


<div class="container mx-auto">

    <?php if (isset($_GET['message'])) : ?>
        <h3><?= $_GET['message'] ?></h3>
    <?php endif; ?>


    <form class="col-6 mx-auto" method="post">
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