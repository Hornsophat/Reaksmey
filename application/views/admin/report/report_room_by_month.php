<style type="text/css">
  .form-control {
    height: 35px;
  }
.list_date{
      width: 14.25% !important;
      padding-right: 8px!important;
      padding-left: 8px!important;
      page-break-after: always !important;
  }
  .bg-green {
  background-color: #4CAF50 !important;
      color: #ffffff;
  }
  .bg-orange {
    background-color: #FF9800 !important;
    color: #ffffff;
  }
  .bg-red {
    background-color: #F44336 !important;
    color: #ffffff;
  }
  .panel-header{
    padding-left: 5px;
  }
  .chosen-container-single .chosen-single {
      width: 100%;
  }
</style>
<style type="text/css">
  .row_filter
  {
    padding-top: 10px;
  }
  .table-fixed tbody {
  height: 200px;
  overflow-y: auto;
  width: 100%;
  }

  .w50{width: 50%}
  .w80{width: 80%}
  /*add some background color to table header*/
  .table > thead > tr > th,
  .table > thead > tr > td {
  font-size: .9em;
  font-weight: 400;
  border-bottom: 0;
  letter-spacing: 1px;
  padding: 8px;
  background: #51596a;
  text-transform: uppercase;
  color: #ffffff;
  }
  .bg_orange
  {
    background-color: #ffe3c4 !important;

  }
  .bg_orange td
  {
    position: static !important;
    background-color: #ffe3c4 !important;
    color: #000 !important;
  }
  .bg_green{background-color: #93bf56}
  .bg_blue{background-color: #b3edf9}
  .table-total-payment{width: 100%;}
  .table-total-payment td
  {
    padding: 5px;
  }
  .table-wrapper
  {
    overflow: scroll;
    max-height: 70vh;
  }

  #table_payment th
  {
    padding: 2px 2px !important;
    text-align: center;
    vertical-align: middle;
    font-weight: bold;
  }

  #table_payment td
  {
    padding: 2px 2px !important;
    vertical-align: middle;
  }

  tr.selected
  {
    background-color: #cee1ff !important;
  }

  .modal_warning .modal-header
  {
    background-color: #eebd5e;
      border-top-left-radius: inherit;
      border-top-right-radius: inherit;
      color: #fff;
  }
  input.feedback
  {
    border: none;
      border-width: 0;
      outline: none;
      border-bottom: 1px solid #44433f;
      width: 100%;
  }

  input.feedback:focus
  {
      border-bottom: 1px solid lightblue;
  
  }

  .table_delete_payslip>tbody>tr>td, .table>tbody>tr>th
  {
    border-top: none;
  }

  /*fixed header table*/
  .table-box table
  {
    width: 1000px;

  }

  .table-box table th,.table-box table td
  {
    padding: 2px 2px !important;
      vertical-align: middle;
      border: 1px solid lightgray;

  }

  .table-box table th:nth-child(1),
  .table-box table td:nth-child(1)
  {
    background-color: #51596a;
    color: #fff;
    position: sticky !important;
    left: 0;
    z-index: 4 !important;
  }

  .table-box table td:nth-child(1)
  {
    z-index: 1;
  }



  .table-box table th, #table_payment > thead > tr > th
  {
    background-color: #51596a;
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 2 !important;
  }

  

  .table-box
  {
    height: 200px;
    width: 600px;
    overflow: scroll;
  }

  #table_payment > thead > tr > th:nth-child(1),
  #table_payment > thead > tr > th:nth-child(2),
  #table_payment > thead > tr > th:nth-child(3),
  #table_payment > tbody > tr > td:nth-child(1),
  #table_payment > tbody > tr > td:nth-child(2),
  #table_payment > tbody > tr > td:nth-child(3)
  {
    background-color:#ffe3c4;
    color: #000;
    position: sticky;
    
  
  }

  #table_payment > thead > tr > th:nth-child(1),
  #table_payment > tbody > tr > td:nth-child(1)
  {
    left: 0;
    min-width: 38px;
  
  }

  #table_payment > thead > tr > th:nth-child(2),
  #table_payment > tbody > tr > td:nth-child(2)
  {
    left: 38px;
    min-width: 134px;
  
  }

  #table_payment > thead > tr > th:nth-child(3),
  #table_payment > tbody > tr > td:nth-child(3)
  {
    left: 172px;
    min-width: 62px;
  
  }
  #table_payment > thead > tr > th:nth-child(1),
  #table_payment > thead > tr > th:nth-child(2),
  #table_payment > thead > tr > th:nth-child(3)
  {
    z-index: 3 !important;
  }
  .CellWithComment{
    position:relative;
  }
  .CellWithComment:hover { 
     background-color: #F44336 !important;
     cursor: pointer;
  }
  .CellComment{
    display:none;
    position:absolute; 
    z-index:100;
    border:1px;
    border-radius: 2px;
    background-color:white;
    border-style:solid;
    border-width:1px;
    border-color:#cccccc;
    padding:3px;
    color:red; 
    top:20px; 
    left:20px;
    padding: 5px;
  }

  .CellWithComment:hover span.CellComment{
    display:block;
  }
  .sp_tooltip{
    line-height: 20px;
    margin-bottom: 0px;
    text-align: left;
  }
</style>
<div class="container top">
    <div class="page-header users-header">
        <form class="form-inline" method="get" action="<?php echo site_url('admin/report/report_room_by_month');?>">
          <div class="row">
            <div class="col-md-10">
                <div class="row">
                 <!-- <div class="col-md-3">
                      <label for="inputError" class="control-label"><?php echo lang('Room Type');?></label>
                      <select class="form-control chosen" name="room_type" id="room_type" style="width: 100%;">
                        <option value=""> Select All </option>
                        <?php 
                          foreach ($room_type as $type) {
                            $sel ='';
                              if ($type['id'] == $room_type_id) {
                                  $sel ='selected';
                              }
                              echo '<option value="'.$type['id'].'" '.$sel.'>'.$type['type'].'</option>';
                          }

                        ?>
                      </select>
                  </div>
                  <div class="col-md-3">
                      <label for="inputError" class="control-label">Type</label>
                      <select class="form-control room_ajax chosen" name="room_id" id="room_id" style="width: 100%;">
                        <option value=""> Select All </option>
                        <?php 
                          foreach ($room_data as $room) {
                            $sel ='';
                              if ($room->id == $room_id) {
                                  $sel ='selected';
                              }
                              echo '<option value="'.$room->id.'" '.$sel.'>'.$room->room_no.'</option>';
                          }

                        ?>
                      </select>
                  </div> -->
                  <div class="col-md-6">
                      <label for="inputError" class="control-label">Month</label>
                      <select class="form-control chosen" name="month" id="month" style="width: 100%;">
                        <?php 
                          foreach ($month_arr as $key => $value) {
                            $sel ='';
                              if ($key == $month) {
                                  $sel ='selected';
                              }
                              echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
                          }

                        ?>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <label for="inputError" class="control-label">Year</label>
                      <select class="form-control chosen" name="year" id="year" style="width: 100%;">
                        ​​​<?php 
                          foreach ($year_arr as $key => $value) {
                            $sel ='';
                              if ($key == $year) {
                                  $sel ='selected';
                              }
                              echo '<option value="'.$key.'" '.$sel.'>'.$value.'</option>';
                          }

                        ?>
                      </select>
                  </div>
                </div>
            </div>
            <div class="col-md-2">
              <diw class="row">
                <div class="col-md-6">
                  <input style="height: 35px;" type="submit" class="btn btn-info pull-right" value="Search" />
                </div>
                <div class="col-md-6">
                  <a class="btn btn-sm btn-success" href="" onclick="PrintElem('#main_div')"><span class="glyphicon glyphicon-print"></span> Print</a><br>
                </div>
              </diw>
              
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
            .list_date{
                  width: 14% !important;
                  padding-right: 1px !important;
                  padding-left: 1px !important;
                  page-break-before: auto;
                  page-break-before: always;
                  page-break-before: avoid;
                  page-break-before: left;
                  page-break-before: right;
                  page-break-before: recto;
                  page-break-before: verso;
                  page-break-after: always !important;
                  float: left !important;
              }
            .bg-green {
              background-color: #4CAF50 !important;
                  color: #ffffff;
              }
              .bg-orange {
                background-color: #FF9800 !important;
                color: #ffffff;
              }
              .bg-red {
                background-color: #F44336 !important;
                color: #ffffff;
              }
              .panel-header{
                padding-left: 5px;
              }
              .panel {
                  margin-bottom: 20px;
                  background-color: #ffffff;
                  border: 1px solid #dddddd;
                  border-radius: 4px;
                  -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
                  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
              }
              .panel-body {
                  padding: 15px 5px;
              }
              .panel-footer {
                  padding:5px;
                  background-color: #f5f5f5;
                  border-top: 1px solid #dddddd;
                  border-bottom-right-radius: 3px;
                  border-bottom-left-radius: 3px;
              }
        }
        </style>
        <div class="row">
            <?php date_default_timezone_set("Asia/Phnom_penh"); ?>
            <div class="row" style="text-align: center;">
              <!-- <img class="" src="<?php echo site_url('assets/images/domnakneak1.png'); ?>" alt="Palm River Hotel" style='text-align: center; clear: both;margin-top:-20px;'> -->

            </div>
            <div class="row">
              <center>
                <h3>ROOM REPORT</h3>
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
        <div class="row">
         <div class="col-sm-12 table-responsive" style="max-height: 70vh;padding-bottom: 50px;">
            <table class="table table-striped table-bordered table-condensed" id="table_payment" style="width: 100%; white-space: nowrap;">
              <thead>
                  <tr>
                      <th style="text-align:center;">No</th>
                      <th style="text-align:left;">Room Type</th>
                      <th style="text-align:left;">Room No</th>
                      <?php 
                        foreach ($date_month_arr as $date) {
                          $bg = "bg-green";
                          if(date('D',strtotime($date)) == 'Sat' || date('D',strtotime($date)) == 'Fri' || date('D',strtotime($date)) == 'Sun'  ){
                              $bg = 'bg-orange';
                          }
                          if(isset($holiday_data_arr[$date])){
                            $bg = 'bg-red';
                          }

                          echo '<th class="'.$bg.'">'.date('d',strtotime($date)).'</th>';
                        }
                      ?>
                  </tr>
              </thead>
              <tbody>
                <?php
                $tr = "";
                $room_type_id ="";
                $type_name = '';
                $i = 1;
                  foreach ($roomtype_data as $types) {
                    $r_type = $types->id;
                    foreach ($room_data_all as $room_all) {
                      if(!($room_type_id == $room_all->type_id)){
                        $type_name = $types->type;
                      }
                      if($r_type == $room_all->type_id){
                        $tr.= '<tr></tr>';
                        $tr.='<td style="text-align:center;">'.$i++.'</td>';
                          $tr.='<td>'.$type_name.'</td>';
                          $tr.='<td>'.$room_all->room_no.'</td>';
                          foreach ($date_month_arr as $date) {
                            $back= '';
                            $checkin = isset($checkin_arr[$room_all->id][$date])?$checkin_arr[$room_all->id][$date]:'';
                            if($checkin['type'] == 'C'){
                              $back = '#c4fbc6';
                            }else if($checkin['type'] == 'R'){
                              $back = '#fbc575';
                            }

                            $tr.='<td style="background:'.$back.';text-align:center;" class="CellWithComment">';
                              if($checkin){
                                $tr.='<span class="CellComment">';
                                if($checkin['cus_name']){
                                  $tr.='<p class="sp_tooltip">- Name: '.$checkin['cus_name'].' </p>';
                                }
                                if($checkin['cus_phone']){
                                  $tr.='<p class="sp_tooltip">- Phone: '.$checkin['cus_phone'].'</p>';
                                }
                                if($checkin['deposit'] > 0) {
                                  $tr.='<p class="sp_tooltip">- Deposit: '.$checkin['deposit'].'</p>';
                                }
                                if($checkin['note']){
                                  $tr.=' <p class="sp_tooltip">- Note: '.$checkin['note'].'</p>';
                                }
                                
                                $tr.='</span>';
                              }
                              

                          $tr.=' </td>';
                          }

                        $tr.='</tr>';

                      }
                      $type_name = '';
                      $room_type_id = $room_all->type_id;
                    }
                  }

                echo $tr;
                ?>
              </tbody>
            </table>
         </div>


        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(".chosen").chosen();
    $(".from_date, .to_date").datepicker({
      format:'yyyy-mm-dd'
    });
    $('#room_type').change(function() {
      dataString = "room_type=" + $('#room_type').val();
       $.ajax({
        type: "Get",
        dataType : 'html',
        url: "<?= site_url()?>admin/room/get_by_roomtype_ajax",
        data: dataString,
        success: function (result) {
          $('.room_ajax').chosen("destroy");
          $('.room_ajax').html(result);
          $('.room_ajax').chosen();

                },
                error: function(request, textStatus, errorThrown) {

                //var err = eval("(" + request.responseText + ")");
                // alert(err.Message);

                alert("Sorry Noting Found!");
              }

            });
      return false;
    });
  });

</script>