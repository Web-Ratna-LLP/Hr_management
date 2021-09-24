<div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Transfer Phone List</h4>
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
                                    <h4 class="mt-0 header-title ">Transfer Phone</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo base_url()?>index.php/Admin/addtranferphone" class="btn btn-primary">Add New</a>
                                    <!-- <a href="<?php echo base_url()?>index.php/Admin/printallsale" class="btn btn-primary">print</a> -->
                                </div>
                            </div>
                            <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>product_id</th>
                                        <th>product_detail_id</th>
                                        <th>Serial No</th>
                                        <th>Shop</th>
                                        <th>actul_shop</th>
                                        <th>Date</th>
                                        <th>total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($transferhone as $phone) 
                                        {
                                            
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $phone->product_id; ?></td>
                                        <td><?php echo $phone->product_detail_id; ?></td>
                                        <td><?php echo $phone->serial_no; ?></td>
                                        <td><?php echo $phone->shop_id;?></td>
                                        <td><?php echo $phone->actul_shop; ?></td>
                                        <td><?php echo $phone->transferdate; ?></td>
                                        <td><?php echo $phone->total; ?></td>
                                        <td><a style="color:blue;" href="<?php echo base_url()?>index.php/Admin/EditPhone/<?php echo $phone->transfer_id;?>"><i class="fa fa-edit"></i></a></td>


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

    $(document).ready(function ()
    {
         
    });

    function btneditemployee(e)
        {
            var transfer_id = $(e).attr('value');

            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/Editphone",
                type:"POST",
                data:{transfer_id : transfer_id},
                success:function(data)
                {   //alert(data);
                    if(data == 0)
                    {
                        $('#ErrSucc').html("phone Not Found");
                    }
                    else
                    {
                        var phone = data;
                        var phone1 = phone.split(',');

                        
                    $("#product_id").val(phone1[0]);
                    $('#product_detail_id').val(phone1[1]);
                    $('#serial_no').val(phone1[2]);
                    $('#shop_id').val(phone1[3]);
                    $('#actul_shop').val(phone1[4]);
                    $('#transferdate').val(phone1[5]);
                    $('#price').val(phone1[6]);
                    $('#total').val(phone1[7]);
                    }                  
                }
            });  
            e.preventDefault();
        }
  

    function btndeletesale(e)
    {
        var sale_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeleteSale",
                type:"POST",
                data:{sale_id : sale_id},
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