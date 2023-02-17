
<?php
    $generalSetting= generalSetting();
    $languages = systemLanguage();
    $styles = allStyles();

?>
<style>
    #livesearch a{  text-align: left; display: block; }
    .languageChange .list{    padding-top: 40px !important;}
    .infix_theme_rtl .list{    padding-top: 40px !important;}
    .infix_theme_style .list{    padding-top: 40px !important;}
    p.date {
        font-size: 11px;
    }

    .mr-10.text-right.bell_time {
        text-align: right;
        margin-right: 0;
        padding-right: 0;
        position: relative;
        left: 22px;
    }

    .profile_single_notification i {
        margin-bottom: 20px;
    }

    .profile_single_notification span.ti-bell {
        font-size: 12px;
        margin-right: 5px;
        display: inline-block;
        overflow: hidden;
    }

    /* .dropdown-item:last-child .profile_single_notification {background: #;background: #000;} */

    .profile_single_notification.d-flex.justify-content-between.align-items-center {
        /* background: red; */
        margin-bottom: 10px !important;
        margin-top: 10px !important;
    }
    .admin .navbar .right-navbar .dropdown .message.notification_msg {
        font-size: 12px;
        max-width: 127px;
        max-height: auto !important;
        overflow: visible !important;
        -webkit-transition: all 0.4s ease 0s;
        -moz-transition: all 0.4s ease 0s;
        -o-transition: all 0.4s ease 0s;
        transition: all 0.4s ease 0s;
        line-height: 1.4;
        white-space: normal;

    }
    .admin .navbar .right-navbar .dropdown .message {
        max-height: initial !important;
    }

    /* sctolled_notify  */
    .sctolled_notify {
        max-height: 300px;
        overflow: auto;
    }
</style>
<style>
    .nice-select.open .list { min-width: 200px;  left: 0;  padding: 5px; }
    .nice-select .nice-select-search { min-width: 190px; }
</style>
<?php
    $coltroller_role=1;
?>

