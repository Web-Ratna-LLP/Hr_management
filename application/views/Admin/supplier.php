    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Supplier</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title" >Add Supplier</h4>
                             <p class="text-muted m-b-30"></p>
                            <form class="" action="<?php echo base_url()?>index.php/Admin/supplierInsert" method="post">
                                <input type="hidden" class="form-control" name="supplier_id" id="supplier_id">
                                <div class="form-group row">
                                    <label class="col-md-3">Supplier Name</label> 
                                    <input type="text" class="form-control col-md-8" name="supplier_name" id="supplier_name" required >
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Supplier Mobile</label> 
                                    <input type="text" class="form-control col-md-8" name="supplier_mobile" id="supplier_mobile" required maxlength="10">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Supplier Address</label> 
                                    <textarea class="form-control col-md-8" name="supplier_address" id="supplier_address"></textarea>
                                    <!-- <input type="text" class="form-control col-md-8" name="supplier_rate" id="supplier_address" required > -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Supplier Gstno</label> 
                                    <input type="text" class="form-control col-md-8" name="supplier_gstno" id="supplier_gstno" required maxlength="15">
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Country</label> 
                                    <!-- <input type="text" class="form-control col-md-8" name="country_id" id="country_id" required > -->
                                    <Select class="form-control col-md-8" id="country_id" name="country_id" required="">
                                        <option>Select</option>
                                        <?php
                                            foreach ($AllCountry as $country) 
                                            {
                                        ?>
                                            <option value="<?php echo $country->country_id;?>"><?php echo  $country->country_name; ?></option>
                                        <?php
                                            } 
                                        ?>  
                                    </Select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">State</label> 
                                   <!--  <input type="text" class="form-control col-md-8" name="state_id" id="state_id" required > -->
                                    <Select class="form-control col-md-8" id="state_id" name="state_id">
                                        <option>Select Country First</option>
                                    </Select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">City</label> 
                                    <Select class="form-control col-md-8" id="city_id" name="city_id">
                                        <option>Select State First</option>
                                    </Select>
                                    <!-- <input type="text" class="form-control col-md-8" name="city_id" id="city_id" required > -->
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3">Pincode</label> 
                                    <input type="text" class="form-control col-md-8" name="pincode" id="pincode" required maxlength="6">
                                </div>
                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button> 
                                        <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                    </div>
                                </div>
                                <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mt-0 header-title">List supplier</h4>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Gstno</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Remain Amt</th>
                                        <th>Pay Amt</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cnt = 1;
                                        foreach ($managesupplier as $supplier) 
                                        {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $supplier->supplier_name; ?></td>
                                        <td><?php echo $supplier->supplier_mobile; ?></td>
                                        <td><?php echo $supplier->supplier_gstno; ?></td>
                                        <td><?php echo $supplier->state_name; ?></td>
                                        <td><?php echo $supplier->city_name; ?></td>
                                        <td><?php echo $supplier->total_remain_amount; ?></td>
                                        <td><?php echo $supplier->total_pay_amount; ?></td>
                                        <td><a style="color:blue;" value="<?php echo $supplier->supplier_id;?>" onclick="btneditsupplier(this)"><i class="fa fa-edit"></i></a></td>
                                        <td><a style="color:red;"  value="<?php echo $supplier->supplier_id;?>" onclick="btndeletesupplier(this)"><i class="fa fa-trash"></i></a></td>
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
        $('#country_id').change(function()
        {   
            get_state();
        });  

        $('#state_id').change(function()
        {    
            get_city();
        });    
    });

    function get_state()
    {
        var country_id = $('#country_id').val();
        if(country_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectStateBycountryid",
                method:"POST",
                data:{country_id : country_id},
                success:function(data)
                {
                    $('#state_id').html(data);
                    $('#city_id').html('<option value="">Select City</option>');
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }

    function get_city()
    {
        var state_id = $('#state_id').val();
        if(state_id != '')
        {
           $.ajax({
                url:"<?=base_url() ?>index.php/Admin/selectCityBystateid",
                method:"POST",
                data:{state_id : state_id},
                success:function(data)
                {
                    $('#city_id').html(data);
                }
            });
        }
        else
        {
           $('#state_id').html('<option value="">Select State</option>');
           $('#city_id').html('<option value="">Select City</option>');
        }
    }

    function btneditsupplier(e)
    {
        var supplier_id = $(e).attr('value');

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/EditSupplier",
            type:"POST",
            data:{supplier_id : supplier_id},
            success:function(data)
            {   //alert(data);
                if(data == 0)
                {
                    $('#ErrSucc').html("Supplier Not Found");
                }
                else
                {
                    var supplier = data;
                    var supplier1 = supplier.split(',');

                    $("#supplier_id").val(supplier1[0]);
                    $('#supplier_name').val(supplier1[1]);
                    $('#supplier_mobile').val(supplier1[2]);
                    $('#supplier_address').val(supplier1[3]);
                    $('#supplier_gstno').val(supplier1[4]);
                    $('#country_id').val(supplier1[5]);
                    $('#state_id').val(supplier1[6]);
                    $('#city_id').val(supplier1[7]);
                    $('#pincode').val(supplier1[8]);
                }                  
            }
        });  
        //e.preventDefault();
    }

    function btndeletesupplier(e)
    {
        var supplier_id = $(e).attr('value');

        if (confirm("Are you sure?")) 
        {
            $.ajax({
                url:"<?php echo base_url() ?>index.php/Admin/DeleteSupplier",
                type:"POST",
                data:{supplier_id : supplier_id},
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