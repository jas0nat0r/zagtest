<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Solutions";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG || <?php echo $pageName; ?></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="All" />	
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
<script type="text/javascript" src="js/jquery-1.7.js"></script>

<script type="text/javascript">

<?php 
	if(isset($_GET['id'])){ ?>
			fetchcontent(<?php echo $_GET['id'];?>);
<?php 		}else{
	
$sqlc = "select * from " . $tblGeneralContent . " where autoid = 9 ";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$c_content = $rowc['content'];

}
?>
	function fetchcontent(solid){
		//alert(solid);	
		
		$('.fetchcontent').html('<div class="waitingimagenew"><img src="images/loadinfo.net.gif" alt="loading"/></div>');
		$.post('solutiondetails.php', {solutionid: ""+solid+""}, function(data){
			//alert(data);
			$('.fetchcontent').html(data);
			});
	}
</script>
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
<div class="middlesection innerbackground fetchcontent">
  
    
<?= stripslashes($c_content) ?>
    </div>
    
   
    </div> 
     </div> 
<?php include("inc/inc-footer.php"); ?><!--end of footer--><?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
