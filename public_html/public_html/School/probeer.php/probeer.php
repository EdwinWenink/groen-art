<?php
$h = "h.txt";
$hallo = fopen($h , 'w') or die("kan niet openen");
$henk = "hallo";
fwrite($hallo, $henk);
fclose($hallo);
http://www.tizag.com/phpT/filewrite.php