<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">  Candidate   </h4>
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
                                    <h4 class="mt-0 header-title">List  Candidate  </h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addCandidate" class="btn btn-primary"> Add New Candidate </a>
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th> Name</th>
                                        <th>email</th>
                                        <th>Number </th>
                                        <th>Address </th>
                                        <th>Degree</th>
                                        <th>University</th>
                                        <th>CGPA</th>
                                        <th>Year</th>
                                        <th>Company Name</th>
                                        <th>Duties</th>
                                        <th>experience</th>
                                        <th>CTC</th>
                                        
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
                                        <td><?php echo $purchase->Candidate_name; ?></td>
                                        <td><?php echo $purchase->email; ?></td>
                                        <td><?php echo $purchase->number; ?></td>
                                        <td><?php echo  $purchase->Address; ?></td>
                                        <td><?php echo $purchase->Degree; ?></td>
                                        <td><?php echo $purchase->University; ?></td>
                                        <td><?php echo $purchase->CGPA; ?></td>
                                        <td><?php echo $purchase->Year; ?></td>
                                        <td><?php echo $purchase->C_name; ?></td>
                                        <td><?php echo $purchase->Duties; ?></td>
                                        <td><?php echo $purchase->experience; ?></td>
                                        <td><?php echo $purchase->CTC; ?></td>
                                       
                                  

                                        <td><a style="color:red;"  value="<?php echo $purchase->Candidate_id;?>" onclick="btndeletepurchase(this)"><i class="fas fa-trash"></i></a></td>
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
        var Candidate_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeleteCandidate",
                type:"POST",
                data:{Candidate_id : Candidate_id},
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