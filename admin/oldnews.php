<?php
include ("common/common.php");
include ("common/xmlfunctions.php");



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
          


          
			
			function dil_edit_form_fetch(category_id){
				
				$.post("news_ajax/editnews_ajax.php", {catid : ""+category_id+""}, function(data){
  				$('#ajaxt_editform'+category_id+'').html(data);
				$('#ajaxt_editform'+category_id+'').slideDown("slow");
				pageLoad();
				});
								
				}
			 function dilcloseajax_form(category_id){
				$('#ajaxt_editform'+category_id+'').slideUp("slow");   
				
				}
				
			function dil_update_category(category_id){
				
				$.post("news_ajax/editnews_ajax_form.php", $("form.dil_edit_category_details"+category_id+"").serialize(), function(data){
  				//$suc_msg = data;
				dilcloseajax_form(category_id);
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
				dil_filtercategory();
			
			}
			function dil_filtercategory(){
				  	$.post("news_ajax/listnews_ajax.php",  function(data){
  					$('#dil_fetch_list').html('<img class="loadignclass" src="images/loadinfo.net.gif" alt="lodading"/>');
					
					//alert(data);
					if(data==""){
						$('#dil_fetch_list').html('<div class="noproduct">You Have Not added any News</div>');
					}else{
						
						$('#dil_fetch_list').html('<ul id="list">'+data+'</ul>');
						}
					//$('#ajaxt_editform'+product_id+'').slideDown("slow");
				});
			}
			
			function diladdnewcategory(){
				  	$.post("news_ajax/addnews_ajax.php", $("form.dil_category_add").serialize() ,  function(data){
  					//alert(data);
						if(data=="pass"){
					$('#NormalGreenSmalladd').css('display', 'block'); 
				    $('#NormalGreenSmalladd').html('Susscefully Added');
					$('#catname').val('');
					$('#catdescription').val('');
					
					
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
					dil_filtercategory();
				});
				}
			
			function dil_deletecategory(category_id){
				
				var r=confirm("Are You Sure you want to delete?");
				if (r==true)
				  {				
				$.post("news_ajax/deletenews_ajax.php", {catid : ""+category_id+""}, function(data){
  				
		//alert(data);
				if(data=='pass'){
				$('.NormalGreenSmall').html('News Deleted Sucessfully'); 
				$('.NormalRedSmall').html('');
				dil_clearmeassages();
				}else{
				$('.NormalRedSmall').html('Unable to Delete This News');
				$('.NormalGreenSmall').html(''); 
				dil_clearmeassages();
				}
				});
				dil_filtercategory();
				 }	
				
				
				}
				
			function dil_clearmeassages(){
					setTimeout(function() {
				$('.NormalRedSmall').html('');
				$('.NormalGreenSmall').html(''); 
                     }, 3000);
				}
        </script>

  
       


        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
        <script type="text/javascript" src="uploader/swfobject.js"></script>




    </head>
    <body  onLoad="dil_filtercategory();">
        <?php include ("inc/header.php"); ?>
        <div class="dil_pagewrp_product"><div class="dil_product_wrapper addcategorymargin">
        
        
         <div class="dil_prodcuttitle">Add Article</div>
          <div class="NormalGreenSmall addcategorymargin" id="NormalGreenSmalladd"></div>
        <div class="NormalRedSmall addcategorymargin" id="NormalRedSmalladd"> </div>
        <br class="clear"/> <br class="clear"/>
      
        <form name="dil_category_add" class="dil_category_add" action="<?= $PHP_SELF; ?>" method="post">
        <div class="dil_prodcutlable">Title :</div>
        <div class="dil_prodcutinput"><input type="text" name="catname" id="catname" class="catinputclass"/></div><br class="clear"/>
        <div class="dil_prodcutlable">Description :</div>
        <div class="dil_prodcutinput"><textarea name="catdescription" id="catdescription" class="catinputclasstextarea wymeditor"></textarea></div><br class="clear"/>
         <br class="clear"/>  <div id="leftimage_cont2"></div>
        <div class="dil_prodcutlable">&nbsp;&nbsp;</div>
        <div class="dil_prodcutinput"><input type="button" value="Add"  class="dil_inputbuttons" name="submit"  onClick="diladdnewcategory(); return false"/><input type="reset" name="catname" id="catname" class="dil_inputbuttons"  value="Cancel"/></div><br class="clear"/>
        </form>
                     
        
        
        
        
        
        
        <div class="dil_prodcuttitle">View Articles</div>
        
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
                    <td  valign="middle" class="SubHead" width="358"><strong>Title</strong></td>
                    <td  valign="middle" class="SubHead" width="303"><strong>Published Date</strong></td>
                   

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