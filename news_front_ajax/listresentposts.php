<?php
include ("../admin/common/common.php");
include ("../admin/common/xmlfunctions.php");


$sql = "select * from " . $tblNews . " ORDER BY idnews DESC ";

$rs = mysql_query($sql) or die(mysql_error());
?>

<?php
$str="";
if (mysql_num_rows($rs) <= 0) {
    echo '<div class="noproduct">No more News to fetch</div>';
} else {
    while ($row_column = mysql_fetch_array($rs)) {
        
 echo $str ='<li><a href="#" onclick="fetchsignlenew('.$row_column['idnews'].'); return false;">'.$row_column['newstitle'].'</a></li>';

     }
} ?>                                       