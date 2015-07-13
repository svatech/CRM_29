
<?php if($this->session->userdata('admin_logged_in')){?>
<li><a href="javascript:void(0);" class="nav-top-item <?php if(($this->session->userdata('admin_logged_in'))&&($menu=='sales')) echo "current"; ?>">Sales</a>
<ul style="display: block;">
    	<li><a href="<?php echo site_url("sales/index"); ?>" <?php if ($submenu=='sales'){?>class="current"<?php }?> >Petrol/Diesel Bill Entry</a></li>
    	<li><a href="<?php echo site_url("sales/other_sales_entry"); ?>" <?php if ($submenu=='other_sales_entry'){?>class="current"<?php }?> >Other Products Bill Entry</a></li>
    	<li><a href="<?php echo site_url("sales/open_close_shift "); ?>" <?php if ($submenu=='open_shift'){?>class="current"<?php }?> >Open/Close Shift</a></li>
    	<li><a href="<?php echo site_url("sales/testing_litres_entry"); ?>" <?php if ($submenu=='testing_entry'){?>class="current"<?php }?> >Testing Litres Bill Entry</a></li>
    	<?php if($this->session->userdata('userrole')!='cashier'){ ?>
    	<li><a href="<?php echo site_url("sales/petrol_sales_entry"); ?>" <?php if ($submenu=='sales_entry'){?>class="current"<?php }?> >Petrol/Diesel Sales Entry</a></li>
        <li><a href="<?php echo site_url("sales/Edit_retail_bill"); ?>" <?php if ($submenu=='Edit_retail_bill'){?>class="current"<?php }?> >Manage Petrol/Diesel Bills</a></li>
        <li><a href="<?php echo site_url("sales/Edit_other_products_bill"); ?>" <?php if ($submenu=='Edit_other_products_bill'){?>class="current"<?php }?> >Manage Other Products Bills</a></li>
        <li><a href="<?php echo site_url("sales/Edit_test_litres_bill"); ?>" <?php if ($submenu=='Edit_test_litres_bill'){?>class="current"<?php }?> >Manage Testing Litres Bills</a></li>
        <li><a href="<?php echo site_url("sales/retail_bill_log"); ?>" <?php if ($submenu=='retail_bill_log'){?>class="current"<?php }?> >Petrol/Diesel Bills log</a></li>
        <li><a href="<?php echo site_url("sales/other_pdts_bill_log"); ?>" <?php if ($submenu=='other_pdts_bill_log'){?>class="current"<?php }?> >Other Products Bills log</a></li>
        <li><a href="<?php echo site_url("sales/cancelled_retail_bills"); ?>" <?php if ($submenu=='cancelled_retail_bills'){?>class="current"<?php }?> >Cancelled Petrol/Diesel Bills</a></li>
        <li><a href="<?php echo site_url("sales/cancelled_other_pdts_bills"); ?>" <?php if ($submenu=='cancelled_other_pdts_bills'){?>class="current"<?php }?> >Cancelled Other Products Bills</a></li>
        <li><a href="<?php echo site_url("sales/cancelled_testing_bills"); ?>" <?php if ($submenu=='cancelled_testing_bills'){?>class="current"<?php }?> >Cancelled Testing Litres Bills</a></li>
        <?php }?>
        </ul>
</li>
<?php }?>
<?php if($this->session->userdata('userrole')=='admin'||$this->session->userdata('userrole')=='manager'){ ?>		
<li><a href="javascript:void(0);" class="nav-top-item <?php if($menu=='purchase') echo "current"; ?>">Purchase</a>
	<ul style="display: block;">
    	<li><a href="<?php echo site_url("purchase/index"); ?>" <?php if ($submenu=='petrol_pur'){?>class="current"<?php }?> >Petrol/Diesel Purchase</a></li>
        <li><a href="<?php echo site_url("purchase/other_purchase"); ?>" <?php if ($submenu=='other_pur'){?> class="current" <?php }?>>Other Products Purchase</a></li>
        <li><a href="<?php echo site_url("purchase/edit_petrol_purchase"); ?>" <?php if ($submenu=='edit_petrol_purchase'){?> class="current" <?php }?>>Manage Petrol/Diesel Purchase Bills</a></li>
        <li><a href="<?php echo site_url("purchase/retail_purchase_log"); ?>" <?php if ($submenu=='retail_purchase_log'){?> class="current" <?php }?>> Petrol/Diesel Purchase Log</a></li>
        <li><a href="<?php echo site_url("purchase/edit_other_purchase"); ?>" <?php if ($submenu=='edit_other_purchase'){?> class="current" <?php }?>>Manage Other Products Purchase Bills</a></li>
        <li><a href="<?php echo site_url("purchase/other_purchase_log"); ?>" <?php if ($submenu=='other_purchase_log'){?> class="current" <?php }?>> Other Products Purchase Log</a></li>
	</ul>
</li> 

<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='reports') echo "current"; ?>">Reports</a>
  	<ul style="display: block;">
  	    <li><a href="<?php echo site_url("reports/oil_service_sms"); ?>" <?php if ($submenu=='oil_service_sms_rpt'){?>class="current"<?php }?> >Oil Service SMS Report</a></li>
  		<li><a href="<?php echo site_url("reports/shift_close"); ?>" <?php if ($submenu=='shft_close_rpt'){?>class="current"<?php }?> >Shift Close Sales Report</a></li>
  		<li><a href="<?php echo site_url("reports/index"); ?>" <?php if ($submenu=='pet_sal_rpt'){?>class="current"<?php }?> >Petrol/Diesel Sales Report</a></li>
        <li><a href="<?php echo site_url("reports/other_sales"); ?>" <?php if ($submenu=='oth_sal_rpt'){?>class="current"<?php }?> >Other Products Sales Report</a></li>
		<li><a href="<?php echo site_url("reports/indent_sales"); ?>" <?php if ($submenu=='ind_sal_rpt'){?>class="current"<?php }?> >Indent Sales Report</a></li>
		<li><a href="<?php echo site_url("reports/pet_purchase"); ?>" <?php if ($submenu=='pet_pur_rpt'){?>class="current"<?php }?> >Petrol/Diesel Purchase Report</a></li>
		<li><a href="<?php echo site_url("reports/other_purchase"); ?>" <?php if ($submenu=='oth_pur_rpt'){?>class="current"<?php }?> >Other Products Purchase Report</a></li>
        <li><a href="<?php echo site_url("reports/tank_stock"); ?>" <?php if ($submenu=='tank_stock_rpt'){?>class="current"<?php }?> >Tank Stock Report</a></li>
        <li><a href="<?php echo site_url("reports/indent_stmt_payment"); ?>" <?php if ($submenu=='indent_stmt_payment'){?>class="current"<?php }?> >Indent Statement Payments Report</a></li>
        <li><a href="<?php echo site_url("reports/cash_inflow_rpt"); ?>" <?php if ($submenu=='cash_inflow_rpt'){?>class="current"<?php }?> >Cash Inflow Report</a></li>
        <li><a href="<?php echo site_url("reports/expenses"); ?>" <?php if ($submenu=='expenses'){?>class="current"<?php }?> >Daily Expenses Report</a></li>
        <li><a href="<?php echo site_url("reports/transactions"); ?>" <?php if ($submenu=='transactions'){?>class="current"<?php }?> >Bank Transactions Report</a></li>
        <li><a href="<?php echo site_url("reports/test_register"); ?>" <?php if ($submenu=='test_reg'){?>class="current"<?php }?> >Testing Litres Register</a></li>
  		<li><a href="<?php echo site_url("reports/pet_bill_register"); ?>" <?php if ($submenu=='pet_bill_register'){?>class="current"<?php }?> >Petrol/Diesel Bill Register</a></li>
  		<li><a href="<?php echo site_url("reports/other_bill_register"); ?>" <?php if ($submenu=='other_bill_register'){?>class="current"<?php }?> >Other Products Bill Register</a></li>
  		<li><a href="<?php echo site_url("reports/rfid_vehicles_report"); ?>" <?php if ($submenu=='rfid_vehicles_report'){?>class="current"<?php }?> >RFID Vehicles Report</a></li>
  		<li><a href="<?php echo site_url("reports/indent_stmt_report"); ?>" <?php if ($submenu=='indent_stmt_report'){?>class="current"<?php }?> >Indent Statments Report</a></li>
		<li><a href="<?php echo site_url("reports/cheque_sal_report"); ?>" <?php if ($submenu=='cheque_sal_report'){?>class="current"<?php }?> >Cheque Sales Report</a></li>
  	</ul>
