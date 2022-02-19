<?php 
include("database_connect.php");
// $test = mysqli_query($conn,"select * from gen_data where  live_check=0 ");
// $gen = array();
// while($row = mysqli_fetch_assoc($test)){
//   $gen[] = $row['gen_name'];
// }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <!-- <meta http-equiv="refresh" content="1"/> -->
	<title>History</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link rel="stylesheet" href="./css/history.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
	<div class="header">
		<text>Smart Plant Management System</text>
		<div class="header-right">
		<a href="./index.php">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Home-icon.svg/1200px-Home-icon.svg.png" alt="">
			<span>Home</span>
		</a>
		<a href="./history.php" class="active">
			<img src="https://cdn-icons-png.flaticon.com/512/32/32223.png" alt="">
			<span>History</span>
		</a>
		<span class="vertical_line"></span>
		<a  id="new_gen_btn" >
			<img src="https://user-images.githubusercontent.com/21024245/35808218-c177e6cc-0a8d-11e8-929c-f8452748642b.png" alt="">
			<span>Compare</span>
		</a>
		</div>
	</div>
	<!-- <div class="header">
		<text>Smart Plant Monitoring System</text>
		<div class="header-right">
			<a href="./index.php">Home</a>
			<span></span>
			<a href="./history.php">History</a>
			<a href="./compare.html" id="compare" >Compare</a>
		</div> -->
	</div>
	<div class="container-box">
		<section class="upper">
			<div id="container_1" class="detail-cont">
				<table>
				<tr>
					<td>Genration : </td>
					<td id="gen_in"></td>
				</tr>
				<tr>
					<td>Plant : </td>
					<td id="plant_in">></td>
				</tr>
				<tr>
					<td>Condition : </td>
					<td id="condition"></td>
				</tr>
				<tr>
					<td>Start Date : </td>
					<td id="start_dt"></td>
				</tr>
				<tr>
					<td>End Date : </td>
					<td id="end_dt"></td>
				</tr>
				</table>
				<!-- <div class="details"><span class="label">Genration</span><span class="details_in" id="gen_in"></span></div>
				<div class="details"><span class="label">Plant</span><span class="details_in" id="plant_in"></span></div>
				<div class="details"><span class="label">Condition</span><span class="details_in" id="condition"></span></div>
				<div class="details"><span class="label">Start Date</span><span class="details_in" id="start_dt"></span></div>
				<div class="details"><span class="label">End Date</span><span class="details_in" id="end_dt"></span></div> -->
			</div>
			<div id="container_2" class="detail-cont">
				<table>
					<th colspan="3" >Temperature</th>
					<tr>
						<td>Day : </td>
						<td id="temp_day"></td>
						<td>Night : </td>
						<td id="temp_night">></td>
					</tr>
					<th colspan="2" >Humidity</th>
					<tr>
						<td>Day : </td>
						<td id="humid_day"></td>
						<td>Night : </td>
						<td id="humid_night">></td>
					</tr>
					<th colspan="2" >Moisture</th>
					<tr>
						<td>Day : </td>
						<td id="moist_day"></td>
						<td>Night : </td>
						<td id="moist_night">></td>
					</tr>
				</table>
				<!-- <div class="details">Room Temperature</div>
				<div class="details">
					<span class="label">Day&nbsp;:&nbsp;</span><span class="details_in" id="temp_day"></span>
					<span class="label">Night&nbsp;:&nbsp;</span><span class="details_in" id="temp_night"></span>
				</div>
				<div class="details">Humidity</div>
				<div class="details">
					<span class="label">Day&nbsp;:&nbsp;</span><span class="details_in" id="humid_day"></span>
					<span class="label">Night&nbsp;:&nbsp;</span><span class="details_in" id="humid_night"></span>
				</div>
				<div class="details">Moisture</span></div>
				<div class="details">
					<span class="label">Day&nbsp;:&nbsp;</span><span class="details_in" id="moist_day"></span>
					<span class="label">Night&nbsp;:&nbsp;</span><span class="details_in" id="moist_night"></span>
				</div> -->
			</div>
			<div id="container_3" class="detail-cont">
			<table>
				<tr>
					<td>Quality of the plant : </td>
					<td id="quality_in">
						
					</td>
				</tr>
				<tr>
					<td>Growth Rate : </td>
					<td id="growth_in">></td>
				</tr>
				<tr>
					<td>Disease Name : </td>
					<td id="dis_name_in"></td>
				</tr>
				<tr>
					<td>Disease Details : </td>
					<td id="dis_detail_in"></td>
				</tr>
				</table>
				<!-- <div class="details"><span class="label">Quality of the plant</span><span class="details_in" id="quality_in"></span></div>
				<div class="details"><span class="label">Growth Rate</span><span class="details_in" id="growth_in"></span></div>
				<div class="details"><span class="label">Disease Name</span><span class="details_in" id="dis_name_in"></span></div>
				<div class="details"><span class="label">Disease Details</span><span class="details_in"  id="dis_detail_in"></span></div>
				<div class="details"><span class="label"></span><span class="details_in"></span></div> -->
			</div>
			<!-- <div>4</div> -->
		</section>
		<section class="middle">
			<div class="graph">
				<div class="select-options">
					<select name="para" class="slct" id="day_select">
						<option value="select" selected="selected">- All -</option>
					</select>
					<select name="para" class="slct" id="time_select">
						<option value="select" selected="selected">- Select -</option>
						<option value="all" >24 Hrs</option>
						<option value="day" >Day</option>
						<option value="night" >Night</option>
					</select>
					<select name="para" class="slct" id="graph_select">
						<option value="select">- Select -</option>
						<option value="temp"  selected="selected" >Temprature</option>
						<option value="humid" >Humidity</option>
						<option value="moist" >Moisture</option>
						<option value="light" >Light</option>
					</select>
				</div>
				<div class="chart">
					<canvas id="myChart" height="26%" width="100%"></canvas>
					<!-- <canvas id="temp_chart" height="26%" width="100%"></canvas>
					<canvas id="humid_chart" height="26%" width="100%"></canvas>
					<canvas id="moist_chart" height="26%" width="100%"></canvas>
					<canvas id="light_chart" height="26%" width="100%"></canvas> -->
				</div>
			</div>
		</section>
		<section class="bottom">
			<div id="temp">
				<span class="unit_lbl">°C</span>
				<input type="number" name="para" id="temp_in" value="0" disabled>
				<label for="">Avg. Temperature</label>
			</div>
			<div id="humid">
				<span class="unit_lbl">%</span>
				<input type="number" name="para" id="humid_in" value="0" disabled>
				<label for="">Avg. Humidity</label>
			</div>
			<div id="moist">
				<span class="unit_lbl">%</span>
				<input type="number" name="para" id="moist_in" value="0" disabled>
				<label for="">Avg. Moisture</label>
			</div>
			<div id="light">
				<span class="unit_lbl">lux</span>
				<input type="number" name="para" id="light_in" value="0" disabled>
				<label for="">Avg. Light</label>
			</div>
			<div id="weeks">
				<br>
				<input type="number" name="para" id="weeks_in" value="0" disabled>
				<label for="">No Of Weeks</label>
			</div>
			<div id="days">
				<br>
				<input type="number" name="para" id="days_in" value="0" disabled>
				<label for="">No of days</label>
			</div>
		</section>
		<section class="image-sec" id="sec4">
			<h3>Images</h3>
			<div id="photos_box">
				<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
			<!-- <div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			</div> -->
			<div class="carousel-inner" id="image-cont">
				<!-- <div class="carousel-item active" >
				<img src="..." class="d-block w-100 "  height=400 id="sumit" alt="...">
				<div class="carousel-caption d-none d-md-block">
					<h5 id=h5-1 >First slide label</h5>
					<p  id=p-2 >Some representative placeholder content for the first slide.</p>
				</div>
				</div> -->
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
			</div>
		</section>
	</div>
	<div class="ask_gen" id="ask_frame">
		<div class="ask_box">
			<div><center><h3>Choose Genration to view History</h3></center></div>
			<div class="ask_contain">
		</div>

		</div>
	</div>
	<script src="./js/history.js"></script>
</body>

</html>