<nav class="navbar navbar-expand-lg up_navbar" id="main-nav-for-chat">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class='up_dash_menu'>
                    <div id="sidebarCollapse" class="sidebar_icon  d-lg-none btn nav_icon">
                        <i class="ti-more"></i>
                    </div>
                    <div class="collaspe_icon open_miniSide">
                        <i class="ti-menu"></i>
                    </div>

                    <ul class="nav navbar-nav mr-auto search-bar ml-0">
                        <li class="">
                            <div class="input-group" id="serching">
                            <span>
                                <i class="ti-search" aria-hidden="true" id="search-icon"></i>
                            </span>
                                <input type="text" class="form-control primary-input input-left-icon" placeholder="<?php echo app('translator')->get('common.search'); ?>"
                                       id="search" onkeyup="showResult(this.value)"/>
                                <span class="focus-border"></span>
                            </div>
                            <div id="livesearch"></div>
                        </li>
                    </ul>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto nav_icon" type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        
                        <div class="client_thumb_btn">
                            <?php if(!empty(profile())): ?>
                                <img class="client_img" src="<?php echo e(asset(profile())); ?>" alt="Profile Pic">
                            <?php else: ?>
                                <img class="client_img" src="<?php echo e(asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="Profile Pic">
                                
                            <?php endif; ?>
                        </div>
                    </button>
                    <div class="collapse navbar-collapse flex-end" id="navbarSupportedContent">
                        <ul class="nav navbar-nav mr-auto nav-buttons flex-sm-row">
                            <?php if( generalSetting()->website_btn==1): ?>
                                <li class="nav-item">
                                    <a class="primary-btn white mr-10" href="<?php echo e(url('/')); ?>/home"><?php echo app('translator')->get('common.website'); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(generalSetting()->dashboard_btn==1): ?>
                                <?php if(Auth::user()->role_id == $coltroller_role): ?>
                                    <li class="nav-item">
                                        <a class="primary-btn white mr-10"
                                           href="<?php echo e(route('admin-dashboard')); ?>"><?php echo app('translator')->get('common.dashboard'); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if( generalSetting()->report_btn==1): ?>
                                <?php if(Auth::user()->role_id == $coltroller_role): ?>
                                    <li class="nav-item">
                                        <a class="primary-btn white" href="<?php echo e(route('student_report')); ?>"><?php echo app('translator')->get('reports.reports'); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>


                        </ul>
                        
                        <ul class="nav navbar-nav mr-0 nav-setting flex-sm-row d-none d-lg-block colortheme">
                            <li class="nav-item active">
                                <input type="hidden" name="url" id="url" value="<?php echo e(url('/')); ?>">
                                <select class="niceSelect infix_session" id="infix_session">

                                    <option data-display="Academic Year" value="0"><?php echo app('translator')->get('common.academic_year'); ?> </option>
                                    <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $academic_year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$academic_year->id); ?>" <?php echo e(getAcademicId()==@$academic_year->id?'selected':''); ?>><?php echo e(@$academic_year->year); ?> [<?php echo e(@$academic_year->title); ?>]</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </li>
                        </ul>
                        


                        <?php if(@$styles && Auth::user()->role_id == 1 ): ?>
                            <?php if(generalSetting()->style_btn==1): ?>
                                <input type="hidden" name="url" id="url" value="<?php echo e(Url('/')); ?>">
                                <ul class="nav navbar-nav mr-0  nav-setting flex-sm-row d-none d-lg-block colortheme">
                                    <li class="nav-item active">
                                        <select class="niceSelect infix_theme_style" id="infix_theme_style">

                                            <option data-display="<?php echo app('translator')->get('common.select_style'); ?>" value="0"><?php echo app('translator')->get('common.select_style'); ?></option>
                                            <?php $__currentLoopData = $styles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $style): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($style->id); ?>" <?php echo e(activeStyle()->id == $style->id?'selected':''); ?>><?php echo e($style->style_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </li>
                                </ul>
                        <?php endif; ?>
                        
                    <?php endif; ?>
                    <!-- Start Right Navbar -->


                        <ul class="nav navbar-nav right-navbar">
                            <?php if(generalSetting()->lang_btn==1): ?>
                                <li class="nav-item">
                                    <select class="niceSelect languageChange" name="languageChange" id="languageChange">
                                        <option data-display="<?php echo app('translator')->get('common.select_language'); ?>" value="0"><?php echo app('translator')->get('common.select_language'); ?></option>
                                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-display="<?php echo e($lang->native); ?>" value="<?php echo e($lang->language_universal); ?>" <?php echo e($lang->language_universal == userLanguage()? 'selected':''); ?>><?php echo e($lang->native); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </li>
                            <?php endif; ?>
                            
                            
                            <li class="nav-item notification-area">
                                <a href="<?php echo e(route('chat.index')); ?>" class="chat-quick-link">
                                    <i class="fa fa-whatsapp"></i>
                                </a>
                            </li>
                            <li class="nav-item notification-area  d-none d-lg-block">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="badge"><?php echo e(count($notifications)); ?></span>
                                        <span class="flaticon-notification"></span>
                                    </button>

                                    <div class="dropdown-menu">
                                        <div class="white-box">
                                            <div class="p-h-20">
                                                <p class="notification"><?php echo app('translator')->get('common.you_have'); ?>
                                                    <span><?php echo e(count($notifications)); ?> <?php echo app('translator')->get('common.new'); ?></span>
                                                    <?php echo app('translator')->get('common.notification'); ?></p>
                                            </div>
                                            <div class="sctolled_notify">

                                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <a class="dropdown-item pos-re"
                                                       href="<?php echo e(route('notification-show',$notification->id)); ?>">

                                                        <div class="profile_single_notification d-flex justify-content-between align-items-center">
                                                            <div class="mr-30">
                                                                <p class="message s"> <span class="ti-bell"></span><?php echo e($notification->message); ?></p>
                                                            </div>
                                                            <div class="text-right bell_time">
                                                                <p class="time text-uppercase"><?php echo e(date("h.i a", strtotime($notification->created_at))); ?></p>
                                                                <p class="date">
                                                                    <?php echo e($notification->date != ""? dateConvert($notification->date):''); ?>

                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <a href="<?php echo e(route('view/all/notification',Auth()->user()->id)); ?>" class="primary-btn text-center text-uppercase mark-all-as-read">
                                                <?php echo app('translator')->get('common.mark_all_as_read'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item setting-area">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="rounded-circle" src="<?php echo e(@profile() && file_exists(@profile()) ? asset(profile()) : asset('public/uploads/staff/demo/staff.jpg')); ?>" alt="">
                                    </button>
                                    <div class="dropdown-menu profile-box">
                                        <div class="white-box">
                                            <a class="dropdown-item" href="#">
                                                <div class="">
                                                    <div class="d-flex">
                                                        <img class="client_img"
                                                             src="<?php echo e(@profile() && file_exists(@profile()) ? asset(profile()) : asset('public/uploads/staff/demo/staff.jpg')); ?> "
                                                             alt="">
                                                        <div class="d-flex ml-10">
                                                            <div class="">
                                                                <h5 class="name text-uppercase"><?php echo e(Auth::user()->full_name); ?></h5>
                                                                <p class="message mb-2"><?php echo e(Auth::user()->email); ?> </p>
                                                                <?php if(isset(Auth::user()->wallet_balance)): ?>
                                                                    <?php if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3): ?>
                                                                        <p class="message">
                                                                            <strong>
                                                                                <?php echo app('translator')->get('common.balance'); ?>:
                                                                                <?php echo e(generalSetting()->currency_symbol); ?><?php echo e((Auth::user()->wallet_balance != null) ? number_format(Auth::user()->wallet_balance, 2, '.', ''): 0.00); ?>

                                                                            </strong>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <ul class="list-unstyled">
                                                <li>

                                                    <?php if(Auth::user()->is_saas == 1): ?>
                                                        <a href="<?php echo e(route('saasStaffDashboard')); ?>">
                                                            <span class="fa fa-home"></span>
                                                            <?php echo app('translator')->get('common.saas_dashboard'); ?>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if(Auth::user()->role_id == "2" && Auth::user()->is_saas == 0): ?>
                                                        <a href="<?php echo e(route('student-profile')); ?>">
                                                            <span class="ti-user"></span>
                                                            <?php echo app('translator')->get('common.view_profile'); ?>
                                                        </a>

                                                    <?php elseif(Auth::user()->role_id != "3" && Auth::user()->is_saas == 0 && Auth::user()->staff): ?>


                                                        <a href="<?php echo e(route('viewStaff', Auth::user()->staff->id)); ?>">
                                                            <span class="ti-user"></span>
                                                            <?php echo app('translator')->get('common.view_profile'); ?>
                                                        </a>

                                                    <?php endif; ?>


                                                </li>



                                                <?php if(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator=="yes" && Auth::user()->role_id==1 && Auth::user()->is_saas ==0): ?>

                                                    <li>
                                                        <a href="<?php echo e(route('viewAsSuperadmin')); ?>">
                                                            <span class="ti-key"></span>
                                                            <?php if(Session::get('isSchoolAdmin')==TRUE): ?>
                                                                <?php echo app('translator')->get('common.view_as_saas_admin'); ?>
                                                            <?php else: ?>
                                                                <?php echo app('translator')->get('common.view_as_school_admin'); ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <li>
                                                    <a href="<?php echo e(route('updatePassowrd')); ?>">
                                                        <span class="ti-key"></span>
                                                        <?php echo app('translator')->get('common.password'); ?>
                                                    </a>
                                                </li>
                                                <li>

                                                    <a href="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>"
                                                       onclick="event.preventDefault();

                                                         document.getElementById('logout-form').submit();">
                                                        <span class="ti-unlock"></span>
                                                        <?php echo app('translator')->get('common.logout'); ?>
                                                    </a>

                                                    <form id="logout-form"
                                                          action="<?php echo e(Auth::user()->role_id == 2? route('student-logout'): route('logout')); ?>"
                                                          method="POST" style="display: none;">

                                                        <?php echo csrf_field(); ?>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <!-- End Right Navbar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>



<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/school_erp/resources/views/backEnd/partials/menu.blade.php ENDPATH**/ ?>