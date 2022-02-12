// var one;
// var two;
// var tale1 = 'gen1';
// var tale2 = 'gen2';


// $.get("./test.php?table=gen", function(data){
//     data = JSON.parse(data);
//     data1 = data[0];
//     days1 = data[1][0]['days'];
//     console.log('1 st :'+days1);
//     $.get("./test.php?table=gen2", function(data){
//         data = JSON.parse(data);
//         data2 = data[0];
//         days2 = data[1][0]['days'];
//         console.log('2 nd :'+days2);
//         // console.log(data1);
//         // console.log(data2);
//         if (days2 > days1){
//             graph(data1,data2,days2);
//         }
//         else if (days1 > days2) {
//             graph(data1,data2,days1);
//         }

//     });
// });



// function graph(one,two,days) {
//     // genData = JSON.parse(genData);
//     // genData =genData[0];
//     // var count = Object.keys(genData).length;
//     // console.log(genData);
//     x_axis = [];
//     for (let i = 1; i <= days; i++) {
//         x_axis.push('day '+i);
//     }
//     // console.log(x_axis);
//     timestamp1 = [];
//     timestamp2 = [];
//     temp1 = [];
//     temp2 = [];
//     humid = [];
//     moist = [];
//     light = [];
//     for(let i=0;i<one.length;i++){
//         timestamp1.push(one[i]['timestamp']);
//         temp1.push(one[i]['room_temp']);
//         humid.push(one[i]['humidity']);
//         moist.push(one[i]['moisture']);
//         light.push(one[i]['light']);
//     }
//     for(let i=0;i<two.length;i++){
//         timestamp2.push(two[i]['timestamp']);
//         temp2.push(two[i]['room_temp']);
//     }

//     const labels = x_axis;
//     const data = {
//         labels: labels,
//         datasets: 
//         [
//             // {
//             //     label: 'Room Temperature',
//             //     backgroundColor: 'yellow',
//             //     borderColor: 'orange',
//             //     // backgroundColor: 'darkblue', // night
//             //     // borderColor: 'dodgerblue',
//             //     data: temp1
//             // },
//             {
//                 label: 'Gen 1',
//                 // backgroundColor: 'darkblue',
//                 // borderColor: 'dodgerblue',
//                 backgroundColor: 'yellow',
//                 // borderColor: 'orange',
//                 data: temp1,
//                 tension: 0.5

//             },
//             {
//                 label: 'Gen 2',
//                 backgroundColor: 'rgb(28 221 168)',
//                 // borderColor: 'rgb(255 0 58)',
//                 // backgroundColor: 'darkblue', // night
//                 // borderColor: 'dodgerblue',
//                 data: temp2,
//                 tension: 0.5
//             }
//         ]
//     };


//     const config = {
//         type: 'bar',
//         data: data,
//         options: {
//           indexAxis: 'y',
//           responsive: true,
//           // Elements options apply to all of the options unless overridden in a dataset
//           // In this case, we are setting the border of each horizontal bar to be 2px wide
//           elements: {
//             bar: {
//               borderWidth: 2,
//             }
//           },
//           responsive: true,
//           animation: {
//             onComplete: () => {
//               delayed = true;
//             },
//             delay: (context) => {
//               let delay = 0;
//               if (context.type === 'data' && context.mode === 'default' && !delayed) {
  //                 delay = context.dataIndex * 300 + context.datasetIndex * 100;
  //               }
  //               return delay;
  //             },
  //           },
  //           scales: {
    //                 x: {
//                     min: 0,
//                     max: 40,
//                     display: true,
//                     title: {
  //                         display: true,
  //                         text: 'Temperature °C',
  //                         color: '#911',
//                         font: {
  //                         family: 'Comic Sans MS',
//                         size: 20,
//                         weight: 'bold',
//                         lineHeight: 1.2,
//                         },
//                         padding: {top: 20, left: 0, right: 0, bottom: 0}
//                     }
//                 },
//                 y: {
  //                     display: true,
  //                     title: {
    //                         display: true,
    //                         text: 'Days',
    //                         color: '#191',
    //                         font: {
//                         family: 'Times',
//                         size: 20,
//                         style: 'normal',
//                         lineHeight: 1.2
//                         },
//                         padding: {top: 30, left: 0, right: 0, bottom: 0
//                     }
//                 }
//               }
//             },
//           plugins: {
  //             legend: {
    //               position: 'right',
    //               onHover: 'handleHover',
    //               onLeave: 'handleLeave'
    //             },
    //             title: {
      //               display: true,
//               text: 'Room Temperature'
//             }
//           }
//         },
//       };

//     const config = {
  //         type: 'line',
  //         data: data,
  //         options: {
    //             responsive: true,
    //         }
//         };
//         try {
  //         const myChart = new Chart(
    //             document.getElementById('myChart'),
    //             config
    //         );
//         } catch (error) {
//         let canvas = document.getElementById('myChart');
//         const context = canvas.getContext('2d');
//         canvas.clear();
//         const myChart = new Chart(
//           document.getElementById('myChart'),
//           config
//         );
//         $("canvas#myChart").remove();
//  

