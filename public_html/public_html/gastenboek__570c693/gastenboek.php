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

// rij kleuren
$color1 = "#908b25";
$color2 = "#4b4918";
$color3 = "#242607";
$color4 = "#e0e49f";
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
    // Is het dat niet dan wordt het een linkje
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
        $bericht = str_replace ("<enter>","<br />",$row['bericht']);
        $g_datum = $row['datum'];
        $g_auteur = $row['auteur'];
        $g_email = $row['email'];
		$g_id= $row['id'];
        $row_color = ($row_count % 2) ? $color1 : $color2;
		$text_color = ($row_count % 2) ? $color3 : $color4;
		
		
		$sql_aantal_likes = mysql_query("SELECT COUNT( 'ip' ) FROM reacties WHERE id LIKE  '".$g_id."' ");
		$rowlike = mysql_fetch_assoc($sql_aantal_likes);
		$rowlikes = $rowlike["COUNT( 'ip' )"];
			
       
		if($rowlikes=='1'){
			$likes="like";
		}
		elseif($rowlikes=='0'){
			$likes=" ";
		}
		else{
			$likes ="likes";
		}
	
		if($rowlikes=='0'){
			$rowlikess=" ";
		}
		else{
			$rowlikess=$rowlikes;
		}
	

	
        echo "<tr><td style=\"border-bottom: 1px solid Black; padding: 5px\" bgcolor=\"$row_color\">";
        echo "<b><font color=\"$text_color\">".$g_auteur."</b></font> op ".$g_datum;
		echo "<b> ".$rowlikess." ".$likes." </b><br />";
		echo "<font color=\"$text_color\">".$bericht."</font><br /><br />";
		
		echo "<form action='like.php' method='post'>
			<input type='hidden' name='id' value='".$g_id."'><input type='hidden' name='ip' value='".$ip."'><input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='liken' value='liken/de-liken'>
			</form>";
		
		echo "<form action='reageren.php' method='post'>
			<input type='hidden' name='id' value='".$g_id."'><input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='reageren' value='hierop reageren'>
			</form>";
			
		$res_ip = mysql_query("SELECT (ip) FROM gastenboek WHERE id LIKE '".$g_id."' ");		
						while($res_ip_2 = mysql_fetch_array($res_ip)){
							if($res_ip_2['ip'] == $ip OR $ip=='128.127.35.186' OR $ip=='192.168.0.109'){	
			
								echo "<form action='bericht.php' method='post'>
									<input type='hidden' name='g_id' value='".$g_id."'><input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='DELETE' value='bericht en alle reacties verwijderen'>
									</form>";	
									
								echo "<form action='reageren.php' method='post'>
								<input type='hidden' name='g_id' value='".$g_id."'>
								<input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='b_aanpassen' value='bericht aanpassen'>
								</form>";	
							}
						}
			
			
			$sql_reageer = "SELECT * FROM reageren WHERE id_b LIKE '".$g_id."' ORDER BY id ASC ";
			$res_reageer = mysql_query($sql_reageer);
			if (!$res_reageer) { 
				die('Fout in de query: ' . mysql_error());
				}
				
			if(mysql_num_rows($res_reageer) >= 1){
				
				echo "<br/><b><i>Reacties:</i></b><br/>";
				while($r_row = mysql_fetch_array($res_reageer)) {
				echo "<br /><table width=\"490\" cellpadding=\"0\" cellspacing=\"0\">";
					$r_bericht = str_replace ("<enter>","<br />",$r_row['bericht']);
					$r_datum = $r_row['datum'];
					$r_auteur = $r_row['auteur'];
					$r_id= $r_row['id'];
					echo "<tr><td style=\"border-top: 1px solid Black; border-left: 1px solid Black; padding: 5px\" bgcolor=\"$row_color\">";
					echo "<b><font color=\"$text_color\">".$r_auteur."</b></font> op ".$r_datum;
					echo "<font color=\"$text_color\"><br />".$r_bericht."</font><br /><br />";
					
					$sql_ip = mysql_query("SELECT (ip) FROM reageren WHERE id_b LIKE '".$g_id."' AND id LIKE '".$r_id."' ");		
						while($sql_ip_2 = mysql_fetch_array($sql_ip)){
							if($sql_ip_2['ip'] == $ip OR $ip=='128.127.35.186' OR $ip=='192.168.0.109'){
								echo "<form action='bericht.php' method='post'>
								<input type='hidden' name='r_id' value='".$r_id."'><input type='hidden' name='g_id' value='".$g_id."'>
								<input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='deleten' value='reactie verwijderen'>
								</form>";
								
								echo "<form action='reageren.php' method='post'>
								<input type='hidden' name='r_id' value='".$r_id."'><input type='hidden' name='g_id' value='".$g_id."'>
								<input onMouseover=this.style.cursor='pointer'  style=\"background: $row_color\" type='submit' name='r_aanpassen' value='reactie aanpassen'>
								</form>";
							}
						}
					echo "</td></tr>";
				echo "</table>";	
					
				}
			}	
		echo "</td></tr>";
	
        $row_count++;
    }
    echo "</table></table>";
} 
else {
    echo "Er zijn geen berichten in het gastenboek. <br /><br />";
}

// Laat het formulier zien.

?>





<script>
function wissel(knop1,tekst1,knop2,tekst2) {
    var oldimage = document.getElementById(knop1).src;
	if (oldimage.indexOf(knop2) >= 0) {
	   document.getElementById(knop1).src = "images/knoppen/"+knop1+".jpg";
	   addtext('id',tekst2);
	} else {
	   document.getElementById(knop1).src = "images/knoppen/"+knop2+".jpg";
	   addtext('id',tekst1)
	}
}


