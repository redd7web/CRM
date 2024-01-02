<?php
include "protected/global.php";

$uhc = $db->query("SELECT *  FROM assets.truck");

$uhcx = $db->query("SELECT *  FROM assets.trailer");



?>
<style>
td{
    border:1px dotted black;
}
</style>
<table style="width: 90%;margin:auto;" >
<tr><td>Vehicle Name</td><td>Make</td><td>Model</td><td>Year</td><td>Vin</td><td>Module</td><td>Division</td></tr>
<?php
    if(count($uhc)>0){
        foreach($uhc as $truck){
            echo "<tr><td>$truck[name]</td><td>$truck[truck_make]</td><td>$truck[truck_model]</td><td>$truck[truck_year]</td><td>$truck[vin]</td><td>$truck[module]</td><td>".numberToFacility($truck['facility'])."</td></tr>";
        }
    }

?>
</table>