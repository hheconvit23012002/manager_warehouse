@php use App\Models\Order; @endphp
@extends('layout.admin.master')

@section('content')
    @php
        $action = [
            'export_pdf' => [
                'icon' => 'fa-solid fa-file-export',
                'title' => 'Export Order',
                'router' => 'admin.web.request.exportRequestPdf',
                'hiddenCondition' => fn($item) => $item->status !== Order::STATUS_DONE
            ],
            'export_delivery_note' => [
                'icon' => 'fa-solid fa-download',
                'title' => 'Export delivery note',
                'router' => 'admin.web.request.exportRequestPdf',
                'hiddenCondition' => fn($item) => $item->status === Order::STATUS_DONE
            ],
            'edit' => [
                'icon' => 'fa-solid fa-pen',
                'onclick' => 'openChangeStatus',
                'title' => 'openChangeStatus',
                'hiddenCondition' => fn($item) => $item->status === Order::STATUS_DONE
            ],
            'info' => [
                'icon' => "fa-solid fa-circle-info",
                'onclick' => 'openInfoOrder',
                'title' => 'view info'
            ]
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
                        'Code'=>'code',
                        'Shop request' => 'request_name',
                        'Shipping Address' => 'shipping_address',
                        'Phone number' => 'phone_number',
                        'Estimated' => 'estimated_delivery_date',
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

    @include('warehouse.request.info',[
        'idModal' => 'info_request',
        'modalTitle' => 'Process Request',
    ])
@endsection
@push('js')
    <script src="{{ asset('js/staff/request.js') }}"></script>
@endpush
