<style type="text/css">
  .form-control {
    height: 35px;
  }
</style>
<?php
  $start_date = $this->input->get('start');
  $end_date = $this->input->get('end');
  $search_string = $this->input->get('search_string');
?>

<div class="container top">
    <?php date_default_timezone_set("Asia/Phnom_penh"); ?>
    <center>
      <?php 
        if($start_date OR $end_date) {
          echo 'Date : '.$start_date . ' - ' . $end_date;
        } else {
          echo $timenow = date("Y-M-d G:i A");
        }
      ?>
    </center>
    </br>
  </div>

<div class="row">
  <div class="col-sm-12">
    <div class="well">           
      <?php echo form_open('admin/report/unpay', array('class' => 'form-inline reset-margin', 'id' => 'myform', 'method' => 'get')); ?>
        <label for="search_string">Search : </label>
        <?php echo form_input('search_string', set_value('search_string', $this->input->get('search_string')), 'class="form-control" placeholder="search customer"'); ?>

        <label for="filter">Fitler : </label>
        <?php echo form_input('start', set_value('start', $this->input->get('start')), 'class="form-control datepicker" placeholder="from"'); ?>
        <?php echo form_input('end', set_value('end', $this->input->get('end')), 'class="form-control datepicker" placeholder="to"'); ?>

        <button type="submit" class="btn btn-primary">Go</button>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="page-header users-header">
    <a  href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>   Print</a>
    </br>
    </br>
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
                width: 80% !important;
            }
        }
        </style>
  <div>
  <center>
  
  <h3​ style="font-family:Khmer OS; font-size:30px;">Report Customer Unpay</h3>
  </center>
  <table class="table table-striped table-bordered table-condensed" style="width: 90%;">
  <thead>
    <tr>
     <th>No</th>
     <th>Date</th>
     <th>Receptionist</th>
     <th>Customer Name</th>
     <th>Payment Date</th>
     <th>Checkin Type</th>
     <th>Room No</th>
     <th>Room Type</th>
     <th>Pay</th>
     <th>Status</th>
     <th>Total</th>
     <th>Item Name</th>
     <th>qty</th>
     <th>total price item</th>

   </tr>
 </thead>
 <tbody>
  <?php
  $i = 1; $total ='';
  foreach($data as $row)
  {
  
    if($row->room_no!=Null){
      $total += $row->price;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$row->current_date.'</td>';
    echo '<td>'.$row->user.'</td>';
    echo '<td>'.$row->family.'</td>';
    echo '<td>'.$row->date_in.'</td>';
    echo '<td>'.$row->time.'</td>';
    echo '<td>'.$row->room_no.'</td>';
    echo '<td>'.$row->type.'</td>';
    echo '<td>'.$row->pay.'</td>';
    echo '<td>';
    echo $row->checkouted==0 ? 'checkin' : 'checkout';
    echo '</td>';
    echo '<td> '.number_format($row->price,2).'</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '</tr>';
    }
    else{
      $totalitem += $row->amount;
      $totalqty +=  $row->qty;
      echo '<tr>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td>';
      echo '';
      echo '</td>';
      echo '<td></td>';
      echo '<td style="color:red">'.$row->item_name.'</td>';
      echo '<td style="color:red">'.number_format($row->qty,2).'</td>';
      echo '<td style="color:red">'.number_format($row->amount,2).'</td>';
      echo '</tr>';
       
    }
    $i++;
  }
  ?>     
  <tr>
    <td class="text-right" colspan="10" style="font-weight:bold;">Total :</td>
    <td style="font-weight:bold;"> <?php echo ' '.number_format($total,2);?></td>
    <td style="font-weight:bold;"></td>
    <td style="font-weight:bold;color:red"><?php echo ' '.number_format( $totalqty ,2);?></td>
    <td style="font-weight:bold;color:red"> <?php echo ' '.number_format($totalitem,2);?></td>
  </tr>
</tbody>
</table>
</div>          

</div>

<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
      autoclose: true,
      weekStart: 1,
      todayHighlight: true,
      format: "yyyy-mm-dd"
    });
  });
</script>