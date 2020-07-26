<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
        background-image: url("sounds-header.jpg"); }
        .wrapper{ 
            width: 700px; 
            padding: 0px;
            position: absolute;
            left:30px;
            top:100px;
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
        /*.logout {
            position: absolute;
            right: 30px;
            bottom: 16px;
        }*/
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
        .left-buttons {
            position: absolute;
            left: 1300px;
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
            margin: 24px 72px;
            cursor: pointer;
            background-color: #008CBA;
        }
        .gohead:link{
            text-decoration: none;
        }
        h4 {
            color: black;
        }
    </style>
</head>
<body>
<div class="main-title"><h4> Songs Leading Friends</h4></div>
<div class="welcome">
        <a class="gohead" href="personal.php"><h4>Hi, <b><?php echo $_SESSION["username"]; ?></b>.</h4></a>
</div>
<div class="wrapper">
<form action="test.php" class="search region" method="POST">
    <div class="col-xs-6">
    <label for="SBS">Search By Singer:</label>
    <input type="text" class="form-control" name="singer">
    </div>
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


<br>
<br>
<div class="left-buttons">
<p class="logout">
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
<p class="Songs">
        <a href="test.php" class="btn btn-danger">Show All the Songs</a>
</p>
</div>
</div>
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
