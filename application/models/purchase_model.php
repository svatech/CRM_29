<?php
class Purchase_model extends CI_Model
{
	function get_pdts_list(){
		return $this->db->query("select product_name from product_master where category='FUEL' and status='1'")->result_array();
	}
	function get_other_pdts_list(){
		return $this->db->query("select product_name from product_master where category!='FUEL' and status='1'")->result_array();
	}
	function get_tanks_list(){
		return $this->db->query("select * from tank_master where status=1")->result_array();
	}
	function get_tnk_pdt($tank){
		return $this->db->query("select product from tank_master where tank_no='$tank' and status=1")->result_array();
	}
	function get_bill_no($bill_mode){
		return $this->db->query("select $bill_mode from bill_no_generator")->result_array();
	}
	function insert_bill($voucher_no,$acct_date,$inv_no,$inv_date,$party_name,$total){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		return $this->db->query("insert into pet_pur_entry(voucher_no,account_date,invoice_no,invoice_date,party_name,total,added_by,added_time) values('$voucher_no','$acct_date','$inv_no','$inv_date','$party_name','$total','$uname','$add_date')");
	}
	function insert_bill_details($voucher_no,$item,$qty,$val,$inv_den,$del_den){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("insert into pet_pur_entry_details(voucher_no,item_name,quantity,amount,inv_density,del_density) values('$voucher_no','$item','$qty','$val','$inv_den','$del_den')");
	}
	function insert_tnk_load_details($voucher_no,$tnk,$pdt,$qty,$date){
		$this->db->query("insert into tank_loading_register(voucher_no,tank_name,product,quantity,delivery_date) values('$voucher_no','$tnk','$pdt','$qty','$date')");
	}
	function update_billno($voucher_no,$mode){
		
		$new_no=++$voucher_no;
		return $this->db->query("update bill_no_generator set $mode='$new_no'");
	}
	function get_pdt_category($pdt){
		$category=$this->db->query("select category from product_master where product_name='$pdt'")->result_array();
		foreach ($category as $cat);
		return $cat["category"];
		}
	function insert_other_bill($voucher_no,$acct_date,$inv_no,$inv_date,$party_name,$pay_mode,$tot,$cash_per,$cash_disc,$sch_per,$sch_disc,$vat_per,$vat,$others,$grnd_tot){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("insert into other_pur_entry(voucher_no,account_date,bill_no,bill_date,party_name,payment_mode,total,cash_dis_per,cash_discount,scheme_dis_per,scheme_discount,vat_tax_per,vat_tax,others,grand_total,added_by,added_time) values('$voucher_no','$acct_date','$inv_no','$inv_date','$party_name','$pay_mode','$tot','$cash_per','$cash_disc','$sch_per','$sch_disc','$vat_per','$vat','$others','$grnd_tot','$uname','$add_date')");
		
	}
	function insert_other_bill_details($voucher_no,$item,$cat,$qty,$rate,$val){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("insert into other_pur_entry_details(voucher_no,item_name,item_category,quantity,rate,amount) values('$voucher_no','$item','$cat','$qty','$rate','$val')");
	}
	/*function sample(){
		return $this->db->query("select voucher_no from purchase_entry_details")->result_array();
		
	}*/
	function get_suppliers_list(){
		return $this->db->query("select * from product_suppliers")->result_array();
	}
	
