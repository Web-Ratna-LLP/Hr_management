<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

	public function __construct()
    {
        parent::__construct();   
    }
    
    public function checkLogin($uname,$pass)
    {
        $this->db->select('*');
        $this->db->from('admin_master');
        $this->db->where('username',$uname);
        $this->db->where('password',$pass);
        $res = $this->db->get();

        if($res->num_rows() != 0)
        {   
            $result = $res->row();
            $username = $result->username;
            $adminid = $result->adminid;

            $_SESSION['username'] = $username;
            $_SESSION['adminid'] = $adminid;
            $_SESSION['usertype'] = "Admin";
            return $result;
        }

        $this->db->select('*');
        $this->db->from('employee_master');
        $this->db->where('employee_username',$uname);
        $this->db->where('employee_password',$pass);
        $res1 = $this->db->get();

        if($res1->num_rows() != 0)
        {   
            $result1 = $res1->row();
            $employee_name = $result1->employee_name;
            $employee_id = $result1->employee_id;
            $shop_id = $result1->shop_id;

            $_SESSION['username'] = $employee_name;
            $_SESSION['employee_id'] = $employee_id;
            $_SESSION['usertype'] = "employee";
            $_SESSION['shop_id'] = $shop_id;
            return $result1;
        }
    }

    public function UpdateAdmin($data,$adminid)
    {
        $this->db->set($data);
        $this->db->where('adminid',$adminid);
        $this->db->update('admin_master',$data);
        return $this->db->affected_rows();
    }

    public function TotalStockAmount()
    {
        $this->db->select("sum(stock*org_pp) as stockprice");
        $this->db->from("purchase_detail_master");   
        $this->db->where('stock !=',0,False);     
        $res = $this->db->get();
        return $res;
    }

    public function TotalQuantity()
    {
        $this->db->select("sum(stock) as stock");
        $this->db->from("purchase_detail_master");
        $res = $this->db->get();
        return $res;
    }
 
    public function TotalSale($todaydate = null, $employee_id = null)
    {
        $this->db->select("*");
        $this->db->from("sale_master a");
        if($todaydate != null && $employee_id != null)
        {
            $this->db->where("invoice_date",$todaydate);
            $this->db->where("a.user_status",$employee_id);
        }
        else if($todaydate != null && $employee_id == null)
        {
            $this->db->where("invoice_date",$todaydate);
        }
        else if($todaydate == null && $employee_id != null)
        {
            $this->db->where("a.user_status",$employee_id);
        }

        $res = $this->db->get();
        return $res;
    }

    public function WeeklySale($todaydate = null, $employee_id = null)
    {
        $this->db->select("sum(a.inv_totalamt) as inv_totalamt");
        $this->db->from("sale_master a");
        if($employee_id != null)
        {
            $this->db->where("a.user_status",$employee_id);
        }
        //$this->db->where("yearweek(a.invoice_date)",yearweek($todaydate));
        //DATE_ADD('a.invoice_date', INTERVAL(1-DAYOFWEEK(a.invoice_date)) DAY),
        //$this->db->where('a.invoice_date BETWEEN "'. DATE_SUB( CURDATE( ) ,INTERVAL -7 DAY). '" and "'. CURDATE( )).'"');
        $res = $this->db->get();
        return $res;
    }

    public function MonthlySale($todaymonth = null, $employee_id = null)
    {
        $this->db->select("sum(a.inv_totalamt) as inv_totalamt");
        $this->db->from("sale_master a");
        if($todaymonth != null && $employee_id != null)
        {
            $this->db->where("month(a.invoice_date)",$todaymonth);
            $this->db->where("a.user_status",$employee_id);
        }
        else if($todaymonth != null && $employee_id == null)
        {
            $this->db->where("month(a.invoice_date)",$todaymonth);
        }
        else if($todaymonth == null && $employee_id != null)
        {
            $this->db->where("a.user_status",$employee_id);
        }

        $res = $this->db->get();
        return $res;
    }

    public function ProductWiseSale($todaydate = null,$employee_id = null)
    {
        $this->db->select("sum(a.qty)as qty,b.invoice_date,c.product_name,d.varient_name");
        $this->db->from("sale_detail_master a");
        $this->db->join("sale_master b","b.sale_id = a.sale_id","inner");
        $this->db->join("product_master c","c.product_id = a.product_id","left");
        $this->db->join("product_detail_master d","d.product_detail_id = a.product_detail_id","left");

        if($todaydate != null && $employee_id != null)
        {
            $this->db->where("invoice_date",$todaydate);
            $this->db->where("user_status",$employee_id);
        }
        else if($todaydate != null && $employee_id == null)
        {
            $this->db->where("invoice_date",$todaydate);
        }
        else if($todaydate == null && $employee_id != null)
        {
            $this->db->where("user_status",$employee_id);
        }
        $this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        return $res;
    }

    public function EmployeeWiseSale($todaydate = null,$employee_id = null)
    {
        $this->db->select("sum(a.qty)as qty,b.invoice_date,b.user_status,e.employee_name");
        $this->db->from("sale_detail_master a");
        $this->db->join("sale_master b","b.sale_id = a.sale_id","inner");
        //$this->db->join("product_master c","c.product_id = a.product_id","left");
        //$this->db->join("product_detail_master d","d.product_detail_id = a.product_detail_id","left");
        $this->db->join("employee_master e","e.employee_id = b.user_status","left");

        if($todaydate != null && $employee_id != null)
        {
            $this->db->where("invoice_date",$todaydate);
            $this->db->where("user_status",$employee_id);
        }
        else if($todaydate != null && $employee_id == null)
        {
            $this->db->where("invoice_date",$todaydate);
        }
        else if($todaydate == null && $employee_id != null)
        {
            $this->db->where("user_status",$employee_id);
        }
        $this->db->group_by('b.user_status');
        $res = $this->db->get();
        return $res;
    }

    public function ProductWiseStock($todaydate = null)
    {
        $this->db->select("sum(a.stock) as stock,a.org_pp,b.varient_name,c.product_name");        
        $this->db->from("purchase_detail_master a");
        $this->db->join("product_detail_master b","b.product_detail_id = a.product_detail_id","left");
        $this->db->join("product_master c","c.product_id = a.product_id","left");

        if($todaydate != null)
        {
            $this->db->where("invoice_date",$todaydate);
        }

        $this->db->group_by('a.product_detail_id');

        $res = $this->db->get();
        return $res;
    }
    public function shopWiseStock($todaydate = null)
    { 
        $this->db->select("sum(e.qty)as qty,a.shop_name,");
        $this->db->from("shop_master a");
        $this->db->join("transfer_master e","e.actul_shop = a.shop_id","left");
        $this->db->group_by('a.shop_id');

        $res = $this->db->get();
        return $res;
    }


   

