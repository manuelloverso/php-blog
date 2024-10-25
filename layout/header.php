<?php
$logged = false;
if (isset($_SESSION['user_id'])) $logged = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'PHP blog' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <header class="py-4">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="title">
                <a href="/PHP/php-blog/index.php" class="fs-2 text-decoration-none">My Blog</a>
            </div>

            <div class="d-flex gap-3 align-items-center">
                <?php if ($logged) : ?>
                    <a href="/PHP/php-blog/views/dashboard.php" class="btn btn-primary">Dashboard</a>
                    <form class="m-0" method="post" action="/PHP/php-blog/controllers/logout-controller.php">
                        <button class="btn btn-outline-primary" type="submit">Logout</button>
                    </form>


                <?php else : ?>
                    <a href="/PHP/php-blog/views/login.php" class="btn btn-primary">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>