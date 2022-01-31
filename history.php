<?php 
include("database_connect.php");
$test = mysqli_query($conn,"select * from gen_data where  live_check=0 ");
$gen = array();
while($row = mysqli_fetch_assoc($test)){
  $gen[] = $row['gen_name'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <!-- <meta http-equiv="refresh" content="1"/> -->
	<title>History</title>
	<link rel="stylesheet" href="./css/history.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
</head>
<body>
	<div class="header">
		<text>Smart Plant Monitoring System</text>
		<div class="header-right">
		<a href="./index.php">Home</a>
		<span></span>
		<a href="#hist">History</a>
		<a href="#compare" id="compare" >Compare</a>
		</div>
	</div>
	<div style="height: 50px; width: 100vw;"></div>
	<div class="container">
		<div class="upper">
			<div id="container_1">
				<div class="details"><span class="label">Genration</span><span class="details_in" id="gen_in"></span></div>
				<div class="details"><span class="label">Plant</span><span class="details_in" id="plant_in"></span></div>
				<div class="details"><span class="label">Condition</span><span class="details_in" id="condition"></span></div>
				<div class="details"><span class="label">Start Date</span><span class="details_in" id="start_dt"></span></div>
				<div class="details"><span class="label">End Date</span><span class="details_in" id="end_dt"></span></div>
			</div>
			<div id="container_2">
				<div class="details"><span class="label">Quality of the plant</span><span class="details_in" id="quality_in"></span></div>
				<div class="details"><span class="label">Growth Rate</span><span class="details_in" id="growth_in"></span></div>
				<div class="details"><span class="label">Disease Name</span><span class="details_in" id="dis_name_in"></span></div>
				<div class="details"><span class="label">Disease Details</span><span class="details_in"  id="dis_detail_in"></span></div>
				<div class="details"><span class="label"></span><span class="details_in"></span></div>
			</div>
			<div id="container_3">
				<div class="details">Room Temperature</div>
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
				</div>
			</div>
			<!-- <div>4</div> -->
		</div>
		<div class="middle">
			<div class="graph">
				<select name="para" class="slct" id="graph_select">
					<option value="temp" selected="selected">Room Temprature</option>
					<option value="humid" >Humidity</option>
					<option value="moist" >Moisture</option>
					<option value="light" >Light</option>
				</select>
				<select name="para" class="slct" id="time_select">
					<option value="none" selected="selected">-:-</option>
					<option value="day" >Day</option>
					<option value="night" >Night</option>
				</select>
				<div class="chart">
					<canvas id="myChart" height="26%" width="100%"></canvas>
					<!-- <canvas id="temp_chart" height="26%" width="100%"></canvas>
					<canvas id="humid_chart" height="26%" width="100%"></canvas>
					<canvas id="moist_chart" height="26%" width="100%"></canvas>
					<canvas id="light_chart" height="26%" width="100%"></canvas> -->
				</div>
			</div>
		</div>
		<div class="bottom">
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
		</div>
	</div>
	<div class="ask_gen" id="ask_frame">
		<span id="choose_gen">Choose Generation which you want to open</span>
		<div class="ask_contain">
		</div>
	</div>
	<script src="./js/history.js"></script>
</body>

</html>
