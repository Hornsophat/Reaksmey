
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
         <th>Name</th>
         <th>Gender</th>
         <th>Address</th>
         <th>Country</th>
         <th>Nationality</th>
         <th>City</th>
         <th>Age</th>
         <th>Passport/ID Card</th>
         <th>Credit Card</th>
         <th>Mobile</th>
         <th>Company</th>
         <th>Email</th>
       </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach($data as $row)
        {
          echo '<tr>';
          echo '<td>'.$i++.'</td>';
          echo '<td>'.$row->Family.'</td>';
          echo '<td>'.$row->Gender.'</td>';
          echo '<td>'.$row->Adress.'</td>';
          echo '<td>'.$row->Country.'</td>';
          echo '<td>'.$row->Nationality.'</td>';
          echo '<td>'.$row->City.'</td>';
          echo '<td>'.$row->Age.'</td>';
          echo '<td>'.$row->Passport.'</td>';
          echo '<td>'.$row->credit_card.'</td>';
          echo '<td>'.$row->Mobile.'</td>';
          echo '<td>'.$row->Company.'</td>';
          echo '<td>'.$row->email.'</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

