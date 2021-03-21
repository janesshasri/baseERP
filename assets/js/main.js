    var Page = {
        load_select_options: function (selector, columns,table, tag , key, label,type) {
            var output = {};
            var values = [];
            var url="";


            url = "workers/getters/get_select_options.php";

            $.ajax({
                url: url,
                type: "post",
                async: false,
                data: {table:table,columns:JSON.stringify(columns)},
                success: function (x) {
                    values = x.values;
                    Page.plant(selector,x.status,values,key,label,type,tag);
                }
            });

        },
        plant: function(selector,status,values,key,label,type,tag){
            if (status) {
                var pages_select_option = "";
                pages_select_option+='<option value="">--Select ' + tag + '--</option>';
                for (i = 0; i < values.length; i++) {
                    if(label==null){
                        pages_select_option += '<option value="' + values[i][key] + '">' + values[i][key]+ '</option>';      
                    }else if(type==3){
                        pages_select_option += '<option value="' + values[i][key] + '"> '+values[i][label]+ '</option>';      
                    }else{
                        pages_select_option += '<option data-val="'+values[i][label]+'" value="' + values[i][key] + '">[' + values[i][key]+'] '+values[i][label]+ '</option>';      
                    }

                }
                $('#' + selector).html('');
                $('#' + selector).html(pages_select_option);
            } else {
                $('#' + selector).html('<option value="">There are no '+tag+'</option>');
                $('#' + selector).append('<small id="fileHelp" class="form-text text-muted">There are no Approved PO Orders</small>');

            }
        },
        get_edit_vals: function (id,table,col){
            var values = {};
            var return_d ="";
            url = "workers/getters/get_edit_data.php";

            $.ajax({
                url: url,
                type: "post",
                async: false,
                data: {table:table,id:id,col:col},
                success: function (x) {
                    var res = JSON.parse(x);
                  if(res.status){
                    values = res.values[0];
                  }else{
                    values = {};
                  }
                }
            });

            return (values);
        },
        send_sms: function(message,number){
            $.ajax({
                url: "workers/senders/smser.php",
                type: "post",
                async: false,
                data: {message:message, number:number},
                success: function (x) {
                    console.log(x);
                }
            });
        },
        get_multiple_vals: function (id,table,col){
            var values = [];
            //   var return_d ="";
            url = "workers/getters/get_multiple_data.php";

            $.ajax({
                url: url,
                type: "post",
                async: false,
                data: {table:table,id:id,col:col},
                success: function (x) {

                    var obj = JSON.parse(x);
                    values = obj.values;
                }
            });

            return (values);
        },
        get_vals_by_condition: function (table,condition){
            var values = [];
            url = "workers/getters/get_values_by_cond.php";

            $.ajax({
                url: url,
                type: "post",
                async: false,
                data: {table:table,condition:JSON.stringify(condition)},
                success: function (x) {
                    var obj = JSON.parse(x);
                    if(obj.status){
                        values = obj.values[0];
                    }else{
                        values = {};
                    }
                }
            });

            return (values);
        },
        get_lasttc:function(table){
            var lasttc = '';
            $.ajax({
                url: "workers/getters/get_lasttc.php?table=" + table,
                type: "GET",
                async: false,
                success: function(x) {
                    var ret = JSON.parse(x);   
                    if(ret.status){
                        if(table=="purchaseorders"){
                            lasttc = ret.values[0].po_tc;

                        }else if(table=="estimates"){
                            lasttc = ret.values[0].est_tc;

                        }
                    }
                }
            });

            return lasttc;
        }

    };


    var rowitem = {
        purchase_entry:true,
        set_itemrow: function (ele,type){
            var itemcodeId = $(ele).val();
            $.ajax({
                url: "workers/getters/get_itemdata.php?itemcodeId=" + itemcodeId+"&itemType="+type,
                type: "post",
                async: false,
                success: function(x) {
                    var output = JSON.parse(x);
                    if (output.status) {
                        rowitem.post_itemrow(ele,output.values[0]);
                    } else {
                    }
                }
            });
        },
        post_itemrow: function(ele,vals){
            if(vals.taxmethod==1){
                var price = vals.priceperqty - (vals.priceperqty*(vals.taxrate/100));
            }else{
                var price = vals.priceperqty;
            }
            $(ele).closest('tr').find('#hsncode').val(vals.hsncode);
            $(ele).closest('tr').find('#price').val(vals.priceperqty);
            $(ele).closest('tr').find('#price').attr('data-price',vals.priceperqty);
            $(ele).closest('tr').find('#qty').val(1);
            $(ele).closest('tr').find('#amount').val(price*1);
            $(ele).closest('tr').find('#taxname').val(vals.taxid);
            $(ele).closest('tr').find('#taxname').attr('data-taxmethod',vals.taxmethod);
            $(ele).closest('tr').find('#uom').val(vals.uom);

            rowitem.update_math_vals();
        },
        update_math_vals: function(){

            var item_select = $('#tb tr').eq(1).find('#item_select').val();
            if(item_select!=''){

                var rowCount = $('#tb tr').length;
                var posubtotal = 0;
                var taxarray = [];
                for(i=1;i<rowCount;i++){ 
                    var rwqty = $('#tb tr').eq(i).find('#qty').val();
                    var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                    var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                    var tax_name = $('#tb tr').eq(i).find('#taxname option:selected').text();
                    var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    var fsubtotal = 0
                    fsubtotal=rwqty*rwprice;
                    if(tax_method == 1){
                        posubtotal = posubtotal + (eval(fsubtotal)*(100/(eval(tax_val)+100)))
                    }
                    else{
                        posubtotal = posubtotal + fsubtotal
                    }

                    $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                    var taxsys = {
                        tax_desc : tax_name,
                        tax_val : tax_val,
                        tax_type : tax_type,
                        tax_method : tax_method,
                        tax_name : tax_name,
                        rwprice : rwprice,
                        rwqty : rwqty,
                    };

                    taxarray[i-1]=taxsys;

                }


                $('#posubtotal').text(eval(posubtotal).toFixed(2));

                var podiscount = $('#podiscount').val();
                var discmeth = $('#discoutTypeTextbutton').attr('data-meth');
                var podeduction= 0 ;
                if(podiscount!=0){
                    if(discmeth=="flat"){
                        podeduction = eval(podiscount);
                    }else{
                        podeduction = eval(posubtotal*(podiscount/100)).toFixed(2);
                    }  
                }


                $('#podiscountText').text(podeduction);

                var tax_text = rowitem.gettax_text(taxarray);
                $('#taxdiv').html('');
                $('#taxdiv').html(tax_text.taxhtml);

                var pograndtotal = (eval(posubtotal - podeduction));
                pograndtotal = (eval(pograndtotal) + eval(tax_text.total_tax_amt_master)).toFixed(2);

                $('#pograndtotal').text(pograndtotal);
                var poadjustmentval = $('#poadjustmentval').val();

                if(poadjustmentval!=0){
                    var finalval = (eval(pograndtotal)+eval(poadjustmentval)).toFixed(2);
                    $('#poadjustment').text(finalval);
                    $('#pobaltotal').text(finalval);   
                }else{
                    $('#pobaltotal').text(pograndtotal);   

                }



            }
        },
        gettax_text: function(taxarray){

            function groupBy(data, property) {
                return data.reduce((acc, obj) => {
                const key = obj[property];
                if (!acc[key]) {
                    acc[key] = [];
                }
                acc[key].push(obj);
                return acc;
                }, {});
            }

            var return_val = {};
            var taxhtml = "";
            globpblist=taxarray;

            var groupedByTaxval = groupBy(globpblist, 'tax_val');
            

            for (var key in groupedByTaxval) {
        
        
                var groupedByTaxtype = groupBy(groupedByTaxval[key], 'tax_type');

                if ('single' in groupedByTaxtype){
                        taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">IGST @ '+groupedByTaxval[key][0].tax_val+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'single')+'</span></div>'+
                        '  </div></div>';
                }

                
                if ('split' in groupedByTaxtype){
                    taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">CGST @ '+groupedByTaxval[key][0].tax_val/2+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'split')+'</span></div>'+
                        '  </div>'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">SGST @ '+groupedByTaxval[key][0].tax_val/2+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'split')+'</span></div>'+
                        '  </div>'+
                        ' </div> ';   
                }
                
            
                
            }

            return {
                taxhtml:  taxhtml,
                total_tax_amt_master: rowitem.get_taxamount()
            };
            
        },
        calcTaxAmt: function(arr,type){
        var amt = "";
        
        var TaxAmt = 0;
        for(var a=0;a<arr.length;a++)
        { 

            if(type == arr[a].tax_type){

            if(arr[a].tax_method==0){
                    TaxAmt+=  eval(arr[a].rwqty)*eval(arr[a].rwprice)*(eval(arr[a].tax_val)/100);
            }else{
                    var total =  eval(arr[a].rwprice)*eval(arr[a].rwqty)*(100/(eval(arr[a].tax_val)+100));
                    total =  total*(eval(arr[a].tax_val)/100);
                    TaxAmt+= total;
            }
        }

        }

        if(type == "split"){
            amt = (TaxAmt/2).toFixed(2);
        }else{
            amt = TaxAmt.toFixed(2);
        }
    
        return amt;

        },
        nf: function (number){
        return number.toFixed(2);
        },
        get_taxamount: function (){

            var rowCount = $('#tb tr').length;

            total_taxval = 0;
            var taxinloop = 0

            for(i=1;i<rowCount;i++){ 
                var itax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                var taxmethod = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                // var taxprice = $('#tb tr').eq(i).find('#price').attr('data-price');
                var taxqty = $('#tb tr').eq(i).find('#qty').val();
            var taxprice = $('#tb tr').eq(i).find('#price').val()
                var taxamt = taxprice*taxqty;
                    if(taxmethod == 1){
                        taxinloop = (eval(taxamt)*(100/(eval(itax_val)+100)));
                        taxinloop = taxinloop*(eval(itax_val)/100)    
                        total_taxval = total_taxval+taxinloop;
                    }else{
                        total_taxval =total_taxval+(eval(taxamt)*(eval(itax_val)/100));
                    }

            }

            return total_taxval;
        },
        chgdiscount_type:function(x){
            var discountMeth = $(x).attr('data-meth');
            if(discountMeth=="flat"){
                $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                $('#discoutTypeTextbutton').attr('data-meth','flat');
            }else{
                $('#discoutTypeTextbutton #discoutTypeText').html('%');
                $('#discoutTypeTextbutton').attr('data-meth','percent');

            }
            rowitem.update_math_vals();

        },
        stkalert:function(x){
            //alert();
            var itemcode = $(x).closest('td').prev('td').prev('td').find('#item_select').val();
            //alert(itemcode);
            var item_det = Page.get_edit_vals(itemcode,'purchaseitemaster',"id");
            var inQty = eval($(x).val());
            if(inQty>eval(item_det.stockinqty)){
                error='<span class="text-danger">The Qty entered is greater than the available stock '+item_det.stockinqty+' ,please enter lesser qty</span>';
                $('#show_errors').show();
                $('#show_errors').html(error);
                $(x).css('border','1px solid red');
                rowitem.purchase_entry=false;

            }else if((item_det.stockinqty-inQty)<=item_det.lowstockalert){
                error='<span class="text-danger">Qty on hand '+item_det.stockinqty+' &nbsp;|&nbsp; low stock alert = '+item_det.lowstockalert+'</span>';
                $('#show_errors').show();
                $('#show_errors').html(error);
                $(x).css('border','inherit');
                rowitem.purchase_entry=true;

            }else{
                $('#show_errors').hide();
                $('#show_errors').html('');
                $(x).css('border','inherit');
                rowitem.purchase_entry=true;

            }


        }

    };


    var sales_rowitem = {
        sales_entry:true,
        set_itemrow: function (ele,type,manual){
            var itemcodeId = $(ele).val();
            $.ajax({
                url: "workers/getters/get_itemdata.php?itemcodeId=" + itemcodeId+"&itemType="+type,
                type: "post",
                async: false,
                success: function(x) {
                    var output = JSON.parse(x);
                    if (output.status) {
                        sales_rowitem.post_itemrow(ele,output.values[0],manual);
                    } else {
                    }
                }
            });
        },
        post_itemrow: function(ele,vals,manual){

            // if(vals.sales_taxmethod==1){
                
            //     var price = vals.sales_priceperqty - (vals.sales_priceperqty*(vals.sales_taxrate/100));
            // }
            // else{
            //     var price = vals.sales_priceperqty;
            // }
            //console.log(vals);
            $(ele).closest('tr').find('#hsncode').val(vals.hsncode);
            $(ele).closest('tr').find('#price').val(vals.sales_priceperqty);
            $(ele).closest('tr').find('#price').attr('data-price',vals.sales_priceperqty);
            $(ele).closest('tr').find('#qty').val(1);
            $(ele).closest('tr').find('#amount').val(vals.sales_priceperqty*1);
            $(ele).closest('tr').find('#taxname').val(vals.sales_taxid);
            $(ele).closest('tr').find('#taxname').attr('data-taxmethod',vals.sales_taxmethod);
            $(ele).closest('tr').find('#uom').val(vals.sales_uom);
            if(manual != undefined ){
                if(manual == 'manual')
                sales_rowitem.update_math_vals_for_manual();
            }else{
                sales_rowitem.update_math_vals();
            }
            
        },
        update_math_vals: function(){

            var item_select = $('#tb tr').eq(1).find('#item_select').val();
            if(item_select!=''){

                var rowCount = $('#tb tr').length;
                var posubtotal = 0;
                var taxarray = [];
                for(i=1;i<rowCount;i++){ 
                    var rwqty = $('#tb tr').eq(i).find('#qty').val();
                    var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                    var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                    var tax_name = $('#tb tr').eq(i).find('#taxname option:selected').text();
                    var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    var fsubtotal = 0
                    fsubtotal=rwqty*rwprice;
                    if(tax_method == 1){
                        posubtotal = posubtotal + (eval(fsubtotal)*(100/(eval(tax_val)+100)))
                    }
                    else{
                        posubtotal = posubtotal + fsubtotal
                    }
                    $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                    var taxsys = {
                        tax_desc : tax_name,
                        tax_val : tax_val,
                        tax_type : tax_type,
                        tax_method : tax_method,
                        rwqty : rwqty,
                        rwprice : rwprice
                    };

                    taxarray[i-1]=taxsys;

                }

                $('#posubtotal').text(eval(posubtotal).toFixed(2));

                var podiscount = $('#podiscount').val();
                var discmeth = $('#discoutTypeTextbutton').attr('data-meth');
                var podeduction= 0 ;
                if(podiscount!=0){
                    if(discmeth=="flat"){
                        podeduction = eval(podiscount);
                    }else{
                        podeduction = eval(posubtotal*(podiscount/100)).toFixed(2);
                    }  
                }


                $('#podiscountText').text(podeduction);

                var tax_text = sales_rowitem.gettax_text(taxarray);
                $('#taxdiv').html('');
                $('#taxdiv').html(tax_text.taxhtml);

                var pograndtotal = (eval(posubtotal - podeduction));
                pograndtotal = (eval(pograndtotal) + eval(tax_text.total_tax_amt_master)).toFixed(2);

                $('#pograndtotal').text(pograndtotal);
                var poadjustmentval = $('#poadjustmentval').val();

                if(poadjustmentval!=0){
                    var finalval = (eval(pograndtotal)+eval(poadjustmentval)).toFixed(2);
                    $('#poadjustment').text(finalval);
                    $('#pobaltotal').text(finalval);   
                }else{
                    $('#pobaltotal').text(pograndtotal);   

                }



            }
        },
        update_math_vals_for_manual: function(){

            var item_select = $('#tb tr').eq(1).find('#item_select').val();
            if(item_select!=''){

                var rowCount = $('#tb tr').length;
                var posubtotal = 0;
                var taxarray = [];
                for(i=1;i<rowCount;i++){ 

                    var rwqty = $('#tb tr').eq(i).find('#qty').val();
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    posubtotal+=rwqty*rwprice;
                    $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                }

                $('#posubtotal').text(eval(posubtotal).toFixed(2));

                var podiscount = $('#podiscount').val();
                var discmeth = $('#discoutTypeTextbutton').attr('data-meth');
                var podeduction= 0 ;
                if(podiscount!=0){
                    if(discmeth=="flat"){
                        podeduction = eval(podiscount);
                    }else{
                        podeduction = eval(posubtotal*(podiscount/100)).toFixed(2);
                    }  
                }


                $('#podiscountText').text(podeduction);
                var pograndtotal = (eval(posubtotal - podeduction));
                pograndtotal = (eval(pograndtotal)).toFixed(2);

                $('#pograndtotal').text(pograndtotal);
                var poadjustmentval = $('#poadjustmentval').val();

                if(poadjustmentval!=0){
                    var finalval = (eval(pograndtotal)+eval(poadjustmentval)).toFixed(2);
                    $('#poadjustment').text(finalval);
                    $('#pobaltotal').text(finalval);   
                }else{
                    $('#pobaltotal').text(pograndtotal);   

                }



            }
        },
        gettax_text: function(taxarray){

            function groupBy(data, property) {
                return data.reduce((acc, obj) => {
                const key = obj[property];
                if (!acc[key]) {
                    acc[key] = [];
                }
                acc[key].push(obj);
                return acc;
                }, {});
            }

            var return_val = {};
            var taxhtml = "";
            globpblist=taxarray;

            var groupedByTaxval = groupBy(globpblist, 'tax_val');
            

            for (var key in groupedByTaxval) {
        
        
                var groupedByTaxtype = groupBy(groupedByTaxval[key], 'tax_type');

                if ('single' in groupedByTaxtype){
                        taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">IGST @ '+groupedByTaxval[key][0].tax_val+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'single')+'</span></div>'+
                        '  </div></div>';
                }

                
                if ('split' in groupedByTaxtype){
                    taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">CGST @ '+groupedByTaxval[key][0].tax_val/2+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'split')+'</span></div>'+
                        '  </div>'+
                        ' <div class="row">'+
                        ' <div class="col-md-8 text-left"><p class="h6">SGST @ '+groupedByTaxval[key][0].tax_val/2+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+rowitem.calcTaxAmt(groupedByTaxval[key],'split')+'</span></div>'+
                        '  </div>'+
                        ' </div> ';   
                }
                
            
                
            }

            return {
                taxhtml:  taxhtml,
                total_tax_amt_master: rowitem.get_taxamount()
            };
            
        },
        calcTaxAmt: function(arr,type){
            console.log(arr);
        var amt = "";
        
        var TaxAmt = 0;
        for(var a=0;a<arr.length;a++)
        { 

            if(type == arr[a].tax_type){

            if(arr[a].tax_method==0){
                    TaxAmt+=  eval(arr[a].rwqty)*eval(arr[a].rwprice)*(eval(arr[a].tax_val)/100);
            }else{
                    var total =  eval(arr[a].rwprice)*eval(arr[a].rwqty)*(100/(eval(arr[a].tax_val)+100));
                    total =  total*(eval(arr[a].tax_val)/100);
                    TaxAmt+= total;
            }
        }

        }

        if(type == "split"){
            amt = (TaxAmt/2).toFixed(2);
        }else{
            amt = TaxAmt.toFixed(2);
        }
    
        return amt;

        },
        nf: function (number){
        return number.toFixed(2);
        },
        get_taxamount: function (taxval){

            var rowCount = $('#tb tr').length;

            total_taxval = 0;
            for(i=1;i<rowCount;i++){ 
                var taxinloop = 0
                var itax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                var taxmethod = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                // var taxprice = $('#tb tr').eq(i).find('#price').attr('data-price');
                var taxqty = $('#tb tr').eq(i).find('#qty').val();
            var taxprice = $('#tb tr').eq(i).find('#price').val()
                var taxamt = taxprice*taxqty;
                if(itax_val==taxval){
                    if(taxmethod == 1){
                        taxinloop = (eval(taxamt)*(100/(eval(taxval)+100)));
                        taxinloop = taxinloop*(eval(taxval)/100)    
                        total_taxval = total_taxval+taxinloop
                    }
                    else{
                        total_taxval =total_taxval+(eval(taxamt)*(eval(taxval)/100));
                    }

                }
            }

            return total_taxval;
        },
        stkalert:function(x){
            //alert();
            var itemcode = $(x).closest('td').prev('td').prev('td').find('#item_select').val();
            var item_det = Page.get_edit_vals(itemcode,'salesitemaster2',"id");
            var inQty = eval($(x).val());
            if(inQty>eval(item_det.stockinqty)){
                error='<span class="text-danger">The Qty entered is greater than the available stock '+item_det.stockinqty+' ,please enter lesser qty</span>';
                $('#show_errors').show();
                $('#show_errors').html(error);
                $(x).css('border','1px solid red');
                sales_rowitem.sales_entry=false;
            }else if((item_det.stockinqty-inQty)<=item_det.lowstockalert){
                error='<span class="text-danger">Qty on hand '+item_det.stockinqty+' &nbsp;|&nbsp; low stock alert = '+item_det.lowstockalert+'</span>';
                $('#show_errors').show();
                $('#show_errors').html(error);
                $(x).css('border','inherit');
                sales_rowitem.sales_entry=true;

            }else{
                $('#show_errors').hide();
                $('#show_errors').html('');
                $(x).css('border','inherit');
                sales_rowitem.sales_entry=true;

            }


        }

    };

    var scrap_rowitem = {
        scrap_entry:true,
        stkalert:function(x){
            //alert();
            var itemcode = $(x).closest('td').prev('td').find('#item_select').val();
            var item_det = Page.get_edit_vals(itemcode,'scrapinventory','scrap_itemcode');
            var inQty = eval($(x).val());
            if(inQty>eval(item_det.scrap_inventory_qty)){
                error='<span class="text-danger">The Qty entered is greater than the available stock '+item_det.scrap_inventory_qty+' ,please enter lesser qty</span>';
                $('#show_errors').show();
                $('#show_errors').html(error);
                $(x).css('border','1px solid red');
                scrap_rowitem.scrap_entry=false;
            }else{
                $('#show_errors').hide();
                $('#show_errors').html('');
                $(x).css('border','inherit');
                scrap_rowitem.scrap_entry=true;

            }


        },
        update_math_vals_for_scrap: function(){

            var item_select = $('#tb tr').eq(1).find('#expense_category').val();
            console.log(item_select);
            if(item_select!=''){
                var rowCount = $('#tb tr').length;
                var posubtotal = 0;
                var taxarray = [];
                for(i=1;i<rowCount;i++){ 
                    var expense_amount = $('#tb tr').eq(i).find('#expense_amount').val();
                    
                    posubtotal+= +expense_amount;
                }

                $('#posubtotal').text(eval(posubtotal).toFixed(2));
                $('#grandtotal').text(eval(posubtotal).toFixed(2));

            }
        }
    }
