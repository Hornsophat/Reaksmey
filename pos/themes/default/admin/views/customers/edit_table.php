<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('edit_customer'); ?></h4>
        </div>
        <?php $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo admin_form_open_multipart("customers/edit_table/" . $customer->id, $attrib); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group person">
                        <?= lang("name", "name"); ?>
                        <?php echo form_input('name', $customer->name, 'class="form-control tip" id="name" required="required"'); ?>
                    </div>
                    <div class="form-group">
                              <?php   $floor = array('Restaurant'=>'Restaurant','Swimming Pool'=>'Swimming Pool');
                                $fl[''] = lang('Select').' - '.lang('Floor');
                                foreach ($floor as $index=>$row) {
                                    $fl[$index]=$row;
                                }
                                echo form_dropdown('floor',$fl,(isset($_POST['floor'])?$_POST['floor']:$customer->tbl_location),'class="form-control floor" id="floor"');
                             ?>   
                    </div>
                    <div class="form-group hide">
                        <?= lang("phone", "phone"); ?>
                         <?php echo form_input('address', $customer->phone, 'class="form-control" id="phone"'); ?>
                    </div>
                    <div class="form-group hide">
                        <?= lang("address", "address"); ?>
                        <?php echo form_input('address', $customer->address, 'class="form-control" id="address"'); ?>
                    </div>
                    <div class="form-group hide">
                        <?= lang("city", "city"); ?>
                        <?php echo form_input('city', $customer->city, 'class="form-control" id="city"'); ?>
                    </div>
                    <div class="form-group hide">
                        <?= lang("state", "state"); ?>
                        <?php echo form_input('state', $customer->state, 'class="form-control" id="state"'); ?>
                    </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="uploadForm">
                        
                    </div>
                    <input type="file" name="userfile" id="files"/>

                </div>

            </div>
        </div>
        <div class="modal-footer">
            <?php echo form_submit('edit_customer', lang('edit_table'), 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
