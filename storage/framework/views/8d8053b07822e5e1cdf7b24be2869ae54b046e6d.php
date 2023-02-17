<?php $__env->startSection('title'); ?>
Student Log
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Student Log</h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('reports.reports'); ?></a>
                <a href="#">Student Log</a>
            </div>
        </div>
    </div>
</section>
<style>
    .modal-content .modal-body {
        padding: 40px 50px;
        max-height: 502px;
        overflow: auto;
        background: white;
        color: black;
        font-size: 1em;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
    }
    pre{
        overflow: unset;
    }
</style>


<style>
    body{

}

.table_container {
  display: flex;
  justify-content: center;
  align-items: center;
}

ul {
  padding-left:0px;
  list-style:none;
  margin-top:1rem;
}



.btn {
  cursor:pointer;
}

.details {
  display: none;
}

.details .open {
  display: table-cell;
}
    </style>


<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Student Log Report</h3>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="" class="table_container">
                         <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Role</th>
        <th>IP Address</th>
		<th>User Agent</th>
		  <th>Action</th>
      </tr>
    </thead>
    <tbody>
		 <?php
		//echo "<pre>"; print_r($user_data);die;
         foreach ($user_data as $key => $row) { 
		   $student_id =  $row->id;
			 
		$logs = 	 DB::table('sm_student_logs')->select('datetime')
				  ->where('user_id', $student_id)
				 ->get();
                                                                 
		?>
      <tr>
        <td><?= $row->full_name; ?></td>
         <td><?= $row->role; ?></td>
		<td><?= $row->ip_address; ?></td>
       <td><?= $row->user_agent; ?></td>
        <td>
          <button class="btn btn-info show-details">
            show details <i class="fa fa-angle-down" aria-hidden="true"></i>
          </button>
          <ul class="details">
			  <?php
			 
			  foreach ($logs as $key => $log) {  ?>
                 <li><?php echo $log->datetime;?></li>
			  <?php } ?>
          </ul>
        </td> 
      </tr>
  <?php }  ?>
 
    </tbody>
  </table>  
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>


<script>
$(document).ready(function(){
  $('.show-details').click(function(){
    console.log($(this).find('.fa.fa-angle-down'));
    $(this).find('i')
           .toggleClass('fa-angle-down fa-angle-up');
    
    $(this).siblings('.details')
           .toggleClass('open')
           .slideToggle('milliseconds');
   });
});


</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/reports/student_report.blade.php ENDPATH**/ ?>