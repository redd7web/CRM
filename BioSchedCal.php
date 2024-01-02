<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Ede Dizon" />
    <style type="text/css">
    body{
        padding:10px 10px 10px 10px;
        margin:10px 10px 10px 10px;
    }
    /* calendar */
table.calendar		{ border-left:1px solid #999;height:1000px; }
tr.calendar-row	{  }
td.calendar-day	{ min-height:200px; font-size:11px; position:relative; } * html div.calendar-day { height:200px; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }
.today_outline{
    outline: 2px solid red;
}
.contentxx{

}
    </style>
    <?php 
    include "source/css.php";
    include "source/scripts.php";
    ?>
	<title>Bio Schedule Calendar</title>
</head>

<body>

<?php
include "protected/global.php";
date_default_timezone_set('America/Los_Angeles');
ini_set("display_errrors",1);



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
            $headex ="<img src='img/delete-icon.jpg' class='del_all' style='cursor:pointer;' month='$month' year='$year' day='$list_day' title='Delete all for this day'>&nbsp;&nbsp;<span style='cursor:pointer;text-decoration:underline;float:left;' class='view_all' day='$list_day' year='$year' month='$month'>View All (".count($stuff).")</span><br/>";
            foreach($stuff as $obs){
                $me ="";
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
                
                if($obs['me'] == null   ){
                    $check = "<img src='img/red_cancel.png' title='Tank not set'>";  $me = 0;
                }else{
                    $check ="<img src='img/check_green_2s.png' title='Tank set' style='width:10%;'/>";
                    switch($obs['me']){                       
                        case 1: $me = 1; break;
                        case 2: $me = 2; break;
                        case 3: $me = 3; break;
                        case 16: $me = 4; break;
                        case 15: $me = 5; break;
                        case 14: $me = 6; break;
                        case 13: $me = 7; break;
                        case 12: $me = 8; break;
                        case 11: $me = 9; break;
                        case 10: $me = 10; break;
                        case 9: $me = 11; break;
                        case 8: $me = 12; break;
                        case 7: $me = 13; break;
                        case 6: $me = 14; break;
                        case 5: $me = 15; break;
                        case 4: $me = 16; break;
                        case 17: $me = 17; break;
                        case 18: $me = 18; break;
                        case 23: $me = 19; break;
                        case 22: $me = 20; break;
                        case 21: $me = 21; break;
                        case 19: $me = 22; break;
                        default: $me = 0;break;
                    }
                    $lotsample = $db->query("SELECT analy_cert FROM Inetforms.ap_form_43939 WHERE ap_form_43939.element_31 = $obs[me] ORDER BY date_created DESC");
                    if(count($lotsample)>0){
                        $pdf = "<a href='coa/".$lotsample[0]['analy_cert']."' target='_blank'><img src='img/pdfexp.gif'  style='width:25px;height:25px;'></a>";
                    }else{
                        $pdf="";
                    }
                }
                $addition .= "<img src='img/delete-icon.jpg' class='del_cal' style='cursor:pointer;' rel='$obs[id]' title='$obs[id]'/>&nbsp;&nbsp;<span style='cursor:pointer;text-decoration:underline;' class='view_day' day='$list_day' month='$month' year='$year' id='$obs[id]'> $check)$product - $hauler &nbsp;&nbsp;<img src='img/edit-icon.jpg'/></span>&nbsp;&nbsp;$pdf<br/><br/> "; 
                
                                    
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
	echo $calendar;
}

/* sample usages */
echo "<table style='width:100%;'><tr><td style='text-align:left;cursor:pointer;font-size:70px;' id='prev'>&laquo;</td><td style='text-align:right;cursor:pointer;font-size:70px;' id='next'>&raquo;</td></tr></table>";

echo "<div style='width:100%;' id='hold'>";
echo '<h2 style="width:100%;text-align:center;" id="headerx" rel="'.date('m').'" xlr="'.date('Y').'">'.date("M").' '.date("d").', '.date("Y").'</h2>';

draw_calendar(date("m"),date("Y"));
echo "</div>";

?>
<script>

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

$('#prev').click(function(){
    var month =( $("#headerx").attr('rel') *1) -1;
    var year = <?php echo date("Y"); ?>; 
    if(month<1){
        month = 12;
        year =($("#headerx").attr('xlr') *1) -1;
    }
   $.get("getCal.php",{month:month,year:year},function(data){
        $("#hold").html(data);
   }); 
});

$('#next').click(function(){   
    var month =( $("#headerx").attr('rel') *1) +1;
    var year = <?php echo date("Y"); ?>;     
    if(month>12){
        month = 1;
         year = ($("#headerx").attr('xlr') *1) +1;
    }   
   $.get("getCal.php",{month:month,year:year},function(data){       
        $("#hold").html(data);
   });  
});

//
$('.del_all').click(function(){    
   if(confirm("Are you sure you want to delete this entry?")){
        $.get("del_calander.php",{  month: $(this).attr('month'),year:$(this).attr('year'), day:$(this).attr('day')  ,all:1   },function(data){
           alert(data);
       });
   }
});

$('.del_cal').click(function(){ 
  if(confirm("Are you sure you want to delete this entry?")){
    $.get("del_calander.php",{  idididi:$(this).attr('rel'),all:0   },function(data){       
        alert(data);
    });  
  }
});



</script>
</body>
</html>