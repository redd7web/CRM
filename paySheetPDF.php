<?php
include "protected/global.php";
ini_set("display_errors",1);
include "plugins/phpToPDF/phpToPDF.php";
if (is_numeric($_GET['entry_id'])){

    $entry_id = mysql_escape_string($_GET['entry_id']);

    $conn = mysqli_connect("localhost", "root", "Ld98Tesn3L2sUm39",  "Inetforms");
    if ($conn-> connect_error){
        die("Connection failed:". $conn-> connect_error);
    }

    $sql = "SELECT * FROM ap_form_71789 WHERE id = '$entry_id'";

    $result = $conn-> query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['element_27_1'] == 1) {
                //Switch Statement to get Customer to be paid
                switch ($row['element_28']) {
                    case 1:
                        $customer = "Anita's Mexican Food";
                        break;
                    case 2:
                        $customer = "California Churro";
                        break;
                    case 3:
                        $customer = "Colony Products";
                        break;
                    case 4:
                        $customer = "Disneyland";
                        break;
                    case 5:
                        $customer = "Los Pericos";
                        break;
                    case 6:
                        $customer = "OSI";
                        break;
                    case 7:
                        $customer = "Snak King";
                        break;
                    case 8:
                        $customer = "Wing Hing";
                        break;
                    default:
                        $customer = "No customer Selected";
                        break;
                }

                switch ($row['element_32']) {
                    case 1:
                        $carrier = "Biotane Pumping";
                        break;
                    default:
                        $carrier = "Biotane Pumping";
                        break;
                }

                $html = "
                <!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
                <html>
                <head>
                    <title>Pay Sheet</title>
                </head>
                
                <style>
                .center {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;

                }
                body {
                    font-family: Calibri;
                }
                
                table.centering {
                    margin-left:auto; 
                    margin-right:auto;
                }
                .titles{
                    font-weight: bold;
                }
                
                </style>
                
                <body>
                    <div>
                        <img  class='center' src='https://inet.iwpusa.com/machforms/machform/img/iwp_logo.png'>
                        <h1 style=' text-align: center;'>Imperial Western Products</h1>
                        <h4 style='text-align: center;'>Incoming Fryer Oil</h4>
                    </div>
                    <div id='supplier_info'>
                    <table class='centering'align:'center;'>
                        <tr>
                            <td><b>Supplier:</b> " . $customer . "</td>
                            <td><b>IKG Decal #</b> " . $row['element_30'] . "</td>
                            <td><b>Inventory:</b> " . $row['element_31'] . "</td>
                        </tr>
                        <tr>
                            <td><b>Carrier:</b> " . $carrier . "</td>
                            <td><b>Freight Rate:</b> $" . $row['element_33'] . " </td>
                            <td><b>Delivery Date:</b> " . $row['element_34'] . "</td>
                        </tr>
                        <tr>
                            <td><br><b>Gross Vehicle Weight:</b> " . $row['element_29'] . "</td>
                            <td><br></td>
                            <td><br>Plant</td>
                        </tr>
                        <tr>
                            <td><b>Tare Vehicle Weight:</b> " . $row['element_36'] . "</td>
                        </tr>
                        <tr>
                            <td><b>Gross Oil Weight: </b>" . $row['element_37'] . "</td>
                        </tr>
                        <tr>
                            <td><br><b>MUI Total (Water & Solids):</b> " . $row['element_41'] . "%</td>
                            <td><br><b>FFA: </b> " . $row['element_40'] . "</td>
                        </tr>
                        <tr>
                            <td><b>Water Mass: </b> " . $row['element_38'] . "%</td>
                            <td><b>Solid Mass: </b> " . $row['element_39'] . "%</td>
                        </tr>
                        <tr>
                            <td><b>Water Weight: </b> " . $row['element_42'] . " Lbs</td>
                            <td><b>Solid Weight: </b> " . $row['element_43'] . " Lbs</td>
                        </tr>
                        <tr>
                            <td><b>Net Oil Minus MIU: </b> " . $row['element_44'] . " Lbs</td>
                        </tr>           
                        <tr>
                            <td><b>Shrink For MIU: </b> " . $row['element_45'] . " Lbs</td>
                        </tr>         
                        <tr>
                            <td><b>*Net Weight: </b> " . $row['element_46'] . " Lbs</td>
                        </tr>       
                        <tr>
                            <td><b>Price Per Pound: </b>$ " . $row['element_48'] . "</td>
                        </tr>        
                        <tr>
                            <td><b>Payment: </b> $" . $row['element_50'] . "</td>
                        </tr>     
                        <tr>
                            <td><b>Freight: </b> $" . $row['element_49'] . "</td>
                        </tr>   
                        <tr>
                            <td><b>Total Payment: </b> $" . $row['element_50'] . "</td>
                        </tr>

                        <tr>
                            <td><b>Filled Out By: </b> " . $row['element_54_1'] . " " . $row['element_54_2'] . "</td>
                            <td><b>Date:</b> " . $row['element_5'] . "</td>
                        </tr>
                    </table>


                            <p><b>Comments:</b> " . $row['element_53'] . "</p>

                    </div>
                </body>
                </html>
                ";
                $new_string = "Paysheet-" . $row['id'];
                $pdf_options = array(
                    "source_type" => 'html',
                    "source" => $html,
                    "action" => 'save',
                    "save_directory" => '',
                    "page_orientation" => 'portrait',
                    "file_name" => $new_string . '.pdf',
                    "page_size" => 'A4'
                );
                phptopdf($pdf_options);

                $path = $new_string . ".pdf";
                $filename = $new_string . ".pdf";

                header("Content-disposition: attachment; filename=" . $filename);
                header("Content-type: application/pdf");
                readfile($filename);

            } else {
                echo "Paysheet information has not been entered";
            }
        }
    }else {
        echo "Entry ID Not Present in Database";
    }

    $conn->close();

} else {
    echo "The Entry_ID _GET[Req_ID] is not a number, please confirm the Weight Cert is correct";
}
?>