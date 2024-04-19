<?php
include __DIR__ . "/Partials/head.php";

include "Controllers/PostController.php";
?>

<?php

// IF USER IS NOT LOGGED IN, CAN NOT MODIFY POST
if (!isset($_SESSION['user_id'])) {

    $_SESSION['error'] = "L'utente deve essere autenticato per poter modificare un post.";

    header("Location: index.php");
}

// GETS THE POST DATA
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} else {
    $_SESSION['error'] = "Operazione non concessa.";

    header("Location: index.php");
}

$post = getSinglePostById($post_id);

// IF THE $_SESSION user_id DOES NOT MATCH THE POST user_id, USER CAN NOT EDIT THE POST
if ($_SESSION['user_id'] != $post['user_id']) {

    $_SESSION['error'] = "L'utente non è autorizzato a modificare il post.";

    header("Location: index.php");
}

?>

<body>

    <?php
    require __DIR__ . "/Partials/navbar.php"
    ?>

    <div class="container">

        <?php
        require __DIR__ . "/Partials/alerts.php"
        ?>

        <div class="row">
            <div class="col">

                Questa è la bozza della pagina di modifica.

                <?php if (isset($post)) : ?>
                    <h1><?php echo "Editing Post: " . $post['title']; ?></h1>
                <?php endif; ?>

                <!-- EDIT POST FORM -->
                <form method="POST" action="Controllers/PostController.php?action=updatePost" class=" border rounded p-3">

                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your post title" value="<?php echo $post['title']; ?>">
                    </div>

                    <button type="submit" name="update_btn" class="btn btn-primary">Update Post</button>

                </form>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="script.js" type="text/javascript"></script>

</html>