<?php
require_once ('DatabaseCode.php');

$posttitle = sanitizeInput($_POST['posttitle']);
$postdescription = sanitizeInput($_POST['postdescription']);
$postimage = $_POST['postimage'];
$startdate = sanitizeInput($_POST['startdate']);
$enddate = sanitizeInput($_POST['enddate']);
$remark = sanitizeInput($_POST['remark']);

$postdate = date("d/m/Y");

if(isset($_POST['btnpostcreate'])){   
    if (createPost($posttitle, $postdescription, $postimage, $startdate, $enddate, $remark, $postdate)) {
        redirect('#', 'Post created Succesfully!');
    } else {
        redirect('#', 'Post are not created.');
    }
}
?>