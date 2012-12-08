<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$bannerStatus = $_REQUEST['bannerStatus'];
$autoid = $_REQUEST['autoid'];
$image = $_REQUEST['image'];
/*$title = $_REQUEST['title'];
$image_title = $_REQUEST['image_title'];*/
$f_description = addslashes($_REQUEST['f_description']);
$tail_no = $_REQUEST['tail_no'];
$make = $_REQUEST['make'];
$model = $_REQUEST['model'];
$year = $_REQUEST['year'];
$equipment = $_REQUEST['equipment'];
$rate = $_REQUEST['rate'];
//$srv_title = $_REQUEST['srv_title'];
$f_description = addslashes($_REQUEST['f_description']);
$description = addslashes($_REQUEST['description']);
$calculator_type = $_REQUEST['calculator_type'];

$Submit=$_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["serv_order"];

if($bannerStatus == "Yes"){$bannerStatus = "Yes";}else{$bannerStatus = "No";}

switch ($Submit)
{

	case "":
		$sql = "select * from ".$tblMainPages." where autoid= 6";
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$title = $row['title'];
		$f_description = $row['f_description'];
		$image = $row['image'];
	break;
	
	case "Save":
	$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../assets/pages/";
		$image = "rental_aircraft.".image_valid($_FILES["uploadimage"]["type"]);
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image, 950, 305, true); 
			
			$sql = "UPDATE ".$tblMainPages." SET image = '".$image."' where autoid =6";
			mysql_query($sql) or die (mysql_error());
		}
		/**/
		$sql = "UPDATE ".$tblMainPages." SET".
		//" title = ".tosql(forTexEditor($title),"Text").
		" status = ".tosql($bannerStatus,"Text").
		",f_description = \"".$f_description."\"".
		" WHERE autoid=".tosql(6,"Number");
		mysql_query($sql) or die (mysql_error());
		
		header("Location:rental_aircraft.php");
		exit;
	break;
	

	case "Add":				
		$sql = "INSERT INTO ".$tblRentalAircrafts."(tail_no,make,model,year,equipment,rate,description,calculator_type) VALUES ('".forTexEditor($tail_no)."','".forTexEditor($make)."','".forTexEditor($model)."','".forTexEditor($year)."','".forTexEditor($equipment)."','".forTexEditor($rate)."','".$description."','".$calculator_type."')";
		mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();
		
		$sql = "INSERT INTO ".$tblCalculator."(aircraft_id) VALUES ('".$id."')";
		mysql_query($sql) or die(mysql_error());

		$image = "rental_aircraft_".$id.".jpg";				
		$uploaddir="../images/rental_aircraft/";
		
		move_uploaded_file($tmp_name, $uploaddir.$image);
		smart_resize_image($uploaddir.$image, 460, 245, true); 
		
		$sql = "UPDATE ".$tblRentalAircrafts." SET image = '".$image."' where autoid=".$id;
		mysql_query($sql) or die (mysql_error());
		
		header("Location:rental_aircraft.php");
		exit;
	break;
	
	case "delete":
		$sql= "DELETE FROM ".$tblCalculator." WHERE aircraft_id=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());
		
		
		$sql= "DELETE FROM ".$tblRentalAircrafts." WHERE autoid=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());
		//delete_file("../images/services/srv_".$autoid.".jpg");
		header( "Location:rental_aircraft.php");
		exit;
	break;
}

include("fckeditor/fckeditor.php") ;
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) )."admin/fckeditor/" ;

