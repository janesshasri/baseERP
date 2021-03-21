<?php


function get_total_notax($items){
    $amt = 0;
    for($i=0;$i<count($items);$i++){
         $items[$i]->tax_method;
        if($items[$i]->tax_method==0){
             $amt+=  ($items[$i]->rwqty*$items[$i]->rwprice);
        }else{
             $amt+= ($items[$i]->rwqty*$items[$i]->rwprice)*(100/(100+$items[$i]->tax_val));
        }
    }

    return $amt;
}


function getamt_total($arr){
    $items = json_decode($arr, true);
    //(100/($arr->tax_val+100)
    $amt = 0;
    for($i=0;$i<count($items);$i++){
        $ttax = 0;
        if($items[$i]['tax_method']==0){
             $ttax=  ($items[$i]['rwqty']*$items[$i]['rwprice'])*($items[$i]['tax_val']/100);
            $amt+=  ($items[$i]['rwqty']*$items[$i]['rwprice']) + $ttax; 
        }else{
            $taxableamt=  ($items[$i]['rwqty']*$items[$i]['rwprice'])*(100/(100+$items[$i]['tax_val']));
            $ttax+=  $taxableamt*($items[$i]['tax_val']/100);
            $amt+=  $taxableamt + $ttax; 
        }
    }

    return $amt;
}



function gettaxamt_total($arr){
    $ttax=0;
    $items = json_decode($arr, true);
    //(100/($arr->tax_val+100)

    for($i=0;$i<count($items);$i++){
        if($items[$i]['tax_method']==0){
            $ttax+= $items[$i]['rwamt']*($items[$i]['tax_val']/100);
        }else{
            $ttax+= ($items[$i]['rwqty']*$items[$i]['rwprice_org'])*(100/($items[$i]['tax_val']+100));
        }
    }

    return $ttax;

}


function get_id($dbcon,$table,$ui){
    $sql = "SELECT * FROM $table ORDER BY ID DESC LIMIT 1";
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if(count($values)>0){
        $curr_id =  $values[0]['id'];
        $now_id = $curr_id+1;
        $code = $ui.$now_id;  
    }else{
        $code = $ui."1";    
    }

    return $code;
}

function get_taxtype_each($arr){
        $taxString = "";
        if($arr->tax_type=="split"){
            $taxString= "CGST @ ".($arr->tax_val/2)." %<br/>";
            $taxString.= "SGST @ ".($arr->tax_val/2)." %";
        }else{
            $taxString= "IGST @ ".($arr->tax_val);
        }
        return $taxString;
 }

function gettaxamt_print($arr){

    if($arr->tax_method==0){
        return nf(($arr->rwprice*$arr->rwqty)*($arr->tax_val/100));
    }else{
        return nf(($arr->rwprice*$arr->rwqty)*(100/($arr->tax_val+100)));
    }
}


function get_taxtype($arr){

    $taxString = "";
    $splitTaxArr = array();
    $singleTaxArr = array();
   
    foreach($arr as $item)
{ 
    $taxvals[$item->tax_val][] = $item;
}


foreach($taxvals as $item)
{ 
        $taxtypes =array();
        //print_r($item);
        foreach($item as $itemine)
        { 
            $taxtypes[$itemine->tax_type][] = $itemine;
        }

        if(isset($taxtypes['single']) &&count($taxtypes['single'])>0){
            $taxString.= '<tr>';

            $taxString.= '<td width="60%" style="text-align:center;border:0px solid #000;padding:10px;">';
            $taxString.= "IGST @ ".($taxtypes['single'][0]->tax_val/1)." %";
            $taxString.= '</td>';
            $taxString.= '<td width="40%" style="text-align:center;border:0px solid #000;padding:10px;">';
            $taxString.= calctaxAmt($item,'single').'</td>';
            $taxString.= '</tr>';

        }

        if(isset($taxtypes['split']) && count($taxtypes['split'])>0){
            $taxString.= '<tr>';

            $taxString.= '<td width="60%" style="text-align:center;border:0px solid #000;padding:10px;">';
            $taxString.= "CGST @ ".($taxtypes['split'][0]->tax_val/2)." %<br/>";
            $taxString.= "SGST @ ".($taxtypes['split'][0]->tax_val/2)." %";
            $taxString.= '</td>';
            $taxString.= '<td width="40%" style="text-align:center;border:0px solid #000;padding:10px;">';
            $taxString.= calctaxAmt($item,'split').'</td>';
            $taxString.= '</tr>';

        }


    
}
 
    return $taxString;
}


