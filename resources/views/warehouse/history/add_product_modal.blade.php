@php use App\Models\Staff;use Illuminate\Support\Facades\Auth; @endphp
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
                @include('common.select-box',[
                    'name' => 'product_id',
                    'label' => 'Product',
                    'data' => $products ?? [],
                    'nameDisplay' => 'name',
                    'nameValue' => 'id',
                    'id' => 'select_product',
                    'required' => true
                ])

                @include('common.input-text',[
                    'name' => 'number',
                    'required' => true,
                    'type' => 'number',
                    'classParent' => 'form-group row',
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



