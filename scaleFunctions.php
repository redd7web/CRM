<?php


function modern_ppb($lot){
    global $db;
    $m = "N/A";
    if(strlen(trim($lot))>0){
        $h = $db->query("SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_7 ='$lot' ORDER BY date_created LIMIT 0,1 ASC");
        if(count($h)>0){
            $m = $h[0]['element_10'];
        }    
    }
    return $m;
}

function non_modern_ppb($origin_weight_cert){
    global $db;
    $ko ="N/A";
    if( strlen(trim($origin_weight_cert))>0 ){
        $kv = $db->query("SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_24 ='$origin_weight_cert' ORDER BY date_created LIMIT 0,1 ASC");
        if(count($kv)>0){
            $ko = $kv[0]['element_10'];
        }    
    }
    return $ko;
    
}

function manual_approve($lookup){
   if(strlen(trim($lookup[0]['element_11_1']))>0 && $lookup[0]['element_11_1'] !=0){
            $_SESSION['manual_approve'][]= "'2'";
        }
            
        if(strlen(trim($lookup[0]['element_11_2']))>0 && $lookup[0]['element_11_2'] !=0){
            $_SESSION['manual_approve'][]= "'4'";
        }
           
        if(strlen(trim($lookup[0]['element_11_3']))>0 && $lookup[0]['element_11_3'] !=0){
            $_SESSION['manual_approve'][]= "'7'";
        }
            
        if(strlen(trim($lookup[0]['element_11_19']))>0 && $lookup[0]['element_11_19'] !=0){
            $_SESSION['manual_approve'][]= "'B'";
        }
        if(strlen(trim($lookup[0]['element_11_18']))>0 && $lookup[0]['element_11_18'] !=0){
            $_SESSION['manual_approve'][]= "'C'";
        }
            
        if(strlen(trim($lookup[0]['element_11_17']))>0 && $lookup[0]['element_11_17'] !=0){
            $_SESSION['manual_approve'][]= "'D'";
        }
            
        if(strlen(trim($lookup[0]['element_11_15']))>0 && $lookup[0]['element_11_15'] !=0){
            $_SESSION['manual_approve'][]= "'F'";
        }
        if(strlen(trim($lookup[0]['element_11_14']))>0 && $lookup[0]['element_11_14'] !=0){
            $_SESSION['manual_approve'][]= "'G'";
        }
            
        if(strlen(trim($lookup[0]['element_11_13']))>0 && $lookup[0]['element_11_13'] !=0){
            $_SESSION['manual_approve'][]= "'H'";
        }
        if(strlen(trim($lookup[0]['element_11_12']))>0 && $lookup[0]['element_11_12'] !=0){
            $_SESSION['manual_approve'][]= "'I'";
        }
            
        if(strlen(trim($lookup[0]['element_11_11']))>0 && $lookup[0]['element_11_11'] !=0){
            $_SESSION['manual_approve'][]= "'J'";
        }
        if(strlen(trim($lookup[0]['element_11_10']))>0 && $lookup[0]['element_11_10'] !=0){
            $_SESSION['manual_approve'][]= "'K'";
        }
            
        if(strlen(trim($lookup[0]['element_11_9']))>0 && $lookup[0]['element_11_9'] !=0){
            $_SESSION['manual_approve'][]= "'L'";
        }
        if(strlen(trim($lookup[0]['element_11_8']))>0 && $lookup[0]['element_11_8'] !=0){
            $_SESSION['manual_approve'][]= "'M'";
        }
            
        if(strlen(trim($lookup[0]['element_11_7']))>0 && $lookup[0]['element_11_7'] !=0){
            $_SESSION['manual_approve'][]= "'N'";
        }
        if(strlen(trim($lookup[0]['element_11_6']))>0 && $lookup[0]['element_11_6'] !=0){
            $_SESSION['manual_approve'][]= "'O'";
        }
      
        if(strlen(trim($lookup[0]['element_11_5']))>0 && $lookup[0]['element_11_5'] !=0){
            $_SESSION['manual_approve'][]= "'R'";
        }
        if(strlen(trim($lookup[0]['element_11_4']))>0 && $lookup[0]['element_11_4'] !=0){
            $_SESSION['manual_approve'][]= "'RP'";
        }
            
        if(strlen(trim($lookup[0]['element_11_20']))>0 && $lookup[0]['element_11_20'] !=0){
            $_SESSION['manual_approve'][]= "'RW'";
        }
        if(strlen(trim($lookup[0]['element_11_22']))>0 && $lookup[0]['element_11_22'] !=0){
            $_SESSION['manual_approve'][]= "'S'";
        }
            
        if(strlen(trim($lookup[0]['element_11_21']))>0 && $lookup[0]['element_11_21'] !=0){
            $_SESSION['manual_approve'][]= "'T'";
        }
        if(strlen(trim($lookup[0]['element_11_26']))>0 && $lookup[0]['element_11_26'] !=0){
            $_SESSION['manual_approve'][]= "'UC'";
        }
            
        if(strlen(trim($lookup[0]['element_11_25']))>0 && $lookup[0]['element_11_25'] !=0){
            $_SESSION['manual_approve'][]= "'UD'";
        }
       
            
        if(strlen(trim($lookup[0]['element_11_24']))>0 && $lookup[0]['element_11_24'] !=0){
            $_SESSION['manual_approve'][]= "'V'";
        }   
               
        if(strlen(trim($lookup[0]['element_11_23']))>0 && $lookup[0]['element_11_23'] !=0){
            $_SESSION['manual_approve'][]= "'W'";
        }   
        
        if(strlen(trim($lookup[0]['element_11_28']))>0 && $lookup[0]['element_11_28'] !=0){
            $_SESSION['manual_approve'][]= "'WT'";
        }   
     
        
        //element_10_33
        if(strlen(trim($lookup[0]['element_11_16']))>0 && $lookup[0]['element_11_16'] !=0){
            $_SESSION['manual_approve'][]= "'E'";
        } 
}


