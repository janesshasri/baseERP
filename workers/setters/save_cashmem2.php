
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $inv_code=$_POST['inv_code'];
    $inv_owner=$_POST['inv_owner'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $return=array();
    
    if ($inv_code=="") {
  
        $inv_code = get_id($dbcon,$table,"INVACC-0000");
    }
    

    if($action=="add"){
        $sql2 = "INSERT INTO invoicesacc (inv_code) VALUES ('$inv_code')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
            $return['inv_code'] = $inv_code;
            $return['inv_owner'] = $inv_owner;
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$inv_code,$table,"inv_code");
    }

}
echo json_encode($return);


?>
