<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('library.book_list'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('library.book_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('library.library'); ?></a>
                <a href="#"><?php echo app('translator')->get('library.book_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
    <div class="row mt-40">
        <div class="col-lg-12">
           <div class="row">
               <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead> 
                            
                            <tr>
                                <th><?php echo app('translator')->get('library.book_title'); ?></th>
                                <th><?php echo app('translator')->get('library.book_no'); ?></th>
                                <th><?php echo app('translator')->get('library.isbn_no'); ?></th>
                                <th><?php echo app('translator')->get('student.category'); ?></th>
                                <th><?php echo app('translator')->get('common.subject'); ?></th>
                                <th><?php echo app('translator')->get('library.publisher_name'); ?></th>
                                <th><?php echo app('translator')->get('library.author_name'); ?></th>
                                <th><?php echo app('translator')->get('library.quantity'); ?></th>
                                <th><?php echo app('translator')->get('library.price'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                        
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(@$value->book_title); ?></td>
                                <td><?php echo e(@$value->book_number); ?></td>
                                <td><?php echo e(@$value->isbn_no); ?></td>
                                <td>
                                <?php if(!empty(@$value->book_category_id)): ?>
                                    <?php echo e(@$value->bookCategory->category_name); ?>

                                <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!empty(@$value->book_subject_id)): ?>
                                        <?php echo e(@$value->bookSubject->subject_name); ?>

                                    <?php endif; ?>
                                </td>
                                <td><?php echo e(@$value->publisher_name); ?></td>
                                <td><?php echo e(@$value->author_name); ?></td>
                                <td><?php echo e(@$value->quantity); ?></td>
                               <td><?php echo e(@$value->book_price); ?></td>
                                
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/studentPanel/studentBookList.blade.php ENDPATH**/ ?>