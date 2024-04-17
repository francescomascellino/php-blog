<?php
include __DIR__ . "/Partials/head.php";
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

    SESSION MESSAGE <br>
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

    <a href="index.php">Torna alla home</a>

</body>

</html>