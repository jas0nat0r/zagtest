<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$thumb_width = "300";      // Width of thumbnail image
$thumb_height = "122";
$upload_dir = '../images/products/products_main';

//include ("common/imagemanipulation.php");
include("common/image_functions.php");

switch ($_REQUEST['action']) {
    case 'd':
        $sql = "UPDATE " . $tblProductsMain . " SET" .
                " status = 0" .
                " WHERE id=" . tosql($_REQUEST['id'], "Number");
        mysql_query($sql) or die(mysql_error());
        $suc_msg = 'Image deleted sucessfully';

        break;
}


$Submit = $_REQUEST['Submit'];



switch ($Submit) {

    case "Add":

 			$img_order = $_REQUEST["slide_image"];
			$img_large = $_REQUEST["large_image"];
		
			
	
 
        for ($i = 0; $i < sizeof($img_order); $i++) {

        $sql = "INSERT INTO " . $tblProductsMain . "(image,banner_title,large_image) VALUES (\"" .
                $img_order . "\"," .
				"\"" . $_REQUEST['banner_title'] . "\"," .
                "\"" . $img_large . "\")";

        mysql_query($sql) or die(mysql_error());
		}
        $suc_msg = 'Image banner added sucessfully';
        break;
		case "Update":
        $s_description = addslashes($_REQUEST['description']);
        $sql = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $s_description . "\"" .
                " WHERE autoid=" . tosql(6, "Number");
        mysql_query($sql) or die(mysql_error());
		
		$s_description2 = addslashes($_REQUEST['description2']);
        $sql2 = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $s_description2 . "\"" .
                " WHERE autoid=" . tosql(10, "Number");
        mysql_query($sql2) or die(mysql_error());
		
		$mailadd = $_REQUEST['mailadd'];
        $sql3 = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $mailadd . "\"" .
                " WHERE autoid=" . tosql(11, "Number");
        mysql_query($sql3) or die(mysql_error());
		
		$fbid = $_REQUEST['fbid'];
        $sql4 = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $fbid . "\"" .
                " WHERE autoid=" . tosql(12, "Number");
        mysql_query($sql4) or die(mysql_error());
		
		$twid = $_REQUEST['twid'];
        $sql5 = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $twid . "\"" .
                " WHERE autoid=" . tosql(13, "Number");
        mysql_query($sql5) or die(mysql_error());
		
		$linkid = $_REQUEST['linkid'];
        $sql6 = "UPDATE " . $tblGeneralContent . " SET" .
                " content = \"" . $linkid . "\"" .
                " WHERE autoid=" . tosql(14, "Number");
        mysql_query($sql6) or die(mysql_error());
		
        $suc_msg = 'Updates were saved sucessfully';
        break;
}

include("fckeditor/fckeditor.php");
$sBasePath = $_SERVER['PHP_SELF'];
$sBasePath = substr($sBasePath, 0, strpos($sBasePath, "admin")) . "admin/fckeditor/";

$sqlc = "select * from " . $tblGeneralContent . " where section='contact'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$c_content = $rowc['content'];

$sqlc2 = "select * from " . $tblGeneralContent . " where section='contact-add2'";
$rsc2 = mysql_query($sqlc2) or die(mysql_error());
$rowc2 = mysql_fetch_assoc($rsc2);
$c_content2 = $rowc2['content'];

$sqlc3 = "select * from " . $tblGeneralContent . " where section='contact-mailadd'";
$rsc3 = mysql_query($sqlc3) or die(mysql_error());
$rowc3 = mysql_fetch_assoc($rsc3);
$c_content3 = $rowc3['content'];

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


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administration</title>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
        <script type="text/javascript" src="js/jquery.ocupload-packed.js"></script>



        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
        <link href="css/datepicke.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/body.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/dropdowntabs.js"></script>
        <script type="text/javascript" src="js/common.js"></script>

