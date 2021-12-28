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
        <li><a href="<?php echo site_url("admin"); ?>">List Staying </a></li>
        <li class="active">List Staying</li>
      </ul>

      <div class="page-header users-header">
        <h2>
         List Staying
          <!-- <a style="margin-left: 10px;" href="<?php echo site_url('admin/reservation/add_multi')?>" class="btn btn-sm btn-success"><?php echo lang('Add Multi');?></a>  -->
          <a style="margin-left: 10px;" href="<?php echo site_url('admin/reservation/add')?>" class="btn btn-sm btn-success"><?php echo lang('Add a new');?></a>
        </h2>
      </div>
      <div class="row">
        <div class="span12 columns col-sm-12">
          <div class="well">
           
            <?php
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_reservation = array();
            foreach ($reservationfield as $array) {
              foreach ($array as $key => $value) {
                $options_reservation[$key] = $key;
              }
              break;
            }

            

            echo form_open('admin/reservation', $attributes);
     
              echo form_label(lang('Search:'), 'search_string');
              echo form_input('search_string', $search_string_selected,'class="form-control"  placeholder="ថ្ងៃបង់ប្រាក់"');

              echo form_label(lang('Order by:'), 'order');
              echo form_dropdown('order', $options_reservation, $order, 'class="span2 form-control"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => lang('Go'));

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed" style="white-space: nowrap;">
            <thead>
              <tr>
                <th> <input type="checkbox"></th>
                <th class="yellow header headerSortDown"><?php echo lang('Customer');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Phone Number');?></th>
                <!-- <th class="yellow header headerSortDown"><?php echo lang('Room Type');?></th> -->
                <th class="yellow header headerSortDown"><?php echo lang('Room Number');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Reservation Type');?></th>
                <!-- <th class="yellow header headerSortDown"><?php echo lang('Checkin');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Checkout');?></th> -->
                <th class="yellow header headerSortDown">ថ្ងៃបង់ប្រាក់</th>
                <th class="yellow header headerSortDown"><?php echo lang('Duration');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Price');?></th>
                <!-- <th class="yellow header headerSortDown"><?php echo lang('Deposit');?></th> -->
                <th class="yellow header headerSortDown"><?php echo lang('Confirmed');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Action');?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $currentoffset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
              if($currentoffset == 0) {
                $currentserialnumber = 1;
              } else {
                $currentserialnumber = (($currentoffset - 1) * 10) + 1;
              }
              
              foreach($reservation as $row) 
              {
                if ($row['room_id'] == 0) {
                    $rimpol = array();
                    $rn = $this->db->query("SELECT reserv_id,room_number FROM tbl_multireservation WHERE reserv_id = '".$row['id']."'")->result();
                    foreach ($rn as $ro_item) {
                      $rimpol[] = $ro_item->room_number;
                      $ro_number = implode(',',$rimpol);
                    }
                    // var_dump($ro_number);die();
                }else{
                    $ro_number = $row['room_no'];
                }
                if($this->lib_permission->checkactionexist('admin/view_reservation')){
                  $onclick = 'onclick="view_reservartion('.$row['id'].');"';
                }else{
                  $onclick = '';
                }
                if( $row['confirmed'] != 1 ){
                echo '<tr>';
                echo '<td '.$onclick.'><input type="checkbox" value="'.$row['id'].'" name="ch_out" id="ch_out" class="ch_out"></td>';
                // echo '<td '.$onclick.'>'.$currentserialnumber++.'</td>';
                echo '<td '.$onclick.'>'.$row['Family'].'</td>';
                echo '<td '.$onclick.'>'.$row['Mobile'].'</td>';
                $room_type = [];
                if($row['is_multy'] == 1){
                  $id = $row['id'];
                  $room_types = $this->db->query("SELECT r_type.type FROM tbl_multireservation m_re INNER JOIN tbl_room room ON m_re.room_id = room.id INNER JOIN tbl_roomtype r_type ON room.type_id = r_type.id WHERE m_re.reserv_id = '$id' GROUP BY r_type.id")->result_array();
                  
                  foreach ($room_types as $type) {
                      $room_type[] = $type->type;
                      $room_t = implode(',',$room_type);
                  }
                  // echo '<td>'.$room_t.'</td>';
                  // echo '<td>'.$ro_number.'</td>';
                }else{
                  echo '<td>'.$row['room_type'].'</td>';
                  // echo '<td>'.$ro_number.'</td>';
                }
                // echo '<td '.$onclick.'>'.$ro_number.'</td>';
                echo '<td '.$onclick.'>'.$row['time'].'</td>';
                // echo '<td '.$onclick.'>'.$row['reservation_date'].'</td>';
                // echo '<td '.$onclick.'>'.$row['checkout_data'].'</td>';
                if($row['checkin_data'] == date('Y-m-d')){
                echo '<td style="background-color:rgb(255, 139, 135)" '.$onclick.'>'.$row['checkin_data'].'</td>';
                }else{
                  echo '<td '.$onclick.'>'.$row['checkin_data'].'</td>';
                }
                echo '<td '.$onclick.'>'.$row['duration'].'</td>';
                echo '<td '.$onclick.'>'.$row['price'].'</td>';
                // echo '<td '.$onclick.'>'.$row['deposit'].'</td>';
                if ($row['confirmed']==0 AND ($row['canceled'])==0)
                {
                  echo '<td style="text-align:center;"><span class="label label-danger" id="' . $row['id'] . '">Not Confirmed</span></td>';


                }else if ($row['confirmed']==1 AND ($row['canceled'])==0) {
                  echo '<td style="text-align:center;"><span class="label label-success">Confirmed</span></td>';
                }else if ($row['canceled']==1) {
                  echo '<td style="text-align:center;"><span class="label label-warning">Canceled</span></td>';
                }
                echo '<td class="crud-actions"> ' ;
                if ($row['confirmed']==0 )
                {
                  if($this->lib_permission->checkactionexist('admin/reservation/confirm') AND $row['canceled']==0){
                    echo '<a class="btn btn-sm btn-success" onclick="reserv_confirm('.$row['id'].')" data-toggle="tooltip" title="Confirm" id="btnVerify"><span class="glyphicon glyphicon-ok"></span></a>' ;
                   echo 
                  '<a  href="'.site_url("admin").'/reservation/update/'.$row['id'].'" style="display:none;" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon-edit"></span></a>
                  <a onclick="return confirm('."'Are you sure you want to cancel item?'".');" href="'.site_url("admin").'/reservation/cancel/'.$row['id'].'" class="btn btn-sm btn-warning '.$hide.'" data-toggle="tooltip" title="Cancel" id="btnDel"><span class="fa fa-window-close"></span></a>';
                  }else{
                    echo '<a class="btn btn-sm btn-danger" disabled data-toggle="tooltip" title="Confirm" id="btnVerify"><span class="glyphicon glyphicon-minus-sign"></span></a>' ;
                  }

                  


                }else{
                  echo '<a href="#" class="btn btn-sm btn-success" disabled data-toggle="tooltip" title="Confirm" id="btnVerify"><span class="glyphicon glyphicon-ok"></span></a>' ;
                }
                echo " " ;
                echo 
                  '<a  href="'.site_url("admin").'/reservation/update/'.$row['id'].'" style="display:none;" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon-edit"></span></a>
                  <a href="'.site_url("admin").'/reservation/delete/'.$row['id'].'" class="btn btn-sm btn-danger '.$hide.'" data-toggle="tooltip" title="Delete" id="btnDel"><span class="glyphicon glyphicon-trash"></span></a>';
               
              // echo  '<a class="btn btn-sm btn-danger" disabled data-toggle="tooltip" title="Confirm" id="btnVerify"><span class="glyphicon glyphicon-minus-sign"></span></a>';

              echo '</td>';
                echo '</tr>';
              }

              }
              ?>      
            </tbody>
          </table>

          <!-- <?php echo $this->pagination->create_links(); ?> -->

      </div>
    </div>
<div class="modal fade" id="view_reservartion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservation Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -22px;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <table class="table_reservation">
                <tbody id="reservartion_data">
                  
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
    // $(window).on('load',function(){
    //     view_reservartion(3);
    // });
    $('.reservation_id').on('click',function(){
        $id = $(this).val();
        if(id){
          view_reservartion(id);
        }
    });
</script>
<script type="text/javascript">
  function reserv_confirm(id)
  {   
    
      // var con=confirm('do you want to write card?');
      // if (con  == true) {
        var result = confirm("Are you sure you want to Confirm this item ?");
        if (result) {
         $.ajax({
         type: "POST",
         dataType : 'json',
             url:"<?php echo site_url()?>admin/reservation/confirm", 
             data: {reserv_id : id},
             async:false,
             success: function (result) {
              if (result == 'true') {
                    try{
                 console.log(result);
                      $('#' + id).removeClass('label label-danger').addClass('label label-success');
                      $('#' + id).text("Confirmed") ;
                      // alert("Success Confirmed !");
                      // window.location.href='<?php echo base_url("admin/checkin")?>';
                    }catch(e) {   
                    alert('Exception while request..');

                }  
              }
              
          },
          error: function (request, textStatus, errorThrown) {        
               var err = eval("(" + request.responseText + ")");
               alert(err.Message);
          }
          
           });
       }
      // }else{
      //   alert('cancel');
      // }
    
  }
  function view_reservartion(id){
    $('#reservartion_data').html('');
    $.ajax({
       type: "get",
       dataType : 'json',
          //  url:"<?php echo site_url()?>admin/view_reservation", 
           data: {reservation_id : id},
           async:false,
           success: function (result) {

              $('#reservartion_data').html(result);
              $('#view_reservartion').modal('show');
        },
        error: function (request, textStatus, errorThrown) {        
             
        }
        
         });

  }
</script>
