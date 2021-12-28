    
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
          <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-sm btn-success"><?php echo lang('Add a new');?></a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns col-sm-12">
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
//             save the columns names in a array that we will use as filter         
            $options_room = array();    
            $columns = array('id', 'room_no', 'type_id', 'floor');
            foreach ($columns as $array) {
                $options_room[$array] = $array;
            }

            echo form_open('admin/room', $attributes);
     
              echo form_label(lang('Search:'), 'search_string');
              echo form_input('search_string', $search_string_selected,'class="form-control" placeholder="search room no"');

              echo form_label(lang('Order by:'), 'order');
              echo form_dropdown('order', $options_room, $order, 'class="span2 form-control"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => lang('Go'));

              $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

              echo form_submit($data_submit);

            echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <!--<th class="header">#</th>-->
                <th class="yellow header headerSortDown"><?php echo lang('Room Number');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Room Type');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Floor');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Status');?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $row_id=1;
              foreach($room as $row)
              {
                echo '<tr>';
                //echo '<td>'.$row_id.'</td>';
                echo '<td>'.$row['room_no'].'</td>';
                echo '<td>'.$row['type_id'].'</td>';
                echo '<td>'.$row['floor'].'</td>';
                if ($row['status']=='b')
                {
                    echo '<td style="text-align:center;"><span class="label label-important">Bussy</span></td>';
                }else if ($row['status']=='f') {
                    echo '<td style="text-align:center;"><span class="label label-success">Free</span></td>';
                }
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/room/update/'.$row['id'].'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon glyphicon-edit"></span></a>                   
                  <a href="'.site_url("admin").'/room/delete/'.$row['id'].'" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete" id="btnDel"><span class="glyphicon glyphicon-trash"></span></a>
                  <a style="display:none" href="'.site_url("admin").'/room/view/'.$row['id'].'" class="btn btn-sm btn-success" data-toggle="tooltip" title="view" id="btnDel"><span class="glyphicon  glyphicon-list-alt"></span></a>
                </td>';
                echo '</tr>';
                $row_id+=1;
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>