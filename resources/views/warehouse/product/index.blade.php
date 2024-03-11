@extends('layout.admin.master')

@section('content')
    @php
        $action = [
            'delete' => [
                'icon' => 'fa-solid fa-trash',
                'onclick' => 'deleteProduct'
            ],
            'edit' => [
                'icon' => 'fa-solid fa-pen',
                'onclick' => 'openModalEdit'
            ],
        ]
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    @include('common.button_icon',[
                        'iconClass' => 'fa-solid fa-plus',
                        'classButton' => 'btn btn-primary',
                        'title' => 'Add new product',
                        'modalId' => 'create-product'
                    ])
                </div>
                <h4 class="page-title">Basic Tables</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                @include('common.table',[
                    'field' => [
                        'Image' => 'image',
                        'Code' => 'code',
                        'Name' => 'name',
                        'Measurement Unit' => 'measurement_unit',
                        'Price' => 'price',
                        'Category' => 'category_name',
                        'Tax' => 'tax_number',
                    ],
                    'data' => $products,
                    'actions' => $action
                ])
            </div>
        </div>
    </div>
    @include('common.pagination',[
        'data' => $products
    ])

    @include('warehouse.product.form',[
        'modalId' => 'create-product',
        'modalTitle' => 'Create new product',
        'router' => 'admin.web.product.store',
        'typeButton' => 'submit'
    ])

    @include('warehouse.product.modify',[
        'modalId' => 'edit-product',
        'modalTitle' => 'Edit product',
        'router' => 'admin.web.product.update',
        'typeButton' => 'submit',
    ])

    @include('warehouse.product.delete',[
        'modalId' => 'delete-product',
        'modalTitle' => 'Delete product',
        'router' => 'admin.web.product.delete',
        'typeButton' => 'submit',
    ])
@endsection
@push('js')
    <script src="{{ asset('js/product.js') }}"></script>
@endpush
