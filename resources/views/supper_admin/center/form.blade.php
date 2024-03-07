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
                @include('common.input-text',[
                    'name' => 'name',
                    'label' => 'name',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'code',
                    'label' => 'code',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'address',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.input-text',[
                    'name' => 'address2',
                    'required' => true,
                    'classParent' => 'form-group row',
                ])

                @include('common.select-box',[
                    'name' => 'type',
                    'label' => 'Type',
                    'data' => $types ?? [],
                    'id' => 'create_from_center_type'
                ])

                @include('common.input-text',[
                    'name' => 'logo',
                    'classParent' => 'form-group row',
                    'classInput' => 'col-9 p-0',
                    'type' => 'file',
                    'displayImage' => true,
                    'change' => 'changeFile(this)'
                ])

                @include('common.input-text',[
                    'name' => 'email',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'email'
                ])

                @include('common.input-text',[
                    'name' => 'phone_number',
                    'label' => 'phone number',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'text'
                ])

                @include('common.input-text',[
                    'name' => 'bank_account_mame',
                    'label' => 'bank account mame',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'text'
                ])

                @include('common.input-text',[
                    'name' => 'bank_account_number',
                    'label' => 'bank account number',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'text'
                ])

                @include('common.input-text',[
                    'name' => 'tax_code',
                    'label' => 'tax code',
                    'required' => true,
                    'classParent' => 'form-group row',
                    'type' => 'text'
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



