<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_GET['rw_code']))
{
    $rw_code = $_GET['rw_code'];

    $sql = "SELECT r.entrytype as rw_entry,r.*,s.* from rawitemaster r, salesitemaster2 s where rw_code = '$rw_code' AND r.proditemcode=s.itemcode ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();
    $rw_orgid = $row['orgid'];
    $rw_entrytype = $row['rw_entry'];
    $raw_items = $row['raw_items'];
    $raw_items_arr = json_decode($raw_items);
    
    $sql1 = "SELECT * from comprofile where orgid ='001' limit 1 ";
    $result1 = mysqli_query($dbcon,$sql1);
    $row1 =$result1-> fetch_assoc();  
 
    $sql2 = "SELECT orgid,orgname,address,city,state,zip,country,mobile,gstin from comprofile c where c.orgid ='".$rw_orgid."' ";
    $sql2.= " union ";
    $sql2.= "SELECT custid as orgid,custname as orgname,address,city,state,zip,country,mobile,gstin from customerprofile c where c.custid ='".$rw_orgid."' ";

    $result2 = mysqli_query($dbcon,$sql2);
    $row2 =$result2-> fetch_assoc();    

}

function get_itemDetails($dbcon,$code){
    echo $code;
    $sql = "SELECT * from purchaseitemaster where itemcode='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    $ret = "[".$row['itemcode']."]  ".$row['itemname']." &nbsp;|&nbsp; HSN : ".$row['hsncode'];
    return $ret;
}

?> 

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            .p_table{
                border:1px soid #000;
            }
        </style>

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body onload="printInit();">
             <img src="images/logo.png" width="200px" height="100px"/>
       <h5 > <div style="text-align:center">Lento Foods India Private Limited<br>
		</div> </h5>
        <h3>
            <div style="text-align:center;">PRODUCT RAWMATERIALS LIST</div>
        </h3>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b><?php echo $rw_entrytype=="self" ? "Company" : "Customer";      ?> Name & Address</b><br/>

                        <?php echo $row2['orgname']; ?>,<br/>
                        <?php echo $row2['address']; ?>,<br/>
                        <?php echo $row2['city']; ?>-<?php echo $row2['zip']; ?><br/>
                        <?php echo $row2['state']; ?>&nbsp;<?php echo $row2['country']; ?><br/>
                        <b>Mob#:</b>&nbsp;<?php echo $row2['mobile']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row2['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Raw Materials RW_CODE:<b> <?php echo $row['rw_code']; ?></b></td> 
                            </tr> 
                        
                            <tr>
                                <td style="padding:5px;">
                                Product: <b><?php echo $row['itemname']; ?></b>
                                </td> 
                            </tr>  
                            <tr>
                                <td style="padding:5px;"></td> 
                            </tr>    
                        </table>

                    </td>
                </tr>
              <table width="100%" style="">
                    <thead style="border:1px solid #000;text-align:center;">
                        <th style=" width:10%;padding:10px;border:1px solid #000;">Item No.</th>
                        <th style="width:50%;padding:10px;border:1px solid #000;">Item Details</th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Qty </th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Unit</th>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<count($raw_items_arr);$i++){
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$raw_items_arr[$i]->item);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $raw_items_arr[$i]->qty;?>

                            </td>    
                             
                            <td style="padding:10px;padding-left:3%;border-right:1px solid #000;">
                                <?php echo $raw_items_arr[$i]->uom;?>

                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
               
     
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding:10px;text-align:right;">
                            <b>For <?php echo $row1['orgname']; ?></b><br/>
                            <br/>
                            <br/>
                            <b>Authorized Signatory</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </tbody>
        </table>

<script>

               function printInit(){
               window.print();
               window.onbeforeprint = beforePrint;
               window.onafterprint = afterPrint;

               }

                        
                   var beforePrint = function () {
                       // alert('start');
                    };

                    var afterPrint = function () {
                        window.history.back();
                    };
</script>