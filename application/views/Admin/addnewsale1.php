<style type="text/css">
    .select2-container .select2-selection--single{
        height:34px !important;
    }
    .select2-container--default .select2-selection--single{
             border: 1px solid #ccc !important; 
         border-radius: 0px !important; 
    }

    .modal-content{
        width: 800px;
    }

    /*iphone */
    @media only screen and (max-width: 800px) {
        .modal-content{
            width: 350px;
        }
    }

    /*normal mobile*/
    @media only screen and (max-width: 600px) {
        .modal-content{
            width: 330px;
        }
    }
        
</style>

<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Sale</h4>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title" >Add Sale</h4>
                         <p class="text-muted m-b-30"></p>
                        <form class="form-horizontal form-wizard-wrapper" id="saleform" >
                            <input type="hidden" class="form-control" name="sale_id" id="sale_id" value="<?php if(isset($product)){echo $product->sale_id;}else{echo '0';}?>">
                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <!-- Customer add modal -->
                                    <div class="container" >
                                        <!-- Modal -->
                                        <div class="modal fade col-md-12" id="myModalParty" role="dialog">
                                            <div class="modal-dialog" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add Customer</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12">
                                                        <form  action="" class="form-horizontal" id="party_form" >
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="control-label text-left col-md-5">Customer Name</label>
                                                                        <div class="col-md-7">
                                                                            <input type="text" id="customer_name" name="customer_name" class="form-control">
                                                                            <input type="hidden" id="customer" name="customer" class="form-control"  value="<?php if(isset($customer_id)){echo $allparty->customer_id;}else{echo "0";}?>"  >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="control-label text-left col-md-5">Customer Mobile</label>
                                                                        <div class="col-md-7">
                                                                            <input type="text" id="customer_mobile" name="customer_mobile" maxlength="10" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="control-label text-left col-md-5">Customer Address</label>
                                                                        <div class="col-md-7">
                                                                            <textarea class="form-control" name="customer_address" id="customer_address"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="control-label text-left col-md-5">Customer Email</label>
                                                                        <div class="col-md-7">
                                                                            <input type="text" id="customer_email" name="customer_email"  class="form-control" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                <label class="control-label col-md-6"></label>
                                                                <button type="button" class="btn btn-success waves-effect waves-light" id="customer_submit" name="save">Save</button>
                                                                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" name="cancel">Cancel</button><br><br>
                                                                </div>
                                                            </div>

                                                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                                                        </form>
                                                        </div>
                                                        <br>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-info" id="bookadd">Add</button>     -->
                                                        <label id="BookErr" style="color:red;"></label>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnmodalclose">Close</button>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Customer Name</label> 
                                            <!-- <input type="hidden" class="form-control col-md-8" name="customer_name" id="customer_name" required > -->
                                            <Select class="form-control col-md-7" id="customer_id" name="customer_id">
                                                <option>Select</option>                                                
                                                <!-- <?php
                                                    foreach ($managecustomer as $customer) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $customer->customer_id;?>"><?php echo $customer->customer_name; ?></option>
                                                <?php
                                                    } 
                                                ?>   -->
                                            </Select>&nbsp;
                                            <button type="button" class="form-control col-md-1" data-toggle="modal" data-target="#myModalParty"><i class='fas fa-plus'></i></button>
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3">Customer Mobile</label> 
                                            <input type="text" class="form-control col-md-8" name="cust_mobile" id="cust_mobile"  maxlength="10">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Customer Address</label> 
                                            <textarea class="form-control col-md-8" name="cust_address" id="cust_address"></textarea>
                                        </div>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Invoice No</label> 
                                            <input type="hidden" class="form-control col-md-8" name="invoice_no" id="invoice_no" value="<?php if(isset($sale)){echo $sale->invoice_no;}else{echo '';}?>">
                                            <input type="text" class="form-control col-md-8" name="invoice_string" id="invoice_string" value="<?php if(isset($sale)){echo $sale->invoice_string;}else{echo '';}?>" readonly>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Invoice Date</label> 
                                            <input type="text" class="form-control col-md-8" name="invoice_date" id="invoice_date" value="<?php if(isset($sale)){echo $sale->invoice_date;}else{echo '';}?>" required >
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <input type="hidden" name="rowSr" value="0" id="rowSr" class="form-control" >
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Name</label> 
                                            <!-- <div class="main-search-input-item" id="autocomplete-container">
                                                <input type="text" id="searchText" class="typeahead form-control" name="searchText"  placeholder="Search Products, Varient, Barcode" type="search" value="<?php if(isset($_SESSION['SearchText'])){echo $_SESSION['SearchText']; unset($_SESSION['SearchText']);}?>" required/>
                                            </div> -->
                                            <Select class="form-control select2" id="product_detail_id" name="product_detail_id">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($manageproduct as $product) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $product->product_detail_id;?>"><?php echo $product->product_name;?>-<?php echo $product->varient_name; ?>-<?php echo $product->serial_no; ?></option>
                                                <?php
                                                    } 
                                                ?>
                                            </Select>
                                            <input type="hidden" id="product_id" name="product_id" value="" class="form-control">
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-2">
                                        <div class="form-group ">
                                            <label>Varient Name</label>
                                            <Select class="form-control" id="varientname" name="varientname">
                                                <option value="">Select</option>
                                            </Select>
                                        </div>
                                    </div> -->

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Serial No</label> 
                                            <input type="hidden" class="form-control" id="shop_id" name="shop_id">
                                            <!-- <input type="text" class="form-control" name="serial_no" id="serial_no"> -->
                                            <Select class="form-control select3" id="serial" name="serial">
                                                <!-- <option value="">Select</option> -->
                                                <!-- <?php
                                                    foreach ($manageproduct as $product) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $product->product_detail_id;?>"><?php echo $product->serial_no; ?></option>
                                                <?php
                                                    } 
                                                ?> -->
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group ">
                                            <label>Qty</label> 
                                            <input type="text" class="form-control" name="qty" id="qty" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Price</label> 
                                            <input type="text" class="form-control" name="price" id="price" value="0" >
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Discount</label> 
                                            <input type="text" class="form-control" name="discount" id="discount" value="0">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Tax (%)</label> 
                                            <input type="text" class="form-control" name="tax_id" id="tax_id" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Tax Amount</label> 
                                            <input type="text" class="form-control" name="tax_amt" id="tax_amt" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Total</label> 
                                            <input type="hidden" class="form-control" name="oldtotal" id="oldtotal" value="0" readonly>
                                            <input type="text" class="form-control" name="total" id="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label style="color: white">.</label>
                                            <button class="form-control btn btn-primary" type="button" id="btnadd">Add</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <table id="saleEntry" class="table table-striped table-bordered table-hover" data-page-size="7">
                                        <thead>
                                        <tr>
                                            <th> Sr no </th>
                                            <th> Product </th>
                                            <th></th>
                                            <!-- <th> Varient </th> -->
                                            <th> Serial </th>
                                            <th></th>
                                            <th> Qty </th>
                                            <th> Rate </th>
                                            <th> Discount </th>
                                            <th> Tax(%) </th>
                                            <th> Tax Amt </th>
                                            <th> Total </th>
                                            <th> </th>
                                            <th> </th>
                                        </tr>
                                        </thead>

                                        <tbody id="tbdy">
                                        <?php
                                            //$subTotal = 0;
                                            $itcnt = 1;
                                            if(isset($saledetail))
                                            {
                                                foreach ($saledetail as $qd) {
                                                  echo  "<td>".$itcnt."</td>"+
                                                        "<td><input type='hidden' name='product_id[]' class='product_id' value=".$qd->product_id."><label>".$qd->product_name." </label></td>"+
                                                        "<td><input type='hidden' name='product_detail_id[]' class='product_detail_id form-control' value=".$qd->product_detail_id." readonly></td>"+
                                                        "<td><input type='hidden' name='serial_no[]' class='serial_no form-control' value=".$qd->serial_no."><label>".$qd->serial_no."</label></td>"+
                                                        "<td><input type='hidden' name='shop_id[]' class='shop_id form-control' value=".$qd->shop_id." readonly>"+
                                                        "<td><input type='text' name='qty[]' class='qty form-control' value=".$qd->qty." readonly></td>"+
                                                        "<td><input type='text' name='price[]' class='price form-control' value=".$qd->price." readonly></td>"+
                                                        "<td><input type='text' name='discount[]' class='discount form-control' value=".$qd->discount." readonly></td>"+
                                                        "<td><input type='text' name='tax_id[]' class='tax_id form-control' value=".$qd->tax_id." readonly></td>"+
                                                        "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value=".$qd->tax_amt." readonly></td>"+
                                                        "<td><input type='text' name='total[]' class='total form-control' value=".$qd->total." readonly></td>"+
                                                        "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";
                                                  //$subTotal .= ($qd->price * $qd->qty);
                                                  $itcnt++;
                                                }
                                            }
                                        ?>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr class="active">
                                                <td colspan="9">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                            </div><br>

                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label id="ErrSucc" style="color: red;"></label>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"></label>                                             
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3"></label>
                                            <input type="hidden" id="saleid" value="">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3"></label>
                                            <input type="hidden" id="shopid" value="">
                                        </div>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Subtotal</label> 
                                            <input type="text" class="form-control col-md-8" name="inv_subtotal" id="inv_subtotal" readonly="" value="<?php if(isset($sale)){echo $sale->inv_subtotal;}else{echo '';} ?>">
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">CGST</label> 
                                            <input type="text" class="form-control col-md-4" name="cgst" id="cgst" readonly="">
                                            <input type="text" class="form-control col-md-4" name="cgst_amt" id="cgst_amt" readonly="">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">SGST</label> 
                                            <input type="text" class="form-control col-md-4" name="sgst" id="sgst" readonly="">
                                            <input type="text" class="form-control col-md-4" name="sgst_amt" id="sgst_amt" readonly="">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Round Off</label> 
                                            <input type="text" class="form-control col-md-8" name="inv_roundoff" id="inv_roundoff" readonly="" value="<?php if(isset($sale)){echo $sale->inv_roundoff;}else{echo '';} ?>">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Total</label> 
                                            <input type="text" class="form-control col-md-8" name="inv_totalamt" id="inv_totalamt" readonly="" value="<?php if(isset($sale)){echo $sale->inv_totalamt;}else{echo '';} ?>">
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <!-- Serial Number add modal -->
                            <div class="container" >
                                <!-- Modal -->
                                <div class="modal fade col-md-12" id="myModalSerial" role="dialog">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add Serial No</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <form action="" class="form-horizontal" id="party_form" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label class="control-label text-left col-md-2">Serial No</label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" id="txtserial_no" name="txtserial_no" class="form-control">
                                                                    </div>
                                                                    <!-- <button type="button" class="btn btn-success waves-effect waves-light col-md-2" id="btnaddserial" >Add</button> -->
                                                                </div>
                                                            </div>
                                                            <label style="color: red;" id="SrrSucc"></label>

                                                            <div class="col-md-12">
                                                                <div class="col-md-12 row">
                                                                    <label class="col-md-9"></label>
                                                                    <label class="control-label col-md-3" style="text-align: right;">Total Quantity : <span id="total_qty"></span></label>
                                                                </div>
                                                                <div class="table-responsive">
                                                                     <table class="col-md-12 table table-striped table-bordered" id="table_serialno">
                                                                        <thead>
                                                                            <tr style="background-color: lightgrey" >
                                                                                <th style="padding-left: 10px;">Serial No</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="tbody"></tbody>
                                                                     </table>            
                                                                </div>
                                                            </div>
                                                        </div>                                                    
                                                    </form>
                                                </div>
                                                <br>                                                
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-info" id="bookadd">Add</button>     -->
                                                <label id="BookErr" style="color:red;"></label>
                                                <button type="button" class="btn btn-default" onclick="btnmodalclose()">Close</button>
                                                <button type="button" class="btn btn-success waves-effect waves-light" id="set_serialno" name="set">Set</button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div>
                                    <button type="button" class="btn btn-primary waves-effect waves-light mr-1" id="btnsubmit">Submit</button> 
                                    <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

