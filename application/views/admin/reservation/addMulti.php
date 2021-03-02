<style>
    .alert { padding: 5px; margin-bottom: 10px; }
  .panel-body {
      padding: 0px 10px;
  }
  .form-group {
    margin-bottom: 5px;
  }
  .delete_room_tr{
    cursor: pointer;
  }
</style>
<?php
// $option_free_rooms = array('' => "");
// foreach ($free_rooms as $row) {
//   $option_free_rooms[$row['id']] = $row['room_no'];
// }

$option_room_type = array('' => "");
foreach ($room_type as $row) {
  // $option_room_type[$row['id']] = $row['type'];
  $option_room_type[$row->id] = $row->type;
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
            <a href="#">New</a>
        </li>
    </ul>
    <!-- <div class="page-header">
    <h2>Multi <?php echo ucfirst($this->uri->segment(2));?></h2>

  </div> -->
    <?php
  //flash messages
  if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">x</a>';
            echo '<strong>Well done!</strong> New reservation Success add to database';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">x</a>';
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

  echo form_open('admin/reservation/add_multi', $attributes); 
  ?>
    <div class="panel panel-default">
        <div class="panel-header">
            <div class="col-sm-12">
                <h3>Multi
                    <?php echo ucfirst($this->uri->segment(2));?>
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <?php echo lang('Customer Information');?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?php echo lang('Customer Name');?></label>
                                        <div class="col-sm-12">
                                            <select class="form-control chosen" name="customer_id" id="customer_id">
                                                <option value=""> Select </option>
                                                <?php 
                                                  foreach ($customer as $cus) {
                                                    echo "<option value='".$cus->id."'>".$cus->Family.' | '.$cus->Mobile."</option>";
                                                  }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?php echo lang('Customer ID');?></label>
                                        <div class="col-sm-12">
                                            <input class="form-control " type="text" id="Family" name="Family" value="<?php echo set_value('Family'); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?php echo lang('Passport / ID Card');?></label>
                                        <div class="col-sm-12">
                                            <input class="form-control " type="text" id="Passport" name="Passport" value="<?php echo set_value('Passport'); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">
                                            <?php echo lang('Phone Number');?></label>
                                        <div class="col-sm-12">
                                            <input class="form-control " type="text" id="Gender" name="Gender" value="<?php echo set_value('sex'); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    <?php echo lang('Duration');?></label>
                                                <div class="col-sm-12">
                                                    <input class="form-control duration" onclick="this.select();" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="duration" name="duration" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    <?php echo lang('CheckIn Date');?></label>
                                                <div class="col-sm-12">
                                                    <input class="dtpicker form-control " type="text" id="date_in" name="date_in" value="<?=date('Y-m-d')?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
                                                    <?php echo lang('CheckOut Date');?></label>
                                                <div class="col-sm-12">
                                                    <input class="form-control  dtpickerend" type="text" id="date_out" name="date_out" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="control-label">Acc Type</label>
                                                    <select name="acc_name" class="form-control acc_name" id="acc_name">
                                                        <option value=" ">Please Select</option>
                                                        <?php 
                                                          foreach ($list_bank as $row) {
                                                            echo "<option value='".$row->id."'>".$row->account_name."</option>";
                                                          }
                                                       ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label class="control-label">Deposit Amount</label>
                                                    <input type="text" name="deposit_am" value="0" onclick="this.select();" class="form-control deposit_am" id="deposit_am" oninput="this.value=this.value.replace(/[^0-9.%]/g,'');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label>Acc Name</label>
                                            <input type="text" value="" name="bank_acc_name" class="form-control bank_acc_name" id="bank_acc_name">
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <label>Acc Number</label>
                                            <input type="text" value="" oninput = "this.value=this.value.replace(/[^0-9]/g,'');" name="bank_acc_number" class="form-control bank_acc_number" id="bank_acc_number">
                                        </div>


                                        <div class="col-md-12">
                                          <div class="form-group">
                                              <label class="control-label">
                                                  <?php echo lang('Discount');?></label>
                                              <div class="col-sm-12">
                                                  <input class="form-control input " onclick="this.select();" type="text" id="discount" name="discount" value="0" oninput="this.value=this.value.replace(/[^0-9.%]/g,'');">
                                              </div>
                                          </div>
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
                        <div class="panel-heading">
                            <?php echo lang('Room Information');?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    <?php echo lang('Room Type');?></label>
                                <div class="col-sm-12">
                                    <?php 
                                    if($roomtype) {
                                      $data = 'class="span2 form-control chosen" id="roomtype" disabled'; 
                                    } else {
                                      $data = 'class="span2 form-control chosen" id="roomtype"';
                                    } ?>
                                    <?php echo form_dropdown('roomtype', $option_room_type, set_value('roomtype', $roomtype), $data); ?>
                                </div>
                                <input type="hidden" name="room_type" value="<?php echo $roomtype ? $roomtype : '0'; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    <?php echo lang('Room Number');?></label>
                                <div class="col-sm-12">
                                    <?php
                                      echo form_dropdown('room_no',[''=>'Select Room'], set_value('room_no', $roomid), 'class="span2 form-control" id="room_no"');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table  table-bordered" id="reservation_group">
                                <thead>
                                    <tr>
                                        <th class="header text-center">#</th>
                                        <th class="yellow header headerSortDown">
                                            <?php echo lang('Room Type');?>
                                        </th>
                                        <th class="yellow header headerSortDown">
                                            <?php echo lang('Room Number');?>
                                        </th>
                                        <th class="yellow header headerSortDown" style="text-align:center;width: 12rem;">
                                            <?php echo lang('Floor');?>
                                        </th>
                                        <th class="yellow header headerSortDown" style="text-align:center; width: 12rem;">
                                            <?php echo lang('CheckIn Type');?>
                                        </th>
                                        <!-- <th class="yellow header headerSortDown" style="text-align:center; width: 12rem;"><?php echo lang('Duration');?></th> -->
                                        <th class="yellow header headerSortDown" style="text-align:center;">
                                            <?php echo lang('Price');?>
                                        </th>
                                        <th class="yellow header headerSortDown" style="text-align:center;width: 12rem;">
                                            <?php echo lang('amount');?>
                                        </th>
                                        <th class="yellow header headerSortDown" style="text-align:center;width: 55px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="multi_room">
                                </tbody>
                            </table>
                            <!-- <div class="col-md-3 col-md-offset-9"> -->
                                <div class="row">
                                    <div class="col-sm-9 col-md-9">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <label>
                                                    <?php echo lang('Note');?></label>
                                                <textarea rows="5" class="form-control" name="note" id="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo lang('total');?></label>
                                                        <input class="form-control" type="text" id="totals" name="total" value="0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" style="color: #ff0500;">
                                                    <label class="control-label"><?php echo lang('grand_total');?></label>
                                                        <input class="form-control grand_total" type="text" id="grand_total" name="grand_total" value="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <?php echo lang('Staying Information');?>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="form-actions" style="margin-bottom: 10px;">
                <button class="btn btn-primary" type="submit" id="write_card">
                    <?php echo lang('Save');?></button>
                <button class="btn " type="reset">
                    <?php echo lang('Cancel');?></button>
            </div>
        </div>
        <!-- End Row One -->
        <!-- End Row two -->
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
            async: false,
            dataType: 'json',
            url: "<?php echo site_url('admin/customer/show'); ?>" + '/' + customer_id,
            success: function(data) {
                try {
                    $("#Family").val(data.cid);
                    $("#Gender").val(data.gender);
                    $("#Passport").val(data.passport);
                } catch (e) {
                    alert('Exception while request...');
                }
            },
            error: function(request, textStatus, errorThrown) {
                alert('Sorry, We cannot find any customer you are looking for...');
            }
        });
    });
    $('#roomtype').change(function() {
        get_room_by_type();
    });

    // $('#roomtype').change(function() {
    //       dataString = "room_type=" + $('#roomtype').val();
    //       // console.log(dataString);
    //       $.ajax({
    //         type: "Get",
    //         dataType: 'json',
    //         url: "<?= site_url()?>admin/room/get_by_id",
    //         data: dataString,
    //         async: false,
    //         success: function(result) {
    //           try {
    //             var $el = $("#room_no");
    //                     $el.empty(); // remove old options
    //                     for (i = 0; i < result[0].length; i++) {
    //                       $el.append($("<option></option>")
    //                         .attr("value", result[0][i].id).text(result[0][i].room_no));
    //                     }

    //                   } catch (e) {
    //                     alert('Exception while request..');
    //                   }

    //                 },
    //                 error: function(request, textStatus, errorThrown) {


    //                 alert("Sorry Noting Found!");
    //               }

    //             });
    //       return false;
    //     });

    //multi room
    // Add room row
    $("#room_no").on("change", function() {
        var room_no = $('#room_no').val();
        var reserva_room_id = $("input[name='reserva_room_id[]']").map(function(){return $(this).val();}).get();
        var duration = $('#duration').val();
        var date_in = $('#date_in').val();
        var room_type = $('#roomtype').val();

        $.ajax({
            type: "get",
            async: false,
            dataType: 'json',
            data: {
                'room_id': room_no,
                'reserva_room_id': reserva_room_id,
                'date_in':date_in,
                'duration':duration,
                'room_type':room_type
            },
            url: "<?php echo site_url('admin/room/get_multiromm_ajax'); ?>",
            success: function(data) {
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
                $('#multi_room').append(data.datatable);
                $('#date_out').val(data.date_out);
                get_room_by_type();
                total_reservation_multy();
            },
            error: function(request, textStatus, errorThrown) {
                alert('Sorry, We cannot This Room ...');
            }
        });

    });

    $("#room_noa").on("change", function() {
        var room_id = $(this).val();
        var dtype = $('#day_type').val();
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                'room_id': room_id,
                'dtype': dtype
            },
            url: "<?php echo site_url('admin/room/get_multiromm_ajax'); ?>",
            async: false,
            success: function(result) {
                // console.log(result);
                // $("#reservation_group tbody").empty();
                $.each(result, function() {
                    var n_row = this.ro_id;
                    var n_rw = $('<tr id= "room_id_' + n_row + '" class="item_' + n_row + '"></tr>');
                    tr_html = '<td><input name="multi_rn[]" type="hidden" value="' + this.ro_id + '"><span id="row_' + this.ro_id + '">1</span></td>';
                    tr_html += '<td><input type="hidden" name="multi_room_id[]" value="' + this.ro_id + '"><input name="multi_room_type[]" type="hidden" value="' + this.ro_type + '"><span id="row_' + n_row + '">' + this.ro_type + '</span></td>';
                    tr_html += '<td><input name="multi_room_no[]" type="hidden" value="' + this.ro_no + '"><span id="row_' + n_row + '">' + this.ro_no + '</span></td>';
                    tr_html += '<td><input name="multi_stying_time[]" type="hidden" value="' + this.staying_time + '"><span>' + this.staying_time + '</span></td>';
                    tr_html += '<td><input name="multi_floor[]" type="hidden" value="' + this.floor + '"><span>' + this.floor + '</span></td>';
                    tr_html += '<td><input name="multi_room_price[]" class="room_price" type="hidden" value="' + this.room_price + '"><span>' + this.room_price + '</span></td>';
                    tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + n_row + '" title="Remove" style="cursor:pointer;"></i></td>';
                    n_rw.html(tr_html);
                    n_rw.prependTo("#multi_room");
                    $('#staying').prop('disabled', false);
                });

            }
            // console.log(n_row);
            // var $el = $("#multi_room");
            // $el.append(result);
            //  $('.order').each(function(index){
            //   $(this).text(index + 1);
            //   $('#staying').prop('disabled', false);

        });
    });

    $('#staying').blur(function() {
        var duration = $(this).val();
        $('.staying').val(duration);

        var multi_room = $('#multi_room tr');
        var sub_total = 0;
        multi_room.each(function(room) {
            // var duration = $(this).find('.staying').val();
            var price = $(this).find('.room_price').val();
            console.log(duration);

            var amount = duration * price;
            sub_total += amount;

        });

        $('#totals').val(sub_total);

        $(document).on("change keyup blur", "#discount", function() {
          alert('hello');
            total_reservation_multy();
        });


        // $("#date_in").on("blur", function() {
        //     var d = new Date($("#date_in").val());
        //     var m = moment(d);
        //     checkout = m.add("days", parseInt($("#staying").val())).format("YYYY-MM-DD HH:mm");
        //     $("#date_out").val(checkout);
        // });
    });


});
$("#date_in").on('change keyup blur', function() {
    var reserva_room_id = $("input[name='reserva_room_id[]']").map(function(){return $(this).val();}).get();
    if(reserva_room_id){
      $('#multi_room').html('');
    }
    total_reservation_multy();
});
$('#discount,#deposit_am').on('keyup',function(){
    total_reservation_multy();
});
$('#duration').on('keyup',function(){
    var reserva_room_id = $("input[name='reserva_room_id[]']").map(function(){return $(this).val();}).get();
    if(reserva_room_id){
      $('#multi_room').html('');
    }
    total_reservation_multy();
});
  function get_room_by_type(){
    var  room_type =  $('#roomtype').val();
    var reserva_room_id = $("input[name='reserva_room_id[]']").map(function(){return $(this).val();}).get();
    var duration = $('#duration').val();
    var date_in = $('#date_in').val();
    if(date_in == ''){
        swal({
            icon: 'warning',
            title: 'Warning',
            text: 'Please Select CheckIn Date !',
            type: 'warning'
        });
    }else{
      $.ajax({
          type: "Get",
          dataType: 'html',
          url: "<?= site_url()?>admin/room/get_by_roomtype_ajax",
          data: {
              'room_type':room_type,
              'reserva_room_id':reserva_room_id,
              'date_in':date_in,
              'duration':duration
          },
          success: function(result) {
              $('.room_no').chosen("destroy");
              $('#room_no').html(result);
              $('.room_no').chosen();
          },
          error: function(request, textStatus, errorThrown) {
              alert("Sorry Noting Found!");
          }
      });
    }
          
    return false;
  }
  // function remove_room_tr(id){
  //   $('#tr_room_id_'+id).closest('tr').remove();
  //   get_room_by_type();
  //   total_reservation_multy();
  // }

  $('.')
  function total_reservation_multy(){
    var reserva_room_id = $("input[name='reserva_room_id[]']").map(function(){return $(this).val();}).get();
    var reserva_rootype_id = $("input[name='reserva_rootype_id[]']").map(function(){return $(this).val();}).get();
    var reserva_chekin_type = $("input[name='reserva_chekin_type[]']").map(function(){return $(this).val();}).get();
    var date_in = $('#date_in').val();
    var deposit_am = $('#deposit_am').val();
    var discount = $('#discount').val();
    var duration = $('#duration').val();
      $.ajax({
          type: "POST",
          dataType: 'json',
          url: "<?= site_url()?>admin/room/total_reservation_multy",
          data: {
              'reserva_rootype_id':reserva_rootype_id,
              'reserva_room_id':reserva_room_id,
              'date_in':date_in,
              'duration':duration,
              'deposit_am':deposit_am,
              'discount':discount
          },
          success: function(result) {
              $('#multi_room').html(result.datatable);
              $('#date_out').val(result.date_out);
              $('#totals').val(result.total);
              $('#grand_total').val(result.grand_total);
          }
      });
  }
</script>