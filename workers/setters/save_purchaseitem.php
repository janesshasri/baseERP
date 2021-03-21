
<?php
include('../../database/db_conection.php');

include('../getters/functions.php');

if (isset($_POST['array'])) {
    $array=$_POST['array'];
    $logarray=$_POST['logarray'];
    $itemcode=$_POST['itemcode'];
    $action=$_POST['action'];
    $table=$_POST['table'];
    $compcode=$_POST['compcode'];
    $table2 = "purchaseitemlog";
    $return=array();

   // $prefix = $compcode!='' ?  strtoupper(substr($compcode, 0, 3)):'';
    $prefix = $compcode!='' ?  strtoupper(substr($compcode, 0, 3))."-":'';
    
    if ($itemcode=="") {  
        $itemcode = get_id($dbcon,$table,$prefix."0");
    }
    
    if($action=="add"){
        $sql2 = "INSERT INTO ".$table." (itemcode) VALUES ('$itemcode')";

        if (mysqli_query($dbcon,$sql2)) {
            $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");

            if($return['status']){
                $sql21 = "INSERT INTO ".$table2." (itemcode) VALUES ('$itemcode')";
                if (mysqli_query($dbcon,$sql21)) {
                    $return = update_query($dbcon,$logarray,$itemcode,$table2,"itemcode");

                }else{
                    $return['status']=false;
                    $return['error']=mysqli_error($dbcon);        
                }
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);    
            }
   
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);
        }
    }else{
        $return = update_query($dbcon,$array,$itemcode,$table,"itemcode");
    
        if($return['status']){
            $sql21 = "INSERT INTO ".$table2." (itemcode) VALUES ('$itemcode')";
            if (mysqli_query($dbcon,$sql21)) {
                $return = update_query($dbcon,$logarray,$itemcode,$table2,"itemcode");

            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);        
            }
        }else{
            $return['status']=false;
            $return['error']=mysqli_error($dbcon);    
        }
        
    }

}
echo json_encode($return);
?>
