<?
function  image_valid($type)
{
    $file_types  = array(   
    'image/pjpeg'     => 'jpg', 
    'image/jpeg'     => 'jpg',
    'image/jpeg'     => 'jpeg',
    'image/gif'     => 'gif',
    'image/X-PNG'    => 'png', 
    'image/PNG'         => 'png', 
    'image/png'     => 'png', 
    'image/x-png'     => 'png', 
    'image/JPG'     => 'jpg',
    'image/GIF'     => 'gif',
    'image/bmp'     => 'bmp',
    'image/bmp'     => 'BMP',
    );
    
    if(array_key_exists($type, $file_types))
    {
       return $file_types[$type];
    }else
	{
		return "";
	}
}



function do_crop($filename,$width,$height,$x1,$y1,$quality=90)
{
	$info = getimagesize($filename);
	
	$image= $filename;
	$dest_image = $filename;
	$img = imagecreatetruecolor($width,$height);
	
	switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $org_img = imagecreatefromgif($image);
      break;
      case IMAGETYPE_JPEG:
        $org_img = imagecreatefromjpeg($image);
      break;
      case IMAGETYPE_PNG:
        $org_img = imagecreatefrompng($image);
      break;
	  default:
	  	return false;
	}
	  
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($org_img);
 
      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {
 
        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($org_img, $trnprt_indx);
 
        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($img, 0, 0, $trnprt_indx);
 
        // Set the background color for new image to transparent
        imagecolortransparent($img, $trnprt_indx);
 
 
      } 
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {
 
        // Turn off transparency blending (temporarily)
        imagealphablending($img, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($img, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($img, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($img, true);
      }
    }
	
	imagecopy($img,$org_img, 0, 0, $x1, $y1, $width, $height);
	

	switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($img,$dest_image);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($img,$dest_image,$quality);
      break;
      case IMAGETYPE_PNG:
        $image = imagepng($img,$dest_image);
      break;
      
    }
 
 	imagedestroy($img);
}

function set_size($image,$target)
{
	if (file_exists($image)) {
        $image = getimagesize($image);
        if ($image[0] > $image[1])
        {
                $percent = $target / $image[0];
        }
        else 
        {
                $percent = $target / $image[1];
        }
        $w = round($image[0] * $percent);
        $h = round($image[1] * $percent);
        $htmlWH = "width=\"" . $w . "\" height=\"" . $h . "\"";
        return $htmlWH;
	}	
}

function do_resize($filename,$width,$height,$quality)
{
	$newfilename=$filename;
	//$width = 873;
	//$height = 472;
//	header('Content-type: image/jpeg');
	list($width_orig, $height_orig) = getimagesize($filename);
	
	if ($width && ($width_orig < $height_orig)) {
		$width = ($height / $height_orig) * $width_orig;
	} else {
	//	$height = ($width / $width_orig) * $height_orig;
	}
	
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	imagejpeg ( $image_p , $newfilename , $quality );

}

function do_resize1($filename,$width,$height,$quality)
{
// Max height and width
$max_width = $width;
$max_height = $height;

   //header("Content-type: image/jpeg");
   
   $size = getimagesize($filename); // Read the size
         $width = $size[0];
         $height = $size[1];
         

         // Proportionally resize the image to the
         // max sizes specified above
         
         $x_ratio = $max_width / $width;
         $y_ratio = $max_height / $height;

         if( ($width <= $max_width) && ($height <= $max_height) )
         {
               $tn_width = $width;
               $tn_height = $height;
         }
         elseif (($x_ratio * $height) < $max_height)
         {
               $tn_height = ceil($x_ratio * $height);
               $tn_width = $max_width;
         }
         else
         {
               $tn_width = ceil($y_ratio * $width);
               $tn_height = $max_height;
         }
     // Increase memory limit to support larger files

     ini_set('memory_limit', '128M');
     
     // Create the new image!
     $src = imagecreatefromjpeg($filename);
     $dst = imagecreatetruecolor($tn_width, $tn_height);
    // imagecopyresized($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
    // imagejpeg($dst);
	 imagejpeg ($dst , $filename , $quality);

}

//---------------------------------

