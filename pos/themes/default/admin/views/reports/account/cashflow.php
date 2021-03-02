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
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/reports/cash_flow');?>">
              <div class="form-group text-left">
              </div>
              <div class="form-group">
                <label for="email">ចាប់ពីថ្ងៃ ទី </label>
                <div class="input-group date input-append">
                  <span class="input-group-addon add-on" style="padding: 1px 10px;"><i class="fa fa-calendar"></i></span>
                  <input autocomplete="off" type="text" class="form-control" value="<?php echo isset($_GET['first_date']) ? $_GET['first_date'] : date('Y-m-01');?>" name="first_date" class="date_format" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group eventForm">
                <label for="pwd"> ដល់ថ្ងៃ​ ទី  </label>
                <div class="input-group date input-append">
                  <span class="input-group-addon add-on" style="padding: 1px 10px;"><i class="fa fa-calendar"></i></span>
                  <input autocomplete="off" type="text" class="form-control" value="<?php echo isset($_GET['last_date']) ? $_GET['last_date'] : date('Y-m-d');?>" name="last_date" class="date_format" id="last_date" style="width: 140px;" />
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
              <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-family: Khmer OS Muol; font-size: 20px;">របាយការណ៍សាច់ប្រាក់</div>
              <?php if ($_GET['first_date']): ?>
                <div class="col-sm-12" style="text-align: center; font-size:14px;margin-bottom: 8px;">
                  <span>ពី&nbsp;<?= date('d-M-Y', strtotime($this->sma->fld(trim($_GET['first_date'])))); ?>&nbsp;ដល់&nbsp;<?= date('d-M-Y', strtotime($this->sma->fld(trim($_GET['last_date'])))); ?></span>
                </div>
                <?php endif ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-sm-12">
          <style type="text/css">
            #head tr th{ text-align: center !important; }
          </style>
          <style type="text/css">
            th{
              margin-left: 20%;
              font-family: Khmer OS Muol;
              font-size: 12px;
            }
            tr td{
              text-align: left;
              font-size: 13px;
            }
            tr{
              height: 30px;
            }
          </style>
          <table cellspacing="0" border="1" class="table table-bordered" style=" border-left: none;">
            <?php 
            $all_income = $delivery + $paid + $due + $other_income;
             ?>
    <tbody>
        <tr>
            <td style="min-width:50px; font-weight: bold;" colspan="5">សាច់ប្រាក់ទទួលបានពី៖</td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">ការលក់ទូរទាត់រួច</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($paid, 2)); ?></td>
            <td style="min-width:50px"></td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">ការសង</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($due, 2)); ?></td>
            <td style="min-width:50px"></td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">ការដឹក</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($delivery, 2)); ?></td>
            <td style="min-width:50px"></td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">ចំណូលផ្សេងៗទូរទាត់រួច</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($other_income, 2)); ?></td>
            <td style="min-width:50px"></td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; font-weight: bold;">សរុបទឹកប្រាក់ទទួលបាន</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right; font-weight: bold;"><?php echo str_replace(',', '', number_format($all_income , 2)); ?>$</td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
        </tr>
        <tr>
            <td style="min-width:50px; font-weight: bold;" colspan="5">សាច់ប្រាក់ដែលបានបង់ចេញ៖</td>
        </tr>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">បង់ការទិញទំនិញ</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
        </tr>
        <?php foreach ($purchase as $pu): ?>
          <?php
            $purchase_total += $pu->total_amount;
           ?>
          <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"><?php echo $pu->supplier_name; ?></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($pu->total_amount, 2)); ?></td>
            <td style="min-width:50px"></td>
          </tr>
        <?php endforeach ?>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px">បង់៖</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
        </tr>
        <?php foreach ($expense as $ex): ?>
          <?php 
            $expense_total += $ex->totalExpense;
           ?>
          <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"><?php echo $ex->expend_name; ?></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right;"><?php echo str_replace(',', '', number_format($ex->totalExpense, 2)); ?></td>
            <td style="min-width:50px"></td>
          </tr>
        <?php endforeach ?>
        <tr>
            <td style="min-width:50px"></td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; font-weight: bold;">សរុបទឹកប្រាក់ហូរចេញ</td>
            <td style="min-width:50px"></td>
            <td style="min-width:50px; text-align: right; font-weight: bold;"><?php echo str_replace(',', '', number_format($purchase_total + $expense_total, 2)); ?>$</td>
        </tr>
        <tr>
            <td style="min-width:50px; font-weight: bold;" colspan="4">សាច់ប្រាក់សុទ្ធនៅសល់</td>
            <td style="min-width:50px; text-align: right; font-weight: bold;"><?php echo str_replace(',', '', number_format($all_income - ($purchase_total + $expense_total), 2)); ?>$</td>
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

