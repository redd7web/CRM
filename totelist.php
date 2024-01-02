<?php                
    //$holders = $db->query("SELECT entry,container,account_no FROM iwp_containers WHERE account_no=$account->acount_id");
   //where("delivery_date",)->where("account_no",$account->acount_id)->get($dbprefix."_containers","entry,container,account_no");
   if(count($account->barrel_info)>0){
        foreach($account->barrel_info as $totes){
            $statx = "";
            if($totes['removal_date'] !="0000-00-00"){
                $statx = "(Removed) $totes[removal_date]";
            }else{
               $statx = ""; 
            }
            echo "<div class='toterow' style='width:100%;height:30px;margin-bottom:5px;padding:5px 5px 5px 5px;'>
            <div class='lefthold' style='width:50%;float:left;'>".$totes['container_label']." ".$statx."</div>";
            if($person->isAdmin()){
                echo "<div class='righthold' style='width:50%;height:16px;background:url(img/delete-icon.jpg) no-repeat left top;cursor:pointer;float:left;' account='$totes[account_no]' entry ='".$totes['entry']."' container_id='$totes[container_id]'>
            &nbsp;
            </div>";
            }
            echo "
          </div>"; 
        }
    }  
?> 