<? 
function code($reactie) 
    { 
   
    
    // Enters                        V
    
    //$reactie = str_replace ("/n","<br>",$reactie);
	//$reactie = trim(preg_replace('/\s+/', '<enter>', $reactie));
	$reactie = str_replace ("<enter>","\n",$reactie);
    
    // Vet, schuin, etc            V
    $reactie = preg_replace("/\<strong\>(.+?)\<\/strong\>/is",'[b]\1[/b]', $reactie);
    $reactie = preg_replace("/\<em\>(.+?)\<\/em\>/is",'[i]\1[/i]', $reactie);
    $reactie = preg_replace("/\<u\>(.+?)\<\/u\>/is",'[u]\1[/u]', $reactie);
    $reactie = preg_replace("/\<s\>(.+?)\<\/s\>/is",'[s]\1[/s]', $reactie);
    
    
       
    // Smiley's                V
            
        
         
         
    $reactie = str_replace ('<img src="images/smilies/smile.png" alt="Emoticon">',':)',$reactie);
    $reactie = str_replace ('<img src="images/smilies/laugh.png" alt="Emoticon">',':D',$reactie);
	$reactie = str_replace ('<img src="images/smilies/tongue.png"  alt="Emoticon">',':p',$reactie);
	$reactie = str_replace ('<img src="images/smilies/sad.png" alt="Emoticon">',':(',$reactie);
	$reactie = str_replace ('<img src="images/smilies/wink.gif"  alt="Emoticon">',';)',$reactie);
	$reactie = str_replace ('<img src="images/smilies/angry.png" alt="Emoticon">',':angry',$reactie);
	$reactie = str_replace ('<img src="images/smilies/eyeroll.gif"  alt="Emoticon">',':roll',$reactie);
	$reactie = str_replace ('<img src="images/smilies/cool.png"  alt="Emoticon">',':cool',$reactie);
	$reactie = str_replace ('<img src="images/smilies/cry.gif"  alt="Emoticon">',':cry',$reactie);
         
         
         

    
    return $reactie; 
    } 


?> 