<div class="col-lg-12">
	<div class="box">
		<div class="box-header">
			<h2 class="blue" id="customer_name"><?php echo lang('list_sale_payment') ?></h2>
			<input type="hidden" id="hide_cus" value="">
		</div>
		<div class="box-content">
			<div class="row" style="margin-top:10px;">
				<div class="col-lg-12">
					<table class="table table-bordered" id="payment_list">
						<thead>
							<tr>
								<th >No</th>
								<th >Customer</th>
								<th >Date</th>
								<th >Paid</th>
								<th >Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0;foreach ($record as $re): $i++;?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $re->company ?></td>
									<td><?php echo date('d/m/Y',strtotime($re->date)) ?></td>
									<td><?php echo $this->sma->formatDecimal($re->amount_usd) ?>($)</td>
									<td style="width:9%"><a target="_blank" href="<?php echo site_url('admin/sales/print_payment/'.$re->rec_id) ?>">View Voucher</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							
						</tfoot>
					</table>
				</div>
			</div>
			
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
	    $('#payment_list').DataTable();
	});
</script>