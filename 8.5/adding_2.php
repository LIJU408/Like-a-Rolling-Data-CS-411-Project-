<?php
session_start();
include "config.php";
?>
<?php
$_SESSION['songname']=$_POST['id'];
$currentsong=$_SESSION['songname'];
$searchuser=$_SESSION['id'];
echo $currentsong;
echo $searchuser;
$insert_sql="INSERT adding (userid,songid) VALUES('$searchuser','$currentsong');";
$index_1=0;
$songid_array=array();
$confirm_songid_sql="SELECT songid FROM adding WHERE userid=$searchuser;";
$confirm_songid_result=mysqli_query($link,$confirm_songid_sql);
if (mysqli_num_rows($confirm_songid_result)>0) {
    while($row=mysqli_fetch_array($confirm_songid_result)) {
        $songid_array[$index_1]=$row['songid'];
        $index_1=$index_1+1;
    }
}
// print_r($songid_array);
//store existing userid in rating as an array(to determine update or insert)
$index_2=0;
$userid_array=array();
$confirm_userid_sql="SELECT userid FROM adding;";
$confirm_userid_result=mysqli_query($link,$confirm_userid_sql);
if (mysqli_num_rows($confirm_userid_result)>0) {
    while($row=mysqli_fetch_array($confirm_userid_result)) {
        $userid_array[$index_2]=$row['userid'];
        $index_2=$index_2+1;
    }
}
if (in_array($searchuser,$userid_array) AND in_array($currentsong,$songid_array)) {
	echo "Has been added!";
	
 } else {
        echo "Enter insert stage!";
        if(mysqli_query($link, $insert_sql)){
        echo "<td>".'Success'."</td>";//"Records were updated successfully.";
        } else {
        	echo "<td>Error</td>";
        }
    }
    header("Location:friend_song_list.php");
    exit;
?>