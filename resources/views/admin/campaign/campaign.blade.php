@extends('layout.admin')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/dataTables.bs5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2-theme.min.css">
    <style>
        .page-header-right-items-wrapper a.btn {
            width: auto !important;
            white-space: nowrap;
        }

        .truncate-text {
            max-width: 150px;
            /* atur sesuai kebutuhan */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@section('main')
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Campaign</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Campaign</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-primary rounded-circle d-inline-block me-3"></span>
                                    <span>New</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                    <span>Working</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                    <span>Qualified</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-danger rounded-circle d-inline-block me-3"></span>
                                    <span>Declined</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-teal rounded-circle d-inline-block me-3"></span>
                                    <span>Customer</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-indigo rounded-circle d-inline-block me-3"></span>
                                    <span>Contacted</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                    <span>Pending</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                    <span>Approved</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-teal rounded-circle d-inline-block me-3"></span>
                                    <span>In Progress</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-paperclip"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-pdf me-3"></i>
                                    <span>PDF</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-csv me-3"></i>
                                    <span>CSV</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-xml me-3"></i>
                                    <span>XML</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-txt me-3"></i>
                                    <span>Text</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-exe me-3"></i>
                                    <span>Excel</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-printer me-3"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('start.campaign') }}" method="POST">
                            @csrf
                            <a href="javascript:void(0);" class="btn btn-primary w-100"
                                onclick="this.closest('form').submit();">
                                <i class="feather-play me-2"></i>
                                <span>Start Campaign</span>
                            </a>
                        </form>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
            <div class="accordion-body pb-2">
                <div class="row">
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-users"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Total Leads</span>
                                            <span class="fs-24 fw-bolder d-block"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-check"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Potential Leads</span>
                                            <span class="fs-24 fw-bolder d-block"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-plus"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Non Potential Leads</span>
                                            <span class="fs-24 fw-bolder d-block"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-minus"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Inactive Leads</span>
                                            <span class="fs-24 fw-bolder d-block"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="leadList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="btn-group mb-1">
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="checkAllLead">
                                                        <label class="custom-control-label" for="checkAllLead"></label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>No</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Schedule</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($campaignContacts as $item)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input checkbox"
                                                            id="checkBox_{{ $item->id }}">
                                                        <label class="custom-control-label"
                                                            for="checkBox_{{ $item->id }}"></label>
                                                    </div>
                                                </td>

                                                <td>{{ $loop->iteration }}</td>

                                                <!-- Company -->
                                                <td>{{ $item->contact->company ?? '-' }}</td>

                                                <!-- Email -->
                                                <td>{{ $item->contact->kirim ?? '-' }}</td>

                                                <!-- Country -->
                                                <td>{{ $item->contact->country ?? '-' }}</td>
                                                <td>
                                                    {{ $item->sent_at ? \Carbon\Carbon::parse($item->sent_at)->format('d M Y') . ' | ' . \Carbon\Carbon::parse($item->sent_at)->format('H.i') : '-' }}
                                                </td>

                                                <td>
                                                    @php
                                                        $status = $item->status;

                                                        $badgeMap = [
                                                            'pending' => [
                                                                'label' => 'Pending',
                                                                'class' => 'badge bg-soft-warning text-warning',
                                                            ],
                                                            'sent' => [
                                                                'label' => 'Sent',
                                                                'class' => 'badge bg-soft-success text-success',
                                                            ],
                                                            'failed' => [
                                                                'label' => 'Failed',
                                                                'class' => 'badge bg-soft-danger text-danger',
                                                            ],
                                                        ];
                                                    @endphp

                                                    <div
                                                        class="{{ $badgeMap[$status]['class'] ?? 'badge bg-secondary' }}">
                                                        {{ $badgeMap[$status]['label'] ?? ucfirst($status) }}
                                                    </div>
                                                </td>


                                                <!-- Actions -->
                                                <td class="text-end">
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <!-- View -->
                                                        <a href="javascript:void(0);"
                                                            class="avatar-text avatar-md btn-view-contact"
                                                            data-bs-toggle="modal" data-bs-target="#viewContactModal"
                                                            data-company="{{ $item->contact->company }}"
                                                            data-kirim="{{ $item->contact->kirim }}"
                                                            data-country="{{ $item->contact->country }}"
                                                            data-main_product="{{ $item->contact->main_product }}"
                                                            data-website="{{ $item->contact->website }}"
                                                            data-phone="{{ $item->contact->phone }}"
                                                            data-whatsapp="{{ $item->contact->whatsapp }}"
                                                            data-contact_person="{{ $item->contact->contact_person }}"
                                                            data-notes="{{ $item->contact->notes }}"
                                                            data-status="{{ $item->contact->status }}">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        <!-- Dropdown -->
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                                data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                <i class="feather feather-more-horizontal"></i>
                                                            </a>

                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item btn-edit-contact"
                                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#editContactModal"
                                                                        data-id="{{ $item->contact->id }}"
                                                                        data-company="{{ $item->contact->company }}"
                                                                        data-main_product="{{ $item->contact->main_product }}"
                                                                        data-website="{{ $item->contact->website }}"
                                                                        data-kirim="{{ $item->contact->kirim }}"
                                                                        data-country="{{ $item->contact->country }}"
                                                                        data-phone="{{ $item->contact->phone }}"
                                                                        data-whatsapp="{{ $item->contact->whatsapp }}"
                                                                        data-contact_person="{{ $item->contact->contact_person }}"
                                                                        data-notes="{{ $item->contact->notes }}"
                                                                        data-status="{{ $item->contact->status }}">
                                                                        <i class="feather feather-edit-3 me-3"></i>
                                                                        Edit
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <form action="" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item btn-delete-contact"
                                                                            href="javascript:void(0)">
                                                                            <i class="feather feather-trash-2 me-3"></i>
                                                                            Delete
                                                                        </a>
                                                                    </form>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection

@section('modal')
@endsection

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/dataTables.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.bs5.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/leads-init.min.js"></script>
@endpush
