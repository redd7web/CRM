<?php
include "plugins/phpToPDF/phpToPDF.php";
include "protected/global.php";
ini_set("display_errors",1);
// when you hit submit in the ER.php 
$check_ = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE id= $_GET[currentry]");// test just submitted
if( $check_[0]['source'] ==null || strlen($check_[0]['source'])== 0){
    $origination = "from_er";
}else {
    $origination = $check_[0]['source'];
}
if(isset($_GET['origid']) && $_GET['origid'] !=' ' && strlen($_GET['origid'])>0){
    $original_entry = $db->query("SELECT * FROM Inetforms.ap_form_44342 WHERE id = $_GET[origid]");//previous test
    
    
}else{
    echo "no origid<br/>";
}

if(count($check_)>0){// everything except dogfood
    switch($check_[0]['element_81']){//sample just submitted completed ? rejected ? retest ?
        case 1:// sample just completed
            // if entry just submitted was marked completed, if original was a pending sample update it with information with what was just submitted, and update just completed sample with source and original    
            $id= array(
                "source"=>$origination,
                "element_85"=>$original_entry[0]['id'],
                "element_16"=>$original_entry[0]['element_16'],
                "element_76"=>$original_entry[0]['element_76']
            ); 
            $db->where("id",$_GET['currentry'])->update("Inetforms.ap_form_44342",$id);
            
                     
            /*************** ORIGINAL SAMPLE STATUS *****************/
            switch( $original_entry[0]['element_81']  ){
                case 4://status of original entry      
                    $origi_data = array(
                        "element_4"=>$check_[0]['element_4'],
                        "element_8"=>$check_[0]['element_8'],
                        "element_9"=>$check_[0]['element_9'],
                        "element_10"=>$check_[0]['element_10'],
                        "element_11"=>$check_[0]['element_11'],
                        "element_12"=>$check_[0]['element_12'],
                        "element_13"=>$check_[0]['element_13'],
                        "element_14"=>$check_[0]['element_14'],
                        "element_6_1"=>$check_[0]['element_6_1'],
                        "element_6_2"=>$check_[0]['element_6_2'],
                        "element_6_3"=>$check_[0]['element_6_3'],
                        "element_6_4"=>$check_[0]['element_6_4'],
                        "element_6_5"=>$check_[0]['element_6_5'],
                        "element_6_6"=>$check_[0]['element_6_6'],
                        "element_6_7"=>$check_[0]['element_6_7'],
                        "element_6_8"=>$check_[0]['element_6_8'],
                        "element_6_9"=>$check_[0]['element_6_9'],
                        "element_6_10"=>$check_[0]['element_6_10'],
                        "element_6_11"=>$check_[0]['element_6_11'],
                        "element_6_12"=>$check_[0]['element_6_12'],
                        "element_6_13"=>$check_[0]['element_6_13'],
                        "element_6_14"=>$check_[0]['element_6_14'],
                        "element_6_15"=>$check_[0]['element_6_15'],
                        "element_6_16"=>$check_[0]['element_6_16'],
                        "element_6_17"=>$check_[0]['element_6_17'],
                        "element_17"=>$check_[0]['element_17'], 
                        "element_20"=>$check_[0]['element_20'],
                        "element_30"=>$check_[0]['element_30'],
                        "element_31"=>$check_[0]['element_31'],
                        "element_32"=>$check_[0]['element_32'],
                        "element_33"=>$check_[0]['element_33'],
                        "element_35"=>$check_[0]['element_35'],
                        "element_36"=>$check_[0]['element_36'],
                        "element_37"=>$check_[0]['element_37'],
                        "element_38"=>$check_[0]['element_38'],
                        "element_40"=>$check_[0]['element_40'],
                        "element_41"=>$check_[0]['element_41'],
                        "element_42"=>$check_[0]['element_42'],                        
                        "element_43"=>$check_[0]['element_43'],
                        "element_45"=>$check_[0]['element_45'],
                        "element_46"=>$check_[0]['element_46'],
                        "element_47"=>$check_[0]['element_47'],                        
                        "element_51"=>$check_[0]['element_51'],
                        "element_52"=>$check_[0]['element_52'],
                        "element_53"=>$check_[0]['element_53'],
                        "element_54"=>$check_[0]['element_54'],
                        "element_71"=>$check_[0]['element_71'],
                        "element_73"=>$check_[0]['element_73'],
                        "element_74"=>$check_[0]['element_74'],
                        "element_58"=>$check_[0]['element_58'],
                        "element_59"=>$check_[0]['element_59'],
                        "element_61"=>$check_[0]['element_61'],
                        "element_62"=>$check_[0]['element_62'],
                        "element_63"=>$check_[0]['element_63'],
                        "element_64"=>$check_[0]['element_64'],
                        "element_66"=>$check_[0]['element_66'],
                        "element_67"=>$check_[0]['element_67'],
                        "element_68"=>$check_[0]['element_68'],
                        "element_70"=>$check_[0]['element_70'],
                        "element_72"=>$check_[0]['element_72'],
                        "element_76"=>$check_[0]['element_76'],
                        "element_77"=>$check_[0]['element_77'],
                        "element_78"=>$check_[0]['element_78'],
                        "element_79"=>$check_[0]['element_79'],
                        "element_80_1"=>$check_[0]['element_80_1'],
                        "element_80_2"=>$check_[0]['element_80_2'],
                        "element_80_3"=>$check_[0]['element_80_3'],
                        "element_81"=>$check_[0]['element_81'],
                        "element_82"=>$check_[0]['element_82'],
                        "element_83"=>$check_[0]['element_83'],
                        "element_84"=>$check_[0]['element_84'],
                        "element_86_12"=>$check[0]['element_86_12'],
                        "element_86_13"=>$check[0]['element_86_13'],
                        "element_86_14"=>$check[0]['element_86_14'],
                        "element_86_15"=>$check[0]['element_86_15'],
                        "element_86_16"=>$check[0]['element_86_16'],
                        "element_86_17"=>$check[0]['element_86_17'],
                        "element_88"=>$check[0]['element_88'],
                        "element_6_18"=>$check[0]['element_6_18'],
                        "element_3"=>'Completed Original',
                        "source"=>$origination
                    );       
                      
                    if($db->where("ap_form_44342.id",$_GET['origid'])->update("Inetforms.ap_form_44342",$origi_data)){
                        header("Location:CompletedTests.php");
                    }
                break;
                case 3://if previous test was a pending retest, update it with Original status                   
                    if(isset($_GET['origid'])){
                         $origi_data = array(
                            "element_3"=>'Original Pending',
                            "element_16"=>$original_entry[0]['element_16'],
                            "source"=>$origination
                        );
                        if( $db->where("id",$_GET['origid'])->update("Inetforms.ap_form_44342",$origi_data) ){
                            header("Location:CompletedTests.php");
                        }
                    }                    
                break;
                case 2://rejected can you complete a rejected sample?
                break;
            }/*************** ORIGINAL SAMPLE STATUS *****************/
            header("Location:CompletedTests.php");    
        break;
        case 2://sample was just rejected
            //if sample was rejected delete original, then update newly created entry with rejected
            $id = array(
                "source"=>$origination,
                "element_76"=>$check_orig[0]['element_76'],
                "element_16"=>$check_orig[0]['element_16'],
                "element_85"=>$_GET['origid']
            );
            
           
            if($db->where("id",$_GET['currentry'])->update("Inetforms.ap_form_44342",$id)){                
                 if(isset($_GET['origid']) && strlen($_GET['origid'])>0  ){
                    if($db->query("UPDATE Inetforms.ap_form_44342 SET element_3 ='Original Rejected',element_81=2 WHERE id=$_GET[origid]")){
                        header("Location:CompletedTests.php");
                     }
                 }                 
            }
            header("Location:CompletedTests.php");
        break;
        case 3://sample was just retested      
        
             /*************** ORIGINAL SAMPLE STATUS *****************/
             switch($original_entry[0]['element_81']){
                case 1://if original was a completed sample update source completed sample with completed original           
                    $origi_data = array(
                        "element_3"=>"Completed Original"
                     );    
                     $db->where("id",$_GET['origid'])->update("Inetforms.ap_form_44342",$origi_data);
                break;
                case 2:// if original sample was a rejected 
                    $origi_data = array(
                        "element_3"=>"Original Rejected"
                    );
                    $db->where("id",$_GET['origid'])->update("Inetforms.ap_form_44342",$origi_data);                    
                break;
                case 3://if original was a pending retest sample, delete original and update newly submitted                     
                     $origi_data = array(
                        "element_3"=>"Pending Original"
                     );    
                     $db->where("id",$_GET['origid'])->update("Inetforms.ap_form_44342",$origi_data);
                break;
                case 4://if original sample was pending
                    $db->query("UPDATE Inetforms.ap_form_44342 SET  element_3='Original Pending' WHERE id = $_GET[origid]");
                break;
                break;
             }
             /*************** ORIGINAL SAMPLE STATUS *****************/
            
             
            
             $id= array(//update newly submitted entry with necessary information
                "element_85"=>$_GET['origid'],
                "source"=>$origination,
                "element_16"=>$original_entry[0]['element_16'],
                "element_76"=>$original_entry[0]['element_76']
             );   
             $db->where("id",$_GET['currentry'])->update("Inetforms.ap_form_44342",$id);             
             header("Location:PendingTests.php");
        break;
        case 4: //Sample was  created without OSR OR TSL directly from ER.php
            //echo "Pending Sample created without OSR or Truck Scale Log!";
            $db->query("UPDATE Inetforms.ap_form_44342 set source='from_er' WHERE id = $_GET[currentry]");
            header("Location:PendingTests.php");
        break;
    }
}/*else{
    $pet_food = $db->query("SELECT * FROM Inetforms.ap_form_45498 WHERE id = $_GET[currentry]");
    switch($pet_food[0]['element_81']){
        case 1:// completed certificate of destruction
            header("Location:CompletedDogFood.php");
        break;
        case 2://rejected
            header("Location:CompletedDogFood.php");
        break;
        case 3://sample was retested
            header("Location:PendingDogFood.php");
        break;
    }
}*/


?>