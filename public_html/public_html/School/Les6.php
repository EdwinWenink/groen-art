<?php
/* Maak een functie "KoopAppels"
Bepaal een willekeurige prijs voor appels (code voor willekeurige prijs: rand( 0, 50 ); )
Als de prijs hoger is dan 25, echo dan dat het duur is
Als de prijs lager is dan 25, echo dan dattie goedkoop is
Voer deze functie 2 keer uit

Bonus: Als de prijs exact 25 is, echo dan niks of iets geheel anders
Voorbeeld:
Die appels zijn veels te duur!

Opdracht 2


Maak een functie waar je twee getallen in kunt stoppen
Tel die twee getallen bij elkaar op
Deel het resultaat door 3
Vermenigvuldig het met het tweede getal
Geef de uitkomst terug (géén echo binnen de functie)
Voer deze functie 2 keer uit met iedere keer andere getallen. Echo de uitkomst */
//regel 20

echo "De appel prijsvergelijker , lol <BR /><br />";

function ka(){
$prijs = rand(0, 50);
if ($prijs < 25){
echo € . $prijs . " ,dit is goedkoop";
}
else if($prijs > 25){
echo € . $prijs . " ,dit is duur";
}
else
echo € . $prijs . " ,ik weet het niet meer";
}

echo ka() . "<br />";
echo ka() . "<br />";
/*Opdracht 2
//regel 40
Maak een functie waar je twee getallen in kunt stoppen
Tel die twee getallen bij elkaar op
Deel het resultaat door 3
Vermenigvuldig het met het tweede getal
Geef de uitkomst terug (géén echo binnen de functie)
Voer deze functie 2 keer uit met iedere keer andere getallen. Echo de uitkomst */
$h = rand( 0, 8); //regel 47
$g = rand( 0, 5);

function Optellen($Een, $Twee ) {
$totaal = $Een +$Twee;
$resultaat = $totaal / 3 * $Twee; 
return $resultaat;
}
echo Optellen($h, $g) . "<br />";          
echo Optellen($h, $g);



