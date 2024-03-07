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
                <h5 class="text-center">Info Staff</h5>
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
                    'name' => 'phone_number',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'text'
                ])


                @include('common.input-text',[
                    'name' => 'image',
                    'classParent' => 'form-group row',
                    'classInput' => 'col-9 p-0',
                    'type' => 'file',
                    'displayImage' => true,
                    'change' => 'changeFile(this)'
                ])

                @include('common.select-box',[
                    'name' => 'category',
                    'label' => 'Or Admin Center',
                    'data' => $center ?? [],
                    'nameDisplay' => 'name',
                    'nameValue' => 'id',
                    'id' => 'create_from_center_id'
                ])

                @include('common.select-box',[
                    'name' => 'center',
                    'label' => 'Or Admin Center',
                    'data' => $center ?? [],
                    'nameDisplay' => 'name',
                    'nameValue' => 'id',
                    'id' => 'create_from_center_id'
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



