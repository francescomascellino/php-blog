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