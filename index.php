<!-- https://localhost/test/insert_data.php?flag=0&rtemp=24&humid=18&moist=35&light=58  url to be used in Nodemcu-->

<!-- Password : #kb6M3obzv3ghjWs7ckJ -->
<?php

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!-- <meta http-equiv="refresh" content="1"/> -->
  <title>Smart Plant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="./css/index.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
  <div id="enable_noti">  
    <div id="notiBox">
        <div><span id="closeNoti">&times;</span></div>
        <span id="notiText"> Hi Noti</span>
    </div>
  </div>
  <div class="header">
    <text>Smart Plant Management System</text>
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
  <div class="webBody">
    <div id="container">
    <div id="photos_box">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <!-- <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div> -->
  <div class="carousel-inner" id="image-cont">




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
    </div>

    <div class="live_data_box">
    <h2 id="live_data_lbl">Live Data</h2>
    <div id="temperature" class="sensor-values">
      <br>
      <span class="unit_lbl">°C</span>
      <text type="text" id="temp_in" class="input_lbl" name="temp" disabled></text>
      <span class="tag_name">Temprature</span>
    </div>
    <div id="humidity" class="sensor-values">
      <br>
      <span class="unit_lbl">g/ml</span>
      <text type="text" id="hum_in" class="input_lbl" name="humid" disabled></text>
      <span class="tag_name">Humidity</span>
    </div>
    <div id="moisture" class="sensor-values">
      <br>
      <span class="unit_lbl">g/&#13221</span>
      <text type="text" id="mos_in" class="input_lbl" name="moist" disabled></text>
      <span class="tag_name">Moisture</span>
    </div>
    <div id="light" class="sensor-values">
      <br>
      <span class="unit_lbl">lux</span>
      <text type="text" id="light_in" class="input_lbl" name="light" disabled></text>
      <span class="tag_name">Light</span>
    </div>
  </div>
  

  <div class="graph_box">
      <h1 id="graph_lbl">Graphical Format</h1>
      <h1 id="graph_lbl2">Details</h1>
      <div id="tmp_graph" class=graph>
        <h2 id="graph1_heading">Temprature</h2>
        <img src="./icon/left-arrow.svg" id="arrow-left"></img>
        <div id="allGraph">
          <div class="chart" id="temp-chart"></div>  
          <div class="chart" id="humid-chart"></div> 
          <div class="chart" id="moist-chart"></div> 
          <div class="chart" id="light-chart"></div>
        </div>
        <img src="./icon/right-arrow.svg" id="arrow-right"></img>
      </div>
      <div  class="graph">
        <div id="details">
          <table class="details-table">
            <tr>
              <td>Plant Name</td>
              <td id="plnt_name">Mint</td>
            </tr>
            <tr>
              <td>Generation</td>
              <td id="gen_name" >BG01</td>
            </tr>
            <tr>
              <td>Condition</td>
              <td id="gen_cond" >Balanced</td>
            </tr>
            <tr>
              <td>Days</td>
              <td id="current_week">-</td>
            </tr>
            <th>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
              </svg>
              <span>Yesterday's</span>
            </th>
            <tr>
              <td>Avg Temprature</td>
              <td id="avg_temp">-</td>
            </tr>
            <tr>
              <td>Avg Humid</td>
              <td id="avg_humid">-</td>
            </tr>
            <tr>
              <td>Avg Moisture</td>
              <td id="avg_moist">-</td>
            </tr>
            <tr>
              <td>Avg Light</td>
              <td id="avg_light">-</td>
            </tr>
          </table>
          <!-- <table class="disease-table">
            <th colspan="2"><h4>Disease Prediction</h4></th>
            <tr>
              <td>Name : </td>
              <td id="dis_name" > -- </td>
            </tr>
            <tr>
              <td>Probability : </td>
              <td id="proba">  -- </td>
            </tr>
            <tr >
              <td>Symptoms : </td>
              <td><textarea  id="symptoms" cols="30" rows="10" disabled> -- </textarea></td>
            </tr>
            <tr >
              <td >Fav condition : </td>
              <td><textarea  id="fav-cond" cols="30" rows="10" disabled> -- </textarea></td>
            </tr>
          </table> -->

        </div>
      </div>
    </div>

    <div class="disease_box">
        <h1 class="disease_lbl">Disease Prediction</h1>
        <div class="box">
          <table>
            <tr>
              <td>Name</td>
              <td id="dis_name" > -- </td>
            </tr>
            <tr>
              <td>Probability</td>
              <td id="proba">  -- </td>
            </tr>
            <tr >
              <td>Symptoms</td>
              <td><textarea  id="symptoms" cols="30" rows="10" disabled> -- </textarea></td>
            </tr>
            <tr >
              <td >Fav condition</td>
              <td><textarea  id="fav-cond" cols="30" rows="10" disabled> -- </textarea></td>
            </tr>
            <tr >
              <td >Spread</td>
              <td><textarea  id="spread" cols="30" rows="10" disabled> -- </textarea></td>
            </tr>
          </table>
        </div>
        <div class="box">
          <img id="dis_image" src="" alt="">
        </div>
    </div>


    <div id="buttons">
        <div class="btns" id="end_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-slash-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"/>
        </svg>
          <span>End</span>
        </div>
        <div class="btns" id="photo_btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
          <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
          <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
        </svg>
          <span>Add Photo</span>
        </div>
        <!-- <button  id="end_btn">End</button>
        <button id="photo_btn">Add Photo</button> -->
      </div>
  </div>