function divisions($lookup){
   if(strlen(trim($lookup[0]['element_10_1']))>0 && $lookup[0]['element_10_1'] !=0){
            $_SESSION['division'][]= "'2'";
        }
            
        if(strlen(trim($lookup[0]['element_10_2']))>0 && $lookup[0]['element_10_2'] !=0){
            $_SESSION['division'][]= "'4'";
        }
           
        if(strlen(trim($lookup[0]['element_10_3']))>0 && $lookup[0]['element_10_3'] !=0){
            $_SESSION['division'][]= "'7'";
        }
            
        if(strlen(trim($lookup[0]['element_10_4']))>0 && $lookup[0]['element_10_4'] !=0){
            $_SESSION['division'][]= "'B'";
        }
        if(strlen(trim($lookup[0]['element_10_5']))>0 && $lookup[0]['element_10_5'] !=0){
            $_SESSION['division'][]= "'C'";
        }
            
        if(strlen(trim($lookup[0]['element_10_6']))>0 && $lookup[0]['element_10_6'] !=0){
            $_SESSION['division'][]= "'D'";
        }
            
        if(strlen(trim($lookup[0]['element_10_8']))>0 && $lookup[0]['element_10_8'] !=0){
            $_SESSION['division'][]= "'F'";
        }
        if(strlen(trim($lookup[0]['element_10_9']))>0 && $lookup[0]['element_10_9'] !=0){
            $_SESSION['division'][]= "'G'";
        }
            
        if(strlen(trim($lookup[0]['element_10_10']))>0 && $lookup[0]['element_10_10'] !=0){
            $_SESSION['division'][]= "'H'";
        }
        if(strlen(trim($lookup[0]['element_10_11']))>0 && $lookup[0]['element_10_11'] !=0){
            $_SESSION['division'][]= "'I'";
        }
            
        if(strlen(trim($lookup[0]['element_10_12']))>0 && $lookup[0]['element_10_12'] !=0){
            $_SESSION['division'][]= "'J'";
        }
        if(strlen(trim($lookup[0]['element_10_13']))>0 && $lookup[0]['element_10_13'] !=0){
            $_SESSION['division'][]= "'K'";
        }
            
        if(strlen(trim($lookup[0]['element_10_14']))>0 && $lookup[0]['element_10_14'] !=0){
            $_SESSION['division'][]= "'L'";
        }
        if(strlen(trim($lookup[0]['element_10_15']))>0 && $lookup[0]['element_10_15'] !=0){
            $_SESSION['division'][]= "'M'";
        }
            
        if(strlen(trim($lookup[0]['element_10_16']))>0 && $lookup[0]['element_10_16'] !=0){
            $_SESSION['division'][]= "'N'";
        }
        if(strlen(trim($lookup[0]['element_10_17']))>0 && $lookup[0]['element_10_17'] !=0){
            $_SESSION['division'][]= "'O'";
        }
      
        if(strlen(trim($lookup[0]['element_10_20']))>0 && $lookup[0]['element_10_20'] !=0){
            $_SESSION['division'][]= "'R'";
        }
        if(strlen(trim($lookup[0]['element_10_21']))>0 && $lookup[0]['element_10_21'] !=0){
            $_SESSION['division'][]= "'RP'";
        }
            
        if(strlen(trim($lookup[0]['element_10_22']))>0 && $lookup[0]['element_10_22'] !=0){
            $_SESSION['division'][]= "'RW'";
        }
        if(strlen(trim($lookup[0]['element_10_23']))>0 && $lookup[0]['element_10_23'] !=0){
            $_SESSION['division'][]= "'S'";
        }
            
        if(strlen(trim($lookup[0]['element_10_24']))>0 && $lookup[0]['element_10_24'] !=0){
            $_SESSION['division'][]= "'T'";
        }
        if(strlen(trim($lookup[0]['element_10_25']))>0 && $lookup[0]['element_10_25'] !=0){
            $_SESSION['division'][]= "'UC'";
        }
            
        if(strlen(trim($lookup[0]['element_10_26']))>0 && $lookup[0]['element_10_26'] !=0){
            $_SESSION['division'][]= "'UD'";
        }
        if(strlen(trim($lookup[0]['element_10_27']))>0 && $lookup[0]['element_10_27'] !=0){
            $_SESSION['division'][]= "'US'";
        }
            
        if(strlen(trim($lookup[0]['element_10_28']))>0 && $lookup[0]['element_10_28'] !=0){
            $_SESSION['division'][]= "'V'";
        }   
               
        if(strlen(trim($lookup[0]['element_10_29']))>0 && $lookup[0]['element_10_29'] !=0){
            $_SESSION['division'][]= "'W'";
        }   
        
        if(strlen(trim($lookup[0]['element_10_30']))>0 && $lookup[0]['element_10_30'] !=0){
            $_SESSION['division'][]= "'WT'";
        }   
        
        if(strlen(trim($lookup[0]['element_10_32']))>0 && $lookup[0]['element_10_32'] !=0){
            //$_SESSION['division'][]= "";
        } 
        
        //element_10_33
        if(strlen(trim($lookup[0]['element_10_33']))>0 && $lookup[0]['element_10_32'] !=0){
            $_SESSION['division'][]= "'E'";
        } 
}

