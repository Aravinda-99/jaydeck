$(document).ready(function(){

    loadLineChartData();
    loadPieChartData();
});


 function loadLineChartData(){
    $.ajax({
      url: base_url + '/dashboard/getLineChartData',
      type: 'POST',
      headers: {'X-CSRF-TOKEN': token},
      success:function(data){
        var chart = new Chart( document.getElementById("line_chart").getContext("2d"), {
         type: "line",
         data: {
            labels: data["dates"],
           datasets: [{
             label: "Order",
             data: data["orders"],
             borderColor: 'rgba(0, 188, 212, 0.75)',
            backgroundColor: 'rgba(0, 188, 212, 0.3)',
            pointBorderColor: 'rgba(0, 188, 212, 0)',
            pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
            pointBorderWidth: 1
           }]
         },
         options: {
           responsive: true,
           legend: false
         }
       });
      }
    })
  }

  function loadPieChartData(){

    var pieColors = [];

    $.ajax({
      url: base_url + '/dashboard/getPieChartData',
      type: 'POST',
      headers: {'X-CSRF-TOKEN': token},
      success:function(data){

        for (var i = 0; i < data["deliveryCount"].length; i++) {
            pieColors.push(getRandomColor());
    
        }

        var chart = new Chart( document.getElementById("pie_chart").getContext("2d"), {
         type: "pie",

         data: {
            labels: data["district"],
            datasets: [{
                label: "Orders",
                data: data["deliveryCount"],
                borderColor: 'rgba(255, 255, 255, 0.75)',
                backgroundColor: pieColors,
                pointBorderColor: 'rgba(0, 188, 212, 0)',
                pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                pointBorderWidth: 1
            },
                ]
        },
        options: {
            legend: {
                position: 'right',
            labels: {
                padding: 20
            }
            },
            responsive: true,
        }

       });
      }
    })
  }

    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

























// $('.count-to').countTo();

// new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line'));
// new Chart(document.getElementById("pie_chart").getContext("2d"), getChartJs1('pie'));


// function getChartJs(type) {

//     alert(type);
//     var config = null;

//     config = {
//         type: 'line',
//         data: {
//             labels: ['TT','WW','VV'],
//             datasets: [{
//                 label: "Orders",
//                 data: [50,25,85],
//                 borderColor: 'rgba(0, 188, 212, 0.75)',
//                 backgroundColor: 'rgba(0, 188, 212, 0.3)',
//                 pointBorderColor: 'rgba(0, 188, 212, 0)',
//                 pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
//                 pointBorderWidth: 1
//             },
//               ]
//         },
//         options: {
//             responsive: true,
//             legend: false
//         }
//     }

//     return config;
// }

// function getChartJs1(type) {
//     var config = null;
//     pieColors = [];

//     for (var i = 0; i < data.length; i++) {
//         pieColors.push(getRandomColor());

//     }

//     config = {
//         type: 'pie',
//         data: {
//             labels: _.map(data, 'lable'),
//             datasets: [{
//                 label: "Orders",
//                 data: _.map(data, 'value'),
//                 borderColor: 'rgba(255, 255, 255, 0.75)',
//                 backgroundColor: pieColors,
//                 pointBorderColor: 'rgba(0, 188, 212, 0)',
//                 pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
//                 pointBorderWidth: 1
//             },
//               ]
//         },
//         options: {
//           legend: {
//              position: 'right',
//             labels: {
//               padding: 20
//             }
//           },
//           responsive: true,
//         }
//     }

//     return config;
// }

// function getRandomColor() {
//     var letters = '0123456789ABCDEF'.split('');
//     var color = '#';
//     for (var i = 0; i < 6; i++ ) {
//         color += letters[Math.floor(Math.random() * 16)];
//     }
//     return color;
// }
