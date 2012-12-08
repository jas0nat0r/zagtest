<?php

include ("common/common.php");

$action = mysql_real_escape_string($_POST['action']);
$updateRecordsArray = $_POST['recordsArray'];

/*switch ($Submit) {

    case "Reorder":
        for ($i = 0; $i < sizeof($arr_id); $i++) {
            $sql = "UPDATE " . $tblMainPages . " SET" .
                    " page_order = " . tosql($arr_order[$i], "Number") .
                    " WHERE autoid=" . tosql($arr_id[$i], "Number");
            mysql_query($sql) or die(mysql_error());
        }
        //header("Location:main_pages.php");
        $suc_msg = 'Pages re-ordered sucessfully';
        //exit;
        break;
}*/


if ($action == "updateRecordsListings") {

    $listingCounter = 1;
    foreach ($updateRecordsArray as $recordIDValue) {

        $query = "UPDATE " . $tblMainPages . " SET page_order = " . $listingCounter . " WHERE autoid = " . $recordIDValue;
        mysql_query($query) or die('Error, insert query failed');
        $listingCounter = $listingCounter + 1;
    }

    echo '<pre>';
    print_r($updateRecordsArray);
    echo '</pre>';
}
?>