function three_pppb_tests($tk){
    global $db;
    $il = $db->query("SELECT element_10  FROM Inetforms.ap_form_43646 WHERE element_27 = '$tk'");
    if(count($il)>0){
        
        $format ="<table style='width:100%;'>";
        $format ."<tr>";
        foreach($il as $score){
            $format .= "<td>".$score['element_10']."</td>";
        }
        $format .="</tr></table>";
        return $format;
    }else{
        return "<table style='width:100%;'><tr><td>0</td></tr></table>";
    }
    
}


function ppb_descript_non_modern($tk,$origin_weight_cert){
    global $db;
    $difference = 0;
    
    $x = "";
    
    
    if(strlen(trim($origin_weight_cert))>0){
        $sample = $db->query("SELECT sample_bag_score,sample_bag_score2 FROM iwp_test_scale WHERE tk = '$tk' ");
        $result = $db->query("SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_24 = '$origin_weight_cert' AND element_16=1 and element_26 = 4 ORDER BY date_created DESC LIMIT 0,1");
        if(count($result)>0 && count($sample)>0){// does this have a sample bag and a sample test ?  if retesting for the first time, compare it to the lot 1 sample bag score
            $difference = $sample[0]['sample_bag_score'] - $result[0]['element_10'];
        }else{
            $difference = 0;
        }
    }
    
    if(abs($difference) >=3000){//if difference is +- 3000 flag it.
         $x = "<img src='img/Red_x.gif' style='width:25%;height:25%;'/>";
    }
    return $x;
}