function nf($number){
    return number_format((float)$number, 2, '.', '');
}

function calctaxAmt($arr,$type){
    $amt = "";
    $taxAmt = 0;
    foreach($arr as $item)
    { 
            $splitTax = 0;
            $singleTax = 0;
            
            if($type==$item->tax_type){

               if($item->tax_method==0){
                    $taxAmt+=  nf(($item->rwamt*($item->tax_val/100)));
               }else{
                    $total =  nf(($item->rwamt)*(100/($item->tax_val+100)));
                    $total = nf(($total*($item->tax_val/100)));
                    $taxAmt+= $total;
               }

            }

    }

    if($type=="split"){
       $amt = nf($taxAmt/2)."<br/>".nf($taxAmt/2);
    }else{
       $amt = $taxAmt;
    }

    return $amt;
}

function get_total($so_items_arr){

    $amt = 0;
    for($i=0;$i<count($so_items_arr);$i++){
            $fsubtotal = $so_items_arr[$i]->rwprice*$so_items_arr[$i]->rwqty;

        if($so_items_arr[$i]->tax_method == 1){
            $subtotal = $fsubtotal*(100/($so_items_arr[$i]->tax_val+100));
            $taxval = $subtotal * ($so_items_arr[$i]->tax_val/100);
            $amt = round($amt + ($subtotal + $taxval),2);
        }
        else{
            $subtotal = $fsubtotal;
            $taxval = $so_items_arr[$i]->rwamt*($so_items_arr[$i]->tax_val/100);
            $amt = round($amt + ($subtotal + $taxval),2);
        }
    }

    return nf($amt);
}


function get_grandtotal($po_items_arr){
    $grand_amt = 0;
    for($i=0;$i<count($po_items_arr);$i++){
        $amt = 0;
        $tax = gettaxamt_print($po_items_arr[$i]);
        $grand_amt= $amt+$tax;
    }

    return nf($grand_amt);
}

function get_grandAmttotal($po_items_arr){
    $grand_amt = 0;
    for($i=0;$i<count($po_items_arr);$i++){
        $amt = nf($po_items_arr[$i]->rwqty*$po_items_arr[$i]->rwprice);
        $grand_amt = $grand_amt +$amt;
    }

    return nf($grand_amt);
}

//display amount in words by jayaprakash

function displaywords($number){
    $no = (int)floor($number);
    $point = (int)round(($number - $no) * 100);
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'one', '2' => 'two',
     '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
     '7' => 'seven', '8' => 'eight', '9' => 'nine',
     '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
     '13' => 'thirteen', '14' => 'fourteen',
     '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
     '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
     '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
     '60' => 'sixty', '70' => 'seventy',
     '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
 
 
      if ($number) {
         $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
         $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
         $str [] = ($number < 21) ? $words[$number] .
             " " . $digits[$counter] . $plural . " " . $hundred
             :
             $words[floor($number / 10) * 10]
             . " " . $words[$number % 10] . " "
             . $digits[$counter] . $plural . " " . $hundred;
      } else $str[] = null;
   }
   $str = array_reverse($str);
   $result = implode('', $str);
 
 
   $points = ($point) ?
     "" . $words[floor($point / 10) * 10] . " " . 
           $words[$point = $point % 10] : ''; 
 
   if($points != ''){        
   return $result . "rupees  " . $points . " paise Only";
 } else {
 
     return $result . "rupees Only";
 }
 
 }

