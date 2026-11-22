<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Bericht</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<script src="scripts.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="reacties.css">


</head>
<body> 
<?php



// Database gegevens includen.
include('dbconnect.php');



if($_POST['liken']) {

	$like_id = $_POST['id'];
	 $ip = $_POST['ip'];
	//kijken of er niks in de array zit, of beter gezegd de query geeft geen rijen, zo nee maak like aan
		$sql_like_ip = mysql_query("SELECT (ip) FROM reacties WHERE id LIKE '".$like_id."' ");
		if (mysql_num_rows($sql_like_ip) == 0) { 
			$insert = mysql_query("INSERT INTO reacties (ip, id) VALUES ('".$ip."','".$like_id."')");
				if($insert){
					echo "GELIKED<head><meta http-equiv='refresh' content='0; URL=\"gastenboek.php\"'></head>";
				}
				Else{
					echo "Er is iets mis gegaan bij het liken van iets wat nog niet geliked was";
				}
		}
		//als er wel iets in zit, maak dan de array aan 
		//als het huidige ip hetzelfde is als een in de array, verwijder dan die specifieke like
		else{
			while($sql_like_ip_2 = mysql_fetch_array($sql_like_ip)){
				if($sql_like_ip_2['ip'] == $ip){
				
				
					$insert = mysql_query("DELETE FROM reacties WHERE ip ='".$ip."' AND id='".$like_id."' ");
						if($insert){
							echo "GEDELIKED<head><meta http-equiv='refresh' content='0; URL=\"gastenboek.php\"'></head>";
						}
						Else{
							echo "Er is iets mis gegaan bij het deliken";
						}
				}
				//als het niet dezelde ip is als een die in de array staat, maak dan een like aan
				//FOUT?? bij het verwijderen van een like, waar meerdere likes staan aangegeven, echood hij ook deze. Geen functionaliteits gevolgen.
				elseif(in_array($ip,$sql_like_ip_2)==false){
					$insert = mysql_query("INSERT INTO reacties (ip, id) VALUES ('".$ip."','".$like_id."')");
						if($insert){
							echo "GELIKED<head><meta http-equiv='refresh' content='0; URL=\"gastenboek.php\"'></head>";
						}
						else{
							echo "Er is iets mis gegaan bij het LIKEN";
						}
				}
				//als van elseif if wordt gemaakt geeft hij 'het ging helemaal mis' wat suggereert dat if false geeft en elseif ook false(oftewel ip komt wel in de array voor)
				//maar if doet wel zijn functie en moet dus true zijn.... het is niet logisch dat elseif nog wordt uitgevoerd en dat gebeurt ook niet want dan zou het aantal
				//likes hetzelfde blijven. Lekker vaag dit weer 
				else{
				echo "het ging helemaal mis";
				}
			}
		}	
		
	}	



?>



</body>
</html> 