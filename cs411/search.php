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
        .wrapper{ width: 700px; padding: 20px; }
        .main-title {
            background-color:whitesmoke ;
            width: 500px;
            border: 15px palegreen;
            padding: 50px;
            margin: 20px;
            top: 8px;
            left: 16px;
        }
        .logout {
            position: absolute;
            right: 8px;
            bottom: 16px;
        }
        .welcome {
            position: absolute;
            right: 8px;
            top: 16px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1 class="main-title"> Songs Leading Friends</h1>
<div class="welcome">
        <h4>Hi, <b><?php echo $_SESSION["username"]; ?></b>.</h4>
</div>
<div class="wrapper">
<form class="search region" method="POST">
    <label for="SBS">Search By Singer:</label>
    <input type="text" name="singer">
    <lable>&nbsp;</label>
    <br>
    <br>
    <label for="SBN">Search By Song Name:</label>
    <input type="text" name="name">
    <br>
    <br>
    <label for="SBY">Search By Release Year: From</label>
    <input type="text" name="year1">
    <lable>To</label>
    <input type="text" name="year2">
    <br>
    <br>
</form>

<button>Search</button>
<br>
<br>
<p class="logout">
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
</p>
</div>
<?php
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
mysqli_close($link);
?>
</body>
</html>
