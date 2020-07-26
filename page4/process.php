<?php
	//include "test.php";
	$servername='localhost';
	$username='root';
	$password='';
	$dbname = "cs411";
	$conn=mysqli_connect($servername,$username,$password,"$dbname");
	if(!$conn){
		die('Could not Connect My Sql:' .mysql_error());
	}

	// fetch the background phto; test.php should store the songid in $SongID when onclick the rating button
	//$query = mysqli_query($conn,"SELECT Image as bg from photo where SongID = $SongID");
	$query = mysqli_query($conn,"SELECT Image as bg from photo");
	$row = mysqli_fetch_array($query);
	$BackGround=$row['bg'];

	// fetch the URL OF songs; test.php should store the songid in $SongID when onclick the rating button
	// Database should add a column of url to the photo Table
	//$query = mysqli_query($conn,"SELECT Image as bg from photo where SongID = $SongID");
	//$query = mysqli_query($conn,"SELECT url as lurl from photo");
	//$row = mysqli_fetch_array($query);
	//$song_url=$row['url'];

	// fetch the average ratings
	$query = mysqli_query($conn,"SELECT AVG(ratings) as AVGRATE from rating where songid = 1");
	$row = mysqli_fetch_array($query);
	$AVGRATE=$row['AVGRATE'];
	// fetch the total number of users of ratings of a song
	$query = mysqli_query($conn,"SELECT count(ratings) as Total from rating where songid = 1");
	$row = mysqli_fetch_array($query);
	$Total=$row['Total'];
	//$query = mysqli_query($conn,"SELECT count(remark) as Totalreview from  rating_data where status=1");
	//$row = mysqli_fetch_array($query);
	//$Total_review=$row['Totalreview'];
	//$review = mysqli_query($conn,"SELECT remark,rating,email from rating_data where status=1 order by date_time desc limit 4 ");
	$rating = mysqli_query($conn,"SELECT count(*) as Total,ratings from rating group by ratings order by ratings desc");
?>