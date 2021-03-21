
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $so_code=$_POST['so_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($so_code=="") {
  
        $so_code = get_id($dbcon,$table,"SO-0000");
    }
    



    if($action=="add"){
        $sql2 = "INSERT INTO salesorders (so_code) VALUES ('$so_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$so_code,$table,"so_code");
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$so_code,$table,"so_code");
    }

}
echo json_encode($return);


?>
