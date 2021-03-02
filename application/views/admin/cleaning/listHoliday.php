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
          <?php echo ucfirst($this->uri->segment(3));?>
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
          <div class="well hide">
           
            
          </div>

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">#</th>
                <th class="yellow header headerSortDown"><?php echo lang('Date');?></th>
                <th class="yellow header headerSortDown"><?php echo lang('Description');?></th>
                <th colspan="2" class="yellow header headerSortDown text-center"><?php echo lang('Action');?></th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $i=0;
                  foreach ($allHoliday as $row) {
                    // var_dump($row);die();
                    $i++
              ?>
                <tr>
                    <td align="center"><?php echo $i ?></td>
                    <td><?php echo date('Y-m-d',strtotime($row->date))?></td>
                    <td><?php echo $row->descripton?></td>
                    <td align="center">
                      <a href="#" class="edit" id="edit"><span class="fa fa-pencil-square-o" onclick="get_data_to_update(<?php echo $row->id;?>)"></span></a>
                      <a href="#" class="del" id="del"><span class="glyphicon glyphicon-minus" onclick="delete_holiday(<?php echo $row->id;?>)"></span></a>
                    </td>

                </tr>
              <?php
                  }
               ?>
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>
    <div id="edit_holyday" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Holiday</h4>
        </div>
        <form method="POST" action="<?php echo site_url('admin/cleaning/editHoliday')?>">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Date</label>
                  <input class="dtpicker form-control input-sm" type="text" id="date_holiday" name="d_holiday" value="">
                  <input type="hidden" name="ro_id" class="ro_id form-control" id="ro_id"> 
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea rows="3" class="form-control" name="holiday_dis" id="holiday_dis" value=""></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
       </form>
      </div>

    </div>
  </div>

    <script type="text/javascript">
      // $(document).on('click','.edit',function(){
      //   var id = $('.r_id').attr('id');
      //   $.ajax({
      //     type :'get',
      //     data:{id:id},
      //     url : '<?php echo site_url()?>admin/cleaning/updateHoliday',
      //     dataType:'Json',
      //     async:false,
      //     success:function(data){
      //       // console.log(data.descripton);
      //       $('#edit_holyday').modal();
      //       $('#date_holiday').val(data.date);
      //       $('#holiday_dis').val(data.descripton);
      //       $('#ro_id').val(data.id);
      //     }
      //   });
      // });

      // $(document).on('click','.del',function(){
      //   var id = $('.r_del').attr('id');
      //    var result = confirm("Are you sure you want to Confirm this item ?");
      //     if (result) {
      //       $.ajax({
      //         type : 'get',
      //         data : {id:id},
      //         url  : '<?php echo site_url()?>admin/cleaning/deletHoliday',
      //         dataType: 'Json',
      //         async:false,
      //         success:function(data){
      //           if (data = "delete success") {
      //             location.reload();
      //           }
      //           console.log(data);
      //         }
      //       });
      //     }
      //   });
      function delete_holiday(id){
        var result = confirm("Are you sure you want to Confirm this item ?");
          if (result) {
            $.ajax({
              type : 'get',
              data : {id:id},
              url  : '<?php echo site_url()?>admin/cleaning/deletHoliday',
              dataType: 'Json',
              async:false,
              success:function(data){
                if (data = "delete success") {
                  location.reload();
                }
                console.log(data);
              }
            });
          }
      }
      function get_data_to_update(id){
        $.ajax({
          type :'get',
          data:{id:id},
          url : '<?php echo site_url()?>admin/cleaning/updateHoliday',
          dataType:'Json',
          async:false,
          success:function(data){
            // console.log(data.descripton);
            $('#edit_holyday').modal();
            $('#date_holiday').val(data.date);
            $('#holiday_dis').val(data.descripton);
            $('#ro_id').val(data.id);
          }
        });
      }
    </script>