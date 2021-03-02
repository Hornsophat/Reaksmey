<?php 
$fdate='';
$ldate='';
if (isset($_GET['first_date']))
  $fdate = $_GET['first_date'];
if (isset($_GET['last_date']))
  $ldate = $_GET['last_date'];
?>
<div class="report">
  <div> 
    <div class="modal-body" id="inv_print">
      <div class="header" style="height: 100px; width: 100%;">
        <div class="row" style="padding-left: 15px; padding-right: 15px;">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-4">
                <!-- <img src="<?php echo base_url();?>updatepos/img/kpg.png"> -->
              </div>
              <div class="col-sm-4" style="text-align: center; padding-bottom: 10px; margin-top: 30px; font-size: 20px;">List Suspend</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="padding-left: 15px; padding-right: 15px;">
        <div class="col-sm-12">
          <style type="text/css">
            #head tr th{ text-align: center !important; }
          </style>
          <table class="table table-bordered" style=" border-left: none;">
              <tr class="text-center">
                <th >No</th>
                <th >Date</th>
                <th >Customer</th>
                <th >Suspend By</th>   
                <th >Phone</th>   
                <th >Amount</th>   
              </tr>
            <?php 
            $i=1;
             foreach  ($suspends as $sus) {
            	?>
            	<tr>
                <td   align="left"><?php echo $i?></td>
                <td  align="left"><?php echo $sus->date ?></td>
                <td   align="left"><?php echo $sus->customer ?></td>
                <td   align="left"><?php echo $sus->username ?></td>
                <td   align="left"><?php echo  $sus->phone?></td>
                <td  align="left"><?php echo number_format($sus->total,2) ?></td> 
              </tr>
           <?php $i++; } ?>
              </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="<?= site_url('update/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="<?= site_url('update/js/moment-with-locales.js'); ?>"></script>
<!-- <script src="<?php echo base_url('update/js/bootstrap-datepicker1.js')?>"></script>  -->
<script src="<?php echo base_url('update/js/jquery.PrintArea.js')?>"></script>  
<script src="<?php echo base_url('update/js/gScript.js')?>"></script>  
<script type="text/javascript">

  $(document).ready(function() {
    $("#fromdatetime, #todatetime").datetimepicker();
  });

  // $(".b_date,.e_date").datepicker({
  //   language: 'en',
  //   pick12HourFormat: true,
  //   format:'yyyy-mm-dd'
  // });

  $(function(){
    $("#print_inv").on("click", function(){
      var export_data = $("#inv_print").html();
      export_data +='<style type="text/css">'+
      'td,th,h5,h6,h2,h3,p,h1,div,span,label{'+
      'font-family: Cambria;'+
      '}'+
      'th{'+
      'font-size: 11px;'+
      'font-weight: bold;'+
      '}'+
      'td{'+
      'font-size: 11px;'+
      '}'+
      '</style>';
      var title = "";
      gsPrint(title,export_data);
    });
  });

</script>

