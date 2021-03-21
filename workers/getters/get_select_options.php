
<?php

include_once('../../database/db_conection.php');
include('functions.php');

header("Content-Type: application/json; charset=UTF-8");
if (isset($_POST['columns'])) {

    $obj = json_decode($_POST["columns"], false);
    $table = $_POST['table'];

    $return=array();
    $values=array();
    $columns_array=array();

    $sql = "SELECT * FROM `$table` ";

    if(count($obj)>0){
        $sql.=" WHERE ";  
    }

    for($i=0;$i<count($obj);$i++){
        foreach ($obj[$i] as $x => $x_value){

            if($i==count($obj)-1){
                $sql.=" `$x`='$x_value' ";

            }else{
                $sql.=" `$x`='$x_value' AND ";
            }
        }
    }
    $sql.=" ; ";        
     //echo $sql;
    
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
