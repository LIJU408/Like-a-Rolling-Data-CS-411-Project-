<?php
session_start();
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

    <style type="text/css">
        body{ font: 14px sans-serif;
        background-image: url("sounds-header6.jpg"); }
        .wrapper{
            width: 550px;
            margin: 0 auto;
        }
        .title1{
            position: absolute;
            width: 25%;
            margin: 0 auto;
            top: 75px;
            left: 5%;
        }
        .title2{
            position: absolute;
            width: 15%;
            margin: 0 auto;
            top: 12px;
            left: 180%;
        }
        .page-header h2{
            margin-top: 0;
            text-align: center;
            
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .secondtable{
            position: absolute;
            width: 350x;
            margin: 0 auto;
            top: 125px;
            left: 180%;
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

        .goback:link{
            text-decoration: none;
        }
        
        .gohead:link{
            text-decoration: none;
        }
        h4 {
            color: white;
        }
        .main-table {
        	position: absolute;
        	top: 100px;
        	left:30px;
        }
        .update-profile {
            position: absolute;
            top: 120px;
            right:50px;
            width: 240px;
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
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
<div class="wrapper update-profile">
        <h2>Update Profile</h2>
        <p>Please fill in your information to get real friends.</p>
        <form action="personal_following.php" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>    
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
        </form>
</div> 
<div class="title1">
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-header clearfix">
                        <h2>My Song List</h2>
                    </div>

<?php
	$searchuser = $_SESSION["id"];
	$query_adding_sql="SELECT * FROM adding,song WHERE adding.songid=song.SongID AND adding.userid=$searchuser";
	$query_adding_result=mysqli_query($link,$query_adding_sql);
	if (mysqli_num_rows($query_adding_result)>0) {
		echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    // echo "<th>SongID</th>";
                    echo "<th>SongName</th>";
                    echo "<th>SingerName</th>";
                    echo "<th>Remove</th>";
                echo "</tr>";
            echo "<thead>";
            echo "<tbody>";
            while($row=mysqli_fetch_array($query_adding_result)) {
            	$currentsong=$row['SongID'];
            	echo "<tr>";
                echo "<td>" . $row['SongName'] . "</td>";
            	echo "<td>" . $row['Singer'] . "</td>";
                
            	echo "<td><form action='removing.php' method='post'>
                        <input type='hidden' name='id' value=$currentsong>
                        <button type='submit' name='sub' value='subed'>Remove</button>
                    </form></td>";
            	echo "</tr>";
            }
            echo "</tbody>";
        //echo "</table>";
	}

?>
                
            </div>        
        </div>
    </div>
</div>
</div>
<div class="title2">
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="page-header clearfix">
                        <h2>Personal Information</h2>
                    </div>


<?php
    $searchuser = $_SESSION["id"];
    $info_sql="SELECT email,location FROM users WHERE id ='$searchuser'";
    $hsong_sql="SELECT SongName FROM song WHERE SongID IN (SELECT SongID FROM rating WHERE userid=$searchuser and ratings >= ALL (SELECT ratings FROM rating WHERE userid=$searchuser))";
    $hsinger_sql="SELECT Singer FROM rating natural join song WHERE userid=$searchuser GROUP BY singer HAVING avg(ratings) >= ALL (SELECT avg(ratings) FROM rating natural join song WHERE userid=$searchuser GROUP BY singer)";
    $hgenre_sql="SELECT Genre FROM rating natural join song WHERE userid=$searchuser GROUP BY genre HAVING avg(ratings) >= ALL (SELECT avg(ratings) FROM rating natural join song WHERE userid=$searchuser GROUP BY genre)";
		echo "<table class='table table-bordered table-striped secondtable'>";
            echo "<thead>";
                echo "<tr>";
                    // echo "<th>SongID</th>";
                    echo "<th>Information</th>";
                    echo "<th>Information content</th>";
                echo "</tr>";
            echo "<thead>";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>Current Email</td>";
                    if($info_result=mysqli_query($link,$info_sql)){
                        $info_array=mysqli_fetch_array($info_result);
                        echo  "<td>".$info_array['email']."</td>";
                    }else{
                        echo "<td>NULL</td>";
                    }
            echo "</tr>";
            echo "</tr>";
            echo "<td>Current Location</td>";
                if($info_result=mysqli_query($link,$info_sql)){
                    echo  "<td>".$info_array['location']."</td>";
                }else{
                    echo "<td>NULL</td>";
                }
            echo "</tr>";
            echo "</tr>";
            echo "<td>Highest Rated Song</td>";
                if($hsong_result=mysqli_query($link,$hsong_sql)){
                    echo  "<td>";
                    while($hsong_row = mysqli_fetch_array($hsong_result)){
                        echo $hsong_row['SongName']."<br>";
                    }
                    echo "</td>";
                }else{
                    echo "<td>NULL</td>";
                }
            echo "</tr>";
            echo "</tr>";
            echo "<td>Highest Rated Singer</td>";
                if($hsinger_result=mysqli_query($link,$hsinger_sql)){
                    echo  "<td>";
                    while($hsinger_row = mysqli_fetch_array($hsinger_result)){
                        echo $hsinger_row['Singer']."<br>";
                    }
                    echo "</td>";
                }else{
                    echo "<td>NULL</td>";
                }
            echo "</tr>";
            echo "<td>Highest Rated Genre</td>";
                if($hgenre_result=mysqli_query($link,$hgenre_sql)){
                    echo  "<td>";
                    while($hgenre_row = mysqli_fetch_array($hgenre_result)){
                        echo $hgenre_row['Genre']."<br>";
                    }
                    echo "</td>";
                }else{
                    echo "<td>NULL</td>";
                }
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";



?>
                
            </div>        
        </div>
    </div>
</div>
</div>
</body>
</html>