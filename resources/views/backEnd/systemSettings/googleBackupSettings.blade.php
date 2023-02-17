@extends('backEnd.master')
@section('title')
@lang('system_settings.backup_settings')
@endsection
@section('mainContent')
<style>
    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
    </style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Google Backup</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('system_settings.system_settings')</a>
                <a href="{{url('google-backup')}}">Google Backup</a>
            </div>
        </div>
    </div>
</section>



<section class="admin-visitor-area">
	<?php 
		if($message ==""){ ?>
	 <div class="alert alert-success">
         <?php echo "You are already Authenticated";?>
     </div>
	<?php }else{ ?>
	
	<div class="alert alert-danger">
         <?php echo "You are not Authenticated";?>
     </div>
	<a class="button" href="{{ url('google-backup-auth') }}">Authenticate Drive</a>
	<?php }	?>
		
 </section>

@endsection
