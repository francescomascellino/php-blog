<?php
include __DIR__ . "/Partials/head.php";

include "Controllers/PostController.php";
?>

<?php

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
}

$post = getSinglePostById($post_id);

if ($_SESSION['user_id'] == $post['user_id']) {
    $_SESSION['message'] = "L'utente " . $_SESSION['user_name'] . " (ID " . $_SESSION['user_id'] . ") è autorizzato a modificare il post con ID " . $post_id;
} else {
    $_SESSION['error'] = "L'utente non è autorizzato a modificare il post.";

    header("Location: index.php");
}

?>

<body>
    Questa è la bozza della pagina di modifica.

    <br> SESSION MESSAGE <br>
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo "Session message: " . $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($post)) : ?>
        <h1><?php echo "Post Title: " . $post['title']; ?></h1>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])) : ?>
        <p><?php echo "Session error: " . $_SESSION['error']; ?></p>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col">
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

    <a href="index.php">Torna alla home</a>

</body>

</html>