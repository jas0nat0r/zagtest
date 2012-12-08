<?php
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();
set_time_limit(900);
include("db.php");

$tblAdmin ="tbl_admin";
$tblAdminEmail ="tbl_admin_email";
$tblMainPages ="tbl_main_pages";
$tblSubPages ="tbl_sub_pages";
$tblSlider ="tbl_slider";
$tblHomeColumn = "tbl_home_column";
$tblNews ="tbl_news";
$tblContact ="tbl_contact";
$tblSalesContact ="tbl_sales_contact";
$tblHomeSlideShow ="tbl_home_slide_show";
$tblMembers ="tbl_members";
$tblGallery ="tbl_gallery";
$tblRentalAircrafts ="tbl_rental_aircrafts";
$tblRentalAircraftsImages ="tbl_rental_aircrafts_images";
$tblFlightSimulators ="tbl_flight_simulators";
$tblFullTimeInstructor ="tbl_full_time_instructor";
$tblPartTimeInstructor ="tbl_part_time_instructor";
$tblAccomplishments ="tbl_accomplishments";
$tblCalculatorType ="tbl_calculator_type";
$tblCalculator ="tbl_calculator";
$tblHomeColumn = "tbl_home_column";
$tblGeneralContent = "tbl_general_content";
$tblAbout = "tbl_about_img";
$tblCommercial = "tbl_commercial_img";
$tblResidential = "tbl_residential_img";
$tblPortfolioImages= "tbl_portfolio_images";
$tblPortfolioLargeImages= "tbl_portfolio_large_images";
$tblServices = "tbl_services";
$tblEmbroidery = "tbl_embroidery_img";
$tbl_category = "tbl_addcategory";
$tbl_prduct = "tbl_addproducts";

$arr_target = array("none","_self","_blank");
$arr_acc_year = array("2000","2001","2002","2003","2004","2005","2006","2007","2008","2009","2010","2011","2012","2013","2014","2015");
$arr_acc_month = array("January","February","March","April","May","June","July","August","September","October","November","December");
//$arr_calculator = array("Calculator 1","Calculator 2","Calculator 3");


function tohtml($strValue){  return htmlspecialchars($strValue);}
function tourl($strValue){  return urlencode($strValue);}
function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}
function get_param($ParamName)
{
  /*global $_POST;
  global $_GET;
	*/
	global $_REQUEST;

  $ParamValue = "";
  /*if(isset($_POST[$ParamName]))
    $ParamValue = $_POST[$ParamName];
  else if(isset($_GET[$ParamName]))
    $ParamValue = $_GET[$ParamName];
*/
	if(get_magic_quotes_gpc())
		$ParamValue = stripslashes($_REQUEST[$ParamName]);
	else
		$ParamValue = $_REQUEST[$ParamName];

  return $ParamValue;
}
 
function is_param($param_value)
{
  if($param_value)
    return 1;
  else
    return 0;
}



function tosql($value, $type="")
{
  if($value == "")
    return "NULL";
  else
    if($type == "Number")
      return doubleval($value);
    else
    {
     
	  if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
		
		//$value = str_replace("&","",$value);
		$value = str_replace("|","",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
		
		//$value = str_replace("&","",$value);
		$value = str_replace("|","",$value);
      }

      return "'" . $value . "'";
    }
}

function fromTextBox($value){	  
	$value = str_replace("&quot;",'"',$value);
	$value = str_replace("&#039","'",$value);
	$value = str_replace("&rsquo;","’",$value);
	$value = str_replace("&lsquo;","‘",$value);
	$value = str_replace("&amp;","&",$value);
	return $value;
}

function toSqlHtml($value)
{	  
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	$value = str_replace("’","&rsquo;",$value);
	return $value;
}

function replace_quote($value)
{	  
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	$value = str_replace("’","&rsquo;",$value);
	return $value;
}
function convert_quote($value)
{	  
	$value = str_replace("\&quot;",'"',$value);
	$value = str_replace("\&#039","'",$value);
	$value = str_replace("\&rsquo;","’",$value);
	return $value;
}

