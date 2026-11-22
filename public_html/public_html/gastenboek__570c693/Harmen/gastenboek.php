<html>
<body>
<h2>Gastenboek</h2>
<?php
    if(!IsSet($aantal_berichten) || !IsSet($pagina_nummer)){ 
    $aantal_berichten = 25; //Stel hier het aantal berichten die per pagina moeten getoond worden in
    $pagina_nummer = 1; //Laat dit op 1 staan (er wordt steeds met de eerste pagina gestart)
    }
    require ("connectie.php");
    $query = mysql_query("SELECT * FROM gastenboek2"); //Haalt alle berichten uit het gastenboek
    $aantal = mysql_num_rows($query) or die(mysql_error()); //Telt het totaal aantal berichten
    $aantal_paginas = ceil($aantal/$aantal_berichten); //Berekent het totaal aantal pagina's
    $start = ($pagina_nummer-1)*25; //Berekent vanaf welk bericht men moet beginnen weergeven
    $selecteer = "SELECT * FROM gastenboek2 ORDER BY id DESC LIMIT ".$start.", 25"; //Selecteert de berichten die per pagina getoond worden
    $resultaat = mysql_query($selecteer) or die(mysql_error());
    if($pagina_nummer!=$aantal_paginas){
      print("<center>Dit is bericht ".($start+1)." tot en met bericht ".($start+$aantal_berichten)." van ".$aantal." berichten in totaal.</center><br>");
    }
    else{
      print("<center>Dit is bericht ".($start+1)." tot en met bericht ".$aantal." van ".$aantal." berichten in totaal.</center><br>");
    }
    while($data = mysql_fetch_array($resultaat)){
    ?>
    <table cellspacing="0" width="600" align="center">
      <tr>
        <td>
          <table cellspacing="0" width="600">
       <tr>
         <td width="450"><br><hr><b>Bericht van
                <?
                if($data['email']!=""){ print("<a href='mailto:".$data['email']."'>".$data['naam']."</a>");}
                else{print($data['naam']);}       
                ?>, geplaatst op <?print($data['datum']);?></b>
              </td>

            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="text-size:10px;"><?print(nl2br($data['bericht']));?></td>
      </tr>

    </table>
    <?
    }
    if($pagina_nummer!=1){
      $vorige = $pagina_nummer-1;
      print("<center><a href=\"gastenboek.php?pagina_nummer=".$vorige."&aantal_berichten=".$aantal_berichten."\"><< Vorige |</a>");
    }
    else{
    print("<center><br><br><font size=3><< Vorige &nbsp;</font>");
    }    for($i=1; $i<=$aantal_paginas; $i++){
          if($i==$pagina_nummer){
            print(" | ".$i." | ");
          }
          else{
            print(" <a href=\"gastenboek.php?pagina_nummer=".$i."&aantal_berichten=".$aantal_berichten."\">".$i."</a> |");
          }
        }
        if($pagina_nummer!=$aantal_paginas){
          $volgende = $pagina_nummer+1;
          print(" <a href=\"gastenboek.php?pagina_nummer=".$volgende."&aantal_berichten=".$aantal_berichten."\">Volgende >></a></center>");
        }
        else if($pagina_nummer==$aantal_paginas){
        print(" <font size=3>&nbsp; Volgende >></font></center>");
        }
        print("<br><br>");
        
		print("<center><a href=# id=\"voegtoea\">Plaats bericht</a><br><br></center>");
        
    ?>

</body>
</html>