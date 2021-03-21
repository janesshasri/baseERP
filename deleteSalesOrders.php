<?php
include("database/db_conection.php");//make connection here
    // sql to delete a record
//	echo $_GET['so_code'];
    $sql = "DELETE FROM salesorders WHERE so_code='".$_GET['so_code']."' ";

    if ($dbcon->query($sql) === TRUE) {
      header("Location: listSalesOrders.php");
    } else {
       echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>