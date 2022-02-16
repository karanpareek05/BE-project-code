function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }
  return color;
}
var frame = document.getElementById('ask_frame');
frame.onclick = function(){
  frame.style.display = 'none';
}

$.get("./fetch.php?flag=3", function(data, status){
  let mydata = JSON.parse(data);
  let genes = [];
  for (let i = 0; i < Object.keys(mydata).length; i++) {
    genes.push(mydata[i]["gen_name"])
  }
  for(let i=0;i<genes.length;i++){
    var frame = document.getElementsByClassName("ask_contain")[0];
    var gne = document.createElement("DIV");
    gne.setAttribute("class","generations");
    gne.setAttribute("id",genes[i]);
    // gne.style.backgroundColor = getRandomColor();
    gne.onclick = function(){
      main(genes[i]);
    }
    frame.appendChild(gne);
    
    var kne = document.createElement("SPAN");
    kne.innerHTML = genes[i];
    gne.appendChild(kne);
  }
});

// var el = document.querySelectorAll(".generations"); 
// console.log(el);
// for(var i =0; i < el.length; i++) {
//     el[i].onclick = function() { 
//       console.log("sumit");
//       console.log(i);
//       console.log(el);
//     };
// }

var myData;
var chart =  document.getElementById('myChart');

function main(divs){

  // console.log(divs);
  document.getElementById('ask_frame').style.display = 'none';
  var allData;
  var dayData;
  var nightData;
  var timestamp = [];
  var temp = [];
  var bgcolor = 'crimson';
  var bordColor = 'darkgrey';
  $.get("./fetch.php?flag=2&table="+divs, function(genData, status){
    genData = JSON.parse(genData);
    allData = genData[0];
    days = genData[1];
    images = genData[2];
    select = document.getElementById('day_select');
    for (var i = 0; i<days.length; i++){
        var opt = document.createElement('option');
        opt.value = days[i]["date"];
        opt.innerHTML = days[i]["date"];
        // opt.selected = 'true';
        select.appendChild(opt);
    }

    if(images.length == 0){
      document.getElementById("sec4").style.display = "none";
    } else {
      // document.getElementById("sec4").style.display = "block";
      for (let i = 0; i < images.length; i++) {
        add_image(images,i);
      }
    }

    $('#day_select').change(function(){
      $('#time_select').val("select");
      graph([0,0],'-','-');
      var selected_day = $(this).val();
      switch (selected_day) {
        case 'select':
          $('#time_select').val("select");
          graph([0,0],'-','-');
          allData = genData[0];
          break;
        default:
          allData = $.grep(genData[0] , function( n, i ) {
            return n.date==selected_day;
          });
          break;
      }
      // console.log(allData);
    });
    dayHrs = [7,8,9,10,11,12,13,14,15,16,17,18]
    nightHrs = [19,20,21,22,23,24,1,2,3,4,5,6]
    test = allData;
    bgcolor = 'crimson';
    bordColor = 'darkgrey';
    $('#time_select').change(function(){
      console.log("Change in Time_select")
      $('#graph_select').val("select")
      graph([0,0],'-','-');
      var check = $(this).val();
      switch (check) {
        case 'day':
          dayData = $.grep(allData, function( n, i ) {
            tist = n.timestamp;
            const dt = new Date(tist).getHours();
            return dayHrs.includes(dt);
          });
          test = dayData;
          bgcolor = 'yellow';
          bordColor = 'orange';
          break;
        case 'night':
          nightData = $.grep(allData, function( n, i ) {
            tist = n.timestamp;
            const dt = new Date(tist).getHours();
            return nightHrs.includes(dt);
          });
          test = nightData;
          bgcolor = 'skyblue';
          bordColor = 'darkslateblue';
          // allData = genData[2];
          break;
        case 'select':
          $('#graph_select').val("select")
          graph([0,0],'-','-');
          test = allData;
          bgcolor = 'crimson';
          bordColor = 'darkgrey';
          break;
      }
      // console.log(test);
    });
    
    // graph(allData,'room_temp','Room Temprature','temp_chart');
    // graph(allData,'humidity','Humidity','humid_chart');
    // graph(allData,'moisture','Soil Moisture','moist_chart');
    // graph(allData,'light','Light Intensity','light_chart');
    // graph(allData,'light','Light Intensity',);
    graph(allData,'room_temp','Temprature');
    $('#graph_select').change(function(){
      console.log("Change in Graph_select")
      var check = $(this).val();
      switch (check) {
        case 'temp':
          graph(test,'room_temp','Temprature');
          break;
        case 'humid':
          // chart.destroy();
          graph(test,'humidity','Humidity');
          break;
        case 'moist':
          graph(test,'moisture','Soil Moisture');
          break;
        case 'light':
          graph(test,'light','Light Intensity');
          break;
        case 'select':
          graph([0,0],'-','-');
          break;
        default:
          graph(allData,'room_temp','Temprature');
          break;
      }
    });

    function graph(genData,column_name,myLabel) {
      // console.log(genData)
      var count = Object.keys(genData).length;
      // console.log(bgcolor,bordColor);
      timestamp = [];
      temp = [];
      for(let i=0;i<count;i++){
        timestamp.push(genData[i]['timestamp']);
        temp.push(genData[i][column_name]);
      }

      const labels = timestamp;
      const data = {
        labels: labels,
        datasets: [{
          label: myLabel,
          backgroundColor: bgcolor,
          borderColor: bordColor,
          // backgroundColor: 'darkblue', // night
          // borderColor: 'dodgerblue',
          data: temp,
          fill: true,
          tension: 0.5
        }]
      };
      const config = {
          type: 'line',
          data: data,
          options: {
            responsive: true,
          }
        };
        try {
          const myChart = new Chart(
            document.getElementById('myChart'),
            config
          );
        } catch (error) {
          // let canvas = document.getElementById('myChart');
          // const context = canvas.getContext('2d');
          // canvas.clear();
          // const myChart = new Chart(
          //   document.getElementById('myChart'),
          //   config
          // );
          $("canvas#myChart").remove();
          var frame = document.getElementsByClassName("chart")[0];
          var gne = document.createElement("CANVAS");
          gne.setAttribute("id","myChart");
          gne.style.height = '70%';
          gne.style.width = '100%';
          frame.appendChild(gne);
          var ctx = document.getElementById("myChart").getContext("2d");
          const myChart = new Chart(ctx,config);
        }

    }

  });

  $.get("./fetch.php?flag=4&table="+divs, function(data, status){
    data = JSON.parse(data);
    details(data);
    avg_data = data[0];
    // console.log(myData);
    document.getElementById('temp_in').value  = avg_data['temp'];
    document.getElementById('humid_in').value = avg_data['humid'];
    document.getElementById('moist_in').value = avg_data['moist'];
    document.getElementById('light_in').value = avg_data['light'];
    var dt1 = avg_data['start'];
    var dt2 = avg_data['end'];
    if (dt1 != '' && dt2 != '' || dt1 != null && dt2 != null) {
      var date1 = new Date(dt1);
      var date2 = new Date(dt2);
      var diffTime = date2.getTime() - date1.getTime();
      var diffDays = diffTime / (1000 * 3600 * 24);
      
      var weeks = diffDays/7;
      // weeks = parseInt(weeks);
      weeks = Math.round(weeks);
      var days = diffDays- (weeks*7);
    }
    document.getElementById('weeks_in').value = weeks;
    document.getElementById('days_in').value = diffDays;

  });

  function details(data) {
    detail_val = data[1];
    day_val = data[3];
    night_val = data[2];
    // console.log(detail_val);
    document.getElementById('gen_in').innerText = detail_val['gen_name'];
    document.getElementById('plant_in').innerText = detail_val['plant_name'];
    document.getElementById('condition').innerText = detail_val['plant_condition'];
    document.getElementById('start_dt').innerText = detail_val['start_date'];
    document.getElementById('end_dt').innerText = detail_val['end_date'];
    document.getElementById('quality_in').innerText = detail_val['quantity'];
    document.getElementById('growth_in').innerText = detail_val['growthrate'];
    document.getElementById('dis_name_in').innerText = detail_val['dis_name'];
    document.getElementById('dis_detail_in').innerText = detail_val['dis_details'];

    document.getElementById('temp_day').innerText = day_val['day_temp']+" °C";
    document.getElementById('temp_night').innerText = night_val['night_temp']+" °C";
    document.getElementById('humid_day').innerText = day_val['day_humid']+" %";
    document.getElementById('humid_night').innerText = night_val['night_humid']+" %";
    document.getElementById('moist_day').innerText = day_val['day_moist']+" lux";
    document.getElementById('moist_night').innerText = night_val['night_moist']+" lux";
  }
  function add_image(data,i){
    const div = document.createElement("div");
    div.classList.add("carousel-item");
    if(i == 0){
      div.classList.add("active");
    }

    const img = document.createElement("img");
    img.classList.add("d-block");
    img.classList.add("w-100");
    img.src = data[i]['image'];
    img.style.width = "800px !important";
    img.style.height = "400px";


    const div2 = document.createElement("div");
    div2.classList.add("carousel-caption");
    div2.classList.add("d-none");
    div2.classList.add("d-md-block");

    const h5 = document.createElement("h5");
    h5.innerText = "Day "+data[i]['day']

    const p = document.createElement("p");
    p.innerText = data[i]['timestamp']

    div.appendChild(img);
    div.appendChild(div2);
    div2.appendChild(h5);
    div2.appendChild(p);
    document.getElementById("image-cont").appendChild(div);
  }

}

