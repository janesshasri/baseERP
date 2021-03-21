
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');


if (isset($_GET['id'])) {

  echo  $po_code = $_GET['id'];

   echo  $sql4 = " UPDATE purchaseorders SET po_status='Delivered'  WHERE po_code='$po_code' ;";
    $return = array();

    if (mysqli_query($dbcon,$sql4)) {
        $return['status']=true;
        header("Location: ../../listPurchaseOrders.php");

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }


}


?>
