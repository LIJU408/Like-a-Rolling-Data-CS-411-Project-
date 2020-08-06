<?php
session_start();
include "config.php";
?>
<?php
$searchuser = $_SESSION["id"];
$email=$_POST["email"];
$location=$_POST["location"];
echo $searchuser;
echo $email;
echo $location;
$updatesql="UPDATE users SET email ='$email',location='$location' WHERE id=$searchuser;";
if(mysqli_query($link, $updatesql)){
	//echo "<td>".'Success'."</td>";//"Records were updated successfully.";
	header("Location:personal.php");
	exit;
} else {
	echo "<td>Error</td>";
}
?>