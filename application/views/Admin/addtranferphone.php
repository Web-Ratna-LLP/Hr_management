<style type="text/css">
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }

    .modal-content {
        width: 800px;
    }

    /*iphone */
    @media only screen and (max-width: 800px) {
        .modal-content {
            width: 350px;
        }
    }

    /*normal mobile*/
    @media only screen and (max-width: 600px) {
        .modal-content {
            width: 330px;
        }
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="page-title">New</h4>
                </div>
                <div class="col-sm-6">
                    <div class="float-right d-none d-md-block">
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <?php echo form_open('Admin/insertphone'); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-4 row">
                                <span class="col-md-1"></span>
                                <label class="col-md-3">Subtotal</label>
                                <input type="text" class="form-control col-md-8" name="inv_subtotal" id="inv_subtotal" value="0.00" readonly="">
                            </div>
                            <div class="col-md-4 row">
                                <span class="col-md-1"></span>
                                <label class="col-md-3">Round Off</label>
                                <input type="text" class="form-control col-md-8" name="inv_roundoff" id="inv_roundoff" value="0.00" readonly="">
                            </div>
                            <div class="col-md-4 row">
                                <span class="col-md-1"></span>
                                <label class="col-md-3">Total</label>
                                <input type="text" class="form-control col-md-8" name="inv_totalamt" id="inv_totalamt" value="0.00" readonly="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> New Stock Transfer</h4>
                        <hr><br>
                        <p class="text-muted m-b-30"></p>
                        <input type="hidden" class="form-control" name="tarnsfer_id" id="tarnsfer_id">
                        <div>
                            <div class="row">
                                <!-- Customer add modal -->


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">From Shop</label>
                                        <!-- <input type="hidden" class="form-control col-md-8" name="customer_name" id="customer_name" required > -->
                                        <Select class="form-control col-md-7" id="shop_id" name="shop_id">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($manageshop as $shop) {
                                            ?>
                                                <option value="<?php echo $shop->shop_id; ?>"><?php echo  $shop->shop_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </Select>&nbsp;
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3">To Shop</label>
                                        <Select class="form-control col-md-7" id="actul_shop" name="actul_shop">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($manageshop as $shop) {
                                            ?>
                                                <option value="<?php echo $shop->shop_id; ?>"><?php echo  $shop->shop_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                    </div>

                                    <div class="form-group row">
                                                <label class="col-md-3"></label> 
                                                <input type="hidden">
                                            </div>
                                            <div class="form-group row">
                                <label class="col-md-3">Transfer Date</label>
                                <input name="transferdate" id="transferdate" class="form-control col-md-8" type="date">
                            </div>

                                </div>

                            </div>
                            
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>



            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"><i class="ion ion-ios-paper"></i> Product Detail</h4>
                        <hr><br>
                        <div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label>Scan</label>
                                        <input type="text" class="form-control" name="imei_no" id="imei_no">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="rowSr" value="0" id="rowSr" class="form-control">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <!-- <div class="main-search-input-item" id="autocomplete-container">
                                                <input type="text" id="searchText" class="typeahead form-control" name="searchText"  placeholder="Search Products, Varient, Barcode" type="search" value="<?php if (isset($_SESSION['SearchText'])) {
                                                                                                                                                                                                                echo $_SESSION['SearchText'];
                                                                                                                                                                                                                unset($_SESSION['SearchText']);
                                                                                                                                                                                                            } ?>" required/>
                                            </div> -->
                                        <Select class="form-control" id="product_detail_id" name="product_detail_id">
                                            <option value="">Select</option>
                                            <?php
                                            foreach ($manageproduct as $product) {
                                            ?>
                                                <option value="<?php echo $product->product_detail_id; ?>"><?php echo $product->product_name; ?>-<?php echo $product->varient_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </Select>
                                        <input type="hidden" id="product_id" name="product_id" value="" class="form-control">
                                        <!-- <input type="hidden" class="form-control" name="pd_name" id="pd_name">
                                            <input type="hidden" class="form-control" name="vn_name" id="vn_name"> -->
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Serial No</label>
                                        <input type="hidden" class="form-control" name="ser_no" id="ser_no">
                                        <Select class="form-control" id="serial" name="serial">
                                        </Select>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group ">
                                        <label>Qty</label>
                                        <input type="text" class="form-control" name="qty" id="qty" value="0" readonly>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" name="price" id="price" value="0">
                                        <input type="hidden" class="form-control" name="org_pp" id="org_pp" value="0">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Discount</label>
                                        <input type="text" class="form-control" name="discount" id="discount" value="0">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Tax (%)</label>
                                        <input type="text" class="form-control" name="tax_id" id="tax_id" value="0" readonly>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Tax Amount</label>
                                        <input type="text" class="form-control" name="tax_amt" id="tax_amt" value="0" readonly>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Total</label>
                                        <input type="hidden" class="form-control" name="oldtotal" id="oldtotal" value="0" readonly>
                                        <input type="text" class="form-control" name="total" id="total" value="0" readonly>
                                    </div>
                                </div>


                            </div>

                            <div class="row">


                                </tbody>
                                <!-- <tfoot>
                                            <tr class="active">
                                                <td colspan="9">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot> -->
                                </table>
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>

            <!-- Serial Number add modal -->


            <div class="col-lg-12">
                <center>
                    <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
                    <button type="reset" class="btn btn-secondary waves-effect">Cancel</button>
                </center>
            </div>
        </div>
        </form>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

<!-- Autocomplete JS -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assetsadmin/autocomplete/bootstrap.css" />
<script src="<?php echo base_url(); ?>assetsadmin/autocomplete/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsadmin/autocomplete/bootstrap3-typeahead.min.js"></script>
 
<script>
    $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get('<?php echo base_url(); ?>index.php/Admin/autocomplete', { query: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
</script> -->

<script src="<?php echo base_url(); ?>assetsadmin/plugins/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        /*$('.select2,#serial').select2().on('change', function(evt, params)
        {
            fetchproduct();
        });*/

        $("#btnsubmit").val('Please wait ...').attr('enable', 'enable');

        $("#product_detail_id").change(function() {
            fetchproduct();
        });

        fetchcustomer();
        fetchcpaymentterm();
        fetchproduct();

        $('#country_id').change(function() {
            get_state();
        });

        $('#state_id').change(function() {
            get_city();
        });
        $("#customer_id").change(function() {
            var customer_id = $("#customer_id").val();

            $.ajax({
                url: "<?php echo base_url() ?>index.php/Admin/fetchcustomerdetail",
                type: "post",
                data: {
                    customer_id: customer_id
                },
                success: function(data) {
                    var customer = data.split("^");

                    $("#cust_mobile").val(customer[2]);
                    $("#cust_address").val(customer[3]);
                }
            });
        });

        $("#discount").change(function() {
            pricefind();
        });

        var rwcnt = 1;
        generatedate();

        $("#btnadd").click(function() {
            var rowSr = $('#rowSr').val();
            var product_id = $("#product_id").val();
            var product_detail_id = $("#product_detail_id").val();
            var product_name = $("#product_detail_id option:selected").html();
            //var product_name = $("#pd_name").val();
            //var varient_name = $('#vn_name').val();
            //var serial_no = $("#ser_no").val();
            var serial_no = $("#serial").val();
            var shop_id = $("#shop_id").val();
            var actul_shop = $("#actul_shop").val();
            var transferdate = $("#transferdate").val();
            var qty = $("#qty").val();
            var org_pp = $("#org_pp").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var tax_id = $("#tax_id").val();
            var tax_amt = $("#tax_amt").val();
            var total = $("#total").val();

            if (parseFloat(qty) > 0) {
                $("#ErrSucc").html("");
                var SrNo = rwcnt;
                if (rowSr != "0") {
                    SrNo = rowSr;
                }
                var str = "<td>" + SrNo + "</td>" +
                    "<td><input type='hidden' name='product_id[]' class='product_id' value=" + product_id + "><label class='text-left'>" + product_name + "</label></td>" +
                    "<td><input type='hidden' name='product_detail_id[]' class='product_detail_id form-control' value=" + product_detail_id + " readonly></td>" +
                    "<td><input type='hidden' name='serial_no[]' class='serial_no form-control' value=" + serial_no + " readonly><label class='text-left'>" + serial_no + "</label></td>" +
                    "<td><input type='hidden' name='shop_id[]' class='shop_id form-control' value=" + shop_id + " readonly>" +
                    "<td><input type='hidden' name='actul_shop[]' class='actul_shop form-control' value=" + actul_shop + " readonly>" +
                    "<td><input type='hidden' name='transferdate[]' class='transferdate form-control' value=" + transferdate + " readonly>" +
                    "<td><input type='text' name='qty[]' class='qty form-control' value=" + qty + " readonly></td>" +
                    "<td><input type='hidden' name='org_pp[]' class='org_pp form-control' value=" + org_pp + " readonly></td>" +
                    "<td><input type='text' name='price[]' class='price form-control' value=" + price + " readonly></td>" +
                    "<td><input type='text' name='discount[]' class='discount form-control' value=" + discount + " readonly></td>" +
                    "<td><input type='text' name='tax_id[]' class='tax_id form-control' value=" + tax_id + " readonly></td>" +
                    "<td><input type='text' name='tax_amt[]' class='tax_amt form-control' value=" + tax_amt + " readonly></td>" +
                    "<td><input type='text' name='total[]' class='total form-control' value=" + total + " readonly></td>" +
                    "<td class='editOn'><i class='fa fa-edit'></i></td><td class='deleteOn'><i class='fa fa-trash'></i></td>";

                if (rowSr <= 0) {
                    $('#tbdy').append("<tr>" + str + "</tr>");
                    rwcnt++;
                    clearVal();
                    FinalSum();
                } else {
                    var tr = null;
                    $('#tbdy').find('tr').each(function(key, val) {
                        if ($(this).find("td:first").text() == rowSr) {
                            tr = $(this);
                        }
                    });
                    tr.html(str);
                    clearVal();
                    FinalSum();
                }
            } else {
                $("#ErrSucc").html("Please Select Qty");
            }
        });

        $("#saleEntry").on("click", ".editOn", function() {
            var tr = $(this).closest('tr');
            var lines = $('td', tr).map(function(index, td) {
                return $(td);
            });

            //lines arrays of td
            $('#rowSr').val(lines[0].text());
            $("#product_detail_id").val(lines[1].find('.product_id').val());
            //$('#product_detail_id').select2().trigger('change');
            $('#product_id').val(lines[1].find('.product_id').val());
            $('#product_name').val(lines[1].find('.product_name').val());
            //$('#product_detail_id').val(lines[2].find('.product_detail_id').val());
            $('#serial_no').val(lines[3].find('.serial_no').val());
            $('#qty').val(lines[5].find('.qty').val());
            $('#org_pp').val(lines[6].find('.org_pp').val());
            $('#price').val(lines[7].find('.price').val());
            $('#discount').val(lines[8].find('.discount').val());
            $('#tax_id').val(lines[9].find('.tax_id').val());
            $('#tax_amt').val(lines[10].find('.tax_amt').val());
            $('#total').val(lines[11].find('.total').val());
        });

        $("#saleEntry").on("click", ".deleteOn", function() {
            var tr = $(this).closest('tr');
            tr.remove();
            Searilize();
            FinalSum();
        });

        //insert 
        $("#btnsubmit").click(function(e)
            //$("#btnsubmit").one("click", function(e)
            {
                var result1 = [];
                var result2 = [];

                var sale_id = $("#sale_id").val();
                var customer_id = $("#customer_id").val();
                var invoice_no = $("#invoice_no").val();
                var invoice_string = $("#invoice_string").val();
                var payment_term_id = $("#pay_term_id").val();
                var b_date = $("#invoice_date").val();

                var d = new Date(b_date.split("-").reverse().join("/"));
                var dd = d.getDate();
                var mm = d.getMonth() + 1;
                var yy = d.getFullYear();
                var invoice_date = yy + "-" + mm + "-" + dd;

                var inv_subtotal = $("#inv_subtotal").val();
                var inv_roundoff = $("#inv_roundoff").val();
                var inv_totalamt = $("#inv_totalamt").val();

                var obj1 = {};
                obj1['sale_id'] = sale_id;
                obj1['customer_id'] = customer_id;
                obj1['invoice_no'] = invoice_no;
                obj1['invoice_string'] = invoice_string;
                obj1['payment_term_id'] = payment_term_id;
                obj1['invoice_date'] = invoice_date;
                obj1['inv_subtotal'] = inv_subtotal;
                obj1['inv_roundoff'] = inv_roundoff;
                obj1['inv_totalamt'] = inv_totalamt;

                result1.push(obj1);

                $('#tbdy').find('tr').each(function(key, val) {
                    var lines = $('td', $(this)).map(function(index, td) {
                        return $(td);
                    });

                    var product_id = lines[1].find('.product_id').val();
                    //var product_name = lines[1].find('.product_name').val();
                    var product_detail_id = lines[2].find('.product_detail_id').val();
                    var serial_no = lines[3].find('.serial_no').val();
                    var shop_id = lines[4].find('.shop_id').val();
                    var qty = lines[5].find('.qty').val();
                    var org_pp = lines[6].find('.org_pp').val();
                    var price = lines[7].find('.price').val();
                    var discount = lines[8].find('.discount').val();
                    var tax_id = lines[9].find('.tax_id').val();
                    var tax_amt = lines[10].find('.tax_amt').val();
                    var total = lines[11].find('.total').val();

                    var obj2 = {};
                    obj2['product_id'] = product_id;
                    //obj2['product_name'] = product_name;
                    obj2['product_detail_id'] = product_detail_id;
                    obj2['serial_no'] = serial_no;
                    obj2['shop_id'] = shop_id;
                    obj2['qty'] = qty;
                    obj2['org_pp'] = org_pp;
                    obj2['price'] = price;
                    obj2['discount'] = discount;
                    obj2['tax_id'] = tax_id;
                    obj2['tax_amt'] = tax_amt;
                    obj2['total'] = total;

                    result2.push(obj2);
                });

                var objectresult = {
                    result1,
                    result2
                };
                if (customer_id == '' || customer_id == null) {
                    $("#ErrSucc").html("Please Select Customer");
                } else {
                    if (payment_term_id == '' || payment_term_id == null) {
                        $("#ErrSucc").html("Please Select Payment Term");
                    } else {
                        $("#ErrSucc").html("");
                        $("#btnsubmit").val('Please wait ...').attr('disabled', 'disabled');

                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/Admin/insertphone",
                            type: "POST",
                            data: JSON.stringify(objectresult),
                            datatype: "JSON",
                            success: function(Jsonstr) {
                                //alert(Jsonstr);
                                var str = Jsonstr.split(',');
                                $('#shopid').val(str[0]);
                                $('#saleid').val(str[1]);
                                var data = str[2];

                                if (data == 1) {
                                    printsale();
                                } else if (Jsonstr == 2 || Jsonstr == 4) {
                                    // window.location.reload("true");
                                    window.location.replace("<?php echo base_url() ?>index.php/Admin/transferphone");

                                }
                            }
                        });
                    }
                }
                e.preventDefault();
            });

        $("#customer_submit").click(function(e) {
            var customer_id = $("#customer_id").val();
            var customer_name = $("#customer_name").val();
            var customer_mobile = $("#customer_mobile").val();
            var customer_address = $("#customer_address").val();
            var customer_email = $("#customer_email").val();

            $.ajax({
                url: "<?php echo base_url() ?>index.php/Admin/CustomerInsert",
                type: "Post",
                data: {
                    customer_id: customer_id,
                    customer_name: customer_name,
                    customer_mobile: customer_mobile,
                    customer_address: customer_address,
                    customer_email: customer_email
                },
                success: function(data) {
                    fetchcustomer();
                    $("#myModalParty").modal("hide");
                }
            });
        });



        $("#serial").change(function() {
            var serial_no = $("#serial").val();
            var pid = $("#product_detail_id").val();
            serial(pid, serial_no);
        });


        $("#imei_no").on('keyup keydown change', function() {
            var serial_no = $("#imei_no").val();

            serial(null, serial_no);
        });
    });

    function serial(pid = null, serial_no = null) {
        $.ajax({
            url: "<?php echo base_url() ?>index.php/Admin/fetchotherdetail1",
            type: "post",
            data: {
                pid: pid,
                serial_no: serial_no
            },
            success: function(data) {
                if (data != 0) {
                    var other = data.split("^")
                    $("#tax_id").val(other[5]);
                    $("#price").val(other[3]);
                    $("#total").val(other[3]);
                    $("#oldtotal").val(other[3]);
                    $("#qty").val("1");
                    $("#product_id").val(other[4]);
                    $("#product_detail_id").val(other[0]);
                    //$('#product_detail_id').select2().trigger('change');
                    //$("#ser_no").val(other[6]);
                    $("#serial").val(other[6]);
                    $("#shop_id").val(other[7]);
                    $("#invoice_no").val(other[8]);
                    if (other[8] == "") {
                        $("#invoice_string").val("");
                    } else {
                        $("#invoice_string").val(other[9]);
                    }
                    /*$("#pd_name").val(other[10]);
                    $("#vn_name").val(other[11]);*/
                    pricefind();
                    $("#imei_no").val("");
                } else {
                    $("#invoice_string").val("");
                    $("#serial").val("");
                    $("#product_detail_id").val("");
                    $("#tax_id").val("0");
                    $("#price").val("0");
                    $("#total").val("0");
                    $("#oldtotal").val("0");
                    $("#tax_amt").val("0");
                    $("#qty").val("0");
                }
            }
        });
    }

    function fetchproduct() {
        var pid = $("#product_detail_id").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/Admin/fetchproduct",
            type: "post",
            data: {
                pid: pid
            },
            success: function(data) {
                var ser_no = data;

                var html = "";
                html += "<option value=''>select</option>";
                //$("#serial").html("");
                //$("#serial").prepend("<option value=''>select</option>").val();

                /*$.each(varient, function (index, value) 
                {
                    var ser_no = value;*/
                if (ser_no != null && ser_no != '' && ser_no != undefined) {
                    var str = ser_no.split(",");
                    $.each(str, function(index, value) {
                        html += "<option value='" + value + "'>" + value + "</option>";
                        //var listItem = $("<option></option>").val(value).html(value);
                        //$("#serial").append(listItem);
                    });
                }
                //});
                $("#serial").html(html);
            }
        });
    }



    function btnmodalclose() {
        clearVal();
        $("#myModalSerial").modal("hide");
    }

    function fetchcpaymentterm() {
        $.ajax({
            url: "<?php echo base_url() ?>index.php/Admin/fetchcpaymentterm",
            type: "Post",
            success: function(data) {
                var pay_term = data.split("~");
                var html = "";
                html += "<option value=''>select</option>";
                $.each(pay_term, function(index, value) {
                    var pay_term = value;
                    if (pay_term != null && pay_term != '' && pay_term != undefined) {
                        var str = pay_term.split("^");
                        html += "<option value='" + str[0] + "'>" + str[1] + "</option>";
                    }
                });
                $("#pay_term_id").html(html);
            }
        });
    }

    function fetchcustomer() {
        $.ajax({
            url: "<?php echo base_url() ?>index.php/Admin/fetchcustomer",
            type: "Post",
            success: function(data) {
                var customer = data;
                var customer1 = customer.split("~");
                $("#customer_id").html("");
                $("#customer_id").prepend("<option value=''>select</option>").val();
                $.each(customer1, function(index, value) {
                    var str = value.split("^");
                    var listItem = $("<option></option>").val(str[0]).html(str[1]);
                    $("#customer_id").append(listItem);
                });

                $('select option').filter(function() {
                    return ($(this).val().trim() == "" && $(this).text().trim() == "");
                }).remove();
            }
        });
    }

    function pricefind() {
        var tax_id = 0;
        var tax_amt = 0;
        var price = 0;
        var total = 0;
        var org_pp = 0;
        var discount = 0;
        var disamt = 0;
        var disprice = 0;
        var FinalToal = 0;

        total = parseFloat($('#oldtotal').val());
        tax_id = parseFloat($('#tax_id').val());
        discount = parseFloat($('#discount').val());

        if (discount > 0) {
            //disamt = total * discount/100;
            if (tax_id > 0) {
                disprice = total - discount;
                tax_amt = (disprice * tax_id) / (100 + tax_id);
            }
            org_pp = disprice - tax_amt;
        } else {
            discount = 0;
            if (tax_id > 0) {
                tax_amt = ((total * tax_id) / (100 + tax_id));
            }
            disprice = total - discount;
            org_pp = total - tax_amt;
        }

        price = total - ((total * tax_id) / (100 + tax_id));
        // FinalToal = total - disamt;
        FinalToal = disprice;

        $('#org_pp').val(org_pp.toFixed(2));
        $('#price').val(price.toFixed(2));
        $('#total').val(FinalToal.toFixed(2));
        $('#tax_amt').val(tax_amt.toFixed(2));
    }

    function FinalSum() {
        var rdoff = 0;
        var sgst = 0;
        var cgst = 0;
        var sgst_amt = 0;
        var cgst_amt = 0;
        var tax_id = 0;
        var tax_amt = 0;
        var Total = 0;
        var FinalTotal = 0;
        var sub_total = 0;

        $('#tbdy').find('tr').each(function(key, val) {
            var lines = $('td', $(this)).map(function(index, td) {
                return $(td);
            });

            sub_total += (parseFloat(lines[6].find('.org_pp').val()));
            tax_id += (parseFloat(lines[9].find('.tax_id').val()));
            tax_amt += (parseFloat(lines[10].find('.tax_amt').val()));
            Total += (parseFloat(lines[11].find('.total').val()));
        });

        cgst = tax_id / 2;
        sgst = tax_id / 2;
        cgst_amt = tax_amt / 2;
        sgst_amt = tax_amt / 2;
        FinalTotal = Math.round(Total);
        rdoff = FinalTotal - Total;

        $('#inv_subtotal').val(sub_total.toFixed(2));
        $('#inv_subtotal1').val(sub_total.toFixed(2));
        $('#cgst').html(cgst.toFixed(2));
        $('#sgst').html(sgst.toFixed(2));
        $('#cgst_amt').val(cgst_amt.toFixed(2));
        $('#sgst_amt').val(sgst_amt.toFixed(2));
        $('#inv_roundoff').val(rdoff.toFixed(2));
        $('#inv_roundoff1').val(rdoff.toFixed(2));
        $('#inv_totalamt').val(FinalTotal);
        $('#inv_totalamt1').val(FinalTotal);
    }

    function Searilize() {
        var cnt = 1;
        $('#tbdy').find('tr').each(function(key, val) {
            $(this).find("td:first").text(cnt);
            cnt++;
        });
    }

    function clearVal() {
        $('#rowSr').val(0);
        $('#product_id').val("");
        $('#product_detail_id').val("");
        //$('.select2 .select2-container').remove();
        //$('.select2,#serial').select2();
        //$('#product_name').html("");
        $('#product_detail_id').val("");
        $('#serial').val("");
        //$('#shop_id').val("");
        $('#qty').val(0);
        $('#price').val(0);
        $('#discount').val(0);
        $('#tax_id').val(0);
        $('#tax_amt').val(0);
        $('#total').val(0);
    }

    function generatedate() {
        var invoice_date = $("#invoice_date").val();
        if (invoice_date == '') {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            /*$( '#invoice_date' ).datepicker({
                dateFormat: 'dd/mm/yy',
                //changeMonth: true,
                //changeYear: true,
                //yearRange: '2019:'+(new Date).getFullYear()
            });*/
            $('#invoice_date').datepicker('setDate', today);
        }
    }

    /*function fetchvarient()
    {
        var pid = $("#product_detail_id").val();
    }*/

    /*function fetchotherdetail(pid)
    {
        $.ajax({
            url : "<?php echo base_url() ?>index.php/Admin/fetchotherdetail1",
            type : "post",
            data : {pid : pid},
            success : function(data)
            {
                var other = data.split("^");
                //$("#tax_id").val(other[5]);
                //$("#total").val(other[5]);
                $("#product_id").val(other[6]);
            }
        });
    }*/

    /*function fetchserialdetail(pid)
    {
        //var pid = $("#product_detail_id").val();
        var serial_no = $("#serial").val();
        $.ajax({
            url : "<?php echo base_url() ?>index.php/Admin/fetchserialdetail",
            type : "post",
            data : {pid : pid,serial_no:serial_no},
            success : function(data)
            {
                var other = data.split("^");
                var serial = other[1].split(",");

                $("#shop_id").val(other[2]);
                $("#invoice_no").val(other[3]);
                if(other[3] == "")
                {
                    $("#invoice_string").val("");
                }
                else
                {
                    $("#invoice_string").val(other[4]);
                }
            }
        });
    }*/
</script>