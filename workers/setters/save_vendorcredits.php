
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $v_credits_id=$_POST['v_credits_id'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($v_credits_id=="") {
        $v_credits_id = get_id($dbcon,$table,"CN00");
    }

    if($action=="add"){
        $sql2 = "INSERT INTO vendorcredits (v_credits_id) VALUES ('$v_credits_id')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$v_credits_id,$table,"v_credits_id");
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$v_credits_id,$table,"v_credits_id");
    }


echo json_encode($return);

}
?>
