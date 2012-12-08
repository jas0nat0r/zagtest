<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");
/*
ew,ewarm,ewmom
fuel1gal,fuel1w,fuel1arm,fuel1mom
oilqt,oilw,oilarm,oilmom
f1w,f2w,f1arm,f1mom
r1w,r2w,r1arm,r1mom
bag1w,bag1arm,bag1mom
totwt,totmom
totarm
Vva
*/
$cid = $_REQUEST['cid'];
$calc_type = $_REQUEST['calc_type'];

$autoid = $_REQUEST['autoid'];
$oilqtmax = $_REQUEST['oilqtmax'];
$fuel1galmax = $_REQUEST['fuel1galmax'];
$bagg1max = $_REQUEST['bagg1max'];
$maxwt = $_REQUEST['maxwt'];
$Vam = $_REQUEST['Vam'];

$fuel_text = $_REQUEST['fuel_text'];
$oil_text = $_REQUEST['oil_text'];
$baggage_text = $_REQUEST['baggage_text'];
$gross_weight_text = $_REQUEST['gross_weight_text'];

$ew = $_REQUEST['ew'];
$ewarm = $_REQUEST['ewarm'];
$ewmom = $_REQUEST['ewmom'];
$fuel1gal = $_REQUEST['fuel1gal'];
$fuel1w = $_REQUEST['fuel1w'];
$fuel1arm = $_REQUEST['fuel1arm'];
$fuel1mom = $_REQUEST['fuel1mom'];
$oilqt = $_REQUEST['oilqt'];
$oilw = $_REQUEST['oilw'];
$oilarm = $_REQUEST['oilarm'];
$oilmom = $_REQUEST['oilmom'];
$f1w = $_REQUEST['f1w'];
$f2w = $_REQUEST['f2w'];
$f1arm = $_REQUEST['f1arm'];
$f1mom = $_REQUEST['f1mom'];
$r1w = $_REQUEST['r1w'];
$r2w = $_REQUEST['r2w'];
$r1arm = $_REQUEST['r1arm'];
$r1mom = $_REQUEST['r1mom'];
$bag1w = $_REQUEST['bag1w'];
$bag1arm = $_REQUEST['bag1arm'];
$bag1mom = $_REQUEST['bag1mom'];
$totwt = $_REQUEST['totwt'];
$totmom = $_REQUEST['totmom'];
$totarm = $_REQUEST['totarm'];
$Vva = $_REQUEST['Vva'];

$Submit=$_REQUEST['Submit'];
$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["accm_order"];

