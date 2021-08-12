<head>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
   google.load('visualization', '1.1', {
        packages: ['line', 'bar', 'corechart']
    });
    // Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawCharts);

function drawCharts() {
    // Create the data table.
    var barData = new google.visualization.arrayToDataTable([
        ['', 'Customer', 'Segment Avg'],
        ['TTM Sales', 4, 2],
        ['TTM Orders', 5, 3],
        ['TTM Categories', 7, 4]
    ]);
    // Create the data table.
    var lineData = new google.visualization.arrayToDataTable([
        ['Year', 'Customer', 'Segment Avg'],
        ['2011', 4, 5],
        ['2012', 5, 3],
        ['2013', 4, 2]
    ]);
    // Set chart options
    var barOptions = {
        chart: {
            title: 'Performance',
        },
        width: 900,
        height: 500
    };
    // Set chart options
    var lineOptions = {
        chart: {
            title: 'Sales History'
        },
        width: 900,
        height: 500
    };


    var barChart = new google.charts.Bar(document.getElementById('bar_chart'));
        barChart.draw(barData, barOptions);
    var barChart2 = new google.charts.Bar(document.getElementById('bar_chart2'));
        barChart2.draw(barData, barOptions);
    var lineChart = new google.charts.Line(document.getElementById('line_chart'));
         lineChart.draw(lineData, lineOptions);
};
  </script>
</head>
<body>
  <!-- Identify where the chart should be drawn. -->
  <script src="https://www.google.com/jsapi" type="text/javascript"></script>
<div id="bar_chart"></div>
<div id="bar_chart2"></div>
<div id="line_chart"></div>
</body>
