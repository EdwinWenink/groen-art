<? 
function bbcode($reactie) 
    { 
    $reactie = htmlspecialchars($reactie);
    
    // Enters                        V
    //$reactie = str_replace ("[br]","<br>",$reactie);
    //$reactie = str_replace ("\n","<br>",$reactie);
	//$reactie = trim(preg_replace('/\s+/', '<enter>', $reactie));
    $reactie = trim(preg_replace('/\n/', '<enter>', $reactie));
	
    // Vet, schuin, etc            V
    $reactie = preg_replace("/\[b\](.+?)\[\/b\]/is",'<strong>\1</strong>', $reactie);
    $reactie = preg_replace("/\[i\](.+?)\[\/i\]/is",'<em>\1</em>', $reactie);
    $reactie = preg_replace("/\[u\](.+?)\[\/u\]/is",'<u>\1</u>', $reactie);
    $reactie = preg_replace("/\[s\](.+?)\[\/s\]/is",'<s>\1</s>', $reactie);
    
    // Marquee
    $reactie = str_replace ("[move]", "<div align=\"center\"><marquee width=\"90%\">", $reactie);
    $reactie = str_replace ("[/move]", "</marquee></div>", $reactie);
      
    // Color, font & size        V
    $reactie = preg_replace ("#\[color=(\#[0-9A-F]{6}|[a-z\-]+)\](.*?)\[/color\]#si", "<font color=\"\\1\">\\2</font>", $reactie);
    $reactie = preg_replace ("/\[font=(.*)\](.*)\[\/font\]/", "<font face=\"$1\">$2</font>", $reactie);
    $reactie = preg_replace ("/\[size=(.*)\](.*)\[\/size\]/", "<font size=\"$1\">$2</font>", $reactie);
    
    // Email toevoegen           V
    $reactie = preg_replace("/\[email\](.*?)\[\/email\]/si", "<a href=\"mailto:\\1\">\\1</a>",$reactie);
    
    // Plaatje toevoegen           V
    $reactie = preg_replace("/\[img\](.*?)\[\/img\]/si", "<img src=\"\\1\" border=\"0\">",$reactie);
    
    // Url toevoegen           V
    $reactie = preg_replace("/\[url\](.*?)\[\/url\]/si", "<a href=\"\\1\" target=\"_blank\"><font color=\"#d0d48f\">\\1</font></a>",$reactie);

    // Diversen               V
    $reactie = str_replace ("[tt]", "<tt>", $reactie);
    $reactie = str_replace ("[/tt]", "</tt>", $reactie);
    $reactie = str_replace ("[left]", "<div align=left>", $reactie);
    $reactie = str_replace ("[/left]", "</div>", $reactie);
    $reactie = str_replace ("[center]", "<div align=\"center\">", $reactie);
    $reactie = str_replace ("[/center]", "</div>", $reactie);
    $reactie = str_replace ("[right]", "<div align=\"right\">", $reactie);
    $reactie = str_replace ("[/right]", "</div>", $reactie);
    $reactie = str_replace ("[sub]", "<sub>", $reactie);
    $reactie = str_replace ("[/sub]", "</sub>", $reactie);
    $reactie = str_replace ("[sup]", "<sup>", $reactie);
    $reactie = str_replace ("[/sup]", "</sup>", $reactie);
    $reactie = str_replace ("[fixed]", "<font face=\"Courier New\">", $reactie);
    $reactie = str_replace ("[/fixed]", "</font>", $reactie);
    $reactie = str_replace ("[[","{{",$reactie);
    $reactie = str_replace ("]]","}}",$reactie);
    $reactie = str_replace ("|","&#124;",$reactie);
    $reactie = str_replace ("[pre]","<pre>",$reactie);
    $reactie = str_replace ("[/pre]","</pre>",$reactie);
    $reactie = str_replace ("{{","[",$reactie);
    $reactie = str_replace ("}}","]",$reactie);
    
    // Horizontale lijn    V
    $reactie = str_replace ("[hr]","<hr color=\"#000000\" noshade />",$reactie);
    
    // Lijst                 V
    $reactie = str_replace ("[list]","<ul>",$reactie);
    $reactie = str_replace ("[*]","<li>",$reactie);
    $reactie = str_replace ("[/list]","</li></ul>",$reactie);
    
    // Tabel                  V
    $reactie = str_replace ("[table]","<table class=\"main\">",$reactie);
    $reactie = str_replace ("[/table]","</table>",$reactie);
    $reactie = str_replace ("[tr]","<tr>",$reactie);
    $reactie = str_replace ("[/tr]","</tr>",$reactie);
    $reactie = str_replace ("[td]","<td>",$reactie);
    $reactie = str_replace ("[/td]","</td>",$reactie);
       
    // Smiley's                V
            
        
         
         
    $reactie = str_replace ('<img src="images/smilies/tongue.png" alt="Emoticon">',':p',$reactie);
   
         
         
         
        
        
         

    $reactie = str_replace (":p","<img src=\"images/smilies/tongue.png\"  alt=\"Emoticon\">",$reactie);
    $reactie = str_replace (":(","<img src=\"images/smilies/sad.png\" alt=\"Emoticon\">", $reactie);
    $reactie = str_replace (":)","<img src=\"images/smilies/smile.png\" alt=\"Emoticon\">",$reactie);
    $reactie = str_replace (":D","<img src=\"images/smilies/laugh.png\" alt=\"Emoticon\">",$reactie);
    $reactie = str_replace (";)","<img src=\"images/smilies/wink.gif\"  alt=\"Emoticon\">",$reactie);
    $reactie = str_replace (":roll","<img src=\"images/smilies/eyeroll.gif\"  alt=\"Emoticon\">", $reactie);
//    $reactie = str_replace (":kiss","<img src=\"images/smilies/kiss.gif\"  alt=\"Emoticon\">",$reactie); 
    $reactie = str_replace (":angry","<img src=\"images/smilies/angry.png\" alt=\"Emoticon\">",$reactie);
    $reactie = str_replace (":cry","<img src=\"images/smilies/cry.gif\"  alt=\"Emoticon\">",$reactie);
// $reactie = str_replace (":huh", "<img src=\"images/smilies/huh.gif\" alt=\"Emoticon\">",$reactie);
 //   $reactie = str_replace (":omg","<img src=\"images/smilies/omg.gif\" alt=\"Emoticon\">",$reactie); 
    $reactie = str_replace (":cool","<img src=\"images/smilies/cool.png\"  alt=\"Emoticon\">",$reactie);
    
    return $reactie; 
    } 


?> 