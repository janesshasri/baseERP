
<?php

include_once('../../database/db_conection.php');
include('functions.php');
if (isset($_POST['value'])&&isset($_POST['field'])) {

    $data = $_POST['value'];
    $field = $_POST['field'];

    $return=array();

    $sql = "SELECT id FROM userprofile WHERE $field='$data' LIMIT 1;";
     $result = mysqli_query($dbcon, $sql);
  
    if (mysqli_num_rows($result) > 0) {
        $return['status']=true;
        $return['flag']=false;

    }else{
        $return['status']=true;
        $return['flag']=true;
    }
    echo json_encode($return);

}


?>
