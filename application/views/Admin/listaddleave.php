<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title"> Leave Application List </h4>
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
                                    <h4 class="mt-0 header-title">List Leave Application </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addleave" class="btn btn-primary">Add Leave Application</a>
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Employee Name</th>
                                        <th>Leave Type</th>
                                        <th>start date </th>
                                        <th>end date </th>
                                        <th>Approved By</th>
                                        <th>Approved Date</th>
                                        <th>Award By</th>
                                        <th>Reason</th>
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($leave as $purchase) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $purchase->employee_name; ?></td>
                                        <td><?php echo $purchase->name; ?></td>
                                        <td><?php echo $purchase->start_date; ?></td>
                                        <td><?php echo  $purchase->end_date; ?></td>
                                        <td><?php echo $purchase->Approved; ?></td>
                                        <td><?php echo $purchase->given_date; ?></td>
                                        <td><?php echo $purchase->Reason; ?></td>
                                       
                                  

                                        <td><a style="color:red;"  value="<?php echo $purchase->addleave_id;?>" onclick="btndeletepurchase(this)"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    ?> 
                                </tbody>
                            </table>
                            <!-- Vendor Payment modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
<script type="text/javascript">


    function btndeletepurchase(e)
    {
        var addleave_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/Deleteaddleave",
                type:"POST",
                data:{addleave_id : addleave_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        window.location.reload("true");
                    }
                    else
                    {
                        window.location.reload("true");
                    }                  
                }
            });          
        }
        return false;
        e.preventDefault();
    }
</script>