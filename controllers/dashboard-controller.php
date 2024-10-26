<?php
session_start();

// early redirect if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP/php-blog/views/login.php?message=Login to access this page.");
    die;
}

// call the right method using an hidden input
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $action();
}



function create_post()
{
    // Connect to the DB
    $conn = new mysqli('localhost', 'root', 'root', 'php-blog');

    // Check connection
    if ($conn->connect_error) {
        exit('Failed to connect to the DB ' . $conn->connect_error);
    }

    $sql = "INSERT INTO `posts` (title, content) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $_POST['title'], $_POST['content']);

    $result = $stmt->execute();

    if ($result) {
        header('Location: ../views/dashboard.php?message=Post created successfully');
    } else {
        header('Location: ../views/create-post.php?error=Post wasnt created');
    }

    var_dump($result);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

function create_category()
{
    // Connect to the DB
    $conn = new mysqli('localhost', 'root', 'root', 'php-blog');

    // Check connection
    if ($conn->connect_error) {
        exit('Failed to connect to the DB ' . $conn->connect_error);
    }


    $sql = "INSERT INTO `categories` (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_POST['name']);

    $result = $stmt->execute();

    if ($result) {
        header('Location: ../views/dashboard.php?message=Category created successfully');
    } else {
        header('Location: ../views/create-post.php?error=Category wasnt created');
    }

    var_dump($result);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