// ------------------- Manage Customer ----------------------
    public function GetAllCustomer($customer_id = null)
    {
        $this->db->select("a.*,b.employee_name");
        $this->db->from("customer_master a");
        $this->db->join("employee_master b","b.employee_id = a.user_status","left");
        if($customer_id != null)
        {
            $this->db->where('customer_id',$customer_id);   
        }
        $this->db->order_by("customer_id", "DESC");
        $res = $this->db->get();
        return $res;
    }

    public function GetAllCustomer_name($customer_id = null)
    {
        $this->db->select("customer_name");
        $this->db->from("customer_master");
        if($customer_id != null)
        {
            $this->db->where('customer_id',$customer_id);   
        }
        //$this->db->where("customer_status", "2");
        $this->db->order_by("customer_id", "DESC");
        $res=$this->db->get();
        return $res;
    }

    public function GetAllCustomer1($customer_id = null)
    {
        $this->db->select("*");
        $this->db->from("customer_master");
        if($customer_id != null)
        {
            $this->db->where('customer_id',$customer_id);   
        }
        $this->db->where("customer_status", "2");
        $this->db->order_by("customer_id", "DESC");
        $res=$this->db->get();
        return $res;
    }

    public function GetAllCustomerExpense($fromdate = null,$todate=null)
    { 
        $this->db->select("a.customer_name,a.down_payment,a.remain_amount,a.user_status,a.insert_date,c.employee_name,b.emi_pay_amt");
        $this->db->from("customer_master a");
        $this->db->from("emi_pay_master b","b.customer_id=a.customer_id","left");
        $this->db->join("employee_master c","c.employee_id = a.user_status","left");
        

        if($fromdate != null && $todate != null)
        {
            $this->db->where('DATE(a.insert_date) >=',$fromdate);
            $this->db->where('emi_pay_date >=',$fromdate);
            $this->db->where('DATE(a.insert_date) <=',$todate);
            $this->db->where('emi_pay_date <=',$todate);
        }
        elseif($fromdate != null && $todate == null)
        {
            $this->db->where('DATE(a.insert_date) >=',$fromdate);
            $this->db->where('emi_pay_date >=',$fromdate);
        }
        elseif($fromdate == null && $todate != null)
        {
            $this->db->where('DATE(a.insert_date) <=',$todate);
            $this->db->where('emi_pay_date <=',$todate);
        }
        /*else
        {
            $this->db->where('DATE(a.insert_date)',$todaydt);
        }*/
          
        $res = $this->db->get();
        return $res;
    }

    public function GetAllKhatavahiExpense($fromdate = null,$todate=null)
    { 
        $this->db->select("a.khatavahi_name,a.pay_amt,a.remain_amt,a.user_status,a.insert_date,c.employee_name");
        $this->db->from("khatavahi_master a");
        $this->db->join("emi_pay_master b","b.customer_id = a.customer_id","left");
        $this->db->join("employee_master c","c.employee_id = a.user_status","left");

        if($fromdate != null && $todate != null)
        {
            $this->db->where('DATE(a.insert_date) >=',$fromdate);
            $this->db->where('DATE(a.insert_date) <=',$todate);
        }
        elseif($fromdate != null && $todate == null)
        {
            $this->db->where('DATE(a.insert_date) >=',$fromdate);
        }
        elseif($fromdate == null && $todate != null)
        {
            $this->db->where('DATE(a.insert_date) <=',$todate);
        }
        /*else
        {
            $this->db->where('DATE(a.insert_date)',$todaydt);
        }*/
          
        $res = $this->db->get();
        return $res;
    }

    public function InsertCustomer($data)
    {
        $this->db->insert('customer_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateCustomer($data,$customer_id)
    {
        $this->db->set($data);
        $this->db->where('customer_id',$customer_id);
        $this->db->update('customer_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteEmiCustomer($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('emi_pay_master');
        return $this->db->affected_rows();
    }  

    public function DeleteCustomer($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customer_master');
        return $this->db->affected_rows();
    }    

// ------------------- Manage Category ----------------------
    public function GetAllCategory($category_id = null)
    {
        $this->db->select("*");
        $this->db->from("category_master");
        
        if($category_id != null)
        {
            $this->db->where('category_id',$category_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertCategory($data)
    {
        $this->db->insert('category_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateCategory($data,$category_id)
    {
        $this->db->set($data);
        $this->db->where('category_id',$category_id);
        $this->db->update('category_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteCategory($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->delete('category_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage Terms -------------------------
    public function GetAllTerms($terms_id = null)
    {
        $this->db->select("*");
        $this->db->from("terms_master");
        
        if($terms_id != null)
        {
            $this->db->where('terms_id',$terms_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertTerms($data)
    {
        $this->db->insert('terms_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateTerms($data,$terms_id)
    {
        $this->db->set($data);
        $this->db->where('terms_id',$terms_id);
        $this->db->update('terms_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteTerms($terms_id)
    {
        $this->db->where('terms_id', $terms_id);
        $this->db->delete('terms_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage Financial Year ----------------
    public function GetAllFinancialYear($financialyear_id = null)
    {
        $this->db->select("*");
        $this->db->from("financialyear_master");
        
        if($financialyear_id != null)
        {
            $this->db->where('financialyear_id',$financialyear_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertFinancialYear($data)
    {
        $this->db->insert('financialyear_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateFinancialYear($data,$financialyear_id)
    {
        $this->db->set($data);
        $this->db->where('financialyear_id',$financialyear_id);
        $this->db->update('financialyear_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteFinancialYear($financialyear_id)
    {
        $this->db->where('financialyear_id', $financialyear_id);
        $this->db->delete('financialyear_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage Brand -------------------------
    public function GetAllBrand($brand_id = null)
    {
        $this->db->select("*");
        $this->db->from("brand_master");
        
        if($brand_id != null)
        {
            $this->db->where('brand_id',$brand_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertBrand($data)
    {
        $this->db->insert('brand_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateBrand($data,$Brand_id)
    {
        $this->db->set($data);
        $this->db->where('brand_id',$Brand_id);
        $this->db->update('brand_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteBrand($brand_id)
    {
        $this->db->where('brand_id', $brand_id);
        $this->db->delete('brand_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage Tax ---------------------------
    public function GetAllTax($tax_id = null)
    {
        $this->db->select("*");
        $this->db->from("tax_master");
        
        if($tax_id != null)
        {
            $this->db->where('tax_id',$tax_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertTax($data)
    {
        $this->db->insert('tax_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateTax($data,$tax_id)
    {
        $this->db->set($data);
        $this->db->where('tax_id',$tax_id);
        $this->db->update('tax_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteTax($tax_id)
    {
        $this->db->where('tax_id', $tax_id);
        $this->db->delete('tax_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage PaymentTerm ----------------------
    public function GetAllPaymentTerm($payment_term_id = null)
    {
        $this->db->select("*");
        $this->db->from("payment_term_master");
        
        if($payment_term_id != null)
        {
            $this->db->where('payment_term_id',$payment_term_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertPaymentTerm($data)
    {
        $this->db->insert('payment_term_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdatePaymentTerm($data,$payment_term_id)
    {
        $this->db->set($data);
        $this->db->where('payment_term_id',$payment_term_id);
        $this->db->update('payment_term_master',$data);
        return $this->db->affected_rows();
    }

    public function DeletePaymentTerm($payment_term_id)
    {
        $this->db->where('payment_term_id', $payment_term_id);
        $this->db->delete('payment_term_master');
        return $this->db->affected_rows();
    }   

//-------------------- State --- City -----------------------
    public function GetAllCountry($country_id = null)
    {
        $this->db->select("*");
        $this->db->from('country_master');
        if($country_id != null)
        {
            $this->db->where('country_id',$country_id);
        }
        $this->db->order_by("country_name", "ASC");
        $res = $this->db->get();
        return $res;
    }

    public function GetAllStateBycountryid($country_id = null)
    {
        $this->db->select("*");
        $this->db->from('state_master');
        if($country_id != null)
        {
            $this->db->where('country_id',$country_id);
        }
        $this->db->order_by("state_name", "ASC");
        $res = $this->db->get();

        $output = '<option value="">Select State</option>';
        foreach($res->result() as $row)
        {
            $output .= '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
        }
        return $output;
    }

    public function GetAllStateBystateid($state_id = null)
    {
        $this->db->select("*");
        $this->db->from('city_master');
        if($state_id != null)
        {
            $this->db->where('state_id',$state_id);
        }
        $this->db->order_by("city_name", "ASC");
        $res = $this->db->get();
        
        $output = '<option value="">Select City</option>';
        foreach($res->result() as $row)
        {
            $output .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
        }
        return $output;
    }

// ------------------- Manage Supplier ----------------------
    public function GetAllSupplier($supplier_id = null)
    {
        $this->db->select("a.*,b.country_name,c.state_name,d.city_name");
        $this->db->from("supplier_master a");
        $this->db->join("country_master b","b.country_id = a.country_id","left");
        $this->db->join("state_master c","c.state_id = a.state_id","left");
        $this->db->join("city_master d","d.city_id = a.city_id","left");
        
        if($supplier_id != null)
        {
            $this->db->where('supplier_id',$supplier_id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function InsertSupplier($data)
    {
        $this->db->insert('supplier_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateSupplier($data,$supplier_id)
    {
        $this->db->set($data);
        $this->db->where('supplier_id',$supplier_id);
        $this->db->update('supplier_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteSupplier($supplier_id)
    {
        $this->db->where('supplier_id', $supplier_id);
        $this->db->delete('supplier_master');
        return $this->db->affected_rows();
    }   
// ------------------- tarnsfer phone Product -----------------------


    public function Gettransferphone()
    {
        $this->db->select("*");
        $this->db->from("transfer_master ");
        $res=$this->db->get();
        return $res;
   //  print_r($this->db->last_query());
    }
    public function Gettransferphone2($transfer_id)
    {
        $this->db->select("*");
        $this->db->from("transfer_master ");
        $this->db->where('transfer_id',$transfer_id);
        $res=$this->db->get();
        return $res;
   //  print_r($this->db->last_query());
    }

    public function update_phone($data, $transfer_id){

        return $this->db->where('transfer_id',$transfer_id)
       ->update('transfer_master',[
        
        'serial_no'=>$data['serial_no'],
        'shop_id'=>$data['shop_id'],
        'actul_shop'=>$data['actul_shop'],
        'transferdate'=>$data['transferdate'],
        'price'=>$data['price'],
        'total'=>$data['total'],]);
    }

    public function transferphoneinsert($data){

        return $this->db->insert('transfer_master',[
        'product_id'=>$data['product_id'],
        'product_detail_id'=>$data['product_detail_id'],
        'serial_no'=>$data['serial'],
        'shop_id'=>$data['shop_id'],
        'actul_shop'=>$data['actul_shop'],
        'qty' => $data['qty'],
        'transferdate'=>$data['transferdate'],
        'price'=>$data['price'],
        'total'=>$data['total'],
        
        ]);


	
    }

    public function DebitStockPhone($stockData = null)
    {
        $sr_no = $stockData->serial_no;
        $this->db->select('*');
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->from('purchase_detail_master');
        $stk = $this->db->get()->row();

        $ss = "";
        $st = $stk->stock;
        $product_detail_id = $stockData->product_detail_id;

        if($product_detail_id != null)
        {
            $ss = $st - $stockData->qty;
        }
        
        $this->db->set('stock', $ss, FALSE);
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->update('purchase_detail_master'); 
        return $this->db->affected_rows();
    }


// ------------------- Manage Product -----------------------
    public function GetAllProduct($product_id = null)
    {
        $this->db->select("a.*,b.min_stock,b.varient_name,b.barcode,c.category_name,d.brand_name,e.tax_name as ptax,f.tax_name as stax");
        $this->db->from("product_master a");
        $this->db->join("product_detail_master b","b.product_id = a.product_id","left");
        $this->db->join("category_master c","c.category_id = a.category_id","left");
        $this->db->join("brand_master d","d.brand_id = a.brand_id","left");
        $this->db->join("tax_master e","e.tax_id = a.purchase_tax","left");
        $this->db->join("tax_master f","f.tax_id = a.sale_tax","left");
        
        if($product_id != null)
        {
            $this->db->where('a.product_id',$product_id);   
        }
        $this->db->group_by('a.product_id');
        $res = $this->db->get();

        return $res;
    }

    

    public function GetAllProduct1($product_detail_id = null,$serial_no=null)
    {
        $this->db->select("a.*,b.varient_name,c.product_name,c.sale_tax,c.purchase_tax,d.tax_rate,e.shop_id");
        $this->db->from("purchase_detail_master a");
        $this->db->join("product_detail_master b","b.product_detail_id = a.product_detail_id","left");
        $this->db->join("product_master c","c.product_id = b.product_id","left");
        $this->db->join("tax_master d","d.tax_id = c.sale_tax","left");
        $this->db->join("purchase_master e","e.purchase_id = a.purchase_id","left");

        if($product_detail_id != null && $serial_no != null)
        {
            $this->db->where('a.product_detail_id',$product_detail_id); 
            $find = "FIND_IN_SET('".$serial_no."', a.serial_no)";  
            $this->db->where($find);  
        }
        else if($product_detail_id == null && $serial_no != null)
        {
            $find = "FIND_IN_SET('".$serial_no."', a.serial_no)";  
            $this->db->where($find);
        }
        else if($product_detail_id != null && $serial_no == null)
        {
            $this->db->where('a.product_detail_id',$product_detail_id); 
        }
        //$this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        //print_r($this->db->last_query());    

        return $res;
    }

    public function GetAllProduct2($product_detail_id = null)
    {
        $this->db->select("a.*,b.varient_name,c.product_name,c.sale_tax,c.purchase_tax,d.tax_rate");
        $this->db->from("purchase_detail_master a");
        $this->db->join("product_detail_master b","b.product_detail_id = a.product_detail_id","left");
        $this->db->join("product_master c","c.product_id = b.product_id","left");
        $this->db->join("tax_master d","d.tax_id = c.sale_tax","left");

        if($product_detail_id != null)
        {
            $this->db->where('a.product_detail_id',$product_detail_id); 
        }
        
        $this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetAllProduct3($product_detail_id = null)
    {
        $this->db->select(" GROUP_CONCAT(serial_no) as serial_no");
        $this->db->from("purchase_detail_master");

        if($product_detail_id != null)
        {
            $this->db->where('product_detail_id',$product_detail_id); 
        }

        $res = $this->db->get();
        return $res;
    }

    public function GetAllProductDetail($product_id = null)
    {
        $this->db->select("a.*");
        $this->db->from("product_detail_master a");
        //$this->db->join("product_detail_master b","b.product_id = a.product_id","left");
        if($product_id != null)
        {
            $this->db->where('a.product_id',$product_id);   
        }
        //$this->db->group_by('a.product_id');
        $res = $this->db->get();
      //  print_r($this->db->last_query());    
        return $res;
    }

    /*public function GetAllProduct2($product_id = null)
    {
        $this->db->select("a.*,b.*");
        $this->db->from("product_master a");
        $this->db->from("product_detail_master b","b.product_id = a.product_id","right");
        if($product_id != null)
        {
            $this->db->where('a.product_id',$product_id);   
        }
        $this->db->group_by('a.product_id');
        $res = $this->db->get();
        return $res;
    }*/

    public function GetVarient($product_id = null,$product_detail_id = null)
    {
        $this->db->select("a.*,b.*");
        $this->db->from("product_detail_master a");
        $this->db->from("product_master b","b.product_id = a.product_id","left");
        if($product_id != null)
        {
            $this->db->where("a.product_id",$product_id);
        }
        else if($product_detail_id != null)
        {
            $this->db->where("a.product_detail_id",$product_detail_id);
        }
        $this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetVarient1($product_detail_id = null)
    {
        $this->db->select("a.*,b.product_name,b.sale_tax,b.purchase_tax,c.category_digit,d.tax_rate");
        $this->db->from("product_detail_master a");
        $this->db->join("product_master b","b.product_id = a.product_id","left");
        $this->db->join("category_master c","c.category_id = b.category_id","left");
        $this->db->join("tax_master d","d.tax_id = b.purchase_tax","left");
        /*$this->db->join("tax_master e","e.tax_id = b.sale_tax","left");*/
        if($product_detail_id != null)
        {
            $this->db->where("a.product_detail_id",$product_detail_id);
        }
        //$this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetVarient2($product_detail_id = null)
    {
        $this->db->select("a.*,b.product_name,b.sale_tax,b.purchase_tax,c.category_digit,d.tax_rate");
        $this->db->from("product_detail_master a");
        $this->db->join("product_master b","b.product_id = a.product_id","left");
        $this->db->join("category_master c","c.category_id = b.category_id","left");
        $this->db->join("tax_master d","d.tax_id = b.sale_tax","left");
        /*$this->db->join("tax_master e","e.tax_id = b.sale_tax","left");*/
        if($product_detail_id != null)
        {
            $this->db->where("a.product_detail_id",$product_detail_id);
        }
        //$this->db->group_by('a.product_detail_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetPurchaseVarient($product_detail_id = null,$ser_no=null)
    {
        $this->db->select("a.*,b.shop_id");
        $this->db->from("purchase_detail_master a");
        $this->db->join("purchase_master b","b.purchase_id = a.purchase_id","left");
        if($product_detail_id != null && $ser_no !=null)
        {
            $this->db->where("a.product_detail_id",$product_detail_id);
            $find = "FIND_IN_SET('".$ser_no."', a.serial_no)";  
            $this->db->where($find);
        }
        else if($product_detail_id != null && $ser_no ==null )
        {
            $this->db->where("a.product_detail_id",$product_detail_id);
        }
        else if($product_detail_id == null && $ser_no !=null)
        {
            $find = "FIND_IN_SET('".$ser_no."', a.serial_no)";  
            $this->db->where($find);
        }
        $res = $this->db->get();
        return $res;
    }

    public function GetSaleVarient($product_detail_id = null)
    {
        $this->db->select("*");
        $this->db->from("sale_detail_master");
        if($product_detail_id != null)
        {
            $this->db->where("product_detail_id",$product_detail_id);
        }
        $res = $this->db->get();
        return $res;
    }

    public function GetProductId($product_name = null)
    {
        $this->db->select("a.*");
        $this->db->from("product_master a");
                
        if($product_name != null)
        {
            $this->db->where('product_name',$product_name);   
        }
        
        $res = $this->db->get();
        return $res;
    }

    public function InsertProduct($data)
    {
        $this->db->insert('product_master',$data);
        return $this->db->affected_rows();  

       

    }

    public function InsertProductDetail($data)
    {
        $this->db->insert_batch('product_detail_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateProduct($data,$product_id)
    {
        $this->db->set($data);
        $this->db->where('product_id',$product_id);
        $this->db->update('product_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteProduct($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_master');
        return $this->db->affected_rows();
    }   

    public function DeleteProductDetail($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_detail_master');
        return $this->db->affected_rows();
    }



// ------------------- Manage Subadmin ----------------------
    public function GetAllSubadmin($subadmin_id = null,$subadmin_username = null)
    {
        $this->db->select("*");
        $this->db->from("subadmin_master");
        
        if($subadmin_id != null && $subadmin_username == null)
        {
            $this->db->where('subadmin_id',$subadmin_id);   
        }
        else if($subadmin_id == null && $subadmin_username != null)
        {
            $this->db->where('subadmin_username',$subadmin_username);   
        }
        $res=$this->db->get();
        return $res;
    }

    public function InsertSubadmin($data)
    {
        $this->db->insert('subadmin_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateSubadmin($data,$subadmin_id)
    {
        $this->db->set($data);
        $this->db->where('subadmin_id',$subadmin_id);
        $this->db->update('subadmin_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteSubadmin($subadmin_id)
    {
        $this->db->where('subadmin_id', $subadmin_id);
        $this->db->delete('subadmin_master');
        return $this->db->affected_rows();
    }   

// ------------------- Manage Purchase ----------------------
    public function GetAllPurchase($purchase_id = null ,$fromdate = null,$todate = null,$product_id = null,$category_id = null,$brand_id = null)
    {
        /*$this->db->select("a.*,b.purchase_price,b.tax_id,b.total,c.supplier_name,d.product_name,e.varient_name,e.min_stock,f.category_name,g.brand_name");
        $this->db->from("purchase_master a");
        $this->db->join("purchase_detail_master b","b.purchase_id = a.purchase_id","left");
        */
        
        $this->db->select("a.*,b.bill_date,b.bill_no,c.supplier_name,d.product_name,e.varient_name,f.category_name,g.brand_name");
        $this->db->from("purchase_detail_master a");
        $this->db->join("purchase_master b","b.purchase_id = a.purchase_id","left");
        $this->db->join("supplier_master c","c.supplier_id = b.supplier_id","left");
        $this->db->join("product_master d","d.product_id = a.product_id","left");
        $this->db->join("product_detail_master e","e.product_id = a.product_id","left");
        $this->db->join("category_master f","f.category_id = d.category_id","left");
        $this->db->join("brand_master g","g.brand_id = d.brand_id","left");
        if($purchase_id != null)
        {
            $this->db->where('a.purchase_id',$purchase_id);
        }

        // 1
        if($fromdate != null && $todate == null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.bill_date <=',$todate);
        }
        else if($fromdate == null && $todate == null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.product_id',$product_id);
        }
        else if($fromdate == null && $todate == null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate == null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('g.brand_id',$brand_id);
        }

        //2 fromdate and other
        else if($fromdate != null && $todate != null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.product_id',$product_id);
        }
        else if($fromdate != null && $todate == null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate == null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('g.brand_id',$brand_id);
        }

        //2 todate and other
        else if($fromdate == null && $todate != null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.bill_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.bill_date <=',$todate);
            $this->db->where('g.brand_id',$brand_id);
        }

        //2 product_id and other
        else if($fromdate == null && $todate == null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate == null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.product_id',$product_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //2 category_id and other
        else if($fromdate == null && $todate == null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //3 fromdate,todate and other
        else if($fromdate != null && $todate != null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.bill_date >=',$fromdate);
            $this->db->where('a.bill_date <=',$todate);
            $this->db->where('g.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
        }

        //3 fromdate,product_id and other
        else if($fromdate != null && $todate == null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('g.brand_id',$brand_id);
        }

        //3 fromdate,category_id and other
        else if($fromdate != null && $todate == null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //3 todate,product_id and other
        else if($fromdate == null && $todate != null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate != null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //3 todate,category_id and other
        else if($fromdate == null && $todate != null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //3 product_id,category_id and other
        else if($fromdate == null && $todate == null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }        

        //4 
        else if($fromdate != null && $todate != null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate != null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('g.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }
        else if($fromdate == null && $todate != null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        //5 All
        else if($fromdate != null && $todate != null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.bill_date >=',$fromdate);
            $this->db->where('b.bill_date <=',$todate);
            $this->db->where('a.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('g.brand_id',$brand_id);
        }

        $this->db->group_by('a.purchase_detail_id');
        $res = $this->db->get();
        return $res;
    }

   /* public function GetAllPurchase1($purchase_id = null ,$fromdate = null,$todate = null,$product_id = null,$category_id = null,$brand_id = null)
    {
        //$this->db->select("a.*,b.price,b.tax_id,b.total,c.supplier_name,d.product_name,e.varient_name,e.min_stock,f.category_name,g.brand_name");
        $this->db->select("a.*,b.bill_date,b.bill_no,c.supplier_name,d.product_name,e.varient_name,f.category_name,g.brand_name");
        $this->db->from("purchase_detail_master a");
        $this->db->join("purchase_master b","b.purchase_id = a.purchase_id","left");
        $this->db->join("supplier_master c","c.supplier_id = b.supplier_id","left");
        $this->db->join("product_master d","d.product_id = a.product_id","left");
        $this->db->join("product_detail_master e","e.product_id = a.product_id","left");
        $this->db->join("category_master f","f.category_id = d.category_id","left");
        $this->db->join("brand_master g","g.brand_id = d.brand_id","left");
        
        if($purchase_id != null)
        {
            $this->db->where('a.purchase_id',$purchase_id);
        }

        $this->db->group_by('a.purchase_detail_id');
        $res = $this->db->get();
        return $res;
    }*/

     public function GetAllPurchase1($purchase_id = null,$supplier_id=null)
    {
        $this->db->select("a.*,c.supplier_name,c.supplier_mobile,c.supplier_address");
        $this->db->from("purchase_master a");
        /*$this->db->join("purchase_detail_master b","b.purchase_id = a.purchase_id","left");*/
        $this->db->join("supplier_master c","c.supplier_id = a.supplier_id","left");        
        if($purchase_id != null)
        {
            $this->db->where('a.purchase_id',$purchase_id);
        }
        if($supplier_id!=null)
        {
            $this->db->where('a.supplier_id',$supplier_id);   
        }

        //$this->db->group_by('a.purchase_detail_id');
        $this->db->order_by('a.purchase_id','desc');
        $res = $this->db->get();
        return $res;
    }

    public function GetPurchaseDetail($purchase_id = null)
    {
        $this->db->select("a.*,c.product_name,c.hsncode,d.varient_name,e.brand_name,f.category_name");
        $this->db->from("purchase_detail_master a");
        $this->db->join("purchase_master b","b.purchase_id = a.purchase_id","left");
        $this->db->join("product_master c","c.product_id = a.product_id","left");
        $this->db->join("product_detail_master d","d.product_detail_id = a.product_detail_id","left");
        $this->db->join("brand_master e","e.brand_id = c.brand_id","left");
        $this->db->join("category_master f","f.category_id = c.category_id","left");
        $this->db->where('a.purchase_id',$purchase_id);
        $res = $this->db->get();
        return $res;
    }

    public function lastPurchase()
    {
        $this->db->select('referance_no');
        $this->db->from('purchase_master');
        $this->db->order_by('referance_no',"desc");
        $res = $this->db->get();
        return $res;
    }

    public function GetPurchaseId($bill_no = null)
    {
        $this->db->select("a.*");
        $this->db->from("purchase_master a");
                
        if($bill_no != null)
        {
            $this->db->where('bill_no',$bill_no);   
        }
        
        $res = $this->db->get();
        return $res;
    }

    public function InsertPurchase($data)
    {
        $this->db->insert('purchase_master',$data);
      //  $this->db->last_query();
        return $this->db->affected_rows();  
    }

    public function InsertPurchaseDetail($data)
    {
        $this->db->insert_batch('purchase_detail_master',$data);
        //$this->db->last_query();
        return $this->db->affected_rows();  
    }

    public function UpdatePurchase($data,$purchase_id)
    {
        $this->db->set($data);
        $this->db->where('purchase_id',$purchase_id);
        $this->db->update('purchase_master',$data);
        return $this->db->affected_rows();
    }

    public function DeletePurchase($purchase_id)
    {
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('purchase_master');
        return $this->db->affected_rows();
    }   

    public function DeletePurchaseDetail($purchase_id)
    {
        $this->db->where('purchase_id', $purchase_id);
        $this->db->delete('purchase_detail_master');
        return $this->db->affected_rows();
    }

// ------------------- Manage Sale --------------------------
    public function GetAllSale($sale_id = null,$employee_id = null,$fromdate = null,$todate = null,$product_id = null,$category_id = null,$brand_id = null)
    {
        $this->db->select("a.*,b.shop_id,b.price,b.tax_id,b.tax_amt,b.total,b.serial_no,c.customer_name,c.customer_address,c.customer_mobile,d.shop_name,e.employee_name,f.product_name,g.category_name,h.brand_name,i.varient_name");
        $this->db->from("sale_master a");
        $this->db->join("sale_detail_master b","b.sale_id = a.sale_id","left");
        $this->db->join("customer_master c","c.customer_id = a.customer_id","left");
        $this->db->join("shop_master d","d.shop_id = b.shop_id","left");
        $this->db->join("employee_master e","e.employee_id = a.user_status","left");
        $this->db->join("product_master f","f.product_id = b.product_id","left");
        $this->db->join("category_master g","g.category_id = f.category_id","left");
        $this->db->join("brand_master h","h.brand_id = f.brand_id","left");
        $this->db->join("product_detail_master i","i.product_id = f.product_id","left");
        
        if($sale_id != null && $employee_id != null)
        {
            $this->db->where('a.sale_id',$sale_id);   
            $this->db->where('a.user_status',$employee_id);
        }
        else if($sale_id != null && $employee_id == null)
        {
            $this->db->where('a.sale_id',$sale_id);   
        }
        else if($sale_id == null && $employee_id != null)
        {
            $this->db->where('a.user_status',$employee_id);
        }

        // 1
        if($fromdate != null && $todate == null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date <=',$todate);
        }
        else if($fromdate == null && $todate == null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('b.product_id',$product_id);
        }
        else if($fromdate == null && $todate == null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate == null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('f.brand_id',$brand_id);
        }

        //2 fromdate and other
        else if($fromdate != null && $todate != null && $product_id == null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('b.product_id',$product_id);
        }
        else if($fromdate != null && $todate == null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate == null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('f.brand_id',$brand_id);
        }

        //2 todate and other
        else if($fromdate == null && $todate != null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate != null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.brand_id',$brand_id);
        }

        //2 product_id and other
        else if($fromdate == null && $todate == null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate == null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //2 category_id and other
        else if($fromdate == null && $todate == null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //3 fromdate,todate and other
        else if($fromdate != null && $todate != null && $product_id != null && $category_id == null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
        }

        //3 fromdate,product_id and other
        else if($fromdate != null && $todate == null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('f.brand_id',$brand_id);
        }

        //3 fromdate,category_id and other
        else if($fromdate != null && $todate == null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //3 todate,product_id and other
        else if($fromdate == null && $todate != null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate == null && $todate != null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //3 todate,category_id and other
        else if($fromdate == null && $todate != null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //3 product_id,category_id and other
        else if($fromdate == null && $todate == null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }        

        //4 
        else if($fromdate != null && $todate != null && $product_id != null && $category_id != null && $brand_id == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
        }
        else if($fromdate != null && $todate != null && $product_id != null && $category_id == null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate != null && $product_id == null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }
        else if($fromdate != null && $todate == null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }
        else if($fromdate == null && $todate != null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }

        //5 All
        else if($fromdate != null && $todate != null && $product_id != null && $category_id != null && $brand_id != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
            $this->db->where('b.product_id',$product_id);
            $this->db->where('f.category_id',$category_id);
            $this->db->where('f.brand_id',$brand_id);
        }
      $this->db->order_by('a.sale_id','desc');
       // $this->db->group_by('a.sale_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetAllSale1($sale_id = null,$fromdate = null,$todate = null)
    {
        $this->db->select("a.*,b.*,c.*,d.*,f.*,g.*,e.employee_name");
        $this->db->from("sale_master a");
        $this->db->join("sale_detail_master b","b.sale_id = a.sale_id","left");
        $this->db->join("customer_master c","c.customer_id = a.customer_id","left");
        $this->db->join("shop_master d","d.shop_id = b.shop_id","left");
        $this->db->join("employee_master e","e.employee_id = a.user_status","left");
        $this->db->join("product_detail_master f","f.product_detail_id = b.product_detail_id","left");
        $this->db->join("product_master g","g.product_id = b.product_id","left");
        /*$this->db->join("tax_master e","e.tax_id = a.sale_tax","left");*/
        
        if($sale_id != null)
        {
            $this->db->where('a.sale_id',$sale_id);   
        }
        if($fromdate != null && $todate != null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
            $this->db->where('a.invoice_date <=',$todate);
        }
        if($fromdate != null && $todate == null)
        {
            $this->db->where('a.invoice_date >=',$fromdate);
        }
        if($fromdate == null && $todate != null)
        {
            $this->db->where('a.invoice_date <=',$todate);
        }

        $this->db->group_by('a.sale_id');
        $res = $this->db->get();
        return $res;
    }

    public function GetSaleDetail($sale_id = null)
    {
        $this->db->select("a.*,b.*,c.*,d.*");
        $this->db->from("sale_detail_master a");
        $this->db->join("sale_master b","b.sale_id = a.sale_id","left");
        $this->db->join("product_master c","c.product_id = a.product_id","left");
        $this->db->join("product_detail_master d","d.product_detail_id = a.product_detail_id","left");
        $this->db->where('a.sale_id',$sale_id);
        $res = $this->db->get();
        return $res;
    }

    public function lastInvoice($shop_id = null)
    {
        /*$query = $this->db->query("SELECT COUNT(*) as count FROM sale_master as a  left join sale_detail_master as b on b.sale_id = a.sale_id where shop_id = $shop_id");
        if($query->num_rows() > 0 )
        {
            $row =  $query->row();
            return $row->count; // return the count
        }
        else
        {
            return 0;
        }*/
        
        $this->db->select('count(*)');
        $this->db->from("sale_master a");
        $this->db->join("sale_detail_master b","b.sale_id = a.sale_id","left");
        if($shop_id != null)
        {
            $this->db->where("shop_id",$shop_id);
        }
        $res = $this->db->get();
        $cnt = $res->row_array();
        return $cnt['count(*)'];
    }

    public function DebitStock($stockData = null)
    {
        $sr_no = $stockData->serial_no;
        $this->db->select('*');
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->from('purchase_detail_master');
        $stk = $this->db->get()->row();

        $ss = "";
        $st = $stk->stock;
        $product_detail_id = $stockData->product_detail_id;

        if($product_detail_id != null)
        {
            $ss = $st - $stockData->qty;
        }
        
        $this->db->set('stock', $ss, FALSE);
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->update('purchase_detail_master'); 
        return $this->db->affected_rows();
    }

    public function CreditStock($stockData = null)
    {        
        $sr_no = $stockData->serial_no;        
        $this->db->select('*');
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->from('purchase_detail_master');
        $stk = $this->db->get()->row();

        $ss = "";
        $st = $stk->stock;
        $product_detail_id = $stockData->product_detail_id;
        if($product_detail_id != null)
        {
            $ss = $st + $stockData->qty;
        }
        
        $this->db->set('stock', $ss, FALSE);
        $this->db->where('product_detail_id', $stockData->product_detail_id);
        $this->db->where('FIND_IN_SET("'.$sr_no.'",serial_no) <> 0');
        $this->db->update('purchase_detail_master'); 
        return $this->db->affected_rows();
    }

    public function GetSaleId($invoice_no = null)
    {
        $this->db->select("a.*");
        $this->db->from("sale_master a");
        if($invoice_no != null)
        {
            $this->db->where('invoice_no',$invoice_no);   
        }
        $res = $this->db->get();
        return $res;
    }

    public function InsertSale($data)
    {
        $this->db->insert('sale_master',$data);
        return $this->db->affected_rows();  
    }

    public function InsertSaleDetail($data)
    {
        $this->db->insert_batch('sale_detail_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateSale($data,$sale_id)
    {
        $this->db->set($data);
        $this->db->where('sale_id',$sale_id);
        $this->db->update('sale_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteSale($sale_id)
    {
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale_master');
        return $this->db->affected_rows();
    }   

    public function DeleteSaleDetail($sale_id)
    {
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale_detail_master');
        return $this->db->affected_rows();
    }

// ------------------- Manage Shop --------------------------
    public function GetAllShop($shop_id = null)
    {
        $this->db->select("*");
        $this->db->from("shop_master");
        
        if($shop_id != null)
        {
            $this->db->where('shop_id',$shop_id);   
        }
        $res = $this->db->get();
        return $res;
    }

    //--------------- AUTOCOMPLETE FUNCTIONS --------- 
    public function autocomplete($qry)
    {
          $query = $this->db->query($qry);
          $data = [];
          $dt = $query->result_array();
          foreach ($dt as $row) 
          {
                $data[] = $row['product_name'].' '.$row['varient_name'].''.$row['barcode'];
          }
          return $data;
    }
    //--------------- AUTOCOMPLETE FUNCTIONS --------- 

    public function InsertShop($data)
    {
        $this->db->insert('shop_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateShop($data,$shop_id)
    {
        $this->db->set($data);
        $this->db->where('shop_id',$shop_id);
        $this->db->update('shop_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteShop($shop_id)
    {
        $this->db->where('shop_id', $shop_id);
        $this->db->delete('shop_master');
        return $this->db->affected_rows();
    }   
// ------------------------------------------------ Hr Management  ------------------------------------------------------------------------------// 

    // --- Manage Member ----------------------//

  


    public function GetAllaward($id = null)
    {
        $this->db->select("a.*,b.employee_name");
        $this->db->from("member_master a");
        $this->db->join("employee_master b","b.employee_id = a.employee_id","left");
        
        if($id != null)
        {
            $this->db->where('member_id',$id);   
        }
        
        $res=$this->db->get();
        return $res;
    }

    public function Insertaward($data)
    {
        $this->db->insert('member_master',$data);
        return $this->db->affected_rows();  
    }

    public function Updateaward($data,$id)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        $this->db->update('member_master',$data);
        return $this->db->affected_rows();
    }

    public function Deleteaward($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member_master');
        return $this->db->affected_rows();
    }   
    // ------------------- Manage Employee ----------------------
    public function GetAllEmployee($employee_id = null,$employee_username = null)
    {
        $this->db->select("*");
        $this->db->from("employee_master");
        
        if($employee_id != null && $employee_username == null)
        {
            $this->db->where('employee_id',$employee_id);   
        }
        else if($employee_id == null && $employee_username != null)
        {
            $this->db->where('employee_username',$employee_username);   
        }
        $res=$this->db->get();
        return $res;
    }

    public function InsertEmployee($data)
    {
        $this->db->insert('employee_master',$data);
        return $this->db->affected_rows();  
    }

    public function UpdateEmployee($data,$employee_id)
    {
        $this->db->set($data);
        $this->db->where('employee_id',$employee_id);
        $this->db->update('employee_master',$data);
        return $this->db->affected_rows();
    }

    public function DeleteEmployee($employee_id)
    {
        $this->db->where('employee_id', $employee_id);
        $this->db->delete('employee_master');
        return $this->db->affected_rows();
    }
     // ------------------- Manage Plan -------------------------
     public function GetAlldepartment($Department_id = null)
     {
         $this->db->select("*");
         $this->db->from("plan_master");
         
         if($Department_id != null)
         {
             $this->db->where('Plan_id',$Department_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertdepartment($data)
     {
         $this->db->insert('plan_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updatedepartment($data,$Department_id)
     {
         $this->db->set($data);
         $this->db->where('Department_id',$Department_id);
         $this->db->update('plan_master',$data);
         return $this->db->affected_rows();
     }
 
     public function Deletedepartment($Department_id)
     {
         $this->db->where('Department_id', $Department_id);
         $this->db->delete('plan_master');
         return $this->db->affected_rows();
     }   


     public function GetAllattendance($attendance_id = null)
     {
         $this->db->select("*");
         $this->db->from("attendance_master");
         
         if($attendance_id != null)
         {
             $this->db->where('attendance_id',$attendance_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertattendance($data)
     {
         $this->db->insert('attendance_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateattendance($data,$attendance_id)
     {
         $this->db->set($data);
         $this->db->where('attendance_id',$attendance_id);
         $this->db->update('attendance_master',$data);
         return $this->db->affected_rows();
     }
 
     public function Deleteattendance($attendance_id)
     {
         $this->db->where('attendance_id', $attendance_id);
         $this->db->delete('attendance_master');
         return $this->db->affected_rows();
     }  

     public function GetAllmemberreport ($member_id , $fromdate ,$todate )
     {
        
         $this->db->select("a.*,b.name,b.rate");
         $this->db->from("member_master a");
         $this->db->join("plan_master b","b.Plan_id = a.Plan_id","left");
         
         if($member_id != null)
         {
             $this->db->where('a.member_id',$member_id);
         }
 
         // 1
         if($fromdate != null && $todate == null && $member_id == null )
         {
             $this->db->where('a.member_id',$fromdate);
         }
         else if($fromdate == null && $todate != null && $member_id != null )
         {
             $this->db->where('a.member_id ',$todate);
             $this->db->where('a.member_id',$member_id);
         }
         $this->db->group_by('a.member_id' ,'DESC');
         $res = $this->db->get();
         return $res;
     }


     public function GetAllattendancetrainer($trainerattendance_id = null)
     {
         $this->db->select("*");
         $this->db->from("trainerattendance_master");
         
         if($trainerattendance_id != null)
         {
             $this->db->where('trainerattendance_id',$trainerattendance_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertattendancetrainer($data)
     {
         $this->db->insert('trainerattendance_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateattendancetrainer($data,$trainerattendance_id)
     {
         $this->db->set($data);
         $this->db->where('trainerattendance_id',$trainerattendance_id);
         $this->db->update('trainerattendance_master',$data);
         return $this->db->affected_rows();
     }
     public function Deleteattendancetrainer($trainerattendance_id)
     {
         $this->db->where('trainerattendance_id', $trainerattendance_id);
         $this->db->delete('trainerattendance_master');
         return $this->db->affected_rows();
     }  


     public function GetAllattinquiry($id = null)
     {
         $this->db->select("*");
         $this->db->from("inquiry_master");
         
         if($id != null)
         {
             $this->db->where('id',$id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertinquiry($data)
     {
         $this->db->insert('inquiry_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateinquiry($data,$id)
     {
         $this->db->set($data);
         $this->db->where('id',$id);
         $this->db->update('inquiry_master',$data);
         return $this->db->affected_rows();
     }
     public function Deleteinquiry($id)
     {
         $this->db->where('id', $id);
         $this->db->delete('inquiry_master');
         return $this->db->affected_rows();
     }  
     
     
     public function GetAllholiday($id = null)
     {
         $this->db->select("*");
         $this->db->from("holiday_master");
         
         if($id != null)
         {
             $this->db->where('id',$id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertholiday($data)
     {
         $this->db->insert('holiday_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateholiday($data,$id)
     {
         $this->db->set($data);
         $this->db->where('id',$id);
         $this->db->update('holiday_master',$data);
         return $this->db->affected_rows();
     }
 
     public function Deleteholiday($id)
     {
         $this->db->where('id', $id);
         $this->db->delete('holiday_master');
         return $this->db->affected_rows();
     }  
     
     
     public function GetAllleavetype($leave_id = null)
     {
         $this->db->select("*");
         $this->db->from("leavetype_master");
         
         if($leave_id != null)
         {
             $this->db->where('leave_id',$leave_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertleavetype($data)
     {
         $this->db->insert('leavetype_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateleavetype($data,$leave_id)
     {
         $this->db->set($data);
         $this->db->where('leave_id',$leave_id);
         $this->db->update('leavetype_master',$data);
         return $this->db->affected_rows();
     }
 
     public function Deleteleavetype($leave_id)
     {
         $this->db->where('leave_id', $leave_id);
         $this->db->delete('leavetype_master');
         return $this->db->affected_rows();
     }

     public function GetAlladdleave($addleave_id = null)
     {
         $this->db->select("a.*,b.name,b.number,c.employee_name");
         $this->db->from("addleave_master a");
         $this->db->join("leavetype_master b","b.leave_id = a.leave_id","left");
         $this->db->join("employee_master c","c.employee_id = a.employee_id","left");
         
         if($addleave_id != null)
         {
             $this->db->where('addleave_id',$addleave_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function Insertaddleave($data)
     {
         $this->db->insert('addleave_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function Updateaddleave($data,$addleave_id)
     {
         $this->db->set($data);
         $this->db->where('addleave_id',$addleave_id);
         $this->db->update('addleave_master',$data);
         return $this->db->affected_rows();
     }
 
     public function Deleteaddleave($addleave_id)
     {
         $this->db->where('addleave_id', $addleave_id);
         $this->db->delete('addleave_master');
         return $this->db->affected_rows();
     }
    
     public function GetAllCandidate($Candidate_id = null)
     {
         $this->db->select("*");
         $this->db->from("Candidate_master ");
        
         
         if($Candidate_id != null)
         {
             $this->db->where('Candidate_id',$Candidate_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function InsertCandidate($data)
     {
         $this->db->insert('Candidate_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function UpdateCandidate($data,$Candidate_id)
     {
         $this->db->set($data);
         $this->db->where('Candidate_id',$Candidate_id);
         $this->db->update('Candidate_master',$data);
         return $this->db->affected_rows();
     }
 
     public function DeleteCandidate($Candidate_id)
     {
         $this->db->where('Candidate_id', $Candidate_id);
         $this->db->delete('Candidate_master');
         return $this->db->affected_rows();
     }

     public function GetAllShortlist($Shortlist_id = null)
     {
         $this->db->select("a.*,b.Candidate_name,c.Department_name");
         $this->db->from("Shortlist_master a ");
         $this->db->join("Candidate_master b","b.Candidate_id = a.Candidate_id","left");
         $this->db->join("plan_master c","c.Department_id = a.Department_id","left");
        
         
         if($Shortlist_id != null)
         {
             $this->db->where('Shortlist_id',$Shortlist_id);   
         }
         
         $res=$this->db->get();
         return $res;
     }
 
     public function InsertShortlist($data)
     {
         $this->db->insert('Shortlist_master',$data);
         return $this->db->affected_rows();  
     }
 
     public function UpdateShortlist($data,$Shortlist_id)
     {
         $this->db->set($data);
         $this->db->where('Shortlist_id',$Shortlist_id);
         $this->db->update('Shortlist_master',$data);
         return $this->db->affected_rows();
     }
 
     public function DeleteShortlist($Shortlist_id)
     {
         $this->db->where('Shortlist_id', $Shortlist_id);
         $this->db->delete('Shortlist_master');
         return $this->db->affected_rows();
     }


   }
