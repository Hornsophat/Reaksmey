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
          <a href="<?php echo site_url('item/add')?>" class="btn btn-sm btn-success"><?php echo lang('Add a new');?></a>
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
          <div class="well hide">
           
            <?php
           
            // $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            // //save the columns names in a array that we will use as filter         
            // $options_checkout = array();    
            // foreach ($checkin as $array) {
            //   foreach ($array as $key => $value) {
            //     $options_checkout[$key] = $key;
            //   }
            //   break;
            // }

            // echo form_open('admin/checkout', $attributes);
     
            //   echo form_label('Search:', 'search_string');
            //   echo form_input('search_string', $search_string_selected, 'class="form-control"');

            //   echo form_label('Order by:', 'order');
            //   echo form_dropdown('order', $options_checkout, $order, 'class="span2 form-control"');

            //   $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

            //   $options_order_type = array('Asc' => 'Asc', 'Desc' => 'Desc');
            //   echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

            //   echo form_submit($data_submit);

            // echo form_close();
            ?>

          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown"><?php echo lang('ItemID');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Item Name');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Price');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Quantity');?></th>
                <th colspan="2" class="yellow header headerSortDown text-center"><?php echo lang('Action');?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $currentoffset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;
              if($currentoffset == 0) {
                $currentserialnumber = 1;
              } else {
                $currentserialnumber = $currentoffset + 1;
              }
              foreach($listitem as $row)
              {
                echo '<tr>';
                echo '<td></td>';
                echo '<td>'.$currentserialnumber++.'</td>';
                echo '<td>'.$row->p_name.'</td>';
                echo '<td>'.$row->price.'</td>';
                echo '<td>'.$row->qty.'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("item/edit").'/'.$row->pid.'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit Item" id="btnEdit"><i class="fa fa-pencil-square-o" aria-hidden"true"></i>'.lang('Edit').'</a>                   
                </td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("item/del").'/'.$row->pid.'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Delete Item" id="btnEdit"><i class="fa fa-times-circle" aria-hidden="true"></i>'.lang('Delete').'</a>                   
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>