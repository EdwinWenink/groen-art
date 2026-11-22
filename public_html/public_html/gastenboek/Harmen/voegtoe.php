<html>
<head>
<title>Bericht toevoegen</title>
// <link rel="stylesheet" href="style.css" type="text/css" media="screen" charset="utf-8" />
</head>
<body>
<h2><center>Bericht toevoegen</center></h2>
<?
if($_POST['submit']){
      if ($_POST['naam'] == ""){
      print("U hebt geen naam ingevuld, wat vereist is. Klik <a href=\"javascript:history.go(-1)\">hier</a> om terug te keren

    en uw naam in te vullen.<br>");
    }
    else if ($_POST['bericht'] == ""){
      print("U heeft geen bericht ingevuld, wat vereist is. Klik <a href=\"javascript:history.go(-1)\">hier</a> om terug te keren en uw bericht in te vullen.<br>");
    }
    else if ($_POST['url']!="" && substr($_POST['url'],0,7)!="http://"){
      print("Er zit een fout in het adres van uw homepage. Let er op dat het adres begint met \"http://\". Klik <a href=\"javascript:history.go(-1)\">hier</a> om terug te keren en dit te verbeteren.");
    }
    else{
      require ("connectie.php");
      $datum = date("d-m-Y");
      $query="INSERT INTO gastenboek2 (naam, bericht, email, url, datum) VALUES ('".strip_tags($_POST['naam'])."', '".strip_tags($_POST['bericht'])."', '".strip_tags($_POST['email'])."', '".strip_tags($_POST['url'])."','".$datum."')";
      $voegtoe=mysql_query($query) or die(mysql_error());
	  print("<center>Goed werk.<br>Klik <a id=\"teruga\" href=index.php>hier</a> om terug te gaan.</center>");
    }
    }
    else{
    ?>
    <form name="data" method="POST" action="voegtoe.php">
    <input type="hidden" name="submit" value="1">
    <table class="main" cellspacing="0" width="400" align="center">
      <tr class="light">
        <td class="main" width="100">Naam:</td>
        <td class="main" width="300"><input type="text" size="30" name="naam"></td>
      </tr>

      <tr class="dark">
        <td class="main" width="100" valign="top">Bericht:</td>
        <td class="main" width="300"><textarea rows="7" cols="30" name="bericht"></textarea></td>
      </tr>
      <tr class="title">
        <td class="main" colspan="2"><br><br>
          <center><input type="submit" value="Voeg toe">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="reset" value="Wis"> </center>
        </td>
      </tr>
    </table>
    </form>
    <?
    }
    ?>
    </body>
    </html>
