<?php
ob_start();
require_once("login.php");
if(isset($_COOKIE['LOGIN'])){

	$allowedExts = array("jpeg", "jpg", "JPG", "pjpeg");

	function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height)
	{
		# create image from jpg only
		$source_gd_image = imagecreatefromjpeg($source_image_path);
				
		if ($source_gd_image === false) {
			return false;
		}		
		
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 90); # last number is image quality, default is 75
		
		# garbage disposal
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		
		return true;
	}
	
	# retrieve number of images, init debug text
	$xx=$_POST["aantal"];
	date_default_timezone_set('UTC+1');
	$extext=date(DATE_RFC2822)."</br>";
	
	# debugging html file
	file_put_contents('test_resize_image.php',"<?php echo 'Debugging menuutje:</br>';?>");
	
	# loop over 'aantal', opgeslagen in xx
	for ($x=1;$x<=$xx;$x++) {
		
		//for testing purposes]
		$extext.="huidige file: {$x}, aantal files: {$xx} </br>";
		
		$path = $_FILES["file_{$x}"]['name'];
		$type = $_FILES["file_{$x}"]['type'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$filesize = $_FILES["file_{$x}"]["size"];
		
		$extext.= "received full filepath: $path </br>";
		$extext.="pathinfo: $ext </br>";
		$extext.="type of file: $type </br>";
		$extext.="size of file: $filesize </br>";
		
		if ($_FILES["file_{$x}"]["error"] > 0)
		{
			$extext.= "Return Code: " . $_FILES["file_{$x}"]["error"] . "<br>";
			if($_FILES["file_{$x}"]["error"]==1){
				$extext.="Bestand is te groot, maak kleiner dan 2 Mb!</br>";
			}
		}
		
		$i=$_POST["categorie_{$x}"];
		
		//voer hier eventuele afwijkende categorie namen in
		switch($i){
			case "Dieren":
				$map="Diversedieren";
				break;
			default:
				$map=$i;
		}
		
		if ((
			($type == "image/jpeg")
			|| ($type == "image/jpg")
			|| ($type == "image/pjpeg")
			|| ($type == "image/JPG")
			)
			&& in_array($ext, $allowedExts))
		{
			$extext.= "Upload: " . $_FILES["file_{$x}"]["name"] . "<br>";
			$extext.= "Type: " . $_FILES["file_{$x}"]["type"] . "<br>";
			$extext.= "Size: " . ($_FILES["file_{$x}"]["size"] / 1024) . " kB<br>";
			$extext.= "Temp file: " . $_FILES["file_{$x}"]["tmp_name"] . "<br>";
			
			$image_groot_path=$map . "/Groot/" . $_POST["naam_{$x}"] . ".jpg";
			
			if (file_exists($image_groot_path))
			  {
			  $extext.= "De naam" . $_POST["naam_{$x}"] . "die is toegewezen aan" . $_FILES["file_{$x}"]["name"] . " bestaat al.<br/>";
			  }
			else {
				$extext.= "Stored in: " . $image_groot_path . "<br/>";
				
				# retrieve source path and sizes of source image
				$source_path=$_FILES["file_{$x}"]["tmp_name"];
				
				$size = getimagesize($_FILES["file_{$x}"]["tmp_name"]);
				$width = $size[0];
				$height = $size[1];
				
				$extext.= "breedte origineel: ".$width;
				$extext.= "<br/> hoogte origineel: ".$height;
				
				# variables that have something to do with scaling
				$nn=195; # 195px op de site, hier dit gebruikt omdat dat beter rekent en html wel rescaled voor ons?
				$rr=$nn/15; # de grootte van de border die we om de image heen willen hebben, 10% dus
				
				$thumbnail_path= $map . "/" . $_POST["naam_{$x}"] . "_thumb.jpg";
				
				# scaling
				if($width>=$height){
					# then width is the limiting factor, scale width
					if(($nn-$height*$nn/$width)<(2*$rr)){
						# then height for our scaled width does not adhere to border constraint, scale width further down.
						$thumbnail_image_height=($nn-2*$rr);
						$thumbnail_image_width=$width/$height*$thumbnail_image_height;
					}
					else {
						$thumbnail_image_width=$nn;
						$thumbnail_image_height=$height*$nn/$width;
					}
				}
				else {
					if(($nn-$width*$nn/$height)<(2*$rr)){
						$thumbnail_image_width=($nn-2*$rr);
						$thumbnail_image_height=$height/$width*$thumbnail_image_width;
					}
					else {
						$thumbnail_image_height=$nn;
						$thumbnail_image_width=$width*$nn/$height;
					}
				}
									 
				$result = generate_image_thumbnail($source_path,$thumbnail_path,$thumbnail_image_width,$thumbnail_image_height,$width,$height);
				
				move_uploaded_file($source_path,$image_groot_path);
				
				if ($result === false) {
					$extext.= '<br>An error occurred while processing upload';
				} else {
					
					$extext.= '<br>Thumbnail image saved as ' . $thumbnail_path .'<br/><hr>';
					
					$naam=$_POST["naam_{$x}"];
					$afm=$_POST["afmetingen_{$x}"];
					$vd=$_POST["verfdoek_{$x}"];
					$prijs=$_POST["prijs_{$x}"];
					if(is_numeric($prijs)){
						$prijsstring = '&euro;'.$prijs;
					} else {
						$prijsstring = $prijs;
					}
					
					$thumbnail_image_height2=$thumbnail_image_height*195/$nn;
					$thumbnail_image_width2=$thumbnail_image_width*195/$nn;
					$margin_top=($nn-$thumbnail_image_height)/2*195/$nn;
					$margin_left=($nn-$thumbnail_image_width)/2*195/$nn;
					$enter="\n";
					# text for the hardcoded div
					$add_thumb='<a href="'.$image_groot_path.'"	rel="lyteshow['.$map.']" title="Naam: '.$naam.' &#10;&#13; Afmetingen: '.$afm.'	Materialen: '.$vd.$enter.' Prijs: '.$prijsstring.'">
						<div class="upload">
						<Img style="height: '.$thumbnail_image_height2.'px; width: '.$thumbnail_image_width2.'px;position: absolute;margin-left: '.$margin_left.'px;margin-top:'.$margin_top.'px;" 
						class="upload2" src="'.$thumbnail_path.'" 
						alt="Naam: '.$naam.' &#10;&#13; Afmetingen: '.$afm.$enter.' Materialen: '.$vd.$enter.' Prijs: '.$prijsstring.'" 
						title="Naam: '.$naam.' &#10;&#13; Afmetingen: '.$afm.$enter.' Materialen: '.$vd.$enter.' Prijs: '.$prijsstring.'" >
						</div></a>';
					
					# html file in map with same name is required!
					$file_name=$map.'/'.$map.'.html';
					
					$extext.= "html file locatie/name: $file_name</br>";
					$htmlfile=file_get_contents($file_name);
					
					# schrijf weg
					file_put_contents($file_name,$add_thumb.$htmlfile, LOCK_EX);						
				}
			}
		}
		  
		else{
			$extext.= "Invalid file!</br>";
			$extext.= "Extension .".$extension." not allowed </br>";
			$extext.= "Extension given by file [type] is ".$_FILES["file_{$x}"]["type"]." </br>";
			break;
		}
		$extext.="_______________________________________________</br>";
	}
	
	$extext.= "forloop end reached! <br/>";
	$var_str = var_export($extext, true);
	$var = "<?php echo $var_str; ?>";
	file_put_contents('test_resize_image.php', $var,FILE_APPEND);
	
	while (ob_get_status()) 
	{
		ob_end_clean();
	}
	
	header( "Location: http://www.groen-art.nl/upload_image.php" );

}
?>