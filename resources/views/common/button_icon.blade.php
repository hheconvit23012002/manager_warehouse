<button class="{{ $classButton ?? 'btn' }} "
        data-toggle="modal" data-target="{{ '#'.$modalId ?? ''}}"
        onclick="{{ $onclick ?? '' }}"
        data-id="{{ $dataId ?? null }}"
        title="{{ $title ?? '' }}"
>
    <i class="{{ $iconClass ?? '' }}"></i>
</button>
