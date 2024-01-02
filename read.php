<?php


include "protected/global.php";
//ini_set('max_execution_time', 9000); 
ini_set('xdebug.var_display_max_depth', 50);
ini_set('xdebug.var_display_max_children', 10000);
ini_set('xdebug.var_display_max_data', 10000);

function aname_to_number($name){
    $db = new Database();
    global $dbprefix;
    $kl = $db->where("name",$name)->get($dbprefix."_accounts","account_ID");
    if(count($kl)>0){
        return $kl[0]['account_ID'];
    }else {
        return NULL;
    }
}


$str = file_get_contents("exports/locations.txt");

$str = str_replace("\t","|",$str);

$str = str_replace("\n","~",$str);
//echo $str;

$a = explode("~",$str);
$max = count($a);
$top = explode("|",$a[2]);


echo "<table style='width:100%;border:1px solid #bbb;'>";
echo "<tr>";
$j = 0;
foreach($top as $header){
    echo "<td>$j<br/>$header</td>";
    $j++;
}

echo"</tr>";
echo "</table>";

/**/

for($i=3;$i<$max-3;$i++){
   $line = explode("|",$a[$i]);
   
   if(strlen($line[2])>0 || strlen($line[15]>0)){
        echo $line[1]." ".$line[15]." f#".reverseTranslate($line[15])."<br/><br/>";
   
       $update_info = array(
            "division"=>reverseTranslate($line[15])
       );
        $db->where("account_ID",$line[1])->update($dbprefix."_accounts",$update_info);
    }      
}






?>



