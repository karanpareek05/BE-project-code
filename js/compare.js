function sortData(data, param) {
  // let [temp, timestamp1,humid,moist,light] = [];
  let array = [];
  for(let i=0;i<data.length-1;i++){
            array.push(data[i][param]);
        }
  return(array);
}



function mainGraph_temp(gen1,gen2,data1,data2,days,canvasId,param,yLable) {

    var x_axis = [];
    for (let i = 1; i <= parseInt(days); i++) {
        x_axis.push('day '+i);
    }

    var data1 = sortData(data1,param);
    var data2 = sortData(data2,param);

  const labels = x_axis;
  
  const data = {
    labels: labels,
    datasets: [
      {
        label: gen1,
        data: data1,
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.5
      },
      {
        label: gen2,
        data: data2,
        fill: true,
        backgroundColor: 'skyblue',
        borderColor: 'dodgerblue',
        tension: 0.5,
        opener:0.5
      }
    ]
  };
  
  const config = {
    type: 'line',
    data: data,
    options: {
      plugins: {
        title: {
          display: true,
          text: yLable+' of both generation',
          font: {size: 16}
        }
      },
      scales: {
        y:{ suggestedMin: 0, suggestedMax: 50 },
        // x:{},     
        yAxis: {
          title: { display: true, text : yLable, font: {size: 20} }, 
          ticks: { suggestedMin: 0, max: 50 } ,
        },
        xAxis: {
          title: { display: true, text : 'Days', font: {size: 16}},
        }
      }
    }
  };
  
  
  const myChart = new Chart(
    document.getElementById(canvasId),
    config
  );
}

// mainGraph_temp();


function quality(starNo,divName) {
  let star = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
  </svg>`; 
  let rating_box = document.getElementById(divName);
  for (let i = 0; i < 5; i++) {
    $('#'+divName).append(star);
  }

  let allStars = $("#"+divName+" svg");
  for (let i = 0; i < starNo; i++) {
    allStars.get(i).style.fill = 'yellow';
  }

  // let stars = document.getElementsByClassName(className);
  // let header = document.getElementById(headerName);
  // classNo  = 6 - starNo - 1;
  // console.log(classNo);
  // stars[classNo].checked = true;
  // switch (starNo) {
  //         case 1:
  //           header.innerText = "Worst";
  //           break;
  //         case 2:
  //           header.innerText = "Bad";
  //           break;
  //         case 3:
  //           header.innerText = "Acceptable";
  //           break;
  //         case 4:
  //           header.innerText = "Very Good";
  //           break;
  //         case 5:
  //           header.innerText = "Excellent";
  //           break;
  //       }
  }  



function drawGraphs(genOneName,genTwoName,valueOne,valueTwo,divId,lable,title,fill,stroke,genOne,genTwo) {
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Generations', lable, { role: 'style' } ],
      [genOneName, valueOne, 'stroke-color: #703593'],
      [genTwoName, valueTwo, 'stroke-color: #871B47']
    ]);


    var options = {
      title: title,
      subtitle: `Average ${title.toLowerCase()} of generation`,
      width: 220,
      height: 400,
      vAxis: {
        title: lable,
        textStyle : {
          fontSize: 16,
          color:'slategrey',
        }
      },
      hAxis: {
        textStyle : {
          fontSize: 16,
          color:'slategrey',
        }
      },
      bar: {
        groupWidth: "70%"
      },
      legend: { position: "none" },
      backgroundColor: { fill:'transparent' },

    };
  
    var chart = new google.charts.Bar(document.getElementById(divId));
    chart.draw(data, google.charts.Bar.convertOptions(options));

    setTimeout(() => {
      for (let i = 0; i < 2; i++) {
        $(`#${divId} path`).get(i).style.setProperty("fill",fill)
        $(`#${divId} path`).get(i).style.setProperty("stroke",stroke)
      }
      var setopacity = document.getElementsByClassName("allGraphs");
      for (let i = 0; i < setopacity.length; i++) {
        setopacity[i].style.opacity = 1;
      }
    },600)
  }



}





// ------------------------ Calling Main Function ----------------------