<!-------------- Add gen frame ---------------->

  <div id="myModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <span class="close">&times;</span>
          <h2>Start New Generation </h2>
        </div>
      <div class="modal-body">
        <span  class=show_text>Generation Name</span>
        <input id="gen_nm" type="text" class=input_data> </input>
        <span class=show_text>Plant Name </span>
        <input id="plant_name" type="text" class=input_data> </input>
        <span  class=show_text>Condition Name</span>
        <input id="cond_nm" type="text" class=input_data> </input>
        <span class=show_text>Temprature Range</span>
        <div class="in_var_data">
          <input id="min_temp" class=min_data type="number" placeholder="Min"></input>
          <input id="max_temp" class=max_data type="number" placeholder="Max"></input>
        </div>
        <span class=show_text>Humidity Range</span>
        <div class="in_var_data">
          <input id="min_humid" class=min_data type="number" placeholder="Min"> </input>
          <input id="max_humid" class=max_data type="number" placeholder="Max"> </input>
        </div>
        <span class=show_text>Moisture Range</span>
        <div class="in_var_data">
          <input id="min_moist" class=min_data type="number" placeholder="Min"> </input>
          <input id="max_moist" class=max_data type="number" placeholder="Max"> </input>
        </div>
        <hr>
        <button id="add_genration"  class="add_gen_btn" >Add Generation</button>
     </div>
    </div>
  </div>

<!-------------- Add Photo frame ---------------->

  <div id="photo_frame" >
    <div class="content">
      <div id="img_header">
        <span class="addImg_text">Add Image Off The Plant</span>
        <span class="close_btn">&times;</span>
      </div>

      <div id="imgContainer">
          <label class="left">Generation</label>
          <input class="right" id="set_gen" type="text" name="img" disabled>
          <label class="left">Day</label>
          <select class="right" id="select_week">
              <option >Select Day</option>
          </select>
          <img id="set_image" src="#" ></img>
          <label class="left">Add Image</label>
          <input class="right" type="file" id="get_image" accept="image/*">
          <label class="left"></label>
          <button class="right" id="img_submit_btn" onclick="image_add();">Add Photo</button>
      </div>    
    </div>
  </div>

<!-------------- End gen frame ---------------->

<div id="endGen_frame" >
    <div class="endGcontent">
      <div id="img_header">
        <span class="addGen_text">End Current Generation</span>
        <span id="close_btn_2">&times;</span>
      </div>

      <div id="endgenContainer">
          <label class="left">Generation</label>
          <input class="right" id="set_gen_name" type="text" name="img" disabled>
          <label class="left">Plant</label>
          <input class="right" id="set_plant_name" type="text" name="img" disabled>
          <label class="left">Quality Of the plant</label>
          <div class="rating-container">
            <div class="star-widget">
                <input type="radio" class="stars" name="rate" id="rate-5">
                <label for="rate-5" class="fas fa-star"></label>
                <input type="radio" class="stars" name="rate" id="rate-4">
                <label for="rate-4" class="fas fa-star"></label>
                <input type="radio" class="stars" name="rate" id="rate-3">
                <label for="rate-3" class="fas fa-star"></label>
                <input type="radio" class="stars" name="rate" id="rate-2">
                <label for="rate-2" class="fas fa-star"></label>
                <input type="radio" class="stars" name="rate" id="rate-1">
                <label for="rate-1" class="fas fa-star"></label>
            </div>
            <form action="#">
                <header id="header"></header>
            </form>
          </div>
          <label class="left">Growth Rate Of the plant</label>
          <input class="right" id="get_growth" type="text" name="img">
          <label class="left">Disease name (If Formed)</label>
          <input class="right" id="get_disease" type="text" name="img">
          <label class="left">Disease Detiails</label>
          <!-- <input class="right" id="get_dis_details" type="text" name="img"> -->
          <textarea class="right" id="get_dis_details"  name="details"></textarea>
          <button class="right" id="endgen_call_btn">End Generation</button>
          
      </div>    
    </div>
  </div>
 <script> var dis_json = <?php
      $myfile = fopen("mint.json", "r") or die("Unable to open file!");
      echo fread($myfile,filesize("mint.json"));
      fclose($myfile);
  ?>;

  
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js"></script>
  <script src="./js/index.js"></script>
</body>
</html>