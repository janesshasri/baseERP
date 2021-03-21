<?php
include("../../database/db_conection.php");//make connection here
    // sql to delete a record
//	echo $_GET['so_code'];
    $sql = "UPDATE purchaseorders SET po_status = '".$_GET['po_status']."' WHERE po_code='".$_GET['po_code']."' ";

    if ($dbcon->query($sql) === TRUE) {
      header("Location: ../../listPurchaseOrders.php");
    } else {
       echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>