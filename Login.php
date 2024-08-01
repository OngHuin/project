<?php
require_once('DatabaseCode.php');
session_start();

header('Content-Type: application/json');

$email = sanitizeInput($_POST['email']);
$password = sanitizeInput($_POST['password']);

$response = array();

$validation = validate($email, 'Email', 'user');

if (mysqli_num_rows($validation) != 0) {
    $loginvalidation = validate2($email, $password, "Email", "Password", "user");
    if (mysqli_num_rows($loginvalidation) != 0) {
        $user = mysqli_fetch_assoc($loginvalidation);
        $_SESSION['email'] = $user['Email'];
        $_SESSION['role'] = $user['Role'];
        
        $response['success'] = true;
        $response['message'] = 'Login Successfully!';
        $response['redirect'] = 'Home.php';
    } else {
        $response['success'] = false;
        $response['message'] = 'The account or password is incorrect!';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'This account is not yet registered!';
}

echo json_encode($response);
?>