function pppb_discep($weight_cert,$lot){    
    global $db;
    $difference = 0;
    $x = "";
    if(strlen(trim($weight_cert))>0){
        $sample = $db->query("SELECT sample_bag_score,sample_bag_score2 FROM iwp_test_scale WHERE tk = '$weight_cert' ");
        $result = $db->query("SELECT element_10 FROM Inetforms.ap_form_43646 WHERE element_7 = '$lot' AND ( element_15 IS NULL OR LENGTH( TRIM(element_15 ) ) =0 ) AND element_16=1 and element_26 = 4 ORDER BY date_created DESC LIMIT 0,1");
        if(count($result)>0 && count($sample)>0){// does this have a sample bag and a sample test ?  if retesting for the first time, compare it to the lot 1 sample bag score
            $difference = $sample[0]['sample_bag_score'] - $result[0]['element_10'];
        }else{
            $difference = 0;
        }
    }
    
    if(abs($difference) >=3000){//if difference is +- 3000 flag it.
         $x = "<img src='img/Red_x.gif' style='width:25%;height:25%;'/>";
    }
    return $x;
}


function void_check($void = NULL,$manual = NULL){
    if($void =="True"){
        return " style='background:orange;' ";
    }else if($manual > 0){
        return " style='background:red;color:white;font-weight:bold;' ";
    }else{
        return " style='background:white;' ";
    }
}




