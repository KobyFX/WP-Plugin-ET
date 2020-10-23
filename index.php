<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div>
<?php
session_start();
require_once('connect.php');
if(isset($_SESSION['userid'])){
    $sql = "select * from posts";
    $result = mysqli_query($conn, $sql);


    echo '<p class="login-status">you are logged in</p>';
    echo 'hello'." ".$_SESSION['username'];

    echo '<div class="output"> ';

        while($row = mysqli_fetch_assoc($result)){
            echo 'message:'.' ' .$row['msg'].'</br>';
        } 
        echo '</div>';
        

    echo '<form method = "post" action = "send.php">
    <input type = "text" name="msg" placeholder="Type here.." class="form-control"></br>
    <input type="submit" value="send">
    </form>';

    echo '<form action="logout.php" method="post">
        <button type="submit" class="btn btn-primary" name="logout-submit">Logout</button>
        </form>';

}elseif(!isset($_SESSION['userid'])){
    echo '<p class="login-status">you are logged out</p> <br>';
    
    echo '<a href="login.php">login now</a>';
}else{
    echo 'dont know why da fuck is it not working';
}


?>


</div>
</body>
</html>

