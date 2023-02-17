@extends('backEnd.master')
@section('title')
@lang('reports.user_log')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('reports.user_log')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('common.dashboard')</a>
                <a href="#">@lang('reports.reports')</a>
                <a href="#">@lang('reports.user_log')</a>
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
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('reports.user_log_report')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="table_id_wrapper" class="dataTables_wrapper no-footer">
                           
                            <table id="table_id" class="display data-table school-table no-footer dtr-inline dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="table_id_info" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 137px;" aria-label="User: activate to sort column descending" aria-sort="ascending">User</th>
                                        <th class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 135px;" aria-label="Role: activate to sort column ascending">Role</th>
                                        <th class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 218px;" aria-label="IP Address: activate to sort column ascending">IP Address</th>
                                        <th class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 215px;" aria-label="Login Time: activate to sort column ascending">Login Time</th>
                                        <th class="sorting_disabled" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 228px;" aria-label="User Agent">User Agent</th>
                                        <th class="sorting_disabled" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 228px;" aria-label="User Agent">View</th>
                                        <th class="sorting" tabindex="0" aria-controls="table_id" rowspan="1" colspan="1" style="width: 172px;" aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    foreach ($user_logs as $row) { ?>
                                        <tr role="row" class="odd">
                                            <td><?= $row['report']['full_name']; ?></td>
                                            <td><?= $row['report']['role']; ?></td>
                                            <td><?= $row['ip_address']; ?></td>
                                            <td><?= $row['created_at']->toDayDateTimeString(); ?></td>
                                            <td><?= $row['user_agent']; ?></td>
                                            <td>

                                                <a class="dropdown-item" data-toggle="modal" data-target="#deletebackground_settingModal{{$row->id }}" href="{{$row->id }}"> <span class="ti-eye" id=""></span></a>

                                            </td>

                                            <td><?= $row['log_type']; ?>
                                            </td>


                                            <!-- open modal -->
                                            <div class="modal fade admin-query" id="deletebackground_settingModal{{$row->id }}">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">User data</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">


                                                            <div style="display: none;">
                                                                @php

                                                                $role_id= $row['role_id'];
                                                                $user_id = $row['user_id'];


                                                                $data = [];
                                                                switch ($role_id) {
                                                                case '1':
                                                                $data['admin'] = json_decode(json_encode(DB::table('users')
                                                                ->where('users.id', '=', $user_id)
                                                                ->first()), true);

                                                                break;
                                                                case '2':
                                                                $data['student'] = json_decode(json_encode(DB::table('sm_students')->select('sm_students.*', 'sm_base_setups.base_setup_name as gender')
                                                                ->join('sm_base_setups', 'sm_base_setups.id', '=', 'sm_students.gender_id')
                                                                ->where('sm_students.user_id', '=', $user_id)
                                                                ->first()), true);
                                                                break;
                                                                case '3':
                                                                $data['parent'] = json_decode(json_encode(DB::table('sm_parents')
                                                                ->where('sm_parents.user_id', '=', $user_id)
                                                                ->first()), true);
                                                                break;
                                                                case '4':

                                                                break;
                                                                case '5':

                                                                break;
                                                                case '6':

                                                                break;
                                                                case '7':

                                                                break;
                                                                case '8':

                                                                break;
                                                                default:
                                                                # code...
                                                                break;
                                                                }

                                                                @endphp
                                                            </div>

                                                            <?php
                                                                            header('Content-Type: application/json');
                                                                            $json2 = json_encode(($data), JSON_PRETTY_PRINT);
                                                                            echo '<pre>' . $json2 . '</pre>';
                                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal -->
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
@include('backEnd.partials.server_side_datatable')

<!-- <script>
    $(document).ready(function() {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": $.fn.dataTable.pipeline({
                url: "{{url('user-log-ajax')}}",
                data: {
                    academic_year: $('#academic_id').val(),
                    class: $('#class').val(),
                    section: $('#section').val(),
                    roll_no: $('#roll').val(),
                    report: $('#report').val(),
                    name: $('#name').val()
                },
                pages: "{{generalSetting()->ss_page_load}}" // number of pages to cache

            }),
            columns: [{
                    data: 'user.full_name',
                    name: 'user.full_name'
                },
                {
                    data: 'role.name',
                    name: 'role.name'
                },
                {
                    data: 'ip_address',
                    name: 'ip_address'
                },
                {
                    data: 'login_time',
                    name: 'login_time'
                },
                {
                    data: 'user_agent',
                    name: 'user_agent',
                    orderable: false,
                    searchable: true
                },
                {
                    data: 'report',
                    name: 'report'
                },
                {
                    data: 'log_type',
                    name: 'log_type'
                },

            ],
            bLengthChange: false,
            bDestroy: true,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: window.jsLang('quick_search'),
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>",
                },
            },
            dom: "Bfrtip",
            buttons: [{
                    extend: "copyHtml5",
                    text: '<i class="fa fa-files-o"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: window.jsLang('copy_table'),
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: "excelHtml5",
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: window.jsLang('export_to_excel'),
                    title: $("#logo_title").val(),
                    margin: [10, 10, 10, 0],
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: "csvHtml5",
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: window.jsLang('export_to_csv'),
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    title: $("#logo_title").val(),
                    titleAttr: window.jsLang('export_to_pdf'),
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                    orientation: "landscape",
                    pageSize: "A4",
                    margin: [0, 0, 0, 12],
                    alignment: "center",
                    header: true,
                    customize: function(doc) {
                        doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 12],
                            alignment: "center",
                            image: "data:image/png;base64," + $("#logo_img").val(),
                        });
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: window.jsLang('print'),
                    title: $("#logo_title").val(),
                    exportOptions: {
                        columns: ':visible:not(.not-export-col)'
                    },
                },
                {
                    extend: "colvis",
                    text: '<i class="fa fa-columns"></i>',
                    postfixButtons: ["colvisRestore"],
                },
            ],
            columnDefs: [{
                visible: false,
            }, ],
            responsive: true,
        });
    });
</script> -->



@endsection