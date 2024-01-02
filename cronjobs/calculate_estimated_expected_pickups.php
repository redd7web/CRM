<?php
include "../protected/global.php";
//********************************* THIS SCRIPT TO BE RUN DAILY (CRON JOB)*******************************************//s

$all = $db->get($dbprefix."_accounts","account_ID");

foreach($all as $value){
    $account = new Account($value['account_ID']);
   $expected = 0;
    $askthree = $db->where('account_no',$account->acount_id)->orderby("date_of_pickup","DESC")->get($dbprefix."_data_table","inches_to_gallons,date_of_pickup");
    if(count($askthree)>0){
        $i = count($askthree);                    
        if($i>=4){
            //start completed pickups formula
           for($i=0;$i<5;$i++){           
                $expected = $expected + $askthree[$i]['inches_to_gallons'];
           }                            
           $expected_pickup_total =  $expected/4 ;
        }
        else {
            $expected_pickup_total=$account->estimated_monthly;
        }
        
        $buffer = array(
            "estimated_volume"=>round($expected_pickup_total,2)
        );
        $db->where("account_ID",$account->acount_id)->update($dbprefix."_accounts",$buffer);
        
    }
}
    

?>