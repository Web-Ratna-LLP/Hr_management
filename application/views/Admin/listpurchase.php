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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mt-0 header-title">List Purchase</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addnewpurchase" class="btn btn-primary">Add New</a>
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Supplier Name</th>
                                        <th>Bill No</th>
                                        <th>Bill Date</th>
                                        <th>SubTotal</th>
                                        <th>Total Amount</th>
                                        <th>Remain Amount</th>
                                        <th>Pay Amount</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managepurchase as $purchase) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $purchase->supplier_name; ?></td>
                                        <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/getpurchasedetail/<?php echo $purchase->purchase_id;?>" ><?php echo $purchase->bill_no; ?></td>
                                        <td><?php echo $purchase->bill_date; ?></td>
                                        <td><?php echo $purchase->sub_total; ?></td>
                                        <td><?php if(isset($purchase->total_amt)){echo $purchase->total_amt;}else{echo 0;} ?></td>
                                        <td><?php if(isset($purchase->remain_amount)){echo $purchase->remain_amount;}else{echo 0;} ?></td>
                                        <td><?php if(isset($purchase->pay_amount)){echo $purchase->pay_amount;}else{echo 0;} ?></td>
                                        <!-- <td><a style="color:blue;" value="<?php echo $purchase->purchase_id;?>" onclick="btneditpurchase(this)"><i class="fa fa-edit"></i></a></td> -->
                                        <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/printpurchase/<?php echo $purchase->purchase_id;?>/<?php echo $purchase->shop_id;?>"><i class="fas fa-print"></i></a></td>

                                        <td><a style="color:blue;"  value="<?php echo $purchase->purchase_id;?>" onclick="btnsupplierpayment(this)"><i class="fas fa-credit-card"></i></a></td>

                                        <td><a style="color:red;"  value="<?php echo $purchase->purchase_id;?>" onclick="btndeletepurchase(this)"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    ?> 
                                </tbody>
                            </table>

                            <!-- Vendor Payment modal -->
                            <div class="container" >
                                <!-- Modal -->
                                <div class="modal fade col-md-12" id="myModalPayment" role="dialog">
                                    <div class="modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Supplier Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                <form  action="" class="form-horizontal" id="party_form" >
                                                    <div class="row">
                                                        <input type="hidden" id="pur_id" name="pur_id" class="form-control">
                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Supplier Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="supplier_name" name="supplier_name" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Bill No</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="bill_no" name="bill_no" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Remain Amount</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="remain_amount" name="remain_amount" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Pay Amount</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="pay_amount" name="pay_amount" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="row">
                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label col-md-3"></label>
                                                            <div class="col-md-9">
                                                                <button type="button" class="btn btn-success waves-effect waves-light" id="payment_submit" name="save">Save</button>
                                                                <button type="button" class="btn btn-inverse waves-effect waves-light" data-dismiss="modal" name="cancel">Cancel</button><br><br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label style="color: red;" id="ErrSucc"></label>
                                                </form>
                                                </div>
                                                <br>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <label id="PaymentErr" style="color:red;"></label>
                                                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnmodalclose">Close</button>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

<script type="text/javascript">

    $(document).ready(function ()
    {
        $("#payment_submit").click(function(e)
        {
            var remain_amount = $("#remain_amount").val();
            var pay_amount = $("#pay_amount").val();
            var purchase_id = $("#pur_id").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/SupplierPayment",
                type : "Post",
                data : {remain_amount : remain_amount, pay_amount : pay_amount, purchase_id : purchase_id },
                success : function(data)
                {
                    $("#myModalPayment").modal("hide");
                    window.location.reload("true");
                }
            });
        });
    });

    function btnsupplierpayment(e)
    {
        var purchase_id = $(e).attr('value');
        //alert(purchase_id);
        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/getpurchase",
            type:"POST",
            data:{purchase_id : purchase_id},
            success:function(data)
            {   //alert(data);
                if(data == 0)
                {
                    $('#ErrSucc').html("Purchase Not Found");
                }
                else
                {
                    var purchase = data.split('^');
                    $paymentmodal = $('#myModalPayment');
                    $paymentmodal.modal('show');
                    $("#pur_id").val(purchase[0]);
                    $('#supplier_name').val(purchase[1]);
                    $('#bill_no').val(purchase[2]);
                    $('#remain_amount').val(purchase[3]);
                }                  
            }
        }); 
    }

    function btneditproduct(e)
    {
        var product_id = $(e).attr('value');

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/Editproduct",
            type:"POST",
            data:{product_id : product_id},
            success:function(data)
            {   //alert(data);
                if(data == 0)
                {
                    $('#ErrSucc').html("product Not Found");
                }
                else
                {
                    var product = data;
                    var product1 = product.split(',');

                    $("#product_id").val(product1[0]);
                    $('#product_name').val(product1[1]);
                    $('#product_mobile').val(product1[2]);
                    $('#product_address').val(product1[3]);
                    $('#product_gstno').val(product1[4]);
                    $('#country_id').val(product1[5]);
                    $('#state_id').val(product1[6]);
                    $('#city_id').val(product1[7]);
                    $('#pincode').val(product1[8]);
                }                  
            }
        });  
        //e.preventDefault();
    }

    function btndeletepurchase(e)
    {
        var purchase_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeletePurchase",
                type:"POST",
                data:{purchase_id : purchase_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        window.location.reload("true");
                    }
                    else
                    {
                        window.location.reload("true");
                        //$('#ErrSucc').html("khatavahi Delete Successfully");
                    }                  
                }
            });          
        }
        return false;
        e.preventDefault();
    }
</script>