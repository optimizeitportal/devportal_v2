
@if($raw_text)
<div class="raw_text_cont">
    {{-- Raw text --}}
    {{-- <pre>
    {{print_r($raw_text)}} --}}
    @foreach($raw_text as $field)
    {{-- {{print_r($field->Text)}} --}}
        {{-- @foreach($field as $key => $value) --}}
            {{-- @if($key==='Text') --}}
                <span
                    class="raw_text_val"
                    data-width="{{ $field['BoundingBox']['Width'] ?? '' }}"
                    data-height="{{ $field['BoundingBox']['Height'] ?? '' }}"
                    data-left="{{ $field['BoundingBox']['Left'] ?? '' }}"
                    data-top="{{ $field['BoundingBox']['Top'] ?? '' }}" 
                >
                    <?= $field['Text'] ?>
                </span>
            {{-- @endif --}}
        {{-- @endforeach --}}
    @endforeach

</div>
@else
<div class="not_found">No Data available!</div>
@endif
