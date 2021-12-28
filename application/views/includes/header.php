<!DOCTYPE html> 
<html lang="en-US">
<head>
  <title>Hotel Management System</title>
  <meta charset="utf-8">
  <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-datetimepicker/bootstrap-datetimepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chosen.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrapValidator.min.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/css/jquery-ui.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-datepicker.min.css'); ?>">
  <!-- <link rel="stylesheet" href="<?php echo site_url('assets/css/sweetalert2.css'); ?>"> -->
  <link rel="stylesheet" href="<?php echo site_url('assets/lib/sweet-alert.css'); ?>">
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/chosen.jquery.js"></script>
  <script src="<?php echo site_url('assets/js/jquery-ui.min.js'); ?>"></script>
  <script src="<?php echo site_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
  <!-- <script src="<?php echo site_url('assets/src/SweetAlert.js'); ?>"></script> -->
  <script src="<?php echo site_url('assets/lib/sweet-alert.min.js'); ?>"></script>

  <script>
	  function show_modal(modal_id) {
	  	$('#'+modal_id).modal('show');
	  }
  </script>

  <style type="text/css">
  	#hide{ display: none; }
  	.crud-actions { width: auto!important; }
  	.hide{
  		display: none;
  	}
  	.text-danger{
  		font-weight: 200;
  	}
  	.chosen-container-single .chosen-single {
	    padding: 5px 0 0 8px;
	    height: 35px;
	}
	.chosen-container-single .chosen-single div b {
	    margin-top: 5px;
	}
	.grand_total{
		font-size: 16px;
		font-weight: 600;
	}
  </style>
