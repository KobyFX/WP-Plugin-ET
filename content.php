<?php 
if(!defined('INDEX')) die('');

$PAGE = array('dashboard', 'chat', 'profile', 'settings', 'sign out');

if(isset($_GET['page'])) $page=$_GET['page'];
else $page = 'dashboard';

foreach ($page as $p) {
if($page == $p) {
    include ='content/$h.php';
    break;
}
}
?>