<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Client Portal";
$childpage = "ZAG Online Store";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG || <?php echo $childpage; ?></title>
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

<script type="text/javascript">
(function() {
	$('.cutomerportaliframe').height( $(window).height() );	

	var	contents = $('iframe').contents(),
		body = contents.find('body'),
		styleTag = $('<style></style>').appendTo(contents.find('head'));

	$('textarea').keyup(function() {
		var $this = $(this);
		if ( $this.attr('id') === 'html') {
			body.html( $this.val() );
		} else {
			// it had to be css
			styleTag.text( $this.val() );
		}
	});

})();

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
             
             <div class="innerbannertext">Online <b>Store</b></div>    
        
		</div>
         
    </div>
<!--  <div class="dropshadowforinner">  
    <div class="middlesection innerbackground">
    	
    </div>
 </div>-->
 <div class="homemidback">
  <div class="dropshadowforinnerbasic"> 
    <div class="middlesection innerbackground">
        <div id="iframeOstore">
            <iframe scrolling="auto" src="https://usm.channelonline.com/zagtech/storesite/Login/"></iframe>
            <br class="clear"/>
            <br class="clear"/> <br class="clear"/><br class="clear"/>
        </div>    
    </div>
    
   
    </div> 
     </div> 
  <?php include("inc/inc-footer.php"); ?><!--end of footer-->
<?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
