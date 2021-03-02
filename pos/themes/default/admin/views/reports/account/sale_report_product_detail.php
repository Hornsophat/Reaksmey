<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-4 pull-left">
            <span class="top_action_button">
                 <a href="JavaScript:void(0);" id="print_inv" class="print_inv btn btn-warning" title="Print">
                    Print<!-- <img src="<?php echo base_url('updatepos/img/pn.png')?>" /> -->
                </a>
                <a href="JavaScript:void(0);" id="export_inv" class="export_inv btn btn-warning" title="Export">
                    Export Exel<!-- <img src="<?php echo base_url('updatepos/img/pn.png')?>" /> -->
                </a>
            </span>
        </div>
    </div>
    <div class="row">
        <div style="text-align: right;" class="col-sm-12">
              <form action="<?php echo site_url('admin/reports/customeers_transaction')?>" method="get" role="form" class="form-inline">
                    <div class="form-group">
                        <label for="email">Customer</label>
                        <select class="form-control" name="customer_id">
                            <option value="">Select Customer</option>
                            <?php 
                                foreach ($people as $row) {
                                     $sel = '';
                                    if($customer_id==$row->id){
                                        $sel ='selected';
                                    }
                                    echo "<option value='$row->id' $sel>$row->name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Warehouse</label>
                        <select class="form-control warehouse_all" name="warehouse_all" style="width:150px;" required>
                            <!-- <option>select all</option> -->
                             <?php 
                                foreach ($warehouse_all as $rows) {
                                     $sel = '';
                                    if($rows->id){
                                        $sel ='selected';
                                    }
                                    echo "<option value='$rows->id' $sel>$rows->name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Categoty</label>
                        <select class="form-control category" name="category" style="width:100px;" required>
                            <option value='all'>All Category</option>
                            <?php 
                                foreach ($category as $ca) {
                                    $se='';
                                    if($category_id==$ca->id)
                                        $se="selected";
                                    echo '<option value="'.$ca->id.'" '.$se.'>'.$ca->name.'</optiom>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Product Items</label>
                        <select class="form-control product_id" name="product_id">
                            <option value="">Select  Products</option>
                            <?php 
                                foreach ($products as $row) {
                                    $sel = '';
                                    if($product_id == $row->code){
                                        $sel ='selected';
                                    }
                                    echo "<option value='$row->code' $sel>$row->name ($row->code)</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="email">Product To</label>
                        <select class="form-control product_id" name="product_to">
                            <option value="">Select  Products</option>
                            <?php 
                                foreach ($products as $row) {
                                    $sel = '';
                                    if($product_to == $row->code){
                                        $sel ='selected';
                                    }
                                    echo "<option value='$row->code' $sel>$row->name ($row->code)</option>";
                                }
                            ?>
                        </select>
                    </div> -->
                     <div class="form-group">
                        <label for="email">Date From</label>
                         <div data-date-format="yyyy-mm-dd" class="input-group input-append">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <input type="text" style="width: 120px;" value="<?php echo $first_date ?>" id="last_date" name="first_date" value="" class="form-control b_date">
                            
                        </div>
                    </div>
                    <div class="form-group eventForm">
                        <label for="pwd"> Date To </label>
                        <div data-date-format="yyyy-mm-dd" class="input-group input-append">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <input type="text" style="width: 120px;" value="<?php echo $last_date ?>" id="last_date" name="last_date" value="" class="form-control e_date">
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Search" class="btn btn-info">
                    </div>
                    
              </form>

        </div>
    </div>
</div>
<div style="clear: both"></div>
<div class="col-sm-12" id="inv_print" style="padding-top:20px;">
   
    <div class="header" style="height: 100px; width: 100%;">
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
            <div class="col-sm-12">
                <div class="row">
                   
                    <div class="col-sm-4">
                        <!-- <img src="<?php echo base_url();?>updatepos/img/kpg.png"> -->
                    </div>
                    <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">របាយការណ៍ទិញផលិតផលអតិថិជន</div>
                    <?php 
                        echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">របាយការណ៍ចាប់ពីថ្ងៃ '.date_format(date_create($first_date),'d-M-Y').' ដល់ '.date_format(date_create($last_date),'d-M-Y').'</div>';
                     ?>
                    
                </div>
            </div>
        </div>
    </div>
    <p style="clear: both"></p>
    <br>
	<table class="table table-bordered table-striped" style=" border-left: none;">
	    <thead>
	      <tr>
            <th>Product Code</th>
            <th>Referebce Code</th>
	       
            <th>Product Name</th> 
            <th>Customer ID.</th>
            <th>Unit</th> 

            <th>Qty Sold</th>

            <th>Selling Price</th>
	        <!-- <th>Item Description</th> -->
            <th>Amount Sold</th>
	        <!-- <th>Profit</th> -->
	      </tr>
	    </thead>
	    <tbody>
          <?php 
                $i=0;
                $p_cost=array();
                foreach ($customer as $cus) {
                    $total_qty += $cus->total_qty;
                    $total_cast += $cus->total_amount;
                    $total_qty_all += $cus->total_qty;
                    $total_cast_all += $cus->total_amount;

                    
                   
                  ?>
        	      <tr>
                       <td ><?php echo $cus->product_code;?></td>
        	           <td ><?php echo $cus->ref_code;?></td>
                       <td ><?php echo $cus->product_name;?></td>
                       <td ><?php echo $cus->customer;?></td>
                       <td ><?php echo $cus->unit;?></td>

                       <td class="text-right"><?php echo substr($cus->total_qty,0,-5);?></td>
        	           <td class="text-right"><?php echo '$ '.number_format(($cus->total_amount/$cus->total_qty),0);?></td>
        	           <td class="text-right"><?php echo '$ '.number_format($cus->total_amount,0);?></td>
        	      </tr>
                  <?php 
                    if($i!=0 && ($cus->customer_id!=$customer[$i+1]->customer_id)){
                  ?>
                     <tr>
                        <th class="text-right">Total</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-right"><?php echo $total_qty;?></th>
                        <th class="text-right"></th>
                        <th class="text-right"><?php echo '$ '.number_format($total_cast,2);?></th>
                      </tr>
                  <?php
                    $total_cost_cust=0;
                     $total_qty=0;
                     $total_cast=0;
                    }
                  ?>
          <?php 
            $i++;   }
          ?>
          <tr>
            <th class="text-right" colspan="4" style="background-color:#89bfe5 !important;">REPORT TOTAL</th>
            <th class="text-right"><?php echo $total_qty_all;?></th>
            <th class="text-center"></th>

            <th class="text-right" colspan="2" style="color:#ff0000 !important;"><?php echo '$ '.number_format($total_cast_all,2);?></th>
          </tr>
	      
	    </tbody>
	</table>
</div>

<script src="<?php echo site_url('update/js/bootstrap-datepicker1.js')?>"></script> 
<!-- <script src="<?php echo site_url('updatepos/js/jquery.PrintArea.js')?>"></script>  
<script src="<?php echo site_url('updatepos/js/gScript.js')?>"></script>   -->
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
             
             $('.category').change(function(){
                var id = $(this).val();
                var wid = $('select.warehouse_all').val();
                // alert(wid);
                $.ajax({
                    type: "get", 
                    async:false,
                    url: "<?= site_url('admin/products/getprodutcate') ?>/" + id,
                    data:{wid:wid},
                    dataType: "json",
                    success: function (scdata) {
                        // console.log(scdata);
                        var d="<option value=''>All Products</option>";
                        if (scdata != null) {
                            for(var i=0;i<scdata.length;i++){
                                // if(scdata[i].id!=undefined){
                                    d+="<option value='"+scdata[i].code+"'>"+scdata[i].name+"("+scdata[i].code+")</option>";

                                // }
                            }
                        }
                        $('select.product_id').html(d);
                    }
                });
    });
});

</script>