
<?php
// database connection 
// localhost user name and password and last parameter is for database name.
$db = mysqli_connect("htl-server.com","martinadodsql1","Marti@133","martinadodsql1");

//  data von database bekommen
$q = mysqli_query($db, "SELECT name, value FROM pie_chart");

if($q){
    $chart_data[] = ["stunde", "value"];
    while($pie_data = mysqli_fetch_assoc($q)){
        settype($pie_data["value"], "int");
       $chart_data [] = [$pie_data["name"], $pie_data["value"]];
    }
    echo json_encode($chart_data);
}else{
    echo "Fail".mysqli_error();
}

?>


<html>
<head>
<style>
 .chart {
  width: 100%; 
  min-height: 450px;
}
</style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--	<script src="https://www.google.com/jsapi"></script>--->
    <script type="text/javascript">
	
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
 
            var data = google.visualization.arrayToDataTable( <?php echo json_encode($chart_data); ?>   );

            var options = {
                title: 'feuchigkeit',
                is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
/
		$(window).resize(function(){
          drawChart();
        });
		
    </script>
</head>
<body>
<div id="piechart" class="chart"></div>
</body>
</html>
