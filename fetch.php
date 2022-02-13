<?php
include("database_connect.php");

	$table = '';
	switch ($_GET['flag']) {
		case '0':
			$whole = array();
			$test = mysqli_query($conn,"select * from gen_data where end_date is null and live_check=1 order by id desc limit 1");
			$rows_no =  mysqli_num_rows($test); 
			if($rows_no !=0 ){
				array_push($whole,mysqli_fetch_assoc($test));
				$test = mysqli_query($conn,"select * from gen_data where end_date is null and live_check=1 order by id desc limit 1");
				while ($row = mysqli_fetch_assoc($test)) {
					$table = $row['gen_name'];
				}
			}
			$result = mysqli_query($conn,"select * from `".$table."` order by id DESC LIMIT 1");
			if(null !== $result){
				array_push($whole,mysqli_fetch_assoc($result));
			}
			
			$ary = array();
			// $all = mysqli_query($conn,"select timestamp,room_temp,light,humidity,moisture from `".$table_name."`");
			$all = mysqli_query($conn,"select * from (select * from `".$table."` order by id desc limit 10)Var1 order by id asc");
			while($row = mysqli_fetch_assoc($all)){
			$ary[] = $row;
			}
			array_push($whole,$ary);
			
			$ary = [];
			$all = mysqli_query($conn,"select *  from `".$table."`");
			while($row = mysqli_fetch_assoc($all)){
			$ary[] = $row;
			}
			array_push($whole,$ary);

			$ary = [];
			$all = mysqli_query($conn,"select *  from photos where gen_name='".$table."' order by timestamp desc");
			while($row = mysqli_fetch_assoc($all)){
			$ary[] = $row;
			}
			array_push($whole,$ary);
			
			echo json_encode($whole);

			break;
		case '1':
			$test = mysqli_query($conn,"select * from gen_data where end_date is null and live_check=1 order by id desc limit 1");
			$rows_no =  mysqli_num_rows($test); 
			if($rows_no !=0 ){
				echo json_encode(mysqli_fetch_assoc($test));
			}
			else{
				echo "nothing";
			}
			break;
		case '2':
			$whole = array();
			$ary = array();
			$all = mysqli_query($conn,"select *  from `".$_GET['table']."`");
			if(null !== $all){
				while($row = mysqli_fetch_assoc($all)){
				$ary[] = $row;
				}
				array_push($whole,$ary);
			}
			// select * from gen1 where HOUR(timestamp) in (18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5);
			// $sql = "select * from `".$_GET['table']."` where HOUR(timestamp) in (6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)";
			// $result = mysqli_query($conn,$sql);
			// $ary = [];
			// if(null !== $result){
			// 	while ($row =mysqli_fetch_assoc($result)) {
			// 		$ary[] = $row; 
			// 	}
			// 	array_push($whole,$ary);
			// }
			// $sql2 = "select * from `".$_GET['table']."` where HOUR(timestamp) in (18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5)";
			// $result2 = mysqli_query($conn,$sql2);
			// $ary = [];
			// if(null !== $result2){
			// 	while ($row = mysqli_fetch_assoc($result2)) {
			// 		$ary[] = $row;
			// 	}
			// 	array_push($whole,$ary);
			// }
			$sql2 = "select date from `".$_GET['table']."` group by date";
			$result2 = mysqli_query($conn,$sql2);
			$ary = [];
			if(null !== $result2){
				while ($row = mysqli_fetch_assoc($result2)) {
					$ary[] = $row;
				}
				array_push($whole,$ary);
			}
			$sql2 = "select * from photos where gen_name='".$_GET['table']."'";
			$result2 = mysqli_query($conn,$sql2);
			$ary = [];
			if(null !== $result2){
				while ($row = mysqli_fetch_assoc($result2)) {
					$ary[] = $row;
				}
				array_push($whole,$ary);
			}
			echo json_encode($whole);
			break;
		case '3':
			$test = mysqli_query($conn,"select * from gen_data where live_check=0");
			$rows_no =  mysqli_num_rows($test); 
			$ary = array();
			while ($row = mysqli_fetch_assoc($test)) {
				$ary[] = $row;
			}
			if($rows_no !=0 ){
				echo json_encode($ary);
			}
			else{
				echo null;
			}
			break;
		case '4':
			$ary = array();
			$all = mysqli_query($conn,"select ROUND(AVG(room_temp)) as temp,ROUND(AVG(humidity)) as humid,ROUND(AVG(moisture)) as moist,ROUND(AVG(light)) as light,
										(select date from `".$_GET['table']."` order by id limit 1)as start,(select date from `".$_GET['table']."` order by id desc limit 1) as end  from `".$_GET['table']."`");
			while($row = mysqli_fetch_assoc($all)){
			$ary[] = $row;
			}
			$result = mysqli_query($conn,"select * from  gen_data where gen_name = '".$_GET['table']."' ");
			if(null !== $result){
				array_push($ary,mysqli_fetch_assoc($result));
			}
			$sql1 = "select round(AVG(temp)) as night_temp,round(AVG(humid)) as night_humid,round(AVG(moist)) as night_moist from (select cast(timestamp + 0.25 as date) as thenight, AVG(room_temp)as temp,AVG(humidity) as humid,AVG(moisture) as moist
			from `".$_GET['table']."`
			where DAY(timestamp) in (18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5)
			group by cast(timestamp + 0.25 as date)
			order by thenight desc)night";
			$result2 = mysqli_query($conn,$sql1);
			if(null !== $result2){
				array_push($ary,mysqli_fetch_assoc($result2));
			}
			$sql2 = "select round(AVG(temp)) as day_temp,round(AVG(humid)) as day_humid,round(AVG(moist)) as day_moist from (select cast(timestamp + 0.25 as date) as thenight, AVG(room_temp)as temp,AVG(humidity) as humid,AVG(moisture) as moist
			from `".$_GET['table']."`
			where DAY(timestamp) in (6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)
			group by cast(timestamp + 0.25 as date)
			order by thenight desc)night";
			$result3 = mysqli_query($conn,$sql2);
			if(null !== $result3){
				array_push($ary,mysqli_fetch_assoc($result3));
			}
			echo json_encode($ary);
			break;
		default:
			break;
	}


	// select round(AVG(temp)) as night_temp,round(AVG(humid)) as night_humid,round(AVG(moist)) as night_moist from (select cast(timestamp + 0.25 as date) as thenight, AVG(room_temp)as temp,AVG(humidity) as humid,AVG(moisture) as moist
	// from gen1
	// where DAY(timestamp) in (18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5)
	// group by cast(timestamp + 0.25 as date)
	// order by thenight desc)night

	// select round(AVG(temp)) as day_temp,round(AVG(humid)) as day_humid,round(AVG(moist)) as day_moist from (select cast(timestamp + 0.25 as date) as thenight, AVG(room_temp)as temp,AVG(humidity) as humid,AVG(moisture) as moist
	// from gen1
	// where DAY(timestamp) in (6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17)
	// group by cast(timestamp + 0.25 as date)
	// order by thenight desc)night

?>