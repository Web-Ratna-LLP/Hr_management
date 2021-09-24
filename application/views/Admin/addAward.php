<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Award</h4>
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
                        <h4 class="mt-0 header-title" >Add Award </h4>
                         <p class="text-muted m-b-30"></p>
                        <form class="form-horizontal form-wizard-wrapper" action="<?php echo base_url()?>index.php/Admin/awardInsert" method="post">
                            <input type="hidden" class="form-control" name="id" id="id" value="<?php if(isset($product)){echo $product->product_id;}else{echo '0';}?>">
                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label"> Name</label> 
                                            <input type="text" class="form-control col-md-8" name="a_name" id="a_name" value="<?php if(isset($product)){echo $product->product_name;}else{echo '';}?>" required>
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3">Description</label> 
                                            <input type="text" class="form-control col-md-8" name="Description" id="Description" value="<?php if(isset($product)){echo $product->display_name;}else{echo '';}?>" required>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Gift Item</label> 
                                            <input type="text" class="form-control col-md-8" name="gift" id="gift" value="<?php if(isset($product)){echo $product->hsncode;}else{echo '';}?>" required maxlength="15">
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Employee Name</label> 
                                            <Select class="form-control col-md-8" id="employee_id" name="employee_id" required="">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($managemember as $category) 
                                                
                                                    {
                                                ?>
                                                    <option value="<?php echo $category->employee_id;?>"><?php echo $category->employee_name; ?></option>
                                                <?php
                                                    } 
                                                ?>  
                                            </Select>  
                                        </div>                                        
                                        <div class="form-group row">
                                            <label class="col-md-3">Award By</label> 
                                         <input type="text" name="Award_by" id="Award_by" class="form-control col-md-8" >  
                                        </div> 
                                     
                                <div class="form-group row">
                                    <label class="col-md-3"> Date</label> 
                                    <input type="date" class="form-control col-md-8" name="given_date" id="given_date" required >
                                </div>
                               
                            <div class="form-group mb-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1" >Submit</button> 
                                    <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                                </div>
                            </div>
                            
                        </form>
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

        /*radiocheck();
        $("input[name='product_varient']").change(function()
        {
            radiocheck();
        });*/

        $("#btnadd").click(function()
        {
            //$("#btnclose").html("");
            //var copy = $("#btnclose").append("<a href='#'><i class='fas fa-window-close'></i></a>");
            $("#outervd").append($("#innervd").clone().find("input:text").val("").end());
            //$(".innervd").clone().insertAfter(".innervd:last");
        });

        $("#outervd").on("click", ".btnclose", function()
        //$(".btnclose").click(function()
        {
            //$('html').not('.innervd:first').remove();
            $(this).closest('.innervd').remove();
        });
        
    });

    function btninsertsave()
    {
        var result1 = [];
        var result2 = [];
        
        var product_id = $("#product_id").val();
        var product_name = $("#product_name").val();
        var display_name = $("#display_name").val();
        var product_desc = $("#product_desc").val();
        var hsncode = $("#hsncode").val();
        var category_id = $("#category_id").val();
        var brand_id = $("#brand_id").val();
        var purchase_tax = $("#purchase_tax").val();
        var sale_tax = $("#sale_tax").val();
        /*var type_of_discount = $("#type_of_discount").val();
        var discount = $("#discount").val();*/
        /*var tax_inclusion = $("#tax_inclusion").val();*/
        
        //var product_varient = $("input[name='product_varient']:checked").val();
        //alert(product_varient);

        var obj1 = {};
        obj1['product_id'] = product_id;
        obj1['product_name'] = product_name;
        obj1['display_name'] = display_name;
        obj1['product_desc'] = product_desc;
        obj1['hsncode'] = hsncode;
        obj1['category_id'] = category_id;
        obj1['brand_id'] = brand_id;
        obj1['purchase_tax'] = purchase_tax;
        obj1['sale_tax'] = sale_tax;
        /*obj1['type_of_discount'] = type_of_discount;
        obj1['discount'] = discount;
        if(tax_inclusion != '' && tax_inclusion != null)
        {
            obj1['tax_inclusion'] = tax_inclusion;
        }
        else
        {
            obj1['tax_inclusion'] = "";
        }*/
        //obj1['product_varient'] = product_varient;

        result1.push(obj1);


        var varient_name = [];
        $('input[name^=varient_name]').each(function(){
             varient_name.push($(this).val());
        });

        /*var purchase_price = [];
        $('input[name^=purchase_price]').each(function(){
             purchase_price.push($(this).val());
        });

        var customer_price = [];
        $('input[name^=customer_price]').each(function(){
             customer_price.push($(this).val());
        });*/

      //  var barcode = [];
       // $('input[name^=barcode]').each(function(){
        //     barcode.push($(this).val());
       // });        

        /*var min_stock = [];
        $('input[name^=min_stock]').each(function(){
             min_stock.push($(this).val());
        });*/
        
        
        var obj2 = {};
        obj2['varient_name'] = varient_name;
       /* obj2['purchase_price'] = purchase_price;
        obj2['customer_price'] = customer_price;*/
        obj2['barcode'] = barcode;
        /*obj2['min_stock'] = min_stock;*/

        result2.push(obj2);
        

        var objectresult = {result1,result2};
        //alert(JSON.stringify(objectresult));

        $.ajax({
            url:"<?php echo base_url() ?>index.php/Admin/productInsert",
            type:"POST",
            data: JSON.stringify(objectresult),
            datatype: "JSON",
            success : function(Jsonstr)
            {   //alert(Jsonstr);
                if(Jsonstr == 1 || Jsonstr == 3)
                {
                    window.location.replace("<?php echo base_url()?>index.php/Admin/manageproduct");
                }
                else
                {
                    //window.location.reload("true");
                }
            }
        });
        
    }
</script>