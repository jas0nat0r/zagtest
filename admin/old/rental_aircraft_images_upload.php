<?php
include ("common/common.php");
include ("common/imagemanipulation.php");

$cid = $_REQUEST['param'];
//$cid = 1;

$dir = '../images/rental_aircraft/';

if (!empty($_FILES)) {	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	
	$sql = "select max(image_order) as maxorder from ".$tblRentalAircraftsImages." where cid=".$cid;
	//$sql = "select max(image_order) as maxorder from tbl_home_slide_show";
	$result = mysql_query($sql) or die(mysql_error());	
	$record = mysql_fetch_object($result);	
	$max_id = $record->maxorder;
	$max_id++;
	
	$sql = "INSERT INTO ".$tblRentalAircraftsImages." (cid,image_order) VALUES ($cid,$max_id)";
	mysql_query($sql) or die(mysql_error());
	$id = mysql_insert_id();
		
	$image = "rental_aircraft_".$id.".".file_extension($_FILES['Filedata']['name']);
	$thumb_file = $dir.'t_'.$image;
	$targetFile = $dir.$image;
	
	move_uploaded_file($tempFile,$targetFile);				
	copy($targetFile,$thumb_file);
	smart_resize_image($dir.$image, 460, 245, true);
	
	chmod($thumb_file, 0644);
	chmod($targetFile, 0644);

	do_resizeToHeight($thumb_file,40,90);
			 
	$sql = "UPDATE ".$tblRentalAircraftsImages." SET images = '".$image."' WHERE id=".$id;
	mysql_query($sql) or die (mysql_error());			

	echo "1";
}
?>