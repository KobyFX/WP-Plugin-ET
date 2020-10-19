<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
    <form action = 'login.php' method = 'post'>
        <label for="exampleInputEmail1">User Name:</label>
        <input type = 'text' name = 'username1' class="form-control" id="exampleInputEmail1" value = '' placeholder = 'username'>

        <label for="exampleInputPassword1">Password</label>
        <input type = 'password' name = 'password1' class="form-control" id="exampleInputPassword1" value = '' placeholder = 'password'>

        </br>
        <button type = 'submit' class="btn btn-primary" name = 'submit'>submit</button>
        <a href='signup.php'>don't have an account?</a>
    </form>
    
</body>
</html>

<?php
require_once('connect.php');

$username1 = $_POST['username1'] ?? '';
$password1 = $_POST['password1'] ?? '';

$result = mysqli_query($conn, "select * from member where username='$username1' and password = '$password1'");
$row = mysqli_fetch_array($result);


if(isset($row['username'])){
    if($row['username'] == $username1 and $row['password'] == $password1){
        session_start();
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("Location: ../project x/index.php?login=success");
        exit();

    }
}elseif(isset($row['username']) != $username1 and isset($row['password']) != $password1){
    echo 'false information piss off';
}


?>