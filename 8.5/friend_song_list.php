<?php
session_start();
include("config.php");
$current_friend=$_SESSION['current_friend'];
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.studentstutorial.com/demo/css/style.css">
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
	<link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

    <style type="text/css">
        body { 
            font: 14px sans-serif;
		/* background-image: $SongID; } */
            background-image: url("sounds-header.jpg"); 
        }
        .song-table {
        	position: absolute;
        	width:500px;
        	top:200px;
        	left:50px;
        }
        .wrapper1 {
        	position: absolute;
        	width: 700px;
        	top:50px;
        	left:50px;
        }
        .goback:link{
            text-decoration: none;
        }
        
        .gohead:link{
            text-decoration: none;
        }
        h4 {
            color: white;
        }
        .main-title {
            position: absolute;
            width: 200px;
            border: 0px;
            padding: 2px;
            margin: 0px;
            left:12px;
            top:0px;
            text-align: center;
            font-family:'Sofia';
            font-size:27px;
            
        }
        .welcome {
            position: absolute;
            width: 300px;
            border: 5px;
            padding: 4.5px;
            margin: 1px;
            right:120px;
            top:0px;
            text-align: right;

        }
        .logout {
            position: absolute;
            width: 100px;
            border: 5px;
            padding: 4.5px;
            margin: 0px;
            right:0px;
            top:0px;
            text-align: center;

        }
        .container{
            height:52px;
            width:100%;
            background-color:#001120;
        }

    </style>
</head>

<body>
<div class="container">
  
    <div class="main-title"><a style="color:white" class="goback" href="search.php"> <b>FrienZongs</b></a></div>
    <div class="welcome">
        <a class="gohead" href="personal.php"><h4>Hi,<b><?=$_SESSION["username"]?></b>&nbsp;&nbsp;</h4></a>
    </div>
    <div class="logout">
        <a href="logout.php" class="gohead"><h4>Log Out</h4></a>
    </div>
</div>
<div class="wrapper1">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-md-8 ">
                    <div class="page-header clearfix ">
                        <h2> <?php echo $current_friend."'s Song List"?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
$get_id_sql="SELECT id FROM users WHERE username='$current_friend';";
$get_result=mysqli_query($link,$get_id_sql);
$get_array=mysqli_fetch_array($get_result);
$get_value=$get_array[0];
$query_adding_sql="SELECT * FROM adding,song WHERE adding.songid=song.SongID AND adding.userid=$get_value";
	$query_adding_result=mysqli_query($link,$query_adding_sql);
	if (mysqli_num_rows($query_adding_result)>0) {
		echo "<table class='table table-bordered table-striped song-table'>";
            echo "<thead>";
                echo "<tr>";
                    // echo "<th>SongID</th>";
                    echo "<th>SongName</th>";
                    echo "<th>Singer</th>";
                    echo "<th>Year</th>";
                    echo "<th>&nbsp;Genre&nbsp;</th>";
                    echo "<th>Add</th>";
                echo "</tr>";
            echo "<thead>";
            echo "<tbody>";
            while($row=mysqli_fetch_array($query_adding_result)) {
            	$currentsong=$row['SongID'];
            	echo "<tr>";
            	echo "<td>" . $row['SongName'] . "</td>";
            	echo "<td>" . $row['Singer'] . "</td>";
                echo "<td>" . $row['ReleaseDate'] . "</td>";
                echo "<td>" . $row['Genre'] . "</td>";
            	echo "<td><form action='adding_2.php' method='post'>
                        <input type='hidden' name='id' value=$currentsong>
                        <button type='submit' name='sub' value='subed'>Add</button>
                    </form></td>";
            	echo "</tr>";
            }
	}
?>