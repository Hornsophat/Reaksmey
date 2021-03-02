
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
        <?php echo $timenow = date("Y-M-d G:i A"); ?>
      </center>
      </br>
    </div>

    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr>
         <th>No</th>
         <th>Room No</th>
         <th>Type</th>
         <th>Checkin Date</th>
       </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach($data as $row)
        {
          echo '<tr>';
          echo '<td>'.$i++.'</td>';
          echo '<td>'.$row->room_no.'</td>';
          echo '<td>'.$row->type.'</td>';
          echo '<td>'.$row->date_in.'</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

