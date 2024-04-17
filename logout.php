<?php

if (session_status() === PHP_SESSION_ACTIVE) {
    echo "SESSION EXISTS!" . "<br>";
    var_dump($_SESSION);
} else {
    echo "SESSION DOES NOT EXISTS! STARTING SESSION..." . "<br>";
    session_start();
    var_dump($_SESSION);
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

// echo "setting session to empty array" . "<br>";

// session_unset();

// var_dump($_SESSION) . "<br>";

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

$_SESSION['message'] = "Logout effettuato con successo";
$_SESSION['error'] = null;

// var_dump($_SESSION['message']);

header("Location: index.php");
exit();
