<style type="text/css">
  .form-control {
    height: 35px;
  }
</style>
<div class="container top">
    <div class="page-header users-header">
        <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/report/payment_report');?>">
          <div class="row">
            <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-3">
                    <label for="">From Date</label>
                      <div class="input-group date input-append" id="fromdatetime">
                        <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                        <input type="text" class="form-control input-sm from_date" value="<?php echo $from_date ;?>" name="from_date" class="form_datetime" id="from_date"/>
                      </div>
                  </div>
                  <div class="col-sm-3">
                    <label for="">From Date</label>
                      <div class="input-group date input-append" id="fromdatetime" style="width: 100%;">
                        <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                        <input style="width: 100%;" type="text" class="form-control to_date" value="<?php echo $to_date ;?>" name="to_date" class="form_datetime" id="to_date"/>
                      </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="row">
                      <div class="form-group" style="width: 100%;">
                      <label for="inputError" class="control-label">Type</label>
                        <div class="col-sm-12">
                          <select class="form-control" name="type" id="type" style="width: 100%;">
                            <option value=""> Select All </option>
                            <option value="hotel" <?= ($type == 'hotel')? 'selected':'';?> > Hotel Sale </option>
                            <option   value="restaurant" <?= ($type == 'restaurant')?'selected':'';?> > Restaurant Sale </option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <br>
                    <div class="form-group pull-right">
                      <input style="height: 35px;" type="submit" class="btn btn-info pull-right" value="Search" />
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-sm-2">
              <br>
              <a class="btn btn-sm btn-success" href="" onclick="PrintElem('#main_div')"><span class="glyphicon glyphicon-print"></span> Print</a><br>
            </div>
          </div>
        </form>
    </div>
    <div id="main_div">
        <style type="text/css">
        @media print {

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #000000 !important;
                padding: 5px !important;

            }

            table {
                border-collapse: collapse !important;
                border-spacing: 0px !important;
                white-space: nowrap;
            }
            .col-sm-6{
              float: left;
              width: 50% !important;
            }
            .row{
                float: left;
                width: 100% !important;
            }
        }
        </style>
        <div>
            <?php date_default_timezone_set("Asia/Phnom_penh"); ?>
            <div class="row" style="text-align: center;">
              <img class="" src="<?php echo site_url('assets/images/domnakneak1.png'); ?>" alt="Palm River Hotel" style='text-align: center; clear: both;margin-top:-20px;'>

            </div>
            <div class="row">
              <center>
                <h3>PAYMENTS REPORT</h3>
                <?php echo $timenow = date("d-M-Y G:i A"); ?>
            </center><br>
            </div>
            <div class="row">
              <div class="col-sm-6">
                  <p>From Date: <?=date('d-m-Y',strtotime($from_date))?></p>
              </div>
              <div class="col-sm-6">
                  <p>To Date: <?=date('d-m-Y',strtotime($to_date))?></p>
              </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-condensed" style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align:center;">No</th>
                    <th>Payment Date</th>
                    <th>Customer Name</th>
                    <th>Mobile</th>
                    <th>User Name</th>
                    <th>Checkin Date</th>
                    <th>Item Name</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <?php
                  echo $data_table;
                ?>
        </table>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(".from_date, .to_date").datepicker({
      format:'yyyy-mm-dd'
    });
  });

</script>