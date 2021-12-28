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

    <?php if ($not_verifued != 0 )
    {
        echo 
        '<div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        You have <strong>' . $not_verifued . '</strong> Not Verifyed Customer . Please check <a href=" ' . base_url() .'admin/customer">Customers List</a>
        </div>' ;
    } ?>
      <div class="page-header users-header">
        <h2>
            <?php echo ucfirst($this->uri->segment(2));?>
            <a href="<?php echo site_url("admin") ?>/checkin/add" class="btn btn-sm btn-default"><?php echo lang('New CheckIn') ; ?></a>
            <a href="<?php echo site_url('admin/show_rooms'); ?>" class="btn btn-sm btn-default">View All Rooms</a>
        </h2>
      </div>

    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-big glyphicon-time"></span>
                        </div>
                        <div class="col-xs-12 text-right">
                            <div class="time"><?php echo date("Y/m/d"); ?></div>
                            </br>
                            <div><?php echo date_default_timezone_get();  ?></div>
                            
                            <div class="huge"><?php echo $total_checkin; ?></div>
                            <div><?php echo lang('rooms');  ?></div>
                        </div>
                    </div>
                </div>
                     <a href="<?php echo site_url('admin/report/today-checkin'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">ចំនួនបន្ទប់ត្រូវបង់ប្រាក់ក្នុងខែនិង</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-5x fa-building"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $total_rooms; ?></div>
                            <div><?php echo lang('rooms');  ?></div>
                        </div>
                    </div>
                </div>
             
                <a href="<?php echo site_url('admin/show_rooms'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ground Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $ground_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"> </div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/first_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">First Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $first_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/second_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Second Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $second_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/third_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Third Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $third_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/four_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Four Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $four_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/five_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Five Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $five_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/six_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Six Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $six_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/seven_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Seven Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $seven_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <a href="<?php echo site_url('admin/eight_floor'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">Eight Floor</span>
                        <span class="pull-right" style="font-size:15px"><?php echo $eight_rooms; ?> </i><?php echo lang('rooms');  ?></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-big glyphicon-user"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $customer_count; ?></div>
                            <div><?php echo lang('Customer'); ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url("admin").'/customer/list' ?> ">
                    <div class="panel-footer">
                        <span class="pull-left"><?php echo lang('View Full list'); ?></span>                 
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-big glyphicon-eye-open"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $today_reserv ; ?></div>
                            <div>អតិថិជនដល់ថ្ងៃបង់ប្រាក់ និងគិតទាំងសម្ភារ </div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>admin/report/unpay">
                    <div class="panel-footer">
                        <span class="pull-left"><?php echo lang('View Details'); ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="glyphicon glyphicon-big glyphicon glyphicon-warning-sign"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $today_checkout; ?></div>
                            <div><?php echo lang('Today Check-Out !'); ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>admin/report/today-checkout">
                    <div class="panel-footer">
                        <span class="pull-left"><?php echo lang('View Details'); ?></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>