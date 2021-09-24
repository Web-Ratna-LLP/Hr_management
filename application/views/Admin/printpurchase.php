<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="<?php echo base_url();?>assetsadmin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url();?>assetsadmin/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assetsadmin/js/printThis.js"></script>
        <script src="<?php echo base_url();?>assetsadmin/js/jspdf.min.js"></script> 
        <script src="<?php echo base_url();?>assetsadmin/js/html2canvas.js"></script>
        <script src="<?php echo base_url();?>assetsadmin/js/bootstrap.bundle.min.js" type="text/javascript"></script>

        <style>
            .invoice-box {
                /*max-width: 800px;*/
                width: 90%;
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
        </script>
    </head>

<body><br><br>
	<div class="btn" style="margin: 25px 61px;" > 
        <input type="button" name="print" id="print" value="Print" onclick="print('printDiv')">
	    <input type="button" name="exportpdf" id="exportpdf" value="Export" onclick="exportpdf()">
	    <a class="btn btn-info" href="<?php echo base_url()?>index.php/Admin/managepurchase">Back</a>
        <!-- <input type="text" value="<?php echo $purchase->purchase_id; ?>"> -->
	</div>

	<div class="invoice-box printDiv" id="printDiv" style="min-height:942px;">		
        
    <section id="top1" style="float: left;margin: 12px;">
        <h1 style="font-weight: bold;">Siddhivinayak Mobile</h1>
        <h5>Address :- Vadodara</h5>
        <h6> 300018, Gujarat </h6>
           </section>
    <section id="top2" style="float: right;margin: 12px;">
    <h1 style="font-family:auto ;font-weight: bold;"> INVOICE</h1>
    <br>
     <h6>Date:-</h6>       
    </section>
		<div class="borderSolid" style="border: 1px solid;"> 
			<!-- <center><h2>~ Invoice ~</h2><center> -->
            <!-- <center><h1><?php if($shop){ echo $shop->shop_name; }else{ echo "";} ?></h1><center><br>
            <center>
                <h6>
                    <?php if($shop){ echo $shop->shop_address; }else{ echo "";} ?><br>
                    GSTIN / UIN :- <?php if($shop){ echo $shop->shop_gst; }else{ echo "";} ?> | Contact No :- <?php if($shop){ echo $shop->shop_phone; }else{ echo "";} ?>
                </h6>
            </center>
            <p></p> -->
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
		        <tr >
		          <td colspan="8" >
		            <table >
		              <tr >
		                <td colspan="4" class="information col-md-8" >
		                  <table>
		                      <tr>
		                        <td class="bold col-md-10" ><h4 style="font-weight: bold;">BILL TO </h4></td>
		                      </tr>
                              <tr>
                                  <td class="bold col-md-10">Name:-  <?php if($purchase){ echo $purchase->supplier_name; }else{ echo ""; }  ?></td>
                              </tr>
		                      <tr>
                                <td class="bold col-md-10">Address:- <?php echo $purchase->supplier_address; ?><br>Mo Number:- <?php echo $purchase->supplier_mobile; ?></td>
		                      </tr>
		                  </table>
                        </td>
                        <td colspan="4" class="details col-md-4">
                        </td>
		           <!--  <td colspan="4" class="details col-md-4">
		                    <table>
		                        <tr class="details">
		                          <td class="bold col-md-3">Bill No </td> <td class="bold col-md-1">:</td><td class="otDetail col-md-8" id="bill_no"><?php echo $purchase->bill_no; ?></td>
		                        </tr>
		                        <tr class="details">
		                          <td class="bold col-md-3">Bill Date </td> <td class="bold col-md-1">:</td><td class="otDetail col-md-8"><?php echo date("d/m/Y", strtotime($purchase->bill_date)); ?></td>
		                        </tr>			         
		                        <tr class="details">
                                  <td class="bold col-md-3">Due Date </td> <td class="bold col-md-1">:</td><td class="otDetail col-md-8"><?php echo date("d/m/Y", strtotime($purchase->due_date)); ?></td>
                                </tr>
		                    </table>
		                </td> -->
		              </tr>
		            </table>
		          </td>
		        </tr>
				
		        <tr>
		          <td colspan="1" >
		            <table style="border-bottom: 1px solid; ">
		                <tr class="heading">
		                    <td><b>Sr</b></td>
                            <td><b>Product</b></td>
                            <td><b>Serial</b></td>
		                    <td><b>Hsn</b></td>
		                    <td><b>Qty</b></td>
                            <td><b>Purchase Price</b></td>
                            <td><b>Taxable</b></td>
                            <td><b>Tax(%)</b></td>
                            <td><b>Tax Amount</b></td>
                            <td><b>Total </b></td>
		                </tr>
                        <?php 

                            $cnt = 1;
                            $totSub = 0;
                            $totQty = 0;
                            $Tax = 0;
                            $totTax = 0;
                            $totAmt = 0;
                            $subtotal = 0;
                            $dis_amt = 0;
                            $subvalue = 0;

                            foreach ($purchasedetail as $sd) 
                            {
                                $subvalue = $sd->qty * $sd->purchase_price;
                                /*if($sd->discount >0) style="border-bottom: 1px solid;"
                                {
                                    $dis_amt = ( $subvalue * $sd->discount)/100;
                                    $subtotal = $subvalue - $dis_amt; 
                                }
                                else
                                {
                                    $subtotal = $sd->qty * $sd->price;
                                }*/
                        ?>
    	                    <tr class="item">
                                <td><?php echo $cnt; ?></td>
    	                        <td><?php echo $sd->product_name.''.$sd->varient_name ; ?></td>
                                <td><div style="overflow:hidden; width:120px; word-wrap:break-word;"><?php echo $sd->serial_no; ?></td>
    	                        <td><?php echo $sd->hsncode; ?></td>
    	                        <td><?php echo $sd->qty; $totQty += $sd->qty; ?></td>
    	                        <td><?php echo $sd->purchase_price;?></td>
                                <td><?php echo $subvalue; $totSub += $subvalue; ?></td>
                                <td><?php echo $sd->tax_id; $Tax = $sd->tax_id;?></td>
                                <td><?php echo $sd->tax_amt; $totTax += $sd->tax_amt; ?></td>
                                <td><?php echo $sd->total; $totAmt += $sd->total; ?></td>
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
                        <?php 
                                $cnt++; 
                            }
                        ?>
                        <tr></tr>
                        <tr></tr><br><br>
                        <tr class="item last">
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td style="text-align: right;padding-top: 5px;"><b>Total :</b></td>
                            <td><b><?php echo $totQty; ?></b></td>
                            
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
				          <td colspan="7"><script type="text/javascript">document.write( number2text('<?php echo $purchase->total_amt; ?>'));</script> </td>
				        </tr>
				      </table> 
					</td>
				</tr>
			  	<tr>
				    <td colspan="8">
				    	<table>
				    		<tr>
							  <!--  <td colspan="4" class="col-md-8">
							      <table>
							        <tr class="terms">
							            <td class="bold" style="width: 150px;" >Invoice Terms :</td> <td rowspan="4" class="otDetail"><?php echo ""; ?></td>
							        </tr>
							      </table>
							    </td> -->
							    <td colspan="2" class="col-md-4">
							      
                                        <tr class="total">
                                          <td class="bold">CGST : <?php echo $Tax/2; ?>%</td><td><?php echo $totTax/2; ?></td>
                                        <tr class="total">
                                          <td class="bold">SGST : <?php echo $Tax/2; ?>%</td><td><?php echo $totTax/2; ?></td>
								        <tr class="total">
								          <td class="bold">Round Off :</td><td><?php echo $purchase->round_off;?></td>
								        <tr class="total">
								          <td class="bold">Net Amount :</td><td><?php echo $purchase->total_amt;?></td>
							      
							    </td>
							</tr>
						</table>
				    </td>
			  	</tr>
			</table>
            <center><h6>Computer Generated Bill</h6></center>
		</div>
    </div>
</body>

</html>
<script type="text/javascript">

            $(document).ready(function()
            {
                $("#print").click(function()
                {
                    $(".printDiv").printThis();
                });
                //window.close();
            });


            /*function print() {
               var fil=document.getElementById("QuoteString").innerHTML
                const filename  = fil+'.pdf';

                html2canvas(document.querySelector('#printDiv')).then(canvas => {
                  let pdf = new jsPDF('p', 'mm', 'a4');
                  pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                  pdf.save(filename);
                });
            }*/



            /*function print(printDiv) 
            {

                var printContents = document.getElementById(printDiv).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }*/




            // Variant
            // This one lets you improve the PDF sharpness by scaling up the HTML node tree to render as an image before getting pasted on the PDF.


            function exportpdf(quality = 1.5) 
            {
                var fil = document.getElementById("bill_no").innerHTML
                const filename  = fil+'.pdf';

                html2canvas(document.querySelector('#printDiv'), 
                            {scale: quality}
                         ).then(canvas => {
                  let pdf = new jsPDF('p', 'mm', 'a4');
                  pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
                  pdf.save(filename);
                });
            }



            
            function MailImage()
            {
                var img;
                var doc;
                var pdf="";
                var fil=document.getElementById("bill_no").innerHTML;
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