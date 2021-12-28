    <div class="container top">

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
          <!-- <a href="<?php echo site_url('cleaning/add')?>" class="btn btn-sm btn-success"><?php echo lang('Add a new');?></a> -->
        </h2>
        
      </div>
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">Ã</a>';
            if(isset($id))
  			{
            	echo '<strong>Well done!</strong> Update Item Success add to database';
            }else{
            	echo '<strong>Well done!</strong> New Item Success add to database';
            }
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
          <div class="well ">
           
            
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown"><?php echo lang('Date_out');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Room Type');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Room_number');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Status');?></th>
                <th colspan="2" class="yellow header headerSortDown text-center"><?php echo lang('Action');?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $i=0;
                  foreach ($room_clean as $row) {
                    // var_dump($row);die();
                    $i++
                  ?>
                  <?php 
                    $mul_det_s = $this->checkin_model->get_room_multy_id($row->room_no);     
                    $roo_no_arr = [];
                    foreach ($mul_det_s as $room_no) {
                       $roo_no_arr[] = $room_no->room_no;
                    }
                    $mul_det = implode(",", $roo_no_arr);
                  ?>
                <tr>
                    <td align="center"><?php echo $i ?></td>
                    <td><?php echo $row->date_out?></td>
                    <td><?php echo $row->type?></td>
                    <td><?php echo $row->room_no?></td>
                    <td align="center"><?php 
                      if ($row->cleaning_status == 1) {
                        echo '<span class="btn btn-xs btn-success">Cleaned</span>';
                      }else{
                        echo '<span class="btn btn-xs btn-warning">Not Clean</span>';
                      }
                    ?></td>
                    <?php 
                      if ($row->cleaning_status == 1) {
                      ?>
                      <td align="center"><a class="btn btn-xs btn-info" href="javascript:void(0)"><span class="glyphicon glyphicon-bookmark"> Clean</span></a></td>
                      <?php
                      }else{
                      ?>
                      <td  align="center"><a class="btn btn-xs btn-info" href="<?php echo site_url('admin/cleaning/update/'.$row->detail_id)?>"><span class="glyphicon glyphicon-bookmark"> Clean</span></a></td>
                      <?php  
                      }
                    ?>

                </tr>
              <?php
                  }
               ?>
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>