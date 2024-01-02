
<?php
#!/usr/bin/php5 -q
date_default_timezone_set('America/Los_Angeles');
ini_set("display_errors",1);
//include "/var/www/html/bakery/protected/global.php";
//$local_path = "/home/iwp2/Desktop/Bimbo1.CSV.CSV";

include "/var/www/html/protected/global.php";


if(file_exists("/var/www/html/croncsv/customers.csv")){
    $lines =file('/var/www/html/croncsv/customers.csv');
    $count = 1;
    foreach($lines as $data){
        $break = explode("\r",$data); 
        $k = explode(",",$break[0]);
         $pack = array(
            "CustomerKey"=>$k[13],
            "CustomerID"=>str_replace('"',"",$k[14]),
            "Name"=>str_replace("\"","",$k[15]),
            "BillToAddressKey"=>$k[16],
            "ShipToAddressKey"=>$k[17],
            "Phone"=>$k[18],
            "Fax"=>$k[19],
            "ContactName"=>$k[20],
            "Inactive"=>$k[21],
            "DiscountKey"=>$k[22],
            "Notes"=>$k[23],
            "InboundTicket"=>$k[24],
            "OutboundTicket"=>$k[25]
        );
        echo "<pre>";
        echo "Line number:$count";
        echo "<br";
        print_r($k);
        echo "<br/>-------<br/>";
        echo "Value of the insert/update";
        echo "<br>";
        print_r($pack);
        echo "</pre>";

        $customerID = str_replace('"',"",$k[14]);
        $customerName = str_replace("\"","",$k[15]);

//        $sql_insert = "INSERT INTO iwp_customers (CustomerKey,
//                                                    CustomerID,
//                                                    Name,
//                                                    BillToAddressKey,
//                                                    ShipToAddressKey,
//                                                    Phone,
//                                                    Fax,
//                                                    ContactName,
//                                                   Inactive,
//                                                   DiscountKey,
//                                                   Notes,
//                                                   InboundTicket,
//                                                   OutboundTicket) VALUES
//                                                    ($k[13],$customerID,'$customerName','$k[16]','$k[17]','$k[18]','$k[19]','$k[20]','$k[21]','$k[22]','$k[23]','$k[24]','$k[25]');";

        
        if($count !=1){//skip 1st line
            $check_ = $db->query("SELECT CustomerKey FROM iwp_customers WHERE CustomerKey = $k[13]");
            if(count($check_)==0){
                $db->insert("iwp_customers",$pack);
                
                echo "<br>";

                echo "<br>";


                echo "Customer ID Inserted:$k[13]<br>";
            }else{
                $db->where("CustomerKey",$k[13])->update("iwp_customers",$pack);
                echo "Customer ID Updated:$k[13]<br>";
            }
        }
        $count++;
    }
}




unset($db);


?>