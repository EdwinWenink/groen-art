<? 
//bericht dat de gebannede IPs moeten krijgen: 
$msg_ban = "Jouw IP-adres is gebanned! Je kunt geen bericht in het gastenboek plaatsen."; 

//vul hieronder de IPs in die je wilt bannen 
$ipadr[0] = "188.92.76.233"; 
$ipadr[1] = "212.117.187.100"; 
$ipadr[2] = "94.142.131.178"; 
$ipadr[3] = "92.241.154.38"; 
$ipadr[4] = "193.105.210.174"; 
$ipadr[6] = "213.5.71.85"; 
$ipadr[7] = "174.36.42.124";
$ipadr[8] = "212.117.164.64";
$ipadr[9] = "94.102.52.87";
$ipadr[10] = "82.223.163.137";
$ipadr[11] = "213.5.71.86";
$ipadr[12] = "91.214.45.223";
$ipadr[13] = "66.245.21.165";
$ipadr[14] = "89.149.202.119";
$ipadr[15] = "221.130.17.20";
$ipadr[16] = "94.76.232.196";
$ipadr[17] = "193.84.77.90";
$ipadr[18] = "";
$ipadr[19] = "";
$ipadr[20] = "";
$ipadr[21] = "";

//je kunt bijv een nieuwe toevoegen door het volgende te doen: 
//$ipadr[3] = "ipadreshier"; 

$aantal = count($ipadr); 
$ipuser = $_SERVER['REMOTE_ADDR']; 

for($i=0; $i<=$aantal; $i++) 
{ 
    if($ipuser == "$ipadr[$i]") 
    { 
        echo "$msg_ban"; 
        exit; 
    } 
} 
?>