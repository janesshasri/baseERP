
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $est_code=$_POST['est_code'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($est_code=="") {
  
        $est_code = get_id($dbcon,$table,"EST-0000");
    }
    

    if($action=="add"){
        $sql2 = "INSERT INTO estimates (est_code) VALUES ('$est_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$est_code,$table,"est_code");
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$est_code,$table,"est_code");
    }

}
echo json_encode($return);


?>
