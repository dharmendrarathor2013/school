@extends('backEnd.master')
@section('title')
    @lang('hr.staff_import')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backEnd/') }}/css/croppie.css">
@endsection
@section('mainContent')
    <style type="text/css">
        .form-control:disabled {
            background-color: #FFFFFF;
        }
    </style>


@section('mainContent')
    <section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('hr.staff_import')</h1>
                <div class="bc-pages">
                    <a href="{{ route('dashboard') }}">@lang('common.dashboard')</a>
                    <a href="#">@lang('hr.add_staff')</a>
                    <a href="#">@lang('hr.staff_import')</a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-2">
                    <div class="main-title">
                       <h3>Select Criteria</h3> 
                    </div>
                </div>
				
				   <div class="offset-lg-2 col-lg-2 text-right mb-20">
                    <a href="{{ url('staff-directory') }}">
                        <button class="primary-btn tr-bg text-uppercase bord-rad">
                           Staff List
                        </button>
                    </a>
                </div>  
				
                <div class="offset-lg-3 col-lg-3 text-right mb-20">
                    <a href="{{ url('/public/backEnd/bulksample/staffs.xlsx') }}">
                        <button class="primary-btn tr-bg text-uppercase bord-rad">
                            @lang('hr.download_sample_file')
                            <span class="pl ti-download"></span>
                        </button>
                    </a>
                </div>   
            </div>

            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staff_bulk_store',
            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'staff_form']) }}
                <div class="row">
                    <div class="col-lg-12">


                        <div class="white-box">
                            <div class="">
                                                            <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title">
                                            <div class="box-body">
                                                <br>
                                                1. Your CSV data should be in the format download file. The first line of
                                                your CSV file should be the column headers as in the table example. Also
                                                make sure that your file is UTF-8 to avoid unnecessary encoding
                                                problems.<br>
                                                2. If the column you are trying to import is date make sure that is
                                                formatted in format Y-m-d (2018-06-06).<br>
                                               
                                                

                                                {{-- 4. For Staff "Gender" use ID(
                                                1=Male,

                                                2=Female,

                                                3=Others,



                                                ).<br> --}}
                                               
                                                {{-- 5. For staff "Religion" use ID(
                                                4=Islam,

                                                5=Hinduism,

                                                6=Sikhism,

                                                7=Buddhism,

                                                8=Protestantism,

                                                ).<br>
                                                8. For relation with guardian (F=Father, M=Mother, O=Other)<br> --}}
                                                3. Please follow this date format(2020-06-15) for Date of birth & Date of joining <br>
                                                
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div> 


                                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                                @if( moduleStatusCheck('MultiBranch') && isset($branches ))
                                <div class="row mb-30">
                                       <div class="col-lg-3">
                                           <div class="input-effect">
                                               <select class="niceSelect w-100 bb form-control{{ $errors->has('branch_id') ? ' is-invalid' : '' }}" name="branch_id" id="branch_id">
                                                    <option data-display="@lang('hr.branch') *" value="">@lang('hr.branch') *</option>
                                                       @foreach($branches as $branch)
                                                       <option value="{{$branch->id}}" {{isset($branch_id)? ($branch->id == $branch_id? 'selected':''): ''}}>{{$branch->branch_name}}</option>
                                                       @endforeach
                                               </select>
                                                <span class="focus-border"></span>
                                                   @if ($errors->has('branch_id'))
                                                   <span class="invalid-feedback invalid-select" role="alert">
                                                       <strong>{{ $errors->first('branch_id') }}</strong>
                                                   </span>
                                               @endif
                                           </div>
                                       </div>
                                </div> 
                                   @endif
                                <div class="row mb-40 mt-30">

                                    {{-- <div class="col-lg-3">
                                        <div class="input-effect sm2_mb_20 md_mb_20">
                                            <select class="niceSelect w-100 bb form-control" name="session"
                                                id="academic_year" style="display: none;">
                                                <option data-display="Academic Year *" value="">Academic Year *
                                                </option>
                                                <option value="1">2022[Jan-Dec]</option>
                                            </select>
                                            <div class="nice-select niceSelect w-100 bb form-control" tabindex="0"><span
                                                    class="current">Academic Year *</span>
                                                <div class="nice-select-search-box"><input type="text"
                                                        class="nice-select-search" placeholder="Search..."></div>
                                                <ul class="list">
                                                    <li data-value="" data-display="Academic Year *"
                                                        class="option selected">Academic Year *</li>
                                                    <li data-value="1" class="option">2022[Jan-Dec]</li>
                                                </ul>
                                            </div>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div> --}}


                                    <div class="col-lg-3" style="display: none;">
                                        <div class="input-effect">
                                            <input class="primary-input form-control{{ $errors->has('staff_no') ? ' is-invalid' : '' }}" type="text"  name="staff_no" value="{{$max_staff_no != ''? $max_staff_no + 1 : 1}}" readonly>
                                            <span class="focus-border"></span>
                                            <label>@lang('hr.staff_no') {{in_array('staff_no', $is_required) ? '*' : ''}} </label>
                                            @if ($errors->has('staff_no'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('staff_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>



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
                                            @lang('hr.save_bulk_staff')
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
        </div>
    </section>
@endsection
