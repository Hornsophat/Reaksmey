<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header modal-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>
            <h4 class="modal-title" id="ajaxModalLabel">
                <?= lang('Transfer Food') ?>
            </h4>
        </div>
        <div class="modal-body" style="padding-bottom:0;">
            <?= $r ? $this->lang->line('click_to_add') : ''; ?>
            <div class="html_con"><?= $html ?></div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <label>Transfer Table From</label>
                <?php 
                
                    $fopt[''] = lang('Select').' '.lang('Tabele From');
                    foreach ($item_sus as $row) {
                        $fopt[$row->id] = $row->customer;
                    }
                    echo form_dropdown('table_form',$fopt,(isset($_POST['table_form'])?$_POST['table_form'] : ""),'class="form-control frant" id="frant"');

                ?>
            </div>
            <div class="col-md-12">
                <label>Transfer Table To</label>
                <?php 
                
                    $topt[''] = lang('Select').' '.lang('Tabele To');
                    foreach ($item_sus as $row) {
                        $topt[$row->id] = $row->customer;
                    }
                    echo form_dropdown('table_to',$topt,(isset($_POST['table_to'])?$_POST['table_to'] : ""),'class="form-control trant" id="trant"');

                ?>
            </div>
            <div class="col-md-3 pull-right">
                <button style="float: right;margin-top:5px;" type="submit" class="btn btn-success btn_transfer" id="btn_transfer">Transfer</button>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.pagination a').attr('data-toggle', 'ajax');
        $('.sus_sale').on('click', function (e) {
            var sid = $(this).attr("id");
            if (count > 1) {
                bootbox.confirm("<?= $this->lang->line('leave_alert') ?>", function (gotit) {
                    if (gotit == false) {
                        return true;
                    } else {
                        window.location.href = "<?= admin_url('pos/index') ?>/" + sid;
                    }
                });
            } else {
                window.location.href = "<?= admin_url('pos/index') ?>/" + sid;
            }
            return false;
        });

        $('select[name="table_form"]').change(function()
        {
            var table_from = $(this).val();   
            $('select[name="table_to"] option[value=' + table_from + ']').hide();      
            $('select[name="table_to"] option:not("[value=' + table_from + ']")').show();
        });

        $('#btn_transfer').on('click',function(){
            var from_id = $('#frant').find(':selected').val();
            var too_id = $('#trant').find(':selected').val();
            if(too_id == ''){
                bootbox.alert('plese select table too');
            }
            if (from_id == '') {
                bootbox.alert('plese select table from');
            }
            // if (too_id == from_id) {
            //     bootbox.alert('Value must be Defferent');
            // }
            $.ajax({
                type:'GET',
                url: '<?php echo admin_url("pos/get_transferTable");?>',
                dataType:'JSON',
                data:{from_id:from_id,too_id:too_id},
                async:false,
                success:function(data){
                    // console.log(data);
                    if (data) {
                        location.reload();
                    }
                }
            });

        });
    });
</script>