function update_open_balance($dbcon,$bal_type){
    if($bal_type=="payables"){
        $sql_q = "select SUM(grn_balance) as payables,grn_po_vendor from grn_notes where grn_payment_status!='Paid' and grn_status='Approved' group by grn_po_vendor;";
        $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");


        while ($row = $exc_q->fetch_assoc()) {
            $vendorid = $row['grn_po_vendor'];
            $opening_bal = $row['payables'];

            $sql90 = " UPDATE vendorprofile SET vendor_opening_bal = '$opening_bal'  WHERE vendorid='".$vendorid."' ;";

            if (mysqli_query($dbcon,$sql90)) {
                $return['status']=true;
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }

        }

    }else if($bal_type=="recievables"){
        $sql_q = "select SUM(inv_balance_amt) as recievables,inv_customer from invoices where inv_payment_status!='Paid' and inv_status='Approved' group by inv_customer;";
        $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");


        while ($row = $exc_q->fetch_assoc()) {
            $custid = $row['inv_customer'];
            $opening_bal = $row['recievables'];

            $sql90 = " UPDATE customerprofile SET cust_opening_bal = '$opening_bal'  WHERE custid='".$custid."' ;";

            if (mysqli_query($dbcon,$sql90)) {
                $return['status']=true;
            }else{
                $return['status']=false;
                $return['error']=mysqli_error($dbcon);
            }

        }

    }
}


function query_genrator($array,$id,$table,$col){
    $obj = json_decode($array,true);
    $query = "";

    $query2 = array(); // After loop cleans the array

    foreach($obj as $key => $value) {
        if($key!='table'){
            $query2[] = $key."='".$value."'";
        }
    }
    // print_r($query2);
    $query = "UPDATE $table SET ";
    $query .= implode(",", $query2) ;  // glue the commasecho
    if($id!=""){
        $query.= " WHERE $col='$id' ;";
    }
    return $query;

}

