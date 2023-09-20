@props(['fieldNames', 'index', 'type', 'label', 'box', 'row', 'key_name','t_type'])

{{-- Render checkboxes if the type is not specified --}}
@if (!isset($type))
    @foreach ($fieldNames as $k => $field_name)
        <div class="col-auto">
            <div class="form-check">
                {{-- Hidden inputs to store checkbox data --}}
                <input type="hidden" name="data[{{ $index }}][field_name]" value="{{ $field_name }}">
                <input type="hidden" name="data[{{ $index }}][field_value]" value="false">
                <input class="form-check-input" name="data[{{ $index }}][field_value]" type="checkbox"
                    value="true" id="{{ str_replace(' ', '_', $field_name) }}">
                <label class="form-check-label" for="{{ str_replace(' ', '_', $field_name) }}">
                    {{ $field_name }}
                </label>
                @php $index++ @endphp
            </div>
        </div>
    @endforeach

{{-- Render input field if the type is 'input' --}}
@elseif ($type == 'input' || $type == 'date' || $type == 'number' || $type == 't_input'|| $type == 'file' || $type == 'checkbox' )
    {{-- Render label if provided --}}
    @if ($type !== "checkbox")
        
        @if (isset($label))
            <label for="">{{ $label }}</label>
        @endif
        {{-- Hidden input to store field data --}}
        <input type="hidden" name="{{ $type == 't_input' ? 'data[tables]['.$box.']['.$row.']['.$index.'][field_name]' : 'data['.$index.'][field_name]' }}" value="{{ isset($label) ? $label : $key_name }}">
        {{-- Render input field based on type --}}
        @if ($type == 'input') 
            <input class="form-control" name="data[{{ $index }}][field_value]" type="text" value=""
                id="">
        @elseif ($type == 'date')
            <input class="form-control" name="data[{{ $index }}][field_value]" type="date" value=""
                id="">
        @elseif ($type == 'number')
            <input class="form-control" name="data[{{ $index }}][field_value]" type="number" value=""
                id="">
        @elseif ($type == 't_input')
            <input class="form-control" name="data[tables][{{ $box }}][{{ $row }}][{{ $index }}][field_value]" type="{{$t_type ?? "text"}}" value=""
                id="">
        @elseif ($type == 'file')
            <input class="form-control" name="data[{{ $index }}][field_value]" type="file" value=""
            id="">

            
        @endif
    @else
        <input type="hidden" name="{{ $type == 't_input' ? 'data[tables]['.$box.']['.$row.']['.$index.'][field_name]' : 'data['.$index.'][field_name]' }}" value="{{ isset($label) ? $label : $key_name }}">
        <input type="hidden" name="data[{{ $index }}][field_value]" value="false">
        <input class="form-check-input" name="data[{{ $index }}][field_value]" type="checkbox"
            value="true" id="{{ str_replace(' ', '_', $label) }}">
            @if (isset($label))
                <label class="form-check-label" for="{{ str_replace(' ', '_', $label) }}">
                    {{ isset($label) ? $label : $key_name }}
                </label>
            @endif
    @endif

@endif
