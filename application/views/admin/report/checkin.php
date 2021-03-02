<?php 
$fdate='';
$ldate='';
if (isset($_GET['first_date']))
  $fdate = $_GET['first_date'];
if (isset($_GET['last_date']))
  $ldate = $_GET['last_date'];
?>
<div class="container top">
  <div class="page-header users-header">    
    <div class="col-sm-12">
        <div class="row">
        <div class="col-sm-2 pull-left">
          <a  href="" class="btn btn-sm btn-success pull-left"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span> Print</a>
        </div>
          <div class="col-sm-10 pull-right" style="text-align: right;">
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/report/last-week-checkin');?>">
              <div class="form-group">
                <label for="email">ចាប់ពីថ្ងៃ ទី </label>
                <div class="input-group date input-append" id="fromdatetime">
                  <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                  <input type="text" class="form-control b_date" value="<?php echo $fdate ;?>" name="first_date" class="form_datetime" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group eventForm">
                <label for="pwd"> ដល់ថ្ងៃ​ ទី  </label>
                <div class="input-group date input-append" id="todatetime">
                  <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                  <input type="text" class="form-control e_date" value="<?php echo $ldate ;?>" name="last_date" class="form_datetime" id="last_date" style="width: 140px;" />
                </div>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-info" value="Search" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </br>
    </br>
  </div>
  <div id="main_div">
    <div>
      <?php date_default_timezone_set("Asia/Phnom_penh"); ?>
      <center>
        <!-- <h3><?php echo "&#x09;" . ucfirst($this->uri->segment(3)) . ' ' . ucfirst($this->uri->segment(2));?> </h3> -->
        <h3>របាយការណ៍ចូលស្នាក់នៅ</h3>
        <?php echo $timenow = date("Y-M-d G:i A"); ?>
      </center>
      </br>
    </div>

    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr style="background:#87c5ff  !important;">
         <th>No</th>
         <th>Receptionist</th>
         <th>Customer Name</th>
         <th>Date In</th>
         <th>Date Out</th>
         <th>Room Type</th>
         <th>Room No</th>
         <th class="center">Checkin Type</th>
         <th>Price</th>
         <th>Staying</th>
         <th>Pay</th>
         <th>Total</th>
       </tr>
      </thead>
      <tbody>
        <?php
        $i = 1; $total ='';
        $to_am='';$price=0;
        foreach($data as $row)
        {
          // $price=$row->amount;
          $to_am += $row->amount;
          echo '<tr>';
          echo '<td>'.$i++.'</td>';
          echo '<td>'.$row->user.'</td>';
          echo '<td>'.$row->Family.'</td>';
          echo '<td>'.$row->date_in.'</td>';
          echo '<td>'.$row->date_out.'</td>';
          echo '<td>'.$row->type.'</td>';
          echo '<td>'.$row->room_no.'</td>';
          echo '<td style="text-align: center;" >'.$row->time.'</td>';
          echo '<td style="text-align: center;" > $ '.$row->amount.'</td>';
          echo '<td style="text-align: center;" >'.$row->staying.'</td>';
          echo '<td>'.$row->pay.'</td>';
          echo '<td> $ '.$row->amount.'</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
      <tr>
          <td style="background:#87c5ff  !important;text-align: left;font-weight:bold;" colspan="11" class="text-right">Total</td>
          <td style="text-align:left;background:#022a50 !important;color:#fff !important;"><?php echo '$ '.number_format($to_am,2);?></td>
        </tr>
    </table>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(".b_date, .e_date").datepicker({
      format:'yyyy-mm-dd'
    });
  });

</script>
