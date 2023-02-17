<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('exam.question_bank'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('exam.examinations'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.examinations'); ?></a>
                <a href="#"><?php echo app('translator')->get('exam.question_bank'); ?></a>
            </div>
        </div>
    </div>
</section>


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="row">
        <div class="">
            <div class="main-title">
                
            </div>
        </div>
		
		 <div class="offset-lg-3 col-lg-3 text-right mb-20">
            <a href="<?php echo e(url('question-bank')); ?>">
                <button class="primary-btn tr-bg text-uppercase bord-rad">
                    Question Bank List
                </button>
            </a>
        </div>
        <div class="offset-lg-3 col-lg-3 text-right mb-20">
            <a href="<?php echo e(url('/public/backEnd/bulksample/questionbanks.xlsx')); ?>">
                <button class="primary-btn tr-bg text-uppercase bord-rad">
                    <?php echo app('translator')->get('exam.download_sample_file'); ?>
                    <span class="pl ti-download"></span>
                </button>
            </a>
        </div>
    </div>
</section>

<?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'qbank_bulk_store',
            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'qbank_form'])); ?>

                <div class="row">
                    <div class="col-lg-12">


                        <div class="white-box">
                            <div class="">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                
                                <div class="row mb-40 mt-30">
                                    <div class="col-lg-3">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control" type="text"
                                                        id="placeholderPhoto" placeholder="Excel file" readonly="">
                                                    <span class="focus-border"></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="photo">Browse</label>
                                                    <input type="file" class="d-none" name="file" id="photo">
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php echo app('translator')->get('exam.save_bulk_question_bank'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/examination/import_question_bank.blade.php ENDPATH**/ ?>