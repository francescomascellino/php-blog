<?php

require __DIR__ . "/../Static/server.php";

require __DIR__ . "/../Classes/BlogPost.php";

// INDEX
function getAllPosts()
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM posts");
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();

    foreach ($posts as $post) {
        $post['author'] = getAuthorById(($post['user_id']));

        array_push($final_posts, $post);
    };

    return $final_posts;
};

function getAuthorById($user_id)
{
    global $conn;

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id=$user_id");
    return mysqli_fetch_assoc($result)['username'];
};

// SHOW
function getSinglePostById($post_id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$post_id AND user_id={$_SESSION['user_id']}");

    return mysqli_fetch_assoc($result);
};

// CREATE - WE INTERCEPT THE POST REQUEST AND CHECK IF THE ACTION IS createPost
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'createPost') {

    // VALIDATION
    $errors = array();

    if (empty(trim($_POST['title']))) {
        array_push($errors, "Il titolo non può essere vuoto");
    }

    if (empty(trim($_POST['content']))) {
        array_push($errors, "Il contenuto non può essere vuoto");
    }

    if (empty($_POST['category_id'])) {
        array_push($errors, "Seleziona almeno una categoria");
    }

    if (!empty($errors)) {
        $values = array(
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'category_id' => $_POST['category_id']
        );
        $query_params = http_build_query(array('values' => $values, 'errors' => $errors));

        // Reindirizza alla pagina precedente con i parametri di query nell'URL
        header("Location: /create.php?$query_params");
        exit;
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category_id'];

    // WE CREATE A BlogPost ISTANCE
    $newPost = new BlogPost($title, $content, $user_id, $category_id, $image);
    // THEN WE RUN THE CREATE METHOD
    createPost($newPost);
}

function createPost($newPost)
{
    global $conn;
    if ($newPost->save($conn)) {
        $_SESSION['message'] = "Il post è stato creato con successo!";
    } else {
        $_SESSION['error'] = "Si è verificato un errore durante la creazione del post.";
    }
    header("Location: /index.php");
    exit;
}

// UPDATE - WE INTERCEPT THE POST REQUEST AND CHECK IF THE ACTION IS updatePost
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'updatePost') {

    $post_id = $_POST['post_id'];
    $post = getSinglePostById($post_id);

    // VALIDATION
    $errors = array();

    if (empty(trim($_POST['title']))) {
        array_push($errors, "Il titolo non può essere vuoto");
    }

    if (!empty($errors)) {
        $values = array(
            'title' => $_POST['title'],
        );
        $query_params = http_build_query(array('values' => $values, 'errors' => $errors));

        // Reindirizza alla pagina precedente con i parametri di query nell'URL
        header("Location: /edit.php?post_id=$post_id&$query_params");
        exit;
    }

    // THEN WE RUN THE UPDATE METHOD
    updatePost($post);
}

function updatePost($post)
{
    global $conn;

    $original_title = $post['title'];

    $new_title = $_POST['title'];

    if ($new_title !== $original_title) {

        $stmt = mysqli_prepare($conn, "UPDATE posts SET title = ? WHERE id = ?");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $new_title, $post['id']);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['error'] = NULL;
                $_SESSION['message'] = "Il post è stato aggiornato con successo!";

                header("Location: /index.php");
                exit;
            } else {
                $_SESSION['message'] = NULL;
                $_SESSION['error'] = "Si è verificato un errore durante l'aggiornamento del post.";

                header("Location: /index.php");
                exit;
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = NULL;
            $_SESSION['error'] = "Si è verificato un errore durante la preparazione della query.";
            header("Location: /index.php");
            exit;
        }
    } else {
        $_SESSION['message'] = NULL;
        $_SESSION['error'] = "Il titolo del post è lo stesso. Nessuna modifica effettuata.";
        header("Location: /index.php");
        exit;
    }
}

function destroyPost()
{
}
