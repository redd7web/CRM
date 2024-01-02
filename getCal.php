<?php
include "protected/global.php";
date_default_timezone_set('America/Los_Angeles');
function draw_calendar($month,$year){
    global $db;
	/* draw table */
	$calendar = '<table style="width:90%;margin:auto;">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
    
	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
         $stuff = $db->query("SELECT * FROM Inetforms.ap_form_47591 WHERE DAY(ap_form_47591.element_6)='$list_day' AND MONTH(ap_form_47591.element_6)='$month' AND YEAR(ap_form_47591.element_6)='$year' ");
        $headex="";
        if(count($stuff)>0){
            $headex ="<img src='img/delete-icon.jpg' class='del_all' style='cursor:pointer;' month='$month' year='$year' day='$list_day'  title='Delete all for this day'>&nbsp;&nbsp;<span style='cursor:pointer;text-decoration:underline;float:left;' class='view_all' day='$list_day' year='$year' month='$month'>View All (".count($stuff).")</span><br/>";
            foreach($stuff as $obs){
                 $me ="";
                 $pdf ="";
                switch($obs['element_1']){
                    case 4:$product = " Colton"; break;
                    case 5:$product = " PBF Colton"; break;
                    case 6:$product = " Co-West"; break;
                    case 5:$product = " PBF Mission Valley"; break;
                    case 8:$product = " IWP Buckeye"; break;
                    case 9:$product = " Flyers"; break;
                    case 10:$product = " Oil Services Clarkdal"; break;
                    case 11:$product = " Chevron Mission Valley"; break;
                    case 12:$product = " New Leaf"; break;
                    case 13:$product = " Everlast"; break;
                    case 14:$product = " Mira loma"; break;
                    case 16:$product = " North Central"; break;
                    case 21:$product = " Petro Diamond"; break;
                    case 20:$product = " McNeese"; break;
                    case 19:$product = " IWP Bswmr"; break;
                    case 18:$product = " Disneyland"; break;
                    case 17:$product = " Auburn Ontario"; break;
                    case 15:$product = " Other"; break;
                    default: $product =""; break;
                }
                
                switch($obs['element_4']){
                    case 4: $hauler = "MRI"; break;
                    case 5: $hauler = "FOB"; break;
                    case 6: $hauler = "IWP"; break;
                    case 7: $hauler = "Desert Soul"; break;
                    default: $hauler ="";
                }
                
                if($obs['me'] == null ){
                    $check = "<img src='img/red_cancel.png' title='Tank not set'>";
                }else{
                    $check ="<img src='img/check_green_2s.png' title='Tank set' style='width:10%;'/>";                    
                    $lotsample = $db->query("SELECT analy_cert FROM Inetforms.ap_form_43939 WHERE ap_form_43939.element_31 = $obs[me] ORDER BY date_created DESC");
                    if(count($lotsample)>0){
                        $pdf = "<a href='coa/".$lotsample[0]['analy_cert']."' target='_blank'><img src='img/pdfexp.gif'  style='width:25px;height:25px;'></a>";
                    }else{
                        $pdf="";
                    }
                }
                $addition .= "<img src='img/delete-icon.jpg' class='del_cal' style='cursor:pointer;' rel='$obs[id]' title='$obs[id]' />&nbsp;&nbsp;<span style='cursor:pointer;text-decoration:underline;' class='view_day' day='$list_day' month='$month' year='$year' id='$obs[id]'> $check)$product - $hauler &nbsp;&nbsp;<img src='img/edit-icon.jpg'/></span>&nbsp;&nbsp;$pdf<br/><br/>"; 
                
                                    
            }
        }else{
            $addition ="";
        }        
        if($list_day == date("d") && $year == date("Y") && $month == date("m")){
            $class=' today_outline ';
        }else{
            $class='';
        }
		$calendar.= '<td class="calendar-day '.$class.'">';
			/* add in the day number */
			$calendar.= $headex.'<div class="day-number" style="position:relative;top:-18px;">'.$list_day.'</div><div class="contentxx" style="width:200px;height:200px;overflow:auto;">'.$addition.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
$dateObj   = DateTime::createFromFormat('!m', $_GET['month']);
echo '<h2 style="width:100%;text-align:center;" id="headerx" rel="'.$_GET['month'].'" xlr="'.$_GET['year'].'">'.$dateObj->format('F').' '.$_GET['year'].'</h2>';

echo draw_calendar($_GET['month'],$_GET['year']);
?>
<script>

$('.del_all').click(function(){ 
   $.get("del_calander.php",{  month: $(this).attr('month'),year:$(this).attr('year'), day:$(this).attr('day')  ,all:1   },function(data){      
       alert(data);
   });  
});

$('.del_cal').click(function(){ 
   $.get("del_calander.php",{  idididi:$(this).attr('rel'),all:0   },function(data){       
       alert(data);
   });  
});


$("table").on("click",".view_all",function(){
    Shadowbox.open({
        content:"view_entry.php?day="+$(this).attr('day')+'&year='+$(this).attr('year')+'&month='+$(this).attr('month'),
        player:"iframe",
        width:"800",
        height:"500",
        title:"View Entry"
    })
});

$("table").on("click",".view_day",function(){
    Shadowbox.open({
        content:"view_entry.php?id="+$(this).attr('id'),
        player:"iframe",
        width:"800",
        height:"140",
        title:"View Entry"
    })
});
</script>