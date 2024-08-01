<?php 
require_once('Heading.php');
require_once('AccessControl.php');
require_once('DatabaseCode.php');
loggedin();

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="userprofile">
        <h2>User Information</h2>
        <?php datadisplay($email, 'Email', 'user'); ?>
    </div>
</body>
</html>
