<?php
session_start();
?>
<?php
$_SESSION['post-data'] = $_POST;
// print_r($_SESSION['post-data']) ;
// echo $_SESSION['post-data']['name'];
// echo $songname;
header("Location:test.php");
exit;
?>