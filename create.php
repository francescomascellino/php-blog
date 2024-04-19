<?php
include __DIR__ . "/Partials/head.php";

include "Controllers/PostController.php";
?>

<?php

// IF USER IS NOT LOGGED IN, CAN NOT MODIFY POST
if (!isset($_SESSION['user_id'])) {

    $_SESSION['error'] = "L'utente deve essere autenticato per poter creare un post.";

    header("Location: index.php");
}

$values = $_GET['values'] ?? array();
$errors = $_GET['errors'] ?? array();

?>

<body>

    <?php
    require __DIR__ . "/Partials/navbar.php"
    ?>

    <div class="container">

        <?php
        require __DIR__ . "/Partials/alerts.php"
        ?>

        <!-- VALIDATION ALERTS -->
        <?php
        require __DIR__ . "/Partials/validation_alerts.php"
        ?>

        <div class="row">
            <div class="col">

                Questa è la bozza della pagina di crezione.

                <!-- <?php if (isset($post)) : ?>
                    <h1><?php echo "Editing Post: " . $post['title']; ?></h1>
                <?php endif; ?> -->

                <h1>Write something unic!</h1>

                <!-- CREATE POST FORM -->
                <form method="POST" action="Controllers/PostController.php?action=createPost" class=" border rounded p-3">

                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <?php
                        date_default_timezone_set('Europe/Rome');
                        ?>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your post title" value="<?php echo $values['title'] ?? "Title " . rand(0, 99) . " " . date('d M Y H:i:s'); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Enter your post content"><?php echo $values['content'] ?? "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium, harum?"; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category">
                            <option <?php echo (!isset($values['category_id'])) ? 'selected' : ''; ?> disabled>Select a Category</option>
                            <option value="1" <?php echo (isset($values['category_id']) && $values['category_id'] == 1) ? 'selected' : ''; ?>>PHP</option>
                            <option value="2" <?php echo (isset($values['category_id']) && $values['category_id'] == 2) ? 'selected' : ''; ?>>JS</option>
                            <option value="3" <?php echo (isset($values['category_id']) && $values['category_id'] == 3) ? 'selected' : ''; ?>>Laravel</option>
                            <option value="4" <?php echo (isset($values['category_id']) && $values['category_id'] == 4) ? 'selected' : ''; ?>>Vue</option>
                        </select>
                    </div>

                    <button type="submit" name="create_btn" class="btn btn-primary">Create Post</button>

                </form>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="/Static/script.js" type="text/javascript"></script>

</html>