</li>


<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='statements') echo "current"; ?>">Statements</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("statements/index"); ?>" <?php if ($submenu=='fuel_stmt'){?>class="current"<?php }?> >Daily Fuel Statement</a></li>
  		<li><a href="<?php echo site_url("statements/cumulative_fuel_stmt"); ?>" <?php if ($submenu=='cumulative_fuel_stmt'){?>class="current"<?php }?> >Cumulative Fuel Statement</a></li>
  		<li><a href="<?php echo site_url("statements/cumulative_sales_stmt"); ?>" <?php if ($submenu=='cumulative_sales_stmt'){?>class="current"<?php }?> >Cumulative Sales Statement</a></li>
        <li><a href="<?php echo site_url("statements/indent_stmt"); ?>" <?php if ($submenu=='indent_stmt'){?>class="current"<?php }?> >Indent Sales Statement</a></li>
        <li><a href="<?php echo site_url("statements/indent_stmt_mgmt"); ?>" <?php if ($submenu=='indent_stmt_mgmt'){?>class="current"<?php }?> >Manage Indent Sales Statements</a></li>
		<li><a href="<?php echo site_url("statements/stock_statement"); ?>" <?php if ($submenu=='stock_stmt'){?>class="current"<?php }?> >Stock Statement</a></li>
		<li><a href="<?php echo site_url("statements/ebook"); ?>" <?php if ($submenu=='ebook'){?>class="current"<?php }?> >E-Book</a></li>
       
  	</ul>
