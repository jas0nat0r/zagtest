<?php
$sqlc = "select * from " . $tblGeneralContent . " where section='footer'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$f_content = $rowc['content'];


$sqlc4 = "select * from " . $tblGeneralContent . " where section='contactus-fbid'";
$rsc4 = mysql_query($sqlc4) or die(mysql_error());
$rowc4 = mysql_fetch_assoc($rsc4);
$c_content4 = $rowc4['content'];

$sqlc5 = "select * from " . $tblGeneralContent . " where section='contact-twid'";
$rsc5 = mysql_query($sqlc5) or die(mysql_error());
$rowc5 = mysql_fetch_assoc($rsc5);
$c_content5 = $rowc5['content'];

$sqlc6 = "select * from " . $tblGeneralContent . " where section='contactus-linkid'";
$rsc6 = mysql_query($sqlc6) or die(mysql_error());
$rowc6 = mysql_fetch_assoc($rsc6);
$c_content6 = $rowc6['content'];


?>
<div class="bottomfooter ">
 		<div class="footerwrapper">
        	<div class="bootmfind">

            <div class="contacttext">Find &amp; Follow us</div> 
            <div class="contacticons"><a href="http://www.facebook.com/<?= $c_content4 ?>"><img src="images/fcbook.png" alt="facebook"/></a>
            <a href="http://twitter.com/<?= $c_content5 ?>"><img src="images/twitter.png" alt="twitter"/></a>
            <a href="http://www.linkedin.com/company/<?= $c_content6 ?>"><img src="images/linkdin.png" alt="linkdin"/></a>
            </div>
            </div>
            
            <div class="footercopyrights" style="-webkit-text-size-adjust: none;">
          <?php
          
            $sql = "select * from " . $tblMainPages . "  Order by page_order Asc ";
            $rs = mysql_query($sql) or die(mysql_error()); 
            $count =0;
            while ($row = mysql_fetch_array($rs)) {                
                $page_name = $row['page_name'];
                $page_url = $row['page_url'];                               

                ?>
         <a <? if($page_name==$pageName)echo'class="footercurrent"';?> href="<?=$page_url;?>" ><?=$page_name = $row['page_name'];?></a>
         <?php if($count!=7){ ?>
         |
         <?php } ?>
            <?php
			$count++;
            }
                
            ?>     
            <br/>
			&copy; ZAG Technical Services 2012. All Rights Reserved
            </div>
        </div>
 </div>