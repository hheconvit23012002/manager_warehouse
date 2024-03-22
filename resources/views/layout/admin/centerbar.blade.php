@php use App\Models\Order; @endphp
<div class="overlay">

</div>
<div class="nav-cart" style="max-height: 580px">
    <div class="" role="document">
        <div class="modal-content">
            {!! Form::open([
                'method' => 'POST',
                 'route' => 'admin.web.request.changeStatus',
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
            <div class="modal-body" style="max-height: 520px; overflow-y: auto">

                <div class="container">
                    @include('common.table',[
                        'field' => [
                            'Code' => 'code',
                            'Name' => 'name',
                            'Measurement Unit' => 'measurement_unit',
                            'Price' => 'price',
                            'Number' => 'number',
                        ],
                        'data' => $data ?? [],
                        'idTable' => 'data-checkout',
                        'usingIndex' => false
            //            'actions' => $action
                    ])
                    <div >
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

                        @include('common.input-text',[
                            'name' => 'estimated_delivery_date',
                            'label' => 'estimate',
                            'classParent' => 'row mb-2',
                            'type' => 'date',
                        ])

                        @include('common.select-box',[
                            'name' => 'status',
                            'label' => 'Status',
                            'data' => $status ?? [],
                            'nameDisplay' => 'name',
                            'nameValue' => 'id',
                        ])

                        @include('common.input-text',[
                            'name' => 'file',
                            'classParent' => 'form-group row',
                            'classInput' => 'col-9 p-0',
                            'type' => 'file',
                            'displayImage' => true,
                            'change' => 'changeFile(this)'
                        ])

                        <input type="hidden" class="form-control" name="request_id" id="request_id">
                        <div class="row">
                            <label class=" col-3 d-flex align-items-center">Description</label>
                            <div class="col-9 p-0">
                                <textarea name="desc" class="form-control" style="width: 100%"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer p-2" style="max-height: 50px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="Submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
