<?php
error_reporting (E_ALL & ~E_NOTICE);
session_start();

$grand1 = 0; $grand2 = 0; $grand3 = 0;$grand4 = 0;

if ( $_SESSION['hw777logged'] == "logged" )
{}
    $hit ="no";
    include "login.php";	
    include "xlsfunctions.php"; 
    
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Disposition: attachment;filename=BuyerTotals".date("c").".xls ");
    header("Content-Transfer-Encoding: binary ");
    xlsBOF();
    
    xlsWriteLabel(0,0,"Buyer");    xlsWriteLabel(0,1,"Individual Total");  xlsWriteLabel(0,2,"Group"); xlsWriteLabel(0,4,"Group 1"); xlsWriteLabel(0,5,"Group 2");
    xlsWriteLabel(0,6,"Group 3"); xlsWriteLabel(0,7,"Group 4");
    /**/
    $grand = 0;
    $result= mysql_query("SELECT owner_id,login,groupz FROM hw777users WHERE role = 'buyer' order by groupz") or die(Mysql_error());
    if(mysql_num_rows($result) == 0){
        ?>
        <script>
        alert("No Buyers to print!");
        </script>
        <?php
    }
    else
    {
           
   	    $xlsRow = 0;
        $xlsCol = 0;
        
        
        while( $order = mysql_fetch_array($result) ) { //get the buyers' owner_id and login name
        
            // reset all values;
            $totalO = 0;
            $totalQ = 0;
            $h = 0;
           
            $xlsRow++;
            
            if($xlsRow == 0)
    		{
    			$xlsRow = 1;
    		}
            
            $bvc = mysql_query("SELECT quantity FROM hw777orders WHERE buyer_id = $order[owner_id]") or die(Mysql_error());
            $usr = mysql_query("SELECT commission,login FROM hw777users WHERE owner_id= $order[owner_id]");
            $user = mysql_fetch_array($usr);
            
            
            
            $h = $user['commission']/100;
                       
            
            
            while($number =  mysql_fetch_array($bvc)){
                $totalQ = $totalQ + $number['quantity'];
            }
            
             $totalO = $totalQ * $h;
            xlsWriteLabel($xlsRow,$xlsCol,"$order[login]");    
            
            xlsWriteLabel($xlsRow,$xlsCol+1,  number_format( ($totalQ- $totalO)/100,1 )   );  
            
               
              
               //echo "<tr><td>".$order['login']."</td><td align='right'>".number_format( ($totalQ- $totalO)/100,1 )."</tr>" ;
            
            
               
            $grand = $grand + ( ($totalQ - $totalO)/100  );
            
            
            
             switch($order['groupz']){
                    case 1:
                        $groupx = "Group 1";
                        
                        break;
                    case 2:
                        $groupx = "Group 2";
                       
                        break;
                    case 3:     
                        $groupx = "Group 3";
                        
                        break;
                    case 4:
                        $groupx = "Group 4";
                       
                        break;    
                    default:   
                        $groupx = "Groupless";                                                                                            
                    }
            
            xlsWriteLabel($xlsRow,$xlsCol+2,$groupx);
        }
        
    }
    
    
    
    
    
    $bhff = mysql_query("SELECT owner_id,commission,login FROM hw777users WHERE groupz = 1") or die(mysql_error() );
    
    if(mysql_num_rows($bhff) !=0){
        
        while($person = mysql_fetch_array($bhff)){ 
             $num = 0;
            $totalO = 0;
            $totalQ = 0;
            $h = 0;
            
           $h = $person['commission']/100;
           
           $jh = mysql_query("SELECT quantity FROM hw777orders WHERE buyer_id = $person[owner_id]") or die(mysql_error() );
            while($order = mysql_fetch_array($jh)){                
                $totalQ = $totalQ + $order['quantity'];                
            }   
            
            $totalO = $totalQ *$h;
            $grand1 = $grand1 + number_format( ($totalQ- $totalO)/100,1 );
        }
    }
    else
    {
        $grand1 = 0;
        
    }
    
    xlsWriteLabel(1,4,$grand1);
    $bhff = mysql_query("SELECT owner_id,commission,login FROM hw777users WHERE groupz = 2") or die(mysql_error() );
    
    if(mysql_num_rows($bhff) !=0){
        
        while($person = mysql_fetch_array($bhff)){ 
             $num = 0;
            $totalO = 0;
            $totalQ = 0;
            $h = 0;
            
           $h = $person['commission']/100;
           
           $jh = mysql_query("SELECT quantity FROM hw777orders WHERE buyer_id = $person[owner_id]") or die(mysql_error() );
            while($order = mysql_fetch_array($jh)){                
                $totalQ = $totalQ + $order['quantity'];                
            }   
            
            $totalO = $totalQ *$h;
            $grand2 = $grand2 + number_format( ($totalQ- $totalO)/100,1 );
        }
    }
    else
    {
        $grand2 = 0;
        
    }
    
    
     $totalO = 0;
     $totalQ = 0;
    $h = 0;
    $num = 0;
    
    
    
   
     xlsWriteLabel(1,5,$grand2);
    $bhff = mysql_query("SELECT owner_id,commission,login FROM hw777users WHERE groupz = 3") or die(mysql_error() );
    
    if(mysql_num_rows($bhff) !=0){
        
        while($person = mysql_fetch_array($bhff)){ 
             $num = 0;
            $totalO = 0;
            $totalQ = 0;
            $h = 0;
            
           $h = $person['commission']/100;
           
           $jh = mysql_query("SELECT quantity FROM hw777orders WHERE buyer_id = $person[owner_id]") or die(mysql_error() );
            while($order = mysql_fetch_array($jh)){                
                $totalQ = $totalQ + $order['quantity'];                
            }   
            
            $totalO = $totalQ *$h;
            $grand3 = $grand3 + number_format( ($totalQ- $totalO)/100,1 );
        }
    }
    else
    {
        $grand3 = 0;
        
    }
     xlsWriteLabel(1,6,$grand3);
    
    
    
    $bhff = mysql_query("SELECT owner_id,commission,login FROM hw777users WHERE groupz = 4") or die(mysql_error() );
    
    if(mysql_num_rows($bhff) !=0){
        
        while($person = mysql_fetch_array($bhff)){ 
             $num = 0;
            $totalO = 0;
            $totalQ = 0;
            $h = 0;
            
           $h = $person['commission']/100;
           
           $jh = mysql_query("SELECT quantity FROM hw777orders WHERE buyer_id = $person[owner_id]") or die(mysql_error() );
            while($order = mysql_fetch_array($jh)){                
                $totalQ = $totalQ + $order['quantity'];                
            }   
            
            $totalO = $totalQ *$h;
            $grand4 = $grand4 + number_format( ($totalQ- $totalO)/100,1 );
        }
    }
    else
    {
        $grand4 = 0;
        
    }
   
    xlsWriteLabel(1,7,$grand4);
    
    
    
    
    
    
    $xlsRow += 2; 
    xlsWriteLabel($xlsRow,0,"Grand Total:");
    xlsWriteLabel($xlsRow,1,"$grand");
        
        
        
      
        
    xlsEOF();
    
    

?>