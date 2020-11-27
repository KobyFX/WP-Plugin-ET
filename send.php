<?php
session_start();
require_once('connect.php');

$msg = $_POST['msg'];
$id = $_SESSION['userid'];
$name = $_SESSION['username'];
$sanmsg = filter_var($msg, FILTER_SANITIZE_STRING);

$sql = "insert into posts(msg, name, id) values ('$sanmsg', '$name', '$id')";
$result = mysqli_query($conn, $sql);

header("Location: index.php");
?>