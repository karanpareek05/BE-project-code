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
  var test;
  var timestamp = [];
  var temp = [];
  var bgcolor = 'crimson';
  var bordColor = 'darkgrey';
  $.get("./fetch.php?flag=2&table="+divs, function(genData, status){
    genData = JSON.parse(genData);
    test = genData[0];

    days = genData[3];
    select = document.getElementById('day_select');
    for (var i = 1; i<=days.length; i++){
        var opt = document.createElement('option');
        opt.value = days[i]["date"];
        opt.innerHTML = days[i]["date"];
        // opt.selected = 'true';
        select.appendChild(opt);
    }
  

    $('#time_select').change(function(){
      $('#graph_select').val("select")
      graph([0,0],'-','-');
      var check = $(this).val();
      switch (check) {
        case 'day':
          test = genData[1];
          bgcolor = 'yellow';
          bordColor = 'orange';
          break;
        case 'night':
          bgcolor = 'skyblue';
          bordColor = 'darkslateblue';
          test = genData[2];
          break;
        default:
          test = genData[0];
          bgcolor = 'crimson';
          bordColor = 'darkgrey';
          break;
      }
    });
    
    // graph(test,'room_temp','Room Temprature','temp_chart');
    // graph(test,'humidity','Humidity','humid_chart');
    // graph(test,'moisture','Soil Moisture','moist_chart');
    // graph(test,'light','Light Intensity','light_chart');
    // graph(test,'light','Light Intensity',);
    graph(test,'room_temp','Room Temprature');
    $('#graph_select').change(function(){
      var check = $(this).val();
      switch (check) {
        case 'temp':
          graph(test,'room_temp','Room Temprature');
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
          graph(test,'room_temp','Room Temprature');
          break;
      }
    });

    function graph(genData,column_name,myLabel) {
      var count = Object.keys(genData).length;
      console.log(bgcolor,bordColor);
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

    document.getElementById('temp_day').innerText = day_val['day_temp'];
    document.getElementById('temp_night').innerText = night_val['night_temp'];
    document.getElementById('humid_day').innerText = day_val['day_humid'];
    document.getElementById('humid_night').innerText = night_val['night_humid'];
    document.getElementById('moist_day').innerText = day_val['day_moist'];
    document.getElementById('moist_night').innerText = night_val['night_moist'];
  }

}




















// var d = JSON.parse(gen_data["responseText"]);
// console.log(d);

// function getRandomColor() {
//   var letters = '0123456789ABCDEF';
//   var color = '#';
//   for (var i = 0; i < 6; i++) {
//     color += letters[Math.floor(Math.random() * 16)];
//   }
//   return color;
// }

// var data = ['gen','gen1','ge2','genration 2','generaion 3'];

// for(let i=0;i<data.length;i++){
//   var frame = document.getElementsByClassName("ask_contain")[0];
//   var gne = document.createElement("DIV");
//   gne.setAttribute("class","generations");
//   gne.setAttribute("id",data[i]);
//   gne.style.backgroundColor = getRandomColor();
//   frame.appendChild(gne);
  
//   var kne = document.createElement("SPAN");
//   kne.innerHTML = data[i];
//   gne.appendChild(kne);
  
// }


// document.getElementById("ask_frame").onclick = function(){
//   document.getElementById("ask_frame").style.display = "none";
// }



// var test;
// var timestamp = [];
// var temp = [];
// $.get("http://192.168.1.203/test/test.php", function(value, status){
//   test = JSON.parse(value);
//   console.log(test);
//   var count = Object.keys(test).length;
//   console.log(count);
//   for(let i=0;i<count;i++){
//     timestamp.push(test[i]['timestamp']);
//     temp.push(test[i]['room_temp']);
//   }

//   const labels = timestamp;
//   const data = {
//     labels: labels,
//     datasets: [{
//       label: 'Room Temprature',
//       backgroundColor: 'yellow',
//       borderColor: 'orange',
//       data: temp,
//     }]
//   };
//   const config = {
//       type: 'line',
//       data: data,
//       options: {
//         responsive: true,
//       }
//     };
//   const myChart = new Chart(
//     document.getElementById('myChart'),
//     config
//   );
// });


