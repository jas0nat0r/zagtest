<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "News";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="All" />	
<meta name="author" content="www.eugein.com" />
<meta name="viewport" content="height=device-height;  "/>
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
  <script src="js/jquery-1.7.js" type="text/javascript"></script>
  
   <script type="text/javascript">//<![CDATA[
	
    	function fetchnews(){
			$('.newsleft').html('<div class="waitingimagenew"><img src="images/loadinfo.net.gif" alt="loading"/></div>');
			fetchresqntpost();
			$.post('news_front_ajax/listnews.php',function(data){
										
								//		alert(data);
										$('.newsleft').html(data);
										});
			
			
			
			}
			
		function fetchsignlenew(newsid){
				$('.newsleft').html('<div class="waitingimagenew"><img src="images/loadinfo.net.gif" alt="loading"/></div>');
				$.post('news_front_ajax/listsinglenews.php',{nwsid: ""+newsid+""},function(data){
										
								//		alert(data);
										$('.newsleft').html(data);
										});
			
			}
		function fetchresqntpost(){
		//	alert('fasfasfas');
				$.post('news_front_ajax/listresentposts.php',function(data){
										
									//	alert(data);
										$('.archivecontent').html(data);
										});
			
		}
    
    //]]></script>
</head>
<body class="home"  onload="fetchnews();">

	<div class="topsection">
    <div class="headerdropshadow"></div>
    	<div class="mainwrapper">
        	<div class="headerbackgorund">
            	<?php include("inc/inc-header.php"); ?>
            
            </div>
           
             <img src="images/companyinner.jpg" alt="slideimg"/>       
             
             <div class="innerbannertext"><b>News</b></div>    
        
		</div>
         
    </div>
  <div class="dropshadowforinner">  
    <div class="middlesection innerbackground">
    	
    </div>
 </div>
 <div class="homemidback">
  <div class="dropshadowforinnerbasic"> 
<div class="middlesection innerbackground">
  <div class="leftcolumn newsleft">
    	<h3><a href="#" class="newstitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet,
consectetur, adipisci velit</a></h3><p class="datenews">Posted on 30th August 2012 at 9:36 am</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget ligula magna, a egestas nisl. Sed turpis magna, dictum eget pulvinar at, molestie vitae turpis. Ut vitae nibh ligula, quis lobortis ligula. Nullam faucibus, lacus non dictum dignissim, lectus metus porta arcu, ut porttitor tellus arcu quis ligula. Sed vehicula posuere volutpat. Vivamus sodales sagittis est sed tincidunt. Aliquam facilisis est eget purus sagittis sollicitudin. Donec pellentesque porttitor purus, id varius ante eleifend vel. Nunc convallis neque vitae tellus venenatis at suscipit est dictum. Suspendisse tempor accumsan lorem non consequat. Morbi facilisis mi eget dui accumsan ut mattis magna accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla sit amet leo imperdiet orci viverra volutpat a quis lacus. Maecenas auctor lacinia orci, a sodales dolor ullamcorper nec. Curabitur lacus magna, interdum vitae sagittis vel, tempor a libero. <br/><br/>
        
        </p>
        
        	<h3><a href="#" class="newstitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet,
consectetur, adipisci velit</a></h3><p class="datenews">Posted on 30th August 2012 at 9:36 am</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget ligula magna, a egestas nisl. Sed turpis magna, dictum eget pulvinar at, molestie vitae turpis. Ut vitae nibh ligula, quis lobortis ligula. Nullam faucibus, lacus non dictum dignissim, lectus metus porta arcu, ut porttitor tellus arcu quis ligula. Sed vehicula posuere volutpat. Vivamus sodales sagittis est sed tincidunt. Aliquam facilisis est eget purus sagittis sollicitudin. Donec pellentesque porttitor purus, id varius ante eleifend vel. Nunc convallis neque vitae tellus venenatis at suscipit est dictum. Suspendisse tempor accumsan lorem non consequat. Morbi facilisis mi eget dui accumsan ut mattis magna accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla sit amet leo imperdiet orci viverra volutpat a quis lacus. Maecenas auctor lacinia orci, a sodales dolor ullamcorper nec. Curabitur lacus magna, interdum vitae sagittis vel, tempor a libero. <br/><br/>
        
        </p>
        
        	
    </div>
    <div class="rightcolumn">
    	<h3>Latest News</h3>
        <ul class="latestnew archivecontent">
      
      
        </ul>
    </div>
      <br class="clear"/>
      <br class="clear"/> <br class="clear"/><br class="clear"/>
    </div>
    
   
    </div> 
     </div> 
 <?php include("inc/inc-footer.php"); ?><!--end of footer-->
<?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
