<?php
include("../../database/db_conection.php");//make connection here
include("../getters/functions.php");//make connection here
// sql to delete a record
//	echo $_GET['so_code'];
$sql = "UPDATE invoices SET inv_status = '".$_GET['inv_status']."' WHERE inv_code='".$_GET['inv_code']."' ";

if ($dbcon->query($sql) === TRUE) {
    if($_GET['inv_status']=="Approved"){
        update_open_balance($dbcon,'recievables');
    }
    header("Location: ../../listInvoices.php");
} else {
    echo "Error deleting record: " . $dbcon->error;
}
$dbcon->close();
?>