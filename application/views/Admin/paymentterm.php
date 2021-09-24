    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Payment Term</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">Add Payment Term</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/PaymentTermInsert" method="post">
                                <input type="hidden" class="form-control" name="payment_term_id" id="payment_term_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Payment Term Name</label> 
                                    <input type="text" class="form-control col-md-9" name="payment_term_name" id="payment_term_name" required >
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button> 
                                        <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">List Payment Term</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managepaymentterm as $payment_term) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $payment_term->payment_term_name; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $payment_term->payment_term_id;?>" onclick="btneditpayment_term(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $payment_term->payment_term_id;?>" onclick="btndeletepayment_term(this)"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

    <script type="text/javascript">
        function btneditpayment_term(e)
        {
            var payment_term_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditPaymentTerm",
                type:"POST",
                data:{payment_term_id : payment_term_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("payment_term Not Found");
                    }
                    else
                    {
                        var payment_term1 = data.split(',');

                        $("#payment_term_id").val(payment_term1[0]);
                        $('#payment_term_name').val(payment_term1[1]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletepayment_term(e)
        {
            var payment_term_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeletePaymentTerm",
                    type:"POST",
                    data:{payment_term_id : payment_term_id},
                    success:function(data)
                    {   
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