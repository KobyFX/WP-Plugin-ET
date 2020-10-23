<?php
session_start();
require_once('connect.php');
$msg = $_POST['msg'];

$sql = "insert into posts (msg) values ('$msg')";
$result = mysqli_query($conn, $sql);

header("Location: index.php");
?>