?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
<link href="css/datepicke.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>
<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script type="text/javascript">
function Delete(autoid)
{
	var userreq=confirm('Are you sure you want to delete ?');
	if (userreq==true)
	{	
		window.location='rental_aircraft.php?Submit=delete&autoid='+autoid;
	}
}
</script>
<link rel="stylesheet" type="text/css" href="css/ddimgtooltip.css" />
<script type="text/javascript" src="js/ddimgtooltip.js">
/***********************************************
* Image w/ description tooltip v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/
</script>
<style>

#list {
	margin: 0;
}


#list li {
	list-style: none;
	margin: 0;
	padding:0;	

}

</style>



<script type="text/javascript">
	$(function() {
	
		$("#list").sortable({ opacity: 0.6, cursor: 'move',handle : '.handle', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("rental_aircraft_order.php", order, function(theResponse){
				//$("#contentRight").html(theResponse);
			}); 												 
		}								  
		});		
	});


</script>

<script type="text/javascript">
function changeColor(id, color) {
	element = document.getElementById(id);
	element.style.background = color;
}
</script>
</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top">
	<form method="post" enctype="multipart/form-data" name="form" id="form">
      <table width="90%" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="heading">Edit Rental Aircrafts Main Content</td>
          </tr>
        <tr>
          <td width="17%" valign="top">&nbsp;</td>
          <td width="83%" class="NormalRedSmall">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="NormalDisabled">Banner Image</td>
          <td align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:950px, hight:305px)</td>
        </tr>
		<tr>
          <td valign="top" class="Normal">Banner Status </td>
          <td colspan="3" class="Normal"> <input checked="checked" name="bannerStatus" type="checkbox" id="bannerStatus" value="Yes" <?=GetCheckBanner($bannerStatus)?> /></td>
		</tr>
        <!--<tr>
          <td valign="top" class="Normal">Image Title</td>
          <td><input name="image_title" type="text" class="NormalTextBox" id="image_title" value="<?=$image_title?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="NormalTextBox" id="title" value="<?=$title?>" style="width:400px;"></td>
        </tr>-->
        <tr>
          <td valign="top" class="Normal">Full Description</td>
          <td><?php
			$oFCKeditor = new FCKeditor('f_description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($f_description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Save"/><input name="autoid" type="hidden" value="<?=$autoid?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><img src="../assets/pages/<?=$image?>" width="745" height="238" /></td>
        </tr>
      </table>
    </form>
	<form method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="90%" border="0">
        <tr>
          <td colspan="2">==================================================================================================</td>
          </tr>
        <tr>
          <td colspan="2" class="heading">Add Rental Aircrafts </td>
          </tr>
        <tr>
          <td width="17%" valign="top">&nbsp;</td>
          <td width="83%" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <!--<tr>
          <td valign="top" class="NormalDisabled">Image</td>
          <td align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:351px, hight: 158px)</td>
        </tr>
        <tr>
          <td valign="top" class="NormalDisabled"> Image</td>
          <td align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:460px, hight:245px)</td>
        </tr>-->
        <tr>
          <td valign="top" class="Normal">Tail #</td>
          <td><input name="tail_no" type="text" class="NormalTextBox" id="tail_no" value="<?=$tail_no?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Make</td>
          <td><input name="make" type="text" class="NormalTextBox" id="make" value="<?=$make?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Model</td>
          <td><input name="model" type="text" class="NormalTextBox" id="model" value="<?=$model?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Year</td>
          <td><input name="year" type="text" class="NormalTextBox" id="year" value="<?=$year?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Equipment</td>
          <td><input name="equipment" type="text" class="NormalTextBox" id="equipment" value="<?=$equipment?>" style="width:400px;"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Rate</td>
          <td><input name="rate" type="text" class="NormalTextBox" id="rate" value="<?=$rate?>" style="width:400px;"> 
            <span class="NormalRedSmall">Ex: 290 (<strong>not like $290</strong>)</span></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Calculator</td>
          <td>
          
          <!--<select name="calculator" class="NormalTextBox" id="calculator" style="width:200px" >
            <option value="-1"> Select Calculator Type</option>
            <?php
                /*for($i = 0; $i < sizeof($arr_calculator); $i++){
                    $select = "";
                    if($arr_calculator[$i] == $calculator){
                        $select = "selected";
                    }
                    echo('<option value="'.$arr_calculator[$i].'" '.$select.'>'.$arr_calculator[$i].'</option>');
                }*/
                ?>
            </select>-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="31%" align="left" valign="top">
                <select name="calculator_type" id="calculator_type" class="NormalTextBox" style="width:200px">
                    <option value="-1" selected>Select Calculator Type</option>
                    <?php echo get_options("select autoid,calculator_type from ".$tblCalculatorType." order by autoid Asc",false,true,$calculator_type) ?>
                </select>
          		</td>
                <td width="8%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[0]"><img src="images/calc_1.jpg" width="50" height="31" border="1"></a></td>
                <td width="8%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[1]"><img src="images/calc_2.jpg" width="50" height="31" border="1"></a></td>
                <td width="53%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[2]"><img src="images/calc_3.jpg" width="50" height="31" border="1"></a></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Description</td>
          <td><?php
			$oFCKeditor = new FCKeditor('description') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/' . preg_replace("/[^a-z0-9]/i", "", 'office2003') . '/' ;
			$oFCKeditor->Value		= stripslashes($description);
			$oFCKeditor->Create() ;
			?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Add"/></td>
        </tr>
      </table>
    </form>
    <form action="" method="post" name="frmfaq">
      <table width="95%" border="0">
        
      </table>
	  <table width="90%" border="0" align="center">
  
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
    <td width="66" height="30" valign="middle" class="SubHead"><strong>Tail #</strong></td>
    <td width="119" valign="middle" class="SubHead"><strong>Make</strong></td>
    <td width="117" valign="middle" class="SubHead"><strong>Model</strong></td>
    <td width="63" valign="middle" class="SubHead"><strong>Year</strong></td>
    <td width="67" valign="middle" class="SubHead"><strong>Rate($)</strong></td>
    <td width="155" valign="middle" class="SubHead"><strong>Equipment</strong></td>
    <td width="35" align="center" class="SubHead"><strong>&nbsp;</strong></td>
    <td width="190" align="center">&nbsp;</td>
  </tr>
  </table>
      <table width="95%" border="0" align="center">
        <tr>
          <td height="30" valign="middle" class="SubHead">
		  
