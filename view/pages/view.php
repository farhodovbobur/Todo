<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4497f215d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../style.css">
    <title>TODO app</title>
</head>

<body>
    <header>
        <?php require 'view/partials/navbar.php'; ?>
    </header>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="my-5">The Best TODO App</h1>

                <?php require 'view/add_todo.php'; ?>

                <hr class='border border-2 opacity-50'>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tasks</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php require 'view/show_todo.php'; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>



