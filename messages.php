<?php 
  session_start();
  require_once('connect.php');
  $sql = "SELECT * from member as a inner join posts as p on a.id = p.id";
  $result = mysqli_query($conn, $sql);
?>

<?php while($row = mysqli_fetch_assoc($result)): ?>
  <div class ="alert alert-success">
    <?php if(isset($row['profile_pic'])): ?>
      <img src="images/<?= $row['profile_pic']; ?>" width='50px' height='50px' style='border-radius: 50px;' >
    <?php else: ?>
      <img src='images/blankpic.jpg' width='50px' height='50px' style='border-radius: 50px;'>
    <?php endif; ?>
    <?= $row['name'] .': ' . $row['msg'] . '</br>'; ?>
  </div>
<?php endwhile; ?>




