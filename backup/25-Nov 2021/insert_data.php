<?php
include("database_connect.php");
$date = date("Y-m-d H:i:s");
$table = ''; 
$test = mysqli_query($conn,"select * from gen_data where end_date is null and live_check=1 order by id desc limit 1");
if (isset($test)) {
while($row = mysqli_fetch_assoc($test)){
	$table = $row['gen_name'];
	}
}	
if(isset($_GET['flag'])){
	switch ($_GET['flag']) {
		case '0':
			$rtemp = $_GET['temp'];
			$light = $_GET['light'];
			$hum = $_GET['humid'];
			$moi = $_GET['moist'];
			$try = mysqli_query($conn,"insert into `".$table."`  values('',".$rtemp.",".$hum.",".$moi.",".$light.",'".$date."','".$date."','".$date."')");
			echo 'sucess';
			break;	
		case '1':
			mysqli_query($conn,"update gen_data set live_check = 0, end_date = '".$date."' where end_date is null and gen_name='".$table."'");
			echo 'done';
			break;
		case '2':
			$name = $_GET['name'];
			$plant = $_GET['plant'];
			$cond = $_GET['cond'];
			$m_t = $_GET['min_t'];
			$x_t = $_GET['max_t'];
			$m_h = $_GET['min_h'];
			$x_h = $_GET['max_h'];
			$m_m = $_GET['min_m'];
			$x_m = $_GET['max_m'];
			$sql = "insert into gen_data (gen_name, plant_name, plant_condition,min_temp, max_temp, min_humid, max_humid, min_moist, max_moist, start_date, end_date, live_check) VALUES ('$name','$plant', '$cond',$m_t, $x_t, $m_h, $x_h, $m_m, $x_m, '".$date."', NULL, 1)";
			mysqli_query($conn,$sql);
			echo "gen_data Updated";
			$sql2 = "create table `".$name."`( id INT(10) NOT NULL AUTO_INCREMENT , room_temp INT(10) NOT NULL , humidity INT(10) NOT NULL , moisture INT(10) NOT NULL , light INT(10) NOT NULL , date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP , time TIME NOT NULL DEFAULT CURRENT_TIMESTAMP , timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(6) , PRIMARY KEY (id)) ENGINE = InnoDB";
			echo $sql2;
			mysqli_query($conn,$sql2);
			break;
		case '3':
			$src = $_REQUEST['src'];
			if (empty($src)) {
				echo "src is empty";
			} else {
				$sql = "insert into photos (gen_name,week,image,date,timestamp) values('".$_GET['gen']."',".$_GET['week'].",'".$src."','".$date."','".$date."')";
				$test = mysqli_query($conn,$sql);
				if(!empty($test)){
					echo "Phot uploaded sucessfully";
				}
				else{
					echo "Select Proper week or Other error Try again !";
				}
			}
			break;
		default:
			echo('wrong value');
			break;
	}
}
else{
	echo "not set";
}
?>