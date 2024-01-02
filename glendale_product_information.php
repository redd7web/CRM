<?php
include "protected/global.php";
ini_set("display_errors",0);
if(isset($_GET['entry_id'])) {

    echo "<div style='text-align:center;font-size:40px;'>";
    echo "<img src='https://inet.iwpusa.com/img/all_pro_logo_1.png'><br>";
    echo "Entry Submitted!<br>";

    echo "<a href='https://inet.iwpusa.com/Glendale.php'> Click Here to Create a New Entry</a>";

    echo "<div>";
    $headers = 'From: noreply@iwpusa.com \r\n';
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



    //Query the database for the entry that is submitted.
    $request = $db->query("SELECT id,
                                    element_9_1,
                                    element_10_1,
                                    element_11,
                                    element_13,
                                    element_23,
                                    element_39, 
                                    element_40,
                                    element_19,
                                    element_33,
                                    element_34,
                                    element_35,
                                    element_36
                            FROM Inetforms.ap_form_78357 WHERE id = $_GET[entry_id]");

    //If results results greater than 0 assign elements to variable names to make logic easier.
    if(count($request) > 0 ){

        $receiving_checkbox = $request[0]['element_9_1'];
        $shipping_checkbox = $request[0]['element_10_1'];
        $customer = $request[0]['element_11'];
        $carrier = $request[0]['element_13'];
        $product = $request[0]['element_23'];

        //Updates 7/9/20
        $fats_and_oils = $request[0]['element_39'];
        $solids = $request[0]['element_40'];
        $net = $request[0]['element_19'];


        //updates 8/5/2020
        $MIU_water = $request[0]['element_33'];
        $MIU_interface = $request[0]['element_34'];
        $MIU_solids = $request[0]['element_35'];
        $percentage_ffa = $request[0]['element_36'];


        //if receiving is checked
    if ($receiving_checkbox == 1){

                //adding logic for receiving Lime Product 12/12/2020
                if($product == 11){
                    $note = "Receiving Lime Entry: Entry " . $_GET['entry_id'];
                    $email_recipients = "sgastelum@iwpusa.com;cochoa@iwpusa.com;Ytapia@iwpusa.com";

                    $message = "Hello, <br> Please click the following link to view an incoming Lime Product Load
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";
                    mail($email_recipients, $note, $message, $headers);

                }



                //if fats and oils are less 75 & Oil
                //incoming oil load
                if($fats_and_oils < 75 && $product == 2){
                    $note = "Fats and Oils Less Than 75%: Entry " . $_GET['entry_id'];
                    $email_recipients = "sgastelum@iwpusa.com;jtrawick@iwpusa.com;cochoa@iwpusa.com;rparsons@iwpusa.com";

                    $message = "Hello, <br> Please click the following link to view an incoming oi
l load with fats and oils less than 75% route product information.
                                    <br>
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> 
                                    <br>
                                     
                                     <p>Percent MIU Water: $MIU_water</p>
                                     <p>Percent MIU Interface: $MIU_interface</p>
                                     <p>Percent MIU Solids:$MIU_solids </p>
                                     <p>Percentage FFA: $percentage_ffa</p>
                                     <p>Fats & Oils: $fats_and_oils</p>
                                     
                                     <br>
                                    
                                    ";

                    mail($email_recipients, $note, $message, $headers);

                }



                //if grease trap and solds > 20
                if($product == 1 && $solids > 20){

                    $note = "Incoming Waste Water With Greater than 20% Solids: Entry " . $_GET['entry_id'];
                    $email_recipients = "sgastelum@iwpusa.com;jtrawick@iwpusa.com;cochoa@iwpusa.com;rparsons@iwpusa.com";

                    $message = "Hello, <br> Please click the following link to view an incoming waste water route with solids greater than 20% product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                    mail($email_recipients, $note, $message, $headers);


                }



                //if customer and carrier is IWP
                if($customer == 1 && $carrier == 1){
                    //If product is grease trap
                    if($product == 1){
                        $note = "4 Division GT Route: Entry " . $_GET['entry_id'];
                        $email_recipients = "BTorres@iwpusa.com; LCrockett@iwpusa.com;sgastelum@iwpusa.com";

                        $message = "Hello, <br> Please click the following link to view a 4 Division grease trap route product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                        mail($email_recipients, $note, $message, $headers);

                    }
                    //if product is UCO
                    if($product == 2){
                        $note = "4 Division Oil Route: Entry " . $_GET['entry_id'];
                        $email_recipients = "YTapia@iwpusa.com;LCrockett@iwpusa.com;SCano@iwpusa.com;sgastelum@iwpusa.com";
                        $message = "Hello, <br> Please click the following link to view a 4 Division Oil Route product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                        mail($email_recipients, $note, $message, $headers);


                    }

                }

                //If product is Red Diesel
                if($product == 10){
                    $note = "Red Diesel: Entry " . $_GET['entry_id'];
                    $email_recipients = "PVasquez@iwpusa.com;sgastelum@iwpusa.com";


                    $message = "Hello, <br> Please click the following link to view a Red Diesel product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                    mail($email_recipients, $note, $message, $headers);


                }

                //If carrier/customer is not IWP
                if($customer != 1 && $carrier != 1){
                    //If the product is grease trap
                    if($product == 1){
                        $note = "3W Waste Water Entry: " . $_GET['entry_id'];
                        $email_recipients = "Btorres@iwpusa.com;sgastelum@iwpusa.com";

                        $message = "Hello, <br> Please click the following link to view a Grease Trap Route product information. Not carried by IWP.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                        mail($email_recipients, $note, $message, $headers);

                    }
                }

                //if product is clear diesel
                if($product == 9){
                    $note = "Clear Diesel Entry: " . $_GET['entry_id'];
                    $email_recipients = "PVasquez@iwpusa.com;sgastelum@iwpusa.com";

                    $message = "Hello, <br> Please click the following link to view a Clear Diesel Route product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                    mail($email_recipients, $note, $message, $headers);


                }
                //if product is brown grease
                if($product == 6){
                    $note = "Incomming Brown Grease Entry: " . $_GET['entry_id'];
                    $email_recipients = "YTapia@iwpusa.com;sgastelum@iwpusa.com ";

                    $message = "Hello, <br> Please click the following link to view an incoming Brown Grease product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                    mail($email_recipients, $note, $message, $headers);

                }

                if($customer != 1 && $carrier != 1){
                    //If the product is UCO
                    if($product == 2){
                        $note = "Incoming Pumper Oil Entry: " . $_GET['entry_id'];
                        $email_recipients = "YTapia@iwpusa.com;sgastelum@iwpusa.com";

                        $message = "Hello, <br> Please click the following link to view an incoming UCO Pumper Oil product information. Not carried by IWP.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                        mail($email_recipients, $note, $message, $headers);

                    }
                }
        }

    //if outbound is checked
    if($shipping_checkbox == 1){

        //if incoming finished oil or brown grease
        if($product == 8 || $product ==6){
            if($net < 40000){
                $note = "Outgoing Load Weighing Less Than 40,000: Entry " . $_GET['entry_id'];
                $email_recipients = "sgastelum@iwpusa.com;jtrawick@iwpusa.com;cochoa@iwpusa.com;rparsons@iwpusa.com";

                $message = "Hello, <br> Please click the following link to view an outgoing load with net less than 40,000 product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

                mail($email_recipients, $note, $message, $headers);

            }
        }

        //if product is finished yellow grease
        if($product == 8){
            $note = "Outgoing Yellow Grease Entry: " . $_GET['entry_id'];
            $email_recipients = "YTapia@iwpusa.com;sgastelum@iwpusa.com";

            $message = "Hello, <br> Please click the following link to view an outgoing yellow grease load product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);
        }

        //if product is UCO
        if($product == 2){
            $note = "Outgoing Oil Entry: " . $_GET['entry_id'];
            $email_recipients = "YTapia@iwpusa.com;sgastelum@iwpusa.com;vrobbins@iwpusa.com";


            $message = "Hello, <br> Please click the following link to view an outgoing oil product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);

        }

        //if product is sludge && customer is not waste management
        if($product == 4 && $customer != 11){
            $note = "Landfill Route Entry: " . $_GET['entry_id'];
            $email_recipients = "GVillalobos@iwpusa.com;sgastelum@iwpusa.com";

            $message = "Hello, <br> Please click the following link to view a landfill sludge route product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);


        }

        //if product is brown grease
        if($product == 6){
            $note = "Outgoing Brown Grease Entry: " . $_GET['entry_id'];
            $email_recipients = "Mlefever@iwpusa.com;sgastelum@iwpusa.com;ytapia@iwpusa.com;vrobbins@iwpusa.com";

            $message = "Hello, <br> Please click the following link to view a brown grease route product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);

        }

        //if the customer is waste management and if the carrier is IWP and the produduct is sludge
        if($product == 4 && $customer == 11 && $carrier == 1){
            $note = "WM Landfill Route Entry: " . $_GET['entry_id'];
            $email_recipients = "GVillalobos@iwpusa.com;sgastelum@iwpusa.com";

            $message = "Hello, <br> Please click the following link to view a sludge Waste Managemeent product information.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);


        }

        //If customer is Waste Management and product is Trash

        if($customer == 11 && $product == 7){

            $note = "Trash Route: " . $_GET['entry_id'];
            $email_recipients = "GVillalobos@iwpusa.com;sgastelum@iwpusa.com";

            $message = "Hello, <br> Please click the following link to view a Trash Route with customer Waste Management.
                                    <br>
                                    
                                    <a href='https://inet.iwpusa.com/machforms/machform/view_entry.php?form_id=78357&entry_id=$_GET[entry_id]'>Click Here </a> ";

            mail($email_recipients, $note, $message, $headers);

        }

    }
    } else {
        echo "Entry Does Not Exist in Database";
}








}





