<?php
include("database/db_conection.php");//make connection here
    // sql to delete a record
	
    $sql = "DELETE FROM estimates WHERE est_code='".$_GET['id']."' ";

    if ($dbcon->query($sql) === TRUE) {
       header("Location: listEstimates.php");
    } else {
        echo "Error deleting record: " . $dbcon->error;
    }
    $dbcon->close();
?>