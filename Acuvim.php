<?php
function inverse($x) {
    if (!$x) {
        throw new Exception('Division by zero.');
    }
    return $x;
}

foreach($_POST as $name=>$value){
    try {
        echo 'post name: '.$name.inverse($value) . "\n";
    } catch (Exception $e) {
        echo 'post name: '.$name.'Caught exception:: ',  $e->getMessage(), "\n";
    } 
}



?>