function division($compare =null, $weight = null){
    $html .="<select class='division' weight='$weight'><option value=''>Default</option>";
        $html .="<option "; 
            if($compare == '2'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='2'>2</option>
<option "; 
            if($compare == '4'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value ='4'>4</option>
<option "; 
            if($compare == '7'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='7'>7</option>
<option "; 
            if($compare == 'B'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='B'>B</option>
<option "; 
            if($compare == 'C'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='C'>C</option>
<option "; 
            if($compare == 'D'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='D'>D</option>
<option "; 
            if($compare == 'E'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='E'>E</option>
<option "; 
            if($compare == 'F'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='F'>F</option>
<option "; 
            if($compare == 'G'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='G'>G</option>
<option "; 
            if($compare == 'H'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='H'>H</option>
<option "; 
            if($compare == 'I'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='I'>I</option>
<option "; 
            if($compare == 'J'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='J'>J</option>
<option "; 
            if($compare == 'K'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='K'>K</option>
<option "; 
            if($compare == 'L'){
                $html .= " selected = 'selected'";
            }
        $html .= "  value='L'>L</option>
<option"; 
            if($compare == 'M'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='M'>M</option>
<option"; 
            if($compare == 'N'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='N'>N</option>
<option"; 
            if($compare == 'O'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='O'>O</option>
<option"; 
            if($compare == 'P'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='P'>P</option>
<option"; 
            if($compare == 'Q'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='Q'>Q</option>
<option"; 
            if($compare == 'R'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='R'>R</option>
<option"; 
            if($compare == 'RP'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='RP'>RP</option>
<option"; 
            if($compare == 'RW'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='RW'>RW</option>
<option"; 
            if($compare == 'S'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='S'>S</option>
<option"; 
            if($compare == 'T'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='T'>T</option>
<option"; 
            if($compare == 'UC'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='UC'>UC</option>
<option"; 
            if($compare == 'UD'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='UD'>UD</option>
<option"; 
            if($compare == 'US'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='US'>US</option>
<option"; 
            if($compare == 'V'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='V'>V</option>
<option"; 
            if($compare == 'W'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='W'>W</option>
<option"; 
            if($compare == 'WT'){
                $html .= " selected = 'selected'";
            }
        $html .= " value='WT'>WT</option>
        <option value='E' "; 
            if($compare == 'E'){
                $html .= " selected = 'selected'";
            }
        $html .= "  >E</option>";
    $html .="</select>";
    return $html;
}


function c_miles($customer){
    global $db;
    $j = $db->query("SELECT miles FROM iwp_customers WHERE CustomerKey  = $customer");
    if(count($j)>0){
        return $j[0]['miles'];
    }else{
        return 0;
    }
}

function v_miles($vendor){
    global $db;
    $j = $db->query("SELECT miles FROM iwp_vendors WHERE VendorKey  = $vendor");
    if(count($j)>0){
        return $j[0]['miles'];
    }else{
        return 0;
    }
}

function sn($tk,$wix){
    global $db;
    $wi = explode(" ",$wix);
    $s = $db->query("SELECT element_16 FROM Inetforms.ap_form_64000 WHERE element_2 = $tk AND ap_form_64000.element_7='$wi[0]' AND ap_form_64000.element_6 ='$wi[1]' ");
    
    if(count($s)>0){
        return $s[0]['element_16'];
    }else{
        return "";
    }
    
}


function haulerDecode($truck){
    global $db;
    if($truck !=NULL){
       $tr = $db->query("SELECT HaulerKey FROM iwp_scale_truck WHERE TruckKey = $truck");
        if(count($tr)>0){
            $hk = $db->query("SELECT Name FROM iwp_truck_haulers WHERE HaulerKey =".$tr[0]['HaulerKey']);
            if(count($hk)>0){
                return $hk[0]['Name'];
            }else{
                return "N/A";
            }
            
        }else{
            return "N/A";
        } 
    }else{
        return "N/A";
    }
    
}

function truckDecode($truck,$mode){
    global $db;
    
    switch($mode){
        case "name":
        $field = "Name";
        break;
        
        case "truckid":
        $field = "TruckID";
        break;
        case "id1":
        $field = "TrailerID1";
        break;
        case "id2":
        $field = "TrailerID2";
        break;
    }
    $tr = $db->query("SELECT $field FROM iwp_scale_truck WHERE TruckKey = $truck");
    if(count($tr)>0){
        return $tr[0]["$field"];
    }else{
        return "N/A";
    }
}

function productKey($productKey){
    global $db;
    $trans = $db->query("SELECT Name FROM iwo_products WHERE ProductKey = $productKey");
    
    if(count($trans)>0){
        return $trans[0]['Name'];
    }else{
        return "N/A";
    }
}


function CustomerKey($customerKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("CustomerKey",$customerKey)->get("iwp_customers","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}


function Vendors($vKey){
    $customer = "N/A";
    global $db;
    $cust = $db->where("VendorKey",$vKey)->get("iwp_vendors","Name");
    if(count($cust)>0){
        $customer = $cust[0]['Name'];
    }
    return $customer;
}


function approval_buyer_seller($vendor,$customer,$division){
    
    switch($division){
        case '2':
        break;
        case '7':
        break;
        case 'B':
        break;
        case 'C':
        break;
        case 'D':
        break;
        case 'F':
        break;
        case 'G':
        break;
        case 'H':
        break;
        case 'I':
        break;
        case 'J':
        break;
        case 'K':
        break;
        case 'L':
        break; 
        case 'M':
        break;
        case 'N':
        break;
        case 'O':
        break;
        case 'P':
        break;
        case 'Q':
        break;
        case 'R':
        break;
        case 'RP':
            if( strlen(trim($vendor))>0 || $vendor != NULL ){
                echo Vendors($vendor);
            }else if( strlen(trim($customer))>0  || $customer != NULL  ){
                echo CustomerKey($customer);
            }else{
                echo "N/A";
            }
        break;
        case 'RW':
        break;
        case 'S':
        break;
        case 'T':
        break;
        case 'UD':
        break;
        case 'US':
        break;
        case 'UC':
        break;
        case 'S':
        break;
        case 'V':
        break;
        case 'W':
        break;
        case 'WT':
        break;
    }
    
}

?>