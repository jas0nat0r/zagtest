<?php
	check_security();
?>
<link href="css/body.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="main.php"><img src="images/logo.png" width="225" height="95" /></a></td><br/>
  </tr>
  <tr>
    <td height="25" align="center">
<div id="colortab" class="ddcolortabs">
<ul>
<li><a class="navigation" href="main.php">Dashboard</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="main_pages.php">Main Pages</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="edit_home.php">Slider Image</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;



<li><a class="navigation" href="edit_services.php">Solutions</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;


<li><a class="navigation" href="edit_about.php" rel="dropmenu_Port">Company</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;

<li><a class="navigation" href="news.php"  rel="dropmenu_Portnew">News</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="addpartners.php">Add Partners</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="clientportal.php">Client Portals</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="edit_contact.php">Contact</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;

<li><a class="navigation" href="copyright.php">Copyright Text</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
<li><a class="navigation" href="sign_out.php">Logout</a></li>
<!--<li><a class="navigation" href="javascript:" rel="dropmenu_Pages">Content Pages</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;-->
</ul>

<!--drop down menu --> 

<div id="dropmenu_Port" class="dropmenudiv_a">
<!--
<a class="navigation" href="edit_project_page.php">Edit top content</a>
-->
<a class="navigation" href="edit_aboutus.php">About Us</a>
<a class="navigation" href="edit_careers.php">Careers</a>

</div>

<div id="dropmenu_Portnew" class="dropmenudiv_a">
<!--
<a class="navigation" href="edit_project_page.php">Edit top content</a>
-->
<a class="navigation" href="casestudies.php">Case Studies</a>
<a class="navigation" href="pressrelease.php">Press Release</a>
<a class="navigation" href="events.php">Events</a>
<a class="navigation" href="blog.php">Blog</a>
</div>


</div> 
<!--drop down menu -->  
<div id="dropmenu_Settings" class="dropmenudiv_a">
<a class="navigation" href="change_email.php">Admin Email</a>
<a class="navigation" href="change_password.php">Change Password</a>
<a class="navigation" href="sign_out.php">Logout</a>
</div>

<div id="dropmenu_home" class="dropmenudiv_a">
<a class="navigation" href="edit_home.php">Slider Images</a>
<a class="navigation" href="edit_home_main.php">Featured Project</a>
</div>

<div id="dropmenu_events" class="dropmenudiv_a">
<a class="navigation" href="add_news.php">News</a>
<a class="navigation" href="add_events.php">Events</a>
</div>

<?php /*?><div id="dropmenu_racing" class="dropmenudiv_a">
<a class="navigation" href="winner.php">Winners</a>
<a class="navigation" href="past_events.php">Past Events</a>
<a class="navigation" href="upcoming_events.php">Upcoming Events</a>

</div><?php */?>


<div id="dropmenu_headerFooters" class="dropmenudiv_a">
<a class="navigation" href="header_text.php">Header Text</a>
<a class="navigation" href="copyright.php">Copyright Text</a>
</div>


<?php /*?><div id="dropmenu_Home" class="dropmenudiv_a">
<a class="navigation" href="vid_home_slide_show.php">Slideshow - Video</a>
<a class="navigation" href="home_slide_show.php">Slideshow - Images</a>
<a class="navigation" href="home_bottom_images.php">Bottom Images</a>
<a class="navigation" href="news_page.php">News</a>

<!--
<a class="navigation" href="home_footer.php">Footer Advertise</a>-->
</div><?php */?>


<div id="dropmenu_Pages" class="dropmenudiv_a">
<a class="navigation" href="members.php">Members</a>
<a class="navigation" href="training_Learn_to_fly.php">Training/Learn to Fly</a>
<a class="navigation" href="maintenance.php">Maintenance</a>
<a class="navigation" href="photo_gallery.php">Photo Gallery</a>
<a class="navigation" href="rental_aircraft.php">Rental Aircraft</a>
<a class="navigation" href="contact_us.php">Contact Us</a>
</div>
<script type="text/javascript">
	tabdropdown.init("colortab", 3);
</script>    
    </td>
  </tr>
</table>
