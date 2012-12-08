<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");

$autoid = $_REQUEST['autoid'];
$title =  addslashes($_REQUEST['title']);
$s_description = addslashes($_REQUEST['s_description']);
$page_url =  addslashes($_REQUEST['page_url']);
$target =  addslashes($_REQUEST['target']);

$Submit = $_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["m_order"];

switch ($Submit)
{
	case "Add":	
	$tmp_name = $_FILES["uploadimage"]["tmp_name"];
		if (!empty($tmp_name)) {
			
		$sql = "INSERT INTO ".$tblMembers."(title,s_description,page_url,target) VALUES ('".$title."','".forTexEditor($s_description)."','".forTexEditor($page_url)."','".$target."')";
		mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();
		
		$image = "members_".$id.".jpg";				
		$uploaddir="../images/members/";
		
		move_uploaded_file($tmp_name, $uploaddir.$image);
		//do_crop($uploaddir.$image,927,351,90);
		smart_resize_image($uploaddir.$image, 265, 79, true); 
		
		$sql = "UPDATE ".$tblMembers." SET image = '".$image."' where autoid=".$id;
		mysql_query($sql) or die (mysql_error());
		
		header("Location:members.php");	
		exit;
		/*echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');*/
		}else{
			$err = "Attach Slide Image";
		}
	break;
	
	case "Reorder":
		for ($i=0; $i<sizeof($arr_id); $i++)
		{
			$sql = "UPDATE ".$tblMembers." SET".
			" members_order = ".tosql($arr_order[$i],"Number").
			" WHERE autoid=".tosql($arr_id[$i],"Number");				
			mysql_query($sql) or die (mysql_error());
			
		}
		header("Location:members.php");
		exit;
	break;
	case "delete":
		$sql = "select image from ".$tblMembers." where autoid=".tosql($autoid,"Number");
		$rs  = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_assoc($rs);
		
		delete_image("../images/members/".$row['image']);
		
		$sql= "DELETE FROM ".$tblMembers." WHERE autoid=".tosql($autoid,"Number");
		mysql_query($sql) or die(mysql_error());
		
		header( "Location:members.php");
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
		var url='members.php?Submit=delete&autoid='+autoid;
		window.location = url;
	}
}
</script>
<script language="javascript">
<!-- Dynamic Version by: Nannette Thacker -->
<!-- http://www.shiningstar.net -->
<!-- Original by :  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->
<!-- Use one function for multiple text areas on a page -->
<!-- Limit the number of characters per textarea -->
<!-- Begin
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
//  End -->
</script>
</head>
<body >
<?php include ("header.php");?>
<table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="972" height="415" align="center" valign="top"><form method="post" enctype="multipart/form-data" name="formp" id="formp">
      <table width="95%" border="0">
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" class="heading">Add Rental Aircrafts</td>
          </tr>
        <tr>
          <td width="18%" valign="top">&nbsp;</td>
          <td width="82%" class="NormalRedSmall"><?=$err?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="Normal"> Image</td>
          <td class="links"><input name="uploadimage" type="file" class="NormalTextBox" id="uploadimage">
          (.jpg width <strong>265px</strong> X <strong>79px</strong>)</td>
        </tr>
        
        <tr>
          <td height="25" valign="top" class="Normal">Title</td>
          <td><input name="title" type="text" class="inputBox" id="title" style="width:400px" value="<?php echo(stripslashes(stripslashes($title)));?>"></td>
        </tr>
        <tr>
          <td valign="top" class="Normal">Short Description</td>
          <td colspan="3"><textarea name="s_description" class="NormalTextBox"  cols="70" rows="2" wrap="physical" id="s_description" onKeyDown="textCounter(document.formp.s_description,document.formp.remLen1,90)" onKeyUp="textCounter(document.formp.s_description,document.formp.remLen1,90)"><?=$s_description?></textarea>&nbsp;&nbsp;<input readonly type="text" name="remLen1" size="3" maxlength="3" value="90" class="NormalTextBox" />
          <span class="Normal">( this text display in Members page.</span><strong><span class="NormalRedSmall">max 90 Charactors</span></strong><span class="Normal">)</span></td>
        </tr>
        <tr>
          <td class="Normal">Page Url</td>
          <td><input name="page_url" type="text" class="inputBox" id="page_url" style="width:400px" value="<?php echo(stripslashes(stripslashes($page_url)));?>"></td>
        </tr>
        <tr>
          <td class="Normal">Page Target</td>
          <td>
          	<select name="target" class="NormalTextBox" id="target" style="width:400px" >
                <!--<option value="-1">Select Target</option>-->
                <?php
                for($i = 0; $i < sizeof($arr_target); $i++){
                    $select = "";
                    if($arr_target[$i] == $target){
                        $select = "selected";
                    }
                    echo('<option value="'.$arr_target[$i].'" '.$select.'>'.$arr_target[$i].'</option>');
                }
                ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="Submit" type="submit" class="btn" id="Submit" value="Add"/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
    
    <form action="" method="post" name="frmfaq">
    <table width="95%" border="0" align="center">
  <tr>
    <td colspan="7" align="center" class="DotLine">-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td height="30" valign="middle" class="SubHead">&nbsp;</td>
    <td width="22%" height="30" valign="middle" class="SubHead"><strong>Member Image</strong></td>
    <td width="39%" valign="middle" class="SubHead"><strong>Title<strong> / Description</strong></strong></td>
    <td width="22%" valign="middle" class="SubHead"><strong>Page Url / Url Target</strong></td>
    <td width="4%" align="center" class="SubHead"><strong>Order</strong></td>
    <td width="11%" align="center">&nbsp;</td>
  </tr>
	<?php
		$sql = "select * from ".$tblMembers." Order by members_order";
		$rs  = mysql_query($sql) or die (mysql_error());
		$i=1;
		while( $row = mysql_fetch_array($rs)) {
		$autoid = $row['autoid'];
		$image = $row['image'];
		$title = $row['title'];
		$s_description = $row['s_description'];
		$page_url = $row['page_url'];
		$target = $row['target'];
		$members_order = $row['members_order'];
    ?>
  <tr bgcolor="#ececec" onMouseOver="this.bgColor='#dbd9d9'" onMouseOut="this.bgColor='#ececec'">
    <td width="2%" align="center" valign="top" class="Normal">[<?=$i?>]
      <input name="id[]" type="hidden" id="id[]" value="<?=$row['autoid']?>"></td>
    <td align="left" valign="top" class="Normal"><img src="../images/members/<?=$image?>" width="200" height="71" /></td>
    <td align="left" valign="top" class="Normal"><strong><?=$title?></strong><br><?php echo(nl2br2($s_description));?></td>
    <td align="left" valign="top" class="Normal"><?php echo($page_url);?><br><?php echo($target);?></td>
    <td align="center" valign="top" class="links"><input name="m_order[]" type="text" class="NormalTextBox" id="m_order[]" value="<?=$row['members_order']?>" size="2" maxlength="2"></td>
    <td align="center" valign="top" class="links"><a href="javascript:" class="links" onClick="MM_openBrWindow('edit-members.php?m_id=<?=$row['autoid']?>','edit','location=yes,resizable=yes,width=900,height=750,scrollbars=yes')">Edit</a> | <a href="javascript:" class="links" onClick="javscript:Delete('<?=$row['autoid']?>')">Delete</a> </td>
    </tr>
<?php	
	$i++; 
	}
?>
  <tr>
    <td align="center" valign="top" class="Normal">&nbsp;</td>
    <td colspan="3" align="center" valign="top" class="Normal">&nbsp;</td>
    <td align="center" valign="top" class="links">&nbsp;</td>
    <td align="center" valign="top" class="links"><input name="Submit" type="submit" class="btn" id="Submit" value="Reorder"/></td>
    </tr>
</table>

    </form></td>
  </tr>
</table>
<?php include ("footer.php");?>
</body>
</html>