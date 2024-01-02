<?php

$k =  shell_exec("find /var/www/html/img/ -type f -iname '*.jpg' -exec jpegoptim --strip-all {} +");
$k =  shell_exec("find /var/www/html/bakery/img/ -type f -iname '*.jpg' -exec jpegoptim --strip-all {} +");
$k =  shell_exec("find /var/www/html/grease/ -type f -iname '*.jpg' -exec jpegoptim --strip-all {} +");
$k =  shell_exec("find /var/www/html/sludge/ -type f -iname '*.jpg' -exec jpegoptim --strip-all {} +");
$k =  shell_exec("find /var/www/html/machforms/machform/data/ -type f -iname '*.jpg' -exec jpegoptim --strip-all {} +");
?>