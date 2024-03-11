@extends('layout.admin.master')

@section('content')
    @php
        $action = [
            'export_pdf' => [
                'icon' => 'fa-solid fa-file-export',
                'router' => 'admin.web.request.exportRequestPdf',
            ],
            'edit' => [
                'icon' => 'fa-solid fa-pen',
                'onclick' => 'openChangeStatus',
                'title' => 'openChangeStatus'
            ],
        ]
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

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
                        'Shop request' => 'request_name',
                        'Shipping Address' => 'shipping_address',
                        'Phone number' => 'phone_number',
                        'Estimated delivery date' => 'estimated_delivery_date',
                        'status' => 'status',
                    ],
                    'data' => $requests ?? [],
                    'actions' => $action
                ])
            </div>
        </div>
    </div>
    @include('common.pagination',[
        'data' => $requests
    ])

    @include('layout.admin.centerbar',[
        'modalTitle' => 'Change Status Request',
    ])
@endsection
@push('js')
    <script src="{{ asset('js/staff/request.js') }}"></script>
@endpush
