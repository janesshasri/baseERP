<?php
include("../../database/db_conection.php");//make connection here
include("../getters/functions.php");//make connection here

// sql to delete a record
//	echo $_GET['so_code'];
$sql = "UPDATE grn_notes SET grn_status = '".$_GET['grn_status']."' WHERE grn_id='".$_GET['grn_id']."' ";

if ($dbcon->query($sql) === TRUE) {
    if($_GET['grn_status']=="Approved"){
        update_open_balance($dbcon,'payables');
        $arr = findbyand($dbcon,$_GET['grn_id'],"grn_notes","grn_id");
        updatebyand($dbcon,"Billed","purchaseorders","po_status","po_code",$arr['values'][0]['grn_po_code']);
    }
    header("Location: ../../listGoodsReceiptNote.php");
} else {
    echo "Error deleting record: " . $dbcon->error;
}
$dbcon->close();
?>