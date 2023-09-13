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
                        <div class="token-sale-box">
                            <div class="form-check pa-r">
                                <input type="hidden" name="input[{{ $key }}][element_selected]" value="false">
                                <input class="form-check-input" name="input[{{ $key }}][element_selected]" type="checkbox" value="true" checked>
                            </div> 
                            <span 
                                data-width="{{ $form[0]['Key_Loc']['Width'] ?? '' }}"
                                data-height="{{ $form[0]['Key_Loc']['Height'] ?? '' }}"
                                data-left="{{ $form[0]['Key_Loc']['Left'] ?? '' }}"
                                data-top="{{ $form[0]['Key_Loc']['Top'] ?? '' }}"
                                contenteditable="true" 
                                class="token-sale-title BoundingBoxLabel"
                                style="display:inline-block;" 
                                data-lableid="editedLable{{ $key }}" 
                                oninput="EditLable(event)"
                            >
                                {{ $form[0]['Key_Text'] ?? '' }}
                            </span>
                            <div class="field-wrap">
                                <input type="hidden" id="editedLable{{ $key }}" class="edited_lable"  name="" data-name="input[{{ $key }}][edited_lable]">
                                
                                @if( $form[1]['Value_Text'] == "NOT_SELECTED" || $form[1]['Value_Text'] == 'SELECTED')
                                    <select name="input[{{ $key }}][value]" id="input{{ $key }}"
                                    data-width="{{ $form[1]['Value_Loc']['Width'] ?? '' }}"
                                    data-height="{{ $form[1]['Value_Loc']['Height'] ?? '' }}"
                                    data-left="{{ $form[1]['Value_Loc']['Left'] ?? '' }}"
                                    data-top="{{ $form[1]['Value_Loc']['Top'] ?? '' }}" type="text"
                                    class="form-control input-bordered BoundingBoxInput" value="<?= $form[1]['Value_Text'] ?? '' ?>"
                                    style="border-bottom: {{ $color }} 2px solid;" >
                                            <option value="SELECTED" selected="{{$form[1]['Value_Text'] == "SELECTED" ? 'true' : 'false'}}" >SELECTED</option>
                                            <option value="NOT_SELECTED" selected="{{$form[1]['Value_Text'] == "NOT_SELECTED" ? 'true' : 'false'}}" >NOT_SELECTED</option>
                                    </select>
                                @else
                                    <input name="input[{{ $key }}][value]" id="input{{ $key }}"
                                        data-width="{{ $form[1]['Value_Loc']['Width'] ?? '' }}"
                                        data-height="{{ $form[1]['Value_Loc']['Height'] ?? '' }}"
                                        data-left="{{ $form[1]['Value_Loc']['Left'] ?? '' }}"
                                        data-top="{{ $form[1]['Value_Loc']['Top'] ?? '' }}" type="text"
                                        class="form-control input-bordered BoundingBoxInput" value="<?= $form[1]['Value_Text'] ?? '' ?>"
                                        style="border-bottom: {{ $color }} 2px solid;" 
                                    />
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="hidden" name="form_data" value="{{ serialize($forms) }}">
                <script>
                       function EditLable(event){
                            let element = event.currentTarget;   // Use event.currentTarget to access the element that triggered the event
                            let lableId = element.getAttribute("data-lableid");  // Get the value of the data-lableId attribute
                           
                            let editedLable = document.getElementById(lableId); // Find the element with the corresponding ID

                            // Check if the element with the given ID exists
                            if (editedLable) {
                                let name = editedLable.getAttribute('data-name'); // Get the data-name attribute
                                editedLable.setAttribute("name", name);// Set the name attribute of the element

                                // Update the value of the element with the contenteditable content
                                editedLable.value = element.textContent;
                            } else {
                                console.error("Element with ID '" + lableId + "' not found.");
                            }
                        }
                </script>
            </div>
        </form>
    </div>
@else
    <div class="not_found">No Data available!</div>
@endif
