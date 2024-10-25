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
                <a href="index.php" class="fs-2 text-decoration-none">My Blog</a>
            </div>
            <a href="login.php" class="btn btn-primary">Login</a>
        </div>
    </header>
</body>