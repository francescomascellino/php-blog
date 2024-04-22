<?php
require __DIR__ . "/Partials/head.php";

require __DIR__ . "/Controllers/PostController.php";
$posts = getAllPosts();

// OLD LOGOUT MESSAGE USING GET PARAMATER (FOR REFERENCE)
/* if (isset($_GET['logout'])) {
    $_SESSION['message'] = 'Logout effettuato con successo.';
} */
?>

<body>

    <?php
    require __DIR__ . "/Partials/navbar.php"
    ?>

    <div class="container pt-3">

        <?php
        require __DIR__ . "/Partials/alerts.php"
        ?>

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

<script src="/Static/script.js" type="text/javascript"></script>

</html>