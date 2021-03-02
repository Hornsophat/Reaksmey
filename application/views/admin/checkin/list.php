    <div class="container top">
      <style type="text/css">
        .hide{
          display: none;
        }
        .table_reservation tbody tr th, .table_reservation tbody tr td{
          padding: 5px 10px;
        }
      </style>
      <?php 
        $user = $this->session->userdata('user_name');
        $permission = $this->db->query("SELECT * FROM tbl_employee WHERE user_name = '$user' ")->row();

        $hide = "";
        if($permission->type == 1)
        {
          $hide = "hide";
        }else if($permission->type == 2)
        {
          $hide = "";
        }
      ?>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
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
          <a  style="margin-left: 10px;" href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-sm btn-success"><?php echo lang('New Checkin');?></a>
           <a style="margin-left: 10px;"  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/multi_add" class="btn btn-sm btn-success"><?php echo lang('Multi Checkin');?></a>
          <!-- <a style="margin-left: 10px;"  href="<?php echo site_url();?>admin_checkin/read_card" class="btn btn-sm btn-primary"><?php echo lang('Read card');?></a> -->

          <!-- <a href="<?php echo site_url();?>admin_checkin/read_card" class="btn btn-primay">read card</a> -->
        </h2>
      </div>
      
       <?php

      if(isset($flash_message)){
        if($flash_message == 'checkout')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Well done!</strong> Success Check outed !';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
   
      <div class="row">
        <div class="span12 columns col-sm-12">
          <div class="well">
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_checkin = array();    
            foreach ($checkinfield as $array) {
              foreach ($array as $key => $value) {
                $options_checkin[$key] = $key;
              }
              break;
            }

            //print_r($options_checkin);

            echo form_open('admin/checkin', $attributes);
     
              echo form_label(lang('Search:'), 'search_string');
              echo form_input('search_string', $search_string_selected, 'class="form-control" placeholder="search customer"');

              echo form_label(lang('Order by:'), 'order');
              echo form_dropdown('order', $options_checkin, $order, 'class="span2 form-control"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => lang('Go'));

              $options_order_type = array('Asc' => 'ASC', 'Desc' => 'DESC');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

              echo form_submit($data_submit);

            echo form_close();

            ?>
            <!-- <div class="col-sm-5 pull-right" style="position: relative; top: -37px;">
              <div class="col-sm-4">
                
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                    <button  class="btn btn-primary all_checkout"><?php echo lang('CheckOut');?></button>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="form-group">
                    <button  class="btn btn-primary all_payment"><?php echo lang('Payment');?></button>
                  </div>
              </div>
            </div> -->


          </div>

          <?php 
            // date_default_timezone_set("Asia/Phnom_penh");
            // echo $today = date("G:i A"); 
          ?>

          <form name="form_checkout" class="form_checkout" id="form_checkout" method="post" action="<?php echo site_url('admin/checkout_all')?>">
            <div class="col-sm-12 store_check hide">
                <input type="checkbox" name="payment" id="payment" class="form-control payment">
            </div>
          </form>

          <?php 
            date_default_timezone_set("Asia/Phnom_penh");
            echo $timenow = date("Y-M-d G:i A");
          ?>
          <div class="">
            <table class="table table-striped table-bordered table-condensed" style="white-space: nowrap;">
              <thead>
                <tr style="text-align: center !important;">
                  <th class="header">#</th>
                  <!-- <th class="yellow header headerSortDown"><?php echo lang('ReserveID');?></th> -->
                  <th class="yellow header headerSortDown"><?php echo lang('Customer');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('Date In');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('Date Out');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('Room Type');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('Room Number');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('CheckIn Type');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('Duration');?></th>
                  <th class="yellow header headerSortDown"><?php echo lang('payment');?></th>
                  <th class="yellow header headerSortDown" colspan="6"  style="text-align:center;"><?php echo lang('Action');?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($checkin as $row)
                {
                  $disabled = ""; $disout ="";
                  if($row['pay'] == "unpay")
                  {
                    $paid = '<span class="label label-danger">Unpay</span>';
                    //$disout = "disabled";
                    $disout = '';
                  }else{
                    $paid = '<span class="label label-success">Paid</span>';
                    $disabled = "disabled";
                  }
                  $background = "";
                  if($row['reserv_id'] > 0){
                    $background = 'background: #ffeac4;';
                  }
                  if($this->lib_permission->checkactionexist('admin/view_reservation')){
                    $onclick = 'onclick="view_checkin('.$row['id'].');"';
                  }else{
                    $onclick = '';
                  }
                  $ro_no = '';
                  $type = '';
                  $c_id = $row['cid'];
                  $d_in = $row['date_in'];
                  $d_out = $row['date_out'];
                  $m_ch  = $row['m_ch'];
                  $mul  = $row['multi_checkin'];

                  $ro_no = $this->checkout_model->get_room_no_by_checkin_id($row['id']);
                  $type = $this->checkout_model->get_room_type_by_checkin_id($row['id']);
                  echo '<tr style="'.$background.'">';
                  echo '<td '.$onclick.'><input type="checkbox" value="'.$row['id'].'" name="ch_out" id="ch_out" class="ch_out"></td>';
                  // echo '<td>'.$row['reserv_id'].'</td>';
                  echo '<td '.$onclick.'>'.$row['customer_id'].'</td>';
                  echo '<td '.$onclick.'>'.date('d-m-Y H:i:s',strtotime($row['date_in'])).'</td>';
                  echo '<td '.$onclick.'>'.date('d-m-Y H:i:s',strtotime($row['date_out'])).'</td>';
                  //echo '<td>'.$row['room_type'].'</td>';
                  echo '<td '.$onclick.'>'.$type.'</td>';
                  echo '<td '.$onclick.'>'.$ro_no.'</td>';
                  echo '<td '.$onclick.'>'.$row['checkin_type'].'</td>';
                  echo '<td '.$onclick.'>'.$row['staying'].'</td>';
                  echo '<td>'.$paid.'</td>';

                  $customer_name = $this->customer_model->get_customer_id($row['customer_id']);
                  echo '<!--  <td class="'.$hide.'">
                    <a href="'.site_url("admin").'/checkin/update/'.$row['id'].'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon glyphicon-edit"></span></a> 
                    
                    </td> -->
                    <td> 
                      <div class="dropdown">
                        <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Action
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                          <li style="display:none;">
                              <a href="'.site_url("admin").'/checkin/update/'.$row['id'].'" class="" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon glyphicon-edit text-info"> Edit</span></a> 
                          </li>';
                          
                          echo '<li>
                              <a href="'.site_url("admin").'/extra/'.$row['id'].'" class="" data-toggle="tooltip" title="Extra Item" id="btnDel"><span class="glyphicon glyphicon-plus text-success"> Extra Item</span></a>
                          </li>';
                      if($row['pay'] != 'pay'){
                        echo '<li>
                              <a href="#" data="'.$row['id'].'" class="btnwrite" data-toggle="tooltip" title="write card" name="btnwrite" id="btnwrite"><span class="glyphicon glyphicon-inbox text-primary"> Write Card</span></a>
                          </li>
                          <li>
                              <a href="#" data="'.$row['id'].'" class="btnDis" data-toggle="tooltip" title="discount" name="btnDis" id="'.$row['id'].'"><span class="glyphicon glyphicon-minus text-success"> Discount</span></a>
                          </li>';
                        }
                         echo ' <li role="separator" class="divider"></li>
                          <li>';
                          if($row['checkout'] == 1){
                             echo '<a href="javascript:void(0)" class="" data-toggle="tooltip" title="Checkout" id="btnDel" disabled="disabled"><span class="glyphicon glyphicon-log-in text-danger">'.lang('CheckOut').' </span></a>';
                          }else{
                             echo '<a onclick="return confirm('."'Are you sure you want to Checkout this item?'".');" href="'.site_url("admin").'/checkout/out/'.$row['id'].'" class="" data-toggle="tooltip" title="Checkout" id="btnDel" '.$disout.'><span class="glyphicon glyphicon-log-in text-danger">'.lang('CheckOut').' </span></a>';
                          }
                          
                        echo '</li>
                          <li>';
                          if($row['pay'] == 'pay'){
                                echo '<a  href="javascript:void(0)" class="" data-toggle="tooltip" title="Payment" id="btnDel"  disabled="disabled"><span class="glyphicon glyphicon-bookmark text-success">'.lang('Payment').'</span></a>';
                          }else{
                            echo '<a onclick="return confirm('."'Are you sure you want to Payment this item?'".');" href="'.site_url("admin_checkin").'/payment_method/'.$row['id'].'/'.$customer_name->id.'" class="" data-toggle="tooltip" title="Payment" id="btnDel" '.$disable_pay.'><span class="glyphicon glyphicon-bookmark text-success">'.lang('Payment').'</span></a>';
                          }
                          echo '<a href="'.site_url("").''.'admin_checkin/'.'edit_checkin/'.$row['id'].'" class="" data-toggle="tooltip" title="Edit Checkin" id="btnDel" '.$disable_pay.'><span class="glyphicon glyphicon-bookmark text-success">'.lang('edit_checkin').'</span></a>';
                          echo '</li>
                        </ul>
                      </div>
                    </td>
                  </td>';
                  echo '</tr>';
                }
                ?> 

              </tbody>
            </table>
          </div>
         <?php echo $this->pagination->create_links(); ?> 

      </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Discount</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo site_url('admin_checkin/dis_invoice');?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Discount (Number or %)</label>
                  <input type="text" name="dis_in" class="form-control dis_in" id="dis_in">
                  <input type="hidden" name="rowDis_id" id="rowDis_id" class="form-control rowDis_id">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <input type="submit" name="btnsubmit" class="btn btn-sm btn-success btnsubmit">
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ================================================================================== -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
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
<!-- ================================================================================== -->
<div class="modal fade" id="view_checkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check-In Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -22px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <table class="table_reservation">
                <tbody id="checkin_data">
                  
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).on('click','.btnDis',function(){
    var row_id = $(this).attr('data');
    $('#myModal').modal('show');
    $('#rowDis_id').val(row_id);

    // alert(row_id);
  });
</script>
<script type="text/javascript">
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
    // =====================write card========================
      // $(function(){
      //   $('.btnwrite').on('click',function(){
      //     var id=$(this).attr('data');
      //     // alert(wri);
      //     var wri=confirm('do you want to write card?');
      //     if (wri == true) {
      //       window.location.href='http://localhost/sv_hotel/admin_checkin/write_card/'+id;
      //     }else{
      //       alert('Cancel write card!');
      //     }
          
      //   });
      // });
    //============================= payment 

    $('.all_payment').click(function(){
        $('.payment').prop('checked',true);
        $('.payment').val(1);

        if($('.ch_store').length > 0){
            $('.form_checkout').submit();

        }else{
          alert('please select customer to Payment');
        }
    });
    //============================= checkout
    $('.all_checkout').click(function(){
        $('.payment').prop('checked',true);
        $('.payment').val(2);

        if($('.ch_store').length > 0){
            $('.form_checkout').submit();

        }else{
          alert('please select customer to Checkout');
        }
    });
  });
  function view_checkin(id){
      $('#checkin_data').html('');
        $.ajax({
           type: "get",
           dataType : 'json',
               url:"<?php echo site_url()?>admin/view_checkin", 
               data: {checkin_id : id},
               async:false,
               success: function (result) {

                  $('#checkin_data').html(result);
                  $('#view_checkin').modal('show');
            },
            error: function (request, textStatus, errorThrown) {        
                 
            }
            
      });
  }
</script>

