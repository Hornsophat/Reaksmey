
<style>
  .alert { padding: 5px; margin-bottom: 10px; }
  .panel-body {
      padding: 5px 10px;
  }
  .form-group {
      margin-bottom: 5px;
  }
</style>
<?php
$option_free_rooms = array('' => "");
foreach ($free_rooms as $row) {
  $option_free_rooms[$row['id']] = $row['room_no'];
}

$option_room_type = array('' => "");
foreach ($room_type as $row) {
  $option_room_type[$row['id']] = $row['type'];
}

$roomType = $this->input->get('roomtype');
if($roomType) {
  $is_roomtype = $this->db->where('id', $roomType)->get('tbl_roomtype')->row();
    //$option_free_rooms = $this->db->where('type_id', $roomType)->get('tbl_room')->result_array();
}

$roomNo = $this->input->get('roomno');

$roomtype = $this->input->get('type');
$roomid = $this->input->get('id');

?>

<div class="container top">

  <ul class="breadcrumb">
    <li>
      <a href="<?php echo site_url("admin"); ?>">
        <?php echo ucfirst($this->uri->segment(1));?>
      </a>
    </li>
    <li>
      <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
        <?php echo ucfirst($this->uri->segment(2));?>
      </a>
    </li>
    <li class="active">
      <a href="#">Edit</a>
    </li>
  </ul>

  <!-- <div class="page-header">
    <h3>Adding <?php echo ucfirst($this->uri->segment(2));?></h3>
  </div> -->

  <?php
  
  //flash messages
  if(isset($flash_message)){
    if($flash_message == TRUE)
    {
      echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo '<strong>Well done!</strong> Checkin Success Edit to database';
      echo '</div>';   
    }else{
      echo '<div class="alert alert-error">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
      echo '</div>';          
    }
  }
  
  ?>

  <?php
  //form data
  $attributes = array('class' => 'form-horizontal', 'id' => '');

  //form validation
  echo validation_errors();

  echo form_open('admin/checkin/update/'. $this->uri->segment(4), $attributes); 
  ?>
  <div class="panel panel-default">
    <div class="panel-header">
        <div class="col-sm-12">
            <h3>
                <?php echo ucfirst($this->uri->segment(3));?>
                Checkin
            </h3>
        </div>
    </div>
    <?php foreach($chec as $ch) { }?>
    <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading"><?php echo lang('Customer Information');?></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Customer Name');?></label>
                  <div class="col-sm-12" >
                    <select class="form-control chosen" name="" id="" disabled>
                      <option value=""> <?php echo $ch->Family ?> </option>
                      <?php 
                      foreach ($customer as $cus) {
                        echo "<option value='".$cus->id."'>".$cus->Family.' | '.$cus->Mobile."</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <!-- <div class="col-sm-12">
                    <input class="form-control " type="text" id="customer_id" name="customer_id" value="">
                  </div>
                  <div class="col-sm-2 btn-fix" style="left: -28px">
                    <a href="#" onclick="javascript:show_modal('search')" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></a>
                  </div> -->
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Customer ID');?></label>
                  <div class="col-sm-12">
                    <input class="form-control " type="text" id="customer_id" name="customer_id" value="<?php echo $ch->id ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Passport / ID Card');?></label>
                  <div class="col-sm-12">
                    <input class="form-control " type="text" id="Passport" name="Passport" value="<?php echo $ch->Passport ?>" readonly >
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Phone Number');?></label>
                  <div class="col-sm-12">
                    <input class="form-control " type="text" id="Gender" name="Gender" value="<?php echo $ch->Mobile ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
           
            <!-- /row -->

          </div>
        </div>
      </div>
    
      <div class="col-md-12">
        <div class="panel panel-info">
          <div class="panel-heading"><?php echo lang('Room Information');?></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group" >
                  <label for="inputError" class="control-label"><?php echo lang('Room Type');?></label>
                  <div class="col-sm-12">
                    <?php if($ch->roomtype) {
                      $data = 'class="span2 form-control chosen"  id="roomtype" readonly'; 
                    } else {
                      $data = 'class="span2 form-control chosen" id="roomtype"';
                    } ?>
                    <?php echo form_dropdown('roomtype', $option_room_type, $ch->roomtype, $data);  ?>
                  </div>
                  <input type="hidden" id="roomtype" name="roomtype" value="<?php echo $ch->roomtype ; ?>">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Room Number');?></label>
                  <div class="col-sm-12">                      
                    <?php echo form_dropdown('room_no', $option_free_rooms, $ch->room_no, $data); ?>
                    <input type="hidden" name="roomnumber" value="<?php echo $ch->room_no; ?>" >                    
                  </div>
                </div>
              </div>
              <div class="col-md-3">
        <div class="control-group" >
          <label for="inputError" class="control-label">Checkin Type</label>         
          <div class="controls">
            <select name="chtype" id="chtype" class="form-control">
                <option value=""> select </option>
                <option value="Overnight" <?php echo $staytime[0]['time']=='Overnight' ? 'selected' : ''; ?>>Overnight</option>
                <option value="Time" <?php echo $staytime[0]['time']=='Time' ? 'selected' : ''; ?>>Time</option>
                <option value="Month" <?php echo $staytime[0]['time']=='Month' ? 'selected' : ''; ?>>Month</option>
              </select>
          </div>
        </div>
      </div>

              <!--loop for tbl_checkin-->
              <?php foreach($chec as $ch) { }?>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('Duration');?></label>
                  <div class="col-sm-12">
                    <input class="form-control" onclick="this.select();" type="text" id="duration" name="duration" value="<?php echo $ch->staying  ?>"  oninput = "this.value=this.value.replace(/[^0-9.]/g,'');">
                  </div>
                </div>
              </div>
            </div>

            <!-- /row -->
            <div class="row">
              <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label"><?php echo lang('CheckIn Date');?></label>
                        <div class="col-sm-12">
                          <input class="dtpicker form-control " type="text" id="date_in" name="date_in" value="<?php echo $ch->date_in ?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label"><?php echo lang('CheckOut Date');?></label>
                        <div class="col-sm-12">
                          <input class="form-control  dtpickerend" type="text" id="date_out" name="date_out" value="<?php echo $ch->checkin_data?>" >
                        </div>
                      </div>
                    </div>
                     <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Banks</label>
                        <div class="col-sm-12">
                         <select class="form-control" name="bank" id="bank">
                           <?php foreach ($banks as $bank) { ?>
                            <option value="<?=$bank->id?>"><?=$bank->account_name?></option>
                           <?php } ?>
                         </select>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Account number</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="account_number" name="account_number" value="">
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label">Account name</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="account_name" name="account_name">
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="inputError" class="control-label" style="color:red;">Remark (For Note)</label>
                        <div class="col-sm-12">
                          <input class="form-control" type="text" id="note" name="note">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputError" class="control-label"><?php echo lang('Price');?></label>
                      <div class="col-sm-12">
                        <input class="form-control " type="text" id="Price" name="Price" value="<?php echo $ch->price?>" >
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputError" class="control-label"><?php echo lang('Extra Charge');?></label>
                      <div class="col-sm-12">
                        <input class="form-control input " onclick="this.select();" type="text" id="extra_charge" name="extra_charges" value="0"  oninput = "this.value=this.value.replace(/[^0-9.]/g,'');">
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputError" class="control-label"><?php echo lang('Discount');?></label>
                      <div class="col-sm-12">
                        <input class="form-control" onclick="this.select();" type="text" id="discount_re" name="discount" value="<?php echo $ch->discount?>"  oninput = "this.value=this.value.replace(/[^0-9.%]/g,'');">
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="col-sm-6 col-md-6">
                    <div class="form-group has-success">
                      <label for="inputError" class="control-label"><?php echo lang('total');?></label>
                      <div class="col-sm-12">
                        <input class="form-control " type="text" id="totals" name="total" value="<?php echo $ch->total?>" readonly>
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="col-sm-6 col-md-6">
                    <div class="form-group has-success">
                      <label for="inputError" class="control-label">Bank Amount</label>
                      <div class="col-sm-12">
                        <input class="form-control " type="text" id="bank_amount" name="bank_amount" value="<?php echo $ch->bank_amount?>">
                      </div>
                    </div>
                  </div> -->
                  <!-- <div class="col-sm-6 col-md-6">
                    <div class="form-group has-warning">
                      <label for="inputError" class="control-label">Deposit Amount</label>
                      <div class="col-sm-12">
                        <input class="form-control " type="text" id="deposit" name="deposit" value="<?php echo $ch->deposit?>">
                      </div>
                    </div> -->
                  </div>
                  <!-- <div class="col-sm-6 col-md-6">
                    <div class="form-group has-success" style="margin-top: 10px;">
                      <label style="color: #ff0500;">Grand Total</label>
                        <div class="col-sm-12">
                          <input type="text" value="<?php echo $ch->grand_total?>" name="grand_total" class="form-control grand_total input" id="grand_total" readonly>
                        </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Row One -->
    <div class="form-actions">
      <button class="btn btn-sm btn-primary"  type="submit" id="write_card"><?php echo lang('Save changes');?></button>
      <button class="btn btn-sm" type="reset"><?php echo lang('Cancel');?></button>
    </div>
  </div>
</div>

<?php echo form_close(); ?>
<!-- =====================================add modal======================================= -->
    <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- =========================================end add  modal============================= -->

<div class="modal fade" id="add-customer" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="infoLabel">add</h4>
      </div>
      <div class="modal-body">
        <p>Add Customer</p>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- /.search-dialog -->

<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="infoLabel">Search</h4>
      </div>
      <div class="modal-body">
        <form class="form-inline" id="frm-Customer-search" role="form" method="post">
          <div class="form-group">
            <label class="sr-only" for="Family">Customer Name</label>
            <input type="text" class="form-control  Family" id="Family" Name="LastName" placeholder="Enter CustomerName">
          </div>
          <div class="form-group">
            <div class="input-group">
              <label class="sr-only" for="Passport">Passport</label>
              <input type="text" class="form-control  Passport" id="Passport" Name="Passport" placeholder="Passport">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <button class="btn btn-primary btn-sm" id="btn-Customer-search">Search</button>
            </div>
          </div>

        </form>

      </br>

      <table id="tblresult" class="table table-bordered">
        <tbody>
          <tr class="active">
            <th style="text-align:center;">#</th>
            <th style="text-align:center;">Family</th>
            <th style="text-align:center;">Passport</th>
            <th style="text-align:center;">ID</th>
            <th style="text-align:center;"></th>
          </tr>

        </tbody>
      </table>

    </div>
  </div>
</div>
</div>

<!-- /.modal-dialog -->

</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(".chosen").chosen();

    $("#customer_id").on("change", function() {
      var customer_id = $("#customer_id").val();
      $.ajax({
        async : false,
        dataType : 'json',
        url : "<?php echo site_url('admin/customer/show'); ?>" + '/' + customer_id,
        success : function(data) {
          try {
            $("#Family").val(data.cid);
            $("#Gender").val(data.gender);
            $("#Passport").val(data.passport);
          } catch(e) {
            alert('Exception while request...');
          }
        },
        error : function(request, textStatus, errorThrown) {
          alert('Sorry, We cannot find any customer you are looking for...');
        }
      });
    });

    $('#roomtype').change(function() {
      dataString = "room_type=" + $('#roomtype').val();
       $.ajax({
        type: "Get",
        dataType : 'html',
        url: "<?= site_url()?>admin/room/get_by_roomtype_ajax",
        data: dataString,
        success: function (result) {
          $('.room_ajax').chosen("destroy");
          $('.room_ajax').html(result);
          $('.room_ajax').chosen();

                },
                error: function(request, textStatus, errorThrown) {

                //var err = eval("(" + request.responseText + ")");
                // alert(err.Message);

                alert("Sorry Noting Found!");
              }

            });
      return false;
    });

	$('#roomtype').change(function() {
      dataString = "room_type=" + $('#roomtype').val();
       $.ajax({
        type: "Get",
        dataType : 'html',
        url: "<?= site_url()?>admin/staying/get_by_stay_ajax",
        data: dataString,
        success: function (result) {
          $('.stay_ajax').chosen("destroy");
          $('.stay_ajax').html(result);
          $('.stay_ajax').chosen();

                },
                error: function(request, textStatus, errorThrown) {

                //var err = eval("(" + request.responseText + ")");
                // alert(err.Message);

                alert("Sorry Noting Found!");
              }

            });
      return false;
    });

  $("#roomtype").on("change", function() {
    dataString = "room_type=" + $('#roomtype').val();
    $.ajax({
      type : "GET",
      dataType : "json",
      data : dataString,
      url : "<?php echo site_url('admin/staying/get_by_id'); ?>",
      async : false,
      success : function(result) {
        try {
          var $el = $("#chtype");
          $el.empty();
          for(i=0; i<result[0].length; i++) {
            $el.append($("<option></option>")
              .attr("value", result[0][i].id).text(result[0][i].time));
          }
        } catch(e) {
          alert("Exception while request..");
        }
      },
      error : function() {
        alert('Sorry Nothing Found For Staying Time!!!');
      }
    });
  });

// $("#chtype").on('blur change', function() {
//   var id = $(this).val();
//   var type = $("#roomtype").val();
//   var dataString = "id=" + id + '&roomtype=' + type;
//   $.ajax({
//     type : "GET",
//     url : "<?php echo site_url('admin/staying/get_price_id'); ?>",
//     data : dataString,
//     dataType : "json",
//     success : function(data) {
//       $("#Price").val(data.price);
//     },
//     error : function() {
//       $("#Price, #per_day, #total").val('');
//     }
//   });

//   if($(this).find("option:selected").text() == 'Overnight') {
//     $("#staying").prop('disabled', false);
//   } else {
//     $("#staying").val(0);
//     $("#staying").prop('disabled', true);
//   }
// });
$('#date_in').on('change blur',function(){
  total_checkin();
});
$('.room_ajax').on('change blur',function(){
  total_checkin();
});
$('#duration, #extra_charge, #discount_re').on('keyup',function(){
  total_checkin();
});
// admin/checkin/total_checkin
});
  function total_checkin(){
      var room_type = $('#roomtype').val();
      var staing_time = $('#chtype').val();
      var duration = $('#duration').val();
      var price = $('#Price').val();
      var date_in = $('#date_in').val();
      var deposit_am = $('#deposit_am').val();
      var discount_re = $('#discount_re').val();
      var grand_total = $('#grand_total').val();
      var room_no = $('.room_ajax').val();
      var extra_charge = $('#extra_charge').val();
      // if(duration == ''){
      //   $('#per_day').val(0);
      // }
      // if(discount_re == ''){
      //   $('#discount_re').val(0);
      // }
      // if(deposit_am == ''){
      //   $('#deposit_am').val(0);
      // }
      // if(room_no == '' || room_no == null){
      //     swal({
      //         icon: 'warning',
      //         title: 'Warning',
      //         text: 'Please Select Room Number !',
      //         type: 'warning'
      //     });
      // }else{
        $.ajax({
          type : 'POST',
          url  : '<?php echo site_url();?>admin/checkin/edit_total_checkin',
          data : {room_type:room_type,
                  staing_time:staing_time,
                  duration:duration,
                  price:price,
                  date_in:date_in,
                  deposit_am:deposit_am,
                  discount:discount_re,
                  grand_total:grand_total,
                  room_no:room_no,
                  extra_charge:extra_charge
                },
          dataType: 'Json',
          async: false,
          success:function(data){
                if(data.error == 1){
                  swal({
                      icon: data.type,
                      title: 'Warning',
                      text: data.message,
                      type: 'warning'
                  });
                }
                if(data.not_free ==1){
                  swal({
                      icon: data.type,
                      title: 'Info',
                      text: data.message,
                      type: 'info'
                  });
                }
                $('#totals').val(data.total);
                $('#Price').val(data.price);
                $('#grand_total').val(data.grand_total);
                $('#date_out').val(data.date_out);
              },
              error : function(){
                $("#Price").val(0);
              }
        });
      // }

      
  }
</script>