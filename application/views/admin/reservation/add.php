   <style>
   .alert { padding: 5px; margin-bottom: 10px; }
   .alert:last-child { margin-bottom: 20px; }
   form label:first-child {
      margin: 10px 0px 5px 5px;
  }
   </style>

    <div class="container top">      
      <ul class="breadcrumb">
        <li><a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li><a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
        <li class="active"><a href="#">New</a></li>
      </ul>
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

      $room_type = $this->input->get('type');
      $room_id = $this->input->get('id');

      //form validation
      echo validation_errors();
      
      echo form_open('admin/reservation/add', $attributes);
      ?>         
<div class="panel panel-default">
    <div class="panel-header">
        <div class="col-sm-12">
            <h3>Adding
                <?php echo ucfirst($this->uri->segment(2));?>
                
            </h3>
        </div>
    </div>
   
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <label><?php echo lang('Customer');?></label>
                <select class="form-control chosen customer" name="customer" id="customer">
                    <option value=""> select </option>
                    <?php foreach ($customer as $cus) {
                          echo "<option value='".$cus->id."'>".$cus->Family.' | '.$cus->Mobile."</option>";
                        } ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-4">
                <label><?php echo lang('Room Type');?></label>
                <?php if($room_type) { $disable = 'disabled'; } else { echo $disable = ''; } ?>
                <select class="form-control chosen roomtype" id="roomtype" name="roomtype" <?php echo $disable; ?>>
                    <option value=""> Select Room Type</option>
                    <?php foreach ($roomtype as $type) {
                          echo "<option value='".$type->id."' ";
                          echo $type->id==$room_type ? 'selected' : '';
                          echo ">".$type->type."</option>";
                        } ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-4">
                <label><?php echo lang('Room Number');?></label>
                <select class="form-control chosen room_ajax room" id="room_ajax" name="room">
                    <option value=""> Select Room </option>
                    <?php if($room_type OR $room_id) {
                        $result = $this->room_model->get_by_type($room_type);
                        foreach($result as $item) {
                          echo '<option value="'.$item['id'].'" ';
                          echo $item['id']==$room_id?'selected':'';
                          echo '>'.$item['room_no'].'</option>';
                        }
                      } ?>
                </select>
                <input type="hidden" name="room_id" value="<?php echo $room_id ? $room_id : '0'; ?>">
            </div>
        </div>
        <div class="row">
             <div class="col-md-3">
                <div class="form-group">
                  <label for="inputError" class="control-label"><?php echo lang('CheckIn Type');?></label>
                  <div class="col-sm-12">
                    <?php 
                      echo form_dropdown('staytime', '', set_value('staytime', $roomid), 'class="span2 form-control chosen stay_ajax" id="staytime"');
                     ?>
                    <input type="hidden" name="stay_time" value="<?php echo $roomid ? $roomid : '0'; ?>">                    
                  </div>
                </div>
              </div>
            <div class="col-sm-4 col-md-4 hide ">
                <label><?php echo lang('Staying Time');?></label>
                <select class="form-control input staytime" id="staytime1" name="staytime1">
                    <option value="" select hidden> Select Staying Time </option>
                    <?php foreach($staytime as $time) {
                        echo '<option value="'.$time['id'].'" ';
                        echo '>'.$time['time'].'</option>';
                      } ?>
                </select>
            </div>
            <div class="col-sm-4 col-md-4">
                <label><?php echo lang('Duration');?></label>
                <input class="per_day form-control" onclick="this.select();" type="text" oninput = "this.value=this.value.replace(/[^0-9.]/g,'');" id="per_day" name="per_day" value="0">
            </div>
            <div class="col-sm-4 col-md-4" id = "price_div">
                <label><?php echo lang('Price');?></label>
                <input class="form-control Price" type="text" id="Price" name="Price" readonly>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
              <label><?php echo lang('Start Date');?></label>
              <input class="dtpicker form-control" type="text" id="date_in" name="date_in" value="">
          </div>
          <div class="col-sm-4 col-md-4">
              <label><?php echo lang('End Date');?></label>
              <input class="form-control dtpickerend" type="text" id="date_out" name="date_out" value="" >
          </div>
          <div class="col-sm-4 col-md-4">
              <label>
                  <?php echo lang('total');?> </label>
              <input class="total form-control total" readonly type="text" id="total" name="total" value="0">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 col-md-8">
            <div class="row">  
                <div class="col-sm-6 col-md-6">
                    <label>Acc Type</label>
                    <select name="acc_name" class="form-control acc_name" id="acc_name">
                        <option>Please Select</option>
                        <?php 
                      foreach ($list_bank as $row) {
                        echo "<option value='".$row->id."'>".$row->account_name."</option>";
                      }
                   ?>
                    </select>
                </div>
                <div class="col-sm-6 col-md-6">
                    <label>Deposit Amount</label>
                    <input type="text" value="0" onclick="this.select();" onkeyup="total_reservation();" oninput = "this.value=this.value.replace(/[^0-9.%]/g,'');" name="deposit_am" class="form-control deposit_am" id="deposit_am">
                </div>
                <div class="col-sm-6 col-md-6">
                    <label>Acc Name</label>
                    <input type="text" value="" name="bank_acc_name" class="form-control bank_acc_name" id="bank_acc_name">
                </div>
                <div class="col-sm-6 col-md-6">
                    <label>Acc Number</label>
                    <input type="text" value="" oninput = "this.value=this.value.replace(/[^0-9]/g,'');" name="bank_acc_number" class="form-control bank_acc_number" id="bank_acc_number">
                </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Discount</label>
                  <input type="text" value="0" onclick="this.select();" onkeyup="total_reservation();" oninput = "this.value=this.value.replace(/[^0-9.%]/g,'');" name="discount_re" class="form-control" id="discount_re">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label style="color: #ff0500;">Grand Total</label>
                    <input type="text" value="0" name="grand_total" class="form-control grand_total input" id="grand_total" readonly>
                   
                </div>
                
              </div>
              
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-sm-4 col-md-4 col-sm-offset-8 col-md-offset-8">
              
          </div>
        </div> -->
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <label>
                    <?php echo lang('Note');?></label>
                <textarea class="form-control" name="note" id="note"></textarea>
            </div>
        </div>
        <div class="row">
            <br>
            <div class="form-actions col-sm-12 col-md-12 pull-right">
                <button class="btn btn-sm btn-primary" type="submit">
                    <?php echo lang('Save changes');?></button>
                <button class="btn btn-sm" type="reset">
                    <?php echo lang('Cancel');?></button>
            </div>
        </div>
    </div>