</head>
<body> 
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #084e92;">
      <div class="container">
        <div class="navbar-header">
          <!-- <a class="navbar-brand" href="<?php echo site_url('admin/dashboard')?>"><?php echo lang('PRH');?><img src="<?php echo site_url('assets/images/imagelogo.png')?>" style="width: 60px; margin-top: -20px;"></a> -->
        </div>
        
        <div class="navbar-right">
          
          <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
	        
	        <!-- notic dorpdown -->
	         <!-- <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bell">  <span class="number bred black"><?= $qty_alert_num+(($Settings->product_expiry) ? $exp_alert_num : 0)+$shop_sale_alerts+$shop_payment_alerts+($payment_alert_num[0]->cus_qty); ?></span></span> <b class="caret"></b>
                              </a>
	          <ul class="dropdown-menu">
			  
	          </ul>
	        </li> -->
	        <!-- End notic dorpdown -->
	        
	        <!-- Tasks dorpdown -->
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-tasks"></span> <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            
	          </ul>
	        </li>
	        <!-- End Task dorpdown -->
	        
	        <!-- User dorpdown -->
	         <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name');?><b class="caret"></b></a>
	          <ul class="dropdown-menu">
	            <li>
	             <a href="<?php echo base_url(); ?>admin/profile"><span class="glyphicon glyphicon-user"></span> <?php echo lang('User Profile'); ?></a>
	            </li>
	            <?php if($this->lib_permission->checkactionexist('admin/user')){ ?>
	            <li>
	              <a href="<?php echo base_url(); ?>admin/user"><span class="glyphicon glyphicon-cog"></span> <?php echo lang('Setting'); ?></a>
	            </li>
	            <?php } if($this->lib_permission->checkactionexist('setting/role')){ ?>
	             <li>
	              <a href="<?php echo base_url(); ?>setting/role"><span class="glyphicon glyphicon-cog"></span> User Role</a>
	            </li>
	            <?php } ?>
	            <li class="divider"></li>
	              <li>
	              <a href="<?php echo base_url(); ?>admin/logout"><span class="glyphicon glyphicon-log-out"></span> <?php echo lang('Logout'); ?></a>
	            </li>
	          </ul>
	        </li>
	        <!--End User dorpdown -->
	        
	   </ul>
        </div>
          
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		  <li <?php if($this->uri->segment(2) == 'reservation'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/dashboard"> Dashboard</a>
		        </li>
          	<?php if($this->lib_permission->checkactionexist('admin/reservation')){ ?>
				<li <?php if($this->uri->segment(2) == 'reservation'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/reservation"> Rent Room</a>
		        </li>
          	<?php } if($this->lib_permission->checkactionexist('admin/checkin')){ ?>

		        <li <?php if($this->uri->segment(2) == 'checkin'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/checkin">Payment</a>
		        </li>
          	<?php } if($this->lib_permission->checkactionexist('admin/checkout')){ ?>

		        <li <?php if($this->uri->segment(2) == 'checkout'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/checkout"><?php echo lang('Checkout'); ?></a>
		        </li>
          	<?php } if($this->lib_permission->checkactionexist('admin/customer')){ ?>
	        
		        <li <?php if($this->uri->segment(2) == 'customer'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/customer"><?php echo lang('Customer'); ?></a>
		        </li>
          	<?php } if($this->lib_permission->checkactionexist('admin/item')){ ?>

		        <li id="<?php echo $hide?>" <?php if($this->uri->segment(2) == 'item'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/item"><?php echo lang('Additem'); ?></a>
		        </li>
	        <?php } if($this->lib_permission->checkactionexist('admin/cleaning')){ ?>
		        <!-- <li id="<?php echo $hide?>" <?php if($this->uri->segment(2) == 'cleaning'){echo 'class="active"';}?>>
		          <a href="<?php echo base_url(); ?>admin/cleaning"><?php echo lang('Cleaning'); ?></a>
		        </li> -->
	        <?php }?>

	        
	        
	        
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('Report');?> <b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<?php if($this->lib_permission->checkactionexist('admin/report/daily')){ ?>
		        		<li>
		        			<a href="<?php echo base_url('admin/report/daily/'); ?>"><span class="glyphicon glyphicon-user"></span><?php echo lang('Daily Report');?></a>
		        		</li>
	        		<?php } if($this->lib_permission->checkactionexist('admin/report/customer')){ ?>
		        		<li>
		        			<a href="<?php echo base_url(); ?>admin/report/customer"><span class="glyphicon glyphicon-user"></span><?php echo lang('Customer Report');?></a>
		        		</li>
		        	<?php } if($this->lib_permission->checkactionexist('admin/report/unpay')){ ?>
		        		<li>
		        			<a href="<?php echo base_url(); ?>admin/report/unpay"><span class="glyphicon glyphicon-user"></span><?php echo lang('Unpay Report');?></a>
		        		</li>
		        	<?php } ?>
	        		<li role="presentation" class="divider"></li>
	        		<?php if($this->lib_permission->checkactionexist('admin/report/today-checkin')){ ?>
		        		<li>
		        			<!-- <a href=""><span class="glyphicon glyphicon-arrow-left"></span><?php echo lang('Checkins Report');?></a> -->
		        			<a href="<?php echo base_url(); ?>admin/report/today-checkin"><span class="glyphicon glyphicon-calendar"></span> <?php echo lang('Checkins Report');?></a>
		        			<!-- <a href="<?php echo base_url(); ?>admin/report/last-week-checkin"><span class="glyphicon glyphicon-calendar"></span><?php echo lang('Last Week Checkins');?></a> -->
		        		</li>
		        	<?php } if($this->lib_permission->checkactionexist('admin/report/today-checkout')){ ?>
	        		<!-- <li role="presentation" class="divider"></li> -->
		        		<li>
		        			<!-- <label><span class="glyphicon glyphicon-arrow-right"></span><?php echo lang('Checkouts Report');?></label> -->
		        			<a href="<?php echo base_url(); ?>admin/report/today-checkout"><span class="glyphicon glyphicon-calendar"></span> <?php echo lang('Checkouts Report');?></a>
		        			<!-- <a href="<?php echo base_url(); ?>admin/report/last-week-checkout"><span class="glyphicon glyphicon-calendar"></span><?php echo lang('Last week Checkouts');?></a> -->
		        		</li>
		        	<?php } if($this->lib_permission->checkactionexist('admin/report/profit-report')){ ?>
		        		<li>
		        			<a href="<?php echo base_url(); ?>admin/report/profit-report"><span class="glyphicon glyphicon-list-alt"></span> <?php echo lang('profit_report');?></a>
		        		</li>
		        	<?php } ?>	
	        		<li role="presentation" class="divider"></li>
	        		<li>
	        			<?php if($this->lib_permission->checkactionexist('admin/report/room')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/room"><span class="glyphicon glyphicon-print"></span> <?php echo lang('Rooms Report');?></a>
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/free-room')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/free-room"><span class="glyphicon glyphicon-print"></span> <?php echo lang('Free Rooms Report');?></a>
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/Busy-room')){ ?>	
	        				<a href="<?php echo base_url(); ?>admin/report/Busy-room"><span class="glyphicon glyphicon-print"></span> <?php echo lang('Busy Rooms Report');?></a>
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/payment_report')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/payment_report"><span class="glyphicon glyphicon-list-alt"></span> <?php echo lang('payment_report');?></a>
						<?php }if($this->lib_permission->checkactionexist('admin/report/payment_report')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/item_report"><span class="glyphicon glyphicon-list-alt"></span> Item Report</a>	
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/payment_report')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/banks"><span class="glyphicon glyphicon-list-alt"></span> <?php echo lang('bank_report');?></a>
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/report_room_by_date')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/report_room_by_date"><span class="glyphicon glyphicon-list-alt"></span> Report Room By Date</a>
	        			<?php } if($this->lib_permission->checkactionexist('admin/report/report_room_by_month')){ ?>
	        				<a href="<?php echo base_url(); ?>admin/report/report_room_by_month"><span class="glyphicon glyphicon-list-alt"></span> Report Room By Month</a>
	        			<?php } ?>


	        			
	        		</li>
	        	</ul>
	        </li>	        
	        
	        <li class="dropdown" id="">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('System'); ?> <b class="caret"></b></a>
	          <ul class="dropdown-menu">
	          <li role="presentation" class="dropdown-header">Hotel_Config</li>
		    	<!-- <li>
	              <a href="#" onclick="javascript:show_modal('hotel-profile')"><span class="glyphicon glyphicon-header"></span><?php echo lang('Hotel Profile');?></a>
	            </li> -->
	            <?php if($this->lib_permission->checkactionexist('admin/roomtype')){ ?>
		            <li>
		              <a href="<?php echo base_url(); ?>admin/roomtype"><span class="glyphicon glyphicon-cog"></span> <?php echo lang('Rooms Type');?></a>
		            </li>
		        <?php } if($this->lib_permission->checkactionexist('admin/staying')){ ?>
		            <li>
		              <a href="<?php echo base_url(); ?>admin/staying"><span class="glyphicon glyphicon-cog"></span> <?php echo lang('Staying Time');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin/room')){ ?>
		            <li>
		              <a href="<?php echo base_url(); ?>admin/room"><span class="glyphicon glyphicon-list-alt"></span> <?php echo lang('Rooms');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin_currencies')){ ?>
		            <li>
		            	<a href="<?php echo base_url(); ?>admin_currencies"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('Currencies');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin_currencies/exspanse_type_insert')){ ?>
		            <li>
		            	<a href="#" data-toggle="modal" data-target="#expense_types"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('expense_type');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin_currencies/expense_list')){ ?>
		            <li>
		            	<a href="<?php echo base_url(); ?>admin_currencies/expense_list"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('add_expense');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin_currencies/add_bank')){ ?>
		            <li>
		            	<a href="<?php echo base_url(); ?>admin_currencies/add_bank"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('add_bank');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin/cleaning/addHoliday')){ ?>
		            <li>
		            	<a href="#" data-toggle="modal" data-target="#myHoliday"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('add_holiday');?></a>
		            </li>
	            <?php } if($this->lib_permission->checkactionexist('admin/cleaning/list_holiday')){ ?>
		            <li>
		            	<a href="<?php echo base_url();?>admin/cleaning/list_holiday"><span class="glyphicon glyphicon-usd"></span> <?php echo lang('list_holiday');?></a>
		            </li>
	          	<?php } ?>
	          	<!-- <li role="presentation" class="divider"></li>
	             <li>
	              <a href="<?php echo base_url(); ?>admin/wizard"><span class="glyphicon glyphicon-wrench"></span> <?php echo lang('Config Wizard'); ?></a>
	            </li> -->
	          </ul>
	        </li>
	        
	                
	        
	        
	      </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div id="myHoliday" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Add Holiday</h4>
	      </div>
	      <form method="post" action="<?php echo site_url('admin/cleaning/addHoliday')?>">
		      <div class="modal-body">
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Date</label>
		        			<input class="dtpicker form-control input-sm" type="text" id="d_holiday" name="d_holiday" value="" > 
		        		</div>
		        	</div>
		        	<div class="col-md-12">
		        		<div class="form-group">
		        			<label>Description</label>
		        			<textarea rows="3" class="form-control" name="holiday_dis"></textarea>
		        		</div>
		        	</div>
		        </div>
		      </div>
		      <div class="modal-footer">
		      	<button type="submit" class="btn btn-primary">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
	     </form>
	    </div>

	  </div>
	</div>
  	<?php
  		if($this->session->flashdata('message')){
  			echo 
	        '<div class="container" style="margin-top: 60px;"><div class="alert alert-'.$this->session->flashdata('alert-type').'" role="alert">
	        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	       ' . $this->session->flashdata('message'). '
	        </div></div>';
  		
     ?>
     <style type="text/css">
     	.container.top {
		    margin-top: 10px !important;
		}
		.alert {
		    padding: 5px 15px !important;
		    margin-bottom: 0px !important;
		    border: 1px solid transparent;
		    border-radius: 4px;
		}
     </style>
     <?php 
		}
      ?>
  <!-- Hotel Profile dialog -->
  <div class="modal fade" id="hotel-profile" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="infoLabel">Hotel Profile</h4>
      </div>
      <div class="modal-body">
      
      <form class="form-horizontal" id="frm-hotel-profile" role="form" method="post">
       <div class="form-group">
        
         <label class="sr-only" for="name">Hotel Name</label>
         <input type="text" class="form-control input-sm" id="Name" Name="Name" placeholder="Hotel Name">
        
       </div>
       <div class="form-group">
        
         <label class="sr-only" for="phone1">Phone Number:</label>
         <input type="text" class="form-control input-sm" id="phone1" Name="phone_1" placeholder="Phone Number 1">
        
       </div>  
       <div class="form-group">
        
         <label class="sr-only" for="phone2">Phone Number [2]:</label>
         <input type="text" class="form-control input-sm" id="phone2" Name="phone_2" placeholder="Phone Number 2">
        
       </div>
       <div class="form-group">
        
         <label class="sr-only" for="email">Email:</label>
         <input type="text" class="form-control input-sm" id="email" Name="Email" placeholder="Email">
        
       </div>                
       <div class="form-group">
        
         <label class="sr-only" for="address">Address:</label>
         <textarea class="form-control input-sm" id="address" Name="Address" placeholder="Address:"></textarea>
        
       </div>                
       <div class="form-group">
        
         <button class="btn btn-primary btn-sm" id="btn-update-hotel-profile">Update</button>
         
       </div>
      </form>
      
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
 </div>
<!-- Hotel Profile dialog -->


<!-- Modal -->
<div class="modal fade" id="expense_types" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Expense Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin_currencies/exspanse_type_insert');?>" method="post">
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
        			<label>Expanse Type</label>
        			<input type="text" name="exspanes_type" class="form-control">
        		</div>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>