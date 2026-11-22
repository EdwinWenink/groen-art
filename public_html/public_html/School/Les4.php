<?php
$welke = rand(0,3);
$fruit = array( "appels" , "peren", "bananen" , "sinaasappels");
$leeftijd = array( "Jaap" => 10, "henk" => 122, "Robert" => 15, "Edwin" => 17, "Kristel" => 14 );
$klant = array("Jaap","henk","Robert","Edwin","Kristel");
$prijs = array( "appels" => 1000, "peren" => 0.75 , "bananen" =>30 , "sinaasappels" => 1);




echo "de prijs van " . $fruit[$welke] . " is €" . $prijs[$fruit[$welke]] . " voor een mens van " . $leeftijd[$klant[$welke]] . " jaar oud";
?>