function insertRow($dbcon,$table,$row){
    $query = "";

    $query2 = array(); // After loop cleans the array
    $query3 = array(); // After loop cleans the array

    $query = "INSERT INTO $table ";

    foreach($row as $key => $value) {
        if($key!='table'){
            $query2[] = $key;
            $query3[] = "'".$value."'";
        }
    }
 
    $query.="(".implode(",", $query2).")";
    $query.=" VALUES (".implode(",", $query3).") ;";

    if (mysqli_query($dbcon,$query)) {
        $return['status']=true;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    return $return;
}

function findbyand($dbcon,$col_val,$table,$col){
    $sql=" SELECT * FROM $table where $col='$col_val'; "; 
    $result = mysqli_query($dbcon, $sql);
    $values = sql_fetch_all($result);

    if (mysqli_num_rows($result) > 0) {
        $return['status']=true;
        $return['values']=$values;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    return $return;
}

function findLastTrans($dbcon,$col_val,$table,$col){
    $sql=" SELECT * FROM $table where $col='$col_val' ORDER BY trans_id DESC LIMIT 1; "; 
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
    return $return;
}

function updatebyand($dbcon,$col_val,$table,$col,$cond_col,$cond_val){
    $sql=" UPDATE  $table SET $col='$col_val' "; 
    if($cond_col){
        $sql.=" WHERE $cond_col='$cond_val'; "; 
    }else{
        $sql.=";";
    }

    if (mysqli_query($dbcon,$sql)) {
        $return['status']=true;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    return $return;
}

function updateNumericbyand($dbcon,$col_val,$table,$col,$cond_col,$cond_val){
     $sql=" UPDATE  $table SET $col=$col$col_val "; 
    if($cond_col){
        $sql.=" WHERE $cond_col='$cond_val'; "; 
    }else{
        $sql.=";";
    }

  //  echo $sql;

    if (mysqli_query($dbcon,$sql)) {
        $return['status']=true;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    return $return;
}

function updatevalbyand($dbcon,$col_val,$table,$col,$cond_col,$cond_val){
   $sql=" UPDATE  $table SET $col= $col+($col_val) "; 
    if($cond_col){
        $sql.=" WHERE $cond_col='$cond_val'; "; 
    }else{
        $sql.=";";
    }

    if (mysqli_query($dbcon,$sql)) {
        $return['status']=true;

    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }
    return $return;
}


function update_query($dbcon,$array,$grn_id,$table,$col){
    $return2=array();

    $sql3 =  query_genrator($array,$grn_id,$table,$col);
    if (mysqli_query($dbcon,$sql3)) {

        $return['status']=true;
    }else{
        $return['status']=false;
        $return['error']=mysqli_error($dbcon);
    }

    return $return;

}

function sql_fetch_all($result){

    
    $results_array = array();
    
    while ($row = $result->fetch_assoc()) {
        $results_array[] = $row;
    }

    $values = $results_array;

    return $values;

}

function getTotalClosingBal($dbcon,$compId){
   $sql = "SELECT cash_on_hand ,petty_cash_bal FROM comprofile  WHERE orgid='".$compId."' LIMIT 1 ";
    $result = mysqli_query($dbcon, $sql);
    while ($row = $result->fetch_assoc()) {
        return $row;
    }
}

function handleTransaction($dbcon,$compId,$entry,$transid,$transData,$effectOn){
         
    
        if ($transid=="") {
            $transid = get_id($dbcon,"transactions","TRN-00");
            $lastRow = getTotalClosingBal($dbcon,$compId);

            $sql = "INSERT INTO transactions (trans_id) VALUES ('$transid')";

            if (mysqli_query($dbcon,$sql)) {
             
                $transData['total_closing_bal'] = $lastRow['closing_bal'];
                $transData['total_cash_on_hand'] = $lastRow['cash_on_hand'];
                $transData['total_petty_cash'] = $lastRow['petty_cash_bal'];

                if($entry['entity'] !== "Bank Deposit" && $effectOn==="Cash"){
                    echo $transData['total_petty_cash'];
                    echo "==".$transData['trans_amt'];
                    echo "==".$transData['trans_type'];
                    echo "==".$transData['total_petty_cash'] = $transData['trans_type'] == "credit" ? $transData['total_petty_cash']+$transData['trans_amt'] : $transData['total_petty_cash']-$transData['trans_amt'];
                }else{
                    echo $transData['trans_type'];
                    echo $transData['trans_amt'];
                    echo $transData['total_closing_bal'];
                    echo $transData['total_closing_bal'] = $transData['trans_type'] == "credit" ? $transData['total_closing_bal']+$transData['trans_amt'] : $transData['total_closing_bal']-$transData['trans_amt'];
                }

               // print_r($transData);

                $return = update_query($dbcon,json_encode($transData),$transid,"transactions","trans_id");
                 echo $effectOn;
                if ($return['status']){
                    if($effectOn==="Bank Transfer" || $effectOn==="Cheque"){
                        echo "bank";
                        $pastVal = findbyand($dbcon,$transData['trans_bank'],'compbank','id');
                        $bank = array();
                        $bank['closing_bal'] = $transData['trans_type'] == "credit" ? $pastVal['values'][0]['closing_bal']+$transData['trans_amt'] : $pastVal['values'][0]['closing_bal']-$transData['trans_amt']  ;
                        //update bank
                        $return = update_query($dbcon,json_encode($bank),$transData['trans_bank'],"compbank","id");
                        if ($return['status']){
                            $pastValcomp = findbyand($dbcon,$compId,'comprofile','orgid');
                            $comprofile = array();
                            $comprofile['closing_bal'] = $transData['trans_type'] == "credit" ? $pastValcomp['values'][0]['closing_bal']+$transData['trans_amt'] : $pastValcomp['values'][0]['closing_bal']-$transData['trans_amt']  ;
                            $return = update_query($dbcon,json_encode($comprofile),$compId,"comprofile","orgid");
                        }else{
                            return $return;
                        }
                    }else if($effectOn==="Cash"){
                        $pastValcomp = findbyand($dbcon,$compId,'comprofile','orgid');
                        $comprofile = array();
                        $comprofile['petty_cash_bal'] = $transData['trans_type'] == "credit" ? $pastValcomp['values'][0]['petty_cash_bal']+$transData['trans_amt'] : $pastValcomp['values'][0]['petty_cash_bal']-$transData['trans_amt']  ;
                        $return = update_query($dbcon,json_encode($comprofile),$compId,"comprofile","orgid");

                    }else{
                        
                    }
                 
                }else{
                    return $return;
                }
            }else{
                return $return;
            }
        }else{ // reversing transaction
 
        }
    return $return; 
}

function modifyCompValues($dbcon,$type,$amt,$id,$transType){
     $res = array();
     $amt = $transType === "credit" ? $amt : -$amt ; 
        if($type==="cash_on_hand" || $type==="petty_cash_bal"){
            $res = updatevalbyand($dbcon,$amt,'comprofile',$type,'orgid',$id);
        }else if($type==="closing_bal"){
            $res = updatevalbyand($dbcon,$amt,'compbank',$type,'id',$id);
        }

        return $res;
}

function createTransaction($dbcon,$compId,$transid,$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_type){

    $transData = array();
    $res = array();
    $transData['trans_entry_type']=$trans_dir;
    $transData['trans_entry_ref']="";
    $transData['trans_row_id']=$rowId;
    $transData['trans_type']=$trans_type;
    $transData['trans_entity']=$entity;
    $transData['trans_amt']=$data['amount'];
    $transData['trans_mode']=$data['payment_mode'];
    $transData['trans_bank']=$data['trans_bank'];
    $transData['total_closing_bal']=$compBank!="" ? $compBank['closing_bal'] : "";
    $transData['total_cash_on_hand']= $compData['cash_on_hand'];;
    $transData['total_petty_cash']= $compData['petty_cash_bal'];
    $transData['trans_entry']= json_encode($data);
    $transData['trans_status']= "Completed";
    $transData['trans_handler']= $handler;

    if ($transid=="") {
        $transid = get_id($dbcon,"transactions","TRN-00");

        $sql = "INSERT INTO transactions (trans_id) VALUES ('$transid')";

        if (mysqli_query($dbcon,$sql)) {
            $res = update_query($dbcon,json_encode($transData),$transid,"transactions","trans_id");
        }else{
            $res['status'] = false;
        }
    }

  return $res;
}

function handleTransactionNew($dbcon,$data,$entity,$rowId,$compId,$handler,$trans_dir){

    $compData = getTotalClosingBal($dbcon,$compId);
    $compBank = $data['trans_bank']!=="" ? findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0] : "";
    $res = array();
   // echo $entity;
    if($entity==="bankdeposit"){

           if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

                // check balanace
                if($trans_dir==="normal" && $compData['cash_on_hand']>=$data['amount']){
                       $res = modifyCompValues($dbcon,"cash_on_hand",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");
                    if($res['status']){
                       $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['bankname'],$trans_dir==="normal"?"credit":"debit");
                    }else{
                       $res['status'] = false;
                    }
                }else{
                    $res['status'] = false;
                    $res['message'] = "Insuffucient Funds";
                }

           }else{
             $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['bankname'],$trans_dir==="normal"?"credit":"debit");
                   
           }


        if($res['status']){
            $compBank = findbyand($dbcon,$data['bankname'],'compbank','id')['values'][0];
            $compData = getTotalClosingBal($dbcon,$compId);
            $data['trans_bank'] = $data['bankname'];
            $res = updatebyand($dbcon,$compBank['closing_bal'],"bankdeposit","closing_bal","transid",$rowId);
            if($res['status']){
                $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"credit":"debit");
            }else{
                $res['status'] = false;
            }
         }else{
             $res['status'] = false;
         }

    }else if($entity==="bankwithdrawels"){
        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

            // check balanace
            if($compBank['closing_bal']>=$data['amount']){
                   $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['bankname'],$trans_dir==="normal"?"debit":"credit");
                   if($res['status']){
                    $res = modifyCompValues($dbcon,"cash_on_hand",$data['amount'],$compId,"credit");
                }else{
                      $res['status'] = false;
                      $res['message'] = "Insuffucient Funds";
                  }
            }else{
                $res['status'] = false;
                $res['message'] = "Insuffucient Funds";
            }

       }
       
        if($res['status']){
            $compBank = findbyand($dbcon,$data['bankname'],'compbank','id')['values'][0];
            $compData = getTotalClosingBal($dbcon,$compId);
            $data['trans_bank'] = $data['bankname'];

            $res = updatebyand($dbcon,$compBank['closing_bal'],"bankwithdrawels","closing_bal","transid",$rowId);
            if($res['status']){
                $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
            }
        }else{
            $res['status'] = false;
        }

    }else if($entity==="vendorcredits"){

        
            if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

                // check balanace
                if($compData['petty_cash_bal']>=$data['amount']){
                    $res = modifyCompValues($dbcon,"petty_cash_bal",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");
                }else{
                    $res['status'] = false;
                    $res['message'] = "Insuffucient Funds";
                }

            }else{
                $compBank = findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0];
                if($compBank['closing_bal']>=$data['amount']){
                    $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['trans_bank'],$trans_dir==="normal"?"debit":"credit");
                }else{
                    $res['status'] = false;
                    $res['message'] = "Insuffucient Funds";
                }
                    
            }

            if($res['status']){
                $compBank = $data['payment_mode']!=="Cash" ? findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0] : "";
                $compData = getTotalClosingBal($dbcon,$compId);
                $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
            }

    }else if($entity==="payments"){

        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

            // check balanace
            if($compData['petty_cash_bal']>=$data['amount']){
                $res = modifyCompValues($dbcon,"petty_cash_bal",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
                $res['message'] = "Insuffucient Funds";
            }

        }else{
            $compBank = findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0];
            if($compBank['closing_bal']>=$data['amount']){
                $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['trans_bank'],$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
                $res['message'] = "Insuffucient Funds";
            }
                
        }

        if($res['status']){
            $compBank = $data['payment_mode']!=="Cash" ? findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0] : "";
            $compData = getTotalClosingBal($dbcon,$compId);
            $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"debit":"debit");
        }else{
            $res['status'] = false;
        }

    }else if($entity==="expenses"){

            
        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

            // check balanace
            if($compData['petty_cash_bal']>=$data['amount']){
                $res = modifyCompValues($dbcon,"petty_cash_bal",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
                $res['message'] = "Insuffucient Funds";
            }

        }else{
            $compBank = findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0];
            if($compBank['closing_bal']>=$data['amount']){
                $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['trans_bank'],$trans_dir==="normal"?"debit":"credit");
            }else{
                $res['status'] = false;
                $res['message'] = "Insuffucient Funds";
            }
        }
        
        if($res['status']){
            $compBank = $data['payment_mode']!=="Cash" ? findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0] : "";
            $compData = getTotalClosingBal($dbcon,$compId);
            $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"debit":"credit");
             }else{
            $res['status'] = false;
        }

    }else if($entity==="customercredits"){

        
        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c
            $res = modifyCompValues($dbcon,"cash_on_hand",$data['amount'],$compId,$trans_dir==="normal"?"credit":"debit");
        }else{
            $compBank = findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0];
            $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['trans_bank'],$trans_dir==="normal"?"credit":"debit");
                
        }

        if($res['status']){
            $compBank = $data['payment_mode']!=="Cash" ? findbyand($dbcon,$data['customer_credits_bank'],'compbank','id')['values'][0] : "";
            $compData = getTotalClosingBal($dbcon,$compId);
            $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"credit":"debit");
        }else{
            $res['status'] = false;
        }

    }else if($entity==="customer_payments"){

                //   print_r($data);
        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c
            $res = modifyCompValues($dbcon,"cash_on_hand",$data['amount'],$compId,$trans_dir==="normal"?"credit":"debit");
        }else{
            //print_r($data);
            $compBank = findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0];
            $res = modifyCompValues($dbcon,"closing_bal",$data['amount'],$data['trans_bank'],$trans_dir==="normal"?"credit":"debit");
        }

        if($res['status']){
            $compBank = $data['payment_mode']!=="Cash" ? findbyand($dbcon,$data['trans_bank'],'compbank','id')['values'][0] : "";
            $compData = getTotalClosingBal($dbcon,$compId);

            $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"credit":"debit");
        }else{
            $res['status'] = false;
        }

    }else if($entity==="pettycashconv"){

            
        if($data['payment_mode']==="Cash"){   //deduct undeposited funds // add closing bal to bank a/c

            if($compData['cash_on_hand']>=$data['amount']){
                $res = modifyCompValues($dbcon,"cash_on_hand",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");

                    if($res['status']){
                        $res = modifyCompValues($dbcon,"petty_cash_bal",$data['amount'],$compId,$trans_dir==="normal"?"debit":"credit");
                    }else{
                        $res['status'] = false;
                    }
                }else{
                    $res['status'] = false;
                    $res['message'] = "Insuffucient Funds";
                }
        }

        if($res['status']){
            $res = createTransaction($dbcon,$compId,"",$rowId,$data,$compData,$compBank,$handler,$trans_dir,$entity,$trans_dir==="normal"?"credit":"debit");
        }else{
            $res['status'] = false;
        }

    }

    return $res;
}


?>

