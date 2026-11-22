<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><meta http-equiv="content-type" content="text/html; charset=ISO 8859-1" />






<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Welkom op Groen-art.nl</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="reacties.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="logo">
	<h1><a href="#">Marjo Groen</a></h1>
	<h2><a href="#">Natuurlijke kunst!</a></h2>
</div>
<div id="page">
	<div id="content">
		<div id="welcome">
			<h1 class="title"><font color="#FFFFFF">Welkom op Groen-art.nl!</font></h1>
		
	<div class="content">
<center>
		
<?php

// Database gegevens includen.
include('dbconnect.php');

$ip = $_SERVER['REMOTE_ADDR']; 

// Alternating row kleuren.
$color1 = "#908b25";
$color2 = "#4b4918";
$row_count = 0; 

// Het indelen in pagina's.
$max_b = "10";
$result = mysql_query("SELECT COUNT(id) FROM gastenboek");
$aantal = mysql_result($result, 0);
$paginas = ceil($aantal/$max_b);

// Als p ingesteld is, stel dan start waarde in.
if(isset($_GET['p'])) {
    // Kijken of p nummeriek is.
    if(is_numeric($_GET['p'])) {
       $page = $_GET['p'];
      $start = addslashes(($_GET['p']-1)*$max_b);
    }
    else {
        $page = 1;
        $start = 0;
    }
}
else {
    $page = 1;
    $start = 0;
}

// Pagina links maken.
$p = "";
for($a = 1; $a <= $paginas; $a++)  {
    // Kijken of dit de huidige pagina is
    if($page == $a) {
        $p .= $a.' ';
    }
    // Is het dat niet dan word het een linkje
    else {
        $p .= '<a href="gastenboek.php?p='.$a.'">'.$a.'</a> ';
    }
}

// Haal de berichten op.
$sql_g = "SELECT * FROM gastenboek ORDER BY datum DESC LIMIT ".$start." , ".$max_b."";
$res_g = mysql_query($sql_g);

if($aantal <= $max_b) {
;
}
else { 
echo "".$p."";
}
// Laat alle berichten zien.
if (mysql_num_rows($res_g) >= 1) {
    echo "<table width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
    while ($row = mysql_fetch_array($res_g)) {
        $bericht = $row['bericht'];
        $g_datum = $row['datum'];
        $g_auteur = $row['auteur'];
        $g_email = $row['email'];
        $row_color = ($row_count % 2) ? $color1 : $color2;
        

        // Als er geen emailadres is, dan word er geen link gemaakt.
        if(empty($g_email)){
            $auteurmail = "".$g_auteur."";
        } 
        else {
             $auteurmail = "".$g_auteur."";
        }
        // Het bericht.
        echo "<tr><td style=\"border-bottom: 1px solid Black; padding: 5px\" bgcolor=\"$row_color\">";
        echo "<b>".$auteurmail."</b> op ".$g_datum."<br />";
        echo "".$bericht."<br /></td></tr>";

        $row_count++;
    }
    echo "</table>";
} 
else {
    echo "Er zijn geen berichten in het gastenboek. <br /><br />";
}

// Laat het formulier zien.

?>




<br /><form method="post" name="addbericht" action="bericht.php">
<input type="hidden" value="<?php echo "".$ip."" ?>" name="ip">
Naam: <input type="text" name="auteur">
Email:<input type="text" name="email"><br /><br />
Bericht:<br />






<textarea rows="10" name="bericht" cols="81"></textarea>

<img  style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[b][/b]')" src="images/knoppen/B.jpg" alt="Dik">
<img  style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[i][/i]')" src="images/knoppen/I.jpg" alt="Schuin">
<img  style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[u][/u]')" src="images/knoppen/U.jpg" alt="Onderstreept">
<img  style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[s][/s]')" src="images/knoppen/abc-.jpg" alt="Doorstreept">
<br />
<img style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[/b]')" src="images/knoppen/B2.jpg" alt="DikOngedaan">
<img style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[/i]')" src="images/knoppen/I2.jpg" alt="SchuinOngedaan">
<img style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[/u]')" src="images/knoppen/U2.jpg" alt="OnderstreeptOngedaan">
<img style="margin: 0px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, '[/s]')" src="images/knoppen/abc-2.jpg" alt="DoorstreeptOngedaan">


<br />


<img style="margin: 1px; margin-left: 0px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':)')" src="images/smilies/smile.png" alt="Emoticon">
<img style="margin: 1px"  onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.content, ':D')" src="images/smilies/laugh.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':p')" src="images/smilies/tongue.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':(')" src="images/smilies/sad.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ';)')" src="images/smilies/wink.gif" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':angry')" src="images/smilies/angry.png" alt="Emoticon">
<img style="margin: 1px; margin-left: 0px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':roll')" src="images/smilies/eyeroll.gif" alt="Emoticon">
// <img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':kiss')" src="images/smilies/kiss.gif" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':cool')" src="images/smilies/cool.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':cry')" src="images/smilies/cry.gif" alt="Emoticon">
// <img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':huh')" src="images/smilies/huh.gif" alt="Emoticon">
//<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="sendtext(document.addbericht.bericht, ':omg')" src="images/smilies/omg.gif" alt="Emoticon"><br /><br /> 
<br /> </table>
-->



<BR>

<a href="bbcodes.html" target="_blank">Extra`s zoals smilies en teksttoepassingen</a></td> </tr><br /><BR>
<input type="submit" value=" Verzenden " name="submit">
<br><br> De email is alleen voor de beheerder zichtbaar; deze hoeft ook alleen maar worden ingevuld wanneer u reactie wilt.



</form>

<BR><BR><BR><BR>
<H1> Dit gastenboek is tijdelijk buiten werking. </H1> <BR><BR><BR><BR>
		</div>	
		</div>

		


		</center>
	</div>
	<!-- end #content -->
	<div id="sidebar">
<?php include"Menu.html"; ?>
		<div>
			<h2>Exposities</h2>


<blockquote>
				<? include("expositie.html") ?>
<!--
<?php 
mysql_connect("localhost","dcbysxzi_Robert","Lowie");
mysql_select_db("expositie"); 
$commando="SELECT * FROM `expositie`";
$resultaat=mysql_query($commando);
$array=mysql_fetch_array($resultaat);

echo "<b> ". $array['datum'] ." </b><br/>";

echo "". $array['tijd'] . "";

?> -->

 
			</blockquote>
		</div>
	</div>
	<!-- end #sidebar -->
	<div id="extra" style="clear: both; height: 1px;"></div>
</div>
<!-- end #page -->
<div id="footer">
	
	<p class="legal">&copy; Robert Wenink</p>
</div>
</div>
</body>
</html>
