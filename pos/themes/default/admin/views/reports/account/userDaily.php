<?php 
$fdate='';
$ldate='';
if (isset($_GET['first_date']))
  $fdate = $_GET['first_date'];
if (isset($_GET['last_date']))
  $ldate = $_GET['last_date'];
?>
<div class="report">
  <span class="top_action_button">
    <a href="JavaScript:void(0);" id="print_inv" class="print_inv" title="Print">
      <img src="<?php echo base_url('update/img/printer-icon.png')?>" />
    </a>
  </span>   

  <div class="header" style=" width: 100%;">
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-10 pull-right" style="text-align: right;">
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/reports/customerDailySale');?>">
              <div class="form-group">
                <label for="email">អតិថិជន </label>
                <select class="form-control" name="customer">
                  <option value="">Please Select</option>
                  <?php 
                  foreach ($people as $row) {
                    $sel='';
                    if($customer == $row->id){
                      $sel='selected';
                    }
                    echo "<option value='$row->id' $sel>$row->name</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group hide">
                <label for="email">ចាប់ពីថ្ងៃ ទី </label>
                <div class="input-group date input-append" id="fromdatetime" data-date-format="yyyy-mm-dd hh:ii">
                  <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                  <input type="text" class="form-control b_date" value="<?php echo $fdate ;?>" name="first_date" class="datepicker form_datetime" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group eventForm hide">
                <label for="pwd"> ដល់ថ្ងៃ​ ទី  </label>
                <div class="input-group date input-append" id="todatetime" data-date-format="yyyy-mm-dd hh:ii">
                  <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                  <input type="text" class="form-control e_date" value="<?php echo $ldate ;?>" name="last_date" class="datepicker form_datetime" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-info" value="Search" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div> 
    <div class="modal-body" id="inv_print">
      <div class="header" style="height: 100px; width: 100%;">
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-4">
                <!-- <img src="<?php echo base_url();?>updatepos/img/kpg.png"> -->
              </div>
              <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">User Daily Sale</div>
              <?php if(isset($_GET['first_date'])){
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">Report From '.date_format(date_create($_GET['first_date']),'d-M-Y H:i').' ដល់ '.date_format(date_create($_GET['last_date']),'d-M-Y H:i').'</div>';
              }else{
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">Report From : '.date('d-M-Y').'</div>';
              } ?>
              <?php 
              if(isset($supplierrow->id)){
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">អតិថិជន : '.$supplierrow->company.'</div>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-sm-12">
          <style type="text/css">
            #head tr th{ text-align: center !important; }
          </style>
          <table class="table table-bordered" style=" border-left: none;">
            <tbody id="head">
              <tr>
                <th >No</th>
                <th >Date</th>
                <th >Items</th>
               <!--  <th >Unit Price</th>
                <th >Quatity</th> -->
                <th >Table</th>   
                <th >SubTotal</th>   
              </tr>
            </tbody>
            <tbody>
            <?php 
            $i=0;
            $total = 0;
            $total1 = 0;
            $total2 = 0;
            foreach ($udaily_sale as $udialy) {  
                $total_table += count($udialy->sale_table);
                $total_amount += $udialy->subtotal;
            $i++;
              ?>
              <tr>
                <td   align="center"><?php echo $i ?></td>
                <td  align="center"><?php echo $udialy->sdate ?></td>
                <td   align="left"><?php echo $udialy->product_name ?></td>
                <td   align="center"><?php echo $udialy->real_unit_price ?></td>
                <td   align="center"><?php echo number_format( $udialy->quantity,0)?></td>
                <td  align="left"><?php echo $udialy->sale_table ?></td> 
                <td  align="center"><?php echo number_format($udialy->subtotal,2); ?></td> 
              </tr>
              <?php } ?>
              <tr >
                <td colspan="5"  style="font-size: s11px; text-align: right; background: #cbcac4;">Total</td>
                <td align="center" style="font-weight: bold; "><?php  echo number_format($total_table,0); ?></td>
                <td align="center" style="font-weight: bold;font-size:25px !important;">$&nbsp;&nbsp;<?php echo number_format($total_amount,2); ?></td>
              </tr>
            </tbody>
          </table>
          <p style="text-align: right; font-size: 12px;">រាជធានីភ្នំពេញ ថ្ងៃទី............ខែ.................ឆ្នាំ ២០១....</p>
          <h4 style="text-align: right; padding-right: 99px; font-size: 12px; font-weight: bold;font-family: khmer OS Muol">ហត្ថលេខា</h4><br/><br/>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= site_url('update/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?= site_url('update/js/moment-with-locales.js'); ?>"></script>
<!-- <script src="<?php echo base_url('update/js/bootstrap-datepicker1.js')?>"></script>  -->
<script src="<?php echo base_url('update/js/jquery.PrintArea.js')?>"></script>  
<script src="<?php echo base_url('update/js/gScript.js')?>"></script>  
<script type="text/javascript">

  $(document).ready(function() {
    $("#fromdatetime, #todatetime").datetimepicker();
  });

  // $(".b_date,.e_date").datepicker({
  //   language: 'en',
  //   pick12HourFormat: true,
  //   format:'yyyy-mm-dd'
  // });

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
  });

</script>

