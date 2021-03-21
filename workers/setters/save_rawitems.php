
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $rw_code=$_POST['rw_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($rw_code=="") {
  
        $rw_code = get_id($dbcon,$table,"RM-00");
    }
    

    if($action=="add"){
        $sql2 = "INSERT INTO rawitemaster (rw_code) VALUES ('$rw_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$rw_code,$table,"rw_code");
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$rw_code,$table,"rw_code");
    }

}
echo json_encode($return);


?>
