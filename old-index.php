<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Home";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG || HOME</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<script src="js/jquery-1.7.js" type="text/javascript"></script>

            <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
            <script src="js/slides.min.jquery.js" type="text/javascript"></script>


            <script type="text/javascript">

                $(document).ready(function(){
                    
                    
                    $(function(){
                        $('#slides').slides({
                            preload: true,
                            preloadImage: 'images/main.png',
                            play: 5000,
                            pause: 2500,
                            hoverPause: true
                        });
                    });
					});
				
            </script>
</head>

<body>
	<div class="topsection">
    <div class="headerdropshadow"></div>
    	<div class="mainwrapper">
        	<div class="headerbackgorund">
            	
                <?php include("inc/inc-header_home.php"); ?>
                
            
            </div>
           
          <!--   <img src="images/slideimg1.jpg" alt="slideimg"/>   -->    
             
             <div id="slides">
        	 <div class="slides_container">      
             
             
                                     <?php
							$sql = "select * from " . $tblSlider . " where status=1 Order by image_order limit 500";
                			$rs = mysql_query($sql) or die(mysql_error());
							$arr_size=mysql_num_rows($rs);
							$i=1;
                			while ($row = mysql_fetch_array($rs)) {
								
							?>  
                           
                            	 
                                    
                                    <a href="#" title="<?php echo $row['title'] ?>" >  
                                        <span class="slide_cont" style="display:block; background:url(<?= trim($row['large_image'], " ../"); ?>) no-repeat;">
                                            
                                        </span >                           
                                   </a>
                            
                                 <?php }?>
             
             
             
             
                                   
             
        </div>
              
    </div>    
        
		</div>
         
    </div>
  <div class="dropshadow">  
    <div class="middlesection">
    	<div class="homeboxes">
        	<h3>Cloud Services</h3>
            <p> 
            <ul class="homeul">
        	<li>Office 365</li>
            <li>Intune</li>
            <li>Azure</li>
       		</ul></p>
            <a href="cloudservices.php">More...</a>
        </div>
        <div class="homeboxes homemargine">
        	<h3>Virtualization</h3>
            <p><ul class="homeul">
        	<li>Hyper-V</li>
            <li>VDI</li>
             <li>Remote Access</li>
        </ul></p>
            <a href="virtualization.php">More...</a>
        </div>
        <div class="homeboxes homemargine">
        	<h3>Communications</h3>
            <p><ul class="homeul">
        	<li>Exchange</li>
            <li>Lync</li>
            <li>SharePoint</li>
            
        </ul></p>
            <a href="communications.php">More...</a>
        </div>
        <div class="homeboxes homemargine">
        	<h3>Systems Management</h3>
            <p> <ul class="homeul">
        	<li>System Center</li>
           
        </ul></p>
            <a href="system_mgt.php">More...</a>
        </div>
        <div class="homeboxes homemargine">
        	<h3>Managed Services</h3>
            <p>Custom solutions for every company’s IT needs</p>
            <a href="managed_services.php">More...</a>
        </div>
        <br class="clear"/>
    </div>
 </div>
 <div class="homemidback">
 <div class="homefooter">
  
  <div class="homefooterwidget">
  <div class="footernews">
  <h2>Newsfeed</h2>
  
  <?php $sql = "select * from " . $tblNews . " ORDER BY idnews DESC ";
					
                            $rs = mysql_query($sql) or die(mysql_error()); 
							?>

                            <?php if(mysql_num_rows($rs) <= 0) {
							   echo '<div class="noproduct">No more News to fetch</div>';
							}else{
								$row_column = mysql_fetch_array($rs);
							 	$publishdate =   date ("dS  M  Y", $row_column['publishdate'] ) ;    	
                                ?>
                    					<p><?php echo substr ($row_column['newstitle'], 0 , 100); ?>...</p>
                                       
				 						 <p class="datenews"><?php echo $publishdate;?></p>
  
                                          <a href="news.php?newsid=<?php echo $row_column['idnews'];?>">More news</a>
                                           <br class="clear"/> <br class="clear"/>
                         
                 
                                    <?php    }  ?> 
  
  
  
 </div>
 
   <div class="footernews footerawarsd">
  <h2>Awards</h2>
  <p><img src="images/homelogos.jpg" alt="logos"/></p>
  
    <br class="clear"/>
 </div>
 <br class="clear"/>
 </div>
 
 
 
 

  <br class="clear"/>
 </div>
 </div>
      
      <?php include("inc/inc-footer.php"); ?><!--end of footer-->
      
               
</body>
</html>
