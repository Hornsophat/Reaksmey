
<div class="container top">
<div class="page-header users-header">
        
          <a  href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>   Print</a>
        </br>
        </br>
</div>
<div id="main_div">

<div>
<?php 
date_default_timezone_set("Asia/Phnom_penh");
echo $timenow = date("Y-M-d G:i A");
?>
<center>
<h3><?php echo "&#x09;" . ucfirst($this->uri->segment(3)) . ' ' . ucfirst($this->uri->segment(2));?> </h3>
</center>
</br>
</br>
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
               		echo '<td>'.$row->Family.'</td>';
               		echo '<td>'.$row->date_in.'</td>';
               		echo '<td>'.$row->date_out.'</td>';
               		echo '<td>'.$row->time.'</td>';
               		echo '<td>'.$row->type.'</td>';
               		echo '<td>'.$row->room_no.'</td>';
                  echo '<td>'.$row->pay.'</td>';
               		echo '<td>$ '.$row->amount.'</td>';
                echo '</tr>';
                $i++;
               }
              ?>     
              <tr>
                <td colspan="9"></td>
                <td><?php echo '$ '.$total;?></td>
              </tr>
            </tbody>
          </table>
</div>          
          
</div>