</li> 
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='expense_mgr') echo "current"; ?> "> Expense Manager</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("expense_mgr/index");?>" <?php if ($submenu=='new_expense'){?>class="current"<?php }?> > Add New Expense</a></li>
  		<li><a href="<?php echo site_url("expense_mgr/manage_expense");?>" <?php if ($submenu=='manage_expense'){?>class="current"<?php }?> > Manage Expenses</a></li>
  		<li><a href="<?php echo site_url("expense_mgr/cancelled_expense");?>" <?php if ($submenu=='cancelled_expense'){?>class="current"<?php }?> > Cancelled Expenses</a></li>
    </ul>
</li>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='bank_transaction') echo "current"; ?> "> Bank Transactions</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("bank_transaction/index");?>" <?php if ($submenu=='new_transaction'){?>class="current"<?php }?> > Add New Transaction</a></li>
  		<li><a href="<?php echo site_url("bank_transaction/manage_transaction");?>" <?php if ($submenu=='manage_transaction'){?>class="current"<?php }?> > Manage Transactions</a></li>
  		<li><a href="<?php echo site_url("bank_transaction/cancelled_transaction");?>" <?php if ($submenu=='cancelled_transaction'){?>class="current"<?php }?> > Cancelled Transactions</a></li>
    </ul>
</li>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='accounts') echo "current"; ?> ">Accounts </a>
  	<ul style="display: block;">
  		<!-- <li><a href="<?php echo site_url("accounts/cash_manager");?>" <?php if ($submenu=='cash_manager'){?>class="current"<?php }?> > Cash Manager</a></li> -->
  		<li><a href="<?php echo site_url("accounts/index");?>" <?php if ($submenu=='cash_in'){?>class="current"<?php }?> > Add Cash Inflow</a></li>
  		<li><a href="<?php echo site_url("accounts/manage_cash_in");?>" <?php if ($submenu=='manage_cash_in'){?>class="current"<?php }?> > Manage Cash Inflow</a></li>
  		<li><a href="<?php echo site_url("accounts/cancelled_cash_in");?>" <?php if ($submenu=='cancelled_cash_in'){?>class="current"<?php }?> > Cancelled Cash Inflow</a></li>
  		<li><a href="<?php echo site_url("accounts/indent_cust_history");?>" <?php if ($submenu=='indent_cust_history'){?>class="current"<?php }?> > Indent Customers Accounts</a></li>
  	</ul>
</li>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='stock') echo "current"; ?> "> Stock Management</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("stock/tank_stock_entry");?>" <?php if ($submenu=='stock_dtls'){?>class="current"<?php }?> > Tank Stock Entry</a></li>
    </ul>
