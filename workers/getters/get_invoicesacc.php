
<?php

include_once('../../database/db_conection.php');
include('functions.php');

if (isset($_POST['payment_vendor'])) {

    $payment_vendor = $_POST['payment_vendor'];

    $return=array();
    $values=array();
     $sql = "SELECT * FROM grn_notes g, vendorprofile v where  g.grn_po_vendor=v.vendorid and g.grn_balance!=0 ;";
    
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {
        $return['status']=true;
        $return['values']=$values;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }

}else if(isset($_POST['cust_payment_customer'])) {

    $cust_payment_customer = $_POST['cust_payment_customer'];

    $return=array();
    $values=array();
    $sql = "SELECT * FROM invoicesacc where inv_customer='$cust_payment_customer' ";
    
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {
        $return['status']=true;
        $return['values']=$values;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }

}
echo json_encode($return);


?>
