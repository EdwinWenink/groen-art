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
include('functies2.php');
$ip = $_SERVER['REMOTE_ADDR']; 


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

<?php
if($_POST['r_aanpassen']){

$r_id=$_POST['r_id'];
$g_id = $_POST['g_id'];
//anders wordt het hele bericht ingeladen in de input, dan wordt elk bericht twee keer geladen
$query= mysql_fetch_assoc(mysql_query("SELECT bericht FROM reageren WHERE id_b='".$g_id."' AND id='".$r_id."'"));
$naam=mysql_fetch_assoc(mysql_query("SELECT auteur FROM reageren WHERE id_b='".$g_id."' AND id='".$r_id."'"));
echo "
<form method='post' name='vervangbericht' action='bericht.php'>
<input type='hidden' value='".$r_id."' name='r_id'>
<input type='hidden' value='".$g_id."' name='g_id'>
Naam: <input type='text' name='auteur' value='".$naam['auteur']."'>
<br /><br />
<textarea class='textarea' id='id' placeholder='Plaats hier uw vervangende bericht' name='bericht'  maxlength='400' autofocus>".code($query['bericht'])."</textarea>";
}

else if($_POST['b_aanpassen']){

$g_id = $_POST['g_id'];
//anders wordt het hele bericht ingeladen in de input, dan wordt elk bericht twee keer geladen
$query= mysql_fetch_assoc(mysql_query("SELECT bericht FROM gastenboek WHERE id='".$g_id."'"));
$naam=mysql_fetch_assoc(mysql_query("SELECT auteur FROM gastenboek WHERE id='".$g_id."'"));
echo "
<form method='post' name='vervangbericht' action='bericht.php'>
<input type='hidden' value='".$g_id."' name='g_id'>
Naam: <input type='text' name='auteur' value='".$naam['auteur']."'>
<br /><br />
<textarea class='textarea' id='id' placeholder='Plaats hier uw vervangende bericht' name='bericht'  maxlength='400' autofocus>".code($query['bericht'])."</textarea>";

}

else {
echo "<form method='post' name='addbericht' action='bericht.php'>
<input type='hidden' value='".$ip."' name='ip'>
<input type='hidden' value='".$_POST['id']."' name='id_bericht'>
Naam: <input type='text' name='auteur'>
<br /><br />
<textarea class='textarea' id='id' placeholder='Plaats hier uw bericht' name='bericht'  maxlength='400' autofocus></textarea>";
}
?>


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
<?php
if($_POST['r_aanpassen']){
echo "<input type='submit' value='   Inzenden   ' name='r_aanpassen'>";
}
else if($_POST['b_aanpassen']){
echo "<input type='submit' value='   Inzenden   ' name='b_aanpassen'>";
}
else{
echo "<input type='submit' value='   Inzenden   ' name='reageer'>";
}
?>
</form>




<!--<br/><br/>
<a href="bbcodes.html" target="_blank">Extra invoegmogelijkheden</a></td> </tr><br/>-->







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
                              <br>  <!-- <li  class="current"><a href="gastenboek/gastenboek.php" accesskey="R" title=""><b>R</b>eacties</a></li> -->
							  <li><a href="http://groen-art.nl/contact.php" accesskey="C" title=""><b>C</b>ontact</a></li>
			</ul>
		</div>
		
		<div>
			<h2>Exposities</h2>


<blockquote>
				<? include("expositie.html") ?>


 
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
