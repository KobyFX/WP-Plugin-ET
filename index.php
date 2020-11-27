<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmashTalk MainPage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body{
            width: 80%;
            margin: 0 auto;
        }
        .result{
            height: 50vh;
            overflow-y: scroll;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <header>
    <?php
        session_start();
        require_once('connect.php');
        if(isset($_SESSION['userid'])):
            $id = $_SESSION['userid'];
            $sql = "select username from member where id = '$id'";
            $row = mysqli_fetch_array(mysqli_query($conn, $sql));
            $name = $row['username'];

    ?>
        <a href="index.php"><img src="images/logo/SmashTalk.png" class="img-responsive" alt="Smash Talk Logo"></a>
        <a href="edit.php" class="btn btn-success pull-right">edit profile</a>
        <p class="login-status">Welcome back <?= $name; ?></p>
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-primary" name="logout-submit">Logout</button>
        </form>
    </header>


    <div>
        <div class="result" id="result">
            <!-- messages will be placed here --> 
        </div>


        <form method = "post" action = "send.php">
            <input type = "text" name="msg" placeholder="Type here.." class="form-control"></br>
            <input type="submit" value="send" class="btn btn-success">
        </form>
        

        <?php elseif(!isset($_SESSION['userid'])): 
                header("Location: login.php");
            ?>
        
        <?php else: 
                header("Location: error.php");
            endif;
        ?>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.0.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
setInterval(function(){
    $(".result").load('messages.php'); // messages will come from this file 
}, 500);
});

</script>
