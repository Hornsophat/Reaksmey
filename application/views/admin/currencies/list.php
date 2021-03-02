    
    <div class="container top">

      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("currencies"); ?>">
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
          <a  href="<?php echo site_url("currencies/add"); ?>" class="btn btn-sm btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns col-sm-12">
          <table class="table table-striped table-bordered table-condensed">
            <thead class="text-center" style="text-align: center;">
              <tr style="text-align: center !important;">
                <th class="header">#</th>
                <th class="yellow header headerSortDown">Currencies Code</th>
                <th class="yellow header headerSortDown">Currencies Name</th> 
                <th class="yellow header headerSortDown">Exchange Rate</th>
                <th class="yellow header headerSortDown">Symbol</th>
                <th class="yellow header headerSortDown">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach ($cur as $key => $row) {
            ?>
              <tr style="text-align: center !important;">
                <td><?php echo $row->id;?></td>
                <td><?php echo $row->cur_code; ?></td>
                <td><?php echo $row->cur_name; ?></td>
                <td><?php echo $row->cur_exchange; ?></td>
                <td><?php echo $row->symbol; ?></td>
                <td><a href="<?php echo base_url().'currencies/update/'.$row->id; ?>" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="<?php echo base_url().'currencies/delete/'.$row->id;?>" data-toggle="tooltip" title="Delete" style="color:#ff0000;"><span class="glyphicon glyphicon-remove"></span></a></td>
              </tr>
            <?php
              }
             ?>
            
            </tbody>
          </table>

         

      </div>
    </div>

    <script type="text/javascript">
          $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
          });
    </script>