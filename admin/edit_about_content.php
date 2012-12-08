<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$thumb_width = "120";      // Width of thumbnail image
$thumb_height = "100";
$upload_dir = '../images/featured';

//include ("common/imagemanipulation.php");
include("common/image_functions.php");


$Submit = $_REQUEST['Submit'];



switch ($Submit) {
    case "Update":
        $_image = $_REQUEST['slide_image'];
		$img_large = $_REQUEST["large_image"];


        $sql = "UPDATE " . $tblAbout . " SET" .
               " image = \"" . $_image . "\"" .
               " ,title = \"" . $_REQUEST['title'] . "\"" .
			   " ,large_image = \"" . $img_large . "\"" .
			   " WHERE id=" . tosql($_REQUEST["item_id"], "Number");
			  
        mysql_query($sql) or die(mysql_error());

        $suc_msg = 'Details updated sucessfully';
        break;
}

include("fckeditor/fckeditor.php");
$sBasePath = $_SERVER['PHP_SELF'];
$sBasePath = substr($sBasePath, 0, strpos($sBasePath, "admin")) . "admin/fckeditor/";

$p_id = $_REQUEST['id'];

if ($p_id != '') {

    $sqls = "select * from " . $tblAbout . " WHERE id=" . tosql($p_id, "Number");
    $rss = mysql_query($sqls) or die(mysql_error());
    $rows = mysql_fetch_array($rss);
} else {
    header("Location:edit_about_content.php");
}
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administration</title>
        <link href="css/body.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
        <link href="css/text_editor.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/dropdowntabs.js"></script>
        <script type="text/javascript" src="js/common.js"></script>

        <script type="text/javascript" src="js/jquery-pack.js"></script>
        <script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
        <script type="text/javascript" src="js/jquery.ocupload-packed.js"></script>

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
                        <table width="95%" border="0">
                            <tr>
                                <td colspan="3"><span class="DotLine">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</span></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="heading">Home</td>
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
                                <td colspan="3">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="NormalRedSmall"><?php echo $msg ?>&nbsp;</td>
                                            <td class="NormalRedSmall">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">

                                                <table  border="0" width="100%">

                                                    <tr>
                                                        <td colspan="2" class="heading">Edit About Image details</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" valign="top">&nbsp;</td>
                                                        <td class="NormalRedSmall">&nbsp;</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td valign="top" class="NormalDisabled">Image&nbsp;&nbsp;</td>
                                                        <td align="left" valign="top" class="Normal">
                                                            Current:
                                                            <br/>
                                                        
                                                                <img src="<?= $rows['image'] ?>" width="200" height="119" />
                                                                                                                          
                                                            
                                                            <br/><br/>
                                                            <div id="upload_status" ></div>
                                                            <a id="upload_link" class="links" href="#">Click here to upload a new image</a>
                                                            <span id="loader" style="display:none;"><img src="loader.gif" alt="Loading..."/></span> <span id="progress"></span>
                                                            <br />
                                                            <div id="uploaded_image"></div>
                                                            <div id="thumbnail_form" style="display:none; width: 100%; height: auto; float: left;">
                                                                <form name="form" action="" method="post">
                                                                    <input type="hidden" name="x1" value="" id="x1" />
                                                                    <input type="hidden" name="y1" value="" id="y1" />
                                                                    <input type="hidden" name="x2" value="" id="x2" />
                                                                    <input type="hidden" name="y2" value="" id="y2" />
                                                                    <input type="hidden" name="w" value="" id="w" />
                                                                    <input type="hidden" name="h" value="" id="h" />
                                                                    <div style="width: 100%; height: auto;">
                                                                        <input type="submit" name="save_thumb" value="Save Thumbnail" id="save_thumb" class="btn" />
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>	


                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td></td>
                                                    </tr>

                                                </table>



                                            </td>


                                        </tr>
                                        <tr>

                                            <td colspan="2">

                                                <div id="save_form">
                                                    <form action="" method="post">
                                                        <table  border="0" width="100%">                                                        
                                                            <tr>
                                                                <td  valign="top">&nbsp;</td>
                                                                <td  class="NormalRedSmall">&nbsp;</td>
                                                            </tr>

                                                            <tr>
                                                                <td valign="top" class="NormalDisabled" width="150">Image Title</td>
                                                                <td align="left" valign="top" class="Normal"><input type="text" name="title" value="<?= $rows['title']; ?>"/></td>
                                                            </tr>
                                                            

                                                            <tr>
                                                                <td valign="top" class="NormalDisabled"></td>
                                                                <td align="left" valign="top" class="Normal">
                                                                    <div id="leftimage_cont">
                                                                        <input type="hidden" name="slide_image" value="<?= $rows['image']; ?>" />
                                                                        <input type="hidden" name="large_image" value="<?= $rows['large_image']; ?>" />
                                                                    </div>
                                                                    <input type="hidden" name="item_id" value="<?= $rows['id']; ?>" />
                                                                    <input type="submit" value="Update" class="btn" name="Submit"/>
                                                                </td>
                                                            </tr>

                                                        </table>

                                                    </form>
                                                </div>
                                            </td>

                                        </tr>

                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td width="18%">&nbsp;</td>
                                <td width="164%" colspan="2">&nbsp;</td>
                            </tr>
                        </table>


                </td>
            </tr>
        </table>
        <?php include ("footer.php"); ?>
    </body>
</html>