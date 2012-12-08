<?php 
include ("common/common.php");
$cid = mysql_real_escape_string($_POST['cid']);
$action 				= mysql_real_escape_string($_POST['action']); 
$updateRecordsArray 	= $_POST['recordsArray'];

if ($action == "updateRecordsListings"){
	
	$listingCounter = 1;
	foreach ($updateRecordsArray as $recordIDValue) {
		
		$query = "UPDATE ".$tblGallery." SET image_order = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
}

?>
<div style="width:940px; height:300px; float:left;overflow:scroll; position:relative; padding:0;margin: 0;">
                    <ul id="list">
                    <?php
                    $i = 1;
                    $sql = "select * from ".$tblGallery." Where cid=".$cid." Order by image_order";
                    $rs  = mysql_query($sql) or die (mysql_error());
                    while( $row = mysql_fetch_array($rs)) { 
                        $id = $row['id'];
                        $images = $row['images'];
                    ?>         
                    
                        <li id="recordsArray_<?php echo $id ?>">
                            <div class="handle"><img src="../images/gallery/<?php echo "t_".$images ?>" /></div>
                            <div class="del"><img src="images/del.png" width="20" height="20" onClick="Delete(<?php echo $id ?>);"></div>   
                            <div class="number"><?php echo $i ?></div>     
                        </li>                
                    <?php
                        $i++;
                    }
                    ?>   
                    </ul>
   			</div>
<script type="text/javascript">	
	// sorting
	$(function() {
		$("#list").sortable({ opacity: 0.6, cursor: 'move',handle : '.handle', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings&cid=<?php echo $cid ?>'; 
			$.post("photo_gallery_order.php", order, function(theResponse){
				$("#thumbContent").html(theResponse);
			}); 												 
		}								  
		});		
	});

</script>