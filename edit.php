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
    $_SESSION['error'] = "Messaggio per gli utenti con ID diverso da quello autenticato.";
}

?>

<body>
    questa è la bozza della pagina di modifica.

    <?php if (isset($_SESSION)) : ?>

        <?php if (isset($_SESSION['message'])) : ?>
            <p><?php echo "Session message: " . $_SESSION['message']; ?></p>
        <?php endif; ?>

        <?php if (isset($post)) : ?>
            <p><?php echo "Post Title: " . $post['title']; ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])) : ?>
            <p><?php echo "Session error: " . $_SESSION['error']; ?></p>
        <?php endif; ?>

    <?php endif; ?>

    <a href="index.php">Torna alla home</a>

</body>

</html>