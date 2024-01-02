<?php
ini_set("display_errors",1);
$header = "From: iwppassreset@iwpusa.com\r\n";
    $header .= "Reply-To: No-reply@iwpusa.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
mail("bthomas@iwpusa.com,edizon@iwpusa.com","HVinet mail test php","Did you get this?",$header);


?>