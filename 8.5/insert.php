<?php
session_start();
include("config.php");
//include("insert_following.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

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
            padding: 15px 54px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 15px;
            margin: 24px 64px;
            cursor: pointer;
            background-color: #008CBA;
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
        .success{
            position: absolute;
            width: 25%;
            top: 75px;
            left: 5%;
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


<div class="success">
        <h3><?php
            if (isset($_GET['success'])) {
                echo "The song you inserted has successfully entered our website. Now you can start rating!";
            }
        ?></h3>
</div>


<div class="wrapper">
<form action="insert_following.php" class="search region" method="POST">
    <div class="col-xs-6">
    <label for="SBS">Enter Singer:</label>
    <input type="text" class="form-control" name="singer">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-6">
    <label for="SBN">Enter Song Name:</label>
    <input type="text" class="form-control" name="name">
    </div>
    <br>
    <br>
    <br>
    <br> 
    <br>
    <div class="col-xs-6">
    <label for="SBG">Enter Song Genre:</label>
    <input type="text" class="form-control" name="genre">
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="col-xs-6">
    <label for="SBY">Enter Release Year:</label>
    <input type="text" class="form-control" name="year">
    </div>
    <br>
    <br>
    <br>
    <br>
    <button class="button">Add Song</button>
</form>
</body>
</html>