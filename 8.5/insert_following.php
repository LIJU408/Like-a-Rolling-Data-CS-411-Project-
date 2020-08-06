<?php
session_start();
include("config.php");
?>
<?php
$singername=$_POST['singer'];
$songname=$_POST['name'];
$year=$_POST['year'];
$genre=$_POST['genre'];
//echo $singername;
//echo $songname;
//echo $year;
//echo $genre;
$insertsql="INSERT song (SongName,Singer,ReleaseDate,Genre,BeatsPerMinute,Danceability) VALUES ('$songname','$singername','$year','$genre','TBD','TBD');";
//$insertsql="INSERT song (SongID,SongName,Singer,ReleaseDate,Genre,BeatsPerMinute,Danceability) VALUES ('1468','$songname','$singername','$year','$genre','TBD','TBD');";
if(mysqli_query($link, $insertsql)){
	//echo "<td>".'Success'."</td>";//"Records were updated successfully.";
	$success=1;
} else {
	//echo "<td>Error</td>";
	$success=0;
}
header("Location:insert.php?success={$success}");
exit;

?>