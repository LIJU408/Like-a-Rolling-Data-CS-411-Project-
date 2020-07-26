<?php
	include'process.php';
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
    <style type="text/css">
        body{ font: 14px sans-serif;
		/* background-image: $SongID; } */
        background-image: url("migito.jpg"); }
        .wrapper{ width: 350px; padding: 20px; }
        .main-title {
            background-color:whitesmoke ;
            width: 500px;
            border: 15px palegreen;
            padding: 50px;
            margin: 20px;
            top: 8px;
            left: 16px;

        }
		.checked {
			color: orange;
		}
	</style>
</head>
<body>
<div class="row container">
<div class="col-md-4 ">

<h1 class="main-title"
	<b>Rating </b>
	<div class="row">
	
		<div class="col-md-6">
			<h3 align="center"><b><?php echo round($AVGRATE,1);?></b> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i></h3>
			<p> <?=$Total;?> ratings </p>
		</div>
		<div class="col-md-6">
			<?php
			while($db_rating= mysqli_fetch_array($rating)){
			?>
				<h4 align="center"><?=$db_rating['ratings'];?> <i class="fa fa-star" data-rating="2" style="font-size:20px;color:green;"></i> Total <?=$db_rating['Total'];?></h4>
				
				
			<?php	
			}
				
			?>
		</div>
	</div>

		<span  onmouseover="starmark(this)" onclick="starmark(this)" id="1one" style="font-size:40px;cursor:pointer;"  class="fa fa-star checked"></span>
		<span onmouseover="starmark(this)" onclick="starmark(this)" id="2one"  style="font-size:40px;cursor:pointer;" class="fa fa-star "></span>
		<span onmouseover="starmark(this)" onclick="starmark(this)" id="3one"  style="font-size:40px;cursor:pointer;" class="fa fa-star "></span>
		<span onmouseover="starmark(this)" onclick="starmark(this)" id="4one"  style="font-size:40px;cursor:pointer;" class="fa fa-star"></span>
		<span onmouseover="starmark(this)" onclick="starmark(this)" id="5one"  style="font-size:40px;cursor:pointer;" class="fa fa-star"></span>
		<br/>

		<button  onclick="result()" type="button" style="margin-top:10px;margin-left:5px;" class="btn btn-lg btn-success">Submit</button>
	<script>
		var count;

		function starmark(item)
		{
		count=item.id[0];
		sessionStorage.starRating = count;
		var subid= item.id.substring(1);
		for(var i=0;i<5;i++)
		{
		if(i<count)
		{
		document.getElementById((i+1)+subid).style.color="orange";
		}
		else
		{
		document.getElementById((i+1)+subid).style.color="black";
		}


		}

		}

		function result()
		{
		//Rating : Count
		//Review : Comment(id)
		alert("Rating : "+count+"\nReview : "+document.getElementById("comment").value);
		}

	</script>

	
	</h1>
</div>
</div><br>
<input type="hidden" name="demo_id" id="demo_id" value="1">
<div class="col-md-4">
<!--<input type="text" class="form-control" name="username" id="username" placeholder="username"><br>-->
<!--<textarea class="form-control" rows="5" placeholder="Write your review here..." name="remark" id="remark" required></textarea><br>-->
<p><button  class="btn btn-default btn-sm btn-info" id="srr_rating">Submit</button></p>
</div>


</body>
</html>