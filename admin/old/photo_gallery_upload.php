<?php
include ("common/common.php");
include ("common/imagemanipulation.php");

$cid = $_REQUEST['param'];
//$cid = 1;

$dir = '../images/gallery/';

if (!empty($_FILES)) {	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	
	$sql = "select max(image_order) as maxorder from ".$tblGallery." where cid=".$cid;
	//$sql = "select max(image_order) as maxorder from tbl_home_slide_show";
	$result = mysql_query($sql) or die(mysql_error());	
	$record = mysql_fetch_object($result);	
	$max_id = $record->maxorder;
	$max_id++;
	
	$sql = "INSERT INTO ".$tblGallery." (cid,image_order) VALUES ($cid,$max_id)";
	mysql_query($sql) or die(mysql_error());
	$id = mysql_insert_id();
		
	$image = "gallery_".$id.".".file_extension($_FILES['Filedata']['name']);
	$thumb_file = $dir.'t_'.$image;
	$targetFile = $dir.$image;
	
	move_uploaded_file($tempFile,$targetFile);				
	copy($targetFile,$thumb_file);
	smart_resize_image($dir.$image, 890, 495, true);
	
	chmod($thumb_file, 0644);
	chmod($targetFile, 0644);

	do_resizeToHeight($thumb_file,100,90);
			 
	$sql = "UPDATE ".$tblGallery." SET images = '".$image."' WHERE id=".$id;
	mysql_query($sql) or die (mysql_error());			

	echo "1";
	/*$sql = "select max(image_order) as maxorder from ".$tblGallery." where cid=".$cid;	
	$result = mysql_query($sql) or die(mysql_error());	
	$record = mysql_fetch_object($result);	
	$max_id = $record->maxorder;
	$max_id++;
	
	$sql = "INSERT INTO ".$tblGallery." (cid,image_order) VALUES ($cid,$max_id)";
	mysql_query($sql) or die(mysql_error());
	$id = mysql_insert_id();
	
	file_put_contents("log.txt",get_file_extension($_FILES['Filedata']['name']));
	
	$image = $id.".".get_file_extension($_FILES['Filedata']['name']);
	$thumb_file = $dir.'thumbs/'.$image;
	$targetFile = $dir.$image;
	
	move_uploaded_file($tempFile,$targetFile);				
	copy($targetFile,$thumb_file);
	
	list($width_orig, $height_orig) = getimagesize($targetFile);
	if($width_orig > $height_orig){
		do_resizeToWidth($targetFile,750,90);
		
		list($width_orig, $height_orig) = getimagesize($targetFile);
		
		if($height_orig > 500){
			$x= 0;
			$y= ($height_orig - 500)/2;
			do_crop($targetFile,750,500,$x,$y);
		}
		
	}else{
		do_resizeToHeight($targetFile,500,90);
		list($width_orig, $height_orig) = getimagesize($targetFile);
		if($width_orig > 750){
			$x= ($width_orig - 750)/2;
			$y= 0;
			do_crop($targetFile,750,500,$x,$y);
		}
	}
	//smart_resize_image( $targetFile, 750, 500);
	
	//do_resizeToHeight($thumb_file,79,90);
	do_resizeToWidth($thumb_file,125,90);
	//do_crop($file,$pw,360,9,9);
			 
	$sql = "UPDATE ".$tblGallery." SET images = '".$image."' WHERE id=".$id;
	mysql_query($sql) or die (mysql_error());			

	echo "1";*/
}
?>