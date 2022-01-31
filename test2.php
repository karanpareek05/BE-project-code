<?php 
include("database_connect.php");

$date = date("Y-m-d");
$whole = array();
$ary = array();
$test = mysqli_query($conn,"select * from gen_data where end_date is null and live_check=1 order by id desc limit 1");
while ($row = mysqli_fetch_assoc($test)) {
    $ary[] = $row;
    $table = $row['gen_name'];
}
$test = mysqli_query($conn,"select count(*)as days from (select * from `".$table."` group by date)dt");
while ($row = mysqli_fetch_assoc($test)) {
    $ary[] = $row;
}
array_push($whole,$ary);
$ary = [];
$all = mysqli_query($conn,"select *  from `".$table."` order by id desc limit 1");
if(null !== $all){
    while($row = mysqli_fetch_assoc($all)){
        array_push($whole,$row);
    }
    
}
$ary = [];
$all = mysqli_query($conn,"select * from (select * from `".$table."` order by id desc limit 10)Var1 order by id asc");
while($row = mysqli_fetch_assoc($all)){
    $ary[] = $row;
}
array_push($whole,$ary);

$ary = [];
$all = mysqli_query($conn,"select ROUND(AVG(room_temp)) as avgTemp,
ROUND(AVG(humidity)) as avgHumid,
ROUND(AVG(moisture)) as avgMoist,
ROUND(AVG(light)) as avgLight,
ROUND(MAX(room_temp)) as maxTemp,
ROUND(MAX(humidity)) as maxHumid,
ROUND(MAX(moisture)) as maxMoist,
ROUND(MAX(light)) as maxLight,
ROUND(MIN(room_temp)) as minTemp,
ROUND(MIN(humidity)) as minHumid,
ROUND(MIN(moisture)) as minMoist,
ROUND(MIN(light)) as minLight from (SELECT * from `".$table."` WHERE date = '".$date."')dt");
while($row = mysqli_fetch_assoc($all)){
    array_push($whole,$row);
}

$date2 = date('Y-m-d', strtotime($date. ' - 1 days'));
// echo($date);
// echo(" : ");
// echo($date2);
$ary = [];
$all = mysqli_query($conn,"select
ROUND(AVG(room_temp)) as nightTemp,
ROUND(AVG(humidity)) as nightHumid,
ROUND(AVG(moisture)) as nightMoist,
ROUND(AVG(light)) as nightLight
from `".$table."` 
where date in ('".$date."','".$date2."') 
and 
HOUR(timestamp) in (18, 19, 20, 21, 22, 23, 0, 1, 2, 3, 4, 5);");
while($row = mysqli_fetch_assoc($all)){
    array_push($whole,$row);
}


$all = mysqli_query($conn,"select
ROUND(AVG(room_temp)) as dayTemp,
ROUND(AVG(humidity)) as dayHumid,
ROUND(AVG(moisture)) as dayMoist,
ROUND(AVG(light)) as dayLight
from `".$table."` 
where date in ('".$date."','".$date2."')
and 
HOUR(timestamp) in (6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);");
while($row = mysqli_fetch_assoc($all)){
    array_push($whole,$row);
}


echo json_encode($whole);
?>