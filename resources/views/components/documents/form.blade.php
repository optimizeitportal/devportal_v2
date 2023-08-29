@if ($forms)
<div class="mb-4">
    <select name="" id="select2" class="p-3">
        <option value="">Select text</option>
        @foreach ($forms as $key => $val)
            @php
            //    $value = explode('.', $val[0]['Key_Text']);
             
            //    if(count($value) > 1){
            //         unset($value[0]);
            //     }
            //     $value = implode('.',$value);
              
            @endphp
            
            <option data-trigger-id="#input{{ $key }}" value="{{$val[0]['Key_Text'] ?? ""}}">{{$val[0]['Key_Text'] ?? ""}}</option>
        @endforeach
    </select>
</div>
    <div class="token-box-top mb-5">
        {{-- form --}}
        <form id="formsData" action="" method="post">
            @csrf
            <div class="row gutter-vr-30px form_cont ">

                @foreach ($forms as $key => $form)
                    @php
                        if ($form[1]['Value_Confidence'] > 90) {
                            $color = 'green';
                        } elseif ($form[1]['Value_Confidence'] > 80) {
                            $color = 'Yellow';
                        } elseif ($form[1]['Value_Confidence'] > 50) {
                            $color = 'orange';
                        }else {
                            $color = 'red';
                        }
                        $val = $form[1]['Value_Text'] ?? "";

                        if ((isset($form[0]['Key_Mandatory']) && $form[0]['Key_Mandatory'] == "Y") && ($val =="" || $val=='VALUE_NOT_FOUND')) {
                            $color = 'red';
                        }
                    @endphp
                
                    <div class="col-lg-4 col-md-6 px-1 py-1">
                        <div class="token-sale-box"> <span class="token-sale-title"
                                style="display:inline-block;">{{ $form[0]['Key_Text'] ?? '' }}</span>
                            <div class="field-wrap">
                                <input name="input[{{ $key }}]" id="input{{ $key }}"
                                    data-width="{{ $form[1]['Value_Loc']['Width'] ?? '' }}"
                                    data-height="{{ $form[1]['Value_Loc']['Height'] ?? '' }}"
                                    data-left="{{ $form[1]['Value_Loc']['Left'] ?? '' }}"
                                    data-top="{{ $form[1]['Value_Loc']['Top'] ?? '' }}" type="text"
                                    class="input-bordered BoundingBoxInput" value="<?= $form[1]['Value_Text'] ?? '' ?>"
                                    style="border-bottom: {{ $color }} 2px solid;" 
                                />

                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="form_data" value="{{ serialize($forms) }}">
            </div>
        </form>
    </div>
@else
    <div class="not_found">No Data available!</div>
@endif
