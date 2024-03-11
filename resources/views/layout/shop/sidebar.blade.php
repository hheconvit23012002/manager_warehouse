<div class="overlay">

</div>
<div class="nav-cart">
    <div class="" role="document">
        <div class="modal-content">
            {!! Form::open([
                'method' => 'POST',
                 'route' => 'checkout',
                 'enctype' => 'multipart/form-data',
                 'id' => 'form-checkout',
                 'class' => 'form-group'
             ]) !!}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $modalTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="container">
                    @include('common.table',[
                        'field' => [
//                            'id' => 'id',
            //                'Image' => 'image',
                            'Code' => 'code',
                            'Name' => 'name',
                            'Measurement Unit' => 'measurement_unit',
                            'Price' => 'price',
                            'Number' => 'number',
            //                'Tax' => 'tax_number',
                        ],
                        'data' => [],
                        'idTable' => 'data-checkout',
                        'usingIndex' => false
            //            'actions' => $action
                    ])
                    <div>
                        <h4 class="text-center">Info detail</h4>
                        @include('common.input-text',[
                            'name' => 'shipping_address',
                            'label' => 'address',
                            'required' => true,
                            'classParent' => 'row mb-2'
                        ])
                        @include('common.input-text',[
                            'name' => 'phone_number',
                            'label' => 'Phone Number',
                            'required' => true,
                            'classParent' => 'row mb-2'

                        ])
                        <input  type="hidden" class="form-control" name="seller_id" value="{{ $centerId }}">
                        <div class="row">
                            <label class=" col-3 d-flex align-items-center">Description</label>
                            <div class="col-9">
                                <textarea name="desc" class="form-control" style="width: 100%" ></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer p-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" onclick="" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
