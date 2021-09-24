    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Tax</h4>
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
                            <h4 class="mt-0 header-title" >Add Tax</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/taxInsert" method="post">
                                <input type="hidden" class="form-control" name="tax_id" id="tax_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Tax Name</label> 
                                    <input type="text" class="form-control col-md-9" name="tax_name" id="tax_name" required placeholder="Tax Name">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Tax Rate</label> 
                                    <input type="text" class="form-control col-md-9" name="tax_rate" id="tax_rate" required placeholder="Tax Rate">
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
                            <h4 class="mt-0 header-title">List Tax</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Tax Name</th>
                                        <th>Tax Rate</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managetax as $tax) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $tax->tax_name; ?></td>
                                        <td><?php echo $tax->tax_rate; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $tax->tax_id;?>" onclick="btnedittax(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $tax->tax_id;?>" onclick="btndeletetax(this)"><i class="fa fa-trash"></i></a></td>
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
        function btnedittax(e)
        {
            var tax_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditTax",
                type:"POST",
                data:{tax_id : tax_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Tax Not Found");
                    }
                    else
                    {
                        var tax = data;
                        var tax1 = tax.split(',');

                        $("#tax_id").val(tax1[0]);
                        $('#tax_name').val(tax1[1]);
                        $('#tax_rate').val(tax1[2]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletetax(e)
        {
            var tax_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteTax",
                    type:"POST",
                    data:{tax_id : tax_id},
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