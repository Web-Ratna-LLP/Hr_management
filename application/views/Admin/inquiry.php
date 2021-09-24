<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">inquiry</h4>
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
                            <h4 class="mt-0 header-title">Add inquiry</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/inquiryInsert" method="post">
                                <input type="hidden" class="form-control" name="id" id="id">
                               
                                    <div class="form-group row">
                                    <label class="col-md-3"></label> 
                                    <input type="hidden"   > 
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-md-3"> Name</label> 
                                    <input type="text" class="form-control col-md-8" name="name" id="name" required >
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3"> Email</label> 
                                    <input type="text" class="form-control col-md-8" name="email" id="email"  >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Mobile</label> 
                                    <input type="text" class="form-control col-md-8" name="mobile" id="mobile" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3"> Address</label>
                                    <textarea class="form-control col-md-8" name="address" id="address"></textarea>
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
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
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
                                        <td><?php echo $employee->name; ?></td>
                                        <td><?php echo $employee->email; ?></td>
                                        <td><?php echo $employee->mobile; ?></td>
                                        <td><?php echo $employee->address; ?></td>
                                        <td><a style="color:red;"  value="<?php echo $employee->id;?>" onclick="btndeleteemployee(this)"><i class="fa fa-trash"></i></a></td>
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
            var id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/EditEmployee",
                type:"POST",
                data:{id : id},
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

                        $("#id").val(employee1[0]);
                        $('#name').val(employee1[1]);
                        $('#mobile').val(employee1[2]);
                        $('#username').val(employee1[3]);
                        $('#password').val(employee1[4]);
                        $('#address').val(employee1[5]);
                        $('#email').val(employee1[6]);
                        $('#shop_id').val(employee1[6]);
                    }                  
                }
            });  
            //e.preventDefault();
        }

        function btndeleteemployee(e)
        {
            var id = $(e).attr('value');

            if (confirm("Are you sure?")) 
            {
                $.ajax({
                    url:"<?php echo base_url() ?>index.php/Admin/Deleteinquiry",
                    type:"POST",
                    data:{id : id},
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