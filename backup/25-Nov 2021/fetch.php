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
			
			$ary = array();
			$all = mysqli_query($conn,"select *  from `".$table."`");
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
			$ary = array();
			$all = mysqli_query($conn,"select *  from `".$_GET['table']."`");
			while($row = mysqli_fetch_assoc($all)){
			$ary[] = $row;
			}
			echo json_encode($ary);
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
			echo json_encode($ary);
			break;
		default:
			break;
	}




?>