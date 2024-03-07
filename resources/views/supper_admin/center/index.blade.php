@extends('layout.admin.master')

@section('content')
    @php
        $action = [
            'delete' => [
                'icon' => 'fa-solid fa-trash',
                'onclick' => 'deleteCenter'
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
                        'title' => 'Add new Staff',
                        'modalId' => 'create-center'
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
                        'Logo' => 'image_logo',
                        'Code' => 'code',
                        'Name'=>'name',
                        'Email' => 'email',
                        'Address' => 'address_detail',
                        'Phone number' => 'phone_number',
                        'Type' => 'type',
                        'Info Bank' => 'bank_info',
                        'Tax code' => 'tax_code',
                    ],
                    'data' => $centers,
                    'actions' => $action
                ])
            </div>
        </div>
    </div>
    @include('common.pagination',[
        'data' => $centers
    ])

    @include('supper_admin.center.form',[
        'modalId' => 'create-center',
        'modalTitle' => 'Create new center',
        'router' => 'admin.web.center.store',
        'typeButton' => 'submit'
    ])

    @include('supper_admin.center.modify',[
        'modalId' => 'edit-center',
        'modalTitle' => 'Edit center',
        'router' => 'admin.web.center.update',
        'typeButton' => 'submit',
    ])

    @include('supper_admin.center.delete',[
        'modalId' => 'delete-center',
        'modalTitle' => 'Delete center',
        'router' => 'admin.web.center.delete',
        'typeButton' => 'submit',
    ])
@endsection
@push('js')
    <script src="{{ asset('js/staff/center.js') }}"></script>
@endpush
