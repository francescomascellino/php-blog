<?php

require __DIR__ . "/../server.php";

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

function createPost()
{
}

// UPDATE - WE INTERCEPT THE POST REQUEST AND CHECK IF THE ACTION IS updatePost
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'updatePost') {

    $post_id = $_POST['post_id'];
    $post = getSinglePostById($post_id);

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
