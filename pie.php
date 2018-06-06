
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

