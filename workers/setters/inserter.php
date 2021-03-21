
<?php


// $array = '{"table":"table","compcode_select":"Open Company Code","vendorcode_select":"Open Vendor Code","podate":"","paymentterm_select":"Open Payment Term","shippingvia_select":"Open Shipping Via","delivat":"Open Location","delivdate":"","freight":"","billaddress":"","shipaddress":"","billcity":"","shipcity":"","billstate":"","shipstate":"","billcountry":"","shipcountry":"","billzip":"","shipzip":"","billmobile":"","shipmobile":"","billgstin":"","shipgstin":"","uniy":"","amount":"","taxname":"0","tandc":"","notes":""}';
function query_genrator($dbcon,$array){
    $return = array();
    $obj = json_decode($array,true);
    count($obj);
    $query = "";

    $query2 = array(); // After loop cleans the array
    $query .= "INSERT INTO ".$obj["table"]." ";
    $query .= "(";
    foreach($obj as $key => $value) {
        if($key!='table'){
            $query2[] = $key;
        }
    }

    $query .= implode(",", $query2) . ")  VALUES";  // glue the commas

    $query23= array(); // After the first foreach cleans the array

    foreach($obj as $key => $value) {
        if($key!='table'){

            $query23[] = "'$value'";
        }
    }
    $query .= "(";
    $query .= implode(",", $query23) . ") <br>"; // glue the commas
    $query .= ";";
    
echo $query;
    //mysql_query($dbcon,$query);
    $query = "select * from purchaseorders;";
    if (mysqli_query($dbcon,)) {
        $return['status']=true;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    

    echo json_encode($return);

}


?>