function convert_smart_quotes($string)
{
  /**
 *  ‘  8216  curly left single quote
 *  ’  8217  apostrophe, curly right single quote
 *  “  8220  curly left double quote
 *  ”  8221  curly right double quote
 *  —  8212  em dash
 *  –  8211  en dash
 *  …  8230  ellipsis
 */
$search = array(
                '&',
                '<',
                '>',
                '"',
                chr(212),
                chr(213),
                chr(210),
                chr(211),
                chr(209),
                chr(208),
                chr(201),
                chr(145),
                chr(146),
                chr(147),
                chr(148),
                chr(151),
                chr(150),
                chr(133)
                );
$replace = array(
                '&amp;',
                '&lt;',
                '&gt;',
                '&quot;',
                '&#8216;',
                '&#8217;',
                '&#8220;',
                '&#8221;',
                '&#8211;',
                '&#8212;',
                '&#8230;',
                '&#8216;',
                '&#8217;',
                '&#8220;',
                '&#8221;',
                '&#8211;',
                '&#8212;',
                '&#8230;'
                );
                   
  return str_replace($search, $replace, $string);
}


function forflash($value)
{	  
	$value = str_replace("&quot;",'"',$value);
	$value = str_replace("&#039","'",$value);
	return $value;
}

function forTextBox($value){	  
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	//$value = str_replace("‘","&#039",$value);
	$value = str_replace("’","&rsquo;",$value);
	$value = str_replace("‘","&lsquo;",$value);
	$value = str_replace("&", "&amp;", $value);
	//$value = str_replace(" – "," &minus; ",$value);
	//$value = str_replace("—"," &minus; ",$value);
	return $value;
}


function get_checkbox_value($sVal, $CheckedValue, $UnCheckedValue)
{
  if(!strlen($sVal))
    return tosql($UnCheckedValue,"Text");
  else
    return tosql($CheckedValue,"Text");
}

