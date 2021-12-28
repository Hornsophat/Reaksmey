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
<div class="container top">
    <div class="page-header users-header">
        <form class="form-inline" method="get" action="<?php echo site_url('admin/report/report_room_by_date');?>">
          <div class="row">
            <div class="col-md-10">
                <div class="row">
                 <div class="col-md-3">
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
                  </div>
                  <div class="col-md-3">
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
                  <div class="col-md-3">
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
                  <p>Room No: <?=$room_no?></p>
              </div>
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
          <?php 
              $munber_of_month = 0;
              $days = date('D',strtotime($from_date));

              $munber_of_month = isset($day_arr[$days])?$day_arr[$days]:0;


              for($a = 1; $a <= $munber_of_month; $a++) {
                    echo '<div class="col-md-2 list_date">
                                    <span style="color:transparent !important;">Na</span>
                            </div>';
              }
              foreach ($date_month_arr as $date) {
                $bg = "bg-green";
                if(date('D',strtotime($date)) == 'Sat'){
                    $bg = 'bg-orange';
                }else if (date('D',strtotime($date)) == 'Sun'){
                    $bg = 'bg-red';
                }
                $back= '';
                $checkin = isset($checkin_arr[$date])?$checkin_arr[$date]:'N/A';
                if($checkin == 'Check-In'){
                  $back = '#c4fbc6';
                }else if($checkin == 'Reservation'){
                  $back = '#fbc575';
                }

                 echo '<div class="col-md-2 list_date">
                               <div class="panel panel-default">
                                  <div class="panel-header '.$bg.'">'.date('D',strtotime($date)).' - '.date('d',strtotime($date)).'</div>
                                  <div class="panel-body" style="background:'.$back.';">'.$checkin.'</div>
                                <!--  <div class="panel-footer">'.$room_no.'</div> -->
                              </div>      
                      </div>';
              }
          ?>
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