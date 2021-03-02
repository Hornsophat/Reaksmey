<div class="col-sm-12">
    <div class="row">
         <div class="col-sm-4 pull-right">
            <span class="top_action_button pull-right">
                <a href="JavaScript:void(0);" id="print_inv" class="print_inv btn btn-warning" title="Print">
                    Print<!-- <img src="<?php echo base_url('updatepos/img/pn.png')?>" /> -->
                </a>
                <a href="JavaScript:void(0);" id="export_inv" class="export_inv btn btn-warning" title="Export">
                    Export Exel<!-- <img src="<?php echo base_url('updatepos/img/pn.png')?>" /> -->
                </a>
            </span> 
        </div>
        <div style="text-align: left;" class="col-sm-12 pull-left">
        <?php echo form_open_multipart("admin/reports/inventory_report", 'class="form-inline"') ?>
            <!-- <form method="post" action="<?php echo base_url();?>admin/reports/inventory_report" class="form-inline"> -->
                    <div class="form-group">
                        <label for="email">Warehouse</label>
                        <select class="form-control" name="stock">
                            <option value=''>All stock</option>
                            <?php 
                            $wh_name=' All Warehouses';
                                foreach ($warehouse as $ware) {
                                    $se='';
                                    if($warehouse_id==$ware->id){
                                        $se="selected";
                                        $wh_name = $ware->name;
                                    }
                                    echo '<option value="'.$ware->id.'" '.$se.'>'.$ware->name.'</optiom>';
                                }
                            ?>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="email">Category</label>
                        <select class="form-control" name="cateogry" id="category">
                            <option value=''>All Category</option>
                            <?php 
                            $cate_name=' All category';
                                foreach ($cate as $ware) {
                                    $se='';
                                    if($cate_id==$ware->id){
                                        $se="selected";
                                        $cate_name = $ware->name;

                                    }
                                    echo '<option value="'.$ware->id.'" '.$se.'>'.$ware->name.'</optiom>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Sub-Category</label>
                        <select class="form-control" name="scateogry" id="scategory">
                            <option value=''>All Sub-Category</option>
                            <?php 
                            $scate_name=' All Subcategory';
                                foreach ($scate as $ware) {
                                    $se='';
                                    if($scate_id==$ware->id){
                                        $se="selected";
                                        $scate_name = $ware->name;

                                    }
                                    echo '<option value="'.$ware->id.'" '.$se.'>'.$ware->name.'</optiom>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">ចាប់ពីថ្ងៃ ទី </label>
                         <div data-date-format="yyyy-mm-dd" class="input-group input-append">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <input type="text" style="width: 120px;" id="last_date" name="first_date" value="<?php echo $fdate; ?>" class="form-control b_date">
                            
                        </div>
                    </div>
                    <div class="form-group eventForm">
                        <label for="pwd"> ដល់ថ្ងៃ&#8203; ទី  </label>
                        <div data-date-format="yyyy-mm-dd" class="input-group input-append">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <input type="text" style="width: 120px;" id="last_date" name="last_date" value="<?php echo $tdate; ?>" class="form-control e_date">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Search" class="btn btn-info">
                    </div>
                    
              </form>

        </div>
    </div>
</div>

<div class="col-sm-12" id="inv_print" style="padding-top:20px;">
 <div class="header" style="height: 100px; width: 100%;">
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
            <div class="col-sm-12">
                <div class="row">
                   
                    <div class="col-sm-4">
                        <!-- <img src="<?php echo base_url();?>updatepos/img/kpg.png"> -->
                    </div>
                    <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">INVENTORY REPORT</div>
                    <?php 
                        if($warehouse_id!=''){
                            // $row=$this->db->where('id',$where_id)->get('warehouses')->row();
                            echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">WAREHOUSE : '.$wh_name.'</div>';
                        }
                            echo '<div class="col-sm-6">';
                            echo '<div class="col-sm-12 pull-left" style="text-align: left; font-size:14px;"><label>Date : '.$fdate.' To '.$tdate.'</label></div>';
                            echo '<div class="col-sm-12 pull-left" style="text-align: left; font-size:14px;"><label>Print Date : '.date('Y-m-d H:i:s').'</label></div>';
                            echo '<div class="col-sm-12 pull-left" style="text-align: left; font-size:14px;"><label>Print By : '.$this->session->userdata('username').'</label></div>';
                            echo '</div><div class="col-sm-6">';
                             
                             echo '<div class="col-sm-12 pull-right" style="text-align: right; font-size:14px;"><label>Category : '.$cate_name.'</label></div>';
                            echo '<div class="col-sm-12 pull-right" style="text-align: right; font-size:14px;"><label>Subcategory: '.$scate_name.'</label></div>';
                            echo '</div>';

                     ?>
                    
                </div>
            </div>
        </div>
    </div>
    <p style="clear: both"></p>
    <br>
	<table class="table table-bordered table-striped">
	    <thead>
	      <tr>
            <th>No</th>
            <!-- <th>Shipment No</th> -->
            <th>Category</th>
            <!-- <th>Product Line</th> -->
            <th>Barcode</th>
	        <!-- <th>SKU</th> -->
	        <th>Description</th>
	        <th>Total Order</th>
	        <th>Sale</th>
            <th>Total Remain</th>
	        <!-- <th>Balance</th> -->
	        <th>Unit Cost</th>
            <th>Unit Price</th>
            <th>Total Cost</th>
	        <th>Total Price</th>

	      </tr>
	    </thead>
	    <tbody>
	   		<?php 
            $i=0;
            // $total_unit=0;
            $total_stock=0;
            $total_order=0;
            $total_sale=0;
            $total_amount=0;
            $total_remain=0;
	   			foreach ($stock as $s) {
                    // $quantity=$this->site->getproductquantity($s->id,$tdate,$warehouse_id);
                    // $cost=$this->site->getcost($s->id,$tdate,$warehouse_id);
                    $total_order += $s->total_po;
                    // $total_stock += $quantity;
                    $total_sale += $s->total_sale;
                    $total_amount += $s->quantity * $s->cost;
                    $i++;

                    $total_remain = $s->total_po - $s->total_sale;


	   		?>
		      <tr>
                <td class="text-left"><?php echo $i;?></td>
                <td class="text-left"><?php echo $s->cate_name;?></td>
                <!-- <td class="text-left"><?php //echo $s->scate_name;?></td> -->
                <td class="text-left"><?php echo $s->code;?></td>
		        <!-- <td class="text-left"><?php //echo $s->sku;?></td> -->
		        <td class="text-left"><?php echo $s->name;?></td>
                <td class="text-right"><?php echo number_format($s->total_po,2);?></td>
		        <td class="text-right"><?php echo number_format($s->total_sale);?></td>
                <td class="text-right"><?php echo number_format($total_remain)?></td>
		        <!-- <td class="text-center"><?php //echo number_format($s->total_po,2);?></td> -->
		        <td class="text-right"><?php echo number_format($s->cost,2);?></td>
                <td class="text-right"><?php echo number_format($s->price,2);?></td>
                <td class="text-right"><?php echo number_format($s->cost * $s->total_po,2);?></td>
		        <td class="text-right"><?php echo number_format($s->price * $s->total_sale,2);?></td>
		      </tr>
		    <?php 
		    	}
		    ?>
              <tr>
                <th class="text-center"><labe>Total</labe></th>
                <th class="text-left"></th>
                <!-- <th class="text-center"></th> -->
                <th class="text-center"></th>
                <!-- <th class="text-center"></th> -->
                <th class="text-center"></th>
                <th class="text-right"><labe><?php echo $total_order?></labe></th>
                <th class="text-right"><labe><?php echo $total_sale?></labe></th>
                <th class="text-right"><label></label></th>
                <th class="text-right"><labe><?php echo $total_stock?></labe></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"></th>
              </tr>
	    </tbody>
	</table>
</div>

<script src="<?php echo base_url('update/js/bootstrap-datepicker1.js')?>"></script> 
<script src="<?php echo base_url('update/js/jquery.PrintArea.js')?>"></script>  
<script src="<?php echo base_url('update/js/gScript.js')?>"></script>  
<script type="text/javascript">
    
 $(".b_date,.e_date").datepicker({
            language: 'en',
            pick12HourFormat: true,
            format:'yyyy-mm-dd'
        });

 $(function(){
    $("#print_inv").on("click", function(){
        var export_data = $("#inv_print").html();
            export_data +='<style type="text/css">'+
                            'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
                                'font-family: Cambria;'+
                            '}'+
                            'th{'+
                                'font-size: 11px;'+
                                'font-weight: bold;'+
                            '}'+
                            'td{'+
                                'font-size: 11px;'+
                            '}'+
                        '</style>';
        var title = "";
        gsPrint(title,export_data);
    });
    $("#export_inv").on("click", function(e){
                     var export_data = $("#inv_print").html();
                    export_data +='<style type="text/css">'+
                                    'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
                                        'font-family: Cambria;'+
                                    '}'+
                                    'th{'+
                                        'font-size: 11px;'+
                                        'font-weight: bold;'+
                                    '}'+
                                    'td{'+
                                        'font-size: 11px;'+
                                    '}'+
                                '</style>';
                        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(export_data));
                        e.preventDefault();
    });
    $('.search_stock').change(function(){
        var id = $(this).val();
        window.location.href = "<?php echo site_url('reports/stock_report')?>"+"/"+id;
    });
    $('#category').change(function(){
        var id = $(this).val();
        $.ajax({
            type: "get", async: false,
            url: "<?= site_url('products/getSubCategories') ?>/" + id,
            dataType: "json",
            success: function (scdata) {
                var d="<option value=''>All Sub-Category</option>";
                if (scdata != null) {
                    for(var i=0;i<scdata.length;i++){
                        // if(scdata[i].id!=undefined){
                            d+="<option value='"+scdata[i].id+"'>"+scdata[i].text+"</option>";

                        // }
                    }
                }
                $('#scategory').html(d);
            }
        });
    });

});

</script>