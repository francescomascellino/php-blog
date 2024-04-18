<?php
function checkSession() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        echo "<br>" . "SESSION EXISTS!" . "<br>";
        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";
    } else {
        session_start();

        echo "<br>" . "SESSION DOES NOT EXISTS! STARTING SESSION..." . "<br>";

        echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";
    }
}

/* function getAllPosts()
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

function getSinglePostById($post_id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$post_id AND user_id={$_SESSION['user_id']}");

    return mysqli_fetch_assoc($result);
};
 */