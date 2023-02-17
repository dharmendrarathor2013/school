<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('style.color_style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <style type="text/css">
        .bg-color{
            width: 20px;
            height: 20px;
            text-align: center;
            padding: 0px;
            margin: 0 auto;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('style.color_style'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('style.style'); ?></a>
                    <a href="#"><?php echo app('translator')->get('style.color_style'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('style.color_style_list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('common.sl'); ?></th>
                                        <th><?php echo app('translator')->get('common.title'); ?></th>
                                        <th>Search Box Color</th>
                                        <th>Pagination Color</th>
                                        <th>Button Color</th>
                                        <th><?php echo app('translator')->get('style.title_color'); ?></th>
                                        <th><?php echo app('translator')->get('style.text_color'); ?></th>
                                        <th>Sidebar Submenu</th>
										<th><?php echo app('translator')->get('style.sidebar_bg'); ?></th>
										
                                        <th><?php echo app('translator')->get('common.status'); ?></th>
										 <th><?php echo app('translator')->get('common.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php @$count=1; ?>
                                <?php $__currentLoopData = $color_styles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background_setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$count++); ?></td>
                                        <td><?php echo e(@$background_setting->style_name); ?></td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color2); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color2); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->primary_color3); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->primary_color3); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->title_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->title_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->text_color); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->text_color); ?></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->sidebar_bg); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->sidebar_bg); ?></div>
                                            </div>
                                        </td>
										
										
										
										
										
										  <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: <?php echo e(@$background_setting->sidebar_bg2); ?>"></div>
                                                </div>
                                                <div class="col-lg-9"><?php echo e(@$background_setting->sidebar_bg2); ?></div>
                                            </div>
                                        </td>
										
										
										
										
										
                                        <td>

                                            <?php if($background_setting->is_active==1): ?>
                                                <label class="primary-btn small fix-gr-bg "><?php echo app('translator')->get('style.activated'); ?></label>
                                            <?php else: ?>
                                                <?php if(userPermission(491)): ?>
                                                    <a class="primary-btn small tr-bg"
                                                    href="<?php echo e(route('make-default-theme',@$background_setting->id)); ?>">
                                                        <?php echo app('translator')->get('style.make_default'); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
										<td>
										  
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <?php echo app('translator')->get('common.select'); ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deletebackground_settingModal<?php echo e(@$background_setting->id); ?>"
                                                            href="<?php echo e(@$background_setting->id); ?>"><?php echo app('translator')->get('common.edit'); ?></a>

                                                    </div>
                                                </div>
										</td>
										
										
										
										
										<div class="modal fade admin-query"
                                                    id="deletebackground_settingModal<?php echo e(@$background_setting->id); ?>">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><?php echo app('translator')->get('common.edit'); ?></h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <?php echo e(Form::open([
                                                                    'class' => 'form-horizontal',
                                                                    'files' => true,
                                                                    'url' => 'color-style-list-update',
                                                                    'method' => 'POST',
                                                                    'enctype' => 'multipart/form-data',
                                                                ])); ?>

                                                                <input type="hidden" id="id" name="id"
                                                                    value="<?php echo e(@$background_setting->id); ?>">



                                                                <div class="">
                                                                    <label for="onecolor">Search Box Color:</label>
                                                                    <input type="color" id="primary_color"
                                                                        name="primary_color"
                                                                        value="<?php echo e(@$background_setting->primary_color); ?>" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Pagination Color:</label>
                                                                    <input type="color" id="primary_color2"
                                                                        name="primary_color2"
                                                                        value="<?php echo e(@$background_setting->primary_color2); ?>" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																   <div class="">
                                                                    <label for="onecolor">Button Color: &nbsp; &nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="primary_color3"
                                                                        name="primary_color3"
                                                                        value="<?php echo e(@$background_setting->primary_color3); ?>" style="width: 70%;"><br>
                                                                </div>
																
																
																
																

                                                                <div class="">
                                                                    <label for="onecolor">Title Color:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="title_color"
                                                                        name="title_color"
                                                                        value="<?php echo e(@$background_setting->title_color); ?>" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Text Color:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="text_color" name="text_color"
                                                                        value="<?php echo e(@$background_setting->text_color); ?>" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Sidebar<br> Submenu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="color" id="sidebar_bg"
                                                                        name="sidebar_bg"
                                                                        value="<?php echo e(@$background_setting->sidebar_bg); ?>" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																    <div class="">
                                                                    <label for="onecolor">Sidebar<br> Background:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="color" id="sidebar_bg2"
                                                                        name="sidebar_bg2"
                                                                        value="<?php echo e(@$background_setting->sidebar_bg2); ?>" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																
																
																
																
																

                                                                <div class="mt-40 d-flex justify-content-between">
                                                                    

                                                                    <button type="submit"
                                                                        class="primary-btn fix-gr-bg"><?php echo app('translator')->get('common.update'); ?>
                                                                    </button>

                                                                    

                                                                </div>

                                                                <?php echo e(Form::close()); ?>


                                                            </div>


                                                        </div>


                                                    </div>


                                                </div>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/systemSettings/color_theme.blade.php ENDPATH**/ ?>