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
		<a href="compare" id="compare" >Compare</a>
		</div>
	</div>
	<div class="container">
		<div class="upper"></div>
		<div class="middle">
			<div class="graph">
				<select name="para" id="graph_select">
					<option value="temp" selected="selected">Room Temprature</option>
					<option value="temp" >Humidity</option>
					<option value="temp" >Moisture</option>
					<option value="temp" >Light</option>
				</select>
				<div>
					<canvas id="myChart" height="26%" width="100%"></canvas>
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
