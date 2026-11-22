    <?
    //Hier de 4 variabelen invullen die je van je provider gekregen hebt
    $dbserver="localhost"; //De server waarop je database draait, meestal "localhost"
    $dbusername="dcbysxzi_Robert"; //De username die je nodig hebt om connectie te maken met je database
    $dbpassword="Lowie"; //Het password dat je nodig hebt om connectie te maken met je database
    $db="dcbysxzi_Groen-art"; //De database waarin alle data bewaard wordt.

    //Hieronder niets wijzigen
    $link = mysql_pconnect($dbserver, $dbusername, $dbpassword) or die("Er kan geen verbinding gemaakt worden met de database.");
    mysql_select_db($db) or die("De database kan niet geselecteerd worden.");
    ?>
