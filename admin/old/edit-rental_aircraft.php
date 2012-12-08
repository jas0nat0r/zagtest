<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$rent_id = $_REQUEST['rent_id'];
$autoid = $_REQUEST['autoid'];

$tail_no = $_REQUEST['tail_no'];
$make = $_REQUEST['make'];
$model = $_REQUEST['model'];
$year = $_REQUEST['year'];
$equipment = $_REQUEST['equipment'];
$rate = $_REQUEST['rate'];
$description = addslashes($_REQUEST['description']);
//$calculator_type = $_REQUEST['calculator_type'];
$newCalculator_type = $_REQUEST['calculator_type'];
$Submit = $_REQUEST['Submit'];

switch ($Submit)
{
	
	case "":
		$sql = "select * from ".$tblRentalAircrafts." where autoid=".tosql($rent_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$tail_no = $row['tail_no'];
		$make = $row['make'];
		$model = $row['model'];
		$year = $row['year'];
		$equipment = $row['equipment'];
		$rate = $row['rate'];
		$description = $row['description'];
		$calculator_type = $row['calculator_type'];
	break;
	
	case "Update":
		$sql = "select * from ".$tblRentalAircrafts." where autoid=".tosql($rent_id,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$calculator_type = $row['calculator_type'];
		
		$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		
		$uploaddir="../images/rental_aircraft/";
		$image = "rental_aircraft_".$rent_id.".jpg";
		
		if (!empty($tmp_name)) {			
			move_uploaded_file($tmp_name, $uploaddir.$image);
			smart_resize_image($uploaddir.$image,  460, 245, true); 
			
			$sql = "UPDATE ".$tblRentalAircrafts." SET".
			" image = ".tosql(forTexEditor($image),"Text").
			" WHERE autoid=".tosql($rent_id,"Number");
			mysql_query($sql) or die (mysql_error());
			}
		
		$sql = "UPDATE ".$tblRentalAircrafts." SET".
		" tail_no = ".tosql(forTexEditor($tail_no),"Text").
		",make = ".tosql(forTexEditor($make),"Text").
		",model = ".tosql(forTexEditor($model),"Text").
		",year = ".tosql(forTexEditor($year),"Text").
		",equipment = ".tosql(forTexEditor($equipment),"Text").
		",rate = ".tosql(forTexEditor($rate),"Text").
		",description = \"".$description."\"".
		",calculator_type = \"".$newCalculator_type."\"".
		" WHERE autoid=".tosql($rent_id,"Number");
		mysql_query($sql) or die (mysql_error());

		
		if($calculator_type != $newCalculator_type){
			$sql = "UPDATE ".$tblCalculator." SET".
			" fuel_text = ".tosql('',"Text").
			",oil_text = ".tosql('',"Text").
			",baggage_text = ".tosql('',"Text").
			",gross_weight_text = ".tosql('',"Text").			
			",oilqtmax = ".tosql('',"Number").
			",fuel1galmax = ".tosql('',"Number").
			",bagg1max = ".tosql('',"Number").
			",maxwt = ".tosql('',"Number").
			",Vam = ".tosql('',"Number").
			",ew = ".tosql('',"Number").
			",ewarm = ".tosql('',"Number").
			",ewmom = ".tosql('',"Number").
			",fuel1gal = ".tosql('',"Number").
			",fuel1w = ".tosql('',"Number").
			",fuel1arm = ".tosql('',"Number").
			",fuel1mom = ".tosql('',"Number").
			",oilqt = ".tosql('',"Number").
			",oilw = ".tosql('',"Number").
			",oilarm = ".tosql('',"Number").
			",oilmom = ".tosql('',"Number").
			",f1w = ".tosql('',"Number").
			",f2w = ".tosql('',"Number").
			",f1arm = ".tosql('',"Number").
			",f1mom = ".tosql('',"Number").
			",r1w = ".tosql('',"Number").
			",r2w = ".tosql('',"Number").
			",r1arm = ".tosql('',"Number").
			",r1mom = ".tosql('',"Number").
			",bag1w = ".tosql('',"Number").
			",bag1arm = ".tosql('',"Number").
			",bag1mom = ".tosql('',"Number").
			",totwt = ".tosql('',"Number").
			",totmom = ".tosql('',"Number").
			",totarm = ".tosql('',"Number").
			",Vva = ".tosql('',"Number").
			" WHERE aircraft_id=".tosql($rent_id,"Number");
			mysql_query($sql) or die (mysql_error());
		}

		echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');
	break;
}
include("fckeditor/fckeditor.php") ;
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) )."admin/fckeditor/" ;
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Administration</title>
<link href="css/datepicke.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/datepicker.js"></script>

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
<link href="css/text_editor.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="js/common.js"></script>

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
<form method="post" enctype="multipart/form-data" name="form" id="form">
  <table width="880" border="0" align="left">
        <tr>
          <td colspan="2" class="heading"> Edit Rental Aircraft</td>
    </tr>
        <!--<tr>
          <td valign="top" class="NormalDisabled">Image</td>
          <td align="left" valign="top" class="Normal"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
            ( file:*.jpg , width:351px, hight:158px)</td>
        </tr>-->
        <tr>
          <td width="174" valign="top" class="Normal">Tail #</td>
          <td width="696"><input name="tail_no" type="text" class="NormalTextBox" id="tail_no" value="<?=$tail_no?>" style="width:400px;"></td>
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
          <td valign="top" class="Normal">Calculator</td>
          <td>

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="43%" align="left" valign="top">
                <select name="calculator_type" id="calculator_type" class="NormalTextBox" style="width:200px">
                    <option value="-1" selected>Select Calculator Type</option>
                    <?php echo get_options("select autoid,calculator_type from ".$tblCalculatorType." order by autoid Asc",false,true,$calculator_type) ?>
                </select>
          		</td>
                <td width="8%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[0]"><img src="images/calc_1.jpg" width="50" height="31" border="1"></a></td>
                <td width="8%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[1]"><img src="images/calc_2.jpg" width="50" height="31" border="1"></a></td>
                <td width="41%" align="left" valign="top"><a style="cursor:pointer" rel="imgtip[2]"><img src="images/calc_3.jpg" width="50" height="31" border="1"></a></td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="top" class="NormalRedSmall" style="font-size:13px;"><strong>Note</strong> -<strong> ***</strong> If you are change the Calculator Type, <br>
                You must re-enter the calculator values for new calculator type. Otherwise calculator will not work<strong>***</strong></td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
        
        <!--<tr>
          <td align="left">&nbsp;</td>
      <td align="left"><?php if($row['image'] !=""){?><img src="../images/services/<?=$row['image']?>" width="351" height="158"><?php }?></td>
        </tr>-->
  </table>
</form><br>
</body>
</html>