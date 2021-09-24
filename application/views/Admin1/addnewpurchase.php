<style type="text/css">
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
                    <h4 class="page-title">Purchase</h4>
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
                        <h4 class="mt-0 header-title" >Add Purchase</h4>
                         <p class="text-muted m-b-30"></p>
                        <form class="form-horizontal form-wizard-wrapper" id="purchaseform" >
                            <input type="hidden" class="form-control" name="purchase_id" id="purchase_id" value="<?php if(isset($product)){echo $product->purchase_id;}else{echo '0';}?>">
                            <div style="border-color: black; border: 1px solid; padding :25px;">

	                            <!-- Supplier add modal -->
	                            <div class="container" >
	                                <!-- Modal -->
	                                <div class="modal fade col-md-12" id="myModalParty" role="dialog">
	                                    <div class="modal-dialog" >
	                                        <div class="modal-content">
	                                            <div class="modal-header">
	                                                <h4 class="modal-title">Add Supplier</h4>
	                                            </div>
	                                            <div class="modal-body">
	                                                <div class="col-md-12">
		                                                <form  action="" class="form-horizontal" id="party_form" method="post">
		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Name</label>
		                                                                <div class="col-md-7">
		                                                                    <input type="text" id="supplier_name" name="supplier_name" class="form-control">
		                                                                    <input type="hidden" id="supplier" name="supplier" class="form-control"  value="<?php if(isset($supplier_id)){echo $allparty->supplier_id;}else{echo "0";}?>"  >
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Mobile</label>
		                                                                <div class="col-md-7">
		                                                                	<input type="text" id="supplier_mobile" name="supplier_mobile" maxlength="10" class="form-control">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Address</label>
		                                                                <div class="col-md-7">
		                                                                	<textarea class="form-control" name="supplier_address" id="supplier_address"></textarea>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Supplier Gstno</label>
		                                                                <div class="col-md-7">
		                                                                	<input type="text" id="supplier_gstno" name="supplier_gstno"  class="form-control" maxlength="15">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Country</label>
		                                                                <div class="col-md-7">
		                                                                	<Select class="form-control" id="country_id" name="country_id">
										                                        <option>Select</option>
										                                        <?php
										                                            foreach ($AllCountry as $country) 
										                                            {
										                                        ?>
										                                            <option value="<?php echo $country->country_id;?>"><?php echo  $country->country_name; ?></option>
										                                        <?php
										                                            } 
										                                        ?>  
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">State</label>
		                                                                <div class="col-md-7">
			                                                                <Select class="form-control" id="state_id" name="state_id">
										                                        <option>Select Country First</option>
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>

		                                                    <div class="row">
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">City</label>
		                                                                <div class="col-md-7">
		                                                                	<Select class="form-control" id="city_id" name="city_id">
										                                        <option>Select State First</option>
										                                    </Select>
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                        <div class="col-md-6">
		                                                            <div class="form-group row">
		                                                                <label class="control-label text-left col-md-5">Pincode</label>
		                                                                <div class="col-md-7">
		                                                                <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6">
		                                                                </div>
		                                                            </div>
		                                                        </div>
		                                                    </div>
		                                                   
		                                                    <div class="col-md-6">
		                                                    	<div class="form-group row">
		                                                        <label class="control-label col-md-6"></label>
		                                                        <button type="button" class="btn btn-success waves-effect waves-light" id="supplier_submit" name="save">Save</button>
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Supplier Name</label> 
                                            <Select class="form-control col-md-7" id="supplier_id" name="supplier_id" >
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($managesupplier as $supplier) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $supplier->supplier_id;?>"><?php echo  $supplier->supplier_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select>&nbsp;
                                            <button type="button" class="form-control col-md-1" data-toggle="modal" data-target="#myModalParty"><i class='fas fa-plus'></i></button>
                                        </div>
                                   
                                   		<div class="form-group row">
                                            <label class="col-md-3">Shop</label> 
                                             <Select class="form-control col-md-8" id="shop_id" name="shop_id" >
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($manageshop as $shop) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $shop->shop_id;?>"><?php echo  $shop->shop_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">GST IN</label> 
                                            <input type="text" class="form-control col-md-8" name="supplier_gst" id="supplier_gst" required maxlength="15">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Address</label> 
                                            <textarea class="form-control col-md-8" name="supplier_add" id="supplier_add"></textarea>
                                        </div>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Bill No</label> 
                                            <input type="text" class="form-control col-md-8" name="bill_no" id="bill_no" required >
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Referance No</label> 
                                            <input type="text" class="form-control col-md-8" name="referance_no" id="referance_no" value="<?php if(isset($ReferanceDetail)){ echo $ReferanceDetail->ReferanceNo; }else{ echo ""; } ?>">
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Bill Date</label> 
                                            <input type="text" class="form-control col-md-8" name="bill_date" id="bill_date" required >
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Due Date</label> 
                                            <input type="text" class="form-control col-md-8" name="due_date" id="due_date">
                                        </div>
                                    </div>
                                </div>
                            </div><br>

                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <input type="hidden" name="rowSr" value="0" id="rowSr" class="form-control" >
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Product Name</label> 
                                            <Select class="form-control select2" id="product_id" name="product_id">
                                                <option value="">Select</option>
                                                <?php
                                                    foreach ($manageproduct as $product) 
                                                    {
                                                ?>
                                                    <option value="<?php echo $product->product_id;?>"><?php echo  $product->product_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group ">
                                            <label>Varient Name</label>
                                            <Select class="form-control" id="varientname" name="varientname">
                                                <option value="">Select</option>
                                            </Select>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group ">
                                            <label>Serial No</label> 
                                            <input type="text" name="serial_no" id="serial_no" class="form-control">                                            
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group ">
                                            <label >Qty</label> 
                                            <input type="text" class="form-control" name="qty" id="qty" value="0" readonly="">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Price</label> 
                                            <input type="text" class="form-control" name="price" id="price" value="0">
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

                                <div class="row table-responsive">
                                    <table id="purchaseEntry" class="table table-striped table-bordered table-hover" data-page-size="7">
                                        <thead>
	                                        <tr>
	                                            <th> Sr no </th>
	                                            <th> Product </th>
	                                            <th> Varient </th>
	                                            <th> Serial </th>
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
	                                            $subTotal = 0;
	                                            $itcnt = 1;
	                                            if(isset($invoicedetail))
	                                            {
	                                                foreach ($invoicedetail as $qd) {
	                                                  echo  "<td>".$itcnt."</td>"+
	                                                        "<td><input type='hidden' name='product_id[]' class='product_id' value=".$product_id."><label>".$product_name."</label></td>"+
	                                                        "<td><input type='hidden' name='varientname[]' class='varientname' value=".$varientname."><label>".$varient_name."</label></td>"+
	                                                        "<td><textarea style='display:none;' name='serial_no[]' class='serial_no form-control'>".$serial_no."</textarea><label>".$serial_no."</label></td>"+
	                                                        "<td><input type='text' name='qty[]' class='qty form-control' value=".$qty." readonly></td>"+
	                                                        "<td><input type='text' name='price[]' class='price form-control' value=".$price." readonly></td>"+
	                                                        "<td><input type='text' name='discount[]' class='discount form-control' value=".$discount." readonly></td>"+
	                                                        "<td><input type='text' name='tax_id[]' class='tax_id form-control' value=".$tax_id." readonly></td>"+
	                                                        "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value=".$tax_amt." readonly></td>"+
	                                                        "<td><input type='text' name='total[]' class='total form-control' value=".$total." readonly></td>"+
	                                                        "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";
	                                                  $subTotal .= ($qd->price * $qd->qty);
	                                                  $itcnt++;
	                                                }
	                                            }
	                                        ?>
                                        </tbody>

                                        <tfoot>
	                                        <tr class="active">
	                                            <td colspan="9">
	                                                <div class="text-right">
	                                                    <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
	                                                </div>
	                                            </td>
	                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div><br>

                            <div style="border-color: black; border: 1px solid; padding :25px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"></label>                                             
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3"></label> 
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3"></label> 
                                        </div>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Subtotal</label> 
                                            <input type="text" class="form-control col-md-8" name="sub_total" id="sub_total" readonly="">
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Round Off</label> 
                                            <input type="text" class="form-control col-md-8" name="round_off" id="round_off" readonly="">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Total</label> 
                                            <input type="text" class="form-control col-md-8" name="total_amt" id="total_amt" readonly="">
                                        </div>
                                    </div>
                                </div>
                                <label style="color: red;" id="ErrSucc"></label>
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
	                                                                <input type="hidden" id="category_digit" name="category_digit" class="form-control">
	                                                                <div class="col-md-8">
	                                                                	<input type="text" id="txtserial_no" name="txtserial_no" class="form-control">
	                                                                </div>
	                                                                <button type="button" class="btn btn-success waves-effect waves-light col-md-2" id="btnaddserial" >Add</button>
	                                                            </div>
	                                                        </div>
	                                                        <label style="color: red;" id="SrrSucc"></label>

		                                                    <div class="col-md-12">
		                                                    	<div class="col-md-12 row">
		                                                    		<label class="col-md-9"></label>
		                                                    		<label class="control-label col-md-3" style="text-align: right;">Total Quantity : <span id="total_qty"></span></label>
		                                                    		<!-- <input type="hidden" value="" id="purchase_price" class="form-control">  -->
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
                                                <button type="button" class="btn btn-default" onclick="btnmodalclose()">Close</button><!-- data-dismiss="modal" -->
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

<script src="<?php echo base_url();?>assetsadmin/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript">

    $(document).ready(function ()
    {
    	$('.select2').select2().on('change', function(evt, params)
        {
            fetchvarient();
        });

    	fetchsupplier();
        /*$("#qty, #price, #discount").bind("keypress", function(e) 
        {
            var keyCode = e.which ? e.which : e.keyCode 

            if (!(keyCode >= 48 && keyCode <= 57)) 
            {
                $("#ErrSucc").html("Please Insert Numeric value (0-9)");
                return false;
            }
            else
            {
                $("#ErrSucc").html("");
            }
        });*/

        $('#country_id').change(function()
        {   
            get_state();
        });  

        $('#state_id').change(function()
        {    
            get_city();
        }); 

        $("#supplier_id").change(function()
        {
            var supplier_id = $("#supplier_id").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchsupplierdetail",
                type : "post",
                data : {supplier_id : supplier_id},
                success : function(data)
                {
                    var supplier = data.split("^");
                    $("#supplier_gst").val(supplier[1]);
                    $("#supplier_add").val(supplier[2]);
                }
            });
        });

        /*$("#product_id").change(function()
        {
            var pid = $("#product_id").val();
            
            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchvarient",
                type : "post",
                data : {pid : pid},
                success : function(data)
                {
                    var varient = data;
                    var varient1 = varient.split("~");
                    $("#varientname").html("");
                    $("#varientname").prepend("<option value=''>select</option>").val();
                    $.each(varient1, function (index, value) 
                    {
                        var str = value.split("^");
                        var listItem = $("<option></option>").val(str[0]).html(str[1]);
                        $("#varientname").append(listItem);
                    });

                    $('select option').filter(function(){
                        return ($(this).val().trim()=="" && $(this).text().trim()=="");
                    }).remove();
                }
            });
        });*/

        $("#varientname").change(function()
        {
            var pid = $("#varientname").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/fetchotherdetail",
                type : "post",
                data : {pid : pid},
                success : function(data)
                {
                    var other = data.split("^");

                    $("#tax_id").val(other[8]);
                    $("#total").val(other[4]);
                    $("#category_digit").val(other[7]);
                    //$("#tax_id").val(other[8]);
                    $smodal = $('#myModalSerial');
                    $smodal.modal('show');
                    $("#tbody tr").remove();
                    $("#total_qty").text(0);
                    //calculate();
                    pricefind();
                }
            });
        })

        $("#qty").keyup(function()
        {
            calculate();
        });

        $("#price").keyup(function()
        {
            calculate();
        });

        $("#discount").keyup(function()
        {
            calculate();
        });

        var rwcnt = 1;
        generatedate();

        $("#btnadd").click(function()
        {
            var rowSr = $('#rowSr').val();
            var product_id = $("#product_id").val();
            var product_name = $("#product_id option:selected").html();
            var varientname = $('#varientname').val();
            var varient_name = $("#varientname option:selected").html();
            var serial_no = $("#serial_no").val();
            /*var shop_id = $("#shop_id").val();
            var shop_name = $("#shop_id option:selected").html();*/
            var qty = $("#qty").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var tax_id = $("#tax_id").val();
            var tax_amt = $("#tax_amt").val();
            var total = $("#total").val();
                     
            if(parseFloat(qty) > 0)
            {
                $("#invoiceErr").html("");
                var SrNo = rwcnt;
                if(rowSr != "0")
                {
                    SrNo = rowSr;
                }
                
                var str = "<td>"+SrNo+"</td>"+
                        "<td><input type='hidden' name='product_id[]' class='product_id' value="+product_id+"><label>"+product_name+"</label></td>"+
                        "<td><input type='hidden' name='varientname[]' class='varientname' value="+varientname+"><label>"+varient_name+"</label></td>"+
                        "<td><textarea style='display:none;' name='serial_no[]' class='serial_no form-control'>"+serial_no+"</textarea><label>"+serial_no+"</label></td>"+
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
                $("#invoiceErr").html("Please Select Qty");
            }
        });

        $("#purchaseEntry").on("click",".editOn", function()
        {
            var tr = $(this).closest('tr');
            var lines = $('td', tr).map(function(index, td) {
                return $(td);
            });
          
            //lines arrays of td
            $('#rowSr').val(lines[0].text());
            $('#product_id').val(lines[1].find('.product_id').val());
            $('#product_name').val(lines[1].find('.product_name').val());
            $('#varientname').val(lines[2].find('.varientname').val());
            $('#varient_name').val(lines[2].find('.varient_name').val());
            $('#serial_no').val(lines[3].find('.serial_no').val());
            /*$('#shop_id').val(lines[4].find('.shop_id').val());
            $('#shop_name').val(lines[4].find('.shop_name').val());*/
            $('#qty').val(lines[4].find('.qty').val());
            $('#price').val(lines[5].find('.price').val());
            $('#discount').val(lines[6].find('.discount').val());
            $('#tax_id').val(lines[7].find('.tax_id').val());
            $('#tax_amt').val(lines[8].find('.tax_amt').val());
            $('#total').val(lines[9].find('.total').val());
        });

        $("#purchaseEntry").on("click",".deleteOn", function()
        {
            var tr=$(this).closest('tr');
            tr.remove();
            Searilize();
            FinalSum();
        });

        $("#btnsubmit").click(function(e)
        {
            var result1 = [];
            var result2 = [];

            var purchase_id = $("#purchase_id").val();
            var supplier_id = $("#supplier_id").val();
            var shop_id = $("#shop_id").val();
            var bill_no = $("#bill_no").val();
            var referance_no = $("#referance_no").val();
            var b_date = $("#bill_date").val();
            var d_date = $("#due_date").val();

            var d = new Date(b_date.split("-").reverse().join("/"));
            var dd = d.getDate();
            var mm = d.getMonth()+1;
            var yy = d.getFullYear();
            var bill_date = yy+"-"+mm+"-"+dd;

            var d1 = new Date(d_date.split("-").reverse().join("/"));
            var dd1 = d1.getDate();
            var mm1 = d1.getMonth()+1;
            var yy1 = d1.getFullYear();
            var due_date = yy1+"-"+mm1+"-"+dd1;

            var sub_total = $("#sub_total").val();
            var round_off = $("#round_off").val();
            var total_amt = $("#total_amt").val();

            var obj1 = {};
                obj1['purchase_id'] = purchase_id;
                obj1['supplier_id'] = supplier_id;
                obj1['shop_id'] = shop_id;
                obj1['bill_no'] = bill_no;
                obj1['referance_no'] = referance_no;
                obj1['bill_date'] = bill_date;
                obj1['due_date'] = due_date;
                obj1['sub_total'] = sub_total;
                obj1['round_off'] = round_off;
                obj1['total_amt'] = total_amt;
                result1.push(obj1);

            var product_id = "";
            var varientname = "";
            var serial_no = "";
            /*var shop_id = "";*/

            $('#tbdy').find('tr').each(function (key, val) 
            {
                var lines = $('td', $(this)).map(function(index, td) {
                    return $(td);
                });

                product_id = lines[1].find('.product_id').val();
                //var product_name = lines[1].find('.product_name').val();
                varientname = lines[2].find('.varientname').val();
                serial_no = lines[3].find('.serial_no').val();
                /*shop_id = lines[4].find('.shop_id').val();*/
                var qty = lines[4].find('.qty').val();
                var price = lines[5].find('.price').val();
                var discount = lines[6].find('.discount').val();
                var tax_id = lines[7].find('.tax_id').val();
                var tax_amt = lines[8].find('.tax_amt').val();
                var total = lines[9].find('.total').val();
                
                var obj2 = {};
                obj2['product_id'] = product_id;
                //obj2['product_name'] = product_name;
                obj2['varientname'] = varientname;
                /*obj2['shop_id'] = shop_id;*/
                obj2['serial_no'] = serial_no;
                obj2['qty'] = qty;
                obj2['price'] = price;
                obj2['discount'] = discount;
                obj2['tax_id'] = tax_id;
                obj2['tax_amt'] = tax_amt;
                obj2['total'] = total;

                result2.push(obj2);
            });

            var objectresult = {result1,result2};
    		if(supplier_id <= 0 || supplier_id == null)
    		{
    			$("#ErrSucc").html("Please Select Supplier");
    		}
    		else
    		{
    			if(shop_id <= 0 || shop_id == null)
	    		{
	    			$("#ErrSucc").html("Please Select Shop");
	    		}
	    		else
	    		{
	    			$("#ErrSucc").html("");
	    			$.ajax({
		                url:"<?php echo base_url(); ?>index.php/Admin/purchaseInsert",
		                type:"POST",
		                data: JSON.stringify(objectresult),
		                datatype: "JSON",
		                success : function(Jsonstr)
		                {   
		                    //alert(Jsonstr);
		                    if(Jsonstr == 1 || Jsonstr == 3)
		                    {
		                        window.location.replace("<?php echo base_url()?>index.php/Admin/managepurchase");
		                    }
		                    else if(Jsonstr == 2 || Jsonstr == 4)
		                    {
		                        window.location.reload("true");
		                    }
		                }
		            });	

	    			/*if(product_id <= 0 || product_id == null)
	    			{
	    				$("#ErrSucc").html("Please Select Product");
	    			}
	    			else
	    			{
	    				if(varientname <=0 || varientname == null)
	    				{
	    					$("#ErrSucc").html("Please Select varient name");
	    				}
	    				else
	    				{
		    				if(serial_no == null)
		    				{
		    					$("#ErrSucc").html("Please Enter Serial_no");
		    				}
		    				else
		    				{
			    				if(shop_id <=0)
			    				{
			    					$("#ErrSucc").html("Please Select Shop");
			    				}
			    				else
			    				{*/
					    			
				    			/*}
				    		}
				    	}
	    			}*/
	    		}
    		}
            e.preventDefault();
        });

        $("#supplier_submit").click(function(e)
        {
        	var supplier_name = $("#supplier_name").val();
            var supplier_mobile = $("#supplier_mobile").val();
            var supplier_address = $("#supplier_address").val();
            var supplier_gstno = $("#supplier_gstno").val();
            var country_id = $("#country_id").val();
            var state_id = $("#state_id").val();
            var city_id = $("#city_id").val();
            var pincode = $("#pincode").val();

            $.ajax({
            	url : "<?php echo base_url()?>index.php/Admin/supplierInsert",
            	type : "Post",
            	data : {supplier_name : supplier_name , supplier_mobile : supplier_mobile, supplier_address : supplier_address , supplier_gstno : supplier_gstno, country_id :country_id , state_id : state_id, city_id : city_id, pincode : pincode },
            	success : function(data)
            	{
            		fetchsupplier();
            		$("#myModalParty").modal("hide");
            	}
            });
        });

        $("#txtserial_no").on('keyup keydown change',function()
        /*$("#txtserial_no").on('change',function()*/
        {
        	var cat_digit = $("#category_digit").val();
        	var ser_no = $("#txtserial_no").val();

        	if(ser_no.length == cat_digit)
        	{	
        		addserialno();
        	}
        	else
        	{	
        		$("#SrrSucc").html("You Enter Less Serial No, If want to add then press Add Button");
        	}
        });

        // start serial modal detail
        $("#btnaddserial").click(function()
        {
        	var txtserial_no = $("#txtserial_no").val();
        	var ser_no = $("#txtserial_no").val();
        	var cat_digit = $("#category_digit").val();
        	
	    	if(txtserial_no == '' || txtserial_no == null)
	    	{
	    		$("#SrrSucc").html("Please Enter Serial No");
	    	}
	    	else
	    	{
	        	addserialno();
	        }
	    });

        $("#table_serialno").on("click", ".deleteOn", function()
        {
            var tr = $(this).closest('tr');
            tr.remove();
            countrow();
        });

        $("#set_serialno").click(function()
        {
        	var tot_qty = $("#total_qty").text();
        	var maxserial_no = [];
        	var textareaserial = new Array();

        	$('#tbody').find('tr').each(function (key, val) 
	        {
	            var lines = $('td', $(this)).map(function(index, td) {
	                return $(td);
	            });

	            maxserial_no = parseFloat(lines[0].find('.serial').val());
	            textareaserial.push(maxserial_no);
	        });
	        
	        $("#serial_no").val(textareaserial);
	        $("#qty").val(tot_qty);
	        $("#myModalSerial").modal("hide");
	        calculate();
        });
        // End serial modal detail
    });

	function fetchvarient()
	{
		var pid = $("#product_id").val();
            
        $.ajax({
            url : "<?php echo base_url()?>index.php/Admin/fetchvarient",
            type : "post",
            data : {pid : pid},
            success : function(data)
            {
                var varient = data;
                var varient1 = varient.split("~");
                $("#varientname").html("");
                $("#varientname").prepend("<option value=''>select</option>").val();
                $.each(varient1, function (index, value) 
                {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#varientname").append(listItem);
                });

                $('select option').filter(function(){
                    return ($(this).val().trim()=="" && $(this).text().trim()=="");
                }).remove();
            }
        });
	}

	function btnmodalclose()
    {
    	clearVal();
    	$("#myModalSerial").modal("hide");
    }

	function addserialno()
	{
		var txtserial_no = $("#txtserial_no").val();
        	
		$("#SrrSucc").html("");
    	var markup = "<tr><td><input type='text' name='serial[]' class='serial form-control' value='"+txtserial_no+"' readonly></td><td class='deleteOn'><a href='#'><i class='fas fa-window-close'></i></a></td></tr>";
    	$("#tbody").append(markup);
        
        countrow();
	}

	function countrow()
	{
		$("#txtserial_no").val("");
		var rowCount = $('#tbody tr').length;
		$("#total_qty").text(rowCount);
	}

	function fetchsupplier()
	{
		$.ajax({
        	url : "<?php echo base_url()?>index.php/Admin/fetchsupplier",
        	type : "Post",
        	success : function(data)
        	{
        		var supplier = data;
                var supplier1 = supplier.split("~");
                $("#supplier_id").html("");
                $("#supplier_id").prepend("<option value=''>select</option>").val();
                $.each(supplier1, function (index, value) 
                {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#supplier_id").append(listItem);
                });

                $('select option').filter(function(){
                    return ($(this).val().trim()=="" && $(this).text().trim()=="");
                }).remove();
        	}
        });	
	}

	function get_state()
    {
        var country_id = $('#country_id').val();
        if(country_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectStateBycountryid",
                method:"POST",
                data:{country_id : country_id},
                success:function(data)
                {
                    $('#state_id').html(data);
                    $('#city_id').html('<option value="">Select City</option>');
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }

    function get_city()
    {
        var state_id = $('#state_id').val();
        if(state_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectCityBystateid",
                method:"POST",
                data:{state_id : state_id},
                success:function(data)
                {
                    $('#city_id').html(data);
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }
    
    function generatedate()
    {
        var bill_date = $("#bill_date").val();
        if(bill_date == '')
        {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            /*$( '#bill_date' ).datepicker({
                dateFormat: 'dd/mm/yy',
                //changeMonth: true,
                //changeYear: true,
                //yearRange: '2019:'+(new Date).getFullYear()
            });*/
            $('#bill_date').datepicker( 'setDate', today );
            $('#due_date').datepicker( 'setDate', today );
        }
    }

    function pricefind()
    {
        var qty = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var price = 0;
        var total = 0; 

        total = parseFloat($('#total').val());
        //qty = parseFloat($('#qty').val());
        tax_id = parseFloat($('#tax_id').val());

        if(tax_id > 0)
        {
            tax_amt = ((total * tax_id) / (100 + tax_id));
        } 
        
        price = total - tax_amt;
        $('#price').val(price.toFixed(2));
        $('#total').val(total.toFixed(2));
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
        $('#tax_amt').val(tax_amt);
    }

    function clearVal()
    {
        $('#rowSr').val(0);
        $('#product_id').val("");
        //$('#product_name').html("");
        $('#varientname').val("");
        $('#serial_no').val("");
        /*$('#shop_id').val("");*/
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
        var FinalTotal = 0;
        var sub_total = 0;

        $('#tbdy').find('tr').each(function (key, val) 
        {
            var lines = $('td', $(this)).map(function(index, td) {
                return $(td);
            });

            sub_total += (parseFloat(lines[9].find('.total').val()));
        });

        FinalTotal = Math.round(sub_total);
        rdoff = FinalTotal - sub_total;

        $('#sub_total').val(sub_total.toFixed(2));
        $('#round_off').val(rdoff.toFixed(2));
        $('#total_amt').val(FinalTotal);
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