</div>  
      
      <?php echo form_close(); ?>
      
<script type="text/javascript">
  $(".chosen").chosen();
  //available room
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
        // try{
        total_reservation();
          
        //   // var $el = $("#room");
        //   // $el.empty(); // remove old options
        //   // for(i=0;i<result[0].length;i++)
        //   // {
        //   //   $el.append($("<option></option>")
        //   //   .attr("value", result[0][i].id).text(result[0][i].room_no));
        //   // }
        // }catch(e) {   
        //   alert('Exception while request..');
        // }
      },  
      error: function (request, textStatus, errorThrown) {

      //var err = eval("(" + request.responseText + ")");
      // alert(err.Message);
      alert ("Sorry Noting Found!");
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
  $("#roomtypes").on("change", function() {
    dataString = "room_type=" + $('#roomtype').val();
    $.ajax({
      type : "GET",
      dataType : "json",
      data : dataString,
      url : "<?php echo site_url('admin_staytime/get_available'); ?>",
      async : false,
      success : function(result) {
        try {
          var $el = $("#");
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

  $("#staytime").on('change', function() {
    total_reservation();
   //  var  dataString = "roomtype=" + $('#roomtype').val();
   // // var dataString = "id=" + $(this).val() + '&room_type=' + $("#roomtype").val();
   //  $.ajax({
   //    type : "GET",
   //    url : "<?php echo site_url('admin/staying/get_price_id'); ?>",
   //    data : dataString,
   //    dataType : "json",
   //    async:false,
   //    success : function(data) {
   //      $("#Price").val(data.price);
   //    },
   //    error : function() {
   //      $("#Price").val("");
   //    }
   //  });

   
  });
  $("#date_in").on('change',function(){
    total_reservation();
  });
  $("#date_in").on('blur',function(){
    total_reservation();
  });
  $("#room_ajax").on('change',function(){
    total_reservation();
  });
  //  $("#day_type").on('change',function(){
  //   var dt_id = $(this).val();
  //   var r_typeid = $('#roomtype').val();
  //   $.ajax({
  //     type: "GET",
  //     url : '<?php echo site_url('admin/staying/getDayType');?>',
  //     data:{dt_id:dt_id,r_typeid:r_typeid},
  //     dataType:'Json',
  //     async: false,
  //     success : function (result){
  //       $("#Price").val(result.addprice);
  //     },
  //     error : function(){
  //       $("#Price").val("");
  //     }

  //   });
  // });


  // $(".input").on('blur', function() {
  //   var total = 0;
  //   var checkout;
  //   var staytime = $("#staytime").find("option:selected").text();
  //   if(staytime == "Overnight") {
  //     //auto show date out time
  //     $("#date_in").on("blur", function() {
  //       var d = new Date($("#date_in").val());
  //       var m = moment(d);
  //       checkout = m.add("days", parseInt($("#per_day").val())).format("YYYY-MM-DD");
  //       $("#date_out").val(checkout);
  //     });
  //     total = parseInt($("#per_day").val()) * parseFloat($('#Price').val());
  //   } else if(staytime == "12Hour") {
  //     //auto show date out time
  //     $("#date_in").on("blur", function() {
  //       var d = new Date($("#date_in").val());
  //       var m = moment(d);
  //       checkout = m.add("hours", 12).format("YYYY-MM-DD");
  //       $("#date_out").val(checkout);
  //     });
  //     total = parseFloat($("#Price").val());
  //   } else if(staytime == "9Hour") {
  //     $("#date_in").on("blur", function() {
  //       var d = new Date($("#date_in").val());
  //       var m = moment(d);
  //       checkout = m.add("hours", 9).format("YYYY-MM-DD");
  //       $("#date_out").val(checkout);
  //     });
  //     total = parseFloat($("#Price").val());
  //   } else if(staytime == "6Hour") {
  //     //auto show date out time
  //     $("#date_in").on("blur", function() {
  //       var d = new Date($("#date_in").val());
  //       var m = moment(d);
  //       checkout = m.add("hours", 6).format("YYYY-MM-DD");
  //       $("#date_out").val(checkout);
  //     });
  //     total = parseFloat($("#Price").val());
  //   } else if(staytime == "3Hour") {
  //     //auto show date out time
  //     $("#date_in").on("blur", function() {
  //       var d = new Date($("#date_in").val());
  //       var m = moment(d);
  //       checkout = m.add("hours", 3).format("YYYY-MM-DD");
  //       $("#date_out").val(checkout);
  //     });
  //     total = parseFloat($("#Price").val());
  //   }

  //   $('#total').val(total);
  // });

  // $('#deposit').on('change',function(){
  //   var tval = $('#total').val();
  //   var dval = $(this).val();
  //   if (dval >= tval) {
  //     var result = confirm('deposit is bigger than total');
  //     if (result == 'TRUE') {
  //       $(this).val();
  //       return;
  //     }else{
  //       $('#deposit').empty();
  //       return;
  //     }
      
  //   }
  // });
  $('#per_day').on('keyup',function(){
      total_reservation();
      // var r_typeid = $('#roomtype').val();
      // var per_day = $('#per_day').val();
      // var d1 = $('#date_in').val();
      // var d2 = $('#date_out').val();
      //   $.ajax({
      //     type : 'get',
      //     url  : '<?php echo site_url();?>admin/room/getPriceByDay',
      //     data : {r_typeid:r_typeid,d1:d1,per_day:per_day},
      //     dataType: 'Json',
      //     async: false,
      //     success:function(data){
      //           $('#total').val(data);
      //         },
      //         error : function(){
      //           $("#Price").val("");
      //         }
      //   });
  });
  // $("#date_in,#per_day,#staytime").on('blur',function(){
  //       var r_typeid = $('#roomtype').val();
  //       var per_day = $('#per_day').val();
  //       var d1 = $(this).val();
  //       var d2 = $('#date_out').val();
  //         $.ajax({
  //           type : 'get',
  //           url  : '<?php echo site_url();?>admin/room/getPriceByDay',
  //           data : {r_typeid:r_typeid,d1:d1,per_day:per_day},
  //           dataType: 'Json',
  //           async: false,
  //           success:function(data){
  //                 $('#total').val(data);
  //               },
  //               error : function(){
  //                 $("#Price").val("");
  //               }
  //         });
  //     });
</script>
<script type="text/javascript">

  function total_reservation(){
      var room_type = $('#roomtype').val();
      var staing_time = $('#staytime').val();
      console.log(staing_time);
      var duration = $('#per_day').val();
      var price = $('#Price').val();
      var date_in = $('#date_in').val();
      var deposit_am = $('#deposit_am').val();
      var discount_re = $('#discount_re').val();
      var grand_total = $('#grand_total').val();
      var room_no = $('.room_ajax').val();
      // if(duration == ''){
      //   $('#per_day').val(0);
      // }
      // if(discount_re == ''){
      //   $('#discount_re').val(0);
      // }
      // if(deposit_am == ''){
      //   $('#deposit_am').val(0);
      // }
      $.ajax({
        type : 'POST',
        url  : '<?php echo site_url();?>admin/room/total_reservation',
        data : {room_type:room_type,
                staing_time:staing_time,
                duration:duration,
                price:price,
                date_in:date_in,
                deposit_am:deposit_am,
                discount:discount_re,
                grand_total:grand_total,
                room_no:room_no
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
              $('#total').val(data.total);
              $('#Price').val(data.price);
              $('#grand_total').val(data.grand_total);
              $('#date_out').val(data.date_out);
              
              var isMonth = data.isMonth;
              
              if(isMonth=='true')
              {
                $('#price_div').hide();
              }
            },
            error : function(){
              $("#Price").val(0);
            }
      });
  }
</script>