<ul id="list">
	<?php
	$sql = "select * from ".$tblRentalAircrafts." Order by rental_order";
	$rs  = mysql_query($sql) or die (mysql_error());
	while( $row = mysql_fetch_array($rs)) {
	$autoid = $row['autoid'];
	$tail_no = $row['tail_no'];
	$make = $row['make'];
	$model = $row['model'];
	$year = $row['year'];
	$equipment = $row['equipment'];
	$rate = $row['rate'];
	$image = $row['image'];
	$calculator_type = $row['calculator_type'];
	$rental_order = $row['rental_order'];
	?>

    <li id="recordsArray_<?php echo $autoid ?>">
    <div id="<?php echo $autoid ?>" style="width:900px;height:19px;margin:2px; padding:4px; background-color:#ececec;" onMouseOver="changeColor(this.id,'#dbd9d9')" onMouseOut="changeColor(this.id,'#ececec')">
        <div style="width:30px;height:25px; overflow:hidden; float:left;"><img src="images/arrow.png" width="16" class="handle" /></div>
		<div style="width:65px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo($tail_no);?></div>
        <div style="width:120px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo $make ?></div>
		<div style="width:120px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo($model);?></div>
        <div style="width:65px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo $year ?></div>
		<div style="width:65px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo($rate);?></div>
        <div style="width:200px;height:15px; overflow:hidden; float:left; padding:2px;"><?php echo $equipment ?></div>
       <div style="width:180px;height:15px;  overflow:hidden;float:left;"><?php if($calculator_type !="-1"){?><a href="add_calculator.php?cid=<?=$row['autoid']?>&calc_type=<?=$calculator_type?>" class="NormalRedSmall"><strong>Calc</strong></a> | <?php }?><a href="rental_aircraft_images.php?cid=<?=$row['autoid']?>" class="links">Add Images</a> | <a href="javascript:" class="links" onClick="MM_openBrWindow('edit-rental_aircraft.php?rent_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=975,height=1050,scrollbars=yes')">Edit</a> | <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')">Delete</a> </div>
    </div>

		<?php /*?><?php 
		$sqlL = "select * from tbl_galler_category Where parent_id=".$id." Order by cat_order";
		$rsL  = mysql_query($sqlL) or die (mysql_error());
		$num_sub = mysql_num_rows($rsL);
		if($num_sub > 0){
			echo('<ul id="list'.$id.'">');
		?>
         <?php
			while( $rowL = mysql_fetch_array($rsL))
			{
			$sub_id = $rowL['id'];
			$category = $rowL['category'];
			$sub_page_order = $rowL['cat_order'];
			
		?><?php */?>
        	 <!--<li id="recordsArray_<?php echo $sub_id ?>">
                <div id="<?php echo $sub_id ?>" style="width:460px;height:19px;margin:2px; padding:4px; background-color:#ececec;" onMouseOver="changeColor(this.id,'#dbd9d9')" onMouseOut="changeColor(this.id,'#ececec')">
                    <div style="width:30px;height:25px; float:left;"><img src="images/arrow.png" width="16" class="handle_<?php echo $id ?>" /></div>
                    <div style="width:183px;height:21px; float:left; padding:2px"><?php echo $category ?></div>
                    <div style="width:240px;height:25px; float:left;"><a href="project_slide_show.php?cid=<?=$sub_id?>" class="links">Upload Images</a> | <a href="#" class="links" onClick="MM_openBrWindow('edit-cat.php?id=<?=$rowL['id']?>','','scrollbars=yes,width=620,height=620')">Edit</a> | <a href="#" class="links" onClick="javscript:Delete('<?=$rowL['id']?>','IMG')">Delete</a></div>
                </div>
            </li>-->
        <?php /*?><?php
			}			
			echo('</ul>');			
			?><?php */?>
			
			
			<?php
		}
		?>
    </li>                
<?php /*?><?php
}
?>  <?php */?> 
</ul>
          </td>
          </tr>
      </table>
    </form>
    
    
  </td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>