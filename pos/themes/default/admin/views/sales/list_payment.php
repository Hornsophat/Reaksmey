<style type="text/css">
	@media print{
		/*table td:nth-child(1){ display:none;} */
		table td:nth-child(1),header nav, footer,input,button,a,.slider-wrapper,.footer-scroll,.navbar,.siderbar,.panel,.box-header,.box_filter,#payment_add{
		display: none !important;

		}
		.table_wrap{
			padding: 0 2% !important;
			
		}
		.bblack{
			background: white !important;
		}
	}
</style>
<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-danger hide" id="msg">
				<p></p>
			</div>
			<div class="alert alert-success hide" id="msg_success">
				<p></p>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h2 class="blue" id="customer_name">Add Sale Payment</h2>
			<input type="hidden" id="hide_cus" value="">
		</div>
		<div class="box-content">
			<div class="row box_filter">
				<div class="col-lg-4">
					<label>Customer</label>
					<select class="form-control" name="cus" id="cus">
						<option value="">Please Select</option>
						<?php foreach ($customer as $cus): ?>
							<option value="<?php echo $cus->id ?>"><?php echo $cus->name ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="col-lg-4">
					<label>Date From</label>
					<input type="text" name="date_from" id="date_from" class="date form-control">
				</div>
				<div class="col-lg-4">
					<label>Date To</label>
					<input type="text" name="date_to" id="date_to" class="date form-control">
					
				</div>
				<div class="col-md-4">
                        <div class="form-group">
                            <?= lang("biller", "slbiller"); ?>
							<select class="form-control" name="billers" id="billers">
	                            <option value="">Please Select</option>
								<?php foreach ($billers as $cus): ?>
									<option value="<?php echo $cus->id ?>" rel='<?php echo $cus->logo; ?>' ph='<?php echo $cus->phone; ?>'><?php echo $cus->company ?></option>
								<?php endforeach ?>
							</select>
                        </div>
                    </div>
			</div>
			<div class="col-md-12" align="center">
			 <img style="max-width:100% !important" id="img" src="<?php echo base_url();?>/assets/uploads/logos/<?= $billers[0]->logo ?>">
				
			</div>
			
			<div class="col-md-12" style="margin-top:10px;margin-bottom:10px">
				<div class="well well-sm" style="margin-bottom:0px;">
					<span>
						អតិថិជន <b id='cus_name_sh'></b>
					</span>
					<span id="d_wrap" class='pull-right hide'>
						ចាប់ពី&nbsp;<b id='d_from'></b>&nbsp;ដល់<b id='d_to'></b>
					</span>
				</div>
			</div>
			<div class="row table_wrap" style="margin-top:10px;">
				<div class="col-lg-12">
					<table class="table table-bordered" id="payment_list">
						<thead>
							<tr>
								<td ><input type="checkbox" class="form-control" id="chk_all"></td>
								<td >No</td>
								<td >Reference No</td>
								<td >Date</td>
								<td >Balance</td>
							</tr>
							
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							
						</tfoot>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="payment_add">
					<div class="col-lg-4">
						<label>Amount</label>
						<input type="text" class="form-control" id="amount_usd" onkeypress="return isNumberKey(event);">
					</div>
					<!-- <div class="col-lg-4">
						<label>Amount R</label>
						<input type="text" class="form-control" id="amount_r" onkeypress="return isNumberKey(event);">
					</div> -->
					<!-- <div class="col-lg-4">
						<label>Amount B</label>
						<input type="text" class="form-control" id="amount_b" onkeypress="return isNumberKey(event);">
					</div> -->
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-lg-12">
					<div class="col-md-2 pull-right">
						<input type="button" class="btn btn-primary pull-right" value="Pay" id="btn_save">
						<a href="JavaScript:void(0);" id="export_inv" class="export_inv btn btn-success pull-right" title="Export"><i style="width:53%;" class="fa fa-file-excel-o"></i>
					       	<!-- <img style="width:53%;" src="<?php echo base_url() ?>/assets/images/icons/export.png"> -->
					    </a>
						<button id="print_rp" class="btn btn-success pull-right" title="print" ><i style="width:70%;" class=" fa fa-print"></i></button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>


