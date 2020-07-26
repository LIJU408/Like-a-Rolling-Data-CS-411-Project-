<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information of all Songs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>-->
    <style type="text/css">
        body{ font: 14px sans-serif;
        background-image: url("sounds-header.jpg"); }
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
            width: 250px;
            border: 15px;
            padding: 10px;
            margin: 5px;
            left:30px;
            top:16px;
            background-color: #b2f5d9;
            text-align: center;
        }
        .welcome {
            position: absolute;
            background-color:#b2f5d9;
            width: 250px;
            border: 15px;
            padding: 10px;
            margin: 5px;
            right:30px;
            top:16px;
            text-align: center;
        }
        .goback:link{
            text-decoration: none;
        }
        .gohead:link{
            text-decoration: none;
        }
        h4 {
            color: black;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="main-title"><a class="goback" href="search.php"><h4> Songs Leading Friends</h4></a></div>
<div class="welcome">
        <a class="gohead" href="personal.php"><h4>Hi, <b><?php echo $_SESSION["username"]; ?></b>.</h4></a>
</div>
<form method="POST">
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Information about Songs</h2>
                        <input type="submit" class="btn btn-primary" value="Confirm Rating" name="Confirm Rating">
                    </div>
</form>
<?php
$searchuser = $_SESSION["id"];
$singername = $_POST["singer"]??"";
$songname = $_POST["name"]??"";
$year1 = $_POST["year1"]??0;

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "demo");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//store existing songid in rating as an array(to determine update or insert)
$index_1=0;
$songid_array=array();
$confirm_songid_sql="SELECT songid FROM rating WHERE userid=$searchuser;";
$confirm_songid_result=mysqli_query($link,$confirm_songid_sql);
if (mysqli_num_rows($confirm_songid_result)>0) {
    while($row=mysqli_fetch_array($confirm_songid_result)) {
        $songid_array[$index_1]=$row['songid'];
        $index_1=$index_1+1;
    }
}
print_r($songid_array);
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
print_r($userid_array);
if (in_array($searchuser,$userid_array)) {
    print("userid check is fine!");
}


if(empty($_POST["year2"])){
    // Attempt select query execution
    $sql = "SELECT * FROM song LEFT JOIN (SELECT * FROM rating WHERE userid=$searchuser) AS temp ON song.SongID=temp.songid WHERE Singer LIKE '%$singername%' AND SongName LIKE '%$songname%' AND ReleaseDate>='$year1'";
}else{
    $year2 = $_POST["year2"];
    $sql = "SELECT * FROM song LEFT JOIN (SELECT * FROM rating WHERE userid=$searchuser) AS temp ON song.SongID=temp.songid WHERE Singer LIKE '%$singername%' AND SongName LIKE '%$songname%' AND ReleaseDate>='$year1' AND ReleaseDate<='$year2'";
}

// $existed_songs=array();
// $confirmsql="SELECT songid FROM rating;";
// $confirmresult=mysqli_query($link,$confirmsql);
// if (mysqli_num_rows($confirmresult)>0) {
//     while($row=mysqli_fetch_assoc($confirmresult)) {
//         $existed_songs[]=$row;
//     }
// }
// print_r($existed_songs);

if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>SongID</th>";
                    echo "<th>SongName</th>";
                    echo "<th>Singer</th>";
                    echo "<th>ReleaseYear</th>";
                    echo "<th>AvgRating</th>";
                    echo "<th>PreviousRating</th>";
                    echo "<th>RatingInput</th>";
                    echo "<th>NewRating</th>";

                echo "</tr>";
            echo "<thead>";
            echo "<tbody>";
            //$ratingarray=array();
            //$numberofrating=0;
            $i=0;
            while($row = mysqli_fetch_array($result)){
            //$row = mysqli_fetch_array($result);
                $currentsong = $row["SongID"];
                $avg_cal_sql="SELECT AVG(ratings) FROM rating WHERE songid = $currentsong;";
                $avg_result=mysqli_query($link,$avg_cal_sql);
                $avg_array=mysqli_fetch_array($avg_result);
                $avg_value=$avg_array[0];
                echo "<tr>";
                    echo "<td>" . $row['SongID'] . "</td>";
                    echo "<td>" . $row['SongName'] . "</td>";
                    echo "<td>" . $row['Singer'] . "</td>";
                    echo "<td>" . $row['ReleaseDate'] . "</td>";
                    echo "<td>" . round($avg_value,3) . "</td>";
                    echo "<td>" . $row['ratings'] . "</td>";
                    echo "<td><input type='text' class='form-control' name='New<?=$i?>'</td>";
                    /*if(!empty($_POST["NewR"])){
                        echo "<td>" . $_POST["NewR"] . "</td>";
                    }else{
                        echo "<td>Error</td>";
                    }*/
                    if(!empty($_POST["New<?=$i?>"])){
                        if ($_POST["New<?=$i?>"]!="cancel") {
                            $NewRating=$_POST["New<?=$i?>"];
                            /*$subratingarray = array($currentsong,$NewRating);
                            $ratingarray[$numberofrating]=$subratingarray;
                            $numberofrating=$numberofrating+1;*/
                            $updatesql = "UPDATE rating SET ratings=$NewRating WHERE songid=$currentsong AND userid=$searchuser;";
                            $insertsql="INSERT rating (userid,songid,ratings) VALUES('$searchuser','$currentsong','$NewRating');";
                            if (in_array($searchuser,$userid_array) AND in_array($currentsong,$songid_array)) {
                                echo "Enter update stage!";
                                if(mysqli_query($link, $updatesql)){
                                    echo "<td>".$NewRating."</td>";//"Records were updated successfully.";
                                } else {
                                echo "<td>Error</td>";
                                }
                            } else {
                                echo "Enter insert stage!";
                                if(mysqli_query($link, $insertsql)){
                                echo "<td>".$NewRating."</td>";//"Records were updated successfully.";
                                } else {
                                echo "<td>Error</td>";
                                }
                            }
                        } else {
                            echo "cancel!";
                            $deletesql="DELETE FROM rating WHERE songid=$currentsong AND userid=$searchuser;";
                            if (mysqli_query($link,$deletesql)) {
                                echo "<td>NoInput</td>";
                            } else {
                                echo "<td>Error</td>";
                            }
                        }
                    } else {
                        echo "<td>NoInput</td>";
                    }
                echo "</tr>";
                $i=$i+1;
            }
            /*for($i=0;$i<$numberofrating;$i=$i+1){
                $updatesql = "UPDATE rating SET ratings=$ratingarray[$numberofrating][1] WHERE songid=$ratingarray[$numberofrating][0] AND userid=$searchuser";
                if(mysqli_query($link, $updatesql)){
                    echo "<td>Success!Please Reload the Page</td>";//"Records were updated successfully.";
                } else {
                    echo "<td>Error</td>";
                }
            }*/
            echo "</tbody>";      
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "No songs matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>