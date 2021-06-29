<?php
include "protected/global.php";
ini_set("display_errors",1);
$accounts = $db->query("SELECT account_ID, name, division
FROM `iwp_accounts`
WHERE status IN('Active','new')  ");

/* if(count($accounts)>0){
	foreach($accounts as $account){
		echo $account['name'] . $account['account_ID'] . $account['division'];
		echo "<br>";
	}
} */
		

if(count($accounts)>0){
    foreach($accounts as $account){
        $route = $db->query("SELECT DISTINCT (
route_id
), SUM( inches_to_gallons ) AS inches_to_gallons, date_of_pickup
FROM iwp_data_table
WHERE account_no =$account[account_ID]
GROUP BY route_id
ORDER BY date_of_pickup DESC ");



        if(count($route)>0){
            //echo $account['name']." ".$route[0]['inches_to_gallons']." ".$route[0]['date_of_pickup']."<br/>";
            echo "UPDATE iwp_accounts SET amount_of_last_pickup = ".$route[0]['inches_to_gallons']." WHERE account_ID = $account[account_ID]  <br/>";
            $db->query("UPDATE iwp_accounts SET amount_of_last_pickup = ".$route[0]['inches_to_gallons'].",date_of_last_pickup='".$route[0]['date_of_pickup']."' WHERE account_ID = $account[account_ID]  ");
			echo $account['account_ID'] . "<br>";
        }
    }
}


?>