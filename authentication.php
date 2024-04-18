<?php
require __DIR__ . "/Partials/head.php";

require __DIR__ . "/Controllers/PostController.php";
$posts = getAllPosts();

?>

<body>

    <?php
    require __DIR__ . "/Partials/navbar.php"
    ?>

    <div class="container pt-3">

        <?php
        require __DIR__ . "/Partials/alerts.php"
        ?>

        SESSION USER DETAILS <br>
        <?php if (isset($_SESSION['user_name'])) : ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <span>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        echo 'Username: ' . $_SESSION['user_name'] . ' (ID: ' . $_SESSION['user_id'] . ')';
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user_id'])) : ?>

            <div class="row mt-3">

                <div class="col">

                    <!-- LOGIN FORM -->
                    <form method="POST" action="login.php" class="border rounded p-3">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center">

                            <div>
                                <button type="submit" name="login_btn" class="btn btn-primary">Login</button>

                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>

                            <div>
                                <a href="register.php" class="ms-auto">Don't have an account? Register!</a>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        <?php else : ?>
            <form method="POST" action="logout.php">
                <button type="submit" name="logout_btn" class="btn btn-warning">Logout</button>
            </form>
        <?php endif; ?>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="script.js" type="text/javascript"></script>

</html>