function do_resizeToMaxHeight($filename,$max_width,$max_height,$quality)
{

//header("Content-type: image/jpeg");
$size = getimagesize($filename); // Read the size
$width = $size[0];
$height = $size[1];

if($width <=$height)
{

	$y_ratio = $max_height / $height;	 
	
	$new_h=$max_height;
	$new_w=$width*$y_ratio;

	//echo($width);
 	// Create the new image!
     $src = imagecreatefromjpeg($filename);
     $dst = imagecreatetruecolor($new_w, $new_h);
	 $dst = imagecreatetruecolor($max_width, $new_h);
	 
	 $dst_x = $max_width/2-$new_w/2;
	// imagecopyresampled($dst_image, $src_image, int $dst_x, int $dst_y, int $src_x, int $src_y, int $dst_w, int $dst_h, int $src_w, int $src_h)
	imagecopyresampled($dst, $src, $dst_x, 0, 0, 0, $new_w, $new_h, $width, $height);

    
}else
{
	$x_ratio = $width/$max_width ;	
	$new_w=$max_width;		
	$new_h=$height/$x_ratio;
	
	//echo($width);
 	// Create the new image!
     $src = imagecreatefromjpeg($filename);
     $dst = imagecreatetruecolor($new_w, $new_h);
	 $dst = imagecreatetruecolor($new_w, $max_height);
	 
	 $dst_y = $max_height/2-$new_h/2;
	// imagecopyresampled($dst_image, $src_image, int $dst_x, int $dst_y, int $src_x, int $src_y, int $dst_w, int $dst_h, int $src_w, int $src_h)
	imagecopyresampled($dst, $src, 0, $dst_y, 0, 0, $new_w, $new_h, $width, $height);
}
	// imagejpeg($dst);
	 imagejpeg ($dst , $filename , $quality);
}

//---------------------------------

function do_resizeToHeight($file,$max_height,$quality,$output = 'file', $delete_original = true, $use_linux_commands = false)
{
	$info = getimagesize($file);
	$image = '';
	
	list($width_old, $height_old) = $info;
	
	$y_ratio = $max_height / $height_old;	
	$final_height=$max_height;
	$final_width=$width_old*$y_ratio;
	
	
	switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $image = imagecreatefromgif($file);
      break;
      case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($file);
      break;
      case IMAGETYPE_PNG:
        $image = imagecreatefrompng($file);
      break;
      default:
        return false;
    }

    $image_resized = imagecreatetruecolor( $final_width, $final_height );
 
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($image);
 
      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {
 
        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
 
        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $trnprt_indx);
 
        // Set the background color for new image to transparent
        imagecolortransparent($image_resized, $trnprt_indx);
 
 
      } 
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {
 
        // Turn off transparency blending (temporarily)
        imagealphablending($image_resized, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($image_resized, true);
      }
    }
 
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
 
    if ( $delete_original ) {
      if ( $use_linux_commands )
        exec('rm '.$file);
      else
        @unlink($file);
    }
 
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
 
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($image_resized, $output);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($image_resized, $output);
      break;
      case IMAGETYPE_PNG:
        imagepng($image_resized, $output);
      break;
      default:
        return false;
    }
 
    return true;
	
	/*
	// Create the new image!
	$src = imagecreatefromjpeg($file);
	$dst = imagecreatetruecolor($new_w, $new_h);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
	// imagejpeg($dst);
	imagejpeg ($dst , $file , $quality);*/
}

function do_resizeToWidth($file,$max_width,$quality,$output = 'file', $delete_original = true, $use_linux_commands = false)
{
	
	$info = getimagesize($file);
	$image = '';
	
	list($width_old, $height_old) = $info;
	
	$x_ratio = $max_width / $width_old;	 
	$final_width = $max_width;
	$final_height = $height_old * $x_ratio;

	switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $image = imagecreatefromgif($file);
      break;
      case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($file);
      break;
      case IMAGETYPE_PNG:
        $image = imagecreatefrompng($file);
      break;
      default:
        return false;
    }
 
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
 
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($image);
 
      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {
 
        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
 
        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $trnprt_indx);
 
        // Set the background color for new image to transparent
        imagecolortransparent($image_resized, $trnprt_indx);
 
 
      } 
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {
 
        // Turn off transparency blending (temporarily)
        imagealphablending($image_resized, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($image_resized, true);
      }
    }
 
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
 
 	if ( $delete_original ) {
      if ( $use_linux_commands )
        exec('rm '.$file);
      else
        @unlink($file);
    }
	
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
 
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($image_resized, $output);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($image_resized, $output);
      break;
      case IMAGETYPE_PNG:
        imagepng($image_resized, $output);
      break;
      default:
        return false;
    }
 
    return true;
	
	/*
	// Create the new image!
	$src = imagecreatefromjpeg($file);
	$dst = imagecreatetruecolor($new_w, $new_h);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
	// imagejpeg($dst);
	imagejpeg ($dst , $file , $quality);*/
}


