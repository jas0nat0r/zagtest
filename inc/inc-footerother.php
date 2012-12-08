<?php
$sqlc = "select * from " . $tblGeneralContent . " where section='footer'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$f_content = $rowc['content'];
?>
<div class="bottomfooter">
 		<div class="footerwrapper">
        	<div class="bootmfind">

            <div class="contacttext">Find &amp; Follow us</div> 
            <div class="contacticons"><a href="#"><img src="images/fcbook.png" alt="facebook"/></a>
            <a href="#"><img src="images/twitter.png" alt="twitter"/></a>
            <a href="#"><img src="images/linkdin.png" alt="linkdin"/></a>
            </div>
            </div>
            
            <div class="footercopyrights" style="-webkit-text-size-adjust: none;">
            <a href="#">Home</a> | 
            <a href="#">Company</a> | 
            <a href="#">Solutions</a> | 
            <a href="#">Partners</a> | 
            <a href="#">News</a> | 
            <a href="#">Client Portal</a> | 
            <a href="#">ZAG Online Store</a> | 
            <a href="#">Contact Us</a><br/>
			&copy; ZAG Technical Services 2012. All Rights Reserved
            </div>
        </div>
 </div>