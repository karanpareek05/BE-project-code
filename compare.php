<?php 
include("database_connect.php");
$date = date("Y-m-d H:i:s");

if (isset($_GET['one']) && isset($_GET['two'])) {

    $table1 = $_GET['one'];
    $table2 = $_GET['two'];

    $whole = array();
    $ary = array();
    $ary1 = array();
    $ary2 = array();

    $test = mysqli_query($conn,"select * from gen_data where gen_name='".$table1."'");
    while ($row = mysqli_fetch_assoc($test)) {
        $ary[] = $row;
    }
    array_push($whole,$ary);

    $ary =[];
    $test = mysqli_query($conn,"select * from gen_data where gen_name='".$table2."'");
    while ($row = mysqli_fetch_assoc($test)) {
        $ary[] = $row;
    }
    array_push($whole,$ary);


    $ary =[];
    $ary1 =[];
    $ary2 =[];

    $test = mysqli_query($conn,"select * from `".$table1."` group by date");
    while ($row = mysqli_fetch_assoc($test)) {
        $ary1[] = $row;
    }
    array_push($ary,$ary1);

    $test = mysqli_query($conn,"select count(*)as days from (select * from `".$table1."` group by date)dt");
    while ($row = mysqli_fetch_assoc($test)) {
        
        array_push($ary,$row);

    }
    // $prevDate = date('d.m.Y',strtotime("-1 days"));
    // $ary =[];
    // $test = mysqli_query($conn,"select ROUND(AVG(room_temp)) as avgTemp,
    // ROUND(AVG(humidity)) as avgHumid,
    // ROUND(AVG(moisture)) as avgMoist,
    // from `".$table2."` where date=".$prevDate);
    // while ($row = mysqli_fetch_assoc($test)) {
    //     $ary[] = $row;
    // }
    // array_push($whole,$ary);

    // array_push($ary,$ary2);

    array_push($whole,$ary);


    $ary =[];
    $ary1 =[];
    $ary2 =[];

    $test = mysqli_query($conn,"select * from `".$table2."` group by date");
    while ($row = mysqli_fetch_assoc($test)) {
        $ary1[] = $row;
    }
    array_push($ary,$ary1);

    $test = mysqli_query($conn,"select count(*)as days from (select * from `".$table2."` group by date)dt");
    while ($row = mysqli_fetch_assoc($test)) {

        array_push($ary,$row);
    }
    // array_push($ary,$ary2);

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
    ROUND(MIN(light)) as minLight from `".$table1."`");
    while($row = mysqli_fetch_assoc($all)){
        array_push($whole,$row);
    }

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
    ROUND(MIN(light)) as minLight from `".$table2."`");
    while($row = mysqli_fetch_assoc($all)){
        array_push($whole,$row);
    }

    $ary = [];
    $test = mysqli_query($conn,"select * from photos where gen_name='".$table1."'");
    while ($row = mysqli_fetch_assoc($test)) {
        array_push($ary,$row);
    }
    array_push($whole,$ary);

    $ary = [];
    $test = mysqli_query($conn,"select * from photos where gen_name='".$table2."'");
    while ($row = mysqli_fetch_assoc($test)) {
        array_push($ary,$row);
    }
    array_push($whole,$ary);


}
else{
    echo "Error !";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="1"/> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="./css/compare.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Compare</title>
</head>

<body>

    <div class="header">
        <text>Smart Plant Monitoring System</text>
        <div class="header-right">
        <a href="./index.php" class="active">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Home-icon.svg/1200px-Home-icon.svg.png" alt="">
            <span>Home</span>
        </a>
        <a href="./history.php">
            <img src="https://cdn-icons-png.flaticon.com/512/32/32223.png" alt="">
            <span>History</span>
        </a>
        <span class="vertical_line"></span>
        <a  id="new_gen_btn" >
            <img src="https://freepikpsd.com/file/2019/10/create-icon-png-1-Transparent-Images-300x300.png" alt="">
            <span>New Gen</span>
        </a>
        </div>
    </div>
    <div class="body">
        <!-- <div class="left"></div> -->
        <div class="container-cent">
            <div class="row1">
                <div class="gen_name">
                    <h2 id="gen-name-one"></h2>
                </div>
                <div class="gen_name">
                    <h2 id="gen-name-two"></h2>
                </div>
            </div>
            <div class="row2">
                <div class="gen_det">
                    <h3>
                        <center>Details</center>
                    </h3>
                    <div class="details-conatiner">
                        <table>
                            <tr>
                                <td>Plant Name</td>
                                <td id="plant-name-one"></td>
                            </tr>
                            <tr>
                                <td>Condition</td>
                                <td id="condition-one"></td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td id="start-one"></td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td id="end-one"></td>
                            </tr>
                            <tr>
                                <td>Disease Name</td>
                                <td id="dis-name-one"></td>
                            </tr>
                            <tr>
                                <td>Disease Details</td>
                                <td id="dis-det-one"></td>
                            </tr>
                            <tr>
                                <td>Growth Rate</td>
                                <td id="growthrate-one"></td>
                            </tr>

                        </table>
                        <!-- <div class="list">
                            <span>Plant Name : <span id="plant-name-one"></span></span>
                            <span>Condition : <span id="condition-one"></span></span>
                            <span>Start Date : <span id="start-one"></span></span>
                            <span>End Date : <span id="end-one"></span></span>
                        </div> -->
                    </div>
                </div>
                <div class="gen_det">
                    <h3>
                        <center>Details</center>
                    </h3>
                    <div class="details-conatiner">
                        <table>
                            <tr>
                                <td>Plant Name</td>
                                <td id="plant-name-two"></td>
                            </tr>
                            <tr>
                                <td>Condition</td>
                                <td id="condition-two"></td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td id="start-two"></td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td id="end-two"></td>
                            </tr>
                            <tr>
                                <td>Disease Name</td>
                                <td id="dis-name-two"></td>
                            </tr>
                            <tr>
                                <td>Disease Details</td>
                                <td id="dis-det-two"></td>
                            </tr>
                            <tr>
                                <td>Growth Rate</td>
                                <td id="growthrate-two"></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row3">
                <div class="quality-rating">
                    <div class="rating-container">
                        <h3><center>Quality</center></h3>
                        <div class="rating_box" id="ratingOne">

                        </div>
                    </div>
                </div>
                <div class="quality-rating">
                    <div class="rating-container">
                        <h3><center>Quality</center></h3>
                        <div class="rating_box" id="ratingTwo">

                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row4">
                <div class="cond-grpahs">
                    <div id="temp_chart" class="allGraphs" style="width: 230px; height: 400px;"></div>
                </div>
                <div class="cond-grpahs">
                    <div id="humid_chart" class="allGraphs" style="width: 230px; height: 400px;"></div>
                </div>
                <div class="cond-grpahs">
                    <div id="moist_chart" class="allGraphs" style="width: 230px; height: 400px;"></div>
                </div>
                <div class="cond-grpahs">
                    <div id="light_chart" class="allGraphs" style="width: 230px; height: 400px;"></div>
                </div>
            </div>
            <div class="row5">
                <div class="photo" >
                    <div id="gen-one-carousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- <div class="carousel-indicators">
                            <button type="button" data-bs-target="#gen-one-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#gen-one-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#gen-one-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> -->
                        <div class="carousel-inner" id="photo-one">

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#gen-one-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gen-one-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="photo" >
                <div id="gen-two-carousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- <div class="carousel-indicators">
                            <button type="button" data-bs-target="#gen-two-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#gen-two-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#gen-two-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div> -->
                        <div class="carousel-inner" id="photo-one">

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#gen-two-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gen-two-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row6">
                    <div class="graph-slide" id="left" onClick="left_graph()">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                        </svg>
                    </div>
                    <div class="graph-slide" id="right" onClick="right_graph()">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                            <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                        </svg>
                    </div>

                    <div class="main-graphs">
                        <div class="chart">
                            <canvas id="tempChart"></canvas>
                        </div>
                        <div class="chart">
                            <canvas id="humidChart"></canvas>
                        </div>
                        <div class="chart">
                            <canvas id="moistChart"></canvas>
                        </div>
                        <div class="chart">
                            <canvas id="lightChart"></canvas>
                        </div>
                    </div>

            </div>

        </div>
    </div>
    <script>
        var data = <?php echo json_encode($whole); ?>;
        console.log(data);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./js/compare.js"></script>
</body>

</html>