function mainGraph_temp(gen1,gen2,data1,data2,days) {

    var x_axis = [];
    for (let i = 1; i <= parseInt(days); i++) {
        x_axis.push('day '+i);
    }

    function getData(data) {
      // let [temp, timestamp1,humid,moist,light] = [];
      let temp = [];
      for(let i=0;i<data.length-1;i++){
          // console.log(data[i]['room_temp'])
                // timestamp1.push(one[i]['timestamp']);
                temp.push(data[i]['room_temp']);
                // humid.push(one[i]['humidity']);
                // moist.push(one[i]['moisture']);
                // light.push(one[i]['light']);
            }
      return(temp);
    }

    var temp1 = getData(data1);
    var temp2 = getData(data2);

  const labels = x_axis;
  
  const data = {
    labels: labels,
    datasets: [
      {
        label: gen1,
        data: temp1,
        fill: true,
        backgroundColor: 'rgba(255, 99, 132, 0.5)',
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.5
      },
      {
        label: gen2,
        data: temp2,
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
          text: 'Room Temperature of both generation',
          font: {size: 16}
        }
      },
      scales: {
        y:{ suggestedMin: 0, suggestedMax: 50 },
        // x:{},     
        yAxis: {
          title: { display: true, text : 'Temperature ( °C )', font: {size: 20} }, 
          ticks: { suggestedMin: 0, max: 50 } ,
        },
        xAxis: {
          title: { display: true, text : 'Days', font: {size: 16}},
        }
      }
    }
  };
  
  
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
}

// mainGraph_temp();


function quality(starNo,headerName,className) {
  let stars = document.getElementsByClassName(className);
  let header = document.getElementById(headerName);
  classNo  = 6 - starNo - 1;
  console.log(classNo);
  stars[classNo].checked = true;
  switch (starNo) {
          case 1:
            header.innerText = "Worst";
            break;
          case 2:
            header.innerText = "Bad";
            break;
          case 3:
            header.innerText = "Acceptable";
            break;
          case 4:
            header.innerText = "Very Good";
            break;
          case 5:
            header.innerText = "Excellent";
            break;
        }
  }  

// quality(5,"header-one","stars-one");
// quality(2,"header-two","stars-two");

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
// drawGraphs("temp_chart","Temperature ( °C )",'Temperature','yellow','orange',);
// drawGraphs("humid_chart","Humidity ( % )",'Humidity','skyblue','dodgerblue');
// drawGraphs("moist_chart","Moisture ( % )","Moisture","#ffd0c6","#ff9db0");
// drawGraphs("light_chart","Light ( lux )","Light","#cbe4f9","violet");


function setDark() {
  document.querySelector("h3>center").style.color = "lavander";
  $(":root").get(0).style.setProperty("--bg-color","#1f1f1f")
  document.querySelector("*").style.color = "lavander";
  $(":root").get(0).style.setProperty("--border-all","1px solid 1px solid #161616");
  $(":root").get(0).style.setProperty("--box-sh-header"," 0px 5px 5px  rgb(8 8 8 / 87%)");
  $(":root").get(0).style.setProperty("--box-sh-other","3px 7px 8px rgb(8 8 8 / 87%)");

}

function setLight() {
  document.querySelector("h3>center").style.color = "slategrey";
  
  $(":root").get(0).style.setProperty("--bg-color","white")
  $(":root").get(0).style.setProperty("--box-sh-header","0px 5px 5px rgb(212, 209, 209)");
  $(":root").get(0).style.setProperty("--box-sh-other","3px 7px 8px rgb(212, 209, 209)");
  $(":root").get(0).style.setProperty("--border-all","1px solid lightgrey");

}

var light = document.getElementById("light");
var dark = document.getElementById("dark");

light.onclick = function () {
  dark.style.setProperty("background-color","whitesmoke");
  dark.style.setProperty("color","grey");
  dark.style.setProperty("border","1px solid grey");
  dark.style.setProperty("border-left","0px");

  light.style.setProperty("background-color","dodgerblue");
  light.style.setProperty("color","white");
  light.style.setProperty("border","0px");

  setLight();
  
}

dark.onclick = function () {
  light.style.setProperty("background-color","whitesmoke");
  light.style.setProperty("color","grey");
  light.style.setProperty("border","1px solid grey");
  light.style.setProperty("border-right","0px");

  dark.style.setProperty("background-color","dodgerblue");
  dark.style.setProperty("color","white");
  dark.style.setProperty("border","0px");

  setDark();
}

// setDark();





// ------------------------ Calling Main Function ----------------------

var promise = $.get('./test.php',(data) =>{
// var promise = $.get('./test.php',(data) =>{
  main(data);
  console.log(data);
},'json')

// ------------------------  Main Function ----------------------

function main(data) {
  var firstgen = data[0][0];
  var secondgen = data[1][0];
  var dataone = data[2];
  var datatwo = data[3];
  var avgone = data[4];
  var avgtwo = data[5];


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

 
  

  quality( parseInt(firstgen.quantity),"header-one","stars-one");
  quality(parseInt(secondgen.quantity),"header-two","stars-two");

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
      mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days2);
    }
    else if (days1 > days2) {
      mainGraph_temp(firstgen['gen_name'],secondgen['gen_name'],data1,data2,days1);
      
    }

}


// function binarySearch(arr,elem) {
//   var start = 0;
//   var end = arr.length - 1;
//   var middle = Math.floor((start + end)/2);
 
//   while(arr[middle] != elem){
//     if(arr[middle] > elem){
//       end = middle - 1;
//     }else{
//       start = middle + 2;
//     }
//     middle = Math.floor((start + end)/2)
//   }
//   return  middle;
// }

// function binarySearch(arr,elem) {
//   var start = 0;
//   var end = arr.length - 1;
//   var middle = Math.floor((start + end)/2);
 
//   if(arr[middle] != elem){
//     if(arr[middle] > elem){
//       binarySearch(arr[start:middle] ,elem);
//     }else{
//       start = middle + 2;
//     }
    
//   }
//   else{
//     return  middle;
//   }
// }


// binarySearch([2,5,6,9,12,13,15,17,19,20,24,26,28],19)








