<?php
$servername = "localhost";
$username = "localuser";
$password = "HelloWorld!";
$database = "fyp";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Database connection failed!");
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES);
}

function validate($item, $attribute, $table){
    global $conn;
    $item = mysqli_real_escape_string($conn, $item);
    $query = "SELECT * FROM $table WHERE $attribute = '$item'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function validate2($item1, $item2, $attribute1, $attribute2, $table){
    global $conn;
    $item1 = mysqli_real_escape_string($conn, $item1);
    $item2 = mysqli_real_escape_string($conn, $item2);
    $query = "SELECT * FROM $table WHERE $attribute1 = '$item1' AND $attribute2 = '$item2'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function redirect($url, $message) {
    echo "<script>alert('$message'); window.location.href='$url';</script>";
    exit();
}

function getAll($table) {
    global $conn;
    $query = "SELECT * FROM $table";
    $result = mysqli_query($conn, $query);
    return $result;
}

function addUser($email, $password, $name, $studentid, $programme, $contactnumber, $role) {
    global $conn;
    
    $query = "INSERT INTO user(Email, Password, Name, StudentID, Programme, ContactNumber, Role) VALUES ('$email', '$password', '$name', '$studentid', '$programme', '$contactnumber', '$role')";
    $result = mysqli_query($conn, $query);
    
    return $result;
}

function datadisplay($item, $attribute, $table) {
    global $conn;
    $item = mysqli_real_escape_string($conn, $item);
    $attribute = mysqli_real_escape_string($conn, $attribute);
    $table = mysqli_real_escape_string($conn, $table);
    
    $query = "SELECT * FROM $table WHERE $attribute = '$item'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        foreach ($data as $column => $value) {
            if ($table === 'user' && $column === 'Password') {
                continue;
            }
            echo "<p><strong>" . htmlspecialchars($column, ENT_QUOTES) . ":</strong> " . htmlspecialchars($value, ENT_QUOTES) . "</p>";
        }
    } else {
        echo "<p>Information could not be retrieved from the table: $table.</p>";
    }
}
