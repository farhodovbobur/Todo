
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c4497f215d.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
</head>

<style>
    .navbar-custom {
        padding: 15px 150px; /* Increase padding */
    }

    .custom-btn {
        width: 120px;
        height: 40px;
    }
</style>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg bg-light navbar-light navbar-custom w-100">
    <div class="container">
        <a class="navbar-brand" href="/">TODO App</a>
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto align-items-center nav-underline">
                <li class="nav-item">
                    <a class="nav-link mx-2" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/todos">Todo List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/notes">Note List</a>
                </li>
            </ul>
            <?php
            if (!isset($_SESSION['user'])): ?>
                <a href="/login" class="btn btn-outline-primary custom-btn mx-2">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a>
                <a href="/register" class="btn btn-outline-success custom-btn">Register</a>
            <?php else: echo $_SESSION['user'];?>
                <a href="/logout" class="btn btn-outline-danger custom-btn mx-2">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Navbar -->
