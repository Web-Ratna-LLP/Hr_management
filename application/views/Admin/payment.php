<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Payment</h4>
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
                                    <h4 class="mt-0 header-title">List Payment</h4>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th> Name</th>
                                        <th>Number</th>
                                        <th>Plan</th>
                                        <th>Plan Price</th>
                                        <th>Pay Amount</th>
                                        <th>Remain Amount</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managemember as $purchase) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $purchase->m_name; ?></td>
                                        <td><?php echo $purchase->number; ?></td>
                                        <td><?php echo $purchase->name; ?></td>
                                        <td><?php echo $purchase->rate; ?></td>
                                        <td><?php echo $purchase->pay_rate; ?></td>
                                        <td><?php echo $purchase->due_rate; ?></td>
                                        
                                        <!-- <td><a style="color:blue;" value="<?php echo $purchase->purchase_id;?>" onclick="btneditpurchase(this)"><i class="fa fa-edit"></i></a></td> -->
                                        <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/printmember/<?php echo $purchase->member_id;?>"><i class="fas fa-print"></i></a></td>

                                        <td><a style="color:blue;"  value="<?php echo $purchase->member_id;?>" onclick="btnsupplierpayment(this)"><i class="fas fa-credit-card"></i></a></td>

                                        <td><a style="color:red;"  value="<?php echo $purchase->member_id;?>" onclick="btndeletepurchase(this)"><i class="fas fa-trash"></i></a></td>
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
                                                <h4 class="modal-title">Member Payment</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                <form  action="" class="form-horizontal" id="party_form" >
                                                    <div class="row">
                                                        <input type="hidden" id="member_id" name="member_id" class="form-control">
                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3"> Name</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="m_name" name="m_name" class="form-control">
                                                            </div>
                                                        </div>


                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Remain Amount</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="due_rate" name="due_rate" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 row">
                                                            <label class="control-label text-left col-md-3">Pay Amount</label>
                                                            <div class="col-md-9">
                                                                <input type="text" id="pay_rate" name="pay_rate" class="form-control">
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
            var pay_rate = $("#pay_rate").val();
            var due_rate = $("#due_rate").val();
            var m_name = $("#m_name").val();
            var member_id = $("#member_id").val();

            $.ajax({
                url : "<?php echo base_url()?>index.php/Admin/memberPayment",
                type : "Post",
                data : {member_id : member_id, m_name : m_name, due_rate : due_rate, pay_rate : pay_rate },
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
        var member_id = $(e).attr('value');
        //alert(purchase_id);
        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/Editmember",
            type:"POST",
            data:{member_id : member_id},
            success:function(data)
            {   //alert(data);
                if(data == 0)
                {
                    $('#ErrSucc').html("Purchase Not Found");
                }
                else
                {
                    var product = data;
                    var product1 = product.split(',');

                    $paymentmodal = $('#myModalPayment');
                    $paymentmodal.modal('show');
                    $("#member_id").val(product1[0]);
                    $('#m_name').val(product1[1]);
                    $('#due_rate').val(product1[2]);
                    $('#pay_rate').val(product1[3]);
                   
                }                  
            }
        }); 
    }

    function btneditproduct(e)
    {
        var member_id = $(e).attr('value');

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/Editmember",
            type:"POST",
            data:{member_id : member_id},
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

                    $("#member_id").val(product1[0]);
                    $('#m_name').val(product1[1]);
                    $('#due_rate').val(product1[2]);
                    $('#pay_rate').val(product1[3]);
                   
                }                  
            }
        });  
        //e.preventDefault();
    }

    function btndeletepurchase(e)
    {
        var member_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/Deletemember",
                type:"POST",
                data:{member_id : member_id},
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