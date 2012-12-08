<?php
include ("common/common.php");
include ("common/xmlfunctions.php");

$thumb_width = "300";      // Width of thumbnail image
$thumb_height = "122";
$upload_dir = '../images/linksimg';

//include ("common/imagemanipulation.php");
include("common/image_functions.php");

?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administration</title>
    	<link media="all" type="text/css" href="js/dil_jquery-ui.css" rel="stylesheet"/>
		<script type="text/javascript" src="js/dil_jquery.min.js"></script>
        
        
         <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
     
       



       
        <link href="css/datepicke.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/body.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/dropdowntabs.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
          <script type="text/javascript" src="wymeditor/jquery.wymeditor.min.js"></script>
   
       
      
       
	
               
       
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


          
 <script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload1');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				//alert(response);
				if(response==="success"){
					$('#files').html('<img src="../images/linksimg/'+file+'" alt="" />').addClass('success');
					$('.dil_product_add').append('<input type="hidden" name="uploadurl" class="uploadurl" value="'+file+'"/>');
					
					
					
				} else{
					$('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>


        <script type="text/javascript">
          
			
			function dil_edit_form_fetch(product_id){
				
				$.post("product_ajax/editproduct_ajax.php", {proid: ""+product_id+""}, function(data){
  				$('#ajaxt_editform'+product_id+'').html(data);
				$('#ajaxt_editform'+product_id+'').slideDown("slow");
				pageLoad(product_id);
				});
								
				}
			 function dilcloseajax_form(product_id){
				$('#ajaxt_editform'+product_id+'').slideUp("slow");   
				
				}
				
			function dil_update_product(product_id ,category_id){
			//alert(product_id);
				$.post("product_ajax/editproduct_ajax_form.php", $("form.dil_edit_product_details"+product_id+"").serialize(), function(data){
  				//$suc_msg = data;
		//		dilcloseajax_form(product_id);
			//	location.reload();
	//alert(data);
				if(data=='pass'){
				$('.NormalGreenSmall').html('Susscefully Updated'); 
				$('.NormalRedSmall').html('');
				dil_clearmeassages();
				
				}else{
				$('.NormalRedSmall').html('Please Check Fields Again');
				$('.NormalGreenSmall').html(''); 
				dil_clearmeassages();
				}
				});
				dil_filtercategory(category_id);
			
			}
			function dil_filtercategory(category_id){
				 
					$('#dil_fetch_list').html('<img class="loadignclass" src="images/loadinfo.net.gif" alt="lodading"/>');
					$.post("product_ajax/listproduct_items_ajax.php", {catid: ""+category_id+""}, function(data){
  					
					
					//alert(data);
					if(data=='No_data'){
						$('#dil_fetch_list').html('<div class="noproduct">No Products Under this Category</div>');
					}else{
						
						$('#dil_fetch_list').html('<ul id="list">'+data+'</ul>');
						}
					//$('#ajaxt_editform'+product_id+'').slideDown("slow");
				});
			}
			
			function dil_fillsearch(text_string){
				
							
				$.post("product_ajax/fetch_product_names.php", {searchkeyword: ""+text_string+""}, function(data){
																							   
  							if(data.length >0) 
                {
					
					$('.suggetion').css('display', 'block');
					  namesAry = new Array();
                      namesAry = data.split(",");
                      namesAry = namesAry.join('","');
                      namesAry = data.split(",");
                   //  alert( namesAry)
   
                     $('.suggetion').html(data);
               
                }else{
					$('.suggetion').css('display', 'none');
					
					}
				});
				
				}
				
				function dil_searchvalue(searchvalue){
					
					$('#prductname_search').val(searchvalue);
					$('.suggetion').css('display', 'none');
					
					$('.NormalGreenSmall').html(''); 
					$('.NormalRedSmall').html('');
					$.post("product_ajax/searchproduct_items_byname.php", {srchstring: ""+searchvalue+""}, function(data){
  					$('#dil_fetch_list').html('<img class="loadignclass" src="images/loadinfo.net.gif" alt="lodading"/>');
					
					//alert(data);
					if(data=='No_data'){
						$('#dil_fetch_list').html('<div class="noproduct">No Products Under this Category</div>');
					}else{
						
						$('#dil_fetch_list').html('<ul id="list">'+data+'</ul>');
						}
					
							
					
				});		
					
					}
					
				function dil_addproduct(){
					
					  	$.post("product_ajax/addproduct_ajax.php", $("form.dil_product_add").serialize() ,  function(data){
  				//alert(data);
						if(data=="pass"){
						$('#NormalGreenSmalladd').css('display', 'block'); 
				    $('#NormalGreenSmalladd').html('Susscefully Added');
					$('#prdname').val('');
					$('#prddescription').val('');
					$('#prdurl').val('');
                                        $('#OutputC').val('');
                                        $('#OutputV').val('');
                                        $('#InitialT').val('');
                                        $('#PackageA').val('');
                                        $('#DropoutV').val('');
                                        $('#OperatingT').val('');

					$('#upload_status2').css('display', 'none');
					$('#uploaded_image2').css('display', 'none');
					}else{ 
					$('#NormalRedSmalladd').css('display', 'block');
				    $('#NormalRedSmalladd').html('Please Check Fields Again');
					
					}
					
					setTimeout(function() {
				   $('#NormalGreenSmalladd').css('display', 'none'); 
				   $('#NormalRedSmalladd').css('display', 'none');
                   $('#NormalGreenSmalladd').html('');
                   $('#NormalRedSmalladd').html('');
                     }, 3000); 
					dil_filtercategory('*');
				});
					
					} 
				
				function morefields(){
					
				$.post('product_ajax/fetchmorefields.php', function(data){
									
						$('.dil_fetchaddmorefields').html(data);
				$('.dil_fetchaddmorefields').slideDown("slow");			//	alert(data)
									});	
			
					}
				function dil_deleteproduct(product_id, category_id){
				
				var r=confirm("Are You Sure you want to delete?");
				if (r==true)
				  {				
				$.post("product_ajax/deleteproduct_ajax.php", {proid : ""+product_id+""}, function(data){
  				
		//alert(category_id);
				if(data=='pass'){
				$('.NormalGreenSmall').html('Category Deleted Sucessfully'); 
				$('.NormalRedSmall').html('');
				dil_clearmeassages();
				}else{
				$('.NormalRedSmall').html('Please Delete Products Under this Category');
				$('.NormalGreenSmall').html(''); 
				dil_clearmeassages();
				}
				});
				dil_filtercategory(category_id);
				 }	
				
				
				}
			
				function dil_clearmeassages(){
					setTimeout(function() {
				$('.NormalRedSmall').html('');
				$('.NormalGreenSmall').html(''); 
                     }, 3000);
				}
        </script>

        <script type="text/javascript">
            function changeColor(id, color) {
                element = document.getElementById(id);
                element.style.background = color;
            }
			
			
			function pageLoad(proid) {
				
				
			

					$('.suggetion').keydown(function(e){
						if (e.keyCode == 38) {
						   $('#prductname_search').focus();   
						}    
						if (e.keyCode == 40) {
						  $('#prductname_search').focus();   
						}
						//alert ("hghgh");
					});
				
     $(function() {
	
                $("#list").sortable({ opacity: 0.6, cursor: 'move',handle : '.handle', update: function() {
                        var order = $(this).sortable("serialize") + '&action=updateRecordsListings&cid=1'; 
                        $.post("portfolio_order.php", order, function(theResponse){
                            //$("#contentRight").html(theResponse);
                        }); 												 
                    }								  
                });		
            });
	 
	 
	 	$(function(){
		var btnUpload=$('#upload2');
		var status=$('.status'+proid);
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				//alert(response);
				if(response==="success"){
					$('.files'+proid).html('<a href="../productfiles/'+file+'"><img src="../images/pdfimage.png" alt="" />'+file+'</a>').addClass('success');
					$('.editformcurrentfileurl'+proid).html('<input type="hidden" name="uploadurl" class="uploadurl" value="'+file+'"/>');
					
					
					
				} else{
					$('.files'+proid).text(file).addClass('error');
				}
			}
		});
		
	});
	 
	 
	 
	 
            }
        </script>




        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="uploader/swfobject.js"></script>






    </head>
    <?php include ("inc/header.php"); ?>
        <body  onLoad="dil_filtercategory('*');">
       
        <div class="dil_pagewrp_product"><div class="dil_product_wrapper">
        
        
         <div class="dil_prodcuttitle">Add Links</div>
         <div class="NormalGreenSmall addcategorymargin" id="NormalGreenSmalladd"></div>
        <div class="NormalRedSmall addcategorymargin" id="NormalRedSmalladd"> </div>
        <br class="clear"/><br class="clear"/><form name="dil_product_add" class="dil_product_add" action="<?= $PHP_SELF; ?>" method="post">
        <div class="dil_prodcutlable">Link Name :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdname" id="prdname" class="catinputclass"/></div><br class="clear"/>
         <div class="dil_prodcutlable">Link URL :</div>
        <div class="dil_prodcutinput"><input type="text" name="prdurl" id="prdurl" class="catinputclass"/></div><br class="clear"/>
        <div class="dil_prodcutlable">Link Description :</div>
        <div class="dil_prodcutinput"><textarea name="prddescription" id="prddescription" class="catinputclasstextarea"></textarea></div><br class="clear"/>
             <div class="dil_prodcutlable">Link Image :</div>
         <div class="dil_prodcutinput">
        <div id="upload1" ><span>Upload File<span></div><span id="status" ></span>
		
		<div id="files" ></div>
        
        </div><br class="clear"/>  <div id="leftimage_cont2"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Add"  class="dil_inputbuttons" name="submit"  onClick="dil_addproduct();"/><input type="reset" name="catname" id="catname" class="dil_inputbuttons"  value="Cancel" onClick=""/></div><br class="clear"/>
        </form>
         <div id="thumbnail_form2" style="display:none; width: 100%; height: auto; float: left;">
                                                                <form name="form" action="" method="post">
                                                                    <input type="hidden" name="x1" value="" id="x1" />
                                                                    <input type="hidden" name="y1" value="" id="y1" />
                                                                    <input type="hidden" name="x2" value="" id="x2" />
                                                                    <input type="hidden" name="y2" value="" id="y2" />
                                                                    <input type="hidden" name="w" value="" id="w" />
                                                                    <input type="hidden" name="h" value="" id="h" />
                                                                    <div style="width: 100%; height: auto;">
                                                                        <input type="button" name="save_thumb"  value="Save Thumbnail" id="save_thumb2" class="btn thumbnailposiotion" />
                                                                    </div>
                                                                   
                                                                </form>
                                                                                                                                
                                                            </div>
        
        
        <div class="dil_prodcuttitle">View Links</div>
        <br class="clear"/><br class="clear"/>
        <div class="filterdiv">
        <div class="filetrby">Search By Link Name :-</div>
        <div class="selectdiv"><input type="text" name="prductname_search" class="prductname_search" id="prductname_search" onKeyUp="dil_fillsearch(this.value)"/>
        </div>
        <div class="suggetion"></div>
        
        </div>
        <br class="clear"/><br class="clear"/>
        <table width="892" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td align="center" valign="top"><form method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <table width="95%" border="0">
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
                   
                        </table>




        <form action="" method="post" name="frmfaq">
            <table width="95%" border="0">

            </table>
            <table width="90%" border="0" align="center">

                <tr>
                    <td  valign="middle" class="SubHead" width="40">&nbsp;</td>
                    <td  valign="middle" class="SubHead" width="358"><strong>Link Image</strong></td>
                    <td  valign="middle" class="SubHead" width="303"><strong>Link Name</strong></td>
                    <td  valign="middle" class="SubHead" width="350"><strong></strong></td> 

                    <td  class="SubHead"  width="195"><strong>Options</strong></td>
                </tr>
            </table>
            <table width="95%" border="0" align="center">
                <tr>
                    <td height="30" valign="middle" class="SubHead" id="dil_fetch_list" >

                       
                    </td>
                </tr>
            </table>
        </form>






    </td>
</tr>
</table><br class="clear"/></div></div>
        <?php include ("footer.php"); ?>
    </body>
</html>