	function fetch_purchase_details($sdate,$edate){
		return $this->db->query("
		SELECT voucher_no,account_date,invoice_no,invoice_date,party_name,total,
    	ifnull((select sum(quantity) from pet_pur_entry_details e where e.voucher_no = p.voucher_no and item_name = 'PETROL'),0) AS petrol,
    	ifnull((select sum(quantity) from pet_pur_entry_details e where e.voucher_no = p.voucher_no and item_name = 'DIESEL'),0) AS diesel
		FROM pet_pur_entry p where account_date between '$sdate' and '$edate'")->result();
	}
	
	function fetch_other_purchase_details($sdate,$edate){
		return $this->db->query("
		SELECT voucher_no,account_date,bill_no,bill_date,party_name,total,
		(select count(*) from other_pur_entry_details s where voucher_no=p.voucher_no) as 
		'pdt_cnt' from other_pur_entry p where account_date between '$sdate' and '$edate'")->result();
	}
	function get_pet_pur_details($bill_no){
		$query=$this->db->query("SELECT * FROM pet_pur_entry WHERE voucher_no='$bill_no'");
		return $query->result();
	}
	
	function pet_pur_pdt_details($bill_no){
		$query=$this->db->query("SELECT * FROM pet_pur_entry_details WHERE voucher_no='$bill_no'");
		return $query->result();
	}
	
	function get_oth_pur_details($bill_no){
		$query=$this->db->query("SELECT * FROM other_pur_entry WHERE voucher_no='$bill_no'");
		return $query->result();
	}
	
	function oth_pur_pdt_details($bill_no){
		$query=$this->db->query("SELECT * FROM other_pur_entry_details WHERE voucher_no='$bill_no'");
		return $query->result();
	}
	function get_tanks_loading_details($bill_no){
		$query=$this->db->query("SELECT * FROM tank_loading_register WHERE voucher_no='$bill_no'");
		return $query->result();
	}
	
	function delete_pet_pur_details($voucher_no){
		$this->db->query("DELETE FROM pet_pur_entry_details  WHERE voucher_no='$voucher_no'");
	}
	
	function delete_oth_pur_details($voucher_no){
		$this->db->query("DELETE FROM other_pur_entry_details  WHERE voucher_no='$voucher_no'");
	}
	
	function delete_tank_loading_details($voucher_no){
		$this->db->query("DELETE FROM tank_loading_register WHERE voucher_no='$voucher_no'");
	}
	
	function insert_pet_pur_dtls($voucher_no,$pdt,$qty,$amt,$inv_den,$del_den,$voucher_status){
		$this->db->query("INSERT INTO pet_pur_entry_details(voucher_no,item_name,quantity,amount,inv_density,del_density,voucher_updated) VALUES('$voucher_no','$pdt','$qty','$amt','$inv_den','$del_den','$voucher_status')");
	}
	function insert_oth_pur_dtls($voucher_no,$pdt,$qty,$amt,$rate,$cat,$voucher_status){
		$this->db->query("INSERT INTO other_pur_entry_details(voucher_no,item_name,item_category,quantity,rate,amount,voucher_updated) VALUES('$voucher_no','$pdt','$cat','$qty','$rate','$amt','$voucher_status')");
	}
	
	function insert_tank_loading_dtls($voucher_no,$tnk,$pdt,$ltrs,$acct_date,$voucher_status){
		$this->db->query("INSERT INTO tank_loading_register(voucher_no,tank_name,product,quantity,delivery_date,voucher_updated) VALUES('$voucher_no','$tnk','$pdt','$ltrs','$acct_date','$voucher_status')");
		//echo $voucher_no." ".$tnk." ".$pdt." ".$ltrs." ".$acct_date;
		
	}
	
	function update_pet_pur_info($voucher_no,$acct_date,$inv_no,$inv_date,$party_name,$total){
	$uname=$this->session->userdata('admin_user_email');
	$add_date=date('Y-m-d H:i:s');
	$this->db->query("UPDATE pet_pur_entry SET account_date='$acct_date',invoice_no='$inv_no',invoice_date='$inv_date',party_name='$party_name',total='$total',added_by='$uname',added_time='$add_date',voucher_updated=(voucher_updated+1) WHERE voucher_no='$voucher_no' ");
	}
	
	function update_oth_pur_info($voucher_no,$acct_date,$inv_no,$inv_date,$party_name,$pay_mode,$total,$cash_disc,$cash_disc_amt,$sch_disc,$sch_disc_amt,$vat,$vat_amt,$other_amt,$grnd_tot){
	$uname=$this->session->userdata('admin_user_email');
	$add_date=date('Y-m-d H:i:s');
	$this->db->query("UPDATE other_pur_entry SET account_date='$acct_date',bill_no='$inv_no',bill_date='$inv_date',party_name='$party_name',payment_mode='$pay_mode',total='$total',cash_dis_per='$cash_disc',cash_discount='$cash_disc_amt',scheme_dis_per='$sch_disc',scheme_discount='$sch_disc_amt',vat_tax_per='$vat',vat_tax='$vat_amt',others='$other_amt',grand_total='$grnd_tot',added_by='$uname',added_time='$add_date' ,voucher_updated=(voucher_updated+1)WHERE voucher_no='$voucher_no' ");
	}
	function fetch_managed_retail_purchase_details($start,$end)
		{
	
		$query=$this->db->query("SELECT *
								FROM 
								(SELECT voucher_no,account_date,invoice_no,invoice_date,party_name,total,added_by,added_time,(voucher_updated)+1 as voucher_updated
								FROM pet_pur_entry
								WHERE voucher_updated NOT IN('0') 
								
								UNION ALL 
								
								SELECT voucher_no,account_date,invoice_no,invoice_date,party_name,total,added_by,added_time, voucher_updated
								FROM pet_pur_entry_log ) as log
								WHERE account_date BETWEEN '$start' and  '$end'
								ORDER BY log.voucher_no,log.voucher_updated desc");
		return $query->result();
		}
		function fetch_no_of_version($voucher_no)
		{
		$query=$this->db->query("SELECT COUNT(*) AS COUNT
								FROM (SELECT *
								FROM pet_pur_entry
								WHERE voucher_updated NOT IN('0')  AND voucher_no='$voucher_no'
								UNION 
								SELECT *
								FROM pet_pur_entry_log
								WHERE voucher_no='$voucher_no') as Log");
		foreach ($query->result_array() as $row);
		$count= $row["COUNT"]; 
		return $count;
		}
		function get_old_purchase_details($voucher_no,$version){
		$query=$this->db->query("SELECT * 
								 FROM crm.pet_pur_entry_log
								 where voucher_no='$voucher_no' AND  voucher_updated='$version'");
		return $query->result();
		}
		function get_old_product_purchase_details($voucher_no,$version)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.pet_pur_entry_details_log 
								 where voucher_no ='$voucher_no' AND  voucher_updated = '$version'
								 GROUP BY item_name");
		return $query->result();
		
		}

		function get_old_tanks_loading_details($voucher_no,$version){
		$query=$this->db->query("SELECT *  
								 FROM crm.tank_loading_register_log
								 where voucher_no ='$voucher_no' AND  voucher_updated = '$version'
								 GROUP BY tank_name");
		return $query->result();

	}
	function fetch_managed_other_purchase_details($start,$end)
		{
	
		$query=$this->db->query("SELECT *
								FROM 
								(SELECT voucher_no,account_date,bill_no,bill_date,party_name,total,added_by,added_time,(voucher_updated)+1 as voucher_updated
								FROM other_pur_entry
								WHERE voucher_updated NOT IN('0') 
								
								UNION ALL 
								
								SELECT voucher_no,account_date,bill_no,bill_date,party_name,total,added_by,added_time, voucher_updated
								FROM other_pur_entry_log ) as log
								WHERE account_date BETWEEN '$start' and  '$end'
								ORDER BY log.voucher_no,log.voucher_updated desc");
		return $query->result();
		}
		function fetch_no_of_version_other($voucher_no)
		{
		$query=$this->db->query("SELECT COUNT(*) AS COUNT
								FROM (SELECT *
								FROM other_pur_entry
								WHERE voucher_updated NOT IN('0')  AND voucher_no='$voucher_no'
								UNION 
								SELECT *
								FROM other_pur_entry_log
								WHERE voucher_no='$voucher_no') as Log");
		foreach ($query->result_array() as $row);
		$count= $row["COUNT"]; 
		return $count;
		}
		function get_old_purchase_details_other($voucher_no,$version){
		$query=$this->db->query("SELECT * 
								 FROM crm.other_pur_entry_log
								 where voucher_no='$voucher_no' AND  voucher_updated='$version'");
		return $query->result();
		}
		function get_old_product_purchase_details_other($voucher_no,$version)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.other_pur_entry_details_log
								 where voucher_no ='$voucher_no' AND  voucher_updated = '$version'
								 GROUP BY item_name");
		return $query->result();
		
		}
	function fetch_comm_rate($product)
	{
		$query=$this->db->query("SELECT ifnull(commision_rate,0) as commision_rate FROM crm.product_master where product_name ='$product';");
		foreach( $query->result()  as $row )
		{
		return $row->commision_rate;
		}
	}
	function get_supplier_prod($supplier)
	{
	$query=$this->db->query("SELECT * FROM crm.product_suppliers Where supplier_name='$supplier' ");
		foreach( $query->result()  as $row )
		{
		return $row->supplied_products;
		}
	}

	
}
