<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('library.add_book'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('library.add_book'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('library.library'); ?></a>
                    <?php if(isset($editData)): ?>
                        <a href="#"><?php echo app('translator')->get('library.edit_book'); ?></a>
                    <?php else: ?>
                        <a href="#"><?php echo app('translator')->get('library.add_book'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
          <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-6">
                    <div class="main-title ">
                        <h3 class="mb-30">
                            <?php if(isset($editData)): ?>
                                <?php echo app('translator')->get('library.edit_book'); ?>
                            <?php else: ?>
                                <?php echo app('translator')->get('library.add_book'); ?>
                            <?php endif; ?>
                           
                    </div>
                </div>
            </div>
            <?php if(isset($editData)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('update-book-data',$editData->id), 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <?php else: ?>
                <?php if(userPermission(300)): ?>
        
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'save-book-data',
                    'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <?php endif; ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->make('backEnd.partials.alertMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="white-box">
                        <div class="">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input
                                            class="primary-input form-control<?php echo e($errors->has('book_title') ? ' is-invalid' : ''); ?>"
                                            type="text" name="book_title" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->book_title :(old('book_title')!=''? old('book_title'):'')); ?>">
                                        <label><?php echo app('translator')->get('library.book_title'); ?> <span>*</span> </label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('book_title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('book_title')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select
                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('book_category_id') ? ' is-invalid' : ''); ?>"
                                            name="book_category_id" id="book_category_id">
                                            <option data-display="<?php echo app('translator')->get('library.select_book_category'); ?> *"
                                                    value=""><?php echo app('translator')->get('common.select'); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($editData)): ?>
                                                    <option
                                                        value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->book_category_id? 'selected':''); ?>><?php echo e($value->category_name); ?></option>
                                                <?php else: ?>
                                                    <option
                                                        value="<?php echo e($value->id); ?>" <?php echo e(old('book_category_id')!=''? (old('book_category_id') == $value->id? 'selected':''):''); ?> ><?php echo e($value->category_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('book_category_id')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('book_category_id')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <select
                                            class="niceSelect w-100 bb form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?>"
                                            name="subject" id="subject">
                                            <option data-display="<?php echo app('translator')->get('common.select_subjects'); ?>"
                                                    value=""><?php echo app('translator')->get('common.select'); ?></option>
                                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($editData)): ?>
                                                    <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->book_subject_id? 'selected':''); ?>><?php echo e($value->subject_name); ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo e($value->id); ?>" <?php echo e(old('subject')!=''? (old('subject') == $value->id? 'selected':''):''); ?> ><?php echo e($value->subject_name); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('subject')): ?>
                                            <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input
                                            class="primary-input form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>"
                                            type="text" name="book_number" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->book_number: old('book_number')); ?>">
                                        <label><?php echo app('translator')->get('library.book_no'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('book_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('book_number')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                            </div>

                            <div class="row mb-30">
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="numberCheckWithDot(this)"
                                            class="primary-input form-control<?php echo e($errors->has('isbn_no') ? ' is-invalid' : ''); ?>"
                                            type="text" name="isbn_no" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->isbn_no: old('isbn_no')); ?>">
                                        <label><?php echo app('translator')->get('library.isbn_no'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('isbn_no')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('isbn_no')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input
                                            class="primary-input form-control<?php echo e($errors->has('publisher_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="publisher_name" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->publisher_name: old('publisher_name')); ?>">
                                        <label><?php echo app('translator')->get('library.publisher_name'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('publisher_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('publisher_name')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input
                                            class="primary-input form-control<?php echo e($errors->has('author_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="author_name" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->author_name: old('author_name')); ?>">
                                        <label><?php echo app('translator')->get('library.author_name'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('author_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('author_name')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-30">

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input
                                            class="primary-input form-control<?php echo e($errors->has('rack_number') ? ' is-invalid' : ''); ?>"
                                            type="text" name="rack_number" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->rack_number: old('rack_number')); ?>">
                                        <label><?php echo app('translator')->get('library.rack_number'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('rack_number')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('rack_number')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
 

                            </div>

                            <div class="row mb-30">

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="numberMinCheck(this)"
                                            class="primary-input form-control<?php echo e($errors->has('quantity') ? ' is-invalid' : ''); ?>"
                                            type="text" name="quantity" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->quantity : old('quantity')); ?>">
                                        <label><?php echo app('translator')->get('library.quantity'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('quantity')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('quantity')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <input oninput="numberMinZeroCheck(this)"
                                            class="primary-input form-control<?php echo e($errors->has('book_price') ? ' is-invalid' : ''); ?>"
                                            type="text" name="book_price" autocomplete="off"
                                            value="<?php echo e(isset($editData)? $editData->book_price : old('book_price')); ?>">
                                        <label><?php echo app('translator')->get('library.book_price'); ?></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('book_price')): ?>
                                            <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('book_price')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row md-20">
                                <div class="col-lg-12">
                                    <div class="input-effect sm2_mb_20 md_mb_20">
                                        <textarea class="primary-input form-control" cols="0" rows="4" name="details"
                                                  id="details"><?php echo e(isset($editData) ? $editData->details : old('details')); ?></textarea>
                                        <label><?php echo app('translator')->get('common.description'); ?> <span></span> </label>
                                        <span class="focus-border textarea"></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                          <?php 
                              $tooltip = "";
                              if(userPermission(300)){
                                    $tooltip = "";
                                }else{
                                    $tooltip = "You have no permission to add";
                                }
                            ?>
                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php if(isset($editData)): ?>
                                        <?php echo app('translator')->get('library.update_book'); ?>
                                    <?php else: ?>
                                        <?php echo app('translator')->get('library.save_book'); ?>
                                    <?php endif; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

        </div>
      
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/library/addBook.blade.php ENDPATH**/ ?>