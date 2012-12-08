<?php
Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "Company";
$childpage = "Contact Us";

$sqlc = "select * from " . $tblGeneralContent . " where section='contact'";
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$c_content = $rowc['content'];

$sqlc2 = "select * from " . $tblGeneralContent . " where section='contact-add2'";
$rsc2 = mysql_query($sqlc2) or die(mysql_error());
$rowc2 = mysql_fetch_assoc($rsc2);
$c_content2 = $rowc2['content'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ZAG || <?php echo $childpage; ?></title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="All" />	
<meta name="viewport" content="height=device-height;  "/>
<meta name="author" content="www.eugein.com" />
<meta name="rating" content="General" />
<meta name="distribution" content="Global" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquerydil.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
 
    <script type="text/javascript">//<![CDATA[
      
	  
	  var $j = jQuery.noConflict(); 
	
           $j(document).ready(function(){
        		
			  $j("#contactFormclass").validate({
			//set the rules for the fild names
	 
			rules: {
				fname: {
					required: true,
					minlength: 2
				},
				lname: {
					required: true,
					minlength: 2
				},
				title: {
					minlength: 2
				},
				email:{
					required: true,
					email: true,
					
				},
				phone:{
				    number: true,
					minlength: 2
				},
				comment:{
					minlength: 2,
					},
			   
			},
			//set messages to appear inline
			messages: {
				fname: "Please Enter First Name <br/>",
				comment: "Please Add Comment <br/>",
				lname: "Please Enter Last Name <br/>",
				title: "Please Enter Title <br/>",
				address : "Please Enter Address <br/>",
				email : "Please Enter Valied E-mail Address <br/>",
				phone : "Please Enter Valid  Phone Number"
				
			},
			
			 
			errorContainer: "#errors",
 
            errorPlacement: function(error,element) 


            {  
			
               
                error.appendTo( $('#errors') );

            }   
					

		}); 

		
		
			
		 $j("#dilsubmit").click(function(){

        

   	if( $j("#contactFormclass").valid())

            	{
					 $j.post('emailsent.php',  $j('form#contactFormclass').serialize(), function(data){
					
						//alert(data);
						 $j('#contactFormclass').get(0).reset()



                                                    $j('.respondmsg').val('');
                                   
						 $j('.respondmsg').html(data);
						//$('.dilrespondmsg').css('display', 'block'); 
						
									
					setTimeout(function() {
				 
				   $j('.respondmsg').html('');
                     }, 3000);
					
					



					
					
					
																				 });
					
				    	
				}
		});  
				
                        	
        	
          });
		  
      //]]></script>



</head>
<body class="home">

	<div class="topsection">
    <div class="headerdropshadow"></div>
    	<div class="mainwrapper">
        	<div class="headerbackgorund">
            	<?php include("inc/inc-header.php"); ?>
            
            </div>
           
             <img src="images/companyinner.jpg" alt="slideimg"/>       
             
             <div class="innerbannertext"><b>Contact</b> Us</div>    
        
		</div>
         
    </div>
  <div class="dropshadowforinner">  
    <div class="middlesection innerbackground">
    	
    </div>
 </div>
 <div class="homemidback">
  <div class="dropshadowforinnerbasic"> 
<div class="middlesection innerbackground">
  <div class="leftcolumn">
    	<h3>Company Information</h3><br/>
        <p>We would love to meet you to answer any questions you may have or solve any IT problems you may be facing. Call us anytime.<br/><br/> </p>
        
        <div class="contactleft">
        	<p><b>Corporate Headquarters:</b><br/>
            
            <?= stripslashes($c_content) ?>
</p>
            
        </div>
        <div class="contactright">
        	
            <div class="mapcover">
               <div id="map_canvas">
               <div id="mapviewer"><iframe id="map" scrolling="no" width="403" height="325" frameborder="0" src="http://www.bing.com/maps/embed/?v=2&amp;cp=37.395935158129646~-121.92730712890625&amp;lvl=16&amp;dir=0&amp;sty=r&amp;where1=2841%20Junction%20Ave%2C%20San%20Jose%2C%20CA%2095134&amp;form=LMLTEW&amp;pp=37.39593505859375~-121.92730712890625&amp;emid=caed19f9-a797-405a-9e3f-12c33c0a36c7"></iframe><div id="LME_maplinks" style="line-height:20px;"></div></div>
               
               
               </div>
            </div>
            
        </div>
        <br class="clear"/>   <br class="clear"/> <br class="clear"/>   <br class="clear"/>
        
            <div class="contactleft">
        	<p><b>Salinas Office:</b><br/>
            
            <?= stripslashes($c_content2) ?>
</p>



            
        </div>
        <div class="contactright">
        	
            <div class="mapcover">
            	 <div id="map_canvas2">
                 
                 <div id="mapviewer"><iframe id="map" scrolling="no" width="403" height="325" frameborder="0" src="http://www.bing.com/maps/embed/?v=2&amp;cp=36.662827~-121.657396&amp;lvl=15&amp;dir=0&amp;sty=r&amp;where1=945%20S%20Main%20St%2C%20Salinas%2C%20CA%2093901&amp;form=LMLTEW&amp;pp=36.66279220581055~-121.65730285644531&amp;emid=e76f740c-c0bd-2ecc-70d3-d620773645f0"></iframe><div id="LME_maplinks" style="line-height:20px;"></div></div>
                 </div>
            </div>
            
        </div>
        
    </div>
    <div class="rightcolumn">
    	<h3>Send Us Your Comments or Questions</h3><br/>
        <p>Please send us your comments regarding information on this site. We appreciate your time. Any necessary replies will be given as soon
as possible.<br/> </p>
		<br class="clear"/>
        
        <form method="post" id="contactFormclass">
        	<p>First Name <span class="bluespecial">*</span></p>
            <input type="text" class="classtesxtbox" name="fname"/><br/> <br/> 
            <p>Last Name <span class="bluespecial">*</span></p>
            <input type="text" class="classtesxtbox" name="lname"/><br/> <br/> 
            <p>Title</p>
            <input type="text" class="classtesxtbox" name="title"/><br/> <br/> 
            <p>Email <span class="bluespecial">*</span></p>
            <input type="text" class="classtesxtbox" name="email"/><br/> <br/> 
             <p>Phone</p>
            <input type="text" class="classtesxtbox" name="phone"/> 	<br/> <br/> 
             <p>Comments</p>
            <textarea class="contacttextarea" name="comment"></textarea><br/> <br/> 
             <div class="errors" id="errors"></div><br/>
             <span class="respondmsg"></span>
            <input type="button" id="dilsubmit"  value="&nbsp;" class="contactsendbuttn" name="Submit" t/>
        
        </form>
        

        
    </div>
      <br class="clear"/>
      <br class="clear"/> <br class="clear"/><br class="clear"/>
    </div>
    
   
    </div> 
     </div> 
   <?php include("inc/inc-footer.php"); ?><!--end of footer-->
<?php include_once("inc/inc-analytics.php") ?> <!--Google Analytics-->

</body>
</html>
