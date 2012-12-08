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
	
	case"Reorder":
		for ($i=0; $i<sizeof($arr_id); $i++){
			$sql = "UPDATE ".$tblRentalAircrafts." SET".
			" rental_order = ".tosql($arr_order[$i],"Number").
			" WHERE autoid=".tosql($arr_id[$i],"Number");
			mysql_query($sql) or die (mysql_error());
		}
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<link href="css/datepicke.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>

<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<link href="css/text_editor.css" rel="stylesheet" type="text/css">
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
</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form" id="form">
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
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="10" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
    <td width="67" height="30" valign="middle" class="SubHead"><strong>Tail #</strong></td>
    <td width="105" valign="middle" class="SubHead"><strong>Make</strong></td>
    <td width="125" valign="middle" class="SubHead"><strong>Model</strong></td>
    <td width="45" valign="middle" class="SubHead"><strong>Year</strong></td>
    <td width="50" valign="middle" class="SubHead"><strong>Rate($)</strong></td>
    <td width="210" valign="middle" class="SubHead"><strong>Equipment</strong></td>
    <td width="35" align="center" class="SubHead"><strong>Order</strong></td>
    <td width="190" align="center">&nbsp;</td>
  </tr>
  <?php
	$sql = "select * from ".$tblRentalAircrafts." Order by rental_order";
	$rs  = mysql_query($sql) or die (mysql_error());
	$i=1;
	while( $row = mysql_fetch_array($rs)) {
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
  <tr bgcolor="#ececec" onMouseOver="this.bgColor='#dbd9d9'" onMouseOut="this.bgColor='#ececec'">
    <td width="26" align="center" valign="top" class="Normal">[<?=$i?>] <input name="id[]" type="hidden" id="id[]" value="<?=$row['autoid']?>"></td>
    <td align="left" valign="top" class="Normal"><?php echo($tail_no);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($make);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($model);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($year);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($rate);?></td>
    <td align="left" valign="top" class="Normal"><?php echo($equipment);?></td>
    <td align="center" valign="top" class="links"><input name="serv_order[]" type="text" class="NormalTextBox" id="serv_order" value="<?=$row['rental_order']?>" size="2" maxlength="2"></td>
    <td align="center" valign="top" class="links"><?php if($calculator_type !="-1"){?><a href="add_calculator.php?cid=<?=$row['autoid']?>&calc_type=<?=$calculator_type?>" class="NormalRedSmall"><strong>Calc</strong></a> | <?php }?><a href="rental_aircraft_images.php?cid=<?=$row['autoid']?>" class="links">Add Images</a> | <a href="javascript:" class="links" onClick="MM_openBrWindow('edit-rental_aircraft.php?rent_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=975,height=1050,scrollbars=yes')">Edit</a> | <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')">Delete</a> </td>
    </tr>
<?php
	$i++; 
	}
?>
  <tr>
    <td align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="2" align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="4" align="left" valign="top" class="Normal">&nbsp;</td>
    <td colspan="2" align="center" valign="top" class="links"><input name="Submit" type="submit" class="btn" id="Submit" value="Reorder"/></td>
    </tr>
</table>
</form>
</td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>