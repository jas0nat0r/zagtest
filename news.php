<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'off');

Header("Cache-Control: max-age=2592000, must-revalidate");
$offset = 3600 * 24 * 30;
$ExpStr = "Expires: " . gmdate("D, d M Y H:i(worry)", time() + $offset) . " GMT";
Header($ExpStr);

include ("admin/common/common.php");
$pageName = "News & Events";

$str ="";
$strList ="";
$sql = "select * from " . $tblNews . " ORDER BY idnews DESC ";
$rs = mysql_query($sql) or die(mysql_error());

$newsId = (int) $_REQUEST['newsid'];

if (isset($newsId) || $newsId != "") {
    //news head list
    
    if (mysql_num_rows($rs) <= 0) {
        $strList = '<div class="noproduct">No more News to fetch</div>';
    } else {
        while ($row_column = mysql_fetch_array($rs)) {
        $strList .= '<li><a href="#" onclick="fetchsignlenew('.$row_column['idnews'].'); return false;">'.$row_column['newstitle'].'</a></li>';
         }
    }
    //news description
    $sqlNews = "select * from " . $tblNews . " WHERE idnews = " . $newsId . "";
    $rsNews = mysql_query($sqlNews) or die(mysql_error());
    $row_columnNews = mysql_fetch_array($rsNews);
    $publishdate = date("dS  M  Y", $row_columnNews['publishdate']);
    $str ='<h3><a href="#" onclick="fetchsignlenew('.$row_columnNews['idnews'].'); return false;" class="newstitle">'.$row_columnNews['newstitle'].'</a></h3><p class="datenews">Posted on '.$publishdate.'</p>
        <p>'.substr($row_columnNews['newsdescription'], 0, 730).'<br/><br/></p>
        <br class="clear"/>
        <div class="sperator marginhometwo"></div>
        <br class="clear"/>
        <a href="#" class="newstitle" onclick="fetchnews(); return false;">&lt; BACK</a>
        <br class="clear"/>
        </span> <br class="clear"/> <br class="clear"/>';
}else{
    if (mysql_num_rows($rs) <= 0) {
       $str =  '<div class="noproduct">No more News to fetch</div>';
    } else {
        while ($row_column = mysql_fetch_array($rs)) {
            $publishdate = date("dS  M  Y", $row_column['publishdate']);
            $str = '<h3><a href="#"  onclick="fetchsignlenew('.$row_column['idnews'].'); return false;" class="newstitle">'.$row_column['newstitle'].'</a></h3><p class="datenews">Posted on '.$publishdate.'</p>
                    <p>'.substr ($row_column['newsdescription'], 0 , 730).'<br/><br/></p>';
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ZAG || <?php echo $pageName; ?></title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="robots" content="All" />	
        <meta name="author" content="www.eugein.com" />
        <meta name="viewport" content="height=device-height;  "/>
        <meta name="rating" content="General" />
        <meta name="distribution" content="Global" />
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <!--[if IE 6]>
        <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
        <link href="css/style_ie6.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
          DD_belatedPNG.fix('body');
        </script>
        <![endif]-->
        <script src="js/jquery-1.7.js" type="text/javascript"></script>

        <script type="text/javascript">//<![CDATA[
            
	<?php if (isset($newsId) || $newsId != "") { ?>
                 fetchsignlenew(<?php echo $newsId; ?>);
                fetchresqntpost();
    	
<?php } else { ?>
                  fetchnews();
<?php } ?>
    
            function fetchnews(){
                $('.newsleft').html('<div class="waitingimagenew"><img src="images/loadinfo.net.gif" alt="loading"/></div>');
                fetchresqntpost();
                $.post('news_front_ajax/listnews.php',function(data1){
										
                    //		alert(data);
                    $('.newsleft').html(data1);
                });
			
			
			
            }
			
            function fetchsignlenew(newsid){
                //alert(newsid);
                $('.newsleft').html('<div class="waitingimagenew"><img src="images/loadinfo.net.gif" alt="loading"/></div>');
                $.post('news_front_ajax/listsinglenews.php',{nwsid:newsid},function(data2){
										
                    //alert(data2);
                    $('.newsleft').html(data2);
                });
			
            }
            function fetchresqntpost(){
                //	alert('fasfasfas');
                $.post('news_front_ajax/listresentposts.php',function(data3){
										
                    	//alert(data3);
                    $('.archivecontent').html(data3);
                });
			
            }

            //]]></script>
    </head>
    <body class="home"  >

        <div class="topsection">
            <div class="headerdropshadow"></div>
            <div class="mainwrapper">
                <div class="headerbackgorund">
                    <?php include("inc/inc-header.php"); ?>

                </div>

                <img src="images/companyinner.jpg" alt="slideimg"/>       

                <div class="innerbannertext">News</div>    

            </div>

        </div>
        <div class="dropshadowforinner">  
            <div class="middlesection innerbackground">

            </div>
        </div>
        <div class="homemidback">
            <div class="dropshadowforinnerbasic"> 
                <div class="middlesection innerbackground">
                    <div class="newsleft leftcolumn">
                        <?php echo $str; ?>
                    </div>
                    <div class="rightcolumn">
                        <h3>Latest News</h3>
                        <ul class="archivecontent latestnew">
                            <?php echo $strList; ?>
                        </ul>
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
