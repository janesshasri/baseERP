
<?php

include_once('../../database/db_conection.php');
include('functions.php');

if (isset($_POST['id'])) {

    $id = $_POST['id'];
    $table = $_POST['table'];
    $col = $_POST['col'];

    $return=array();
    $values=array();
    $sql = "SELECT * FROM $table WHERE $col='$id';";
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
