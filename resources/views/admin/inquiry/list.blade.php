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
                    <h5 class="m-b-10">Inquiry</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">New Inquiry</li>
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
                    <div class="col-xxl-4 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-users"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Running Campaign</span>
                                            <span class="fs-24 fw-bolder d-block">

                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-check"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Failed Campaign</span>
                                            <span class="fs-24 fw-bolder d-block">

                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-plus"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">New Leads</span>
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
                                            <th>Fish Name</th>
                                            <th>Quantity</th>
                                            <th>Destination</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inquiries as $item)
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
                                                <td>
                                                    {{ $item->company_name ?? '-' }}
                                                    @if ($item->status === 'new')
                                                        <span class="badge bg-soft-success text-success ms-1">New</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->email ?? '-' }}</td>
                                                <td>{{ $item->fish_name ?? '-' }}</td>
                                                <td>{{ $item->qty ? number_format($item->qty, 0, ',', '.') : '-' }} Kg</td>
                                                <td>{{ $item->port_of_destination ?? '-' }}</td>
                                                <td>
                                                    {{ $item->created_at->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <select class="form-control status-select"
                                                        data-select2-selector="status" data-id="{{ $item->id }}"
                                                        data-current="{{ $item->status }}">

                                                        <option value="new" data-bg="bg-success"
                                                            {{ $item->status == 'new' ? 'selected' : '' }}>
                                                            New
                                                        </option>

                                                        <option value="read" data-bg="bg-warning"
                                                            {{ $item->status == 'read' ? 'selected' : '' }}>
                                                            Read
                                                        </option>

                                                        <option value="potential" data-bg="bg-primary"
                                                            {{ $item->status == 'potential' ? 'selected' : '' }}>
                                                            Lead Potential
                                                        </option>

                                                        <option value="archived" data-bg="bg-danger"
                                                            {{ $item->status == 'archived' ? 'selected' : '' }}>
                                                            Archived
                                                        </option>
                                                    </select>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-view-inquiry"
                                                            data-bs-toggle="modal" data-bs-target="#ViewInquiryModal"
                                                            data-id="{{ $item->id }}"
                                                            data-company_name="{{ $item->company_name }}"
                                                            data-email="{{ $item->email }}"
                                                            data-whatsapp="{{ $item->whatsapp }}"
                                                            data-phone="{{ $item->phone }}"
                                                            data-fish_name="{{ $item->fish_name }}"
                                                            data-latin_name="{{ $item->latin_name }}"
                                                            data-freezing_method="{{ $item->freezing_method }}"
                                                            data-size="{{ $item->size }}"
                                                            data-qty="{{ $item->qty }}"
                                                            data-port_of_destination="{{ $item->port_of_destination }}"
                                                            data-status="{{ $item->status }}"
                                                            data-note="{{ $item->note }}">
                                                            <i class="feather-eye"></i>
                                                        </a>
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
    </div>
@endsection

@section('modal')
    <div class="modal fade-scale" id="ViewInquiryModal" tabindex="-1" aria-labelledby="ViewInquiryModal"
        aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Inquiry</span>
                        <small class="d-block fs-11 fw-normal text-muted">Inquiry Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Company Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="company_name"
                                                        name="company_name" placeholder="Company Name" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" placeholder="Email" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Whatsapp</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="whatsapp"
                                                        name="whatsapp" placeholder="Whatsapp Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Phone</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone" placeholder="Phone Number">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Fish Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="fish_name"
                                                        name="fish_name" placeholder="Fish Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Latin Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="latin_name"
                                                        name="latin_name" placeholder="Latin Fish Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Freezing Method</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="freezing_method"
                                                        name="freezing_method" placeholder="Freezing Method">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Size</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="size"
                                                        name="size" placeholder="Size of Fish">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Quantity</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="qty"
                                                        name="qty" placeholder="Quantity of Fish">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Port Destination</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="port_of_destination"
                                                        name="port_of_destination" placeholder="Port Destination">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status"
                                                    data-select2-selector="status">
                                                    <option value="new" data-bg="bg-success">New</option>
                                                    <option value="read" data-bg="bg-warning">Read</option>
                                                    <option value="potential" data-bg="bg-primary">Lead Potential</option>
                                                    <option value="archived" data-bg="bg-danger">Archived</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Note</label>
                                                <textarea rows="6" class="form-control" id="InquiryNote" placeholder="Note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <!--! BEGIN: [mail-editor-action-left] !-->
                            <div class="d-flex align-items-center">
                            </div>
                            <!--! BEGIN: [mail-editor-action-right] !-->
                            <div class="d-flex align-items-center gap-2">
                                <a href="">
                                    <span class="btn btn-light-danger" data-bs-trigger="hover"
                                        title="Send Message">Close</span>
                                </a>
                                <button type="button" id="btn-mark-read" class="btn btn-success d-none">
                                    Mark as Read
                                </button>
                                <button type="submit" id="btn-submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/dataTables.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.bs5.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/leads-init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            const deleteButtons = document.querySelectorAll('.btn-delete-campaign');

            deleteButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('form');
                    if (!form) return;

                    swalWithBootstrapButtons.fire({
                        title: 'Delete Campaign Item?',
                        text: 'Are you sure you want to delete this campaign contact? This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel',
                        reverseButtons: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });

                });
            });

        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view-inquiry');
            if (!btn) return;

            const form = document.querySelector('#ViewInquiryModal form');
            if (form && btn.dataset.id) {
                form.action = `/admin/inquiry/update/${btn.dataset.id}`;
            }

            document.getElementById('company_name').value = btn.dataset.company_name ?? '';
            document.getElementById('email').value = btn.dataset.email ?? '';
            document.getElementById('whatsapp').value = btn.dataset.whatsapp ?? '';
            document.getElementById('phone').value = btn.dataset.phone ?? '';
            document.getElementById('fish_name').value = btn.dataset.fish_name ?? '';
            document.getElementById('latin_name').value = btn.dataset.latin_name ?? '';
            document.getElementById('freezing_method').value = btn.dataset.freezing_method ?? '';
            document.getElementById('size').value = btn.dataset.size ?? '';
            document.getElementById('qty').value = btn.dataset.qty ?? '';
            document.getElementById('port_of_destination').value = btn.dataset.port_of_destination ?? '';
            document.getElementById('InquiryNote').value = btn.dataset.note ?? '';

            const statusSelect = document.querySelector('select[name="status"]');
            if (statusSelect) {
                statusSelect.value = btn.dataset.status ?? 'read';
                statusSelect.dispatchEvent(new Event('change'));
            }

            toggleActionButtons(btn.dataset.status);
        });
    </script>
    <script>
        $(document).on('change', '.status-select', function() {

            const select = $(this);
            const inquiryId = select.data('id');
            const newStatus = select.val();
            const oldStatus = select.data('current');

            Swal.fire({
                title: 'Change status?',
                text: 'Are you sure you want to update this inquiry status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (!result.isConfirmed) {
                    select.val(oldStatus).trigger('change.select2');
                    return;
                }

                $.ajax({
                    url: `/admin/inquiry/${inquiryId}/status`,
                    type: 'PUT',
                    data: {
                        status: newStatus,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        select.data('current', newStatus);

                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: res.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        select.val(oldStatus).trigger('change.select2');
                        Swal.fire('Error', 'Failed to update status', 'error');
                    }
                });

            });
        });
    </script>
    <script>
        function toggleActionButtons(status) {
            const btnSubmit = document.getElementById('btn-submit');
            const btnMarkRead = document.getElementById('btn-mark-read');

            if (status === 'new') {
                btnSubmit.classList.add('d-none');
                btnMarkRead.classList.remove('d-none');
            } else {
                btnSubmit.classList.remove('d-none');
                btnMarkRead.classList.add('d-none');
            }
        }
    </script>
    <script>
        document.getElementById('btn-mark-read')?.addEventListener('click', function() {

            const inquiryId = document.querySelector('.btn-view-inquiry').dataset.id;

            Swal.fire({
                title: 'Mark as Read?',
                text: 'This inquiry will be marked as read.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, mark as read'
            }).then((result) => {

                if (!result.isConfirmed) return;

                fetch(`/admin/inquiry/${inquiryId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: 'read'
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Inquiry marked as read',
                            timer: 1200,
                            showConfirmButton: false
                        });

                        toggleActionButtons('read');

                        // update select status if exists
                        const statusSelect = document.querySelector('select[name="status"]');
                        if (statusSelect) {
                            statusSelect.value = 'read';
                            statusSelect.dispatchEvent(new Event('change'));
                        }
                    });
            });
        });
    </script>
@endpush
