<?php

include ("admin/common/common.php");

	if ($_POST['solutionid'] != '') {

    $sqls = "select * from " . $tblServices . " WHERE id=" . tosql($_POST['solutionid'], "Number");
    $rss = mysql_query($sqls) or die(mysql_error());
    $rows = mysql_fetch_array($rss);
	
		$sqlc = "select * from " . $tblServices . " where id = ".$_POST['solutionid']." and status=1";
		$rsc = mysql_query($sqlc) or die(mysql_error());
		$rowc = mysql_fetch_assoc($rsc);
		$c_content = $rowc['content'];
}
?>

  
    
          <?= $rows['title']; ?>
   
    <div class="detailsleft">
    	<img src="<?= trim($rows['imagepath'], " ../"); ?>" alt="detailimg"  class="solutionimage"/>
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
    
  