switch ($Submit)
{
	case "":
		$sql = "select * from ".$tblCalculator." where aircraft_id= ".$cid;
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		$fuel_text = $row['fuel_text'];
		$oil_text = $row['oil_text'];
		
		$baggage_text = $row['baggage_text'];
		$gross_weight_text = $row['gross_weight_text'];
		
		$oilqtmax = $row['oilqtmax'];
		$fuel1galmax = $row['fuel1galmax'];
		$bagg1max = $row['bagg1max'];
		$maxwt = $row['maxwt'];
		$Vam = $row['Vam'];
		$ew = $row['ew'];
		$ewarm = $row['ewarm'];
		$ewmom = $row['ewmom'];
		$fuel1gal = $row['fuel1gal'];
		$fuel1w = $row['fuel1w'];
		$fuel1arm = $row['fuel1arm'];
		$fuel1mom = $row['fuel1mom'];
		$oilqt = $row['oilqt'];
		$oilw = $row['oilw'];
		$oilarm = $row['oilarm'];
		$oilmom = $row['oilmom'];
		$f1w = $row['f1w'];
		$f2w = $row['f2w'];
		$f1arm = $row['f1arm'];
		$f1mom = $row['f1mom'];
		$r1w = $row['r1w'];
		$r2w = $row['r2w'];
		$r1arm = $row['r1arm'];
		$r1mom = $row['r1mom'];
		$bag1w = $row['bag1w'];
		$bag1arm = $row['bag1arm'];
		$bag1mom = $row['bag1mom'];
		$totwt = $row['totwt'];
		$totmom = $row['totmom'];
		$totarm = $row['totarm'];
		$Vva = $row['Vva'];
	break;
	
	case "Update":
		
		$sql = "UPDATE ".$tblCalculator." SET".	
		" fuel_text = ".tosql($fuel_text,"Text").
		",oil_text = ".tosql($oil_text,"Text").
		",baggage_text = ".tosql($baggage_text,"Text").
		",gross_weight_text = ".tosql($gross_weight_text,"Text").
		",oilqtmax = ".tosql($oilqtmax,"Number").
		",fuel1galmax = ".tosql($fuel1galmax,"Number").
		",bagg1max = ".tosql($bagg1max,"Number").
		",maxwt = ".tosql($maxwt,"Number").
		",Vam = ".tosql($Vam,"Number").
		",ew = ".tosql($ew,"Number").
		",ewarm = ".tosql($ewarm,"Number").
		",ewmom = ".tosql($ewmom,"Number").
		",fuel1gal = ".tosql($fuel1gal,"Number").
		",fuel1w = ".tosql($fuel1w,"Number").
		",fuel1arm = ".tosql($fuel1arm,"Number").
		",fuel1mom = ".tosql($fuel1mom,"Number").
		",oilqt = ".tosql($oilqt,"Number").
		",oilw = ".tosql($oilw,"Number").
		",oilarm = ".tosql($oilarm,"Number").
		",oilmom = ".tosql($oilmom,"Number").
		",f1w = ".tosql($f1w,"Number").
		",f2w = ".tosql($f2w,"Number").
		",f1arm = ".tosql($f1arm,"Number").
		",f1mom = ".tosql($f1mom,"Number").
		",r1w = ".tosql($r1w,"Number").
		",r2w = ".tosql($r2w,"Number").
		",r1arm = ".tosql($r1arm,"Number").
		",r1mom = ".tosql($r1mom,"Number").
		",bag1w = ".tosql($bag1w,"Number").
		",bag1arm = ".tosql($bag1arm,"Number").
		",bag1mom = ".tosql($bag1mom,"Number").
		",totwt = ".tosql($totwt,"Number").
		",totmom = ".tosql($totmom,"Number").
		",totarm = ".tosql($totarm,"Number").
		",Vva = ".tosql($Vva,"Number").
		" WHERE aircraft_id=".tosql($cid,"Number");
		mysql_query($sql) or die (mysql_error());
		
		header("Location:add_calculator.php?cid=".$cid."&calc_type=".$calc_type);
		exit;
	break;
	
	case "delete":
	
		$sql= "DELETE FROM ".$tblAccomplishments." WHERE autoid=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());	
		
		//delete_file("../images/services/srv_".$autoid.".jpg");
		
		header( "Location:add_calculator.php");
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
<link href="css/datepicke.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>

<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/cal.css" rel="stylesheet" type="text/css">
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
		window.location='add_calculator.php?Submit=delete&autoid='+autoid;
	}
}
</script>
</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="90%" border="0">
        <tr>
          <td colspan="3">==================================================================================================</td>
          </tr>
        <tr>
          <td colspan="3" class="heading">Add Calculator</td>
          </tr>
        <tr>
          <td width="22%" valign="top">&nbsp;</td>
          <td width="78%" colspan="2"><a href="rental_aircraft.php" class="dpTitleText"> &lt;&lt; Back </a></td>
        </tr>
        <tr>
          <td class="Normal">Max Oil Capacity</td>
          <td colspan="2"><input type="text" name="oilqtmax" value="<?=$oilqtmax;?>" size="15" class="NormalTextBox"></td>
        </tr>
        <tr>
          <td class="Normal">Max Useable Fuel</td>
          <td colspan="2"><input type="text" name="fuel1galmax" value="<?=$fuel1galmax;?>" size="15" class="NormalTextBox"></td>
        </tr>
        <tr>
          <td class="Normal">Maximum Baggagge</td>
          <td colspan="2"><input type="text" name="bagg1max" value="<?=$bagg1max;?>" size="15" class="NormalTextBox"></td>
        </tr>
        <tr>
          <td class="Normal">Max Gross Weight</td>
          <td colspan="2"><input type="text" name="maxwt" value="<?=$maxwt;?>" size="15" class="NormalTextBox"></td>
        </tr>
        <tr>
          <td class="Normal">Maneuvering Speed at Max Gross</td>
          <td colspan="2"><input type="text" name="Vam" value="<?=$Vam;?>" size="15" class="NormalTextBox"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
            <?php if($calc_type == "1"){?>
            <table width="660" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr align="center">
					<?php
						$sql = "select * from ".$tblRentalAircrafts." Where autoid =".$cid;
						$rs  = mysql_query($sql) or die (mysql_error());
						$row = mysql_fetch_assoc($rs);
						$tail_no = $row['tail_no'];
                    ?>
                    <th colspan="2" style="background: none repeat scroll 0% 0% rgb(255, 204, 204);" scope="col"><?=$tail_no?></th>
                    <th scope="col">WEIGHT, lbs</th>
                    <th scope="col">ARM, in</th>
                    <th scope="col">MOMENT, in-lb</th>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">Empty Weight </th>
                    <td align="center" class="reg"><input name="ew" type="text" class="NormalTextBox" id="ew" value="<?=$ew;?>" size="6"></td>
                    <td align="center" class="reg"><input type="text" name="ewarm" value="<?=$ewarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="ewmom" value="<?=$ewmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" scope="row">FUEL <input type="text" name="fuel_text" value="<?=$fuel_text;?>" class="NormalTextBox" style="width:120px;"><!--FUEL <small>(40 gal useable, 6 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="fuel1gal" value="<?=$fuel1gal;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1w" value="<?=$fuel1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1arm" value="<?=$fuel1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="fuel1mom" value="<?=$fuel1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr>
                    <th class="specalt" scope="row">OIL <input type="text" name="oil_text" value="<?=$oil_text;?>" class="NormalTextBox" style="width:120px;"><!--<small>(6 qt max, 7 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="oilqt" value="<?=$oilqt;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilw" value="<?=$oilw;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilarm" value="<?=$oilarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="oilmom" value="<?=$oilmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">FRONT SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="f1w" value="<?=$f1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="f2w" value="<?=$f2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="f1arm" value="<?=$f1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="f1mom" value="<?=$f1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">REAR SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="r1w" value="<?=$r1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="r2w" value="<?=$r2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="r1arm" value="<?=$r1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="r1mom" value="<?=$r1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" colspan="2" scope="row">BAGGAGE <input type="text" name="baggage_text" value="<?=$baggage_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" class="alt"><input type="text" name="bag1w" value="<?=$bag1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="bag1arm" value="<?=$bag1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="bag1mom" value="<?=$bag1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
            
                <!--<tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3"><input type="button" onclick="doCalc()" value="&nbsp;Calculate&nbsp;" name="doit" class="NormalTextBox"> &nbsp; <input type="button" onclick="initWB(1478.5,38.78,40,46,37,73,95);" value="Reset" name="undoit" class="NormalTextBox"></td>
                </tr>-->
                <tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3">&nbsp;</td>
                </tr>
            
                <tr name="overweight" id="overweight" style="display: none;">
                    <td align="center" class="warning" colspan="5">WARNING! The calculated gross weight exceeds maximum gross takeoff weight for this aircraft!</td>
                </tr>
            
                <tr>
                    <th class="specalt" colspan="2" scope="row">GROSS WEIGHT <input type="text" name="gross_weight_text" value="<?=$gross_weight_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" id="grossweight" class="altro" style="background: none repeat scroll 0% 0% rgb(231, 231, 231);"><input type="text" name="totwt" value="<?=$totwt;?>" size="6" class="NormalTextBox"></td>
                    <td class="alt">&nbsp;</td>
                    <td align="center" class="altro"><input type="text" name="totmom" value="<?=$totmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr>
                    <th class="specalt" colspan="3" scope="row">Loaded Center of Gravity</th>
            <!-- ?? maxlength='5' is a workaround to mask a Math.round(totarm*100)/100 bug in IE 5 with +oilarm values -->
                    <td align="center" class="altro"><input type="text" maxlength="5" name="totarm" value="<?=$totarm;?>" class="NormalTextBox" size="6"></td>
                    <td class="alt">&nbsp;</td>
                </tr>
            
                <tr bgcolor="#ccccff">
                    <th class="specalt" colspan="2" scope="row">MANEUVERING SPEED, Va <small>(kts):</small></th>
                    <td align="center" class="altro"><input type="text" name="Vva" value="<?=$Vva;?>" class="NormalTextBox" size="6"></td>
                    <td align="left" class="alt" colspan="2">&nbsp;</td>												
                </tr>
            </tbody></table>
            <?php }elseif($calc_type == "2"){?>
            <table width="660" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr align="center">
					<?php
						$sql = "select * from ".$tblRentalAircrafts." Where autoid =".$cid;
						$rs  = mysql_query($sql) or die (mysql_error());
						$row = mysql_fetch_assoc($rs);
						$tail_no = $row['tail_no'];
                    ?>
                    <th colspan="2" style="background: none repeat scroll 0% 0% rgb(255, 204, 204);" scope="col"><?=$tail_no?></th>
                    <th scope="col">WEIGHT, lbs</th>
                    <th scope="col">ARM, in</th>
                    <th scope="col">MOMENT, in-lb</th>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">Empty Weight </th>
                    <td align="center" class="reg"><input name="ew" type="text" class="NormalTextBox" id="ew" value="<?=$ew;?>" size="6"></td>
                    <td align="center" class="reg"><input type="text" name="ewarm" value="<?=$ewarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="ewmom" value="<?=$ewmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" scope="row">FUEL <input type="text" name="fuel_text" value="<?=$fuel_text;?>" class="NormalTextBox" style="width:120px;"><!--<small>(92 gal useable, 6 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="fuel1gal" value="<?=$fuel1gal;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1w" value="<?=$fuel1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1arm" value="<?=$fuel1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="fuel1mom" value="<?=$fuel1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr>
                    <th class="specalt" scope="row">OIL <input type="text" name="oil_text" value="<?=$oil_text;?>" class="NormalTextBox" style="width:120px;"><!--<small>(13 qt max, 7 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="oilqt" value="<?=$oilqt;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilw" value="<?=$oilw;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilarm" value="<?=$oilarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="oilmom" value="<?=$oilmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">FRONT SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="f1w" value="<?=$f1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="f2w" value="<?=$f2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="f1arm" value="<?=$f1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="f1mom" value="<?=$f1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">REAR SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="r1w" value="<?=$r1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="r2w" value="<?=$r2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="r1arm" value="<?=$r1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="r1mom" value="<?=$r1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" colspan="2" scope="row">BAGGAGE <input type="text" name="baggage_text" value="<?=$baggage_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" class="alt"><input type="text" name="bag1w" value="<?=$bag1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="bag1arm" value="<?=$bag1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="bag1mom" value="<?=$bag1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
            
                <!--<tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3"><input type="button" onclick="doCalc()" value="&nbsp;Calculate&nbsp;" name="doit" class="NormalTextBox"> &nbsp; <input type="button" onclick="initWB(1478.5,38.78,40,46,37,73,95);" value="Reset" name="undoit" class="NormalTextBox"></td>
                </tr>-->
                <tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3">&nbsp;</td>
                </tr>
            
                <tr name="overweight" id="overweight" style="display: none;">
                    <td align="center" class="warning" colspan="5">WARNING! The calculated gross weight exceeds maximum gross takeoff weight for this aircraft!</td>
                </tr>
            
                <tr>
                    <th class="specalt" colspan="2" scope="row">GROSS WEIGHT <input type="text" name="gross_weight_text" value="<?=$gross_weight_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" id="grossweight" class="altro" style="background: none repeat scroll 0% 0% rgb(231, 231, 231);"><input type="text" name="totwt" value="<?=$totwt;?>" size="6" class="NormalTextBox"></td>
                    <td class="alt">&nbsp;</td>
                    <td align="center" class="altro"><input type="text" name="totmom" value="<?=$totmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr>
                    <th class="specalt" colspan="3" scope="row">Loaded Center of Gravity</th>
            <!-- ?? maxlength='5' is a workaround to mask a Math.round(totarm*100)/100 bug in IE 5 with +oilarm values -->
                    <td align="center" class="altro"><input type="text" maxlength="5" name="totarm" value="<?=$totarm;?>" class="NormalTextBox" size="6"></td>
                    <td class="alt">&nbsp;</td>
                </tr>
            
                <tr bgcolor="#ccccff">
                    <th class="specalt" colspan="2" scope="row">MANEUVERING SPEED, Va <small>(kts):</small></th>
                    <td align="center" class="altro"><input type="text" name="Vva" value="<?=$Vva;?>" class="NormalTextBox" size="6"></td>
                    <td align="left" class="alt" colspan="2">&nbsp;</td>												
                </tr>
            </tbody></table>
            <?php }elseif($calc_type == "3"){?>
            <table width="660" cellspacing="0" cellpadding="0" border="0">
                <tbody><tr align="center">
					<?php
						$sql = "select * from ".$tblRentalAircrafts." Where autoid =".$cid;
						$rs  = mysql_query($sql) or die (mysql_error());
						$row = mysql_fetch_assoc($rs);
						$tail_no = $row['tail_no'];
                    ?>
                    <th colspan="2" style="background: none repeat scroll 0% 0% rgb(255, 204, 204);" scope="col"><?=$tail_no?></th>
                    <th scope="col">WEIGHT, lbs</th>
                    <th scope="col">ARM, in</th>
                    <th scope="col">MOMENT, in-lb</th>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">Empty Weight </th>
                    <td align="center" class="reg"><input name="ew" type="text" class="NormalTextBox" id="ew" value="<?=$ew;?>" size="6"></td>
                    <td align="center" class="reg"><input type="text" name="ewarm" value="<?=$ewarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="ewmom" value="<?=$ewmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" scope="row">FUEL <input type="text" name="fuel_text" value="<?=$fuel_text;?>" class="NormalTextBox" style="width:120px;"><!--<small>(84 gal useable, 6 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="fuel1gal" value="<?=$fuel1gal;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1w" value="<?=$fuel1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="fuel1arm" value="<?=$fuel1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="fuel1mom" value="<?=$fuel1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr style="display: none;">
                    <th class="specalt" scope="row">OIL <input type="text" name="oil_text" value="<?=$oil_text;?>" class="NormalTextBox" style="width:120px;"><!--<small>(8 qt max, 7 lb/gal)</small>--></th>
                    <td align="center" class="reg"><input type="text" name="oilqt" value="<?=$oilqt;?>" size="4" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilw" value="<?=$oilw;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="oilarm" value="<?=$oilarm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="oilmom" value="<?=$oilmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">FRONT SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="f1w" value="<?=$f1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="f2w" value="<?=$f2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="f1arm" value="<?=$f1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="f1mom" value="<?=$f1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="spec" colspan="2" scope="row">REAR SEAT 1 &amp; 2</th>
                    <td align="center" class="reg"><input type="text" name="r1w" value="<?=$r1w;?>" size="6" class="NormalTextBox"><br>
                    <input type="text" name="r2w" value="<?=$r2w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="reg"><input type="text" name="r1arm" value="<?=$r1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="regro"><input type="text" name="r1mom" value="<?=$r1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                <tr>
                    <th class="specalt" colspan="2" scope="row">BAGGAGE <input type="text" name="baggage_text" value="<?=$baggage_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" class="alt"><input type="text" name="bag1w" value="<?=$bag1w;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="alt"><input type="text" name="bag1arm" value="<?=$bag1arm;?>" size="6" class="NormalTextBox"></td>
                    <td align="center" class="altro"><input type="text" name="bag1mom" value="<?=$bag1mom;?>" size="8" class="NormalTextBox"></td>
                </tr>
            
                <!--<tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3"><input type="button" onclick="doCalc()" value="&nbsp;Calculate&nbsp;" name="doit" class="NormalTextBox"> &nbsp; <input type="button" onclick="initWB(1478.5,38.78,40,46,37,73,95);" value="Reset" name="undoit" class="NormalTextBox"></td>
                </tr>-->
                <tr bgcolor="#aaaaaa">
                    <th class="spec" colspan="2">&nbsp;</th>
                    <td align="right" class="reg" colspan="3">&nbsp;</td>
                </tr>
            
                <tr name="overweight" id="overweight" style="display: none;">
                    <td align="center" class="warning" colspan="5">WARNING! The calculated gross weight exceeds maximum gross takeoff weight for this aircraft!</td>
                </tr>
            
                <tr>
                    <th class="specalt" colspan="2" scope="row">GROSS WEIGHT <input type="text" name="gross_weight_text" value="<?=$gross_weight_text;?>" class="NormalTextBox" style="width:120px;"></th>
                    <td align="center" id="grossweight" class="altro" style="background: none repeat scroll 0% 0% rgb(231, 231, 231);"><input type="text" name="totwt" value="<?=$totwt;?>" size="6" class="NormalTextBox"></td>
                    <td class="alt">&nbsp;</td>
                    <td align="center" class="altro"><input type="text" name="totmom" value="<?=$totmom;?>" size="8" class="NormalTextBox"></td>
                </tr>
                
                <tr>
                    <th class="specalt" colspan="3" scope="row">Loaded Center of Gravity</th>
            <!-- ?? maxlength='5' is a workaround to mask a Math.round(totarm*100)/100 bug in IE 5 with +oilarm values -->
                    <td align="center" class="altro"><input type="text" maxlength="5" name="totarm" value="<?=$totarm;?>" class="NormalTextBox" size="6"></td>
                    <td class="alt">&nbsp;</td>
                </tr>
            
                <tr bgcolor="#ccccff">
                    <th class="specalt" colspan="2" scope="row">MANEUVERING SPEED, Va <small>(kts):</small></th>
                    <td align="center" class="altro"><input type="text" name="Vva" value="<?=$Vva;?>" class="NormalTextBox" size="6"></td>
                    <td align="left" class="alt" colspan="2">&nbsp;</td>												
                </tr>
            </tbody></table>
            <?php }?>
            
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input name="Submit" type="submit" class="btn" id="Submit" value="Update"/></td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>