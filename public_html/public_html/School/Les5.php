<?php

/*Maak een array "auto's" en vul die met auto's
Maak daarbij een array "prijzen" en vul die met de prijzen van de auto's
Laat met een for alle auto's met de daarbij horende prijs zien
Voorbeeld:
Volkswagen €1000 Fiat Multipla €-200 Jeep €300 Landrover €3000

Opdracht 2

Zet met een while de getallen 1 tot en met 100 op het scherm
Maak de tafel van 10 dikgedrukt
Maak de tafel van 4 schuingedrukt

Bonus: Maak een getal dat zowel in de tafel van 4 als de tafel van 10 zit schuin èn dikgedrukt
Zo kijk je of iets in de tafel van 10 zit:
if( $Getal % 10 == 0 )

Zo kijk je of iets in de tafel van 4 zit:
if( $Getal % 4 == 0 ) */



$autos = array("Volkswagen", "Fiat", "Jeep", "Landrover");
$prijs = array("€1000","€-200","€300", "€3000");

for( $i = 0; $i < count($autos); $i ++) {
echo $autos[$i] . " " . $prijs[$i] . "<br />" ;
}




$getal = 0;
while( $getal <= 100 ){ 
if($getal % 20 == 0){
echo "<b><i>" . $getal . "</i></b><br />";
$getal ++;
}
else if( $getal % 10 == 0 ){
echo "<b>" . $getal . "</b><br />";
$getal ++;
}
else if( $getal % 4 == 0 ){
echo"<i><u>" . $getal . "</u></i><br />";
$getal ++;
}
else {
echo $getal . "<br />";
$getal ++; 
}
}





?>
