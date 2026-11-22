

<?php

$fo = fopen("gastenboek.txt", "a");

$naam = $_POST("naam");
$email = $_POST("email");
$bericht = $_POST("bericht");
$totaal = $naam + $email + $bericht;
fclose("$fo");









