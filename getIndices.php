<table style="width: 100%;margin:auto;">
<tr style="background:-moz-linear-gradient(center top , #e7edf7, #adbef7) repeat scroll 0 0 rgba(0, 0, 0, 0);">

<td class="cell_label">#</td>
<td class="cell_label">Month</td>
<td class="cell_label">Price</td>
<td class="cell_label">User</td>
<td class="cell_label">Modified</td>
<?php
    $index = $db->get("iwp_jacobsen");
    
    foreach($index as $value){
        $month = explode ("-",$value['date']);
        switch($month[1]){
            case "01":
                $mname = "January";
                break;
            case "02":
                $mname = "Febuary";
                break;
            case "03":
                $mname = "March";
                break;
            case "04":
                $mname = "April";
                break;
            case "05":
                $mname = "May";
                break;
            case "06":
                $mname = "June";
                break;
            case "07":
                $mname= "July";
                break;
            case "08":
                $mname= "August";
                break;
            case "09":
                $mname = "September";
                break;
            case "10":
                $mname = "October";
                break;
            case "11":
                $mname = "November";
                break;
            case "12":
                $mname = "December";
                break;
                
        }
        
        echo "<tr><td>$value[id]</td><td>$mname</td>  <td> ". number_format ($value['percentage'],2)."</td><td>". uNumToName($value['user']). "</td><td>$value[modified]</td>";
    }

?>


</tr>

</table>