
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/">TODO App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/todos">Todo list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/notes">Notes</a>
                </li>
            </ul>
            <?php
            if (!isset($_SESSION['user'])): ?>
                <a href="/login" class="btn btn-outline-primary mx-2">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a>
                <a href="/register" class="btn btn-outline-success">Register</a>
            <?php else: echo $_SESSION['user'];?>
                <a href="/logout" class="btn btn-outline-danger mx-2">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
