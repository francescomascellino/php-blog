# PREPARE DATABASE CONNECTION:
*server.php*
```php
<?php

session_start();

define("DB_SERVERNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
define("DB_NAME", "db_php_blog");

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connessione al database non riuscita: " . $conn->connect_error);
} else {
    $connection_message = "Connessione al database avvenuta con successo.";
}
?>
```

# MANAGE LOGIN
*login.php*
```php
<?php
require "server.php";

$password = $_POST['password'];
$username = $_POST['username'];

// PERPARES THE CONNECTION AND SELECTS THE PASSWORD IN THE ROW CORRESPONDING WITH THE username
$stmn = $conn->prepare("SELECT * FROM users WHERE username = ?");

// BINDS THE $username VARIABLE WITH THE PARAMETER
$stmn->bind_param("s", $username);

// EXECUTES THE STATEMENT
$stmn->execute();

// GETS THE RESULTS
$result = $stmn->get_result();

// IF THERE IS AT LEAST 1 ROW IN THE $result
if ($result->num_rows === 1) {

    // EXTRACTS THE ROW IN AN ASSOCIATIVE ARRAY
    $row = $result->fetch_assoc();

    $stored_password = $row['password'];

    // CHECKS IF THE $stored_password IS EQUAL TO THE HASHED VERSION OF THE $password GIVEN BY THE USER
    if (password_verify($password, $stored_password)) {
        $_SESSION['message'] = "Utente trovato nel database e password corretta. / Accesso Effettuato correttamente!";

        // SETS THE SESSION VARIABLES
        $_SESSION['user_name'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];

        var_dump($_SESSION['message']);
        var_dump($_SESSION['user_name']);

        // REDIRECTS TO THE HOME PAGE
        header("Location: index.php");
    } else {

        $_SESSION['user_name'] = "WRONG PASSWORD";
        $_SESSION['user_id'] = "NONE";

        $_SESSION['message'] =  "Utente trovato nel database ma password non corretta. / Nome Utente o Password errati.";

        var_dump($_SESSION['message']);
        var_dump($_SESSION['user_name']);

        header("Location: index.php");
    }
} else {
    // IF THERE IS NO ROW IN THE $result WE DO NOT HAVE A MATCHING USER REGISTERED IN THE DB
    $_SESSION['user_name'] = "USER NOT FOUND";
    $_SESSION['user_id'] = "NONE";

    $_SESSION['message'] =  "Utente non trovato nel database. / Nome Utente o Password errati.";

    header("Location: index.php");
}
```

# GET ALL POSTS FROM DATABASE
*functions.php*
```php
<?php
function getAllPosts()
{
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM posts");
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();

    // FOREACH DOES NOT EDIT THE ORIGINAL ARRAY!
    foreach ($posts as $post) {
        $post['author'] = getAuthorById(($post['user_id']));
        // var_dump($post['author']);
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

// WE TELL THE EDITOR THAT $posts IS AN ARRAY TO PREVENT ALERTS
/** @var array $posts */
$posts = getAllPosts();
```
*index.php*
```php
<?php foreach ($posts as $key => $post) : ?>

    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">TITLE: <?php echo $post['title'] ?></h5>
            <h6>POST ID <?php echo $post['id'] ?></h6>
            <h6 class="card-subtitle mb-2 text-muted ">AUTHOR: <?php echo $post['author'] ?></h6>
            <p class="card-text"><?php echo $post['content'] ?></p>
        </div>
    </div>

<?php endforeach ?>
```

# BASIC CONTROL ON USER TO EDIT POST
link to the post edit page on *index.php*
```php
<?php foreach ($posts as $key => $post) : ?>

    <a class="btn btn-warning w-25" href="<?php echo 'edit.php?post_id=' . $post['id']; ?>">Modifica Post</a>

<?php endforeach ?>
```

*functions.php*
```php
function getSinglePostById($post_id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM posts WHERE id=$post_id AND user_id={$_SESSION['user_id']}");

    return mysqli_fetch_assoc($result);

};
```
*edit.php*
```php
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
```