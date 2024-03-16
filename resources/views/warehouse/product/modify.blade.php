@php use App\Models\Staff; @endphp
<div class="modal fade" id="{{ $modalId ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open([
                'method' => $method ?? 'POST',
                 'route' => [$router ?? 'test'],
                 'enctype' => 'multipart/form-data',
                 'id' => 'form-'. ($modalId ?? '')
             ]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $modalTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="product_id" id="product_id">
                @include('common.input-text',[
                    'name' => 'name',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'code',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'measurement_unit',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'price',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'estimated_delivery',
                    'label' => 'Estimated (day)',
                    'classParent' => 'form-group row',
                    'type' => 'number',
                ])

                @include('common.input-text',[
                    'name' => 'image',
                    'classParent' => 'form-group row',
                    'classInput' => 'col-9 p-0',
                    'type' => 'file',
                    'displayImage' => true,
                    'change' => 'changeFile(this)'
                ])

                @if(Auth::user()->position === Staff::POSITION_SUPPER_ADMIN)
                    @include('common.select-box',[
                        'name' => 'center_id',
                        'label' => 'Center',
                        'data' => $centers ?? [],
                        'nameDisplay' => 'name',
                        'nameValue' => 'id',
                        'id' => 'select_center_edit',
                    ])
                @endif

                @include('common.select-box',[
                    'name' => 'category',
                    'label' => 'Category',
                    'data' => $categories ?? [],
                    'nameDisplay' => 'name',
                    'nameValue' => 'id',
                    'id' => 'edit_from_category',
                    'createTag' => true
                ])

                @include('common.select-box',[
                    'name' => 'tax',
                    'label' => 'Tax',
                    'data' => $taxs ?? [],
                    'nameDisplay' => 'number',
                    'nameValue' => 'id',
                    'id' => 'edit_from_tax',
                    'createTag' => true
                ])

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="{{ $typeButton ?? 'button' }}" onclick="{{ $onclick ?? '' }}"
                        class="{{$classButton ?? 'btn btn-primary'}}">{{ $submitText ?? 'Save' }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



