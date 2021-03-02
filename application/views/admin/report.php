
<div class="container top">
  <div class="page-header users-header">
    <a href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>   Print</a>
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
          <?php foreach ($fields as $field) {
            echo ' <th class="yellow header headerSortDown"> ' .  $field . ' </th> '  ;
          } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data as $row) {
          echo '<tr>';
          foreach ($fields as $field) {
            echo '<td>'.$row[$field].'</td>';
          }
          echo '</tr>';
        } ?>
      </tbody>
    </table>
  </div>
</div>

