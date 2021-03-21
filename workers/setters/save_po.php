
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $po_code=$_POST['po_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($po_code=="") {
  
        $po_code = get_id($dbcon,$table,"PO-00000");
    }
    



    if($action=="add"){
        $sql2 = "INSERT INTO purchaseorders (po_code) VALUES ('$po_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$po_code,$table,"po_code");
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$po_code,$table,"po_code");
    }

}
echo json_encode($return);


?>
