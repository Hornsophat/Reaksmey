
<?php
  $start_date = $this->input->get('start');
  $end_date = $this->input->get('end');
  $search_string = $this->input->get('search_string');
?>

<div class="container top">
  <div class="page-header users-header">
    <a  href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>   Print</a>
    </br>
    </br>
  </div>
  <div id="main_div">
  <div>
    <?php date_default_timezone_set("Asia/Phnom_penh"); ?>
    <center>
      <h3><?php echo "&#x09;" . ucfirst($this->uri->segment(3)) . ' ' . ucfirst($this->uri->segment(2));?> </h3>
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

<table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
     <th>No</th>
     <th>Date</th>
     <th>Receptionist</th>
     <th>Customer Name</th>
     <th>Date In</th>
     <th>Date Out</th>
     <th>Checkin Type</th>
     <th>Room Type</th>
     <th>Room</th>
     <th>Pay</th>
     <th>Status</th>
     <th>Total</th>

   </tr>
 </thead>
 <tbody>
  <?php
  $i = 1; $total ='';
  foreach($data as $row)
  {
    $total += $row->amount;

    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$row->current_date.'</td>';
    echo '<td>'.$row->user.'</td>';
    echo '<td>'.$row->family.'</td>';
    echo '<td>'.$row->date_in.'</td>';
    echo '<td>'.$row->date_out.'</td>';
    echo '<td>'.$row->time.'</td>';
    echo '<td>'.$row->type.'</td>';
    echo '<td>'.$row->room_no.'</td>';
    echo '<td>'.$row->pay.'</td>';
    echo '<td>';
    echo $row->checkouted==0 ? 'checkin' : 'checkout';
    echo '</td>';
    echo '<td>$ '.$row->amount.'</td>';
    echo '</tr>';
    $i++;
  }
  ?>     
  <tr>
    <td colspan="11"></td>
    <td><?php echo '$ '.$total;?></td>
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