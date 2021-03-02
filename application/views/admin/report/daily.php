
<div class="container top">
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
                width: 100% !important;
            }
        }
      </style>
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
         <th>Checkin Date</th>
         <th>Customer Name</th>
         <th>Mobile</th>
         <th> User Name</th>
         <th>Date Out</th>
         <th>Payment Date</th>
         <th>Item Name</th>
        
         <th>Amount</th>
       </tr>
      </thead>
      <tbody>
        <?php
          echo $data_table;
        ?>
      </tbody>
    </table>
  </div>
</div>

