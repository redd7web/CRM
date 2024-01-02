<?php
include "protected/global.php";


 $db->query("INSERT INTO iwp_list_of_utility2 SELECT * FROM iwp_list_of_utility WHERE completed_date < DATE_SUB(NOW(),INTERVAL 1 YEAR) AND completed_date !='0000-00-00'");

?>