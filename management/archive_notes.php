<?php
include "protected/global.php";
echo "<ul>";
for($i=2015;$i++;$i<date("Y")){
    echo "<li><a href='archive_notes.php?year=$i'>$i</a></li>";
}
echo "</ul>";

?>