<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="<?php echo base_url();?>assetsadmin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url();?>assetsadmin/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assetsadmin/js/jspdf.min.js"></script> 
        <script src="<?php echo base_url();?>assetsadmin/js/html2canvas.js"></script>
        <script src="<?php echo base_url();?>assetsadmin/js/bootstrap.bundle.min.js" type="text/javascript"></script>

        <style>
            .invoice-box {
                /*max-width: 800px;*/
                width: 70%;
                margin: auto;
                padding: 20px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 15px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .borderSolid{
              border: 1px solid #eee;
              box-shadow: 0 0 10px rgba(0, 0, 0, .15);
              padding: 10px;
            }
            
            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }
            
            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }
            
            .invoice-box table tr td:nth-child(2) {
                text-align: left;
                line-height: 10px;
            }
            
            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }
            
            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }
            
            .invoice-box table tr.heading td {
                border-bottom: 1px solid #ddd;
                font-weight: bold;
                line-height: 10px;
            }
            
            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }
            
            .invoice-box table tr.item td{
                border-bottom: 1px solid #eee;
            }
            
            .invoice-box table tr.item.last td {
                border-bottom: none;
            }
            
            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }
            
            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
                
                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
            
            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }
            
            .rtl table {
                text-align: right;
            }
            
            .rtl table tr td:nth-child(2) {
                text-align: left;
            }
            
            .bold{
              font-weight: bold;
              text-align: left;
            }   
            
            .otDetail{
              text-align: left;
            }  
            
            .terms{
              padding-bottom: 20px;
            }

            table tr.terms td:nth-child(2) {
                border-right: 2px solid #b3b3b3;/*#eee;*/
                margin-top: 10px;
                line-height: 20px;
                height: 160px;
            }

            table tr.total td{
              padding-bottom: 20px;
              line-height: 20px;
            }

            table tr.AmtWords {
              background: #c3c3c3; /*#eee;*/
            }

            table tr.AmtWords td:nth-child(2) {
                margin-top: 10px;
                line-height: 20px;
            }

            table tr.AmtWords td{
              padding-bottom: 20px;
              line-height: 20px;
            }
        </style>

        <script type="text/javascript">
            /*$(document).ready(function()
            {
                $("#print").click();
            });*/

            function number2text(value) {
                var fraction = Math.round(frac(value)*100);
                var f_text  = "";

                if(fraction > 0) {
                    f_text = "AND "+convert_number(fraction)+" PAISE";
                }

                return convert_number(value)+" RUPEE "+f_text+" ONLY";
            }

            function frac(f) {
                return f % 1;
            }

            function convert_number(number)
            {
                if ((number < 0) || (number > 999999999)) 
                { 
                    return "NUMBER OUT OF RANGE!";
                }
                var Gn = Math.floor(number / 10000000);  /* Crore */ 
                number -= Gn * 10000000; 
                var kn = Math.floor(number / 100000);     /* lakhs */ 
                number -= kn * 100000; 
                var Hn = Math.floor(number / 1000);      /* thousand */ 
                number -= Hn * 1000; 
                var Dn = Math.floor(number / 100);       /* Tens (deca) */ 
                number = number % 100;               /* Ones */ 
                var tn= Math.floor(number / 10); 
                var one=Math.floor(number % 10); 
                var res = ""; 

                if (Gn>0) 
                { 
                    res += (convert_number(Gn) + " CRORE"); 
                } 
                if (kn>0) 
                { 
                        res += (((res=="") ? "" : " ") + 
                        convert_number(kn) + " LAKH"); 
                } 
                if (Hn>0) 
                { 
                    res += (((res=="") ? "" : " ") +
                        convert_number(Hn) + " THOUSAND"); 
                } 

                if (Dn) 
                { 
                    res += (((res=="") ? "" : " ") + 
                        convert_number(Dn) + " HUNDRED"); 
                } 


                var ones = Array("", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX","SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN","FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN","NINETEEN"); 
                var tens = Array("", "", "TWENTY", "THIRTY", "FOURTY", "FIFTY", "SIXTY","SEVENTY", "EIGHTY", "NINETY"); 

                if (tn>0 || one>0) 
                { 
                    if (!(res=="")) 
                    { 
                        res += " AND "; 
                    } 
                    if (tn < 2) 
                    { 
                        res += ones[tn * 10 + one]; 
                    } 
                    else 
                    { 
                        res += tens[tn];
                        if (one>0) 
                        { 
                            res += ("-" + ones[one]); 
                        } 
                    } 
                }

                if (res=="")
                { 
                    res = "zero"; 
                } 
                return res;
            }

            /*function print() {
               var fil=document.getElementById("QuoteString").innerHTML
                const filename  = fil+'.pdf';

                html2canvas(document.querySelector('#printDiv')).then(canvas => {
                  let pdf = new jsPDF('p', 'mm', 'a4');
                  pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                  pdf.save(filename);
                });
            }*/

            // Variant
            // This one lets you improve the PDF sharpness by scaling up the HTML node tree to render as an image before getting pasted on the PDF.
            function print(quality = 1.5) 
            {
                var fil = document.getElementById("collectionno").innerHTML
                const filename  = fil+'.pdf';

                html2canvas(document.querySelector('#printDiv'), 
                            {scale: quality}
                         ).then(canvas => {
                  let pdf = new jsPDF('p', 'mm', 'a4');
                  pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                  pdf.save(filename);
                });
                //window.location.replace("");
            }
            
            function MailImage()
            {
                var img;
                var doc;
                var pdf="";
                var fil=document.getElementById("collectionno").innerHTML;
                const filename  = fil+'.pdf';
              
                html2canvas(document.querySelector('#printDiv'), 
                {scale: 1}
                         ).then(canvas => {
                       // img=canvas.toDataURL().replace(/^data[:]image\/(png|jpg|jpeg)[;]base64,/i, "");
                        doc = new jsPDF('p', 'mm', 'a4');
                        doc.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                        pdf=doc.output('datauristring'); //canvas.toDataURL('image/png'); 
                        var EmailId=document.getElementById('email').value;
                        var fd = new FormData();     // To carry on your data  
                        fd.append('data',pdf);
                        fd.append('email_id',EmailId)
                        
                        $.ajax({
                           type: "POST",
                           url: "<?php echo base_url(); ?>index.php/Admin/SendMail",
                           dataType: 'text',
                           processData: false,
                           contentType: false,
                           data: fd
                        }).done(function(o) {
                          console.log(["Response:" , o]); 
                          alert(o);
                        });
                });   
            }
        </script>
    </head>

<body><br><br>
    <div class="invoice-box row" > 
       <input type="button" name="print" id="print" value="Export" onclick="print()">
       <!-- <a class="btn btn-info" href="<?php echo base_url()?>index.php/Admin/managesale/<?php echo $sale->sale_id; ?>">Back</a> -->
    </div>
<?php 
    if(isset($saleinvoice))
    {   
        $cnt = 1;
        foreach ($saleinvoice as $inv) 
        {
?>
    <div class="invoice-box" id="printDiv" style="min-height:942px;">       
        
        <div class="borderSolid" style="border: 1px solid;"> 
            <!-- <center><h2>~ Invoice ~</h2><center> -->
            <center><h1><?php  echo $inv->shop_name; ?></h1><center><br>
            <center>
                <h6>
                    <?php echo $inv->shop_address; ?><br>
                    GSTIN / UIN :- <?php echo $inv->shop_gst; ?> | Contact No :- <?php echo $inv->shop_phone; ?>
                </h6>
            </center>
            <p></p>
            <table style="border: 1px solid;">
                <!-- <tr>
                  <td colspan="8" style="border-bottom: 1px solid #eee;">
                    <table >
                        <tr>
                            <td class="col-md-1"> <img src="<?php echo base_url();?>assets/images/logo.jpg" style="height: :40px; max-width:120px;"> </td>
                            <td class="col-md-7" style="border-right: 1px solid #ddd;">
                                <h2><?php if($shop){ echo $shop->shop_name; }else{ echo "";} ?></h2>
                                <p style="font-size: 12px; ">Office :- <?php if($shop){ echo $shop->shop_address; }else{ echo "";} ?></p>
                            </td>
                            <td class="col-md-4">
                                <table style="font-size: 12px; border-bottom: none solid #ddd; font-weight: none; line-height: 10px; margin-top: 10px;">
                                    <tr>
                                      <td class="bold">Gst-No</td><td>:</td><td><?php if($shop){ echo $shop->shop_gst; }else{ echo "";} ?></td>
                                    </tr>
                                    <tr>
                                      <td class="bold">Phone No</td><td>:</td><td><?php if($shop){ echo $shop->shop_phone; }else{ echo "";} ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table> 
                </tr> -->
                <tr style="border-bottom: 1px solid;">
                  <td colspan="8" >
                    <table >
                      <tr >
                        <td colspan="4" class="information col-md-8" style="border-right: 1px solid;">
                          <table>
                              <tr>
                                <td class="bold col-md-10">Billing Address </td>
                              </tr>
                              <tr>
                                  <td class="bold col-md-10"><?php echo $inv->customer_name; ?></td>
                              </tr>
                              <tr>
                                <td class="col-md-10"><?php echo $inv->customer_address; ?><br><?php echo $inv->customer_mobile; ?></td>
                              </tr>
                          </table>
                        </td>
                        <td colspan="4" class="details col-md-4">
                            <table>
                                <tr class="details">
                                  <td class="bold col-md-6">Invoice No </td> <td>:</td><td class="otDetail col-md-6" id="collectionno"><?php echo $inv->invoice_string; ?></td>
                                </tr>
                                <tr class="details">
                                  <td class="bold col-md-6">Invoice Date </td> <td>:</td><td class="otDetail col-md-6"><?php echo date("d/m/Y", strtotime($inv->invoice_date)); ?></td>
                                </tr>                    
                                <tr>
                                  <td ></td><td></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                
                <tr>
                  <td colspan="8" >
                    <table style="border: 1px ">
                        <tr class="heading">
                            <td><b>Sr</b></td>
                            <td><b>Description </b></td>
                            <td><b>Hsn</b></td>
                            <td><b>Qty</b></td>
                            <td><b>Rate</b></td>
                            <td><b>Dis</b></td>
                            <td><b>Taxable</b></td>
                            <td><b>Tax(%)</b></td>
                            <td><b>Tax Amount</b></td>
                            <td><b>Total </b></td>
                        </tr>
                        <!-- <?php 
                            $totSub = 0;
                            $totQty = 0;
                            $totTax = 0;
                            $totAmt = 0;
                            $subtotal = 0;
                            $dis_amt = 0;
                            $subvalue = 0;

                            foreach ($saledetail as $sd) 
                            {
                                $subvalue = $sd->qty * $sd->price;
                                if($sd->discount >0)
                                {
                                    $dis_amt = ( $subvalue * $sd->discount)/100;
                                    $subtotal = $subvalue - $dis_amt; 
                                }
                                else
                                {
                                    $subtotal = ($sd->qty * $sd->price)/100;
                                }
                        ?> -->
                            <tr class="item">
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $inv->product_name.''.$inv->varient_name ; ?></td>
                                <td><?php echo $inv->hsncode; ?></td>
                                <td><?php echo $inv->qty; $totQty += $inv->qty; ?></td>
                                <td><?php echo $inv->price;?></td>
                                <td><?php echo $inv->discount;?>(%)</td>
                                <td><?php echo $subvalue; $totSub += $subvalue; ?></td>
                                <td><?php echo $inv->tax_id;?></td>
                                <td><?php echo $inv->tax_amt; $totTax += $inv->tax_amt; ?></td>
                                <td><?php echo $inv->total; $totAmt += $inv->total; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr><tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <!-- <?php 
                                $cnt++; 
                           }
                        ?> --> 
                        <tr></tr>
                        <tr></tr><br><br>
                        <tr class="item last">
                            <td></td>
                            <td></td>
                            <td style="text-align: right;padding-top: 5px;"><b>Total :</b></td>
                            <td><b><?php echo $totQty; ?></b></td>
                            <td></td>
                            <td style="text-align: right;padding-top: 5px;"><b></b></td>
                            <td><b><?php echo $totSub; ?></b></td>
                            <td></td>
                            <td><?php echo $totTax; ?></td>
                            <td><?php echo $totAmt; ?></td>
                        </tr>
                    </table>
                  </td>
                </tr>
                <tr><td colspan="8"></td></tr>
                <tr>
                    <td colspan="8">
                      <table>
                        <tr class="AmtWords">
                          <td class="bold" >Total Amount In Words :</td>
                          <td colspan="7"><script type="text/javascript">document.write( number2text('<?php echo $inv->inv_totalamt; ?>'));</script> </td>
                        </tr>
                      </table> 
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <table>
                            <tr>
                                <td colspan="4" class="col-md-8">
                                  <table>
                                    <tr class="terms">
                                        <td class="bold" style="width: 150px;" >Invoice Terms :</td> <td rowspan="4" class="otDetail"><?php echo ""; ?></td>
                                    </tr>
                                  </table>
                                </td>
                                <td colspan="4" class="col-md-4">
                                    <table>   
                                        <tr class="total">
                                          <td class="bold">Round Off:</td><td><?php echo $inv->inv_roundoff;?></td>
                                        </tr>
                                        <tr class="total">
                                          <td class="bold">Net Amount :</td><td><?php echo $inv->inv_totalamt;?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <center><h6>Computer Generated Bill</h6></center>
        </div>
    </div>
<?php
        }
    }
?>
</body>

</html>
