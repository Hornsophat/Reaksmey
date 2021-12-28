    
<style>
    label { margin: 0 auto;}
    .label { margin: 7px 2px; }
    .text-width { width: 95px; }
    .line-top { border-top: 1px solid #ddd; margin-top: 5px; padding-top: 5px; }
    .panel-heading { min-height: 200px; padding: 0 10px!important; }
    .panel-footer { padding: 5px; }
    .badge { font-size: 14px; margin-top: 3px; }
</style>

    <div class="container top">
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo $this->session->userdata('user_name');?>
          </a> 
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

    <div class="page-header users-header">
      <h2>
        <?php echo ucfirst($this->uri->segment(2));?>
        <div class="pull-right">
          <label>Filter : </label>
          <button type="button" class="btn btn-default active" id="all">All</button>
          <button type="button" class="btn btn-default" id="available">Available</button>
          <button type="button" class="btn btn-default" id="reservation">Room Rent</button>
          <button type="button" class="btn btn-default" id="checkin">CheckIn</button>
        </div>
      </h2>
    </div>
    <div class="row" id="parent">
        <?php if(count($rooms) > 0) { ?>
            <?php foreach($rooms as $room) { ?>
            <?php
            $has_checkin = $this->dashboard_model->has_checkin($room->id);
            // var_dump($has_checkin);die();
            $has_reservation  = $this->dashboard_model->has_reservation($room->id);

            //change color of panel box
            if(count($has_checkin) > 0) { $boxcolor = 'panel-primary'; } 
            else if(count($has_reservation) > 0) { $boxcolor = 'panel-yellow'; } 
            else { $boxcolor = 'panel-default'; }

            //add add status type of panel box
            if(count($has_checkin) > 0) { $show_class = 'checkin'; }
            else if(count($has_reservation) > 0) { $show_class = 'reservation'; }
            else { $show_class = 'available'; }
            ?>
              <div class="col-md-3 <?php echo $show_class; ?>">
                <div class="panel <?php echo $boxcolor; ?>">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-xs-3">
                        <i class="fa fa-5x fa-building" aria-hidden="true"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $room->room_no; ?></div>
                        <div>
                          <span>Floor :</span>
                          <label class="text-width"><?php echo $room->floor; ?></label>
                          <div class="clearfix"></div>
                        </div>
                        <div>
                          <span>Type :</span>
                          <label class="text-width"><?php echo $room->type; ?></label>
                        </div>
                        <div>
                          <span>Price :</span>
                          <label class="text-width badge badge-default"><?php echo $this->dashboard_model->get_room_price($room->type_id); ?> $</label>
                        </div>
                      </div>
                      <?php if(count($has_checkin) > 0) { ?>
                        <div class="col-xs-12" id="reservation">
                          <div class="line-top">
                          <div> <a style="color:yellow" href="customer/view/<?php echo $has_reservation->cid  ?>"> Customer : <b><?php echo $has_reservation->family; ?></b></a></div>
                            <div>Phone : <b><?php echo $has_reservation->mobile; ?></b></div>
                            <div>Gender : <b><?php echo $has_reservation->gender; ?></b></div>
                            <div>Date In : <b><?php echo $has_checkin->date_in; ?></b></div>
                            <!-- <div>Date Out : <b><?php echo $has_checkin->date_out; ?></b></div> -->
                          </div>
                        </div>
                      <?php } else if(count($has_reservation) > 0) { ?>
                        <div class="col-xs-12" id="checkin">
                          <div class="line-top">
                          <div> <a style="color:yellow" href="customer/view/<?php echo $has_reservation->cid  ?>"> Customer : <b><?php echo $has_reservation->family; ?></b></a></div>
                            <div>Phone : <b><?php echo $has_reservation->mobile; ?></b></div>
                            <div>Gender : <b><?php echo $has_reservation->gender; ?></b></div>
                            <div>Date In : <b><?php echo $has_reservation->reservation_date; ?></b></div>
                            <!-- <div>Date Out : <b><?php echo $has_reservation->checkout_data; ?></b></div> -->
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="panel-footer">
                    <?php if(count($has_checkin) > 0) { ?>
                      <label class="pull-left label <?php echo $has_checkin->pay=='pay' ? 'label-success' : 'label-danger'; ?>">CheckIn (<?php echo $has_checkin->pay; ?>)</label>

                      <a onclick="return confirm('Are you sure you want to Checkout this Room?');" class="pull-right btn btn-sm btn-primary" data-toggle="tooltip" title="Checkout" href="<?php echo site_url('admin/checkout/out/'.$has_checkin->id); ?>"><img src="<?php echo site_url('assets/images/check-out-icon.png'); ?>" width="18"></a>
                      


                      <?php if($has_checkin->pay == 'unpay') { ?>
                          <a onclick="return confirm('Are you sure you want to Payment this Room?');" class="pull-right btn btn-sm btn-success" data-toggle="tooltip" title="Payment" href="<?php echo site_url('admin_checkin/payment_method/'.$has_checkin->id); ?>" style="margin-right:4px;">Pay</a>
                      <?php } ?>
                    <?php } else if(count($has_reservation) > 0) { ?>
                      <label class="pull-left label label-default">Room  (<?php echo $has_reservation->confirmed==1?'confirmed':'not confirmed'; ?>)</label>
                      <a class="pull-right btn btn-sm btn-danger" data-toggle="tooltip" title="Cancel" href="#" onclick="javascript:reserv_cancel(<?php echo $has_reservation->id; ?>)"><img src="<?php echo site_url('assets/images/cancel-icon.png'); ?>" width="18"></a>
                      <?php if($has_reservation->confirmed == 0) { ?>
                        <button type="button" id="confirm" class="pull-right btn btn-sm btn-success" data-toggle="tooltip" title="Confirm" onclick="javascript:reserv_confirm(<?php echo $has_reservation->id; ?>)" style="margin-right:4px;"><i class="fa fa-check"></i></button>
                      <?php } ?>
                    <?php } else { ?>
                      <div class="pull-right">
                        <a class="btn btn-sm btn-warning" data-toggle="tooltip" title="Reservation" href="<?php echo site_url('admin/reservation/add?type='.$room->type_id.'&id='.$room->id); ?>"><img src="<?php echo site_url('assets/images/booking-icon.png'); ?>" width="18"></a>
                        <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Checkin" href="<?php echo site_url('admin/checkin/add?type='.$room->type_id.'&id='.$room->id); ?>"><img src="<?php echo site_url('assets/images/check-in-icon.png'); ?>" width="18"></a>
                      </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            <?php } ?>
        <?php } else { echo 'Cannot find any room in our database!!'; } ?>
    </div>
    <!-- /.row -->

<script>
  $(document).ready(function() {
    var $btns = $(".btn").click(function() {
      if(this.id == "all") {
        $("#parent > div").fadeIn(450);
      } else {
        var $el = $("." + this.id).fadeIn(450);
        $("#parent > div").not($el).hide();
      }
      $btns.removeClass('active');
      $(this).addClass('active');
    });
  });

  function reserv_confirm(id) {
    $.ajax({
      type: "POST",
      dataType : 'json',
      url: "<?php echo site_url()?>admin/reservation/confirm", 
      data: {reserv_id : id},
      async:false,
      success: function (result) {
        try {
          $("#confirm").attr('disabled', true);
          alert("Success Confirmed !");
        }catch(e) {   
          alert('Exception while request..');
        }     
      },
      error: function (request, textStatus, errorThrown) {        
        var err = eval("(" + request.responseText + ")");
        alert(err.Message);
      }
    });
  }

  function reserv_cancel(id) {
    $.ajax({
      type : "POST",
      url : "<?php echo site_url('admin/show_rooms/reserv_cancel'); ?>",
      data : { reserv_id : id },
      async : false,
      success : function(result) {
        try {
          alert('Completely Cancel Reservation');
          setTimeout(function() { 
            window.location.reload();
          }, 1000);
        } catch(e) {
          alert("Exception while request...");
        }
      },
      error : function(request, textStatus, errorThrown) {
        var error = eval("(" + request.responseText + ")");
        alert(error);
      }
    });
  }
</script>