    
    <?php 
$fdate='';
$ldate='';
if (isset($_GET['first_date']))
  $fdate = $_GET['first_date'];
if (isset($_GET['last_date']))
  $ldate = $_GET['last_date'];
?>
    <div class="container top">
      <div class="col-sm-12">
        <div class="row">
        <div class="col-sm-2 pull-left">
          <a  href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>Print</a>
        </div>
          <div class="col-sm-10 pull-right" style="text-align: right;">
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('currencies/expense_list');?>">
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
      <br>
      <br>


      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("currencies"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("currencies").'/'.$this->uri->segment(3); ?>/add_exspanse" class="btn btn-sm btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns col-sm-12">
          <table class="table table-striped table-bordered table-condensed">
            <thead class="text-center" style="text-align: center;">
              <tr style="text-align: center !important;">
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Expanes Date</th>
                <th class="yellow header headerSortDown">Expanes Type</th> 
                <th class="yellow header headerSortDown">Amount</th>
                <th class="yellow header headerSortDown">Note</th>
                <th class="yellow header headerSortDown">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach ($expenes as $key => $row) {

                $total += $row->amount;
            ?>
              <tr style="text-align: center !important;">
                <td><?php echo $row->tdid;?></td>
                <td><?php echo $row->date; ?></td>
                <td><?php echo $row->ex_type; ?></td>
                <td>$ <?php echo number_format($row->amount,3); ?></td>
                <td><?php echo $row->note; ?></td>
                <td><a href="<?php echo base_url().'currencies/update_expenes/'.$row->tdid; ?>" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="<?php echo base_url().'currencies/delete_expenes/'.$row->tdid;?>" data-toggle="tooltip" title="Delete" style="color:#ff0000;"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
              
            <?php
              }
             ?>
              <tr>
                <td colspan="3" style="text-align: center; background-color:#033c73;color:#fff;">Total Expenes:</td>
                <td colspan="3" style="background-color:#033c73;color:#fff;">$ <?php echo $total;?></td>
              </tr>
              
            </tbody>
          </table>

         

      </div>
    </div>

    <script type="text/javascript">
          $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
          });
    </script>


    <script type="text/javascript">
  $(document).ready(function() {
    $(".b_date, .e_date").datepicker({
      format:'yyyy-mm-dd'
    });
  });

</script>