<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.whicth) ? evt.whicth:evt.keyCode;
		if (charCode == 110 || charCode == 190 || charCode == 46) {
			return true;
		}
		return!(charCode > 31 && (charCode<48 || charCode>57));

	}
		$('#cus').change(function(){
		get_data();
	});
	$('#date_to').change(function(){
		get_data();
	});
	$('#date_from').change(function(){
		if ($('#date_to').val()!='') {
			get_data();
		};
		
	});

	function get_data(){
		// $('#btn_save').on('click',function(){
		// 	alert('test_click');
		// });
		var cus=$('#cus').val();
		var cus_name=$('#cus :selected').text();
		// alert(cus_name);
		var date_from=$('#date_from').val();
		var date_to=$('#date_to').val();
		
		if (date_from>date_to) {
			bootbox.alert('date_from can not bigger than date_to');
		}else{
				

			$.get("<?php echo base_url('admin/sales/get_sale_payment')?>",
			{
				cus_id:cus,
				date_from:date_from,
				date_to:date_to
			},function(data){
				// console.log(data);
				$('#payment_list tbody').html(data.tbody);
				$('#payment_list tfoot').html(data.tfoot);
				$('#cus_name_sh').text(cus_name);
				if (date_from && date_to) {
					$('#d_wrap').removeClass('hide');
				};
				$('#d_from').text(date_from);
				$('#d_to').text(date_to);
				// $('.chk_sale').iCheck();

			},'Json');
		}
	}

	$('#btn_save').click(function(){
		

		var sale_ids = $('.chk_sale:checkbox:checked').map(function () {
					        return this.value;
					    }).get();

		var cus_id = $('#cus').val();
		var msg ='';
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();
		var amount_usd = $('#amount_usd').val();
		var billers = $('#billers').val();
		// var amount_r = $('#amount_r').val();
		var amount_b = $('#amount_b').val();
		if (amount_usd == '' && amount_b=='') {
			msg= 'Please Add Amount To Pay';
			bootbox.alert(msg);
			// $('#msg').removeClass('hide');
			// $('#msg p').text(msg);
			// $("html, body").animate({ scrollTop: 0 }, 200);
			return;
		};
		if (cus_id=='') {
			msg= 'No Customer Selected';
			bootbox.alert(msg);
			// $('#msg').removeClass('hide');
			// $('#msg p').text(msg);
			// $("html, body").animate({ scrollTop: 0 }, 200);
			return;

		};
		if (sale_ids.length<1) {
			bootbox.alert('No Sale Selected');
			return;
		};
		bootbox.confirm("Confirm ?",function(result){
			// console.log(amount_usd+'-'+amount_r+'-'+amount_b);
			if (result==true) {
				$.get("<?php echo base_url('admin/sales/save_payment') ?>",
				{
					cus_id:cus_id,
					amount_usd:amount_usd,
					date_from:date_from,
					date_to:date_to,
					sale_ids:sale_ids,
					billers:billers,
					// amount_r:amount_r,
					// amount_b:amount_b
				},
				function(data){
					// console.log(data);
					if (data.d='success') {
						$('#msg_success p').text(data.d);
						setTimeout(function(){ 
						    $("#msg_success").fadeOut("slow"); 
						 }, 3000 ); 
						$('#msg_success').removeClass('hide');
						$("html, body").animate({ scrollTop: 0 }, 200);
						$('#cus').val(cus_id).change();
						
						resetAllValues()
						location.href="<?php echo site_url('admin/Sales/print_payment/') ?>"+"/"+data.rec_id;
					};
				},'Json')
			};
		});
			

		
	});
	function resetAllValues() {
	  $('#payment_add').find('input:text').val('');
	}
	$('#print_rp').click(function(){
		window.print();
	});
	$('#chk_all').on('ifChecked',function(){
		var v = $('.chk_sale');
		// console.log(v);
		v.each(function(){
			$(this).attr('checked',true);
		});
		get_total();

	});
	$('#chk_all').on('ifUnchecked',function(){
		var v = $('.chk_sale');
		v.each(function(){
			$(this).attr('checked',false);
		});
		get_total();

	});
	
	$(document).on('change','.chk_sale',function(){
		get_total();
	});

	function get_total(){
		var total_usd = 0;
		var total_b = 0;
		var chk = $('.chk_sale');
		chk.each(function(){
			var v = $(this);
			var usd = v.attr('usd');
			// var baht = v.attr('b');
			// console.log(v.attr('checked'));
			if (v.attr('checked')) {

				total_usd += parseFloat(usd);
				// total_b += parseFloat(baht);
			};
		});
		$('#amount_usd').val(formatDecimal(total_usd));
		// $('#amount_b').val(formatDecimal(total_b));
		
		
	}
	$(function(){
		$("#export_inv").on("click", function(e){
	        var export_data ='<style type="text/css">'+
	        				'table tr td:nth-child(1){'+
	        				'display:none;'+
	        				'}'+
	                        'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
	                            'font-family: Cambria;'+
	                        '}'+
	                        'th{'+
	                            'font-size: 11px;'+
	                            'font-weight: bold;'+
	                            'border:1px solid black !important;'+
	                        '}'+
	                        'td{'+
	                            'font-size: 11px;'+
	                            'border:1px solid black !important;'+
	                        '}'+
	                    '</style>';
	        export_data += $(".table_wrap").html();

	            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(export_data));
	            e.preventDefault();
	        });
	})
</script>