function do_thumbResize($filename,$newfilename,$width,$height,$quality)
{
// Max height and width
$max_height = $height;
//header("Content-type: image/jpeg");
$size = getimagesize($filename); // Read the size
$img_width = $size[0];
$img_height = $size[1];

//$y_ratio = $max_height / $height;	 

if ($img_width==$img_height){
$new_h=$new_w=$width;
}else if($img_width>$img_height){

$ratio = $img_height/$height;	
$new_h=$height;
$new_w=$img_width/$ratio;

if ($new_w<$width){
//$new_h=$new_h+10;
//$new_w=$new_w+10;
$ratio = $img_width/$width ;	
$new_h=$img_height/$ratio;
$new_w=$width;
}

}else{

$ratio = $img_width/$width ;	
$new_h=$img_height/$ratio;
$new_w=$width;
}

//echo("original ".$img_width.",".$img_height." new ".$new_w.",".$new_h." ratio ".$ratio);
copyfile($filename,$newfilename);
 // Create the new image!
    $src = imagecreatefromjpeg($newfilename);
    $dst = imagecreatetruecolor($new_w, $new_h);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $img_width, $img_height);
    // imagejpeg($dst);
	 imagejpeg ($dst , $newfilename , $quality);
}

function do_thumbResize2($filename,$newfilename,$width,$height,$quality)
{
	// Max height and width
	$max_height = $height;
	//header("Content-type: image/jpeg");
	$size = getimagesize($filename); // Read the size
	$img_width = $size[0];
	$img_height = $size[1];
	
	//$y_ratio = $max_height / $height;	 
	
	if ($img_width==$img_height){
	$new_h=$new_w=$width;
	}else if($img_width>$img_height){
	
	$ratio = $img_height/$height;	
	$new_h=$height;
	$new_w=$img_width/$ratio;
	
	if ($new_w<$width){
	//$new_h=$new_h+10;
	//$new_w=$new_w+10;
	$ratio = $img_width/$width ;	
	$new_h=$img_height/$ratio;
	$new_w=$width;
	}
	
	}else{
	
	$ratio = $img_width/$width ;	
	$new_h=$img_height/$ratio;
	$new_w=$width;
	}	
	
	$newfilename = $filename; 

    $src = imagecreatefromjpeg($newfilename);
    $dst = imagecreatetruecolor($new_w, $new_h);
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $img_width, $img_height);
	 imagejpeg ($dst , $newfilename , $quality);
}

function do_thumb($filename,$newfilename,$width,$height,$quality)
{
	//$dir_path="gallery/thumbs/";
	// Set a maximum height and width
	//$width = 100;
	//$height = 100;
	// Content type
//	header('Content-type: image/jpeg');
	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize($filename);
	
		if ($width && ($width_orig < $height_orig)) {
			$width = ($height / $height_orig) * $width_orig;
		} else {
			$height = ($width / $width_orig) * $height_orig;
		}
	// Resample
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	// Output
	//imagejpeg($image_p, null, 100);
	imagejpeg ( $image_p , $newfilename , $quality );
}

function delete_image($filename)
{
	if (is_file($filename)) {
		unlink ($filename);
	}
}

function delete_file($filename)
{
	if (is_file($filename)) {
		unlink ($filename);
	}
}


function remove_directory($dir) {
  if ($handle = opendir("$dir")) {
   while (false !== ($item = readdir($handle))) {
     if ($item != "." && $item != "..") {
       if (is_dir("$dir/$item")) {
         remove_directory("$dir/$item");
       } else {
         unlink("$dir/$item");
        // echo " removing $dir/$item<br>\n";
       }
     }
   }
   closedir($handle);
   rmdir($dir);
  // echo "removing $dir<br>\n";
  }
}

function copyfile($filename,$newfilename)
{
copy($filename, $newfilename);
//if (!) {
   // echo "failed to copy $file...\n";
//}

}

