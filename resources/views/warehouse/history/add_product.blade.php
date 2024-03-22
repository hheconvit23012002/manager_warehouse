@php use App\Models\Staff;use Illuminate\Support\Facades\Auth; @endphp
@extends('layout.admin.master')


@php
    $userLogin = Auth::user();
@endphp
@section('content')
    @php

    @endphp
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    @include('common.button_icon',[
                        'iconClass' => 'fa-solid fa-plus',
                        'classButton' => 'btn btn-primary',
                        'title' => 'Add number product',
                        'modalId' => 'add-number-product'
                    ])
                </div>
                <h4 class="page-title">Basic Tables</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                @php
                    $fields = [
                        'Code' => 'code',
                        'Image' => 'image_product',
                        'Name' => 'name_product',
                        'Unit' => 'measurement_unit_product',
                        'Price' => 'price',
                        'Number' => 'number',
                        'Time add' => 'created_at',
                    ];
                    if($userLogin->position === Staff::POSITION_SUPPER_ADMIN){
                        $fields['Center'] = 'center_name_product';
                    }
                @endphp
                @include('common.table',[
                    'field' => $fields,
                    'data' => $histories,
                    'actions' => $action ?? []
                ])
            </div>
        </div>
    </div>
    @include('common.pagination',[
        'data' => $histories
    ])

    @include('warehouse.history.add_product_modal',[
        'modalId' => 'add-number-product',
        'modalTitle' => 'Add number product',
        'router' => 'admin.web.product.addNumberProduct',
        'typeButton' => 'submit'
    ])
@endsection
@push('js')
    <script src="{{ asset('js/product.js') }}"></script>
@endpush
