<?php
include "protected/global.php";
include "plugins/phpToPDF/phpToPDF.php";
ini_set("display_errors",0);
$report ="";
$cotton = $db->query("SELECT * FROM Inetforms.ap_form_43646 WHERE ap_form_43646.id = $_GET[Req_ID]");
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: No-reply@iwpusa.com'."\r\n".'Reply-To: No-reply@iwpusa.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
echo "<pre>";
print_r($cotton);
echo "</pre>";

    switch($cotton[0]['element_3']){//requestor
        case 4: $requestor = "Ruben"; break;
        case 5: $requestor = "Ricardo"; break;
        case 6: $requestor = "Ivan"; break;
        case 7: $requestor = "Johhny"; break;
        case 8: $requestor = "Joe"; break;
        case 9: $requestor = "Daniel"; break;
        case 10: $requestor = "Omar"; break;
        case 11: $requestor = "Pablo"; break;
        case 12: $requestor = $cotton[0]['element_4']; break;
        
    }


$package = array(
    "element_16"=>$_GET['Req_ID'],//operator sample request assigned id
    "date_created"=>$cotton[0]['date_created'],
    "ip_address"=>$cotton[0]['ip_address'],       
    "status"=>1,
    "element_3"=>"Completed",//status
    "element_8"=>$cotton[0]['element_1'],//request date
    "element_9"=>$cotton[0]['element_2'],//request time
    "element_77"=>$cotton[0]['element_7'],
    "element_4"=>$cotton[0]['element_3'],
    "element_10"=>$requestor,//requestor
    "source"=>"from_cotton",//source
    "element_11"=>$cotton[0]['element_5'],//Commodity
    "element_12"=>$cotton[0]['element_9'],//Origin
    "element_13"=>$cotton[0]['element_10'],//Alfatoxin
    "element_14"=>$cotton[0]['element_11'],//Disposition
    "element_84"=>$cotton[0]['element_12']//Drop Down
);

//echo "<pre>";
//print_r($package);
//echo "</pre>";
/**/
if($db->insert("Inetforms.ap_form_44342",$package)){
    $for = $db->getInsertId();
    echo $db->getInsertId()." pending/completed id";
    echo "
    </br>
    </br>
    </br>
    Success! Your submission has been saved!
    </br>
    For your records ( <em style='color:red;font-size:1em;line-height:1'>$_GET[Req_ID]</em>)
    </br>
    </br>
    </br>
    </br>
    Please  
    </br>
    <a href='https://inet.iwpusa.com/OSR.php'>Click here</a>
    </br>
    to start a new entry
    </br>
    </br>
    </br>
    <a href='https://inet.iwpusa.com/CompletedTests.php'>Click here to View COMPLETED Lab Tests</a>
    </br>
    <a href='https://inet.iwpusa.com/PendingTests.php'>Click here to View PENDING Lab Tests</a>";
    
    $kl = $db->query("SELECT * FROM Inetforms.ap_form_43646 WHERE ap_form_43646.id =$_GET[Req_ID] ORDER BY date_created DESC");
    
    
    /**/
    if(count($kl)>0){
         // how mamy test samples are there?
        if(count($kl) == 2 && strlen(trim( $kl[0]['element_27']))>0 ){// find if there are retests, then compare it to the sample lot entered.
            $sample = $db->query("SELECT * FROM iwp_test_scale WHERE tk = ".$kl[0]['element_27']);
            $difference = abs($sample[0]['sample_bag_score'] - $kl[0]['element_10']);   
            if($difference >=3000){
                $sample_bag_number =$kl[0]['element_7'];
                $sample_ppb =$kl[0]['element_10'];
                $weight_cert=$kl[0]['element_15'];
                $weight_cert_ppb=$sample[0]['sample_bag_score'];
                mail("IT@iwpusa.com","--------DISCREPENCY------","There has been a 3000 discrepency on a load.\r\nSample Back Number: $sample_bag_number \r\n Sample Bag ppb: $sample_ppb \r\n Weight Certificate: $weight_cert \r\n Sample ppb: $weight_cert_ppb",$headers);
            }
        }
    }
    
    if(count($kl)>0){
        if($kl[0]['element_16']==1){ 
            switch($kl[0]['element_16']){
                case 1: $origin = "Modern Gin"; break;
                case 2: $origin = "YUCO";
                case 4: $origin = "Coachella Facility"; break;
                case 5: $origin = "Crit"; break;
                case 6: $origin = "Other"; break;
                case 3: $origin = $kl[0]['element_5']; break;
            }
            switch($kl[0]['element_11']){//disposition
                case 1: $disposition = "OK"; break;
                case 2: $disposition = "R"; break;
                case 3: $disposition = "F"; break;
                
            }
        
            $report .= "<!DOCTYPE HTML><html><head><title>Exported Completed Routes</title><style type='text/css'> @page{ size: 8.5in 11in;margin: 0.5in;} body { font-family:Tahoma;} img {border:0;} #page { width:800px; margin:0 auto; padding:15px;}#logo { float:left; margin:0;} #address { height:181px; margin-left:250px; } table { width:100%;  border:0px solid #bbb;} td{ padding: 1px 1px 1px 1px; border: 3px solid black;} tr.odd { background:#e1ffe1;} #bar2 > div{ padding:0px 0px 0px 0px; } #bar3 > div { padding:0px 0px 0px 0px; }</style></head><body><table style='width:100%;'><tr><td colspan='10' style='text-align:left;'><img src='https://inet.iwpusa.com/img/IWPlogo.png'/></td></tr><tr><td colspan='10' style='text-align:center;font-size:36px;font-weight:bold;font-family: 'Verdana', Times, serif;'>Cotton Seed Report<br/>Activity Report For: ".$kl[0]['date_created']."</td></tr><tr><td>Technician</td> <td>$requestor</td></tr><td>Origin</td><td>$origin</td></tr><td>Lot # </td><td>".$kl[0]['element_7']."</td></tr><td>Driver </td><td>".$kl[0]['element_8']."</td></tr><td>Commodity</td><td>".$kl[0]['element_9']."</td></tr><td>Alfatoxin</td><td>".$kl[0]['element_10']."</td></tr><td>Disposition</td><td>$disposition</td></tr><td>Note</td><td>".$kl[0]['element_13']."</td></tr><td>Weight Ticket No.</td><td>".$kl[0]['element_15']."</td></tr><td>Newbos Number</td><td>".$kl[0]['element_17']."</td></tr></tr><tr><td colspan='2'><span style='font-size:12px;font-weight:bold;font-style:italic;'></span></td></tr></table></body></html>";
            echo " report: $report";
            $path = 'machforms/machform/data/form_43646/files/';
            $file_name = "Cotton_Seed_Report".date("Y-m-d")."-$_GET[Req_ID].pdf";
            $pdf_options = array(
                "source_type" => 'html',
                "source" => $report,
                "action" => 'save',
                "save_directory" => $path,
                "page_orientation" => 'portrait',
                "file_name" => $file_name,
                "page_size" => 'legal'
            );
            phptopdf($pdf_options);
            mail("EDizon@iwpusa.com,Tprokop@iwpusa.com,LNavarro@iwpusa.com","Cotton Report ".date("Y-m-d")."-$_GET[Req_ID]","Click here to review report <a href='https://inet.iwpusa.com/view_cotton_report.php?file=$file_name&entry_=$_GET[Req_ID]&report_type=".$kl[0]['element_16']."'>Click here to view report</a>",$headers);
        }
    }
    
        
   
    
    
    
    
    
}

?>
