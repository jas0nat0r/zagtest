<?php
$sqlc = "select * from " . $tblGeneralContent . " where section='footer'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$f_content = $rowc['content'];
?>

      		 <div id="about_footer">
                        <div id="about_footer_inner">	
                        	<div id="about_footer_inner_left">
                        		<div id="about_footer_menubar">
                                    <ul>
                                        <li><a href="index.php">Home |</a></li> 
                                        <li><a href="products.php">Products and Services |</a></li> 
                                        <li><a href="about_us.php">About Us |</a></li> 
                                        <li><a href="quote.php">Get a Quote |</a></li> 
                                        <li><a href="service_center.php">Client Service Center |</a></li> 
                                        <li><a href="links.php">Links |</a></li> 
                                        <li><a href="testimonials.php">Testimonials |</a></li> 
                                        <li><a href="contact_us.php">Contact Us</a></li>
                                        
                                    </ul>
                              </div><!--end of footer menu bar-->
                              
                               </div><!-- end of footer inner left --><div id="slogan">
                              	 <a href="http://eight25media.com/"><span id="about_footer_slogan"><?php echo nl2br2($f_content); ?><br/>
<span id="slogan_2">Solution by <span id="EIGHT">EIGHT25MEDIA</span></span></span></a>
                              </div><!--end of slogan-->
                                                    
                </div>
           </div><!--end of footer-->