function CopyFiles($source,$dest)
{    
   $folder = opendir($source);
   while($file = readdir($folder))
   {
       if ($file == '.' || $file == '..') {
           continue;
       }
       
       if(is_dir($source.'/'.$file))
       {
           mkdir($dest.'/'.$file,0777);
           CopySourceFiles($source.'/'.$file,$dest.'/'.$file);
       }
       else 
       {
           copy($source.'/'.$file,$dest.'/'.$file);
       }
       
   }
   closedir($folder);
   return 1;
}
//remove file, directories, subdirectories
function RemoveFiles($source)
{
   $folder = opendir($source);
   while($file = readdir($folder))
   {
       if ($file == '.' || $file == '..') {
           continue;
       }
       
       if(is_dir($source.'/'.$file))
       {
           RemoveFiles($source.'/'.$file);
       }
       else 
       {
           unlink($source.'/'.$file);
       }
       
   }
   closedir($folder);
 //  rmdir($source);
   return 1;
}

// Image Merge
function mergeImage($image1,$image2,$newName,$path)
{
//echo($image1." ".$image2." ".$newName." ".$path);

global $image_wmax;
global $image_hmax;
global $image_thumb_w;
global $image_thumb_h;


$newThumb = $newName;
$newName = $path.$newName;
$image1 = $path.$image1;
$image2 = $path.$image2;

$transparency = 100;
$jpegQuality = 100;

	$sizeImg1 = getimagesize($image1);
    $widthImg1 = $sizeImg1[0];
    $heightImg1 = $sizeImg1[1];	
	
	$sizeImg2 = getimagesize($image2);
    $widthImg2 = $sizeImg2[0];
    $heightImg2 = $sizeImg2[1];	
	
	$totalWidth = $widthImg1+$widthImg2;
	
	if($image_wmax < $totalWidth)
	{
		if(($image_wmax/2) > $widthImg1)
		{
			$cropW = $widthImg1*2;
		}else
		{
			if(($image_wmax/2) > $widthImg2)
			{
				$cropW = $widthImg2*2;

			}else
			{
				$cropW = $image_wmax;
			}
			
		}
	}else
	{
		if($widthImg1 > $widthImg2)
		{
			$cropW = $widthImg2*2;			
		}else
		{
			$cropW = $widthImg1*2;		
		}
	}
	

	$img = imagecreatetruecolor($cropW,$heightImg1);			
	$org_img = imagecreatefromjpeg($image1);
	$ims = getimagesize($image1);
	imagecopy($img,$org_img, 0, 0, 0, 0, $cropW, $heightImg1);
	imagejpeg($img,$newName,$jpegQuality);
	imagedestroy($img);	
			
	$Img2  = imageCreateFromJPEG($image2);
	$Img1 = imageCreateFromJPEG($newName);
		
	$imgX = $cropW/2;
	imageCopyMerge($Img1, $Img2, $imgX, 0, 0, 0, imageSX($Img2), imageSY($Img2), 100);
	ImageJPEG($Img1, $newName, $jpegQuality);
		
	do_resizeToMaxHeight($newName,$image_wmax,$image_hmax,90);
	
	do_thumbResize($path.$newThumb,$path."thumbs/$newThumb",$image_thumb_w,$image_thumb_h,100);
	do_crop($path."thumbs/$newThumb",$image_thumb_w,$image_thumb_h,100);
	
}


