
<?php

include_once('../../database/db_conection.php');
include('functions.php');
if (isset($_GET['compcode'])) {

    $compcode = $_GET['compcode'];

    $return=array();
    $values=array();
    $sql = "SELECT * FROM comprofile where  orgid='$compcode' ;";
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {
        $return['status']=true;
        $return['values']=$values;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($conn);
    }

}
echo json_encode($return);


?>
