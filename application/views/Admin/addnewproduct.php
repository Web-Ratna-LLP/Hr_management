<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">Product</h4>
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
                        <h4 class="mt-0 header-title" >Add Product</h4>
                         <p class="text-muted m-b-30"></p>
                        <form class="form-horizontal form-wizard-wrapper" action="" method="post">
                            <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?php if(isset($product)){echo $product->product_id;}else{echo '0';}?>">
                            <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Product Name</label> 
                                            <input type="text" class="form-control col-md-8" name="product_name" id="product_name" value="<?php if(isset($product)){echo $product->product_name;}else{echo '';}?>" required>
                                        </div>
                                   
                                        <div class="form-group row">
                                            <label class="col-md-3">Display Name</label> 
                                            <input type="text" class="form-control col-md-8" name="display_name" id="display_name" value="<?php if(isset($product)){echo $product->display_name;}else{echo '';}?>" required>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Hsncode</label> 
                                            <input type="text" class="form-control col-md-8" name="hsncode" id="hsncode" value="<?php if(isset($product)){echo $product->hsncode;}else{echo '';}?>" required maxlength="15">
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-md-3">Product Description</label> 
                                            <textarea class="form-control col-md-8" name="product_desc" id="product_desc" required><?php if(isset($product)){echo $product->product_desc;}else{echo '';}?></textarea>
                                        </div>
                                               
                                        <!-- <div class="form-group row">
                                            <label class="col-md-3">Tax Inclusion</label> 
                                            <input type="checkbox" class="form-control col-md-1" style="text-align: left;" name="tax_inclusion" id="tax_inclusion" value="<?php if(isset($product)){echo $product->tax_inclusion;}else{echo '';}?>">
                                        </div> -->

                                        <label style="color: red;"><?php if(isset($_SESSION['ErrSucc'])){echo $_SESSION['ErrSucc']; unset($_SESSION['ErrSucc']); }?></label>
                                    </div>                              
                                
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-md-3">Category</label> 
                                            <Select class="form-control col-md-8" id="category_id" name="category_id" required="">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($managecategory as $category) 
                                                    {
                                                        if(isset($product->category_id))
                                                        {
                                                            if($product->category_id == $category->category_id)
                                                            {  
                                                ?>
                                                                <option value="<?php echo $category->category_id;?>" selected=""><?php echo $category->category_name;?></option>
                                                <?php
                                                            }
                                                            else
                                                            {  
                                                ?>
                                                                <option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {   
                                                ?>
                                                        <option value="<?php echo $category->category_id;?>"><?php echo $category->category_name;?></option>
                                                <?php
                                                        }
                                                    } 
                                                ?>  
                                            </Select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Brand</label> 
                                            <Select class="form-control col-md-8" id="brand_id" name="brand_id">
                                                <option>Select</option>
                                                <?php 
                                                    foreach ($managebrand as $brand) 
                                                    {
                                                        if(isset($product->brand_id))
                                                        {
                                                            if($product->brand_id == $brand->brand_id)
                                                            {  
                                                ?>
                                                                <option value="<?php echo $brand->brand_id;?>" selected=""><?php echo $brand->brand_name;?></option>
                                                <?php
                                                            }
                                                            else
                                                            {  
                                                ?>
                                                                <option value="<?php echo $brand->brand_id;?>"><?php echo $brand->brand_name;?></option>
                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {   
                                                ?>
                                                            <option value="<?php echo $brand->brand_id;?>"><?php echo  $brand->brand_name; ?></option>
                                                <?php
                                                        } 
                                                    }
                                                ?>  
                                            </Select>
                                        </div>                                        
                                    
                                        <!-- <div class="form-group row">
                                            <label class="col-md-3">Type of Discount</label> 
                                            <Select class="form-control col-md-8" id="type_of_discount" name="type_of_discount">
                                                <option value="">Select</option>
                                                <option value="1">Percentage</option>
                                                <option value="2">Amount</option>          
                                                <option value="1" <?= isset($product) ? ($product->type_of_discount == '1'  ? 'selected' : '' ) : '' ?> >Percentage</option>
                                                <option value="2" <?= isset($product) ? ($product->type_of_discount == '2'  ? 'selected' : '' ) : '' ?> >Amount</option>
                                            </Select>
                                        </div> -->
                                    
                                        <!-- <div class="form-group row">
                                            <label class="col-md-3">Discount </label> 
                                            <input type="text" class="form-control col-md-8" name="discount" id="discount" value="<?php if(isset($product)){echo $product->discount;}else{echo '';}?>">
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-md-3">Purchase Tax</label> 
                                            <Select class="form-control col-md-8" id="purchase_tax" name="purchase_tax">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($managetax as $tax) 
                                                    {
                                                        if(isset($product->purchase_tax))
                                                        {
                                                            if($product->purchase_tax == $tax->tax_id)
                                                            {  
                                                ?>
                                                                <option value="<?php echo $tax->tax_id;?>" selected=""><?php echo $tax->tax_name;?></option>
                                                <?php
                                                            }
                                                            else
                                                            {  
                                                ?>
                                                                <option value="<?php echo $tax->tax_id;?>"><?php echo $tax->tax_name;?></option>
                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {   
                                                ?>
                                                            <option value="<?php echo $tax->tax_id;?>"><?php echo  $tax->tax_name; ?></option>
                                                <?php
                                                        }
                                                    } 
                                                ?>  
                                            </Select>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3">Sale Tax</label> 
                                            <Select class="form-control col-md-8" id="sale_tax" name="sale_tax">
                                                <option>Select</option>
                                                <?php
                                                    foreach ($managetax as $tax) 
                                                    {
                                                        if(isset($product->sale_tax))
                                                        {
                                                            if($product->sale_tax == $tax->tax_id)
                                                            {  
                                                ?>
                                                                <option value="<?php echo $tax->tax_id;?>" selected=""><?php echo $tax->tax_name;?></option>
                                                <?php
                                                            }
                                                            else
                                                            {  
                                                ?>
                                                                <option value="<?php echo $tax->tax_id;?>"><?php echo $tax->tax_name;?></option>
                                                <?php
                                                            }
                                                        }
                                                        else
                                                        {   
                                                ?>
                                                            <option value="<?php echo $tax->tax_id;?>"><?php echo  $tax->tax_name; ?></option>
                                                <?php
                                                        }
                                                    } 
                                                ?>  
                                            </Select>
                                        </div>
                                    </div>
                                </div>

                            </div><br>

                            <!-- <div style="border-color: black; border: 1px solid; padding :15px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                            <label class="col-md-3">Product Varient :</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="pdvr1" name="product_varient" value="1" class="custom-control-input"> 
                                                <label class="custom-control-label" for="pdvr1">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="pdvr2" name="product_varient" value="0" class="custom-control-input" checked> 
                                                <label class="custom-control-label" for="pdvr2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br> -->

                            <div class="varientdetail" style="border-color: black; border: 1px solid; padding :15px;">
                                <span id="lblpsdetail">Pricing And Stock Varient Details</span>
                                <br><br>
                                <?php
                                    if(isset($productdetail))
                                    {
                                        foreach ($productdetail as $pd) 
                                        {
                                ?>
                                        <div id="outervd">
                                            <div id="innervd" class="innervd" style="border-color: black; border: 1px solid; padding :15px; margin-top: 10px;">
                                                <div style="text-align: right;" id="btnclose" class="btnclose">
                                                    <a href="#"><i class="fas fa-window-close"></i></a>
                                                </div>

                                                <div class="row" >
                                                    <div class="col-md-6" >
                                                        <div class="form-group row" id="div_vn">
                                                            <label class="col-md-3">Varient Name</label> 
                                                            <input type="text" class="form-control col-md-8" name="varient_name[]" id="varient_name" value="<?php echo $pd->varient_name; ?>" required>
                                                        </div>

                                                       <!--  <div class="form-group row">
                                                            <label class="col-md-3">Purchase Price</label> 
                                                            <input type="text" class="form-control col-md-8" name="purchase_price[]" id="purchase_price" value="<?php echo $pd->purchase_price; ?>">
                                                        </div> -->
                                                    </div>

                                                 <!--     <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-3">Barcode</label> 
                                                            <input type="text" class="form-control col-md-8" name="barcode[]" id="barcode"  value="<?php echo $pd->barcode; ?>">
                                                        </div>

                                                        <+ <div class="form-group row">
                                                            <label class="col-md-3">Customer Price</label> 
                                                            <input type="text" class="form-control col-md-8" name="customer_price[]" id="customer_price" value="<?php echo $pd->customer_price; ?>">
                                                        </div> -->

                                                        <!-- <div class="form-group row">
                                                            <label class="col-md-3">Stock</label> 
                                                            <input type="text" class="form-control col-md-8" name="min_stock[]" id="min_stock" value="<?php echo $pd->min_stock; ?>">
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <div id="outervd">
                                            <div id="innervd" class="innervd" style="border-color: black; border: 1px solid; padding :15px; margin-top: 10px;">
                                                <div style="text-align: right;" id="btnclose" class="btnclose">
                                                    <a href="#"><i class="fas fa-window-close"></i></a>
                                                </div>

                                                <div class="row" >
                                                    <div class="col-md-6" >
                                                        <div class="form-group row" id="div_vn">
                                                            <label class="col-md-3">Varient Name</label> 
                                                            <input type="text" class="form-control col-md-8" name="varient_name[]" id="varient_name" >
                                                        </div>

                                                        <!-- <div class="form-group row">
                                                            <label class="col-md-3">Purchase Price</label> 
                                                            <input type="text" class="form-control col-md-8" name="purchase_price[]" id="purchase_price" >
                                                        </div> -->

                                                    </div>
                                                    <div style="text-align: right;" id="btnadd">
                                    <button type="button" class="btn btn-primary waves-effect waves-light mr-1">Add</button> 
                                </div>

                                                   
                                                        <!-- <div class="form-group row">
                                                            <label class="col-md-3">Customer Price</label> 
                                                            <input type="text" class="form-control col-md-8" name="customer_price[]" id="customer_price" >
                                                        </div> -->

                                                        <!-- <div class="form-group row">
                                                            <label class="col-md-3">Stock</label> 
                                                            <input type="text" class="form-control col-md-8" name="min_stock[]" id="min_stock" value="<?php echo $pd->min_stock; ?>">
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                <?php
                                    }
                                ?>
                               
                            </div><br>
                                
                            <div class="form-group mb-0">
                                <div>
                                    <button type="button" class="btn btn-primary waves-effect waves-light mr-1" onclick="btninsertsave()">Submit</button> 
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