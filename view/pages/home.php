<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4497f215d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style.css">
    <title>TODO App</title>
</head>

<body>
    <header>
        <?php require 'view/partials/navbar.php'; ?>
    </header>

    <div class="container">
        <h1>Home page</h1>

        <?php
        if (isset($_SESSION['user'])) {
            echo "Hello, {$_SESSION['user']}. Welcome to App.";
        }
        ?>

    </div>
</body>
</html>