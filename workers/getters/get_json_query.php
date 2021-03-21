
<?php


function query_genrator($array,$id){
    $obj = json_decode($array,true);
    $query = "";

    $query2 = array(); // After loop cleans the array

    foreach($obj as $key => $value) {
        if($key!='table'){
            $query2[] = $key."='".$value."'";
        }
    }
   // print_r($query2);
    $query = "UPDATE purchaseorders SET ";
    $query .= implode(",", $query2) ;  // glue the commasecho
    if($id!=""){
            $query.= " WHERE po_code='$id' ;";
    }
    return $query;
    
//
//    $query23= array(); // After the first foreach cleans the array
//
//    foreach($obj as $key => $value) {
//        if($key!='table'){
//
//            $query23[] = "'$value'";
//        }
//    }
//    $query .= "(";
//    $query .= implode(",", $query23) . ") <br>"; // glue the commas
//    $query .= ";";


    //echo $query;
}


?>