    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Financial Year</h4>
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
                            <h4 class="mt-0 header-title">Add Financial Year</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/FinancialyearInsert" method="post">
                                <input type="hidden" class="form-control" name="financialyear_id" id="financialyear_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Financial Year Name</label> 
                                    <input type="text" class="form-control col-md-9" name="financial_name" id="financial_name" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Start Date</label> 
                                    <input type="date" class="form-control col-md-9" name="start_date" id="start_date" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">End Date</label> 
                                    <input type="date" class="form-control col-md-9" name="end_date" id="end_date">
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
                            <h4 class="mt-0 header-title">List financialyear</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Financial Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managefinancialyear as $financialyear) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $financialyear->financial_name; ?></td>
                                        <td><?php echo $financialyear->start_date; ?></td>
                                        <td><?php echo $financialyear->end_date; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $financialyear->financialyear_id;?>" onclick="btneditfinancialyear(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $financialyear->financialyear_id;?>" onclick="btndeletefinancialyear(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditfinancialyear(e)
        {
            var financialyear_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditFinancialYear",
                type:"POST",
                data:{financialyear_id : financialyear_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Financial Year Not Found");
                    }
                    else
                    {
                        var financialyear1 = data.split(',');

                        $("#financialyear_id").val(financialyear1[0]);
                        $('#financial_name').val(financialyear1[1]);
                        $('#start_date').val(financialyear1[2]);
                        $('#end_date').val(financialyear1[3]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeletefinancialyear(e)
        {
            var financialyear_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteFinancialYear",
                    type:"POST",
                    data:{financialyear_id : financialyear_id},
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