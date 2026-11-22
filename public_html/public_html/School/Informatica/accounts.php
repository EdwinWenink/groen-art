<html>

Welkom <?php echo $_POST["Voornaam"] . " "; 
echo $_POST["Achternaam"]; ?><br />
Ingevulde gegevens: <br /><br /><?php echo "Geboortedatum: " . $_POST["Geboortedag"] . "-";
 echo $_POST["Geboortemaand"] . "-";
 echo $_POST["Geboortejaar"] . " <br />";
 echo "Geslacht: " . $_POST["Geslacht"];