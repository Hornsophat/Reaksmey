<style type="text/css">
	table hr{
		padding: 0;
		margin: 1%;
	}
	@media print{
		header nav, footer,input,button,a,.slider-wrapper,.footer-scroll,.navbar,.siderbar,.panel{
		display: none !important;
		}
		.bblack{
			background: white !important;
		}
	}
</style>
<div class="col-md-12">
	<button id="print_rp" class="btn btn-success pull-right">Print</button>

	<a href="JavaScript:void(0);" id="export_inv" class="export_inv btn btn-success pull-right" title="Export">
        Export Excel
    </a>
</div>
<div class="col-md-12 " style="margin-top:2%">
    <div class="panel panel-info">
        <div
            class="panel-heading"><?= lang('filter') ?></div>
        <div class="panel-body" style="padding: 5px;">
        	<!-- <div class="col-md-12">
        		<div class="col-md-3">
                    <input type="radio" name="category_id" value="" id="category_id" class="form-control category_id" checked="">
                    &nbsp;
                    <?php echo 'ទាំងអស់' ?>
                </div>
	            <?php foreach ($category as $cate): ?>
	                <div class="col-md-3">
	                    <input type="radio" name="category_id" value="<?php echo $cate->id ?>" id="category_id" class="form-control category_id">
	                    &nbsp;
	                    <?php echo $cate->name ?>
	                </div>
	            <?php endforeach ?>
        	</div> -->
            <!-- <div class="col-md-4">
            	<label>
            		<?php echo lang('product') ?>
            	</label>
            	<select class="form-control" id="pro_sel">
            		<option value="">Select</option>
            	</select>
            </div> -->
            <div class="col-md-4">
            	<label>
            		<?php echo lang('date_from') ?>
            	</label>
            	<input type="text" class="form-control" id="date_from" value="<?php echo date('Y-m-01') ?>">
            </div>
            <div class="col-md-4">
            	<label>
            		<?php echo lang('date_to') ?>
            	</label>
            	<input type="text" class="form-control" id="date_to" value="<?php echo date('Y-m-d') ?>">
            </div>
            
        </div>
    </div>

</div>


<div class="col-md-12 table_wrap" style="margin-top:2%">
	<table class="table table-bordered" id="p_table">
		<thead>
			<th><?php echo lang('date') ?></th>
			<th><?php echo lang('product_code') ?></th>
			<th><?php echo lang('product_name') ?></th>	
			<!-- <th><?php echo lang('qty_purch') ?></th> -->
			<th><?php echo lang('qty_sold') ?></th>
			<!-- <th><?php echo lang('cost') ?></th> -->
			<!-- <th><?php echo lang('price')?></th> -->
			<th><?php echo lang('total_cost') ?></th>
			<th><?php echo lang('total_price') ?></th>
			<th><?php echo lang('profit') ?></th>
			<!-- <th><?php echo lang('loss') ?></th> -->
			<!-- <th>Total</th> -->
		</thead>
		<tbody>
			<!-- <tr>
				<td colspan="7" style="text-align:center">No Data</td>
			</tr> -->
		</tbody>
		<tfoot>
			
		</tfoot>
	</table>
</div>
<script type="text/javascript" src="<?= $assets ?>js/hc/bootstrap-datepicker1.js;?>"></script>
<script type="text/javascript" src="<?= $assets ?>js/hc/jquery.PrintArea.js;?>"></script>
<script type="text/javascript" src="<?= $assets ?>js/hc/gScript.js;?>"></script>

 
<script type="text/javascript">
	$("#date_from,#date_to").datepicker({
            language: 'en',
            pick12HourFormat: true,
            format:'yyyy-mm-dd'
        });
	$(document).ready(function(){
		get_data();
		get_product();
		// $('#p_table').dataTable().fnUpdate();
	})
	 $('.category_id').on("ifClicked",function(){
	 	// console.log($(this).val());
        get_data($(this).val());
        get_product($(this).val());
		// $('#p_table').dataTable().fnUpdate();

    });
	 $('#pro_sel').change(function(){
	 	get_data();
	 });
	 $('#date_from,#date_to').on("change",function(){
	 	// console.log($(this).val());
        get_data();
		// $('#p_table').dataTable().fnUpdate();

    });
	function get_data(cid){
		// var cat_id = $('input[name=category_id]:checked').val();
		cat_id = cid;
		var pid = $('#pro_sel').val();
		var date_from = $('#date_from').val();
		var date_to = $('#date_to').val();
		$.get("<?php echo site_url('reports/get_pl')?>",
		{
			cat_id:cat_id,
			pid:pid,
			date_from:date_from,
			date_to:date_to
		},function(data){
			console.log(data);
			$('#p_table tbody').html(data.table);
			$('#p_table tfoot').html(data.tfoot);
			// $('#p_table').dataTable().fnDraw();
			// console.log($('#p_table').dataTable())
			

		},'Json');


	}
	function get_product(cat_id){
		
		$.get("<?php echo site_url('reports/get_product_filter')?>",
			{
				cat_id:cat_id
			},function(data){
				// console.log(data);
				$('#pro_sel').html(data.products);

			},'Json');
		
	}
	$(function(){
		$("#export_inv").on("click", function(e){
	        var export_data ='<style type="text/css">'+
	                        'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
	                            'font-family: Cambria;'+
	                        '}'+
	                        'th{'+
	                            'font-size: 11px;'+
	                            'font-weight: bold;'+
	                            'border:1px solid black;'+
	                        '}'+
	                        'td{'+
	                            'font-size: 11px;'+
	                            'border:1px solid black;'+
	                        '}'+
	                    '</style>';
	            export_data += $(".table_wrap").html();

	            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(export_data));
	            e.preventDefault();
	        });
	})
	$('#print_rp').click(function(){
		window.print();
	});
</script>