<!-- WYMeditor main JS file, minified version -->
        <script type="text/javascript" src="wymeditor/wymeditor/jquery.wymeditor.min.js"></script>
        <script type="text/javascript">

            /* Here we replace each element with class 'wymeditor'
             * (typically textareas) by a WYMeditor instance.
             * 
             * We could use the 'html' option, to initialize the editor's content.
             * If this option isn't set, the content is retrieved from
             * the element being replaced.
             */

            jQuery(function() {
                jQuery('.wymeditor').wymeditor();
            });

        </script>     
        <script type="text/javascript">
            function Delete(autoid)
            {
                var userreq=confirm('Are you sure you want to delete ?');
                if (userreq==true)
                {	
                    window.location='rental_aircraft.php?Submit=delete&autoid='+autoid;
                }
            }
        </script>
        <link rel="stylesheet" type="text/css" href="css/ddimgtooltip.css" />
        <script type="text/javascript" src="js/ddimgtooltip.js">
            /***********************************************
             * Image w/ description tooltip v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
             * This notice MUST stay intact for legal use
             * Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
             ***********************************************/
        </script>
        <style>

            #list {
                margin: 0;
            }


            #list li {
                list-style: none;
                margin: 0;
                padding:0;	

            }

        </style>



        <script type="text/javascript">
            $(function() {
	
                $("#list").sortable({ opacity: 0.6, cursor: 'move',handle : '.handle', update: function() {
                        var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
                        $.post("winner_order.php", order, function(theResponse){
                            //$("#contentRight").html(theResponse);
                        }); 												 
                    }								  
                });		
            });


        </script>

        <script type="text/javascript">
            function changeColor(id, color) {
                element = document.getElementById(id);
                element.style.background = color;
            }
        </script>

        <script type="text/javascript">
            //<![CDATA[

            //create a preview of the selection
            function preview(img, selection) { 
                //get width and height of the uploaded image.
                var current_width = $('#uploaded_image').find('#thumbnail').width();
                var current_height = $('#uploaded_image').find('#thumbnail').height();

                var scaleX = <?php echo $thumb_width; ?> / selection.width; 
                var scaleY = <?php echo $thumb_height; ?> / selection.height; 
	
                $('#uploaded_image').find('#thumbnail_preview').css({ 
                    width: Math.round(scaleX * current_width) + 'px', 
                    height: Math.round(scaleY * current_height) + 'px',
                    marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
                    marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
                });
                $('#x1').val(selection.x1);
                $('#y1').val(selection.y1);
                $('#x2').val(selection.x2);
                $('#y2').val(selection.y2);
                $('#w').val(selection.width);
                $('#h').val(selection.height);
            } 

            //show and hide the loading message
            function loadingmessage(msg, show_hide){
                if(show_hide=="show"){
                    $('#loader').show();
                    $('#progress').show().text(msg);
                    $('#uploaded_image').html('');
                }else if(show_hide=="hide"){
                    $('#loader').hide();
                    $('#progress').text('').hide();
                }else{
                    $('#loader').hide();
                    $('#progress').text('').hide();
                    $('#uploaded_image').html('');
                }
            }

           

            $(document).ready(function () {
                $('#loader').hide();
                $('#progress').hide();
                var myUpload = $('#upload_link').upload({
                    name: 'image',
                    action: '<?= $image_handling_file ?>?tw=<?= $thumb_width ?>&th=<?= $thumb_height ?>&p=<?= $upload_dir ?>',
                    enctype: 'multipart/form-data',
                    params: {upload:'Upload'},
                    autoSubmit: true,
                    onSubmit: function() {
                        $('#upload_status').html('').hide();
                        loadingmessage('Please wait, uploading file...', 'show');
                    },
                    onComplete: function(response) {
                        
                        loadingmessage('', 'hide');
                        response = unescape(response);
                        var response = response.split("|");
                        var responseType = response[0];
                        var responseMsg = response[1];
                        if(responseType=="success"){
                            var current_width = response[2];
                            var current_height = response[3];
                            //display message that the file has been uploaded
                            $('#upload_status').show().html('The image has been uploaded. Click and drag to select the cropping area on the image');
                            //put the image in the appropriate div
                            $('#uploaded_image').html('<img src="'+responseMsg+'" style="margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" /><div style="float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width; ?>px; height:<?php echo $thumb_height; ?>px;"><br/><br/>Cropped Image : <br/><img src="'+responseMsg+'" style="position: relative;" id="thumbnail_preview" alt="Thumbnail Preview" /></div>')
                            //find the image inserted above, and allow it to be cropped
                            $('#uploaded_image').find('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height / $thumb_width; ?>', onSelectChange: preview }); 
                            //display the hidden form
                            $('#thumbnail_form').show();
                        }else if(responseType=="error"){
                            $('#upload_status').show().html('Error<br/>'+responseMsg+'');
                            $('#uploaded_image').html('');
                            $('#thumbnail_form').hide();
                        }else{
                            $('#upload_status').show().html('Unexpected Error<br/>Please try again');
                            $('#uploaded_image').html('');
                            $('#thumbnail_form').hide();
                        }
                    }
                });
	
                //create the thumbnail
                $('#save_thumb').click(function() {
                    var x1 = $('#x1').val();
                    var y1 = $('#y1').val();
                    var x2 = $('#x2').val();
                    var y2 = $('#y2').val();
                    var w = $('#w').val();
                    var h = $('#h').val();
                    if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                        alert("You must make a selection first");
                        return false;
                    }else{
                        //hide the selection and disable the imgareaselect plugin
                        $('#uploaded_image').find('#thumbnail').imgAreaSelect({ disable: true, hide: true }); 
                        loadingmessage('Please wait, saving thumbnail....', 'show');
                        $.ajax({
                            type: 'POST',
                            url: '<?= $image_handling_file ?>?tw=<?= $thumb_width ?>&th=<?= $thumb_height ?>&p=<?= $upload_dir ?>',
                            data: 'save_thumb=Save Thumbnail&x1='+x1+'&y1='+y1+'&x2='+x2+'&y2='+y2+'&w='+w+'&h='+h,
                            cache: false,
                            success: function(response){
                                loadingmessage('', 'hide');
                                response = unescape(response);
                                var response = response.split("|");
                                var responseType = response[0];
                                var responseLargeImage = response[1];
                                var responseThumbImage = response[2];
                                if(responseType=="success"){
                                    $('#upload_status').show().html('The thumbnail has been saved');
                                    //load the new images
                                    $('#uploaded_image').html('<br/>Cropped Image :<br/><img src="'+responseThumbImage+'" alt="Thumbnail Image"/>');
                                    //hide the thumbnail form
                                    //leftimage_cont
                                    //$('#leftimage_cont').html(responseThumbImage);
                                    $('#leftimage_cont').html('<input type="hidden" name="slide_image" value="'+responseThumbImage+'" /><input type="hidden" name="large_image" value="'+responseLargeImage+'" />');
									
									
                                    //save_form
                                    $('#save_form').css('display', 'block');
                                    
                                    $('#thumbnail_form').hide();
                                }else{
                                    $('#upload_status').show().html('<h1>Unexpected Error</h1><p>Please try again</p>'+response);
                                    //reactivate the imgareaselect plugin to allow another attempt.
                                    $('#uploaded_image').find('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height / $thumb_width; ?>', onSelectChange: preview }); 
                                    $('#thumbnail_form').show();
                                }
                            }
                        });
			
                        return false;
                    }
                });
            }); 


            //]]>
        </script>


        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="uploader/swfobject.js"></script>




    </head>
    <body >
        <?php include ("inc/header.php"); ?>
        <table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <table width="95%" border="0" bgcolor="#98B3CE">
                            <tr>
                                <td colspan="3"><span class="DotLine">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</span></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="heading">Contact Details</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <span class="NormalGreenSmall">
                                        <? if (isset($suc_msg) && $suc_msg != '')
                                            echo $suc_msg; ?>
                                    </span><br/>
                                    <span class="NormalRedSmall">
                                        <? if (isset($error_msg) && $error_msg != '')
                                            echo $error_msg; ?>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="heading"></td>
                            </tr>
                            <tr>
                                <td colspan="3">

                                    <form method="post" name="form1" id="form1">
                                        <table width="90%" border="0">
                                            <tr>
                                                <td colspan="2" height="30"></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" class="heading">Edit Contact</td>
                                            </tr>

                                            <tr>
                                                <td width="17%" valign="top">&nbsp;</td>
                                                <td width="83%" class="NormalRedSmall">&nbsp;</td>
                                            </tr>


											<tr>
                                                <td valign="top" class="Normal">Mail address</td>
                                                <td>
                                                    <input type="text" name="mailadd" value="<?= $c_content3 ?>"/>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td valign="top" class="Normal">Facebook id</td>
                                                <td>
                                                    <input type="text" name="fbid" value="<?= $c_content4 ?>"/>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td valign="top" class="Normal">Twitter id</td>
                                                <td>
                                                   <input type="text" name="twid" value="<?= $c_content5 ?>"/>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td valign="top" class="Normal">Linkdin id</td>
                                                <td>
                                                    <input type="text" name="linkid" value="<?= $c_content6 ?>"/>
                                                </td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td valign="top" class="Normal">Address One</td>
                                                <td>
                                                    <textarea class="wymeditor" name="description"><?= stripslashes($c_content) ?></textarea>
                                                </td>
                                            </tr>
                                            
                                               <tr>
                                                <td valign="top" class="Normal">Address Two</td>
                                                <td>
                                                    <textarea class="wymeditor" name="description2"><?= stripslashes($c_content2) ?></textarea>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><input type="hidden" name="n_id" value="<?= $rowc['id']; ?>" /></td>
                                                <td align="right"><input type="submit" value="Update" class="btn wymupdate" name="Submit"/></td>
                                            </tr>

                                        </table>
                                    </form>

                                </td>
                            </tr>
                            
                </td>
            </tr>
        </table>
        <?php include ("footer.php"); ?>
    </body>
</html>