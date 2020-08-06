<?php
    include "config.php";
    include "getweather.php";
    
    session_start();
   //$genre="";
    //From weather to get the recommended genre and from temperatrue to get the bpm range
    //Table weather -> genre 
    if($weather=="Clear"){
        $genre="pop";
    }else if($weather=="Clouds"){
        $genre="adult standards";
    }else if($weather=="Rain"){
        $genre="rock";
    }else{
        $genre="metal";
    }



    //$temperature (range differs in different season ) to bpm(range: 50 - 210) - linear regression relation
    //Judge the season and adjust relation coffieffient between the temperatrue and bpm range
    if ($season == 'Spring' || $season == 'Summer')
    //Suppose $temperature is in range(-10 °C - 40 °C)
    {
        $k1 = (50 - 210) / (40 + 10);
        $b1 = 50 - $k1 * 40   ; 
        $bpm = $temperature * $k1 + $b1;
    }
    else//Suppose $temperature is in range(-40 °C - 20 °C)
    {
        $k2 = (50 - 210) / (20 + 40);
        $b2 = 50 - $k1 * 20;
        $bpm = $temperature * $k2 + $b2;
    }
    
    // $dancaibility range in [15:95]
    $Actualtime = date("g");
    // Sweep out sleepy feeling
    if ( $Actualtime >= 0 && $Actualtime <= 6){
        $danceability = 70;
    } 

    // Wake up people just get up
    else if ( $Actualtime >= 6 && $Actualtime <= 8){
        $danceability = 50;
    } 

    // Soft music
    else {
        $danceability = 30;
    }



    //Preparation to select top 10 ratings songs for every genre;
    $get_genre_ratings_sql="SELECT songname, ratings FROM song NATURAL JOIN rating WHERE genre like '$genre' AND (BeatsPerMinute > ($bpm -  30) AND BeatsPerMinute < ($bpm + 30)) ";
    $genre_ratings=mysqli_query($link,$get_genre_ratings_sql);

    $RecommendRatings = array();
    while ($rate = mysqli_fetch_array($genre_ratings))
    {
        $RecommendRatings[$rate['songname']] = $rate['ratings'];
    }

    $points=array();
    $points=array_values($RecommendRatings);
    array_multisort($points, SORT_DESC, $RecommendRatings, SORT_NUMERIC);
    //$set_sort1 = array_multisort($points, SORT_DESC, $genreRatings, SORT_NUMERIC);//Sort genreRatings desc; Return Bool value 
    $key_array=array();
    $value_array=array();
    $key_array=array_keys($RecommendRatings);
    $value_array=array_values($RecommendRatings);

?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lemonada">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Chilanka">

  


    <style type="text/css">
        body { 
            font: 14px sans-serif;
		/* background-image: $SongID; } */
            background-image: url("sounds-header6.jpg"); 
        }
        .wrapper1 { 
            width: 600px; 
            padding: 20px;
            position: absolute;
            top:20px;
            right:168px;
            text-align:center;
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
        .explanation{
            position: absolute;
            width: 350px;
            border: 5px;
            padding: 4.5px;
            margin: 0px;
            left:70px;
            top:180px;
            font-size:20px;
            font-family:'Lemonada';
        }
        </style>
</head>

<body>


<div class="explanation">
        <p>Today is <?=$today->format('m-d-Y')?>.<br> I am located in <?=$city?>.<br>The weather is "<?=$weather?>".<br>The average temperture is <?=$temperature?>&deg;C.<br>We recommend these songs for you based on the local weather and tempreture.</p>
</div>



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
                        <h2>Songs List</h2>
                    </div>


<?php
    //if ($set_sort1 = 1){
        // Print the recommended songs table
        echo "<table class='table table-bordered table-striped friend-table'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Song</th>";
                /*echo "<th>SongName</th>";
                echo "<th>Singer</th>";
                echo "<th>Year</th>";
                echo "<th>&nbsp;Genre&nbsp;</th>";*/
                echo "<th>Ratings</th>";
            echo "</tr>";
        echo "<thead>";
        echo "<tbody>";
    
    $number = count($RecommendRatings);
    //echo $number;
    for($i=0;$i<$number - 1;$i=$i+1){
        echo "<tr>";
        echo "<td>" . $key_array[$i] . "</td>";
        echo "<td>" . round($value_array[$i],3) . "</td>";
        echo "</tr>";
    }

    

    echo "</tbody>";      
    echo "</table>";
?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


