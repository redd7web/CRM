<?php
include "protected/global.php";
include "source/scripts.php";
ini_set("display_errors",1);

if(isset($_POST['query'])){

    $output = '';
    $query = "SELECT name, account_ID FROM iwp_accounts WHERE status IN ('active', 'new') AND name LIKE '%". $_POST['query'] . "%';";
    $result = $db->query($query);
    $output = "<ul style='width:250px;'>";
    if ($result > 0){
        foreach($result as $results) {
            $output .= "<li>" . $results['name'] . " ~ " . $results['account_ID'] . "</li>";
        }
    } else {
        $output .= "<li>No Account Found</li>";
    }
    $output .= "</ul>";
    echo $output;
}