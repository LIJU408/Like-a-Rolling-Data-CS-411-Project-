<?php
session_start();
?>
<?php
$_SESSION['current_friend']=$_POST['id'];
header("Location:friend_song_list.php");
exit;
?>