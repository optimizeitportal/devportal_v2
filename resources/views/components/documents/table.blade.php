@if (isset($tables) && !empty($tables))
    <div class="card">
        <div class="table-responsive">
            {{-- form --}}
            <form id="tableData" action="{{url('/send_tables')}}" method="post">
                @csrf
                <input type="hidden" name="thead_data" value="{{serialize($tables[0])}}">
                <table class="table " style="table-layout: fixed; width:100%;">
                    <thead class="table-light">
                        <tr>
                            @foreach ($tables[0] as $thead)
                                <th scope="col" style="font-size: 0.88rem" width="100vw" >{{ $thead }}</th>
                            @endforeach
                            @php unset($tables[0]); @endphp
                        </tr>
    
                    </thead>
                    <tbody>
                        @foreach ($tables as $k1 => $table)
                            <tr>
                                @foreach ($table as $k2 => $tbody)
                                    <td {{ $k2==0 ? 'scope="row"' : '' }}> <input type="text" name="table[{{$k1}}][{{$k2}}]" class="input-bordered" value="{{ $tbody }}" style="width:80%"> </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </form>
        </div>
    </div>
@elseif (isset($table_new) && !empty($table_new))

    @php
        $nav_tab_id = array_keys($table_new);
        $i=1;
    @endphp
    @if(count($nav_tab_id) > 1)
    <div class="pagination_cont">
        <ul id="table_pagination" class="nav tab-nav simple-pagination">
            @foreach ($nav_tab_id as $tab_key=> $tab_id )         
                <li>
                    <a class="" data-toggle="tab" href="#{{$tab_id}}">{{$tab_key+1}}  </a>
                </li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="tab-content" style="padding: 0px 15px;">
        
        @foreach ($table_new as $key=> $table)

            <div class="tab-pane fade p-0 show {{current($nav_tab_id) ==$key ? 'active': ''}}" id="_table_{{$i++}}">
                <div class="table-responsive">
                    <table class="table Table_data">
                        @if(isset($table['header']))
                            <thead class="table-light">
                                @foreach ($table['header'] as $h_row_key=> $h_row)
                                    <tr>
                                        @foreach ($h_row as $h_col)
                                            <th  rowspan="{{$h_col['Row_Span']}}" colspan="{{$h_col['Column_Span']}}" scope="col" style="font-size: 0.72rem"  >{{ $h_col['Cell_Text'] ?? $h_col['Merged_Cell_Text'] }}</th>
                                        @endforeach
                                    </tr>
                                    {{-- width="100vw" --}}
                                    {{-- style="table-layout: fixed; width:100%;" --}}
                                @endforeach

                            </thead>
                        @endif
                        @if (isset($table['body']))
                            <tbody>
                                @foreach ($table['body'] as $b_row_key=> $b_row)
                                    <tr>
                                        @foreach ($b_row as $b_ckey => $b_col)
                                            @php 
                                                $confidence = isset($b_col['Merged_Cell_Confidence']) ? $b_col['Merged_Cell_Confidence'] : $b_col['Cell_Confidence'];
                                                    if ($confidence > 90) {
                                                        $color = 'green';
                                                    } elseif ($confidence > 80) {
                                                        $color = 'Yellow';
                                                    } elseif ($confidence > 50) {
                                                        $color = 'orange';
                                                    } else {
                                                        $color = 'red';
                                                    }
                                            @endphp
                                            <td rowspan="{{$b_col['Row_Span']}}" colspan="{{$b_col['Column_Span']}}"> 
                                                <input 
                                                    type="text"  
                                                    data-width="{{ $b_col['Cell_Loc']['Width'] ?? $b_col['Merged_Cell_Loc']['Width'] ?? '' }}"
                                                    data-height="{{ $b_col['Cell_Loc']['Height'] ?? $b_col['Merged_Cell_Loc']['Height'] ?? '' }}"
                                                    data-left="{{ $b_col['Cell_Loc']['Left'] ?? $b_col['Merged_Cell_Loc']['Left'] ?? '' }}"
                                                    data-top="{{ $b_col['Cell_Loc']['Top'] ??$b_col['Merged_Cell_Loc']['Top'] ?? ''}}"
                                                    name="table[{{$key}}][{{$b_row_key}}][{{$b_ckey}}]" 
                                                    class="form-control  input-bordered BoundingBoxInput" value="{{ $b_col['Cell_Text'] ?? $b_col['Merged_Cell_Text'] }}" 
                                                    style="width:100%; height:33px; border-bottom: {{ $color }} 2px solid;"
                                                > 
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="not_found">No Data available!</div>
@endif
