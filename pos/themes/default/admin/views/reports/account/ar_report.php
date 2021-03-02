<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
-->

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script> -->
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
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/reports/account_receiveable');?>">
              <div class="form-group">
                <label for="email">អតិថិជន</label>
                <select class="form-control" name="customer_paid">
                  <option value="">Please Select</option>
                  <?php 
                  foreach ($cus_data as $row) {
                    $sel='';
                    if($customerrow->id ==  $row->id){
                      $sel='selected';
                    }
                    // $sel='selected';
                    echo "<option value='$row->id' $sel>$row->name</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="email">ចាប់ពីថ្ងៃ ទី </label>
                <div class="input-group date input-append" id="fromdatetime" data-date-format="yyyy-mm-dd hh:ii">
                  <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                  <input type="text" class="form-control b_date" value="<?php echo $fdate ;?>" name="first_date" class="datepicker form_datetime" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group eventForm">
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
              <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">បញ្ញឺអ្នកជំពាក់លុយ</div>
              <?php if(isset($_GET['first_date'])){
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">របាយការណ៍ចាប់ពីថ្ងៃ '.date_format(date_create($_GET['first_date']),'d-M-Y H:i').' ដល់ '.date_format(date_create($_GET['last_date']),'d-M-Y H:i').'</div>';
              }else{
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">របាយការណ៍ប្រចាំថ្ងៃ : '.date('d-M-Y').'</div>';
              } ?>
              <?php 
              if(isset($customerrow->id)){
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">អតិថិជន : '.$customerrow->company.'</div>';
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
                <th>លេខអតិថិជន</th>
                <th>ឈ្មោះអតិថិជន</th>
                <!-- <th>CUS Name</th> -->
                <th>លេខទូរស័ព្ទ</th>
                <!-- <th>CUS Email</th> -->
                <th>អាស័យដ្ឋាន</th>
                <th>ចំនួន</th>
              </tr>
            </tbody>
            <tbody>
            <?php 
            $total=0;
            foreach ($payment_re as $cus_re) {  
                $unpaid = $cus_re->gtotal - $cus_re->paid_total;
                $total+=$unpaid;
              ?>
              <tr>
                <td  align="left"><?php echo $cus_re->customer_id; ?></td>
                <!-- <td   align="left"><?php echo $cus_re->company; ?></td> -->
                <td  align="left"><a target="_blank" href="<?php echo base_url('admin/reports/sale_deatail/'.$cus_re->customer_id);?>"><?php echo $cus_re->company; ?></a></td> 
                <td  align="left"><?php echo $cus_re->phone;?></td> 
                <!-- <td  align="left"><?php echo $cus_re->email;?></td> -->
                <td  align="left"><?php echo $cus_re->address;?></td>
                <td  align="right"><?php echo number_format($unpaid,2);?> R</td>
              </tr>

              <?php } ?>
              <tr >
                <td colspan="4"  style="font-size: 11px; text-align: right; background: #cbcac4;">សរុប</td>
                <td align="right" style="font-weight: bold; "><?php echo number_format($total,2);?> R</td>
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