function get_options_array($array,$selected_value){
 
  for($i=0; $i<sizeof($array); $i++) {
	$id = $array[$i];
    $value = $array[$i];
   
    $selected="";
    if ($id == $selected_value) {
      $selected = "SELECTED";
    }
    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}

 //get_options("select swfType,swfType from tbl_store_swftype",false,true,$swf)
function get_options($sql,$is_search,$is_required,$selected_value)
{
  global $db2;  //-- connection special for list box

  $options_str="";
  if ($is_search)
    $options_str.="<option value=\"\">All</option>";
  else
  {
    if (!$is_required)
    {
      $options_str.="<option value=\"\"></option>";
    }
  }
  $rs  = mysql_query($sql) or die (mysql_error());
 // $db2->query($sql);
  while( $row = mysql_fetch_array($rs)) 
  {
   $id=$row[0];
   $value=$row[1];
    $selected="";
    if ($id == $selected_value)
    {
      $selected = "SELECTED";
    }
    $options_str.= "<option value='".$id."' ".$selected.">".$value."</option>";
  }
  return $options_str;
}




function check_security()
{
	if (isset($_SESSION['username']) || !$_SESSION['username']=='') {
	
	} else {
	
		header( "Location: index.php?login=error" );
		exit;
	}
}

function GetCheck($value)
{
	if ($value=="true")
	{
		return "checked=checked";
	}else{
		return "";
	}
}function GetCheckINFO($value)
{
	if ($value=="Yes")
	{
		return "checked=checked";
	}else{
		return "";
	}
}

function check_login_security()
{
	if (isset($_COOKIE['clientid']) || !$_COOKIE['clientid']=='') {
	
	} else {	
		header( "Location: client_login.php" );
		exit;
	}
}

function closeWindow()
{echo('<script type="text/javascript">self.close();</script>');}
function closePopUpWindow()
{echo('<script type="text/javascript">self.close();</script>');}
function parentWindowRefresh()
{echo('<script type="text/javascript">window.opener.location.reload();self.close();</script>');}
function ReleseUrl($title){
	$title = str_replace("-", " ", $title);	
	return strtolower($title);
}
function releseBr($title){
	
	$title = str_replace("<br>", ", ", $title);
	$title = str_replace("</br>", ", ", $title);	
	return $title;
}

function StripUrl($title){
	$title = str_replace("#", "sharp", $title);	
	$title = str_replace("/", "or", $title);	
	$title = str_replace("$", "", $title);	
	$title = str_replace("&amp;", "and", $title);	
	$title = str_replace("&", "and", $title);	
	$title = str_replace("+", "plus", $title);	
	$title = str_replace(",", "", $title);	
	$title = str_replace(":", "", $title);	
	$title = str_replace(";", "", $title);
	$title = str_replace("=", "equals", $title);	
	$title = str_replace("?", "", $title);	
	$title = str_replace("@", "at", $title);	
	$title = str_replace("<", "", $title);	
	$title = str_replace(">", "", $title);	
	$title = str_replace("%", "", $title);	
	$title = str_replace("{", "", $title);	
	$title = str_replace("}", "", $title);
	$title = str_replace("|", "", $title);
	$title = str_replace("\\", "", $title);
	$title = str_replace("^", "", $title);
	$title = str_replace("~", "", $title);
	$title = str_replace("[", "", $title);
	$title = str_replace("]", "", $title);
	$title = str_replace("`", "", $title);
	$title = str_replace("'", "", $title);
	$title = str_replace("\"", "", $title);
	$title = str_replace(" ", "-", $title);
	$title = str_replace("-", "-", $title);
	$title = str_replace("--", "-", $title);
	return strtolower($title);
}

function nl2br2($string) {
	$string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
	return $string;
} 

//character limit
function limitchrmid($value,$lenght){
    if (strlen($value) >= $lenght ){
		$lenght_max = ($lenght);
        //$lenght_max = ($lenght/2)-3;
        //$start = strlen($value)- $lenght_max;
        $limited = substr($value,0,$lenght_max);
        $limited.= " ... ";                  
        //$limited.= substr($value,$start,$lenght_max);
    }
    else{
        $limited = $value;
    }
    return $limited;
} 

function getAdminDetails($field)
{
	global $tblAdminEmail;
	
	$sql = "select ".$field." from ".$tblAdminEmail." where autoid='1'";
	$rs  = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($rs);
	
	return $row[$field];
}

function checkCustomerSecurity()
{
	if (isset($_SESSION['userid']) || !$_SESSION['userid']=='') {
	
	} else {	
		header( "Location: login.php" );
		exit;
	}
}
function forTexEditor($value)
{
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	$value = str_replace("’","&#039",$value);
	$value = str_replace("&", "&amp;", $value); 
	/*$value = str_replace("’","&rsquo;",$value);
	$value = str_replace("’","&rsquo;",$value);*/
	$value = str_replace("£","&pound;",$value);
	$value = str_replace("&bull;","&bull;",$value);
	$value = str_replace("•","&bull;",$value);
	$value = str_replace("©","&copy;",$value);
	return $value;
}

function forFCKEditor($value)
{
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	$value = str_replace("'","&#039",$value);
	//$value = str_replace("&", "&amp;", $value); 
	/*$value = str_replace("'","&rsquo;",$value);
	$value = str_replace("'","&rsquo;",$value);*/
	$value = str_replace("£","&pound;",$value);
	$value = str_replace("&bull;","&bull;",$value);
	$value = str_replace("•","&bull;",$value);
	$value = str_replace("©","&copy;",$value);
	return $value;
}
function fromFCKEditor($value)
{
	$value = str_replace("&quot;",'"',$value);
	$value = str_replace("&#039","'",$value);
	$value = str_replace("&#039","'",$value);
	$value = str_replace("&pound;","£",$value);
	$value = str_replace("&bull;","&bull;",$value);
	$value = str_replace("&bull;","•",$value);
	$value = str_replace("&copy;","©",$value);
	return $value;
}

function forCopyright($value)
{
	$value = str_replace('"',"&quot;",$value);
	$value = str_replace("'","&#039",$value);
	$value = str_replace("’","&#039",$value);
	$value = str_replace("£","&pound;",$value);
	$value = str_replace("&bull;","&bull;",$value);
	$value = str_replace("•","&bull;",$value);
	$value = str_replace("©","&copy;",$value);
	return $value;
}

function getTelephone(){
	$sql = "select telephone from tbl_pages where autoid = 1";
	$rs  = mysql_query($sql) or die (mysql_error());
	$row = mysql_fetch_assoc($rs);
	$telephone = $row['telephone'];
	
	return $telephone;
}

function GetCheckBanner($value)
{
	if ($value=="Yes")
	{
		return "checked=checked";
	}else{
		return "";
	}
}

?>