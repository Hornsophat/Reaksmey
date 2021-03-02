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
          <a  href="" class="btn btn-sm btn-success"  onClick="PrintElem('#main_div')" ><span class="glyphicon glyphicon-print"></span>Print</a>
        </div>
          <div class="col-sm-10 pull-right" style="text-align: right;">
            <form class="form-inline" role="form" method="get" action="<?php echo site_url('admin/report/get-all-amount-in');?>">
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
        <h3>របាយការណ៍ប្រាក់ចំណេញប្រចាំខែ</h3>
        <?php echo $timenow = date("Y-M-d G:i A"); ?>
      </center>
      </br>
    </div>
<style type="text/css">
   #center{
    text-align: center;
  }
</style>
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr>
         <th id="center">total income</th>
         <th id="center">total expend</th>
         <th id="center">profit</th>
       </tr>
      </thead>
      <tbody>
        <tr>
          <td id="center">$&nbsp;<?php echo ($in_amount[0]->tmount-$in_amount[0]->refun);?></td>
          <td id="center">$&nbsp;<?php echo $ex_amount[0]->emount;?></td>
          <td id="center">$&nbsp;<?php echo ($in_amount[0]->tmount-$ex_amount[0]->emount-$in_amount[0]->refun);?></td>
        </tr>
      </tbody>
      <tr>
          <td colspan="2" class="text-right" style="background-color:#022a50;color:#fff;">Total Profit</td>
          <td style="background-color:#022a50;color:#fff;text-align:center;"><?php echo '$ '.($in_amount[0]->tmount-$ex_amount[0]->emount);?></td>
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
