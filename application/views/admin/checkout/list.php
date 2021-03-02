    <style type="text/css">
      .pagination > ul{ list-style: none; }
      .pagination > ul > li{ float: left; border: 1px solid #ccc !important; padding: 5px 8px; margin: 0px 3px; }
      .pagination > ul > li.active{ background: #022241; color: #fff; }
    </style>
    <div class="container top">

      <ul class="breadcrumb">
        <li><a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(2));?></li>
      </ul>

      <div class="page-header users-header">
        <h2><?php echo ucfirst($this->uri->segment(2));?></h2> 
      </div>
      
      <div class="row">
        <div class="span12 columns col-sm-12">
          <div class="well">
            <?php $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');            
            //save the columns names in a array that we will use as filter         
            $options_checkout = array();
            $columns = array('id', 'date_in', 'date_out', 'staying', 'user', 'pay');
            foreach ($columns as $array) {
              $options_checkout[$array] = $array;
            }

            echo form_open('', $attributes);
            
            echo form_label(lang('Search:'), 'search_string');
            echo form_input('search_string', $search_string_selected, 'class="form-control" placeholder="'.lang('search customer').'"');

            echo form_label(lang('Order by:'), 'order');
            echo form_dropdown('order', $options_checkout, $order, 'class="span2 form-control"');

            $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => lang('Go'));

            $options_order_type = array('Desc' => 'Desc', 'Asc' => 'Asc');
            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

            // echo form_label('Filter:', 'filter');
            // $options_filter_type = array(''=>' select ', 'pay' => 'Pay', 'unpay' => 'Unpay');
            // echo form_dropdown('payment', $options_filter_type, '', 'id="payment" class="span1 form-control"');

            echo form_submit($data_submit);

            echo form_close();
            ?>
            <div class="col-sm-3 pull-right" style="position: relative; top: -37px">
              <div class="col-sm-7 hide">
                <div class="form-group">
                  <select class="form-control customer_out" name="customer_out" id="customer_out">
                    <option value=""> select customer </option>
                    <?php foreach ($customer as $cus) {
                      if($cus !='') {
                        echo "<option value='".$cus->id."'>".$cus->Name."</option>";
                      }
                    } ?>
                  </select>
                </div>
              </div>
              <!-- <div class="col-sm-4">
                <div class="form-group">
                  <button  class="btn btn-primary all_reciept">Reciept By Customer</button>
                </div>
              </div> -->
            </div>
          </div>

          <?php 
          date_default_timezone_set("Asia/Phnom_penh");
          echo $timenow = date("Y-M-d G:i A");
          ?>

          <form name="form_checkout" class="form_checkout" id="form_checkout" method="post" action="<?php echo site_url('admin/get_reciept_all')?>">
            <div class="col-sm-12 store_check hide"></div>
            <div class="store_customer hide"></div>
          </form>

          <table style="text-align:center; font-size:12px;" class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown"><?php echo lang('CheckinID');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Customer');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Date In');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Date Out');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Room Type');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Room Number');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('CheckIn Type');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Staying');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Payment');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('User');?></th>
                <th style="text-align:center"class="yellow header headerSortDown" colspan="3"><?php echo lang('Action');?></th>
              </tr>
            </thead>
            <tbody id="table-body">
              <?php
              foreach($checkout as $row)
              {         
                $disabled = '';       
                if($row['pay'] == 'pay') { $payment = "<span id='lblconfirm' class='label label-success'>paid</span>"; $disabled = 'disabled'; } 
                else { $payment = "<span id='lblconfirm' class='label label-danger'>unpaid</span>"; }

                $room_no = $this->checkout_model->get_room_no_by_checkin_id($row['id']);
                $type = $this->checkout_model->get_room_type_by_checkin_id($row['id']);
                echo '<tr>';
                echo '<td><input type="checkbox" value="'.$row['id'].'" name="ch_out" id="ch_out" class="ch_out" ></td>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['customer_id'].'</td>';
                echo '<td>'.$row['date_in'].'</td>';
                echo '<td>'.$row['date_out'].'</td>';
                echo '<td>'.$type.'</td>';
                echo '<td>'.$room_no.'</td>';
                echo '<td>'.$row['checkin_type'].'</td>';
                echo '<td>'.$row['staying'].'</td>';
                echo '<td>'.$payment.'</td>';
                echo '<td>'.$row['user'].'</td>';
                echo '<td>
                <a href="'.site_url("admin").'/reciept/'.$row['id'].'/'.$row['cid'].'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Reciept" id="btnEdit"><span class="">'.lang('Reciept').'</span></a>                   
              </td>';
              echo '<td><button type="button" value="'.$row['id'].'" id="btnpay" onclick="pay('.$row['id'].')" class="btn btn-sm btn-success" '.$disabled.'>'.lang('Payment').'</button></td>';
              echo '<td><a onclick="return confirm('."'Are you sure you want to Eject this item?'".');" href="'.site_url("admin").'/eject/'.$row['id'].'" class="btn btn-sm btn-info">'.lang('Eject').'</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>

        <?php echo $this->pagination->create_links(); ?>
      </div>
    </div>

    <script type="text/javascript">
      // $("#btnpay").click(function() {
      //   var id = $(this).val();
      //   $.ajax({
      //     url : "<?php echo site_url('admin/pay'); ?>/" + id,
      //     success : function(respond) {
      //       $("#lblconfirm").removeClass("label label-danger").addClass("label label-success");
      //       $("#lblconfirm").text("paid");
      //       $("#btnpay").prop('disabled', true);
      //       alert('Payment is successfully!');
      //     },
      //     error : function() {
      //       alert('something error');
      //     }
      //   });
      // });
      function pay(id) {

        var result = confirm("Are you sure you want to Confirm this item ?");
        if (result) {
          $.ajax({
            url : "<?php echo site_url('admin/pay'); ?>/" + id,
            success : function(response) {
              var con = confirm('Payment is successfully!');
              if(con == true) {
                location.reload();
              }
              // $("#lblconfirm").removeClass("label label-danger").addClass("label label-success");
              // $("#lblconfirm").text("paid");
              // $("#btnpay").prop('disabled', true);
              // alert('Payment is successfully!');
            },
            error : function() {
              alert('something error');
            }
          });
        }

      }
      // $("#payment").change(function() {
      //   var status = $(this).val();
      //   $.ajax({
      //     type : 'GET',
      //     url : '<?php echo base_url();?>/admin/checkout/get_payment',
      //     success : function(response) {
      //       $("#table-body").html(response);
      //     },
      //   });
      // });

      $(function(){

        $('.ch_out').change(function(){
          var chid = $(this).val();
          if($(this).prop('checked'))
          { 
            $('.store_check').append("<input type='text' name='ch_store[]' class='form-control ch_store' value='"+ chid +"'>");
          }else{
            $('.ch_store').each(function(){
              var ch = $(this).val();
              if(chid == ch)
              {
                $(this).remove();
              }
            });
          }
          
        });

        $('.customer_out').change(function(){
          var cus = $(this).val();
          if(cus){
            $('.store_customer').append("<select name='store_cus' id='store_cus' class='store_cus'>"+"<option value='"+ cus +"'>"+ cus +"</optio>"+"</select>");
          }else{
            $('.store_customer').html('');
          }
        });

        $('.all_reciept').click(function(){
        var c = $('.customer_out').val();
        if($('.ch_store').length > 0){
          $('.form_checkout').submit();
        }else{
          alert('please select customer and room to payment');
        }

      });
      });
  </script>