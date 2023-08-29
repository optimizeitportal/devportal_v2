@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')

@component('components.breadcrumb')
@slot('li_1') Dashboards @endslot
@slot('title') Dashboard @endslot
@endcomponent

<div class="row">

    <div class="col-xl-12">
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
        <!-- end row -->

        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
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
                                        <img src="{{ URL::asset('build/images/product/img-7.png') }}" alt="" class="avatar-sm">
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
                                        <img src="{{ URL::asset('build/images/product/img-4.png') }}" alt="" class="avatar-sm">
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
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
  <!-- Required datatable js -->
  <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
  {{-- <script src="{{ URL::asset('build/libs/pdfmakebuild/pdfmake.min.js') }}"></script> --}}
  <script src="{{ URL::asset('build/libs/pdfmakebuild/vfs_fonts.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- Responsive examples -->
  <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
  <!-- Datatable init js -->
  <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection
