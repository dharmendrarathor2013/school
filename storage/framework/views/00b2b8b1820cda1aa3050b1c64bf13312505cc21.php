<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('academics.class_routine_create'); ?>
<?php $__env->stopSection(); ?>
<style>
    .nice-select.bb .current {
      bottom: 10px;
     }

    .dloader_img_style{
        width: 40px;
        height: 40px;
    }

    .dloader {
        display: none;
    }

    .pre_dloader {
        display: block;
    }

</style>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('academics.class_routine_create'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('academics.academics'); ?></a>
                    <a href="#"><?php echo app('translator')->get('academics.class_routine_create'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('common.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                   
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'class_routine_new', 'method' => 'get', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                           
                            <div class="col-lg-6 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('common.select_class'); ?> *" value=""><?php echo app('translator')->get('common.select_class'); ?> *</option>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$class->id); ?>"  <?php echo e(isset($class_id)? ($class_id == $class->id?'selected':''):''); ?>><?php echo e(@$class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('common.select_section'); ?> *" value=""><?php echo app('translator')->get('common.select_section'); ?> *</option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('common.search'); ?>
                                </button>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if(isset($sm_weekends)): ?>
        <section class="mt-20">
            <div class="container-fluid p-0">
                <div class="row mt-40">
                    <div class="col-lg-6 col-md-6">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->get('academics.class_routine_create'); ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 pull-right">
                        <a href="<?php echo e(route('classRoutinePrint', [$class_id, $section_id])); ?>" class="primary-btn small fix-gr-bg pull-right" target="_blank"><i class="ti-printer"> </i> <?php echo app('translator')->get('academics.print'); ?></a>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-lg-12 student-details up_admin_visitor">
                        <ul class="nav nav-tabs tabs_scroll_nav" role="tablist">
                            <input type="hidden" name="routine_class_id" id="routine_class_id" value="<?php echo e($class_id); ?>">
                            <input type="hidden" name="routine_section_id" id="routine_section_id" value="<?php echo e($section_id); ?>">
                            <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link  <?php echo e(Session::get('session_day_id') !=null ? ( Session::get('session_day_id')==$sm_weekend->id ? 'active' :'') : ( $loop->index == 0 ? 'active' : '' )); ?> tab_link "  href="<?php echo e($sm_weekend->name); ?>" data-sm_weekend_id="<?php echo e($sm_weekend->id); ?>" role="tab" data-toggle="tab"><?php echo e(@$sm_weekend->name); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           
                            <li class="nav-item edit-button">
                                <?php if(userPermission(66)): ?>                                    
                                    <button  class="primary-btn small fix-gr-bg" onclick="addRowInRoutine();" id="addRowBtn"> <span class="ti-plus pr-2"></span> <?php echo app('translator')->get('common.add'); ?></button>
                                <?php endif; ?>
                                
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Start day wise routine  Tab -->
                           
                            <div role="tabpanel" class="tab-pane fade show active" >
                                <div class="white-box dloader" id=select_class_routine_loader>
                                    <div class="dloader_style mt-2 text-center">
                                        <img class="dloader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                    </div>
                                </div>
                                <div id="show_routine">

                                </div>
                               
                            </div>
                           
                            <!-- End day wise routine Tab -->
    
    
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
    <div class="modal fade" id="classRoutineDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle"><?php echo app('translator')->get('academics.delete_class_routine'); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        
                <div class="text-center">
                    <h4><?php echo app('translator')->get('common.are_you_sure_to_delete'); ?></h4>
                </div>
                
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.cancel'); ?></button>
                  
                    <button class="primary-btn fix-gr-bg"  id="classRoutineDeleteSubmitButton"><?php echo app('translator')->get('common.delete'); ?></button>
                     
                </div>
          
            </div>
            
          </div>
        </div>
      </div>


<?php $__env->startPush('script'); ?>
<?php if(isset($sm_weekends)): ?>
    <script> 
    $(document).on('click', '.tab_link', function(e){
        e.preventDefault();
        $('.tab_link').removeClass('active');
        $(this).addClass('active');
        let day_id = $(this).data('sm_weekend_id');

        addDayData(day_id);
    });

    $(document).ready(function(){
        addDayData($('.tab_link.active').data('sm_weekend_id'));
    })


    function addDayData(day_id){
        $('#show_routine').html('');  
        $('#select_class_routine_loader').removeClass('dloader').addClass('pre_dloader');

        var url          = $("#url").val();
        var day_id = day_id;
        var class_id = $('#routine_class_id').val();
        var section_id = $('#routine_section_id').val();
     
        var formData={
            day_id : day_id,
            class_id :class_id,
            section_id :section_id,
        };

        $.ajax({
                type: "post",
                data: formData,
                dataType: "html",
                url: url + "/" + "day-wise-class-routine",
             
                                                   
             success: function(data) {  

 

                 $('#show_routine').html(data);   
                 $('.niceSelect').niceSelect('destroy');        
                 $(".niceSelect").niceSelect();

                $(".primary-input.time").datetimepicker({
                format: "LT",  
                });  

                $('#select_class_routine_loader').removeClass('pre_dloader').addClass('dloader');

                                                   
            },
                                                
            error: function(data) {
                $('#select_class_routine_loader').removeClass('pre_dloader').addClass('dloader');
            }
     
                                                
            });

          
        //after fetch data by day id append to show_routine div
    }
                               
                
        
        addRowInRoutine = () => {
        $("#addRowBtn").button("loading");
        var tableLength = $("#classRoutineTable tbody tr").length;
        var url = $("#url").val();       

      let row_count = parseInt($('#row_count').val());
        var tr=`
        <tr id="row_${row_count}" class="0">
                                                    <td class="border-top-0"> 
                                                        <div class="input-effect">
                                                            <select class="niceSelect w-100 bb form-control" name="routine[${row_count}][subject]" id="subject" required>
                                                                <option data-display="<?php echo app('translator')->get('common.select'); ?> <?php echo app('translator')->get('academics.subject'); ?> *" value=""><?php echo app('translator')->get('common.select'); ?> <?php echo app('translator')->get('academics.subject'); ?> *</option>

                                                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        
                                                                <option value="<?php echo e(@$subject->subject_id); ?>"><?php echo e(@$subject->subject->subject_name); ?></option>
                                                            
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <span class="focus-border"></span>
                                                                <?php if($errors->has('subject')): ?>
                                                                <span class="invalid-feedback invalid-select" role="alert">
                                                                    <strong><?php echo e($errors->first('subject')); ?></strong>
                                                                </span>
                                                                <?php endif; ?>
                                                            </div>
                                                    </td>
                                                       
                                                    <td class="border-top-0"> 
                                                        <div class="row " id="teacher-div">
                                                            <div class="col-lg-12 mt-30-md">
                                                                <select class="niceSelect w-100 bb form-control" name="routine[${row_count}][teacher_id]" id="teacher_name">
                                                                    <option data-display="<?php echo app('translator')->get('common.select_teacher'); ?>" value=""><?php echo app('translator')->get('common.select_teacher'); ?> </option>
                                                                 
                                                                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                
                                                                            <option value="<?php echo e(@$teacher->id); ?>"><?php echo e(@$teacher->full_name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                  
                                                                    
                                                                </select>
                                                                <div class="pull-right loader loader_style" id="select_teacher_loader">
                                                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                                                </div>
                                                                <span class="text-danger" role="alert" id="teacher_error"></span>
                                                            </div>
                                                        </div>
                                                    </td> 

                                                    <td class="border-top-0">  
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input time  form-control<?php echo e(@$errors->has('start_time') ? ' is-invalid' : ''); ?>" required type="text" name="routine[${row_count}][start_time]" >
                                                                    <label style="top: -13;"><?php echo app('translator')->get('academics.start_time'); ?> *</label>
                                                                    <span class="focus-border"></span>
                                                                    <?php if($errors->has('start_time')): ?>
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong><?php echo e(@$errors->first('start_time')); ?></strong>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button class="" type="button">
                                                                    <i class="ti-timer"></i>
                                                                </button>
                                                            </div>
                                                        </div> 
                                                   
                                                    </td>   

                                                    <td class="border-top-0">   
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input time start_time_required  form-control<?php echo e(@$errors->has('end_time') ? ' is-invalid' : ''); ?>"  required type="text" name="routine[${row_count}][end_time]"  >
                                                                    <label style="top: -13;"><?php echo app('translator')->get('academics.end_time'); ?> *</label>
                                                                    <span class="focus-border"></span>
                                                                   <?php if($errors->has('end_time')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                                    </span>
                                                                    <span class="text-danger start_time_error"></span> 
                                                                <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button class="" type="button">
                                                                    <i class="ti-timer"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                 
                                                    <td class="border-top-0">
                                                        <div class="input-effect">
                                                            <input type="checkbox" id="isBreak[${row_count}]" class="common-checkbox is_break_checkbox" data-row_id="${row_count}" value="1"
                                                            name="routine[${row_count}][is_break]"
                                                            <?php echo e(isset($class_time)? ($class_time->is_break == 1? 'checked':''):''); ?>

                                                            >
                                                                <label for="isBreak[${row_count}]">Is Break</label>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0 ">
                                                        <div class="input-effect text-center">
                                                        <a href="" class="btn-primary" data-toggle="modal" data-target="#multipleDaysModal_${row_count}" > <i class="fa fa-calendar "></i></a>
                                                        </div>
                                                        <div class="modal fade" id="multipleDaysModal_${row_count}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content"> 
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><?php echo e(__('academics.multiple_day')); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>       
                                                <div class="modal-body">
                                                    <input type='checkbox' id="all_days_${row_count}" class='common-checkbox all_days' data-row_id="${row_count}" name='all_days[]' value='0'>
                                                    <label for='all_days_${row_count}'><?php echo e(__('academics.select_all')); ?></label>
                                                    <div class='row p-0'>

                                                        <?php $__currentLoopData = $sm_weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm_weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-lg-4 pr-0">
                                                            <input type="checkbox" class="common-checkbox day-checkbox day_${row_count}" value="<?php echo e($sm_weekend->id); ?>" data-row_id="${row_count}" id="day_<?php echo e($loop->index .'_${row_count}'); ?>"
                                                            name="routine[${row_count}][day_ids][]"  >
                                                                <label for="day_<?php echo e($loop->index .'_${row_count}'); ?>"><?php echo e($sm_weekend->name); ?></label>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>
                                                    <div class="col-lg-12 text-center ">
                                                    <div class="d-flex justify-content-between pull-right">
                                                            <button class="primary-btn fix-gr-bg pull right " data-dismiss="modal" >Okay</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </div>
                                        </div>
                                                    </td>
                                                    <td class="border-top-0">   
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-30-md">
                                                                <select class="niceSelect w-100 bb form-control" name="routine[${row_count}][room]" id="room" >
                                                                    <option data-display="<?php echo app('translator')->get('academics.select_room'); ?>" value=""><?php echo app('translator')->get('academics.select_room'); ?></option>
                                                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                      
                                                                        <option value="<?php echo e(@$room->id); ?>"><?php echo e(@$room->room_no); ?></option>
                                                                      
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <span class="text-danger" role="alert" id="room_error"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-top-0">
                                                     
                                                        <?php if(userPermission(249)): ?>

                                                           
                                                            <button class="removeRoutineRowBtn primary-btn icon-only fix-gr-bg" type="button">
                                                                <span class="ti-trash" ></span>
                                                                </button>

                                                        <?php endif; ?>  
                                            
                                                    </td>
                                                </tr>
                                                
                                    
        `;
              
       
        $("#classRoutineTable tbody").append(tr);
        $('#row_count').val(row_count + 1);
         

         $('.niceSelect').niceSelect('destroy');        
         $(".niceSelect").niceSelect();

         $(".primary-input.time").datetimepicker({
        format: "LT",
    });
    };

    
        $(document).on("change", '.all_days', function() {
            let day_id = $(this).data('row_id');
           
            $(".day_"+day_id).prop("checked", this.checked);
        });

        $(document).on("change", '.day-checkbox', function() {
            let day_id = $(this).data('row_id');          
            if ($(".day_"+day_id+":checked").length == $(".day_"+day_id).length) {
                $('#all_days_'+day_id).prop("checked", true);
            } else {
                $('#all_days_'+day_id).prop("checked", false);
            }
        });
        $(document).on("change", '.is_break_checkbox', function()  {
           
            let row_id = $(this).data('row_id');   

            let tr = $('#row_'+row_id);
            console.log(tr);
            if(tr.length > 0){
                if (this.checked) {
                    tr.find('.niceSelect').prop('disabled', true);
                     
                } else {
                    tr.find('.niceSelect').prop('disabled', false);                 
                }
            }
        });
        $(document).on("click", '.removeRoutineRowBtn', function(e) { 
      
            let class_routine_id = $(this).data('class_routine_id');
            
            if(!class_routine_id){         
                 $(this).parent().parent().remove();
            }else{
                let row_id = $(this).data('row_id'); 
                $('#classRoutineDeleteModal').modal('toggle');
                $("#classRoutineDeleteSubmitButton").unbind("click");
                $("#classRoutineDeleteSubmitButton").bind("click", function() {

                    var url          = $("#url").val();
                  
                    $.ajax({
                    type: "post",
                    data: {id : class_routine_id},
                    dataType: "html",
                    url: url + "/" + "delete-class-routine",
             
                                                   
                        success: function(data) {
                               
                                  $('#row_'+row_id).remove();
                                setTimeout(function() {
                                   
                                    toastr.success(
                                        "Operation Success!",
                                        "Success Alert", {
                                            iconClass: "customer-info",
                                        }, {
                                            timeOut: 2000,
                                        }
                                    );
                                }, 500);
                                $('#classRoutineDeleteModal').modal('hide');
                                // console.log(data);
                            },
                            error: function(data) {
                                console.log('error');
                                // setTimeout(function() {
                                //     toastr.error("Operation Not Done!", "Error Alert", {
                                //         timeOut: 5000,
                                //     });
                                // }, 500);
                            },
                                                        
                    });

               
                });

            }  



           
        });
   

    </script> 
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/impactinstitute.in/dev.impactinstitute.in/resources/views/backEnd/academics/class_routine_new.blade.php ENDPATH**/ ?>