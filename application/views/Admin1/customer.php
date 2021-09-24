    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Customer</h4>
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
                            <h4 class="mt-0 header-title">Add Customer</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/customerInsert" method="post">
                                <input type="hidden" class="form-control" name="customer_id" id="customer_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Customer Name</label> 
                                    <input type="text" class="form-control col-md-8" name="customer_name" id="customer_name" required>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3">Customer Mobile</label> 
                                    <input type="text" class="form-control col-md-8" name="customer_mobile" id="customer_mobile" maxlength="10" pattern="[1-9]{1}[0-9]{9}"  title="10 digit only" required>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3">Customer Email</label> 
                                    <input type="text" class="form-control col-md-8" name="customer_email" id="customer_email">
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3">Customer Address</label> 
                                    <textarea id="customer_address" name="customer_address" class="form-control col-md-8"></textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button> 
                                        <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                    </div>
                                </div><br>

                                <label style="color: red;" id="ErrSucc"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">List customer</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managecustomer as $customer) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $customer->customer_name; ?></td>
                                        <td><?php echo $customer->customer_mobile; ?></td>
                                        <td><?php echo $customer->customer_email; ?></td>
                                        <td><?php echo $customer->customer_address; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $customer->customer_id;?>" onclick="btneditcustomer(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $customer->customer_id;?>" onclick="btndeletecustomer(this)"><i class="fa fa-trash"></i></a></td>
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

        function btneditcustomer(e)
        {
            var customer_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditCustomer",
                type:"POST",
                data:{customer_id : customer_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Customer Not Found");
                    }
                    else
                    {
                        var customer = data;
                        var customer1 = customer.split(',');

                        $("#customer_id").val(customer1[0]);
                        $('#customer_name').val(customer1[1]);
                        $('#customer_mobile').val(customer1[2]);
                        $('#customer_email').val(customer1[3]);
                        $('#customer_address').val(customer1[4]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletecustomer(e)
        {
            var customer_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteCustomer",
                    type:"POST",
                    data:{customer_id : customer_id},
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