@extends('backEnd.master')
@section('title')
@lang('style.color_style')
@endsection
@section('mainContent')
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
                <h1>@lang('style.color_style')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                    <a href="#">@lang('style.style')</a>
                    <a href="#">@lang('style.color_style')</a>
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
                                <h3 class="mb-0">@lang('style.color_style_list')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>@lang('common.sl')</th>
                                        <th>@lang('common.title')</th>
                                        <th>Search Box Color</th>
                                        <th>Pagination Color</th>
                                        <th>Button Color</th>
                                        <th>@lang('style.title_color')</th>
                                        <th>@lang('style.text_color')</th>
                                        <th>Sidebar Submenu</th>
										<th>@lang('style.sidebar_bg')</th>
										
                                        <th>@lang('common.status')</th>
										 <th>@lang('common.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php @$count=1; @endphp
                                @foreach($color_styles as $background_setting)
                                    <tr>
                                        <td>{{@$count++}}</td>
                                        <td>{{@$background_setting->style_name}}</td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->primary_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->primary_color}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->primary_color2}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->primary_color2}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->primary_color3}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->primary_color3}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->title_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->title_color}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->text_color}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->text_color}}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->sidebar_bg}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->sidebar_bg}}</div>
                                            </div>
                                        </td>
										
										
										
										
										
										  <td>
                                            <div class="row">
                                                <div class=" col-lg-2">
                                                    <div class="bg-color"  style="background: {{@$background_setting->sidebar_bg2}}"></div>
                                                </div>
                                                <div class="col-lg-9">{{@$background_setting->sidebar_bg2}}</div>
                                            </div>
                                        </td>
										
										
										
										
										
                                        <td>

                                            @if($background_setting->is_active==1)
                                                <label class="primary-btn small fix-gr-bg ">@lang('style.activated')</label>
                                            @else
                                                @if(userPermission(491))
                                                    <a class="primary-btn small tr-bg"
                                                    href="{{route('make-default-theme',@$background_setting->id)}}">
                                                        @lang('style.make_default')</a>
                                                @endif
                                            @endif
                                        </td>
										<td>
										  
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        @lang('common.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#deletebackground_settingModal{{ @$background_setting->id }}"
                                                            href="{{ @$background_setting->id }}">@lang('common.edit')</a>

                                                    </div>
                                                </div>
										</td>
										
										
										
										
										<div class="modal fade admin-query"
                                                    id="deletebackground_settingModal{{ @$background_setting->id }}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">@lang('common.edit')</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">

                                                                {{ Form::open([
                                                                    'class' => 'form-horizontal',
                                                                    'files' => true,
                                                                    'url' => 'color-style-list-update',
                                                                    'method' => 'POST',
                                                                    'enctype' => 'multipart/form-data',
                                                                ]) }}
                                                                <input type="hidden" id="id" name="id"
                                                                    value="{{ @$background_setting->id }}">



                                                                <div class="">
                                                                    <label for="onecolor">Search Box Color:</label>
                                                                    <input type="color" id="primary_color"
                                                                        name="primary_color"
                                                                        value="{{ @$background_setting->primary_color }}" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Pagination Color:</label>
                                                                    <input type="color" id="primary_color2"
                                                                        name="primary_color2"
                                                                        value="{{ @$background_setting->primary_color2 }}" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																   <div class="">
                                                                    <label for="onecolor">Button Color: &nbsp; &nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="primary_color3"
                                                                        name="primary_color3"
                                                                        value="{{ @$background_setting->primary_color3 }}" style="width: 70%;"><br>
                                                                </div>
																
																
																
																

                                                                <div class="">
                                                                    <label for="onecolor">Title Color:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="title_color"
                                                                        name="title_color"
                                                                        value="{{ @$background_setting->title_color }}" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Text Color:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                                                                    <input type="color" id="text_color" name="text_color"
                                                                        value="{{ @$background_setting->text_color }}" style="width: 70%;"><br>
                                                                </div>

                                                                <div class="">
                                                                    <label for="onecolor">Sidebar<br> Submenu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="color" id="sidebar_bg"
                                                                        name="sidebar_bg"
                                                                        value="{{ @$background_setting->sidebar_bg }}" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																    <div class="">
                                                                    <label for="onecolor">Sidebar<br> Background:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="color" id="sidebar_bg2"
                                                                        name="sidebar_bg2"
                                                                        value="{{ @$background_setting->sidebar_bg2 }}" style="width: 70%;"><br>
                                                                </div>
																
																
																
																
																
																
																
																
																

                                                                <div class="mt-40 d-flex justify-content-between">
                                                                    {{-- <button type="button" class="primary-btn tr-bg"
                                                                                        data-dismiss="modal">@lang('common.cancel')
                                                                                    </button> --}}

                                                                    <button type="submit"
                                                                        class="primary-btn fix-gr-bg">@lang('common.update')
                                                                    </button>

                                                                    {{-- <a href=""
                                                                                        class="primary-btn fix-gr-bg">@lang('common.update')</a> --}}

                                                                </div>

                                                                {{ Form::close() }}

                                                            </div>


                                                        </div>


                                                    </div>


                                                </div>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
