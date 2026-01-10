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

        /* Pastikan search & bulk sejajar */
        .dataTables_filter {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Paksa bulk button horizontal */
        .bulk-actions {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 8px;
        }

        /* Paksa button tidak jadi block */
        .bulk-actions .btn {
            display: inline-flex;
            white-space: nowrap;
        }

        /* Rapikan input search */
        .dataTables_filter input {
            width: 220px;
            min-width: 220px;
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
                                                {{ number_format($runningCampaign, 0, ',', '.') }}
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
                                                {{ number_format($failedCampaign, 0, ',', '.') }}
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
                                            <span
                                                class="fs-24 fw-bolder d-block">{{ number_format($newLeads, 0, ',', '.') }}</span>
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
                                <div id="bulkActionWrapper" class="d-none">
                                    <button class="btn btn-danger btn-sm" id="btnBulkDelete">Delete</button>
                                </div>
                                <table class="table table-hover" id="CampaignList">
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
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
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

            // EVENT DELEGATION (WAJIB)
            document.addEventListener('click', function(e) {

                const btn = e.target.closest('.btn-delete-campaign');
                if (!btn) return;

                e.preventDefault();

                const form = btn.closest('form');
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
    </script>
    <script>
        $(function() {

            if ($.fn.DataTable.isDataTable('#CampaignList')) {
                $('#CampaignList').DataTable().destroy();
            }

            $('#CampaignList').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('campaign.datatable') }}",
                pageLength: 10,
                order: [
                    [1, 'asc']
                ],

                /* ✅ TAMBAHAN WAJIB (SLOT BULK ACTION) */
                dom: "<'row align-items-center mb-3 px-3'" +
                    "<'col-md-6'l>" +
                    "<'col-md-6 d-flex align-items-center justify-content-end'f<'bulk-actions ms-3'>>" +
                    ">" +
                    "t" +
                    "<'row mt-3 px-3'" +
                    "<'col-md-6'i>" +
                    "<'col-md-6 d-flex justify-content-end'p>" +
                    ">",

                columns: [{
                        data: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'company',
                        name: 'company'
                    }, // ⬅️ WAJIB
                    {
                        data: 'email',
                        name: 'email'
                    }, // ⬅️ WAJIB
                    {
                        data: 'country',
                        name: 'country'
                    }, // ⬅️ WAJIB
                    {
                        data: 'schedule',
                        name: 'email_campaign_contacts.sent_at'
                    },
                    {
                        data: 'status',
                        orderable: true,
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],


                /* ✅ SUDAH ADA – TETAP */
                drawCallback: function() {
                    if (typeof toggleBulkButton === 'function') {
                        toggleBulkButton();
                    }
                }
            });

            /* ✅ PINDAHKAN BULK BUTTON (SEKALI SAJA) */
            if ($('#bulkActionWrapper').length) {
                $('.bulk-actions').append($('#bulkActionWrapper'));
            }

        });
    </script>
    <script>
        "use strict";

        $(document).ready(function() {

            function getSelectedIds() {
                return $('.checkbox-user:checked').map(function() {
                    return $(this).val();
                }).get();
            }

            function toggleBulkButton() {
                $('#bulkActionWrapper').toggleClass(
                    'd-none',
                    getSelectedIds().length === 0
                );
            }

            function csrf() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            // check all
            $('#checkAllLead').on('change', function() {
                $('.checkbox-user').prop('checked', this.checked);
                toggleBulkButton();
            });

            // single checkbox (delegated karena server-side)
            $(document).on('change', '.checkbox-user', function() {
                $('#checkAllLead').prop(
                    'checked',
                    $('.checkbox-user').length === $('.checkbox-user:checked').length
                );
                toggleBulkButton();
            });

            // BULK DELETE
            $('#btnBulkDelete').on('click', function() {
                const ids = getSelectedIds();
                if (!ids.length) return;

                Swal.fire({
                    title: 'Delete selected campaigns?',
                    text: `You are about to delete ${ids.length} campaign(s). This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    $.ajax({
                        url: "{{ route('campaign.bulk-delete') }}",
                        type: "POST",
                        data: {
                            ids: ids,
                            _token: csrf()
                        },
                        success: function(res) {
                            Swal.fire('Deleted', res.message, 'success');
                            $('#checkAllLead').prop('checked', false);
                            $('#bulkActionWrapper').addClass('d-none');
                            $('#CampaignList').DataTable().ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error',
                                xhr.responseJSON?.message || 'Something went wrong',
                                'error'
                            );
                        }
                    });
                });
            });

        });
    </script>
@endpush
