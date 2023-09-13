@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <!-- Responsive datatable examples -->
    <link href="{{ asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <style>
        select.form-control{
            appearance: auto;
        }
        .form-check.pa-r{
            position: absolute;
            right: -1px;
            top: 0px;
            margin: 0;
        }
        .token-sale-box {
            position: relative;
        }
        span.token-sale-title {
            width: 85%;
            padding: 2px 4px;
        }
        [contenteditable]:focus-visible {
            color: #fff;
        }
    </style>
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Dashboard @endslot
@endcomponent

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 bt-r" style="display: none">
                        <div class="">
                            <label for="" class="opt-p mb-2">
                                <b>Sample Document</b>
                                {{-- <span class="help_info" data-tooltip-text="test">
                                    <i class="fa fa-info"></i>
                                    <span class="tool-text">
                                        <ul>
                                            <li>These are the documents already trained and have full array of
                                                functions including key insights.</li>
                                            <li>When you select any of them, you can see the extracted sample
                                                data.</li>
                                            <li>When you upload your own documents of the same kind, you will
                                                get the same kind of outputs in less than 60 seconds.</li>
                                            <li>Documents that not in our library already, will be classified as
                                                ‘Other’.</li>
                                            <li>Our team continuously updates the document list, please send us
                                                your requests to add any new document.</li>
                                        </ul>
                                    </span>
                                </span> --}}
                            </label>
                            <select id="docTypes_select" class="form-control opt-p" name=""
                                style="padding: 10px;">
                                <option value="">Select a Sample Document</option>
                                @foreach ($documents as $document)
                                    <option data-total-page="{{ $document['no-of-pages'] }}"
                                        value='{{ $document['DocName'] }}'>{{ $document['DocName'] }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="uploaded_list_cont">
                        <span class="doc_prev"><i class="fa fa-angle-left"></i></span>
                        <div class="uploaded_select_box">
                            <label for="uploaded_list_select" class="opt-p mb-2"><b>Processed
                                    Documents</b></label>
                            <select id="uploaded_list_select" class="form-control opt-p" name=""
                                style="padding: 10px;">
                                <option value="">Select Document</option>
                                @foreach ($uploaded_lists as $doc_files)
                                    <option value='{{ $doc_files['files'] }}'>{{ $doc_files['file_name'] }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <span class="doc_next"><i class="fa fa-angle-right"></i></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="card" style="min-height: 65vh;">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center doc_info__details" style="">

                    <div class=" m-0 doc_info_cont" style="position: relative;">
                        <strong style="font-size: 14px;">Document Name
                            {{-- <span class="help_info" data-tooltip-text="test" style="vertical-align: middle;">
                                <i class="fa fa-info"></i>
                                <span class="tool-text">
                                    <ul>
                                        <li>This is the document classification(id)</li>
                                        <li>If the value is ‘Other’, it means this document is not in our
                                            library.</li>
                                        <li>You can tell our team to on-board the document by clicking
                                            “On-Board” button next to the classification.</li>
                                    </ul>
                                </span>
                            </span> :  --}}
                        </strong>
                        <span class="doc_name" style="font-size: 14px"></span>
                        <div class="doc_details" style="display: none;">
                            <strong style="font-size: 14px;">Domain :</strong>
                            <span class="doc_domain" style="font-size: 14px"></span>

                            <strong style="font-size: 14px; margin-left:5px;">State :</strong>
                            <span class="doc_state" style="font-size: 14px"></span>

                        </div>
                    </div>
                    <div class="doc_page__select" style="font-size:13px; font-weight:600; padding-right:10px;">
                        Page:
                        <select class="" name="pageno">
                            <option value="1">1</option>
                        </select>
                        <input type="hidden" id="total_page" value="1">
                        <div id="buttonWrapper">
                            <button type="button" class="scale" data-scale="up"><i
                                    class="fa fa-search-plus"></i></button>
                            <button type="button" class="scale" data-scale="down" disabled="disabled"><i
                                    class="fa fa-search-minus"></i></button>
                               <!-- Button trigger modal -->
                            {{-- <button type="button" style="float: right; padding: 2px 12px;  margin-left: 6px;font-size: 0.9rem;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Form
                            </button> --}}
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="img-cont">
                    <div class="doc_image text-center">
                        <div class="not_found" style="padding: 20px;">No Data available!</div>
                    </div>
                    <div class="bound_box text-center" style="display: none;">

                        <img usemap="#mark" id="mainimg" src="" width="100%" style="display:none;">
                        <canvas id="BoundingBoxCanvas" width="100%"
                            style="display: none;max-width: 100%;"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-tabs doc_files_tab" id="myTab" role="tablist"
            style="z-index: 1;position: relative;">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="raw_textTab" data-bs-toggle="tab"
                    data-bs-target="#tab-4-1" type="button" role="tab" aria-controls="tab-4-1"
                    data-result-id=".rawText" data-url="get_rawtext" aria-selected="true">Raw Text
                    {{-- <span class="help_info" data-tooltip-text="test">
                        <i class="fa fa-info"></i>
                        <span class="tool-text">
                            <ul>
                                <li>Every text in your documents are extracted and shown here</li>
                                <li>The data is segregated by page</li>
                            </ul>
                        </span>
                    </span> --}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="formTab" data-bs-toggle="tab" data-bs-target="#tab-4-2"
                    type="button" role="tab" aria-controls="tab-4-2" data-result-id=".formData"
                    data-url="get_formdata" data-form-id="#formsData" aria-selected="false"
                    data-form-submit="1">Forms
                    {{-- <span class="help_info" data-tooltip-text="test">
                        <i class="fa fa-info"></i>
                        <span class="tool-text">
                            <ul>
                                <li>The key and value pairs from the documents are displayed here.</li>
                                <li>The data is sequenced as they appear on the document.</li>
                                <li>For the documents from our library – label transformation is built in to
                                    provide specific information.</li>
                                <li>Selecting any element will highlight the corresponding data on the form
                                    image on the left side.</li>
                            </ul>
                        </span>
                    </span> --}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tableTab" data-bs-toggle="tab" data-bs-target="#tab-4-3"
                    type="button" role="tab" aria-controls="tab-4-3" data-result-id=".tableData"
                    data-url="get_tabledata" data-form-id="#tableData" aria-selected="false">Tables
                    {{-- <span class="help_info" data-tooltip-text="test">
                        <i class="fa fa-info"></i>
                        <span class="tool-text right">
                            <ul>
                                <li>The data in table formats within the documents are displayed here.</li>
                                <li>Selecting any element will highlight the corresponding data on the form
                                    image on the left side.</li>
                            </ul>
                        </span>
                    </span> --}}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reportTab" data-bs-toggle="tab" data-bs-target="#tab-4-4"
                    type="button" role="tab" aria-controls="tab-4-4" data-result-id=".reportData"
                    data-url="get_reports" aria-selected="false">Key Insights
                    {{-- <span class="help_info" data-tooltip-text="test">
                        <i class="fa fa-info"></i>
                        <span class="tool-text right">
                            <ul>
                                <li>This is applicable to the documents available in our library.</li>
                                <li>Personalized insights will be provided as per customer requirements</li>
                            </ul>
                        </span>
                    </span> --}}
                </button>
            </li>
        </ul>

        <div class="card" style="min-height: 75vh;">
            <div class="card-header text-start">
                <strong style="font-size: 14px;">Results </strong>
                <button class="btn btn-primary doc_submit" data-submit-id="#formsData"
                    style="display: none;">confirm</button>
                <div
                    style="font-size:13px; font-weight:600; padding-right:10px; display:inline-block; float: right;">
                    {{-- <a target="_blank" class="download_doc" data-href="{{ url('download_document') }}"
                        href="{{ url('download_document') }}" style=" display:none; ">
                        <i class="fa fa-download"></i> Download</a> --}}
                        <button type="button" style="float: right; padding: 2px 12px;  margin-left: 6px;font-size: 0.9rem;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Chat
                            </button>
                        <button type="button" style="float: right; padding: 2px 12px;  margin-left: 6px;font-size: 0.9rem; display:none;" class="btn btn-primary download_doc" data-bs-toggle="modal" data-bs-target="#download_model">
                            <i class="fa fa-download"></i> Download
                        </button>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content docuTab-cont">
                    <div class="tab-pane active rawText" id="tab-4-1" role="tabpanel"
                        aria-labelledby="raw_textTab">
                        No Data available!
                    </div>
                    <div class="tab-pane formData" id="tab-4-2" role="tabpanel" aria-labelledby="formTab">
                        No Data available! </div>
                    <div class="tab-pane tableData" id="tab-4-3" role="tabpanel"
                        aria-labelledby="tableTab">No Data available! </div>
                    <div class="tab-pane reportData" id="tab-4-4" role="tabpanel"
                        aria-labelledby="reportTab">No Data available! </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            {{-- <h5 class="modal-title" id="staticBackdropLabel"></h5> --}}
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="chat-bot-container">
                    <div class="chunkos-chat">
                        <header>
                          <div class="flex-wrapper">
                            Chatbot
                          </div>
                        </header>
                        <div class="chat-app" id="chat-app">
                      
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="download_model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="download_modelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="download_modelLabel">Download</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <a target="_blank" class="download_doc_json" data-href="{{ url('download_document') }}"
                                href="{{ url('download_document') }}">
                                <i class="fa fa-download"></i> JSON Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <a target="_blank" class="download_doc_edi" data-href="#"
                                href="#">
                                <i class="fa fa-download"></i> EDI Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/dropzone.js?ver=36') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/tiff_image-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/canvas-zoom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/simplePagination.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/chatbot.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var uploadDoc = form_click = table_click = report_click = form_submit = table_submit = true;
    var upload_fileName;
    var download_file_name;
    var timer;
    var counter = 0;
    var intervalMsec = 500
    var timerClear = true;
    var loader_text_sec;

    // Timer function
    function timerfun() {
        var s = "";
        counter += intervalMsec / 1000;
        // s = Math.round(counter) + " sec";
        s = Math.round(counter);
        $("#preloader .timer").text(s);
    }

    // Array of status texts
    var status_text = [
        'You document has been submitted for processing, please wait',
        'When the job is finished, you can see the results under Raw_Text, Forms (Key-Value pairs), Table (tabular data, if any)',
        'Usually, our servers will complete the extraction within 30 to 40 seconds…depending on the traffic/load, it may differ a bit, please wait',
        'We should be able to see the results in a few more seconds, please wait'
    ]
    var status_key = 0;

    // Function to set the file name and page number for document download link
    function set_download_link(file_name, page_no) {
        file_name = download_file_name;
        let link = $('.download_doc_json').attr('data-href');
        let total_page = $('select[name="pageno"] option').length;
        link = link + '?file_name=' + file_name + "&page_no=" + page_no + "&total_page=" + total_page;
        $('.download_doc_json').attr('href', link);
    }

    // Function to convert data URL to File object
    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[arr.length - 1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, {
            type: mime
        });
    }

    // Function to check the document status using an API
    function check_document_status(myfile_name = null) {
        // CSRF token
        let token = '{{ csrf_token() }}';
        let data = {
            '_token': token,
            'file_name': myfile_name
        };

        // Send data to Controller using POST request
        $.post("{{ url('/check_document_status') }}", data, function(data, status) {
            // Check Login
            if (data == "force_redirect") {
                location.reload()
            }
            // For Token Expired
            if (data.message == 'The incoming token has expired') {
                location.reload()
            }

            // Parse response data
            let obj = JSON.parse(data);

            // Prevent the Console log in production
            @if (env('APP_DEBUG') == true)
                console.log(obj);
            @endif

            // Check if the document is uploaded
            if (obj.upload_file_name != "") {
                if (obj.Item.file_status.S == "UPLOADED") {
                    // Show preloader
                    setTimeout(function() {
                        $('#preloader').show();
                        $('#loader_text').show();
                    }, 1);

                    // Check document status recursively
                    setTimeout(function() {
                        check_document_status();
                    }, {{ env('FILE_STATUS_CHECK_INTERVAL') }});

                } else {
                    $('#loader_text').hide();
                    $('.download_doc').show();

                    status_key = 0;
                    upload_fileName = obj.upload_file_name;
                    let total_page = obj.Item.doc_total_pages.N;
                    let option = "";
                    $('#Uploaded__fileName').val(obj.Item.file_name.S)

                    // For Document Pages
                    for (let i = 1; i <= total_page; i++) {
                        option = option + "<option value='" + i + "'>" + i + "</option>";
                    }
                    $('select[name="pageno"]').html(option);
                    $('.doc_name').html(obj.Item.doc_name.S);
                    if (obj.Item.doc_name.S !== "OTHER") {
                        $('.doc_details').show();
                        $('.doc_domain').text(obj.Item.doc_domain.S)
                        $('.doc_state').text(obj.Item.doc_state.S)
                        $('.on-board').remove();
                    } else {
                        $('.on-board').remove();
                        $('.doc_info_cont').append('<button class="btn on-board"> On-Board </button>');
                        $('.doc_details').hide();
                        $('.on-board').click(function() {
                            Swal.fire(
                                '',
                                'The team has been notified to on-board this document, we will get back to you as soon as the on-boarding is done',
                                'success'
                            )
                        })
                    }
                    // get_rawText(obj.upload_file_name, 1, "upload")

                    // For Ajax run
                    $('#raw_textTab').attr('data-click', '1');

                    // get Raw Text
                    get_documents($('#raw_textTab'), ' "upload"')
                    // let files = $('#file')[0].files[0];
                    let files = obj.Item.file_name.S;
                    let extension = files.split('.').pop().toLowerCase();
                    if (myfile_name == null) {
                        var ajax_call = extension !== "pdf" ? false : true;
                        // get Image
                        get_image(obj.upload_file_name, 1, "upload", ajax_call)
                    } else {
                        var ajax_call = true;
                        let fileName = extension !== "pdf" ? obj.Item.file_name.S : obj.upload_file_name;
                        let build_file_name = extension !== "pdf" ? false : true;
                        // get Image
                        get_image(fileName, 1, "upload", ajax_call, build_file_name)
                    }
                    if (myfile_name == null) {
                        $('#file').val("");
                        $('.note').html(
                            " Upload upto 10 pages within 2 MB of types: .pdf, .png, .jpeg, .tiff"
                        )
                        $('.note').css("color", "#454545");
                        timerClear = true;
                        clearInterval(timer);
                        counter = 0;
                    }
                    if (obj.Item.doc_result_filename != undefined) {
                        download_file_name = obj.Item.doc_result_filename.S
                        let page_no = $('[name="pageno"] :selected').val();
                        // Set download link
                        set_download_link(download_file_name, page_no);
                    }
                }
            }
        });
    }

    // Retrieve image data for a specific file name and page number
    function get_image(file_name, page_no, data_type = 'sample', ajax_call = true, build_file_name = true) {
        let token = '{{ csrf_token() }}';
        //check upload file name
        if (build_file_name == true) {
            file_name = uploadDoc ? upload_fileName : file_name;
        }
        data_type = uploadDoc ? "upload" : data_type;
        // $('.doc_name').text(file_name);
        let data = {
            'file_name': file_name,
            'page_no': page_no,
            '_token': token,
            'data_type': data_type,
            'build_file_name': build_file_name
        }
        if (ajax_call == true) {
            //ajax
            $.post("{{ url('/get_image') }}", data, function(data, status) {
                if (data == "force_redirect") {
                    location.reload()
                }
                if (data !== '"Error processing the request!"') {
                    $('.doc_image').html(data);
                    // For Coming from Dashbord Page

                    let filename = file_name
                    var extension = filename.split('.').pop().toLowerCase();
                    if (extension == "tiff" && build_file_name == false) {
                        var file = dataURLtoFile($(data).attr('src'), filename);
                        var reader = new FileReader();
                        var output = $('<img />');
                        reader.onload = function() {
                            Tiff.initialize({
                                TOTAL_MEMORY: 2000000
                            });
                            var tiff = new Tiff({
                                buffer: reader.result
                            });
                            var tiffCanvas = tiff.toDataURL();
                            // set attr for Tiff img element
                            output.attr('src', tiffCanvas)

                        }
                        reader.readAsArrayBuffer(file)
                        $('.doc_image').html(output);
                    }

                }
                if (data !== "No Data available!") {
                    setTimeout(function() {
                        $('.doc_image').hide();
                        $('#BoundingBoxCanvas').show();
                        $('.bound_box').show();
                        canvasInit();

                    }, 300)

                } else {
                    $('.doc_image').show();
                }
            }).fail(function(error) {
                toastr['error']("Something Went Wrong, Please Try Again");
            });
        } else {
            $('.doc_image').hide();
            $('#BoundingBoxCanvas').show();
            $('.bound_box').show();
            canvasInit();
        }
    }

    // Retrieve different types of documents (raw text, forms, tables, reports)
    function get_documents(thisData, data_type = 'sample') {
        url = thisData.attr('data-url');
        result_id = thisData.attr('data-result-id');
        let file_name = $('#docTypes_select :selected').val();
        let page_no = $('[name="pageno"] :selected').val();
        let token = '{{ csrf_token() }}'
        //check upload file name
        file_name = uploadDoc ? upload_fileName : file_name;
        data_type = uploadDoc ? "upload" : data_type;

        set_download_link(file_name, page_no);
        let data = {
            'file_name': file_name,
            'page_no': page_no,
            '_token': token,
            'data_type': data_type
        }
        if (thisData.attr('data-click') == '1') {
            //ajax
            $.post("{{ url('/') }}/" + url, data, function(data, status) {

                if (data == "force_redirect") {
                    location.reload()
                }
                thisData.attr('data-click', '0')
                $(result_id).html(data);
                //for form tab
                $('.docuTab-cont').css({
                    'padding': '0px 15px'
                });
                if (thisData.attr('id') == "formTab") {
                    $("#select2").select2({
                        minimumInputLength: 3
                    });
                    $('.docuTab-cont').css({
                        'height': '100%',
                        'overflow': 'unset',
                        'padding': '0px 6px'
                    });
                    $('.token-box-top').css({
                        'height': '94vh',
                        'overflow-y': 'scroll',
                        'padding': '20px'
                    });

                    $("#select2").change(function() {
                        $('.token-sale-box').css('border', '2px solid #0000');
                        let tigger_id = $(this).find(':selected').attr('data-trigger-id');
                        $(tigger_id).trigger('click');

                        $(tigger_id).parents('.token-sale-box,td').css('border', '2px solid var(--opt-primary)');

                        $('.token-box-top,' + tigger_id).animate({
                            scrollTop: $(tigger_id).offset().top - 350
                        }, 'slow');
                    })

                    $('.select2-selection__rendered').click(function() {
                        $('.select2-search__field').attr({
                            'id': 'select2SearchInput',
                            'autofocus': true
                        });
                        $('#select2SearchInput').focus();
                    });
                    @if (isset($_GET['action']) && $_GET['action'] == 'view')
                        $('.doc_submit').hide();
                        $('input.BoundingBoxInput').attr('readonly', true);
                    @endif ()



                }
                $('.BoundingBoxLabel').click(function(){
                    BoundingBox($(this))
                })
                $('.BoundingBoxInput ,span.raw_text_val').click(function() {
                    $('span.raw_text_val').removeClass('active');
                    if ($(this).hasClass('raw_text_val')) {
                        $(this).addClass('active');
                    }
                    BoundingBox($(this))
                });
                if (thisData.attr('id') == "formTab" || thisData.attr('id') == 'tableTab') {
                    $('.BoundingBoxInput').focus(function() {
                        $('.token-sale-box').css('border', '2px solid #0000');
                        $(this).parents('.token-sale-box,td').css('border', '2px solid var(--opt-primary)')
                    }).focusout(function() {
                        $(this).parents('.token-sale-box,td').css('border', '2px solid #0000')
                    })
                    let page_count = $('ul#table_pagination li').length;

                    $('#table_pagination').pagination({
                        pages: page_count,
                        itemsOnPage: 5
                    });
                }
                if (thisData.attr('data-form-id')) {
                    sendDocument(file_name, page_no);
                }

            }).fail(function(error) {
                toastr['error']("Something Went Wrong, Please Try Again");
            });
        }
    }

    //Send to the user edited Document.
    function sendDocument(file_name, page_no) {
        // prevent the form submission and pass data from ajax
        $('#formsData, #tableData').submit(function(e) {
            e.preventDefault();
            let input = $('<input/>').attr({
                'type': 'hidden'
            });
            // dynamically change the url for submit click in table or form check
            let url = $(this).attr('id') == "formsData" ? '/send_forms' : '/send_tables';
            let data = $(this).serialize();

            // Adding the extra field in post data (file name , page number)
            data = data + "&file_name=" + file_name + "&page_no=" + page_no + "&uploaded_file_name=" + $(
                '#Uploaded__fileName').val();
            //ajax
            $.post("{{ url('/') }}" + url, data, function(data, status) {
                if (data == "force_redirect") {
                    location.reload()
                }
                @if (env('APP_DEBUG') == true)
                    console.log(data);
                @endif
            });
        })
        $('.doc_submit').click(function() {
            //confirmation alert
            Swal.fire({
                title: 'Are you sure?',
                text: "Please Confirm Changes.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr('data-submit-id');
                    $(id).submit();
                    $('.doc_submit').hide();
                    $('#formTab').attr('data-form-submit', 0)
                    // check the click event for table or forms data.
                    if (id == "#formsData") {
                        form_submit = false;
                    } else if (id == "#tableData") {
                        table_submit = false;
                    }
                }
            })
        });
    }
    // Sending AJAX request and upload file
    function uploadData(formdata) {

        uploadDoc = form_click = table_click = report_click = form_submit = table_submit = true;
        upload_fileName = "";
        $('#formTab').attr('data-form-submit', 1)
        $('#raw_textTab').trigger('click');
        $('.doc_files_tab li button').attr('data-click', 1);
        $('.doc_info_cont .on-board').remove();
        $('.uploaded_list li').removeClass('active');
        formdata.append('_token', '{{ csrf_token() }}');
        // $('#docTypes_select option:first').attr('selected', true);
        $("#docTypes_select option:selected").prop("selected", false);
        $('select[name="pageno"] option:first').attr('selected', true);
        $('.doc_name').text("");
        $('.note').html('<div align=\"center\"><img src=\"{{ asset('images/spinner.gif') }}\"></div>');
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
            // dataType: 'json',
            success: function(data) {
                if (data == "force_redirect") {
                    location.reload()
                }
                //addThumbnail(response);
                // $('#loader_text h6').text(status_text[0]);
                // status_key++;
                setTimeout(function() {
                    $('#preloader').show();
                    $('#loader_text').show();
                }, 1);
                setTimeout(function() {
                    check_document_status();
                }, 5000);

                $('.note').html(data);
            }

        });
    }

    function ShowNoDataText() {
        $('.doc_image').show().html('<div class="not_found" style="padding: 20px;">No Data available!</div>');
        $('.bound_box').hide();
        $('.rawText').html('<div class="not_found">No Data available!</div>');
    }
    const BoundingBox = (data) => {
        //( data) is user clicked forms data obj.
        let width = data.attr('data-width');
        let height = data.attr('data-height');
        let top = data.attr('data-top');
        let left = data.attr('data-left');
        let canvasWidth = $('#BoundingBoxCanvas').width();
        let canvasHeight = $('#BoundingBoxCanvas').height();
        // canvas draw function for bounding box
        canvasDraw({
            'width': width,
            'height': height,
            'top': top,
            'left': left
        })
    }
    //end functions


    // document ready function
    $(function() {
        // uploaded list select box change event.
        $('#uploaded_list_select').change(function() {
            ShowNoDataText();
            $('.doc_files_tab li button').attr('data-click', 1);
            form_click = table_click = report_click = true;
            $('#raw_textTab').trigger('click');
            let file_name = $(this).find(':selected').val();
            check_document_status(file_name);
        })

        // for selecting the next uploaded list next document
        $('.doc_next').click(function() {
            let doc_next_val = $('#uploaded_list_select :selected').next().val()
            $('#uploaded_list_select').val(doc_next_val).trigger('change');
        });

        // for selecting the prev uploaded list next document
        $('.doc_prev').click(function() {
            let doc_prev_val = $('#uploaded_list_select :selected').prev().val();
            $('#uploaded_list_select').val(doc_prev_val).trigger('change');
        });

        @if (isset($_GET['file']))
            $('#preloader').show()
            // check_document_status('{{ $_GET['file'] }}')
            $('#uploaded_list_select').val('{{ $_GET['file'] }}').trigger('change');
            var new_url = "doc_verify";
            window.history.pushState(null, "", new_url);
        @endif


        $('.help_info').parent().css('position', 'relative');
        // check_document_status()
        $('.doc_files_tab li button').attr('data-click', 1);
        $("#docTypes_select option:selected").prop("selected", false);



        $('.doc_files_tab li button').click(function() {


            if ($(this).attr('id') == "formTab" && $('#formTab').attr('data-form-submit') == 1) {
                $('.doc_submit').show();
            }
            // else if ($('#docTypes_select :selected').val() == "" && $(this).attr('id') == "tableTab" && table_submit == true) {
            //     $('.doc_submit').show()
            // }
            else {
                @if (isset($_GET['action']) && $_GET['action'] == 'view')
                    $('.doc_submit').hide();
                    $('input.BoundingBoxInput').attr('readonly', true);
                @endif ()
                $('.doc_submit').hide();
            }

            // legend show only forms and table tabs.
            if ($(this).attr('id') == "formTab" || $(this).attr('id') == 'tableTab') {
                $('.legend').show();
            } else {
                $('.legend').hide();
            }
            if ($(this).attr('data-form-id')) {
                $('.doc_submit').attr('data-submit-id', $(this).attr('data-form-id'));
            }
            get_documents($(this));
        })
        $('#docTypes_select').change(function() {
            $('select[name="pageno"] option:first').attr('selected', true);
            let total_page = $(this).find(':selected').attr('data-total-page');
            let option = "";
            for (let i = 1; i <= total_page; i++) {
                option = option + "<option value='" + i + "'>" + i + "</option>";
            }
            $('select[name="pageno"]').html(option);
            $('.doc_details').hide();
            $('.download_doc').hide();
            $('.uploaded_list li').removeClass('active');
            $('#formTab').attr('data-form-submit', 0)
        })

        $('[name="pageno"]').change(function() {
            form_submit == true
            $('#formTab').attr('data-form-submit', 1)
        })
        // event for select sample document
        $('#docTypes_select , [name="pageno"]').change(function() {
            ShowNoDataText();

            $('.doc_files_tab li button').attr('data-click', 1);
            form_click = table_click = report_click = true;
            let file_name = $('#docTypes_select :selected').val();
            let page_no = $('[name="pageno"] :selected').val();
            if ($(this).attr('name') !== "pageno") {
                uploadDoc = false;
                $('[name="pageno"] :selected').attr('selected', false);
                $('.doc_name').text($(this).val());
                page_no = 1;
            }
            $('#raw_textTab').trigger('click');
            get_image(file_name, page_no);
            //get raw text
            // get_rawText(file_name, page_no);
            get_documents($('#raw_textTab'));
            if ($(this).find(':selected').val() !== "") {
                $('.raw_text_cont').show();
                $('.form_cont').show();
                // $('#mainimg').show();
                $('.bound_box').show();
                $('.not_found').hide();

            } else {
                $('.raw_text_cont').hide();
                $('.form_cont').hide();
                // $('#mainimg').hide();
                $('.bound_box').hide();
                $('.not_found').show();
                $('select[name="pageno"]').html("<option value='0'>0</option>");
            }
        })
     
        // $('.token-sale-title').click( function() {
        //         $(this).attr()
        // });
    

        // Comming Form the Dashborad Page For Sample Document
        @if (isset($_GET['sample_file']))
            $('#preloader').show()
            let value = '{{ $_GET['sample_file'] }}'
            $('#docTypes_select option[value="' + value + '"]').attr('selected', true);
            $('#docTypes_select').trigger('change')

            // Replace the Url Without Refresh
            var new_url = "doc_verify";
            window.history.pushState(null, "", new_url);
        @endif

        // preloade hide and show for ajax start and stop
        $(document).ajaxStart(function() {
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
        // $.get("https://dev.digitizer.optimizeit.ai/chatbot", function (dataJSON) {
        //     dataJSON = JSON.parse(dataJSON)
        //     console.log(dataJSON)
        //     $('#chat-app').chunkosChat({
        //         dataJSON: dataJSON,
        //     });
        // });
    })
</script>
@endsection
