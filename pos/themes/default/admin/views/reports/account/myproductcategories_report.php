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
    <a href="JavaScript:void(0);" id="export_inv" class="export_inv btn btn-warning" title="Export">
                    Export Exel<!-- <img src="<?php echo base_url('updatepos/img/pn.png')?>" /> -->
                </a>
  </span> 

  <div class="header" style=" width: 100%;">
    <div class="row" style="padding-left: 15px; padding-right: 15px;">
      <div class="col-sm-12">
        <div class="row">         
          <div class="col-sm-10 pull-right" style="text-align: right;">
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/reports/myproductcategories_report');?>">
              <div class="form-group">
                <label for="email">ប្រភេទទំនិញ</label>
                <?php $cat[''] = "";
                $cat[''] = 'Select Category';
                foreach ($categories as $category) {
                  $cat[$category->name] = $category->name;
                }
                echo form_dropdown('category', $cat, (isset($_GET['category']) ? $_GET['category'] : ''), 'class="form-control select" id="category"')
                ?>
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
              <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">របាយការណ៍ប្រាក់ចំណេញរបស់ផលិតផល</div>
              <?php if(isset($_GET['first_date'])){
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">របាយការណ៍លក់ចាប់ពីថ្ងៃ '.date_format(date_create($_GET['first_date']),'d-M-Y H:i').' ដល់ '.date_format(date_create($_GET['last_date']),'d-M-Y H:i').'</div>';
              }else{
                echo '<div class="col-sm-12" style="text-align: center; font-size:14px;">របាយការណ៍លក់ប្រចាំថ្ងៃ : '.date('d-M-Y').'</div>';
              } ?>
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
            <tbody id="head" style="background:#34b4d4 !important;">
              <tr>
                <th rowspan="2">ល.រ</th>
                <!-- <th rowspan="2">កាលបរិច្ឆេទ</th> -->
                <th rowspan="2">បាកូដ្ឋទំនិញ</th>
                <th rowspan="2">ឈ្មោះទំនិញ</th>
                <th rowspan="2">ប្រភេទទំនិញ</th>
                <th colspan="5">សរុប</th>
              </tr>
              <tr>
                <th>ចំនួន</th>
                <th>ថ្លៃដើម</th>
                <th>ថ្លៃលក់ចេញ</th>
                <th>បញ្ចុះតម្លៃ</th>
                <th>ប្រាក់ចំនេញ</th>
              </tr>
            </tbody>
            <tbody>
              <?php 
              // $f='2016-05-22';
              // $t='2016-05-24';
              // $sql="SELECT * From sma_sales WHERE date BETWEEN '$f' AND '$t' ORDER BY id DESC";
              // $filter_report=$this->db->query($sql)->result();
              $i=0;
              $total = 0;
              $total1 = 0;
              $total2 = 0;
              $total3 = 0;
              $dis = 0;
              $last_amount = 0;
              foreach ($getrp as $filter_report) { 
                // var_dump($filter_report);die();

                $first_price=$filter_report->tcost*$filter_report->total_qty;
                if ($filter_report->pdis > 0) {
                  $sale_p = $filter_report->sale_price+$filter_report->pdis;
                }else{
                  $sale_p = $filter_report->sale_price;
                }
                $total_item_dis = $filter_report->tidis;
                $dis=$filter_report->pdis + $total_item_dis;
                $last_amount = $sale_p-($first_price+$dis);
                // var_dump($dis);

                $total = $total + $first_price;
                $total1 = $total1 + $sale_p;
                $total2 = $total2 + $dis;
                $total3 = $total3 + $last_amount;

                $i++;
                ?>
                <tr>
                  <td   align="center"><?php echo $i ?></td>
                  <!-- <td  align="center"><?php echo $filter_report->saledate ?></td> -->
                  <td   align="center"><?php echo $filter_report->product_code ?></td>
                  <td  align="center"><?php echo $filter_report->product_name ?></td>
                  <td  align="center"><?php echo $filter_report->name ?></td>
                  <td  align="center"><?php echo number_format($filter_report->total_qty,2) ?></td>
                  <td   align="center"><?php echo number_format($first_price,2);?></td>
                  <td   align="center"><?php echo number_format($sale_p,2);?></td>
                  <td align="center"><?php echo number_format($dis,2); ?></td>
                  <td  align="center"><?php echo number_format($last_amount,2) ?></td>
                </tr>
                <?php } ?>
                <tr >
                  <td colspan="5"  style="font-size: 11px; text-align: right; background: #cbcac4;">សរុប</td>
                  <td align="center" style="font-weight: bold; "><?php  echo number_format($total,2); ?></td>
                  <td align="center" style="font-weight: bold;"><?php echo number_format($total1,2); ?></td>
                  <td align="center" style="font-weight: bold;;"><?php  echo number_format($total2,2); ?></td>
                  <td align="center" style="font-weight: bold;;"><?php  echo number_format($total3,2); ?></td>
                </tr>
              </tbody>
              <!-- <tbody style="border:1px solid #E6E6E6;">
                <tr>
                    <td style="border-left: none; border-bottom: 0px; border-left: none;" colspan="5" rowspan="3"></td>
                    <td style="font-size: 18px; text-align: right; background: #cbcac4;border-bottom: 1.5px solid #E6E6E6;">សរុប</td>
                    <td align="center" style="font-weight: bold; border-bottom: 1.5px solid #E6E6E6;"><?php  echo $total; ?></td>
                    <td align="center" style="font-weight: bold;border-bottom: 1.5px solid #E6E6E6;"><?php echo $total1; ?></td>
                    <td align="center" style="font-weight: bold;border-bottom: 1.5px solid #E6E6E6;"><?php  echo $total2; ?></td>
                </tr>                 
              </tbody> -->
          </table>
          <p style="text-align: right; font-size: 12px;">រាជធានីភ្នំពេញ ថ្ងៃទី............ខែ.................ឆ្នាំ ២០១....</p>
          <h4 style="text-align: right; padding-right: 99px; font-size: 12px; font-weight: bold;font-family: khmer OS Muol">ហត្ថលេខា</h4><br/><br/>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= site_url('update/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?= site_url('update/js/moment-with-locales.min.js'); ?>"></script>
<!-- <script src="<?php echo base_url('update/js/bootstrap-datepicker1.js')?>"></script> -->
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

</script>

