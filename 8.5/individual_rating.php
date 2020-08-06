<?php
include "config.php";
session_start();
$song = $_SESSION["songid"];
$userid=$_SESSION['id'];

$genresql = "SELECT genre FROM song WHERE songid = $song";
$genreresult = mysqli_query($link,$genresql);
$genretotal = mysqli_fetch_array($genreresult)[0];

if(strpos($genretotal,'rock') !== false){ 
	$genre = 'rock' ; 
}

else if(strpos($genretotal,'pop') !== false){ 
	$genre = 'pop' ; 
}

else if(strpos($genretotal,'metal') !== false){ 
	$genre = 'guitar' ; 
}

else{ 
	$genre = 'standard' ; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Rating</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>-->
    <style type="text/css">
        body{ font: 18px sans-serif;
        background-image: url("<?php echo $genre?>.jpg")
		; }
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
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
        .container{
            height:52px;
            width:100%;
            background-color:#001120;
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
        .rating_input {
        	position:absolute;
        	left:40px;
        	top:160px;
			width:380px;
			height:50px;
        }
        .go_back_again {
        	text-decoration: none;
        	color:white;
        }
		.secondtable{
            position: absolute;
            width: 350x;
            margin: 0 auto;
            top: 120px;
            left: 100%;
			text-align: center;
        }
		.button1{
            width: 800x;
            margin: 0 auto;
            top: 150px;
            left: 0px;
			border: none;
            color: white;
            padding: 12px 24px;
            text-align: left;
            text-decoration: none;
            font-size: 16px;
            margin: 12px 32px;
            cursor: pointer;
            background-color: #008CBA;
		}
		.button2{
            width: 350x;
            margin: 0 auto;
            top: 150px;
            left: 100px;
			border: none;
            color: white;
            padding: 12px 24px;
            text-align: right;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 12px 32px;
            cursor: pointer;
            background-color: #008CBA;
		}
		h2{
			text-align: center;
		}
		th{
			text-align: center;
		}
		.rate_input{
			height:50px;
		}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<?php  
	if(isset($_POST["submit"])){
		$rating = $_POST["rating"];
	}else{
		$rating = '-1';
	}
	
	$index_1=0;
	$songid_array=array();
	$confirm_songid_sql="SELECT songid FROM rating WHERE userid=$userid;";
	$confirm_songid_result=mysqli_query($link,$confirm_songid_sql);
	if (mysqli_num_rows($confirm_songid_result)>0) {
	    while($row=mysqli_fetch_array($confirm_songid_result)) {
	        $songid_array[$index_1]=$row['songid'];
	        $index_1=$index_1+1;
	    }
	}
	//store existing userid in rating as an array(to determine update or insert)
	$index_2=0;
	$userid_array=array();
	$confirm_userid_sql="SELECT userid FROM rating;";
	$confirm_userid_result=mysqli_query($link,$confirm_userid_sql);
	if (mysqli_num_rows($confirm_userid_result)>0) {
	    while($row=mysqli_fetch_array($confirm_userid_result)) {
	        $userid_array[$index_2]=$row['userid'];
	        $index_2=$index_2+1;
	    }
	}
	//echo 'rating'.$rating.'<br>song'.$song.'<br>userid'.$userid.'<br>submit'.$_POST["submit"];
	if($rating == '-1'){
		//$sql="";
	}else if($rating == 'cancel'){
		$sql = "DELETE  FROM rating WHERE songid=$song AND userid=$userid;";
		if (mysqli_query($link,$sql)) {
			echo "succ";
		} else{
			echo"error" . $sql . '' . mysqli_error($link);
		}
	}else{
		if (in_array($userid,$userid_array) AND in_array($song,$songid_array)){
			$sql = "UPDATE rating SET ratings=$rating WHERE songid=$song AND userid=$userid;";
		}else{
			$sql = "INSERT INTO rating VALUES ('$userid','$song', '$rating');";
		}
		if (mysqli_query($link,$sql)) {
			//echo "succ";
		} else{
			echo"error" . $sql . '' . mysqli_error($link);
		}
		//$sql = "INSERT INTO rating VALUES ('$userid','$song', '$rating');";
	}
	// echo '<br> sql'.$sql;
	//mysql_query($conn, $sql);

	
	$get_name_sql="SELECT SongName FROM song WHERE SongID = $song;";
	$get_result=mysqli_query($link,$get_name_sql);
	$get_array=mysqli_fetch_array($get_result);
	$get_value=$get_array[0];
	$avg_cal_sql="SELECT AVG(ratings) FROM rating WHERE songid = $song;";
	$avg_result=mysqli_query($link,$avg_cal_sql);
	$avg_array=mysqli_fetch_array($avg_result);
	$avg_value=$avg_array[0];
	$avg_value=round($avg_value,3);
	$count_user_sql="SELECT count(userid) FROM rating WHERE songid=$song;";
	$count_result=mysqli_query($link,$count_user_sql);
	$count_array=mysqli_fetch_array($count_result);
	$count_value=$count_array[0];
	$count_add_sql="SELECT count(userid) FROM adding WHERE songid=$song;";
	$count_add_result=mysqli_query($link,$count_add_sql);
	$count_add_array=mysqli_fetch_array($count_add_result);
	$count_add_value=$count_add_array[0];
	$max_rating_sql="SELECT max(ratings) FROM rating WHERE songid=$song;";
	$max_result=mysqli_query($link,$max_rating_sql);
	$max_array=mysqli_fetch_array($max_result);
	$max_value=$max_array[0];
	$min_rating_sql="SELECT min(ratings) FROM rating WHERE songid=$song;";
	$min_result=mysqli_query($link,$min_rating_sql);
	$min_array=mysqli_fetch_array($min_result);
	$min_value=$min_array[0];

	mysqli_close($link);
?>

<div class="container">
  
    <div class="main-title"><a style="color:white" class="goback" href="search.php"> <b>FrienZongs</b></a></div>
    <div class="welcome">
        <a class="gohead" href="personal.php"><h4>Hi,<b><?=$_SESSION["username"]?></b>&nbsp;&nbsp;</h4></a>
    </div>
    <div class="logout">
        <a href="logout.php" class="gohead"><h4>Log Out</h4></a>
    </div>

  
</div>

<div class="rating_input">
<form method="POST">
	<h2>Rate <?php echo $get_value?></h2>
	<br>
	<br>
	<input class="form-control rate_input" type='text' name='rating' placeholder="Enter your rating here!">
	<br>
	<br>
	<button  class="btn btn-primary button1" type='submit' name="submit" value="submit">Confirm</button>
	<a href="test.php" class="btn btn-primary button2">Rate another</a>
</form>
</div>
<!--<div class="information_song">
	<h2>The statistics of  <?php echo $get_value?></h2>
	<h4>How many people rate the song:<?php echo $count_value?></h4>
	<h4>How many people add the song:<?php echo $count_add_value?></h4>
	<h4>The maximum rating:<?php echo $max_value?></h4>
	<h4>The minimum rating:<?php echo $min_value?></h4>
	<h4>The average rating:<?php echo $avg_value?></h4>
</div>-->


<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                
<?php
	echo "<table class='table table-bordered table-striped secondtable'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>The statistics of&nbsp".$get_value."</th>";
	echo "</tr>";
	echo "<thead>";
	echo "<tbody>";
	echo "<tr>";
	echo "<td>How many people rate the song:&nbsp".$count_value."</td>";
	echo "</tr>";
	echo "</tr>";
	echo "<td>How many people add the song:&nbsp".$count_add_value."</td>";
	echo "</tr>";
	echo "</tr>";
	echo "<td>The maximum rating:&nbsp".$max_value."</td>";
	echo "</tr>";
	echo "</tr>";
	echo "<td>The minimum rating:&nbsp".$min_value."</td>";
	echo "</tr>";
	echo "<td>The average rating:&nbsp".$avg_value."</td>";
	echo "</tr>";
	echo "</tbody>";
	echo "</table>";

?>
            </div>        
        </div>
    </div>
</div>

</body>
</html>