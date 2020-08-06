<?php
session_start();
?>
<?php    

#Fetching the city from ipstack

$url = "http://api.ipstack.com/check?access_key=7184746f9d7ae7a116f11f634fbdb157&format=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response);

$city  = $response->city;

?>

<?php
$apiKey = "fbf652243dd227d900588132132aafbc";
   if (isset($_GET["cityname"]))
            {
       
                $cityName = $_GET["cityname"]; 
                $city = $cityName;
            }else
            {
                $cityName = $city;
            }
            
            
#fetching the weather from openweathermap using the city
            
$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityName . "&lang=en&units=metric&APPID=" . $apiKey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response);

$currentDate = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">-->
    <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif;
        background-image: url("sounds-header.jpg"); }
        .wrapper{ 
            width: 600px; 
            padding: 0px;
            position: absolute;
            right:45px;
            top:145px;
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
        .AllSongs{
            position: absolute;
            width: 300px;
            border: 5px;
            padding: 4.5px;
            margin: 1px;
            left:150px;
            top:0px;
            text-align: center;
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
        



        .Songs {
            position: absolute;
            left: 50px;
            bottom: 95px;
        }
        .Insert {
            position: absolute;
            left: 50px;
            bottom: 5px;
        }
        .Recommend {
            position: absolute;
            left: 50px;
            bottom: 50px;
        }
        
        .left-buttons {
            position: absolute;
            right: 1375px;
            bottom: 64px;
        }
        .button {
            border: none;
            color: white;
            padding: 15px 64px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 24px 64px;
            cursor: pointer;
            background-color: #008CBA;
        }
        .gohead:link{
            text-decoration: none;
        }
        h4 {
            color: white;
        }


        .weather-container {
            border: #E0E0E0 1px solid;
            padding: 15px 20px 20px 20px;
            border-radius: 2px;
            width: 275px;
            margin: 0 auto;
            position: absolute;
            top: 2px;
            right:1065px;
            font-family: Arial;
            font-size: 0.95em;
            color: #000000;
        }
        .weather-icon {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
  
    <div class="main-title"><p style="color:white"> <b>FrienZongs</b></p></div>
    <div class="AllSongs">
        <a href="all_song.php" class="gohead"><h4>Show All Songs</h4></a>
    </div>
    <div class="welcome">
        <a class="gohead" href="personal.php"><h4>Hi,<b><?=$_SESSION["username"]?></b>&nbsp;&nbsp;</h4></a>
    </div>
    <div class="logout">
        <a href="logout.php" class="gohead"><h4>Log Out</h4></a>
    </div>

  
</div>

<div class="wrapper">
<form action="deliver.php" class="search region" method="POST">
    <div class="col-xs-6">
    <label for="SBS">Search By Singer:</label>
    <input type="text" class="form-control" name="singer">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-6">
    <label for="SBN">Search By Song Name:</label>
    <input type="text" class="form-control" name="name">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-6">
    <label for="SBG">Search By Song Genre:</label>
    <input type="text" class="form-control" name="genre">
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="col-xs-6">
    <label for="SBY">Search By Release Year:</label>
    </div>
    <br>
    <br>
    <div class="col-xs-3">
    <label>From</label>
    <input type="text" class="form-control" name="year1">
    </div>
    <div class="col-xs-3">
    <label>To</label>
    <input type="text" class="form-control" name="year2">
    </div>
    <br>
    <br>
    <br>
    <br>
    <button class="button">Search</button>
</form>

<div class="left-buttons">

<p class="Songs">
        <a href="rsbw.php" class="btn btn-danger">Recommend Songs to You</a>
</p>
<p class="Insert">
        <a href="insert.php" class="btn btn-danger">Add Songs That Have Not Been Included</a>
</p>
<p class="Recommend">
        <a href="recommend.php" class="btn btn-danger">Recommend New Friends to You</a>
</p>
</div>




<div class="weather-container">
        <?php 
        #validation for city name
            if($data->cod != 200){
                echo 'Plese enter a valid city';
            }
        ?>
        <div class="date">
         
            <div><?php if(isset($data->name)){echo "Location: ".$data->name;}else{ echo "Location: ".$city ;} ?></div>
            </br>
            <div><?php echo date("jS F, Y",$currentDate); ?></div>
        </div>
        <div class="weather-forecast">
            <?php 
            #validation if we do not get a successful response
            if($data->cod == 200){ ?>
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <?php echo $data->main->temp_max; ?>&deg;C / <span
                class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
                </br>
                </div>
                <?php echo "Weather Description: ".$data->weather[0]->description; ?>;
                
                
        
        </div>
            <?php } ?>

        <!--
         <h3>Enter a city to search</h3>
         <form action ="weather.php" method="get">
         <input type="text" pattern="[A-Za-z]+" name="cityname" title="City name may only contain letters" />
         <input type="submit" value="Go" /> </form>
        </div>
        -->







<br>
<br>

<?php
/*$singername = $_POST["singer"]??"";
$songname = $_POST["name"]??"";
$year1 = $_POST["year1"]??0;

//Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password)
$link = mysqli_connect("localhost", "root", "", "cs411");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(empty($_POST["year2"])){
    // Attempt select query execution
    $sql = "SELECT * FROM song WHERE Singer LIKE '%$singername%' AND SongName LIKE '%$songname%' AND ReleaseDate>='$year1'";
}else{
    $year2 = $_POST["year2"];
    $sql = "SELECT * FROM song WHERE Singer LIKE '%$singername%' AND SongName LIKE '%$songname%' AND ReleaseDate>='$year1' AND ReleaseDate<='$year2'";
}
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>SongID</th>";
                echo "<th>SongName</th>";
                echo "<th>Singer</th>";
                echo "<th>ReleaseDate</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['SongID'] . "</td>";
                echo "<td>" . $row['SongName'] . "</td>";
                echo "<td>" . $row['Singer'] . "</td>";
                echo "<td>" . $row['ReleaseDate'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);*/
?>
</body>
</html>
