<?php
session_start();

/* 
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

$cookieParams = session_get_cookie_params();

echo "Cookie Name: " . session_name() . "<br>";
echo "Cookie Path: " . $cookieParams["path"] . "<br>";
echo "Cookie Domain: " . $cookieParams["domain"] . "<br>";
echo "Cookie Secure: " . ($cookieParams["secure"] ? 'Yes' : 'No') . "<br>";
echo "Cookie HttpOnly: " . ($cookieParams["httponly"] ? 'Yes' : 'No') . "<br>";
 */

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

session_start();

$_SESSION['message'] = "Logout effettuato con successo";

header("Location: index.php");
exit();
