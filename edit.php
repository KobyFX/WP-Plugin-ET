<?php
session_start();
require_once('connect.php');

$name_err = $pass_err  = $email_err = "";

if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
   $sql = "select * from member where id = '$id'";
   $row = mysqli_fetch_array(mysqli_query($conn, $sql));
   $name = $row['username'];
   $email = $row['email'];
   
}else{
    header("Location: error.php");
}

if(isset($_POST['submit'])){

    //checking name + update
    $input_name = trim($_POST['name']);
        if(!preg_match("/^[a-zA-Z ]*$/", $input_name)){
            $name_err = "Please enter a valid name!";
        }
        elseif(!empty($input_name)){
            mysqli_query($conn, "update posts set name = '$input_name' where id = $id");
            $namesql = "update member set username = '$input_name' where id = $id ";
            mysqli_query($conn, $namesql);
            $_SESSION['username'] = $input_name;
            echo '<p>congrats your name has been updated to ' . $input_name . '</p>';
        } else{
            $name_err = "Please enter a valid name";
        }
    //////

    // checking password + update
    $input_password = trim($_POST['password']);
    if(!empty($input_password)){
        $passsql = "update member set password = '$input_password' where id = $id ";
        mysqli_query($conn, $passsql);
        echo '<p>congrats your password has been updated</p>';
    }elseif(empty($input_password)){
        echo '<p>password still the same</p>';
    } else{
        $pass_err = "passord wasn't updated!";
    }
    ///////

    // checking email + update
    $input_email = trim($_POST['email']);
    if(!empty($input_email)){
        $emailsql = "update member set email = '$input_email' where id = $id ";
        mysqli_query($conn, $emailsql);
        echo '<p>congrats your email has been updated to' . $input_email . '</p>';
    } else{
        $email_err = "email wasn't updated!";
    }
    //////

    //profile pic
    if(isset($_FILES["file"])){
    $targetDir = "images/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    }
    if(!empty($fileName)){
        $picsql = "update member set profile_pic = '$fileName' where id = $id ";
        mysqli_query($conn, $picsql);
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        echo 'congrats your profile pic has been updated';
    }else{
        echo "profile picture wasn't updated";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit your profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
	.edit-form {
		width: 50%;
    	margin: 3vh auto;
	}
    .edit-form form {
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 5%;
    }
    .img-responsive{
        margin: 0 auto;
    }
    @media only screen and (max-width: 600px){
        .edit-form {
		width: 80%;
	}
    }

</style>
</head>
<body>
<div class="edit-form">
    <form  method = 'post' enctype="multipart/form-data">

    <a href="index.php"><img src="images/logo/SmashTalk.png" class="img-responsive" alt="Smash Talk Logo"></a>
    <h2>Edit your profile</h2>

        <label for="name">UserName:</label>
        <input type = 'text' name = 'name' class="form-control" id="name" value = '<?php echo $name ?>' placeholder = 'New username'>
        <span class="help-block"><?php echo $name_err;?></span>

        <label for="password">Password:</label>
        <input type = 'password' name = 'password' class="form-control" id="password" value = '' placeholder = 'New password'>

        <label for="email">UserName:</label>
        <input type = 'text' name = 'email' class="form-control" id="email" value = '<?php echo $email ?>' placeholder = 'New email'>

        <label>Upload New Profile Picture</label>
        <input type="file" name="file" id="file">

        </br>
        <button type = 'submit' class="btn btn-primary" name = 'submit'>apply edits</button>
        <a href='index.php'>back to Homepage</a>
    </form>
</div>
</body>
</html>

