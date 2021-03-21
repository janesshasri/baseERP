<?php
include("database/db_conection.php");//make connection here
    // sql to delete a record
	
    $sql = "DELETE FROM vendorcredits WHERE v_credits_id='".$_GET['id']."' ";

    if ($dbcon->query($sql) === TRUE) {
       header("Location: listVendorCredits.php");
    } else {
        echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>