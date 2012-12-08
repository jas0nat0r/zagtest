<?php
include ("../admin/common/common.php");
include ("../admin/common/xmlfunctions.php");
//print_r($_POST);                  

$sql = "select * from " . $tblNews . " WHERE idnews = " . $_POST['nwsid'] . "";

$rs = mysql_query($sql) or die(mysql_error());
?>

<?php
$str="";
if (mysql_num_rows($rs) <= 0) {
    echo '<div class="noproduct">No more News to fetch</div>';
} else {
    while ($row_column = mysql_fetch_array($rs)) {

        $publishdate = date("dS  M  Y", $row_column['publishdate']);
  
echo   $str ='<h3><a href="#" onclick="fetchsignlenew('.$row_column['idnews'].'); return false;" class="newstitle">'.$row_column['newstitle'].'</a></h3><p class="datenews">Posted on '.$publishdate.'</p>
        <p>'.substr($row_column['newsdescription'], 0, 730).'<br/><br/></p>
        <br class="clear"/>
        <div class="sperator marginhometwo"></div>
        <br class="clear"/>
        <a href="#" class="newstitle" onclick="fetchnews(); return false;">&lt; BACK</a>
        <br class="clear"/>
        </span> <br class="clear"/> <br class="clear"/>';


     }
} ?>                                       