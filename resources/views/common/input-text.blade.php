<div class=" {{ $classParent ?? 'row' }} {{ ($displayImage ?? false) === true ? 'mb-0' : '' }}">
    <label for="{{ $id ?? $name }}" class=" {{ $classLabel ?? 'col-3' }} d-flex align-items-center">
        {{ ucfirst($label ?? $name) }}
        {!! ($required ?? false) ? '<span id="star-required">*</span>' : '' !!}
    </label>
    <input class="{{ $classInput ?? 'form-control col-9' }}" type="{{ $type ?? 'text' }}" {{ ($readonly ?? false) ? 'readonly' : '' }}
           {{ ($required ?? false) ? 'required' : '' }}"
           name="{{ $name }}"
           id="{{ $id ?? $name }}" onchange="{{ $change  ?? "" }}"
           placeholder="{{ $placeholder ?? ($label ?? $name) }}">
</div>
@if(str_contains(($type ?? ''),'file') && ($displayImage ?? false) === true)
    <div class="row mb-2">
        <div class="{{ $classLabel ?? 'col-3' }}"></div>
        <div class="{{ $classInput ?? 'col-9' }}">
            <img src="#" id="blah" alt="your image" class="img-thumbnail" />
        </div>
    </div>
    <script>

        function changeFile(element){
            let parentElement = element.parentNode.parentNode
            let blah = parentElement.querySelector("#blah")
            const [file] = element.files
            if (file) {
                blah.src = URL.createObjectURL(file);
                blah.width =150;
                blah.height =150;
            }
        }
        {{--console.log($('#' + '{{ ($modalId ?? '') . "-" .($id ?? $name) ?? '' }}'))--}}
        {{--imgInp.on('change', function (){--}}
        {{--    console.log("a")--}}

        {{--})--}}

    </script>
@endif
