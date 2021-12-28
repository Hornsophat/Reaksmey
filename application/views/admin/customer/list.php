    

    <div class="container top">
      <ul class="breadcrumb">
        <li><a href="<?php echo site_url("admin"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
        <li class="active"><?php echo ucfirst($this->uri->segment(2));?></li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-sm btn-success"><?php echo lang('Add a new');?></a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns col-sm-12">
          <div class="well">           
            <?php           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            // $options_customer = array();    
            // foreach ($customer as $array) {
            //   foreach ($array as $key => $value) {
            //     $options_customer[$key] = $key;
            //   }
            //   break;
            // }

            $options_customer = array();
            $columns = array('id', 'Family', 'Gender', 'Age', 'Passport', 'Mobile', 'email');
            foreach($columns as $array) {
              $options_customer[$array] = $array;
            }

            echo form_open('', $attributes);
     
            echo form_label(lang('Search:'), 'search_string');
            echo form_input('search_string', $search_string_selected, 'class="form-control"');

            echo form_label(lang('Order by:'), 'order');
            echo form_dropdown('order', $options_customer, $order, 'class="span2 form-control"');

            $options_order_type = array('Desc' => 'Desc', 'Asc' => 'Asc');
            echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="span1 form-control"');

            $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => lang('Go'));
            echo form_submit($data_submit);

            echo form_close();
            ?>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown"><?php echo lang('Customer');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Age');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Nationality');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Passport / ID Card');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Mobile');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Email');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('roomtype');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('room');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Verified');?></th>
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

              foreach($customer as $row) {
                echo '<tr>';
                echo '<td>'.$currentserialnumber++.'</td>';
                echo '<td>'.$row['Family'].'</td>';
                echo '<td>'.$row['Age'].'</td>';
                echo '<td>'.$row['Nationality'].'</td>';
                echo '<td>'.$row['Passport'].'</td>';
                echo '<td>'.$row['Mobile'].'</td>';
                echo '<td>'.$row['email'].'</td>';
                echo '<td>'.$row['type'].'</td>';
                echo '<td>'.$row['room_no'].'</td>';
                if ($row['verifyed']==0) {
                  echo '<td style="text-align:center;"><span class="label label-danger" id="' . $row['id'] . '">Not Verifyed</span></td>';
                } else if ($row['verifyed']==1) {
                   echo '<td style="text-align:center;"><span class="label label-success">Verifyed</span></td>';
                }
                echo '<td class="crud-actions"> ' ;
                if ($row['verifyed']==0) {
                  echo '<a href="#" class="btn btn-sm btn-success" onclick="javascript:verify(' .$row['id'] . ')" data-toggle="tooltip" title="Verify" id="btnVerify"><span class="glyphicon glyphicon-ok"></span></a>' ;
                } else {
				          echo '<a href="#" class="btn btn-sm btn-success" disabled data-toggle="tooltip" title="Verify" id="btnVerify"><span class="glyphicon glyphicon-ok"></span></a>' ;
				        }
				        echo " " ;
                echo 
                '<a href="'.site_url("admin").'/customer/update/'.$row['id'].'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon glyphicon glyphicon-edit"></span></a>                   
                <a href="'.site_url("admin").'/customer/view/'.$row['id'].'" class="btn btn-sm btn-info" data-toggle="tooltip" title="Edit & View" id="btnEdit"><span class="glyphicon	glyphicon glyphicon-list-alt"></span></a>                   
                <a href="'.site_url("admin").'/customer/delete/'.$row['id'].'" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete" id="btnDel"><span class="glyphicon glyphicon-trash"></span></a>
                <a style="display:none" href="'.site_url("assets").'/pdf/'.$row['id'].'.pdf" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Delete" id="btnDel"><span >Contract</span></a>
                </td>';
                echo '</tr>';
                
              }
              
              ?>      
            </tbody>
          </table>
          <?php echo $this->pagination->create_links(); ?>
      </div>
    </div>
    
    <script type="text/javascript">
      function verify(id) {
        $.ajax({
          type: "POST",
          dataType : 'json',
          url: "<?= site_url()?>admin/customer/verify",
          data: {cus_id : id},
          async:false,
          success: function (result) {
            try{
              $('#' + id).removeClass('label label-danger').addClass('label label-success');
              $('#' + id).text("Verified") ;
              alert("Success verifyed !");
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
    </script>