function addtext(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
    	"ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	range.moveStart ('character', strPos);
    	range.moveEnd ('character', 0);
    	range.select();
    }
    else if (br == "ff") {
    	txtarea.selectionStart = strPos;
    	txtarea.selectionEnd = strPos;
    	txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

</script>

<br />

<form method="post" name="addbericht" action="bericht.php">
<input type="hidden" value="<?php echo "".$ip."" ?>" name="ip">
Naam: <input type="text" name="auteur">
Email*:<input type="text" name="email"><br /><br />


<textarea class="textarea" id="id" placeholder="Plaats hier uw bericht!" name="bericht"  maxlength="400" autofocus></textarea>
<br />

<img id="B" style="margin: -2px"  onMouseover="this.style.cursor='pointer'" onClick="wissel('B','[b]','B2','[/b]')" src="images/knoppen/B.jpg" alt="Dik"  />
<img id="I" style="margin: -2px"  onMouseover="this.style.cursor='pointer'" onClick="wissel('I','[i]','I2','[/i]')" src="images/knoppen/I.jpg" alt="Schuin">
<img id="U" style="margin: -2px"  onMouseover="this.style.cursor='pointer'" onClick="wissel('U','[u]','U2','[/u]')" src="images/knoppen/U.jpg" alt="Onderstreept">
<img id="abc-" style="margin: -2px"  onMouseover="this.style.cursor='pointer'" onClick="wissel('abc-','[s]','abc-2','[/s]')" src="images/knoppen/abc-.jpg" alt="Doorstreept">

<br />

<!-- Smileys -->

<img style="margin: 1px; margin-left: 0px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :) ')" src="images/smilies/smile.png" alt="Emoticon">
<img style="margin: 1px"  onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :D ')" src="images/smilies/laugh.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :p ')" src="images/smilies/tongue.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :( ')" src="images/smilies/sad.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' ;) ')" src="images/smilies/wink.gif" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :angry ')" src="images/smilies/angry.png" alt="Emoticon">
<img style="margin: 1px; margin-left: 0px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :roll ')" src="images/smilies/eyeroll.gif" alt="Emoticon">
<!--<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',':kiss')" src="images/smilies/kiss.gif" alt="Emoticon">-->
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :cool ')" src="images/smilies/cool.png" alt="Emoticon">
<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' :cry ')" src="images/smilies/cry.gif" alt="Emoticon">
<!--<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext(':huh')" src="images/smilies/huh.gif" alt="Emoticon">-->
<!--<img style="margin: 1px" onMouseover="this.style.cursor='pointer'" onClick="addtext(':omg')" src="images/smilies/omg.gif" alt="Emoticon"><br /><br /> -->
<br /> </table>
<a style="margin: 1px; margin-left: 0px" onMouseover="this.style.cursor='pointer'" onClick="addtext('id',' [url] http://www. [/url] ')"> Link toevoegen </a> <br/>


<br/>

<input type="submit" value="   Inzenden   " name="submit">


</form>


<br />


<!--<br/><br/>
<a href="bbcodes.html" target="_blank">Extra invoegmogelijkheden</a></td> </tr><br/>-->
<br><br> *Optioneel. Uw email is alleen toegankelijk voor de beheerder. 






		</div>	
		</div>

		


		</center>
	</div>
	<!-- end #content -->
	<div id="sidebar">


		<div id="menu">
			<ul>
				<li><a href="http://groen-art.nl/index.php" accesskey="T" title=""><b>T</b>huispagina</a></li>
				<li><a href="http://groen-art.nl/paarden.php" accesskey="p" title=""><b>P</b>aarden</a></li>
				<li><a href="http://groen-art.nl/kikkers.php" accesskey="k" title=""><b>K</b>ikkers</a></li>
				<li><a href="http://groen-art.nl/portretten.php" accesskey="p" title=""><b>P</b>ortretten</a></li>
				<li><a href="http://groen-art.nl/vormen.php" accesskey="V" title=""><b>V</b>ormen</a></li>
				<li><a href="http://groen-art.nl/mysterie.php" accesskey="M" title=""><b>M</b>ysterie</a></li>
                                <li><a href="http://groen-art.nl/natuur.php" accesskey="N" title=""><b>N</b>atuur</a></li>
                                <li><a href="http://groen-art.nl/collages.php" accesskey="C" title=""><b>C</b>ollages</a></li>
                                <li><a href="http://groen-art.nl/ddieren.php" accesskey="D" title=""><b>D</b>iverse Dieren</a></li>
                                <li><a href="http://groen-art.nl/diversen.php" accesskey="D" title=""><b>D</b>iversen</a></li>
                              <br> <li class="current"><a href="gastenboek/gastenboek.php" accesskey="R" title=""><b>G</b>astenboek</a></li>
							  <li><a href="http://groen-art.nl/contact.php" accesskey="C" title=""><b>C</b>ontact</a></li>
			</ul>
		</div>
		
		<div>
			<h2>Exposities</h2>


<blockquote>
				<? include("expositie.html") ?>
<?php /*
mysql_connect("localhost","dcbysxzi_Robert","Lowie");
mysql_select_db("expositie"); 
$commando="SELECT * FROM `expositie`";
$resultaat=mysql_query($commando);
$array=mysql_fetch_array($resultaat);

echo "<b> ". $array['datum'] ." </b><br/>";

echo "". $array['tijd'] . "";

*/ ?> 

 
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