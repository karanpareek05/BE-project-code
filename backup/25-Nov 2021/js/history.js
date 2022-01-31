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
    gne.style.backgroundColor = getRandomColor();
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
function main(divs){

  console.log(divs);
  document.getElementById('ask_frame').style.display = 'none';
  var test;
  var timestamp = [];
  var temp = [];
  $.get("./fetch.php?flag=2&table="+divs, function(value, status){
    test = JSON.parse(value);
    console.log(test);
    var count = Object.keys(test).length;
    console.log(count);
    for(let i=0;i<count;i++){
      timestamp.push(test[i]['timestamp']);
      temp.push(test[i]['room_temp']);
    }

    const labels = timestamp;
    const data = {
      labels: labels,
      datasets: [{
        label: 'Room Temprature',
        backgroundColor: 'yellow',
        borderColor: 'orange',
        data: temp,
      }]
    };
    const config = {
        type: 'line',
        data: data,
        options: {
          responsive: true,
        }
      };
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  });

  $.get("./fetch.php?flag=4&table="+divs, function(data, status){
    myData = JSON.parse(data);
    console.log
    document.getElementById('temp_in').value  = myData[0]['temp'];
    document.getElementById('humid_in').value = myData[0]['humid'];
    document.getElementById('moist_in').value = myData[0]['moist'];
    document.getElementById('light_in').value = myData[0]['light'];
  });

}
