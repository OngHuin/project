<?php
require_once('DatabaseCode.php');

header('Content-Type: application/json');

$email = sanitizeInput($_POST['email']);

$response = array();
$validation = validate($email, 'Email', 'user');

$response['exists'] = (mysqli_num_rows($validation) > 0);

echo json_encode($response);
?>
