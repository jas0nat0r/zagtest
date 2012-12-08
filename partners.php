<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Company";
$childpage = "Partners";
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


</head>
<body class="home">

	<div class="topsection">
    <div class="headerdropshadow"></div>
    	<div class="mainwrapper">
        	<div class="headerbackgorund">
            	<?php include("inc/inc-header.php"); ?>
            
            </div>
           
             <img src="images/companyinner.jpg" alt="slideimg"/>       
             
             <div class="innerbannertext">our <b>Partners</b></div>    
        
		</div>
         
    </div>
  <div class="dropshadowforinner">  
    <div class="middlesection innerbackground">
    	
    </div>
 </div>
 <div class="homemidback">
  <div class="dropshadowforinnerbasic"> 
<div class="middlesection innerbackground">
  
    

 
     
     
     	<?php
						 	
							$sqlproduct = "select * from " . $tbl_prduct ." p  ORDER BY product_id ASC ";
							
							$product = mysql_query($sqlproduct) or die(mysql_error()); 
							if(mysql_num_rows($product) <= 0) {
							   echo '<div class="noproductpagination">No Links </div>';
							}else{
								$count = 1 ;
							while ($row = mysql_fetch_array($product)) {
								 
                                $autoid = $row['product_id'];
                               
                                $th_img=explode(",", $row['productimage']);		
				         			?> 
                    			
                                    <div class="<?php if($count%3==0&&$count!=""){?> solcol2<?php }else{ ?>solcol1<?php } ?> partnersheight">
                                        <h3 class="otherh3"><?php echo $row['productname']; ?></h3>
                                        <img src="<?= trim($th_img[0], " ../"); ?>" alt="solimg" class="solutionimage" />
                                         <br class="clear"/>       <br class="clear"/>
                                        
                                    </div>
                                
                                     
                                           <?php $count++; }} ?>
                                           
                                           
                                           
    
 
      <br class="clear"/>
      <br class="clear"/> <br class="clear"/><br class="clear"/>
    </div>
    
   
    </div> 
     </div> 
 <?php include("inc/inc-footer.php"); ?><!--end of footer-->
<?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
