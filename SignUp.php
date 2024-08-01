<?php
require_once ('DatabaseCode.php');

$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);
$name = sanitizeInput($_POST['name']);
$studentid = sanitizeInput($_POST['studentid']);
$programme = sanitizeInput($_POST['programme']);
$contactnumber = sanitizeInput($_POST['contactnumber']);
$role = sanitizeInput($_POST['role']);

if (addUser($email, $password, $name, $studentid, $programme, $contactnumber, $role)) {
    if ($role = "committee"){
        
    }
    redirect('Login.html', 'Account Register Succesfully!');
} else {
    redirect('Registration.html', 'Unknown domain or error.');
}
?>
