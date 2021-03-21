
<?php

include_once('../../database/db_conection.php');
include('functions.php');

if (isset($_POST['table'])) {

    $table = $_POST['table'];
    $condition = $_POST['condition'];

    $return=array();
    $values=array();
    $cond = json_decode($condition);

    $sql = "SELECT * FROM $table ";
    $sql.= "WHERE";
    $propsCont = 0;
    foreach ($cond as $key => $value) {$propsCont+=1;}
  $keyCount = 0;
  foreach ($cond as $key => $value) {
    $sql.="  ";
    $sql.= $keyCount==$propsCont-1 ? "UPPER(".$key.")=UPPER('".$value."') " : "UPPER(".$key.")=UPPER('".$value."') AND " ;
    $keyCount+=1;
   }

   
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
