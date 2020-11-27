<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to SmashTalk</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
	.login-form {
		width: 50%;
    	margin: 3vh auto;
	}
    .login-form form {
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 5%;
    }
    .img-responsive{
        margin: 0 auto;
    }
    @media only screen and (max-width: 600px){
        .login-form {
		width: 80%;
	}
    }

</style>
</head>
<body>
<div class="login-form">
    <form action = 'login.php' method = 'post'>
    <img src="images/logo/SmashTalk.png" class="img-responsive" alt="Smash Talk Logo">
        <h2 class="text-center">Log in</h2> 
        

        <label for="username1">User Name:</label>
        <input type = 'text' name = 'username1' class="form-control" id="username1" value = '' placeholder = 'username' required>

        <label for="password1">Password</label>
        <input type = 'password' name = 'password1' class="form-control" id="password1" value = '' placeholder = 'password' required>

        </br>
        <button type = 'submit' class="btn btn-primary" name = 'submit'>submit</button>
        <a href='signup.php' class="pull-right">don't have an account?</a>
    </form>
</div>
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
        header("Location: index.php?login=success");
        exit();

    }
}elseif(isset($row['username']) != $username1 and isset($row['password']) != $password1){
    echo 'please enter valid information';
}


?>