<?php
function loggedin() {
    session_start();

    if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
        header('Location: Login.html');
        exit();
    }
}

function isadmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

function iscommittee() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'committee';
}

function isadminorcommittee() {
    return isadmin() || iscommittee();
}
?>
