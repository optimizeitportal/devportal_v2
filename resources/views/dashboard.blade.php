@extends('layouts.master')

@section('title') Data Extraction @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

@endsection
@section('content')

{{-- @component('components.breadcrumb')
@slot('li_1') D-Board @endslot
@slot('title') D-Board @endslot
@endcomponent --}}

<div class="row">

    <div class="col-xl-12">
        <div class="metrics2_result">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Doc Count</p>
                                    <h4 class="mb-0">{{ $doc_metrics['doc_count'] }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Processed</p>
                                    <h4 class="mb-0">{{ $doc_metrics['processed'] }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-cog font-size-24"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Extracted</p>
                                    <h4 class="mb-0">{{ $doc_metrics['extracted'] }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="card">
            <div class="card-body">
                <div class="file_upload1 p-0">
                    <label class="opt-p mb-2" for="file"
                        style="font-size: 14px;position: relative;"> <b>Upload Your Own Document</b>
                        {{-- <span class="help_info" data-tooltip-text="test">
                            <i class="fa fa-info"></i>
                            <span class="tool-text">
                                <ul>
                                    <li>Upload any document (please follow restrictions for the trial)
                                        and extract data
                                        in less than 60 seconds.</li>
                                    <li>If you upload documents which are already in our library, they
                                        will be
                                        automatically identified, and key insights will be generated.
                                    </li>
                                    <li>Extracted information are available under Raw-Text, Forms,
                                        Tables sections on
                                        the right-hand side.</li>
                                    <li>If the document is not in our library, you will get as-is data
                                        extraction and
                                        key-insights are not available</li>
                                    <li>With click of a button, you can ask our team to on-board your
                                        document.</li>
                                </ul>
                            </span>
                        </span> --}}
                    </label>
                    <input type="file" name="file" id="file">
                    <div class="dz-message needsclick text-center upload-area" id="uploadfile">

                        <p class="opt-p"> Drag Files here or <i class="fa fa-upload"></i> Click to
                            Upload</p>
                    </div>
                    <p class="note needsclick text-center mt-1 mb-0 opt-p" style="line-height:1.3;">
                        Upload upto 10 pages within 2 MB of types: .pdf, .png, .jpeg, .tiff
                    </p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body list_result">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documents</th>
                            <th scope="col">Uploaded On</th>
                            <th scope="col">Status</th>
                            <th scope="col" data-orderable="false">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($uploaded_list))
                            @foreach ($uploaded_list as $k => $list_val)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $list_val['file_name'] }}
                                    </td>
                                    <td data-sort="{{ strtotime($list_val['updated_on']) }}">
                                        {{ $list_val['updated_on'] }}</td>
                                    <td>{{ $list_val['status']  == "UPLOADED" ? "PROCESSING" : $list_val['status'] }}</td>
                                    <td>
                                        <a
                                            href="{{ $list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('doc_verify?file=' . $list_val['files']) }}&action=view">
                                            <button class="btn action_btn view"
                                                data-toggle="tooltip" data-placement="top"
                                                @if( $list_val['status'] == 'UPLOADED')
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='{{asset('images/spinner.gif')}}'> <p>Please wait till the file is processed<p>"
                                                @else
                                                title="view"
                                                @endif
                                                > <i class="fa fa-eye"></i></button>
                                        </a>
                                        <a
                                            href="{{$list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('doc_verify?file=' . $list_val['files']) }}&action=edit">
                                            <button class="btn action_btn edit"
                                                data-toggle="tooltip" data-placement="top"
                                                @if( $list_val['status'] == 'UPLOADED')
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='{{asset('images/spinner.gif')}}'> <p>Please wait till the file is processed<p>"
                                                @else
                                                title="Edit"
                                                @endif
                                                    >


                                                <i class="fa fa-edit"></i></button>
                                        </a>
                                        <a
                                            href="{{ $list_val['status'] == 'UPLOADED' ? "javascript:void(0)" : url('download_document?file_name=' . session('account_id') . '/' . current(explode('.', $list_val['files'])) . '_Key_Value_Result.json') }}">
                                            <button class="btn action_btn download"
                                                data-toggle="tooltip" data-placement="top"
                                                @if( $list_val['status'] == 'UPLOADED')
                                                data-bs-html="true"
                                                title="<img width='17px' height='17px' src='{{asset('images/spinner.gif')}}'> <p>Please wait till the file is processed<p>"
                                                @else
                                                title="Download"
                                                @endif

                                                > <i
                                                    class="fa fa-download"></i></button>
                                        </a>
                                        {{-- <a href="javascript:viod(0)">
                                        <button class="btn action_btn delete"> <i class="fa fa-trash"></i></button>
                                     </a>  --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="5">
                                    No Data available!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- Transaction Modal -->
<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="{{ asset('build/images/product/img-7.png') }}" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                    </div>
                                </td>
                                <td>$ 255</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div>
                                        <img src="{{ asset('build/images/product/img-4.png') }}" alt="" class="avatar-sm">
                                    </div>
                                </th>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                        <p class="text-muted mb-0">$ 145 x 1</p>
                                    </div>
                                </td>
                                <td>$ 145</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Shipping:</h6>
                                </td>
                                <td>
                                    Free
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    $ 400
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- subscribeModal -->
{{-- <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="avatar-md mx-auto mb-4">
                        <div class="avatar-title bg-light rounded-circle text-primary h1">
                            <i class="mdi mdi-email-open"></i>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <h4 class="text-primary">Subscribe !</h4>
                            <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay
                                update.</p>

                            <div class="input-group bg-light rounded">
                                <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">

                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    <i class="bx bxs-paper-plane"></i>
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- end modal -->

@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ asset('build/js/pages/dashboard.init.js') }}"></script>
  <!-- Required datatable js -->
  <script src="{{ asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('build/libs/jszip/jszip.min.js') }}"></script>
  {{-- <script src="{{ asset('build/libs/pdfmakebuild/pdfmake.min.js') }}"></script> --}}
  <script src="{{ asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- Responsive examples -->
  <script src="{{ asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
  <!-- Datatable init js -->
  <script src="{{ asset('build/js/pages/datatables.init.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dropzone.js?ver=36') }}"></script>
    <script>
        var uploadDoc = form_click = table_click = report_click = form_submit = table_submit = true;
        var upload_fileName;
        var download_file_name;
        var timer;
        var counter = 0;
        var intervalMsec = 500
        var timerClear = true;
        var loader_text_sec;

        var autoReload = false;
        // insert the seconds in preloader 
        function timerfun() {
            var s = "";
            counter += intervalMsec / 1000;
            s = Math.round(counter);
            $("#preloader .timer").text(s);
        }
        // status text
        var status_text = [
            'You document has been submitted for processing, please wait',
            'When the job is finished, you can see the results under Raw_Text, Forms (Key-Value pairs), Table (tabular data, if any)',
            'Usually, our servers will complete the extraction within 30 to 40 seconds…depending on the traffic/load, it may differ a bit, please wait',
            'We should be able to see the results in a few more seconds, please wait'
        ]

        // Calling api for document status check
        function check_document_status(myfile_name = null) {
            let token = '{{ csrf_token() }}';
            let data = {
                '_token': token,
                'file_name': myfile_name
            };
            $.post("{{ url('/check_document_status') }}", data, function(data, status) {
                if (data == "force_redirect") {
                    location.reload()
                }
                if (data.message == 'The incoming token has expired') {
                    location.reload()
                }
                let obj = JSON.parse(data);
                @if (env('APP_DEBUG') == true)
                    console.log(obj);
                @endif
                if (obj.upload_file_name != "") {
                    console.log(obj)
                    // obj.Item.file_status.S == 'uploaded'
                    if (obj.Item && obj.Item.file_status == "") {
                        //show preloader
                        setTimeout(function() {
                            $('#preloader').show();
                            $('#loader_text').show();
                        }, 1);

                        // check Document status
                        setTimeout(function() {
                            check_document_status();
                        }, {{ env('FILE_STATUS_CHECK_INTERVAL') }});

                    } else {
                        $('#loader_text').hide();
                        $('.download_doc').show();
                        status_key = 0;
                        upload_fileName = obj.upload_file_name;
                        let total_page = obj.Item.doc_total_pages.N;
                        window.location.href = "{{ url('doc_verify?file=') }}" + obj.Item.file_name.S;

                    }
                }
            });
        }
        // functions
        var status_key = 0;
        // Sending AJAX request and upload file
        function uploadData(formdata) {

            uploadDoc = form_click = table_click = report_click = form_submit = table_submit = true;
            upload_fileName = "";
            $('#raw_textTab').trigger('click');
            $('.doc_files_tab li a').attr('data-click', 1);
            $('.doc_info_cont .on-board').remove();
            $('.uploaded_list li').removeClass('active');
            formdata.append('_token', '{{ csrf_token() }}');
            // $('#docTypes_select option:first').attr('selected', true);
            $("#docTypes_select option:selected").prop("selected", false);
            $('select[name="pageno"] option:first').attr('selected', true);
            $('.doc_name').text("");
            // $('.note').html('<div align=\"center\"><img src=\"{{ asset('images/spinner.gif') }}\"></div>');
            $('.note').html('<div class="spinner-border text-center text-primary m-1" role="status"><span class="sr-only">Loading...</span></div>');
            $('#loader_text').show();
            $('#loader_text h6').text(status_text[0]);
            // status_key++;
            timerClear = false;
            clearInterval(timer);
            counter = 0;
            timer = setInterval(timerfun, intervalMsec);

            clearInterval(loader_text_sec);
            status_key = 0;
            // For changing text every 10 seconds in pre-loader
            loader_text_sec = setInterval(function() {
                status_text.length <= status_key ? status_key = 3 : status_key++;
                $('#loader_text h6').text(status_text[status_key]);
            }, 10000);
            $.ajax({
                url: '{{ url('upload_document') }}',
                type: 'post',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data == "force_redirect") {
                        location.reload()
                    }
                    $('.note').html(data);
                    // location.reload();
                    setTimeout(function(){
                        get_uploaded_fileList()
                    },2000)
                    loader_text_sec = setInterval(function() {
                        get_uploaded_fileList()
                    }, 5000);
                }
            });
        }

        function ShowNoDataText() {
            $('.doc_image').show().html('<div class="not_found" style="padding: 20px;">No Data available!</div>');
            $('.bound_box').hide();
            $('.rawText').html('<div class="not_found">No Data available!</div>');
        }
        // Get Uploaded List For Auto Reload Content in Any Changes
        function get_uploaded_fileList() {
            autoReload = true
            let token = '{{ csrf_token() }}';
            $.post({
                    url: "{{ url('/get_uploaded_fileList') }}",
                    global: false
                }, {
                    '_token': token
                },
                function(data, status) {
                    if (data !== "noData") {
                        $('.metrics_result').html($(data).find('#metrics_list')[0])
                        $('.list_result').html($(data).find('#ListTable')[0])
                        $('.metrics2_result').html($(data).find('#metrics2')[0])
                        $('.dataTable').DataTable();
                        $('#ListTable_filter label').append('<i class="fa fa-search"></i>');

                        $('.fa-trash-alt').addClass('fa-trash').removeClass('fa-trash-alt')
                        $('[data-toggle="tooltip"]').tooltip()

                    }
                    autoReload = false;

                })
        }

        $(function() {
            // $('[data-bs-target="#selectPage" ]').trigger('click')
            $('.dataTable').DataTable();
            // insert Search icon for DataTable Search field
            $('#ListTable_filter label').append('<i class="fa fa-search"></i>');

            // for Select Sample Document redirect to doc-verify Page 
            $('#docTypes_select').change(function() {
                window.location.href = "{{ url('doc_verify?sample_file=') }}" + $(this).find(':selected')
                    .val();
            })

            //For Every 5 sec call the get_uploaded_fileList Function.
            loader_text_sec = setInterval(function() {
                get_uploaded_fileList()
            }, 5000);

            // preloade hide and show for ajax start and stop
            $(document).ajaxStart(function(e, s) {

                $('#preloader').show()
                if (timerClear == true) {
                    counter = 0;
                    timer = setInterval(timerfun, intervalMsec);
                }
            });
            $(document).ajaxStop(function() {
                $('#preloader').hide()
                if (timerClear == true) {
                    clearInterval(timer);
                    counter = 0;
                }

            });
            // auth expire time check
            $('body').click(() => {
                let time;
                let login_time = {{ session('login_time') }};
                let exp_time = {{ session('ExpiresIn') }};
                time = Math.floor(new Date().getTime() / 1000);
                if ((time - login_time) > exp_time) {
                    location.reload();
                }
            })


        })
    </script>
@endsection
