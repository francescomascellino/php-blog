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
        $_SESSION['error'] = null;

        // SETS THE SESSION VARIABLES
        $_SESSION['user_name'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];

        // REDIRECTS TO THE HOME PAGE
        header("Location: index.php");
    } else {

        $_SESSION['user_name'] = "WRONG PASSWORD";
        $_SESSION['user_id'] = "NONE";

        $_SESSION['message'] = null;
        $_SESSION['error'] =  "Utente trovato nel database ma password non corretta. / Nome Utente o Password errati.";

        header("Location: index.php");
    }
} else {
    // IF THERE IS NO ROW IN THE $result WE DO NOT HAVE A MATCHING USER REGISTERED IN THE DB
    $_SESSION['user_name'] = "USER NOT FOUND";
    $_SESSION['user_id'] = "NONE";

    $_SESSION['error'] =  "Utente non trovato nel database. / Nome Utente o Password errati.";
    $_SESSION['message'] = null;

    header("Location: index.php");
}

exit();
