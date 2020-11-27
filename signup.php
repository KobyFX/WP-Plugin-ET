<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
    <form action = 'signup.php' method = 'post'>
    <img src="images/logo/SmashTalk.png" class="img-responsive" alt="Smash Talk Logo">
        <h2 class="text-center">Sign Up</h2> 

        <input type = 'text' name = 'username' class="form-control" value = '' placeholder = 'username' required>
        </br>
        <input type = 'text' name = 'email' class="form-control" value = '' placeholder = 'email' required>
        </br>
        <input type = 'password' name = 'password' class="form-control" value = '' placeholder = 'password' required>
        </br>
        <button type = 'submit' name = 'submit' class="btn btn-primary">submit</button>
        <a href='login.php' class="pull-right">already have an account?</a>
    </form>
</div>
</body>
</html>

<?php
require_once('connect.php');

$name_err = $pass_err  = $email_err = "";

if(isset($_POST['submit'])){

    //checking name
    $input_name = trim($_POST['username']);
        if(!preg_match("/^[a-zA-Z ]*$/", $input_name) || empty($input_name)){
            $name_err = "Please enter a valid name!";
            echo $name_err . '<br>';
        }
    //////

    // checking password
    $input_password = trim($_POST['password']);
    if(empty($input_password)){
        $pass_err = "please enter a password!";
        echo $pass_err . '<br>';
    }
    ///////

    // checking email + update
    $input_email = trim($_POST['email']);
    if(empty($input_email) || !filter_var($input_email, FILTER_VALIDATE_EMAIL)){
        $email_err = "please enter a valid email!";
        echo $email_err . '<br>';
    }

    if(empty($name_err) && empty($pass_err) && empty($email_err)){
        $sql = "insert into member(id, username, password, email) values (id, '$input_name', '$input_password', '$input_email')";
        if(mysqli_query($conn, $sql)){
            echo "Congrats, your account has been created <a href='login.php'>login in now</a>";
        }else{
            echo "Sorry but something gone wrong!";
        }
    }

}

?>