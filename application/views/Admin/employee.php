    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Employees</h4>
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
                            <h4 class="mt-0 header-title">Add Employees</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/employeeInsert" method="post">
                                <input type="hidden" class="form-control" name="employee_id" id="employee_id">
                               
                                <div class="form-group row">
                                    <label class="col-md-3"></label> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Name</label> 
                                    <input type="text" class="form-control col-md-8" name="employee_name" id="employee_name" required >
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-md-3"> UserName</label> 
                                    <input type="text" class="form-control col-md-8" name="employee_username" id="employee_username" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Password</label> 
                                    <input type="password" class="form-control col-md-8" name="employee_password" id="employee_password" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Mobile</label> 
                                    <input type="text" class="form-control col-md-8" name="employee_mobile" id="employee_mobile" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Email</label> 
                                    <input type="text" class="form-control col-md-8" name="employee_email" id="employee_email"  >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Address</label>
                                    <textarea class="form-control col-md-8" name="employee_address" id="employee_address"></textarea>
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
                            <h4 class="mt-0 header-title">List Employee</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($manageemployee as $employee) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $employee->employee_name; ?></td>
                                        <td><?php echo $employee->employee_username; ?></td>
                                        <td><?php echo $employee->employee_mobile; ?></td>
                                        <td><?php echo $employee->employee_email; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $employee->employee_id;?>" onclick="btneditemployee(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $employee->employee_id;?>" onclick="btndeleteemployee(this)"><i class="fa fa-trash"></i></a></td>
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
        function btneditemployee(e)
        {
            var employee_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditEmployee",
                type:"POST",
                data:{employee_id : employee_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("Employee Not Found");
                    }
                    else
                    {
                        var employee = data;
                        var employee1 = employee.split(',');

                        $("#employee_id").val(employee1[0]);
                        $('#employee_name').val(employee1[1]);
                        $('#employee_mobile').val(employee1[2]);
                        $('#employee_username').val(employee1[3]);
                        $('#employee_password').val(employee1[4]);
                        $('#employee_address').val(employee1[5]);
                        $('#employee_email').val(employee1[6]);
                        $('#shop_id').val(employee1[6]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeleteemployee(e)
        {
            var employee_id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/DeleteEmployee",
                    type:"POST",
                    data:{employee_id : employee_id},
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