<?php

$tekst = "je moeder";
$start = ord('a');

for($j = 0; $j<26; $j++){
$letter = 0;
	for{$i= 0; $i=strlen($tekst); $i++){
		$nu = $start + $j;
			if(ord($tekst[$i] == $nu))
			{ $letter +=1 }
	}
	echo chr($nu) + $nu;
}

?>	
		
		
		