</li>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='export_data') echo "current"; ?>"> Export Data </a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("export_data/index");?>" <?php if ($submenu=='indent_statement'){?>class="current"<?php }?> > Indent Statement Report</a></li>
  		<li><a href="<?php echo site_url("export_data/bank_transc_rpt");?>" <?php if ($submenu=='bank_transc_rpt'){?>class="current"<?php }?> > Bank Transaction Report</a></li>
  		<li><a href="<?php echo site_url("export_data/cash_sale_rpt");?>" <?php if ($submenu=='cash_sale_rpt'){?>class="current"<?php }?> > Cash Sales Report</a></li>
  		<li><a href="<?php echo site_url("export_data/cheque_sale_rpt");?>" <?php if ($submenu=='cheque_sale_rpt'){?>class="current"<?php }?> > Cheque Sales Report</a></li>
  		<li><a href="<?php echo site_url("export_data/cheque_sale_nt_rpt");?>" <?php if ($submenu=='cheque_sale_nt_rpt'){?>class="current"<?php }?> > Cheque Sales Report(Not cleared)</a></li>
  		<li><a href="<?php echo site_url("export_data/indent_statement_payment");?>" <?php if ($submenu=='indent_statement_payment'){?>class="current"<?php }?> > Indent Statement Payment Report</a></li>
  		<li><a href="<?php echo site_url("export_data/icici_bank_transc_rpt");?>" <?php if ($submenu=='icici_bank_transc_rpt'){?>class="current"<?php }?> > ICICI Credit Card Bank Transaction Report</a></li>
  		<li><a href="<?php echo site_url("export_data/hdfc_bank_transc_rpt");?>" <?php if ($submenu=='hdfc_bank_transc_rpt'){?>class="current"<?php }?> >HDFC Credit Card Bank Transaction Report </a></li>
  		<li><a href="<?php echo site_url("export_data/export_data_master_dtls");?>" <?php if ($submenu=='export_data_master_dtls'){?>class="current"<?php }?>>Export Data Master</a></li>
  	</ul>
</li>
<?php } ?>
<?php if($this->session->userdata('userrole')=='admin'){ ?>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='master') echo "current"; ?> "> Masters</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("master/product_master_dtls");?>" <?php if ($submenu=='product_master_dtls'){?>class="current"<?php }?>>Product Master</a></li>
  		<li><a href="<?php echo site_url("master/tank_master_dtls");?>" <?php if ($submenu=='tank_master_dtls'){?>class="current"<?php }?> > Tank Master</a></li>
        <li><a href="<?php echo site_url("master/pump_master_dtls");?>" <?php if ($submenu=='pump_master_dtls'){?>class="current"<?php }?> >Pump Master</a></li>
		<li><a href="<?php echo site_url("master/customer_master_dtls");?>" <?php if ($submenu=='customer_master_dtls'){?>class="current"<?php }?>>Indent Customer Master</a></li>
		<li><a href="<?php echo site_url("master/retail_customer_dtls");?>" <?php if ($submenu=='retail_customer_dtls'){?>class="current"<?php }?>>Retail Customer Master</a></li>
		<li><a href="<?php echo site_url("master/supplier_master_dtls");?>" <?php if ($submenu=='supplier_master_dtls'){?>class="current"<?php }?>>Supplier Master</a></li>
		<li><a href="<?php echo site_url("master/rfid_vehicles_master_dtls");?>" <?php if ($submenu=='rfid_vehicles_master_dtls'){?>class="current"<?php }?>>RFID Vehicles Master</a></li>
		<li><a href="<?php echo site_url("master/sms_control_dtls");?>" <?php if ($submenu=='sms_control_dtls'){?>class="current"<?php }?>>SMS Control</a></li>
		
    </ul>
</li>

<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='users') echo "current"; ?> "> User Management</a>
  	<ul style="display: block;">
  		<li><a href="<?php echo site_url("users/list_users");?>" <?php if ($submenu=='list_users'){?>class="current"<?php }?> > User Master</a></li>
    </ul>
</li>
<?php }?>
<?php if($this->session->userdata('userrole')=='admin' ||$this->session->userdata('userrole')=='manager'){ ?>
<li> <a href="javascript:void(0);" class="nav-top-item <?php if($menu=='sopages') echo "current"; ?> ">Charts</a>
  	<ul style="display: block;">
  		<?php if($this->session->userdata('admin_user_email')=='admin'){ ?>
  		<li><a href="<?php echo site_url("sopages/ro_sales");?>" <?php if ($submenu=='ro_sales'){?>class="current"<?php }?> > Everyday Sales of RO</a></li>
  		<li><a href="<?php echo site_url("sopages/ro_inventory");?>" <?php if ($submenu=='ro_inventory'){?>class="current"<?php }?> > Inventory of RO</a></li>
  		<li><a href="<?php echo site_url("sopages/ro_stockloss");?>" <?php if ($submenu=='ro_stockloss'){?>class="current"<?php }?> > Stock Loss Statements</a></li>
  		<?php }?>
  		<li><a href="<?php echo site_url("sopages/ro_cumulative_sales");?>" <?php if ($submenu=='ro_cumulative_sales'){?>class="current"<?php }?> > Cumulative Sales Chart</a></li>
   		<li><a href="<?php echo site_url("sopages/ro_fuel_sales");?>" <?php if ($submenu=='ro_fuel_sales'){?>class="current"<?php }?> > Petrol Diesel Sales Chart</a></li>
   		
    </ul>
</li>
<?php }?>
 
  
