<?php
session_start();

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

            header('Location: /PHP/php-blog/views/dashboard.php');
        } else {
            // set errors and redirect
            $_SESSION['errors']['password'] = "Invalid password";
            header('Location: /PHP/php-blog/views/login.php');
        }
    } else {
        // set errors and redirect
        $_SESSION['errors']['username'] = "User not found";
        header('Location: /PHP/php-blog/views/login.php');
    }

    //close the statement
    $stmt->close();
}



// close the connection
$conn->close();
