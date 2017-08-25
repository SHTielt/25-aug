<?php

function createThumbnail( $fname, $thumbWidth )
{
  $pathToImages = '../view/fotouploads/';
  $pathToThumbs = '../view/fotouploads/thumbs/';
  // open the directory
  $dir = opendir( $pathToImages );

  // parse path for the extension
  $info = pathinfo($pathToImages . $fname);
  
  print_r($info);
  
  $extension = pathinfo($pathToImages . $fname, PATHINFO_EXTENSION);
  echo "extension: ".$extension;
 
  
  switch ($extension) {
      case ($extension == 'jpg' || $extension == 'jpeg'):
         
  			echo "Creating thumbnail for {$fname} <br />";

  			// load image and get image size
  			$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
  			$width = imagesx( $img );
  			$height = imagesy( $img );

  			// calculate thumbnail size
  			$new_width = $thumbWidth;
  			$new_height = floor( $height * ( $thumbWidth / $width ) );

  			// create a new temporary image
  			$tmp_img = imagecreatetruecolor( $new_width, $new_height );

  			// copy and resize old image into new image
  			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

  			// save thumbnail into a file
  			imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
  
  			// close the directory
  			closedir( $dir );
                            
          break;
      
      case 'gif':
          	echo "Creating thumbnail for {$fname} <br />";

  			// load image and get image size
  			$img = imagecreatefromgif( "{$pathToImages}{$fname}" );
  			$width = imagesx( $img );
  			$height = imagesy( $img );

  			// calculate thumbnail size
  			$new_width = $thumbWidth;
  			$new_height = floor( $height * ( $thumbWidth / $width ) );

  			// create a new temporary image
  			$tmp_img = imagecreatetruecolor( $new_width, $new_height );

  			// copy and resize old image into new image
  			imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

  			// save thumbnail into a file
  			imagegif( $tmp_img, "{$pathToThumbs}{$fname}" );
  
  			// close the directory
  			closedir( $dir );
   
          break;
      
	  case 'png':
          echo "Creating thumbnail for {$fname} <br />";

  		// load image and get image size
  		$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
  		$width = imagesx( $img );
  		$height = imagesy( $img );

  		// calculate thumbnail size
  		$new_width = $thumbWidth;
  		$new_height = floor( $height * ( $thumbWidth / $width ) );

  		//1. create a new temporary image
  		$tmp_img = imagecreatetruecolor( $new_width, $new_height );
  		//imagecreatetruecolor returns an image identifier representing a black image of the specified size
  		//more functions are needed for png
  		//1. kleur genereren
  		$white = imagecolorallocate($tmp_img, 100, 100, 100);
  		//2. background van image wijzigen
  		imagefill($tmp_img,0,0,$white);
		//imagecolortransparent($tmp_img, $white);
		var_dump($tmp_img);
		//exit;
  		// copy and resize old image into new image
  		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );//nothing to do with colors
  		//imagecopy($tmp_img, $img, 0, 0, 0, 0, $width, $height);

  		// save thumbnail into a file
  		imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );
  
  		// close the directory
  		closedir( $dir );
   
          break;
		  
      default:
          
          break;
  }
  
   
  
}



?>


