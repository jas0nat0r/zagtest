<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Solutions";
$childpage = "Communications";

$sqlc = "select * from " . $tblGeneralContent . " where section='about'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$c_content = $rowc['content'];


	$sqls = "select * from " . $tblServices . " WHERE id=3";
    $rss = mysql_query($sqls) or die(mysql_error());
    $rows = mysql_fetch_array($rss);
	
		$sqlc = "select * from " . $tblServices . " where id = 3 and status=1";
		$rsc = mysql_query($sqlc) or die(mysql_error());
		$rowc = mysql_fetch_assoc($rsc);
		$c_content = $rowc['content'];

 //while ($row = mysql_fetch_array($rs)) {
 
  
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG || <?php echo $childpage; ?></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="All" />	
<meta name="viewport" content="height=device-height;  "/>
<meta name="author" content="www.eugein.com" />
<meta name="rating" content="General" />
<meta name="distribution" content="Global" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />

<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
<link href="css/style_ie6.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
  DD_belatedPNG.fix('body');
</script>
<![endif]-->


</head>
<body class="home">

	<div class="topsection">
    <div class="headerdropshadow"></div>
    	<div class="mainwrapper">
        	<div class="headerbackgorund">
            	
                
            <?php include("inc/inc-header.php"); ?>
            
            </div>
           
             <img src="images/companyinner.jpg" alt="slideimg"/>       
             
             <div class="innerbannertext">our <b>Solutions</b></div>    
        
		</div>
         
    </div>
  <div class="dropshadowforinner">  
    <div class="middlesection innerbackground">
    	
    </div>
 </div>
 <div class="homemidback">
  <div class="dropshadowforinnerbasic"> 
<div class="middlesection innerbackground">
     <h2><?= $rows['title']; ?></h2>
   
    <div class="detailsleft">
    	<img src="images/pageservimg3.jpg" alt="detailimg"  class="solutionimage"/>
    </div>
    <div class="detailsright">
   <?= stripslashes($c_content) ?>
    
    </div>
        <br class="clear"/> <br class="clear"/><br class="clear"/>
      <div class="singlesolutions">
     <br class="clear"/>
                                 <a href="solutions.php" class="newstitle" >&lt; BACK</a>
                                  <br class="clear"/>
    </div>
    
      <br class="clear"/>
      <br class="clear"/> <br class="clear"/><br class="clear"/>
    
    </div>
    
   
    </div> 
     </div> 
 <?php include("inc/inc-footer.php"); ?><!--end of footer--><?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
