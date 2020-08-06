<?php
session_start();
include "config.php";
?>
<?php
$_SESSION['songid']=$_POST['id'];
echo $_SESSION['songid'];
$currentsong=$_SESSION['songid'];
$searchuser=$_SESSION['id'];
$delete_sql="DELETE FROM adding WHERE songid=$currentsong AND userid=$searchuser;";
if(mysqli_query($link, $delete_sql)){
echo "<td>".'Success'."</td>";//"Records were updated successfully.";
} else {
    echo "<td>Error</td>";
}
header("Location:personal.php");
exit;
?>