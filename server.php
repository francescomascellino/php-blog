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
