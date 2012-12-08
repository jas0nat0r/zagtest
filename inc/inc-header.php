<?php
$sqlH = "select * from " . $tblAdmin . " where autoid= 1";
$rsH = mysql_query($sqlH) or die(mysql_error());
$rowH = mysql_fetch_assoc($rsH);
$f_descriptionH = $rowH['f_description'];
$curr_pg='';
?>
<script src="js/jquery-1.7.js" type="text/javascript"></script>
<script type="text/javascript">



var timeoutID;
var timeoutID2;
var timeoutID3;
var timeoutID4;
$(function(){
	$('.comdrop').mouseover(function(){
		window.clearTimeout(timeoutID);
		var submenu = $(this).next();
		//alert(submenu.attr('id'));
		if(submenu.attr('id')=='dropone'){
			left = 519.5; 
		}else if(submenu.attr('id')=='droptwo'){
			left = 613.5;
		}else if(submenu.attr('id')=='dropthree'){
			left = 709.5;
		}else if(submenu.attr('id')=='dropfour'){
			left = 777.5;
		}
		
		submenu.css({
			position:'absolute',
			top: '75px',
			left: left + 'px',
			zIndex:1000
		});
		
		submenu.stop().show();
		
			
		submenu.hover(function(){
					
				   } ,
				   function() {
					 $(this).hide();
				   }
			);
			
		
		submenu.mouseover(function(){
			window.clearTimeout(timeoutID);
			$(this).prev().addClass('productitemselected');	
		});
		
		
		
		
	});
	
	
		$('.comdrop').hover(function(){
					
				   } ,
				   function() {
			
				//   alert($(this).next().attr('class'));
				timeoutID = window.setTimeout(function() {$('#dropone').stop(false, true).hide();});  // slide up
			}
			);
			
	
	
//menu2


	$('.soldrop').mouseover(function(){
		window.clearTimeout(timeoutID2);
		var submenu = $(this).next();
		//alert(submenu.attr('id'));
		if(submenu.attr('id')=='dropone'){
			left = 519.5; 
		}else if(submenu.attr('id')=='droptwo'){
			left = 613.5;
		}else if(submenu.attr('id')=='dropthree'){
			left = 709.5;
		}else if(submenu.attr('id')=='dropfour'){
			left = 777.5;
		}
		
		submenu.css({
			position:'absolute',
			top: '75px',
			left: left + 'px',
			zIndex:1000
		});
		
		submenu.stop().show();
		
			
		submenu.hover(function(){
					
				   } ,
				   function() {
					 $(this).hide();
				   }
			);
			
		
		submenu.mouseover(function(){
			window.clearTimeout(timeoutID2);
			$(this).prev().addClass('productitemselected');	
		});
		
		
		
		
	});



	

	

			
	
	$('.soldrop').hover(function(){
					
				   } ,
				   function() {
			
				//   alert($(this).next().attr('class'));
				timeoutID2 = window.setTimeout(function() {$('#droptwo').stop(false, true).hide();});  // slide up
			}
			);
			
			

//menu3


	$('.newsdrp').mouseover(function(){
		window.clearTimeout(timeoutID3);
		var submenu = $(this).next();
		//alert(submenu.attr('id'));
		if(submenu.attr('id')=='dropone'){
			left = 519.5; 
		}else if(submenu.attr('id')=='droptwo'){
			left = 613.5;
		}else if(submenu.attr('id')=='dropthree'){
			left = 709.5;
		}else if(submenu.attr('id')=='dropfour'){
			left = 777.5;
		}
		
		submenu.css({
			position:'absolute',
			top: '75px',
			left: left + 'px',
			zIndex:1000
		});
		
		submenu.stop().show();
		
			
		submenu.hover(function(){
					
				   } ,
				   function() {
					 $(this).hide();
				   }
			);
			
		
		submenu.mouseover(function(){
			window.clearTimeout(timeoutID3);
			$(this).prev().addClass('productitemselected');	
		});
		
		
		
		
	});



	$('.newsdrp').hover(function(){
					
				   } ,
				   function() {
			
				//   alert($(this).next().attr('class'));
				timeoutID3 = window.setTimeout(function() {$('#dropthree').stop(false, true).hide();});  // slide up
			}
			);


//menu4


	$('.clientdrp').mouseover(function(){
		window.clearTimeout(timeoutID4);
		var submenu = $(this).next();
		//alert(submenu.attr('id'));
		if(submenu.attr('id')=='dropone'){
			left = 519.5; 
		}else if(submenu.attr('id')=='droptwo'){
			left = 613.5;
		}else if(submenu.attr('id')=='dropthree'){
			left = 709.5;
		}else if(submenu.attr('id')=='dropfour'){
			left = 777.5;
		}
		
		submenu.css({
			position:'absolute',
			top: '75px',
			left: left + 'px',
			zIndex:1000
		});
		
		submenu.stop().show();
		
			
		submenu.hover(function(){
					
				   } ,
				   function() {
					 $(this).hide();
				   }
			);
			
		
		submenu.mouseover(function(){
			window.clearTimeout(timeoutID4);
			$(this).prev().addClass('productitemselected');	
		});
		
		
		
		
	});



	$('.clientdrp').hover(function(){
					
				   } ,
				   function() {
			
				//   alert($(this).next().attr('class'));
				timeoutID4 = window.setTimeout(function() {$('#dropfour').stop(false, true).hide();});  // slide up
			}
			);
					
			
	
	$('.sublinks').mouseover(function(){
									  
							$(this).prev().addClass('productitemselected');	  
									  
									  });
	$('.sublinks').mouseout(function(){
									  
								$(this).prev().removeClass('productitemselected');	  
									  
									  });
	

});
</script>
			<div class="logodiv">
                	<a href="index.php"><img src="images/logo.png" alt="logo"/></a>
            </div>
            <div class="mainmenu" >
		   
            <?php
          
            $sql = "select * from " . $tblMainPages . " where status=1 Order by page_order Asc ";
            $rs = mysql_query($sql) or die(mysql_error()); 
            $count=0;
            while ($row = mysql_fetch_array($rs)) {                
                $page_name = $row['page_name'];
                $page_url = $row['page_url'];                               

                ?>
         <a class="<? if($page_name==$pageName)echo'current';?> <? if($count==0){echo'subparent comdrop';}else if($count==1){echo'subparent soldrop'; }else if($count==2){echo'subparent newsdrp'; }else if($count==3){echo'subparent clientdrp';}?>"  href="<?=$page_url;?>" ><?=$page_name = $row['page_name'];?></a>
         
         
         <? if($count==0){?>
         <div class="sublinks dropone" id="dropone"><br class="clear"/>
                                    <a href="about_us.php" class="<? if($childpage=="About Us")echo'sublinkscurrentselecterd';?>" >About Us</a><br class="clear"/>
                    
                    
                                        <a href="partners.php" class="<? if($childpage=="Partners")echo'sublinkscurrentselecterd';?>" >Partners</a><br class="clear"/>
                    
                    
                                        <a href="careers.php" class="<? if($childpage=="Careers")echo'sublinkscurrentselecterd';?>" >Careers</a><br class="clear"/>
                    
                    
                                        <a href="contact_us.php" class="<? if($childpage=="Contact Us")echo'sublinkscurrentselecterd';?>" >Contact Us</a>
          <br class="clear"/> </div>
         
         <? } ?>
        
                 <? if($count==1){?>
         <div class="sublinks droptwo" id="droptwo"><br class="clear"/>
                                    <a href="cloudservices.php" class="<? if($childpage=="Cloud Services")echo'sublinkscurrentselecterd';?>" >Cloud Services</a><br class="clear"/>
                    
                    
                                        <a href="virtualization.php"  class="<? if($childpage=="Virtualization")echo'sublinkscurrentselecterd';?>" >Virtualization</a><br class="clear"/>
                    
                    
                                        <a href="communications.php"  class="<? if($childpage=="Communications")echo'sublinkscurrentselecterd';?>">Communications</a><br class="clear"/>
                    
                    
                                        <a href="system_mgt.php" class="<? if($childpage=="System Management")echo'sublinkscurrentselecterd';?>">Systems Management</a><br class="clear"/> 
                                        
                                        <a href="managed_services.php" class="<? if($childpage=="Managed Services")echo'sublinkscurrentselecterd';?>">Managed Services</a><br class="clear"/> 
                                        
                                        <a href="server.php" class="<? if($childpage=="Server")echo'sublinkscurrentselecterd';?>">Server</a><br class="clear"/> 
                                        
                                        <a href="security.php" class="<? if($childpage=="Security")echo'sublinkscurrentselecterd';?>">Security</a><br class="clear"/> 
                                        
                                        <a href="databases.php" class="<? if($childpage=="Database")echo'sublinkscurrentselecterd';?>">Database</a><br class="clear"/> 
                                        
                                        </div>
         
         <? } ?>
         
         
                 <? if($count==2){?>
         <div class="sublinks dropthree" id="dropthree"><br class="clear"/>
                                    <a href="case_study.php" class="<? if($childpage=="Case Study")echo'sublinkscurrentselecterd';?>">Case Studies</a><br class="clear"/>
                    
                    
                                        <a href="press_release.php" class="<? if($childpage=="Press Releases")echo'sublinkscurrentselecterd';?>">Press Releases</a><br class="clear"/>
                    
                    
                                        <a href="events.php" class="<? if($childpage=="Events")echo'sublinkscurrentselecterd';?>">Events</a><br class="clear"/>
                    
                    
                                        <a href="blog.php" class="<? if($childpage=="Blog")echo'sublinkscurrentselecterd';?>">Blog</a>
          <br class="clear"/> </div>
         
         <? } ?>
         
                  <? if($count==3){?>
         <div class="sublinks dropfour" id="dropfour"><br class="clear"/>
                                    <a href="tech_supports.php" class="<? if($childpage=="Technical	Support")echo'sublinkscurrentselecterd';?>">Technical Support</a><br class="clear"/>
                    
                    
                                        <a href="https://connect.zagtech.com/v4_6_Release/services/system_io/customerportal/portal.html?company=zag" class="<? if($childpage=="Customer Portal")echo'sublinkscurrentselecterd';?>">Customer Portal</a><br class="clear"/>
                    
                   
                                        <a href="zag_online_store.php" class="<? if($childpage=="ZAG Online Store")echo'sublinkscurrentselecterd';?>">Online Store</a><br class="clear"/>
                     </div>
         
         <? } ?>
         
            <?php
           $count++; }
                
            ?>
           </div>
           
          
                	 

                	    
                       
                    
               
           
    