function mergeImageGallery($image1,$image2,$newName,$path,$gallery_id)
{
//echo($image1." ".$image2." ".$newName." ".$path);

global $image_wmax;
global $image_hmax;
global $image_thumb_w;
global $image_thumb_h;

$newThumb = $newName;
$newName = $path.$newName;
$image1 = $path.$image1;
$image2 = $path.$image2;

$transparency = 100;
$jpegQuality = 90;

	$sizeImg1 = getimagesize($image1);
    $widthImg1 = $sizeImg1[0];
    $heightImg1 = $sizeImg1[1];	
	
	$sizeImg2 = getimagesize($image2);
    $widthImg2 = $sizeImg2[0];
    $heightImg2 = $sizeImg2[1];	
	
	$totalWidth = $widthImg1+$widthImg2;
	
	if($image_wmax < $totalWidth)
	{
		if(($image_wmax/2) > $widthImg1)
		{
			$cropW = $widthImg1*2;
		}else
		{
			if(($image_wmax/2) > $widthImg2)
			{
				$cropW = $widthImg2*2;

			}else
			{
				$cropW = $image_wmax;
			}
			
		}
	}else
	{
		if($widthImg1 > $widthImg2)
		{
			$cropW = $widthImg2*2;			
		}else
		{
			$cropW = $widthImg1*2;		
		}
	}
	
	
	$img = imagecreatetruecolor($cropW,$heightImg1);			
	$org_img = imagecreatefromjpeg($image1);
	$ims = getimagesize($image1);
	imagecopy($img,$org_img, 0, 0, 0, 0, $cropW, $heightImg1);
	imagejpeg($img,$newName,$jpegQuality);
	imagedestroy($img);	
			
	$Img2  = imageCreateFromJPEG($image2);
	$Img1 = imageCreateFromJPEG($newName);
		
	$imgX = $cropW/2;
	imageCopyMerge($Img1, $Img2, $imgX, 0, 0, 0, imageSX($Img2), imageSY($Img2), 100);
	ImageJPEG($Img1, $newName, $jpegQuality);
	
	do_thumbResize($path.$newThumb,"../gallery/".$gallery_id."/thumb/".$newThumb,$image_thumb_w,$image_thumb_h,100);
	do_crop("../gallery/".$gallery_id."/thumb/$newThumb",$image_thumb_w,$image_thumb_h,100);
	
	do_resizeToMaxHeight($newName,$image_wmax,$image_hmax,90);
		
	do_thumbResize($path.$newThumb,"../gallery/".$gallery_id."/gthumb/".$newThumb,$image_thumb_w,$image_thumb_h,100);
	do_crop("../gallery/".$gallery_id."/gthumb/$newThumb",$image_thumb_w,$image_thumb_h,100);

	//copy("../gallery/".$gallery_id."/gthumb/".$newThumb, "../gallery/".$gallery_id."/thumb/".$newThumb);
	
}

function smart_resize_image( $file, $width = 0, $height = 0, $proportional = true, $output = 'file', $delete_original = true, $use_linux_commands = false )
  {
    if ( $height <= 0 && $width <= 0 ) {
      return false;
    }
 
    $info = getimagesize($file);
    $image = '';
 
    $final_width = 0;
    $final_height = 0;
    list($width_old, $height_old) = $info;
 
    if ($proportional) {
      if ($width == 0) $factor = $height/$height_old;
      elseif ($height == 0) $factor = $width/$width_old;
      else $factor = min ( $width / $width_old, $height / $height_old);   
 
      $final_width = round ($width_old * $factor);
      $final_height = round ($height_old * $factor);
 
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
    }
 
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        $image = imagecreatefromgif($file);
      break;
      case IMAGETYPE_JPEG:
        $image = imagecreatefromjpeg($file);
      break;
      case IMAGETYPE_PNG:
        $image = imagecreatefrompng($file);
      break;
      default:
        return false;
    }
 
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
 
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $trnprt_indx = imagecolortransparent($image);
 
      // If we have a specific transparent color
      if ($trnprt_indx >= 0) {
 
        // Get the original image's transparent color's RGB values
        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
 
        // Allocate the same color in the new image resource
        $trnprt_indx    = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $trnprt_indx);
 
        // Set the background color for new image to transparent
        imagecolortransparent($image_resized, $trnprt_indx);
 
 
      } 
      // Always make a transparent background color for PNGs that don't have one allocated already
      elseif ($info[2] == IMAGETYPE_PNG) {
 
        // Turn off transparency blending (temporarily)
        imagealphablending($image_resized, false);
 
        // Create a new transparent color for image
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
 
        // Completely fill the background of the new image with allocated color.
        imagefill($image_resized, 0, 0, $color);
 
        // Restore transparency blending
        imagesavealpha($image_resized, true);
      }
    }
 
    imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
 
    if ( $delete_original ) {
      if ( $use_linux_commands )
        exec('rm '.$file);
      else
        @unlink($file);
    }
 
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
 
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:
        imagegif($image_resized, $output);
      break;
      case IMAGETYPE_JPEG:
        imagejpeg($image_resized, $output,90);
      break;
      case IMAGETYPE_PNG:
        imagepng($image_resized, $output);
      break;
      default:
        return false;
    }
 
    return true;
  }
  
  
function MakeDirectory($dir, $mode = 0755)
{
  if (is_dir($dir) || @mkdir($dir,$mode)) return TRUE;
  if (!MakeDirectory(dirname($dir),$mode)) return FALSE;
  return @mkdir($dir,$mode);
}
function file_extension($filename)
{
    return strtolower(end(explode(".", $filename)));
}

?>