<?php require_once("login.php"); ?>
<!DOCTYPE html>
<html>
<HEAD>
<TITLE>Nieuwe Schilderijen uploaden</TITLE>

</HEAD>
<body onload="add()">

<form action="resize_image.php" method="post" enctype="multipart/form-data">

<div id="fooBar"></div>

<script>
var aantal=0;
function add() {
	aantal += 1;
	
    var element ='<div id="entry" style="width:280px;border-style:solid;border-width:2px;">\
	<label for="file_'+aantal+'">File:</label><input type="file" name="file_'+aantal+'" id="file_'+aantal+'"><br>\
	<label for="categorie_'+aantal+'">Categorie:</label><input list="categorie" name="categorie_'+aantal+'" id="categorie_'+aantal+'">\
			<datalist id="categorie">  \
			<option value="Natuur">  \
			<option value="Dieren">  \
			<option value="Kikkers">  \
			<option value="Vormen">  \
			<option value="Mysterie">  \
			<option value="Skylines">  \
			<option value="Collages"> \
			<option value="Beweging"> \
			<option value="Portretten">  \
			<option value="Paarden">  \
			<option value="Diversen">  \
		</datalist><br>\
	<label for="naam_'+aantal+'">Naam:</label><input type="text" name="naam_'+aantal+'" id="naam_'+aantal+'"><br>\
	<label for="afmetingen_'+aantal+'">Afmetingen:</label><input type="text" name="afmetingen_'+aantal+'" id="afmetingen_'+aantal+'"><br>\
	<label for="verfdoek_'+aantal+'">Verf en doek soort:</label><input list="verfdoek" name="verfdoek_'+aantal+'" id="verfdoek_'+aantal+'">\
	<datalist id="verfdoek"> \
		<option value="Acryl op doek">	\
		<option value="Acryl op papier"> \
		<option value="Olie op papier"> \
		<option value="Olie op doek"> \
	</datalist><br> \
	<label for="prijs_'+aantal+'">Prijs in €:</label> \
	<input type="text" name="prijs_'+aantal+'" id="prijs_'+aantal+'"> \
	</div><br/>';
																																																																																																																																																																																																																									
 document.getElementById("fooBar").innerHTML += element;
 document.getElementById("hidden").setAttribute("value",aantal);
}
</script>

<input type="button" value="Nog een foto!" onclick="add()"/>
<input type="hidden" name="aantal" value="0" id="hidden">
<input type="submit" name="submit" value="Zenden en verwerken!">
<br><br>
<a href="?logout=1">Of uitloggen?</a>
<br><br>
<a href="/test_resize_image.php" target=”_blank”>Debugfile checken?</a>


</form>

</body>
</html>