// var promise = $.get('./test.php',(data) =>{
// var promise = $.get('http://localhost/test/test.php',(data) =>{

  
//   console.log(data);
// },'json')

if (data != null) {
  main(data);
  console.log(data)
}
else{
  $(".container-cent").get(0).style.display = 'none';
}

// ------------------------  Main Function ----------------------

function main(data) {
  var firstgen = data[0][0];
  var secondgen = data[1][0];
  var dataone = data[2];
  var datatwo = data[3];
  var avgone = data[4];
  var avgtwo = data[5];

  var imagesOne = data[6];
  var imagesTwo = data[7]

  // for (let i = 0; i < imagesOne.length; i++) {
  //   add_image(imagesOne,i,'image-cont-one');
  // }

  // for (let i = 0; i < imagesTwo.length; i++) {
  //   add_image(imagesTwo,i,'image-cont-two');
  // }

  


  document.getElementById("gen-name-one").innerText = firstgen['gen_name'];
  document.getElementById("gen-name-two").innerText = secondgen['gen_name'];

  document.getElementById("plant-name-one").innerText = firstgen['plant_name'];
  document.getElementById("condition-one").innerText = firstgen['plant_condition'];
  document.getElementById("start-one").innerText = firstgen['start_date'];
  document.getElementById("end-one").innerText = firstgen['end_date'];

  document.getElementById("plant-name-two").innerText = secondgen['plant_name'];
  document.getElementById("condition-two").innerText = secondgen['plant_condition'];
  document.getElementById("start-two").innerText = secondgen['start_date'];
  document.getElementById("end-two").innerText = secondgen['end_date'];

 
  quality(parseInt(firstgen.quantity),'ratingOne');
  quality(parseInt(secondgen.quantity),'ratingTwo');


  // document.getElementById("avg-temp-one").innerText = avgone['avgTemp']+" °C";
  // document.getElementById("avg-humid-one").innerText = avgone['avgHumid']+" %";
  // document.getElementById("avg-moist-one").innerText = avgone['avgMoist']+" %";
  // document.getElementById("avg-light-one").innerText = avgone['avgLight']+" lux";

  // document.getElementById("avg-temp-two").innerText = avgtwo['avgTemp']+" °C";
  // document.getElementById("avg-humid-two").innerText = avgtwo['avgHumid']+" %";
  // document.getElementById("avg-moist-two").innerText = avgtwo['avgMoist']+" %";
  // document.getElementById("avg-light-two").innerText = avgtwo['avgLight']+" lux";


  drawGraphs(firstgen['gen_name'],secondgen['gen_name'],parseInt(avgone['avgTemp']),parseInt(avgtwo['avgTemp']),"temp_chart","Temperature ( °C )",'Temperature','yellow','orange',);
  drawGraphs(firstgen['gen_name'],secondgen['gen_name'],parseInt(avgone['avgHumid']),parseInt(avgtwo['avgHumid']),"humid_chart","Humidity ( % )",'Humidity','skyblue','dodgerblue');
  drawGraphs(firstgen['gen_name'],secondgen['gen_name'],parseInt(avgone['avgMoist']),parseInt(avgtwo['avgMoist']),"moist_chart","Moisture ( % )","Moisture","#ffd0c6","#ff9db0");
  drawGraphs(firstgen['gen_name'],secondgen['gen_name'],parseInt(avgone['avgLight']),parseInt(avgtwo['avgLight']),"light_chart","Light ( lux )","Light","#cbe4f9","violet");


    data1 = dataone[0];
    days1 = parseInt(dataone[1]['days']);
    console.log('1 st :'+days1);


    data2 = datatwo[0];
    days2 = parseInt(datatwo[1]['days']);
    console.log('2 nd : '+days2);

    if (days2 > days1){
      days = days2
    }
    else if (days1 > days2) {
      days = days1
    }

    mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days,'tempChart','room_temp','Temperature ( °C )');
    mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days,'humidChart','humidity','Humidity ( % )');
    // mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days,'moistChart','moisture','Moisture ( % )');
    // mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days,'lightChart','light','Light ( lux )');

}


function add_image(data,i,apdName){
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
    document.getElementById(apdName).appendChild(div);
  }


  // add_image(data,i,'image-cont-one')








