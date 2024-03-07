{{--@php--}}
{{--    $nameValue = $nameValue ?? '';--}}
{{--    $nameDisplay = $nameDisplay ?? '';--}}
{{-- @endphp--}}
<div class="{{ $classParent ?? 'row' }} ">
    <label for="{{ $id ?? $name }}" class=" {{ $classLabel ?? 'col-3' }} d-flex align-items-center">
        {{ ucfirst($label ?? $name) }}
        {!! ($required ?? false) ? '<span id="star-required">*</span>' : '' !!}
    </label>
    <div class="{{ $classSelect ?? 'col-9 mb-2 p-0' }}">
        <select {{ ($multipleSelect ?? false) ? 'multiple' : '' }} class="custom-select mb-3" id="{{ (($id ?? $name) ?? '') }}" name="{{ $name ?? '' }}">
            {!! ($required ?? false) ? '' : '<option selected>Select value</option>' !!}
            @foreach($data as $text => $each)
                <option value="{{ isset($nameValue) ? ($each->$nameValue ?? $each) ?? '' : $each }}">{{ isset($nameDisplay) ? ($each->$nameDisplay ?? $text )  ?? '' : $text}}</option>
            @endforeach
        </select>
    </div>
</div>
@push('js')
    <script>
            $("#" + "{{ $id ?? $name }}").select2({
                placeholder: '{{ $name ?? '' }}', // placeholder phải là một chuỗi
                // closeOnSelect : true,
                tags: {{ $createTag ?? 'false' }},
            });
    </script>
@endpush

