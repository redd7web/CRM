<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="ReDDaWG" />
    <meta charset="UTF-8" />
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    
<style type="text/css">
body{
    padding:10px 10px 10px 10px;
}

</style>

</head>

<?php
include "protected/global.php";
ini_set("display_errors",0);
$rts = $db->query("SELECT iwp_ikg_manifest_info.*,iwp_list_of_routes.* FROM iwp_ikg_manifest_info LEFT JOIN iwp_list_of_routes ON iwp_ikg_manifest_info.route_id = iwp_list_of_routes.route_id  WHERE iwp_list_of_routes.status ='enroute'");
?>


<body>

<table style="width: 850px;">
<tr>
<?php
$account = new Account();
if(count($rts)>0){
    $count=0;
    foreach($rts as $b){
        $ikg_info = new IKG($b['route_id']);
        $count++;
        echo "<td><form action='oil_routing.php' method='post' target='_blank' class='goto_manifest'><label style='cursor:pointer;text-decoration:underline;' >$ikg_info->ikg_manifest_route_number<input type='hidden' name='from_routed_oil_pickups' value='1'/><input type='hidden' value='$ikg_info->route_id' name='manifest'/></label></form><br/>
        <a href='field_report.php?ikg=$ikg_info->route_id&back=true'>Field Report</a><br/>
        Driver: ".uNumToName($ikg_info->driver)."<br/> 
        Created by:".$ikg_info->created_by."<br/>
        Facility: ".$ikg_info->recieving_facility."<br/>";
        
        $huc = $db->query("SELECT date_of_pickup,account_no FROM iwp_data_table WHERE route_id = $ikg_info->route_id ORDER BY date_of_pickup DESC ");
        
        
        
        echo "Hours in Current Route: ";
        $checkTime = strtotime($ikg_info->last_stop);
        $loginTime = strtotime($ikg_info->first_stop);
        $diff = $checkTime - $loginTime;
        echo abs(number_format($diff/3600,2))." Hours<br/>";
        echo "Last stop city: ".$account->singleField($huc[0]['account_no'],"city")."<br/>";
        ?>
        <iframe src="bigpie.php?route_id=<?php echo $ikg_info->route_id; ?>" style="width: 310px;height:400px;border:0px solid #bbb;overflow:hidden;" scrolling="no" frameborder="0"></iframe>
        <iframe src="plugins/jqwidgets-ver3.4.0/demos/jqxprogressbar/defaultfunctionality.php?route_id=<?php echo $ikg_info->route_id; ?>" style="width: 310px;height:100px;border:0px solid #bbb;"></iframe>
       
        <?php
        echo "</td>";
        if($count%3 == 0 && $count !=1){
            echo "</tr><tr>";
        }
    }
}


?>
</tr>
</table>
<script>
$(".goto_manifest").click(function(){
    alert("click");
    $(this).submit();
})
</script>
</body>