<!-- Autocomplete JS -->
<!-- <link rel="stylesheet" href="<?php echo base_url();?>assetsadmin/autocomplete/bootstrap.css" />
<script src="<?php echo base_url();?>assetsadmin/autocomplete/jquery.js"></script>
<script src="<?php echo base_url();?>assetsadmin/autocomplete/bootstrap3-typeahead.min.js"></script>
 
<script>
    $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get('<?php echo base_url();?>index.php/Admin/autocomplete', { query: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
</script> -->

<script src="<?php echo base_url();?>assetsadmin/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function ()
    {
        $('.select2,.select3').select2().on('change', function(evt, params)
        {
            fetchvarient();
        });

        fetchcustomer();
        fetchproduct();

        $("#customer_id").change(function()
        {
            var customer_id = $("#customer_id").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchcustomerdetail",
                type : "post",
                data : {customer_id : customer_id},
                success : function(data)
                {
                    var customer = data.split("^");

                    $("#cust_mobile").val(customer[2]);
                    $("#cust_address").val(customer[3]);
                }
            });
        });

        $("#discount").change(function()
        {
            pricefind();
        });

        var rwcnt = 1;
        generatedate();

        $("#btnadd").click(function()
        {
            var rowSr = $('#rowSr').val();
            var product_id = $("#product_id").val();
            var product_detail_id = $("#product_detail_id").val();
            var product_name = $("#product_detail_id option:selected").html();
            /*var varientname = $('#varientname').val();
            var varient_name = $("#varientname option:selected").html();*/
            var serial_no = $("#serial_no").val();
            var shop_id = $("#shop_id").val();
            var qty = $("#qty").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var tax_id = $("#tax_id").val();
            var tax_amt = $("#tax_amt").val();
            var total = $("#total").val();
                     
            if(parseFloat(qty) > 0)
            {
                $("#ErrSucc").html("");
                var SrNo = rwcnt;
                if(rowSr != "0")
                {
                    SrNo = rowSr;
                }
                var str = "<td>"+SrNo+"</td>"+
                        "<td><input type='hidden' name='product_id[]' class='product_id' value="+product_id+"><label>"+product_name+"</label></td>"+
                        "<td><input type='hidden' name='product_detail_id[]' class='product_detail_id form-control' value="+product_detail_id+" readonly></td>"+
                        "<td><input type='hidden' name='serial_no[]' class='serial_no form-control' value="+serial_no+" readonly><label>"+serial_no+"</label></td>"+
                        "<td><input type='hidden' name='shop_id[]' class='shop_id form-control' value="+shop_id+" readonly>"+
                        "<td><input type='text' name='qty[]' class='qty form-control' value="+qty+" readonly></td>"+
                        "<td><input type='text' name='price[]' class='price form-control' value="+price+" readonly></td>"+
                        "<td><input type='text' name='discount[]' class='discount form-control' value="+discount+" readonly></td>"+
                        "<td><input type='text' name='tax_id[]' class='tax_id form-control' value="+tax_id+" readonly></td>"+
                        "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value="+tax_amt+" readonly></td>"+
                        "<td><input type='text' name='total[]' class='total form-control' value="+total+" readonly></td>"+
                        "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";

                if(rowSr <= 0)
                {
                    $('#tbdy').append("<tr>"+str+"</tr>");
                    rwcnt++;
                    clearVal();
                    FinalSum();
                }
                else
                {
                    var tr = null;
                    $('#tbdy').find('tr').each(function (key, val) {
                        if($(this).find("td:first").text() == rowSr)
                        {
                            tr = $(this); 
                        }
                    });
                    tr.html(str);
                    clearVal();
                    FinalSum();
                }  
            }
            else
            {
                $("#ErrSucc").html("Please Select Qty");
            }
        });

        $("#saleEntry").on("click",".editOn", function()
        {
            var tr = $(this).closest('tr');
            var lines = $('td', tr).map(function(index, td) {
                return $(td);
            });
          
            //lines arrays of td
            $('#rowSr').val(lines[0].text());
            $('#product_id').val(lines[1].find('.product_id').val());
            $('#product_name').val(lines[1].find('.product_name').val());
            $('#product_detail_id').val(lines[2].find('.product_detail_id').val());
            $('#serial_no').val(lines[3].find('.serial_no').val());
            $('#qty').val(lines[5].find('.qty').val());
            $('#price').val(lines[6].find('.price').val());
            $('#discount').val(lines[7].find('.discount').val());
            $('#tax_id').val(lines[8].find('.tax_id').val());
            $('#tax_amt').val(lines[9].find('.tax_amt').val());
            $('#total').val(lines[10].find('.total').val());
        });

        $("#saleEntry").on("click",".deleteOn", function()
        {
            var tr=$(this).closest('tr');
            tr.remove();
            Searilize();
            FinalSum();
        });

        //insert 
        $("#btnsubmit").click(function(e)
        {
            var result1 = [];
            var result2 = [];

            var sale_id = $("#sale_id").val();
            var customer_id = $("#customer_id").val();
            var invoice_no = $("#invoice_no").val();
            var invoice_string = $("#invoice_string").val();
            var b_date = $("#invoice_date").val();

            var d = new Date(b_date.split("-").reverse().join("/"));
            var dd = d.getDate();
            var mm = d.getMonth()+1;
            var yy = d.getFullYear();
            var invoice_date = yy+"-"+mm+"-"+dd;

            var inv_subtotal = $("#inv_subtotal").val();
            var inv_roundoff = $("#inv_roundoff").val();
            var inv_totalamt = $("#inv_totalamt").val();


            var obj1 = {};
                obj1['sale_id'] = sale_id;
                obj1['customer_id'] = customer_id;
                obj1['invoice_no'] = invoice_no;
                obj1['invoice_string'] = invoice_string;
                obj1['invoice_date'] = invoice_date;
                obj1['inv_subtotal'] = inv_subtotal;
                obj1['inv_roundoff'] = inv_roundoff;
                obj1['inv_totalamt'] = inv_totalamt;

                result1.push(obj1);

            $('#tbdy').find('tr').each(function (key, val) 
            {
                var lines = $('td', $(this)).map(function(index, td) {
                    return $(td);
                });

                var product_id = lines[1].find('.product_id').val();
                //var product_name = lines[1].find('.product_name').val();
                var product_detail_id = lines[2].find('.product_detail_id').val();
                var serial_no = lines[3].find('.serial_no').val();
                var shop_id = lines[4].find('.shop_id').val();
                var qty = lines[5].find('.qty').val();
                var price = lines[6].find('.price').val();
                var discount = lines[7].find('.discount').val();
                var tax_id = lines[8].find('.tax_id').val();
                var tax_amt = lines[9].find('.tax_amt').val();
                var total = lines[10].find('.total').val();
                
                var obj2 = {};
                obj2['product_id'] = product_id;
                //obj2['product_name'] = product_name;
                obj2['product_detail_id'] = product_detail_id;
                obj2['serial_no'] = serial_no;
                obj2['shop_id'] = shop_id;
                obj2['qty'] = qty;
                obj2['price'] = price;
                obj2['discount'] = discount;
                obj2['tax_id'] = tax_id;
                obj2['tax_amt'] = tax_amt;
                obj2['total'] = total;

                result2.push(obj2);
            });

            var objectresult = {result1,result2};
            if(customer_id =='' || customer_id == null)
            {
                $("#ErrSucc").html("Please Select Customer");
            }
            else
            {
                $("#ErrSucc").html("");

                $.ajax({
                    url:"<?php echo base_url(); ?>index.php/Admin/saleInsert",
                    type:"POST",
                    data: JSON.stringify(objectresult),
                    datatype: "JSON",
                    success : function(Jsonstr)
                    {   
                        //alert(Jsonstr);
                        var str = Jsonstr.split(',');
                        $('#shopid').val(str[0]);
                        $('#saleid').val(str[1]);
                        var data = str[2];

                        if(data == 1)
                        {
                            printsale();
                        }
                        else if(Jsonstr == 2 || Jsonstr == 4)
                        {
                            window.location.reload("true");
                        }
                    }
                });
            }
            e.preventDefault();
        });

        $("#customer_submit").click(function(e)
        {
            var customer_name = $("#customer_name").val();
            var customer_mobile = $("#customer_mobile").val();
            var customer_address = $("#customer_address").val();
            var customer_email = $("#customer_email").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/CustomerInsert",
                type : "Post",
                data : {customer_name : customer_name , customer_mobile : customer_mobile, customer_address : customer_address , customer_email : customer_email },
                success : function(data)
                {
                    fetchcustomer();
                    $("#myModalParty").modal("hide");
                }
            });
        });

        //Serial no select using check box
        $("#myModalSerial").on('click','input[type="checkbox"]',function()
        {
            var check = $('#myModalSerial').find('input[type=checkbox]:checked').length;
            $("#total_qty").text(check);
        });

        $("#set_serialno").click(function()
        {
            var tot_qty = $("#total_qty").text();
           
            var values = new Array();            
        	$.each($("input[type=checkbox]:checked").parents("td").siblings(),function() {
                	values.push($(this).find('.serial').val());
        	});
            $("#serial_no").val(values);
            $("#qty").val(tot_qty);
            $("#myModalSerial").modal("hide");
        });

        $("#txtserial_no").keyup(function()
        {
            var pid = $("#product_detail_id").val();
            var ser_no = $(this).val();
            fetchserialdetail(pid,ser_no);
        });

        $("#serial").change(function()
        {
            serial();
        });        

    });

    function serial()
    {
        fetchserialdetail();
        var serial_no = $("#serial").val();

        $.ajax(
        {
            url:"<?php echo base_url()?>index.php/Admin/fetchotherdetail1",
            type:"post",
            data:{serial_no:serial_no},
            success:function(data)
            {
                var other = data.split("^")
                $("#tax_id").val(other[5]);
                $("#price").val(other[3]);
                $("#total").val(other[3]);
                $("#oldtotal").val(other[3]);
                $("#qty").val("1");
                $("#product_id").val(other[4]);
                pricefind();
            }
        });
    }

    function fetchproduct()
    {
        var pid = $("#product_detail_id").val();
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchproduct",
            type : "post",
            data :{pid:pid},
            success : function(data)
            {
                var varient = data.split("~");                

                var html = "";
                html += "<option value=''>select</option>";
                //$("#serial").html("");
                //$("#serial").prepend("<option value=''>select</option>").val();

                $.each(varient, function (index, value) 
                {
                    var ser_no = value;
                    if(ser_no != null && ser_no != '' && ser_no != undefined)
                    {
                        var str = ser_no.split(",");
                        $.each(str, function (index, value) 
                        {
                            html += "<option value='"+value+"'>"+value+"</option>";
                            /*var listItem = $("<option></option>").val(value).html(value);
                            $("#serial").append(listItem);*/
                        });
                    }
                });
                $("#serial").html(html);
            }
        });
    }

    function printsale() 
    {
        var saleid = $('#saleid').val();
        var shopid = $('#shopid').val();
        window.location.replace("<?php echo base_url()?>index.php/Admin/printsale/"+saleid+"/"+shopid);        
    }
    
    function btnmodalclose()
    {
        clearVal();
        $("#myModalSerial").modal("hide");
    }

    function fetchvarient()
    {
        var pid = $("#product_detail_id").val();        
        //fetchotherdetail(pid);            
        //fetchserialdetail(pid);
        fetchproduct();
    }

    function fetchotherdetail(pid)
    {
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchotherdetail1",
            type : "post",
            data : {pid : pid},
            success : function(data)
            {
                var other = data.split("^");
                //$("#tax_id").val(other[5]);
                //$("#total").val(other[5]);
                $("#product_id").val(other[6]);
            }
        });
    }

    function fetchserialdetail(pid)
    {
        //fetchproduct();
        var pid = $("#product_detail_id").val();
        var serial_no = $("#serial").val();
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchserialdetail",
            type : "post",
            data : {pid : pid,serial_no:serial_no},
            success : function(data)
            {
                /*$smodal = $('#myModalSerial');
                $smodal.modal('show');
                $("#tbody tr").remove();
                $("#total_qty").text(0);*/

                var other = data.split("^");
                var serial = other[1].split(",");

                /* if(serial == '' || serial == null)
                {
                    $("#SrrSucc").html("Serial No Not Avilable");
                }
                else
                {
                    $("#SrrSucc").html("");
                    $.each(serial, function (index, value) 
                    {
                        var markup = "<tr><td><input type='checkbox' name='checkserial[]' class='form-control checkserial'></td><td><input type='text' name='serial[]' class='serial form-control' value='"+value+"' readonly></td></tr>";
                        $("#tbody").append(markup);
                    });
                }*/

                $("#shop_id").val(other[2]);
                $("#invoice_no").val(other[3]);
                if(other[3] == "")
                {
                    $("#invoice_string").val("");
                }
                else
                {
                    $("#invoice_string").val(other[4]);
                }
            }
        });
    }

    function fetchcustomer()
    {
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchcustomer",
            type : "Post",
            success : function(data)
            {
                var customer = data;
                var customer1 = customer.split("~");
                $("#customer_id").html("");
                $("#customer_id").prepend("<option value=''>select</option>").val();
                $.each(customer1, function (index, value) 
                {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#customer_id").append(listItem);
                });

                $('select option').filter(function(){
                    return ($(this).val().trim()=="" && $(this).text().trim()=="");
                }).remove();
            }
        }); 
    }
    
    function generatedate()
    {
        var invoice_date = $("#invoice_date").val();
        if(invoice_date == '')
        {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            /*$( '#invoice_date' ).datepicker({
                dateFormat: 'dd/mm/yy',
                //changeMonth: true,
                //changeYear: true,
                //yearRange: '2019:'+(new Date).getFullYear()
            });*/
            $('#invoice_date').datepicker( 'setDate', today );
        }
    }

    function pricefind()
    {
        var tax_id = 0;
        var tax_amt = 0;
        var price = 0;
        var total = 0; 
        var chgprice = 0;
        var discount = 0;
        var disamt = 0;
        var FinalToal=0;

        total = parseFloat($('#oldtotal').val());
        tax_id = parseFloat($('#tax_id').val());
        discount = parseFloat($('#discount').val());

        if(discount > 0)
        {
            disamt = total * discount/100;

            if(tax_id > 0)
            {
                var disprice = 0; 
                disprice = total-disamt;
                tax_amt = (disprice* tax_id)/100;
            } 
        }
        else
        {
            if(tax_id > 0)
            {
                tax_amt = ((total * tax_id)/100);
            } 
        }
        chgprice = total-tax_amt;

        FinalToal = total-disamt;
        $('#price').val(chgprice.toFixed(2));
        $('#total').val(FinalToal.toFixed(2));
        $('#tax_amt').val(tax_amt.toFixed(2));
    }

    function calculate()
    {
        var subtotal = 0;
        var price = 0;
        var qty = 0;
        var discount = 0;
        var disamt = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var subtotal = 0;
        var total = 0; 

        price = parseFloat($('#price').val());
        qty = parseFloat($('#qty').val());
        discount = parseFloat($('#discount').val());
        tax_id = parseFloat($('#tax_id').val());

        if(qty > 0)
        {
            subtotal = price * qty;
        }
        else
        {
            subtotal = price;
        }
        
        if(tax_id > 0)
        {
            tax_amt = ((subtotal * tax_id) / 100);
        }        

        if(discount > 0)
        {
            disamt = ((subtotal * discount) / 100);
        }
        
        total = subtotal + tax_amt - disamt;
        $('#total').val(total.toFixed(2));
        $('#tax_amt').val(tax_amt.toFixed(2));
    }

    function clearVal()
    {
        $('#rowSr').val(0);
        $('#product_id').val("");
        //$('#product_name').html("");
        $('#product_detail_id').val("");
        $('#serial_no').val("");
        //$('#shop_id').val("");
        $('#qty').val(0);
        $('#price').val(0);
        $('#discount').val(0);
        $('#tax_id').val(0);
        $('#tax_amt').val(0);
        $('#total').val(0);
    }

    function FinalSum()
    {
        var rdoff = 0;
        var sgst = 0;
        var cgst = 0;
        var sgst_amt = 0;
        var cgst_amt = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var Total = 0;
        var FinalTotal = 0;
        var sub_total = 0;

        $('#tbdy').find('tr').each(function (key, val) 
        {
            var lines = $('td', $(this)).map(function(index, td) {
                return $(td);
            });

            sub_total += (parseFloat(lines[6].find('.price').val()));
            tax_id += (parseFloat(lines[8].find('.tax_id').val()));
            tax_amt += (parseFloat(lines[9].find('.tax_amt').val()));
            Total += (parseFloat(lines[10].find('.total').val()));
        });

        cgst = tax_id/2;
        sgst = tax_id/2;
        cgst_amt = tax_amt/2;
        sgst_amt = tax_amt/2;
        FinalTotal = Math.round(Total);
        rdoff = FinalTotal - Total;

        $('#inv_subtotal').val(sub_total.toFixed(2));
        $('#cgst').val(cgst.toFixed(2));
        $('#sgst').val(sgst.toFixed(2));
        $('#cgst_amt').val(cgst_amt.toFixed(2));
        $('#sgst_amt').val(sgst_amt.toFixed(2));
        $('#inv_roundoff').val(rdoff.toFixed(2));
        $('#inv_totalamt').val(FinalTotal);
    }

    function Searilize()
    {
        var cnt = 1;
        $('#tbdy').find('tr').each(function (key, val) {
            $(this).find("td:first").text(cnt);
            cnt++;
        }); 
    }

</script>    