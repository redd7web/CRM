
<?php

ini_set("display_errors",1);
function getDaysBetween2Dates(DateTime $date1, DateTime $date2, $absolute = true){
    $interval = $date2->diff($date1);
    // if we have to take in account the relative position (!$absolute) and the relative position is negative,
    // we return negatif value otherwise, we return the absolute value
    return (!$absolute and $interval->invert) ? - $interval->days : $interval->days;
}
$thelist="";
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if (($file != ".") && ($file != "..") && strstr($file,".pdf") ){
            
            $interval = getDaysBetween2Dates( new DateTime( date("Y-m-d", filemtime($file))  ) ,  new DateTime( date("Y-m-d") ) , true);
            
            $thelist .= '<li><a href="'.$file.'">'.$file;  
            
            if(   $interval > 365 ){
                $thelist .=" moved ";
            }
            
            $thelist .="</a> date created ".date("Y-m-d H:i:s.", filemtime($file) )." ($interval) days </li>";
        }
    }

    closedir($handle);
}
?>

<p>List of files:</p>
<ul>
<p><?=$thelist?></p>
</ul>