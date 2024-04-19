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

                Questa è la bozza della pagina di crezione.

                <!-- <?php if (isset($post)) : ?>
                    <h1><?php echo "Editing Post: " . $post['title']; ?></h1>
                <?php endif; ?> -->

                <h1>Write something unic!</h1>

                <!-- EDIT POST FORM -->
                <form method="POST" action="Controllers/PostController.php?action=createPost" class=" border rounded p-3">

                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter your post title" value="<?php echo "Title " . rand(0, 99) . " " . date('d M Y H:i:s'); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Enter your post content"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium, harum?</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category">
                            <option selected>Select a Category</option>
                            <option value="1">PHP</option>
                            <option value="2">JS</option>
                            <option value="3">Laravel</option>
                            <option value="4">Vue</option>
                        </select>
                    </div>

                    <button type="submit" name="create_btn" class="btn btn-primary">Create Post</button>

                </form>
            </div>
        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="script.js" type="text/javascript"></script>

</html>