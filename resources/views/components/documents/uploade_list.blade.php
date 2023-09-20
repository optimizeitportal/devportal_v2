<div>
    {{-- metrics_list --}}
    <table id="metrics_list" class="styled-table metrics">
        <thead>
            <tr>
                <td>Doc Count</td>
                <td>Processed</td>
                <td>Extracted</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="doc_count">{{ $doc_metrics['doc_count'] }}</td>
                <td class="processed">{{ $doc_metrics['processed'] }}</td>
                <td class="extracted">{{ $doc_metrics['extracted'] }}</td>
            </tr>
        </tbody>
    </table>

    {{-- metrics_list 2 --}}
    <div class="row" id='metrics2'>
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
    {{-- Uploade_list --}}
    <table id="ListTable" class="table table-bordered dt-responsive  nowrap w-100 {{ !empty($uploaded_list) ? 'dataTable' : '' }}">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Documents</th>
                <th scope="col">Uploaded on</th>
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
                        <td data-sort="{{ strtotime($list_val['updated_on']) }}">{{ $list_val['updated_on'] }}</td>
                        <td>{{ $list_val['status']  == "UPLOADED" ? "PROCESSING" : $list_val['status'] }}</td>
                        <td>
                            <a
                                href="{{ $list_val['status'] == 'UPLOADED' ? 'javascript:void(0)' : url('doc_verify?file=' . $list_val['files']) }}&action=view">
                                <button class="btn action_btn view" data-toggle="tooltip" data-placement="top"
                                    @if ($list_val['status'] == 'UPLOADED') data-bs-html="true"
                                        title="<img width='17px' height='17px' src='{{asset('images/spinner.gif')}}'> <p>Please wait till the file is processed<p>"
                                    @else
                                        title="view" 
                                    @endif
                                >
                                    <i class="fa fa-eye"></i></button>
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
