<?php
include __DIR__ . "/Partials/head.php";
?>

<?php
$posts = getAllPosts();
?>

<?php
if (isset($_GET['logout'])) {
    $_SESSION['message'] = 'Logout effettuato con successo.';
}
?>

<body>
    <h1>PHP My Blog</h1>
    DATABASE CONNECTION MESSAGE <br>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>Connection Message: <?php echo $connection_message; ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    SESSION MESSAGE <br>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo "Session message: " . $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    SESSION ERROR <br>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo "Session error: " . $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

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

    <div class="container">

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
                        <button type="submit" name="login_btn" class="btn btn-primary">Login</button>

                        <button type="reset" class="btn btn-danger">Reset</button>

                    </form>

                </div>

            </div>

        <?php else : ?>
            <form method="POST" action="logout.php">
                <button type="submit" name="logout_btn" class="btn btn-warning">Logout</button>
            </form>
        <?php endif; ?>

        <div class="row">
            <div class="col">

                <!-- ALL POSTS -->
                <?php foreach ($posts as $key => $post) : ?>

                    <div class="col">
                        <div class="card my-3">
                            <div class="card-body">
                                <h5 class="card-title">TITLE: <?php echo $post['title'] ?></h5>
                                <h6>POST ID <?php echo $post['id'] ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted ">AUTHOR: <?php echo $post['author'] ?></h6>
                                <p class="card-text"><?php echo $post['content'] ?></p>
                            </div>

                            <?php echo "Post user_id = " . $post['user_id'] ?>

                            <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == 1 || $_SESSION['user_id'] == $post['user_id'])) : ?>
                                <a class="btn btn-warning w-25" href="<?php echo 'edit.php?post_id=' . $post['id']; ?>">Modifica Post</a>

                            <?php else : ?>
                                <a class="btn btn-warning disabled w-25" href="#">Modifica Post</a>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php endforeach ?>

            </div>
        </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>