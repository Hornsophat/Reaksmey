<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .ob {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: 10px;
    }

    .ob li {
        width: 10%;
        margin: 0 10px 10px 0;
        float: left;
        position: relative;
    }

    .ob li .btn {
        width: 100%;
    }

    .ob li .sus_sale {
        width: 100%;
        padding: 10px 5px;
    }

    .ob li:nth-child(5n+5) {
        margin-right: 2;
    }

    .del-sus{
        background: #5bc0de; 
        padding: 6px 10px;
        color: #fff;
        cursor: pointer;
        position: absolute;
        right: 0;
        opacity: 0.4;
    }
    .all-sus p { margin-bottom: 2px; }
    .all-sus:hover .del-sus { opacity: 0.8; background: #31b0d5; }

    .control-button { background: #5bc0de; padding: 2px 3px; text-align: right; }
    .control-button .btn-default { border: none; }
    .control-button .btn-sm { padding: 0 8px; }
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header modal-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>
            <h4 class="modal-title" id="ajaxModalLabel">
                <?= lang('suspended_sales') ?>
            </h4>
        </div>
        <div class="modal-body" style="padding-bottom:0;">
            <?= $r ? $this->lang->line('click_to_add') : ''; ?>
            <div class="html_con"><?= $html ?></div>
            <div class="clearfix"></div>
        </div>

        <?php if ($page) { ?>
            <div class="modal-footer" style="padding:0;">
                <div class="text-center">
                    <div class="page_con"><?= $page ?></div>
                </div>
            </div> 
        <?php } ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.pagination a').attr('data-toggle', 'ajax');
        // $('.pagination').on('click', 'a', function (e) {
        //     e.preventDefault();
        //     var pg = $(this).attr("href");
        //     $.get(pg, function (data) {
        //         $('#myModal').find('.modal-dialog').html(data);
        //     });
        //     return false;
        // });
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

        $('.del-sus').click(function(){
            var id = $(this).attr('id');
            bootbox.confirm({
                message : "Are you sure you want to delete this bill?",
                buttons : {
                    confirm : {
                        label : "Yes",
                        className : "btn-success"
                    },
                    cancel : {
                        label : "Cancel",
                        className : "btn-danger"
                    }
                },
                callback : function(result) {
                    $.ajax({
                        url:"<?php echo site_url('admin/pos/delete')?>"+'/'+id,
                        async: false,
                        success: function(data){
                            $('.del-sus').closest('ul.ob li#sus_'+id).hide();
                            // alert(data);
                        },
                        error: function(data){

                        }
                    });
                }
            });
        });

        $('.pay_sus').on('click', function(e) {
            var sid = $(this).attr('id');
            if(count > 1) {
                bootbox.confirm("<?= $this->lang->line('leave_alert')?>", function(gotit) {
                    if(gotit == false) {
                        return true;
                    } else {
                        window.location.href = "<?= admin_url('pos/index'); ?>/" + sid + "?tag=payment";
                    }
                });
            } else {
                window.location.href = "<?= admin_url('pos/index'); ?>/" + sid + "?tag=payment";
            }
            return false;
        });
    });
</script>
