<html>
<head>
	<link rel="stylesheet" href="style.css" type="text/css">
	<title>Schaatskamp Midlaren 2009</title>
	<script type="text/javascript" src="jquery-1.3.2.js"></script>
	<script type="text/javascript" src="ui.core.js"></script>
	<script type="text/javascript" src="jquery.corner.js"></script>
	<script type="text/javascript" src="pause.js"></script>
	  
	<script>
	$(document).ready(function(){

		$("div").corner("25px");
		$("#acca").click(function() {
				$("div.contie").fadeOut();
				$("#acc").slideDown("slow");
		});
		
		$("#deelnemersa").click(function() {
				$("div.contie").fadeOut();
				$("#deelnemers").slideDown("slow");
		});
		
		$("#ijsbaana").click(function() {
				$("div.contie").fadeOut();
				$("#ijsbaan").slideDown("slow");
		});
		
		$("#programmaa").click(function() {
				$("div.contie").fadeOut();
				$("#programma").slideDown("slow");
		});
		
		$("#homea").click(function() {
				$("div.contie").fadeOut();
				$("#home").slideDown("slow");
		});
		
		$("#paklijsta").click(function() {
				$("div.contie").fadeOut();
				$("#paklijst").slideDown("slow");
		});
		
		$("#inschrijfa").click(function() {
				$("div.contie").fadeOut();
				$("#inschrijf").slideDown("slow");
		});
		
		$("#gastenboeka").click(function() {
				$("div.contie").fadeOut();
				$("#gastenboek").slideDown("slow");
		});		
		
		$("#voegtoea").click(function() {
				$("div.contie").fadeOut();
				$("#voegtoe").fadeIn("slow");
		});
		
		$("#teruga").click(function() {
				$("div.contie").fadeOut();
				$("#gastenboek").fadeIn("slow");
		});

		$("#videoa").click(function() {
				$("div.contie").fadeOut();
				$("#video").fadeIn("slow");
		});		
		
	});
	
	</script>
</head>

<body>
	<div id="alles" class="text">
		<center>
				
	<!--	<img src="logo2.png"><br>
		<img src="logo.jpg"><br>
		</center>-->
		
	<!--	<div id="mennu">
			<?php include ("menu.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="home">
		<?php include ("home.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="acc">
		<?php include ("acc.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="deelnemers">
		<?php include ("deelnemers.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="ijsbaan">
		<?php include ("ijsbaan.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="programma">
		<?php include ("programma.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="inschrijf">
		<?php include ("inschrijf.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="paklijst">
		<?php include ("paklijst.html"); ?>
		</div>-->
		
	<!--	<div class="contie" id="video">
		<?php include ("video.html"); ?>
		</div> -->
		
		<div class="contie" id="gastenboek">
		<?php include ("gastenboek.php"); ?>
		</div>

		<div class="contie" id="voegtoe">
		<?php include ("voegtoe.php"); ?>
		</div>
		
	</div>
</body>
</html>