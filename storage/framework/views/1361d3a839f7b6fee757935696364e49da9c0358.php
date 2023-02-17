<?php
    $setting = generalSetting();
    if(isset($setting->copyright_text)){
    $copyright_text = $setting->copyright_text;
    }else{
    $copyright_text = 'Copyright 2019 All rights reserved by Codethemes';
    }
?>

</div>
</div>
<?php if(moduleStatusCheck('Lead')==true): ?>
    <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id="fullCalReminderModal_<?php echo e($item->id); ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span> <span class="sr-only"><?php echo app('translator')->get('common.close'); ?></span>
                    </button>
                </div>
                <div class="modal-body text-center">
                <?php echo $__env->make('lead::lead_calender', ['event' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.close'); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(config('app.app_sync')): ?>
    <a target="_blank" href="https://1.envato.market/9WVoZ3" class="float_button"> <i class="ti-shopping-cart-full"></i>
        <h3>Purchase InfixEdu</h3>
    </a>
<?php endif; ?>
<div class="has-modal modal fade" id="showDetaildModal">
    <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="showDetaildModalTile"><?php echo app('translator')->get('system_settings.new_client_information'); ?></h4>
                <button type="button" class="close icons" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBody">

            </div>
        </div>
    </div>
</div>
<!--  Start Modal Area -->
<div class="modal fade invoice-details" id="showDetaildModalInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('common.add_invoice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBodyInvoice">
            </div>
        </div>
    </div>
</div>
<!--================Footer Area ================= -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if(Auth::check()): ?>
                    <p><?php echo $copyright_text; ?> </p>
                <?php else: ?>
                    <p><?php echo $copyright_text; ?> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<!-- ================End Footer Area ================= -->

<script>
    window.jsLang = function(key, replace) {
        let translation = true

        let json_file = $.parseJSON(window._translations[window._locale]['json'])
        translation = json_file[key]
            ? json_file[key]
            : key


        $.each(replace, (value, key) => {
            translation = translation.replace(':' + key, value)
        })

        return translation
    }
</script>

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.data-tables.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.flash.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jszip.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/pdfmake.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/vfs_fonts.js"></script>
<script src="<?php echo e(asset('public/backEnd/js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.html5.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.print.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.rowReorder.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.responsive.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.colVis.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>


<script src="<?php echo e(asset('public/backEnd/js/metisMenu.js')); ?>"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/fastselect.standalone.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/moment.min.js"></script>

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap_datetimepicker.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/fullcalendar.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/vendors/js/fullcalendar-locale-all.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/select2/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/lesson_plan.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('public/')); ?>/js/registration_custom.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/daterangepicker.min.js"></script>
<script>
    pdfMake.fonts = {
        DejaVuSans: {
            normal: 'DejaVuSans.ttf',
            bold: 'DejaVuSans-Bold.ttf',
            italics: 'DejaVuSans-Oblique.ttf',
            bolditalics: 'DejaVuSans-BoldOblique.ttf'
        }
    };



        ;(function($){
        $.fn.datepicker.dates[_locale] = new Object({
            "days" : <?php echo json_encode(__('calender.days')); ?>,
            "daysShort": <?php echo json_encode(__('calender.daysShort')); ?>,
            "daysMin": <?php echo json_encode(__('calender.daysMin')); ?>,
            "months": <?php echo json_encode(__('calender.months')); ?>,
            "monthsShort": <?php echo json_encode(__('calender.monthsShort')); ?>,
            "today": <?php echo json_encode(__('calender.today')); ?>,
            "clear": <?php echo json_encode(__('calender.clear')); ?>

        })
    }(jQuery));

</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/editor/summernote-bs4.js"></script>
<script src="<?php echo e(url('Modules\Wallet\Resources\assets\js\wallet.js')); ?>"></script>

<script src="<?php echo e(asset('public/backEnd/')); ?>/js/lesson_plan.js"></script>


<script type="text/javascript">
    //$('table').parent().addClass('table-responsive pt-4');
    // for select2 multiple dropdown in send email/Sms in Individual Tab
    $("#selectStaffss").select2();
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });

    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectSectionss").select2();
    $("#checkbox_section").click(function() {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectSectionss > option").prop("selected", "selected");
            $("#selectSectionss").trigger("change");
        } else {
            $("#selectSectionss > option").removeAttr("selected");
            $("#selectSectionss").trigger("change");
        }
    });
</script>
<script>
    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : (event.keyCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/search.js"></script>


<?php echo Toastr::message(); ?>



<script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
<script src="<?php echo e(asset('public/chat/js/custom.js')); ?>"></script>





<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldPushContent('script'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
<?php if(moduleStatusCheck('Lead')==true): ?>

    <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $reminder_date_time=Carbon::parse($item->date_time)->format('Y-m-d').' '.$item->time;
        ?>
    <script>
        setInterval(() => {
                        let id = <?php echo e($item->id); ?>;
                        let reminder_date = '<?php echo e($reminder_date_time); ?>';
                        let current_time = moment().format('Y-M-D h:mm:ss a');
                        let current_time_integer = Date.parse(current_time);
                        let reminder_integer = Date.parse(reminder_date); 
                        console.log(current_time_integer,reminder_integer,id);
                        if(current_time_integer==reminder_integer) {
                        $('#fullCalReminderModal_'+id).modal('show');
                        }
                    }, 1000);
    </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>  

</body>

</html><?php /**PATH C:\xampp\htdocs\school_erp\resources\views/backEnd/partials/footer.blade.php ENDPATH**/ ?>