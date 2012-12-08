<?php
include ("common/common.php");
include ("common/imagemanipulation.php");

$cid = 1;

$dir = '../assets/home/';

if (!empty($_FILES)) {	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$sql = "select max(image_order) as maxorder from tbl_images where cid=".$cid;
	//$sql = "select max(image_order) as maxorder from tbl_home_slide_show";
	$result = mysql_query($sql) or die(mysql_error());	
	$record = mysql_fetch_object($result);	
	$max_id = $record->maxorder;
	$max_id++;
	
	$sql = "INSERT INTO tbl_images (cid,image_order) VALUES ($cid,$max_id)";
	//$sql = "INSERT INTO tbl_images (image_order) VALUES ($max_id)";
	mysql_query($sql) or die(mysql_error());
	$id = mysql_insert_id();
		
	$image = "slider_".$id.".".file_extension($_FILES['Filedata']['name']);
	$thumb_file = $dir.'t_'.$image;
	$targetFile = $dir.$image;
	
	move_uploaded_file($tempFile,$targetFile);				
	copy($targetFile,$thumb_file);
	smart_resize_image($dir.$image, 950, 405, true);
	
	chmod($thumb_file, 0644);
	chmod($targetFile, 0644);

	do_resizeToHeight($thumb_file,100,90);
			 
	$sql = "UPDATE tbl_images SET images = '".$image."' WHERE id=".$id;
	mysql_query($sql) or die (mysql_error());			

	echo "1";
}
?>