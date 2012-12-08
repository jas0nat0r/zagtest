<?php
include ("common/common.php");
include ("common/xmlfunctions.php");
include ("common/imagemanipulation.php");


switch ($_REQUEST['action']) {
    case 'd':
        $sql = "UPDATE " . $tblMainPages . " SET" .
                " status = 0" .
                " WHERE autoid=" . tosql($_REQUEST['id'], "Number");
        mysql_query($sql) or die(mysql_error());


        break;
    case 'r':
        $sql = "UPDATE " . $tblMainPages . " SET" .
                " status = 1" .
                " WHERE autoid=" . tosql($_REQUEST['id'], "Number");
        mysql_query($sql) or die(mysql_error());


        break;


    default:
        break;
}

$autoid = $_REQUEST['autoid'];
$page_name = $_REQUEST['page_name'];
$type = $_REQUEST['type'];
$Submit = $_REQUEST['Submit'];

$arr_id = $_REQUEST["id"];
$arr_order = $_REQUEST["mp_order"];

$arr_sid = $_REQUEST["sid"];
$arr_sorder = $_REQUEST["sp_order"];



$sqlc = "select * from " . $tblMainPages;
$rsc = mysql_query($sqlc) or die(mysql_error());
$rowc = mysql_fetch_assoc($rsc);
$page_name = $rowc['page_name'];
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Administration</title>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
        <link href="css/datepicke.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/body.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/ddcolortabs.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="js/dropdowntabs.js"></script>
        <script type="text/javascript" src="js/common.js"></script>
        <script type="text/javascript">
            function Delete(autoid,type)
            {
                var userreq=confirm('Are you sure you want to delete ?');
                if (userreq==true)
                {	
                    var url='main_pages.php?Submit=delete&autoid='+autoid+'&type='+type;
                    window.location = url;
                    //alert(url);
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
                        $.post("main_pages_order.php", order, function(theResponse){
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

    </head>
    <body >
        <?php include ("inc/header.php"); ?>
        <table width="990" height="692" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#98B3CE">


            <tr>
                <td width="972" height="415" align="center" valign="top">




                    <form action="" method="post" name="frmfaq">
                        <table width="95%" border="0">
                            <tr>
                                <td height="30"></td>

                            </tr>
                            
                        </table>
                        <table width="90%" border="0" align="center">
                            <tr>
                                <td colspan="3" class="heading">&nbsp;&nbsp;Main Pages</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="heading" height="30"></td>
                            </tr>

                            <tr>
                                <td  valign="middle" class="SubHead">&nbsp;</td>


                                <td  valign="middle" class="SubHead"><strong>Name</strong></td>

                                <td  class="SubHead"><strong>Options</strong></td>
                            </tr>
                        </table>
                        <table width="95%" border="0" align="center">
                            <tr>
                                <td height="30" valign="middle" class="SubHead">

                                    <ul id="list">
                                        <?php
                                        $sql = "select * from " . $tblMainPages . " Order by page_order";
                                        $rs = mysql_query($sql) or die(mysql_error());


                                        while ($row = mysql_fetch_array($rs)) {
                                            $autoid = $row['id'];
                                            $autoid = $row['autoid'];
                                            $page_name = $row['page_name'];
                                            $page_order = $row['page_order'];
                                            $page_url = $row['page_url'];
                                            $page_stat = $row['status'];
                                            ?>

                                            <li id="recordsArray_<?php echo $autoid ?>">
                                                <div id="<?php echo $autoid ?>" style="width:900px;height:30px;margin:2px; padding:4px; background-color:#ececec;" onMouseOver="changeColor(this.id,'#dbd9d9')" onMouseOut="changeColor(this.id,'#ececec')">
                                                    <div style="width:30px;height:25px; overflow:hidden; float:left; padding-top: 5px;"><img src="images/arrow.png" width="16" class="handle" /></div>

                                                    <div style="width:360px;height:27px; overflow:hidden; float:left; padding:2px;">

                                                        <?= $row['page_name']; ?>

                                                    </div>
                                                    <div style="width:180px;height:15px;  overflow:hidden;float:left;">
                                                       <!-- <a href="javascript:" class="links" onClick="MM_openBrWindow('<?= $page_url; ?>_edit.php','Edit','location=yes,resizable=yes,width=620,height=250,scrollbars=yes')">Edit</a>-->
                                                        &nbsp;&nbsp;
                                                        <? if ($page_stat == 0) { ?>
                                                            <a href="main_pages.php?action=r&id=<?= $autoid; ?>" class="links" onClick="return confirm('Do you really want to reactivate ?');">Reactivate</a>
                                                        <? } else { ?>
                                                            <a href="main_pages.php?action=d&id=<?= $autoid; ?>" class="links" onClick="return confirm('Do you really want to delete ?');">Delete</a>
                                                        <? } ?>
                                                    </div>
                                                </div>




                                                <?php
                                            }
                                            ?>
                                        </li>                
                                        <?php /* ?><?php
                                          }
                                          ?>  <?php */ ?> 
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
        <?php include ("footer.php"); ?>
    </body>
</html>