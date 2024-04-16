<?php
//DEBUGGER
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/server.php";

require __DIR__ . "/functions.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <h1>PHP My Blog</h1>

    <p>Connection Message: <?php echo $connection_message; ?></p>

    <?php if (isset($_SESSION)) : ?>

        <?php if (isset($_SESSION['message'])) : ?>
            <p><?php echo "Session message: " . $_SESSION['message']; ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])) : ?>
            <p><?php echo "Session error: " . $_SESSION['error']; ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <p>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo 'Username: ' . $_SESSION['user_name'] . ' (ID: ' . $_SESSION['user_id'] . ')';
        }
        ?>
    </p>

    <div class="container">

        <?php if (!isset($_SESSION['user_id'])) : ?>

            <div class="row">

                <div class="col">

                    <!-- LOGIN FORM -->
                    <form method="POST" action="login.php">
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

        <?php endif; ?>

        <div class="row mt-3">
            <div class="col">

                <!-- ALL POSTS -->
                <?php foreach ($posts as $key => $post) : ?>

                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title">TITLE: <?php echo $post['title'] ?></h5>
                            <h6>POST ID <?php echo $post['id'] ?></h6>
                            <h6 class="card-subtitle mb-2 text-muted ">AUTHOR: <?php echo $post['author'] ?></h6>
                            <p class="card-text"><?php echo $post['content'] ?></p>
                        </div>

                        <a class="btn btn-warning w-25" href="<?php echo 'edit.php?post_id=' . $post['id']; ?>">Modifica Post</a>
                    </div>

                <?php endforeach ?>

            </div>
        </div>

    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>