<?php

if (session_status() === PHP_SESSION_ACTIVE) {
    echo "SESSION EXISTS!" . "<br>";
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
} else {
    session_start();

    echo "SESSION DOES NOT EXISTS! STARTING SESSION..." . "<br>";

    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
}

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

echo "<br>";

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

$_SESSION['message'] = "Logout effettuato con successo.";
$_SESSION['error'] = null;

header("Location: index.php");
// header("Location: index.php?logout");
exit();
