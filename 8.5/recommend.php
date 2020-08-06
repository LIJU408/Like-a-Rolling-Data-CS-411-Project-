<?php
session_start();
include ("config.php");
include ("recommend_back.php");


$matrix1 = array();  // to calculate singer similarity
$matrix2 = array();  // to calculate genre similarity
$matrix3 = array();  // to calculate bpm similarity
$matrix4 = array();  // to calculate danceability similarity
$current_user = $_SESSION["username"];
// echo $current_user;
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$singerR = "SELECT userid, singer, AVG(ratings) as avgratings FROM (SELECT userid,ratings,singer FROM rating LEFT JOIN song ON rating.songid = song.songid) as temp GROUP BY userid,singer;";
$singerRating = mysqli_query($link,$singerR);

$genreR = "SELECT userid, genre, AVG(ratings) as avgratings FROM (SELECT userid,ratings,genre FROM rating LEFT JOIN song ON rating.songid = song.songid) as temp GROUP BY userid,genre";
$genreRating = mysqli_query($link,$genreR);

$bpmR = "SELECT userid, beatsperminute, AVG(ratings) as avgratings FROM (SELECT userid,ratings,beatsperminute FROM rating LEFT JOIN song ON rating.songid = song.songid) as temp GROUP BY userid,beatsperminute";
$bpmRating = mysqli_query($link,$bpmR);

$danceabilityR = "SELECT userid, danceability, AVG(ratings) as avgratings FROM (SELECT userid,ratings,danceability FROM rating LEFT JOIN song ON rating.songid = song.songid) as temp GROUP BY userid,danceability";
$danceabilityRating = mysqli_query($link,$danceabilityR);


$weight1 = $_POST['weight1']??0;
$weight2 = $_POST['weight2']??0;
$weight3 = $_POST['weight3']??0;
$weight4 = $_POST['weight4']??0;


while ($rate1 = mysqli_fetch_array($singerRating))
{
    $users = mysqli_query($link,"select username from users where id = $rate1[userid]");
    $username = mysqli_fetch_array($users);
    $matrix1[$username['username']][$rate1['singer']] = $rate1['avgratings'];
    // print_r($users);
}

while ($rate2 = mysqli_fetch_array($genreRating))
{
    $users = mysqli_query($link,"select username from users where id = $rate2[userid]");
    $username = mysqli_fetch_array($users);
    $matrix2[$username['username']][$rate2['genre']] = $rate2['avgratings'];
    // print_r($users);
}

while ($rate3 = mysqli_fetch_array($bpmRating))
{
    $users = mysqli_query($link,"select username from users where id = $rate3[userid]");
    $username = mysqli_fetch_array($users);
    $matrix3[$username['username']][$rate3['beatsperminute']] = $rate3['avgratings'];
    // print_r($users);
}

while ($rate4 = mysqli_fetch_array($danceabilityRating))
{
    $users = mysqli_query($link,"select username from users where id = $rate4[userid]");
    $username = mysqli_fetch_array($users);
    $matrix2[$username['username']][$rate4['danceability']] = $rate4['avgratings'];
    // print_r($users);
}



/*echo "<pre>";

print_r($matrix);
echo "</pre>";*/

$recommendation = getRecommendation($matrix1, $weight1, $matrix2, $weight2, $matrix3, $weight3, $matrix4, $weight4, $current_user);

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
            background-image: url("sounds-header6.jpg"); 
        }
        .wrapper1 { 
            width: 350px; 
            /*padding: 20px;*/
            position: absolute;
            top:40px;
            right:200px;
        }
        .form-control {
            width:200px;
        }
        .form-group {
            position: absolute;
            left:20px;
        }
        .weight-input {
            position: absolute;
            top:150px;
            left:120px;
        }
        .friend-table {
            width: 500px;
            position: absolute;
            top:180px;
            right:200px;
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
        h4{
            color:white;
        }
        .goback:link{
            text-decoration: none;
        }
        
        .gohead:link{
            text-decoration: none;
        }
        .button {
            border: none;
            color: white;
            padding: 12px 40px;
            text-align: left;
            text-decoration: none;
            font-size: 16px;
            margin: 12px 32px;
            cursor: pointer;
            background-color: #008CBA;
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


<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="weight-input" method="POST">
    <div class="col-xs-7">
    <label for="SBS">Singer Weight:</label>
    <input type="text" class="form-control" name="weight1">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-7">
    <label for="SBS">Genre Weight:</label>
    <input type="text" class="form-control" name="weight2">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-7">
    <label for="SBS">BPM Weight:</label>
    <input type="text" class="form-control" name="weight3">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-7">
    <label for="SBS">Danceability Weight:</label>
    <input type="text" class="form-control" name="weight4">
    </div>
    <br>
    <br>
    <br> 
    <br>
    <br>
    <br>
    <div class="col-xs-7">
    <input type="submit" class="btn btn-primary button" name="submit" value="submit">
    </div>
</form>
<div class="wrapper1">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-md-8 ">
                    <div class="page-header clearfix ">
                        <h2>Friends List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
                            $points=array();
                            $points=array_values($recommendation);
                            $sorted_recommendation=array_multisort($points, SORT_DESC, $recommendation, SORT_NUMERIC);
                            $key_array=array();
                            $value_array=array();
                            $key_array=array_keys($recommendation);
                            $value_array=array_values($recommendation);
                            if (isset($_POST['submit'])) {
                                echo "<table class='table table-bordered table-striped friend-table'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Friend</th>";
                                                echo "<th>Score</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Location</th>";
                                                echo "<th>His Song List</th>";
                                            echo "</tr>";
                                        echo "<thead>";
                                        echo "<tbody>";
                                        for($i=0;$i<3;$i=$i+1) {
                                            $current_friend=$key_array[$i];
                                            $email_sql="SELECT email FROM users WHERE username='$current_friend';";
                                            $location_sql="SELECT location FROM users WHERE username='$current_friend';";
                                            $email_result=mysqli_query($link,$email_sql);
                                            $email_array=mysqli_fetch_array($email_result);
                                            $email_value=$email_array[0];
                                            $location_result=mysqli_query($link,$location_sql);
                                            $location_array=mysqli_fetch_array($location_result);
                                            $location_value=$location_array[0];
                                            echo "<tr>";
                                            echo "<td>" . $key_array[$i] . "</td>";
                                            echo "<td>" . round($value_array[$i]*100,3) . "</td>";
                                            echo "<td>" . $email_value. "</td>";
                                            echo "<td>" . $location_value. "</td>";
                                            echo"<td><form action='recommend_following.php' method='post'>
                                                    <input type='hidden' name='id' value=$current_friend>
                                                    <button type='submit' name='sub' value='subed'>View</button>
                                            </form></td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";      
                                    echo "</table>";

                            } 

                            ?>


