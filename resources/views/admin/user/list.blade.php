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
                    <h5 class="m-b-10">List User</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">List User</li>
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
                        <a href="javascript:void(0);" class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#AddUser">
                            <i class="feather-plus me-2"></i>
                            <span>Add User</span>
                        </a>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
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
                                    <button class="btn btn-success btn-sm" id="btnBulkActivate">Activate</button>
                                    <button class="btn btn-warning btn-sm" id="btnBulkDeactivate">Deactivate</button>
                                </div>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Verified</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr class="single-item">
                                                <td>
                                                    <div class="item-checkbox ms-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="checkbox-user custom-control-input checkbox"
                                                                id="checkBox_{{ $user->id }}"
                                                                value="{{ $user->id }}">
                                                            <label class="custom-control-label"
                                                                for="checkBox_{{ $user->id }}"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="hstack gap-3">
                                                        <div>
                                                            <span class="text-truncate-1-line">{{ $user->name }}</span>
                                                            @if ($user->is_superadmin == 1)
                                                                <small class="fs-12 fw-normal text-muted">Super
                                                                    Admin</small>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->email_verified_at)
                                                        {{ \Carbon\Carbon::parse($user->email_verified_at)->format('d M Y H:i') }}
                                                    @else
                                                        <em>Unverified</em>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select class="form-control status-select"
                                                        data-select2-selector="status" data-user-id="{{ $user->id }}"
                                                        data-auth-id="{{ auth()->id() }}"
                                                        data-current="{{ $user->is_active }}">
                                                        <option value="1" data-bg="bg-success"
                                                            {{ $user->is_active == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>

                                                        <option value="0" data-bg="bg-danger"
                                                            {{ $user->is_active == 0 ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-edit-user"
                                                            data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                            data-email="{{ $user->email }}"
                                                            data-email-verified="{{ $user->email_verified_at }}"
                                                            data-is-active="{{ $user->is_active }}"
                                                            data-is-superadmin="{{ $user->is_superadmin }}"
                                                            data-action="{{ route('users.updateAdmin', $user->id) }}">
                                                            <i class="feather feather-edit"></i>
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
        <!-- [ Main Content ] end -->
    </div>
@endsection

@section('modal')
    {{-- modal tambah user --}}
    <div class="modal fade-scale" id="AddUser" tabindex="-1" aria-labelledby="AddUser" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Add User</span>
                        <small class="d-block fs-11 fw-normal text-muted">Add your new user</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('user.add') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" placeholder="Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control password" id="newPassword"
                                                        name="password" placeholder="Password Confirm">
                                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1"
                                                        data-bs-toggle="tooltip" title="Show/Hide Password"><i
                                                            class="feather-eye"></i></div>
                                                </div>
                                                <div class="progress-bar mt-2">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Password Confirmation</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" placeholder="Password again"
                                                        required>
                                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1"
                                                        data-bs-toggle="tooltip" title="Show/Hide Password">
                                                        <i class="feather-eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Admin Type</label>
                                                <select class="form-control" name="status"
                                                    data-select2-selector="status">
                                                    <option value="0" data-bg="bg-success">Admin</option>
                                                    <option value="1" data-bg="bg-warning">Super Admin</option>
                                                </select>
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
                                        title="Send Message">Cancel</span>
                                </a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade-scale" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Edit Lead</span>
                        <small class="d-block fs-11 fw-normal text-muted">Update your user information</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>

                <!-- Body -->
                <div class="modal-body p-0">
                    <form id="editUserForm" action="" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" id="edit_name"
                                                        name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="text" class="form-control" id="edit_email"
                                                        name="email" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" data-select2-selector="status"
                                                    id="edit_is_active" name="is_active">
                                                    <option value="1" data-bg="bg-success">Active</option>
                                                    <option value="0" data-bg="bg-danger">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Admin Type</label>
                                                <select class="form-control" data-select2-selector="status"
                                                    id="edit_is_superadmin" name="is_superadmin">
                                                    <option value="0" data-bg="bg-success">Admin</option>
                                                    <option value="1" data-bg="bg-warning">Super Admin</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email Verification</label>
                                                <div class="input-group">
                                                    <p id="edit_email_verified">-</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">

                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Reset Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control password" name="password">
                                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1"
                                                        data-bs-toggle="tooltip" title="Show/Hide Password">
                                                        <i class="feather-eye"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Password Confirmation</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation">
                                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass1"
                                                        data-bs-toggle="tooltip" title="Show/Hide Password">
                                                        <i class="feather-eye"></i>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/lslstrength.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.bs5.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/leads-init.min.js"></script>
    <script src="https://kit.fontawesome.com/d61a3422c6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('change', '.status-select', function() {

            let select = $(this)
            let userId = select.data('user-id')
            let authId = select.data('auth-id')
            let oldValue = select.data('current')
            let newValue = select.val()

            // 🔒 CEGAH user menonaktifkan dirinya sendiri
            if (userId == authId && newValue == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'You cannot disable an account that is currently logged in.',
                    confirmButtonText: 'OK'
                })
                select.val(oldValue)
                return
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'The user status will be changed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (!result.isConfirmed) {
                    select.val(oldValue)
                    return
                }

                $.ajax({
                    url: "{{ route('users.update-status') }}",
                    type: "POST",
                    dataType: "json", // 🔥 WAJIB
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId,
                        is_active: newValue
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            confirmButtonText: 'OK'
                        })

                        select.data('current', newValue)
                    },
                    error: function(xhr) {
                        let errorMessage =
                            xhr.responseJSON?.message ??
                            'Gagal mengubah status'

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        })

                        select.val(oldValue)
                    }
                })

            })
        })
    </script>
    <script>
        function formatDateTime(dateString) {
            if (!dateString) return 'Not Verified';

            const date = new Date(dateString);

            return date.toLocaleString('en-GB', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        }

        $(document).on('click', '.btn-edit-user', function() {

            const btn = $(this)

            $('#edit_name').val(btn.data('name'))
            $('#edit_email').val(btn.data('email'))

            const verifiedAt = btn.data('email-verified');
            $('#edit_email_verified').text(
                formatDateTime(verifiedAt)
            );

            $('#edit_is_active')
                .val(btn.data('is-active'))
                .trigger('change')

            $('#edit_is_superadmin')
                .val(btn.data('is-superadmin'))
                .trigger('change')

            $('#editUserForm').attr('action', btn.data('action'))

            // reset password
            $('#editUserForm').find('input[type="password"]').val('')
        })
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.show-pass1');
            if (!toggle) return;

            const input = toggle.closest('.input-group').querySelector('input');
            const icon = toggle.querySelector('i');

            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';

                // ganti icon → eye-off
                icon.classList.remove('feather-eye');
                icon.classList.add('feather-eye-off');
            } else {
                input.type = 'password';

                // ganti icon → eye
                icon.classList.remove('feather-eye-off');
                icon.classList.add('feather-eye');
            }
        });
    </script>
    <script>
        "use strict";

        $(document).ready(function() {

            /* ===============================
               UTIL
            =============================== */
            function getSelectedUsers() {
                return $('.checkbox-user:checked').map(function() {
                    return $(this).val();
                }).get();
            }

            function toggleBulkButton() {
                const selected = getSelectedUsers().length;
                $('#bulkActionWrapper').toggleClass('d-none', selected === 0);
            }

            function csrf() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            function confirmAction(title, text, confirmText, callback) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: confirmText,
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) callback();
                });
            }

            function ajaxAction(url, data) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrf()
                    },
                    success: function(res) {
                        Swal.fire('Success', res.message, 'success')
                            .then(() => location.reload());
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error',
                            xhr.responseJSON?.message || 'Something went wrong',
                            'error'
                        );
                    }
                });
            }

            /* ===============================
               CHECKBOX HANDLING
            =============================== */

            // Check all
            $('#checkAllLead').on('change', function() {
                $('.checkbox-user').prop('checked', this.checked);
                toggleBulkButton();
            });

            // Single checkbox
            $(document).on('change', '.checkbox-user', function() {
                $('#checkAllLead').prop(
                    'checked',
                    $('.checkbox-user').length === $('.checkbox-user:checked').length
                );
                toggleBulkButton();
            });

            /* ===============================
               BULK ACTIVATE
            =============================== */
            $('#btnBulkActivate').on('click', function() {
                const ids = getSelectedUsers();
                if (!ids.length) return;

                confirmAction(
                    'Activate users?',
                    `Activate ${ids.length} selected users.`,
                    'Yes, activate',
                    function() {
                        ajaxAction("{{ route('user.bulk-status') }}", {
                            user_ids: ids,
                            is_active: 1
                        });
                    }
                );
            });

            /* ===============================
               BULK DEACTIVATE
            =============================== */
            $('#btnBulkDeactivate').on('click', function() {
                const ids = getSelectedUsers();
                if (!ids.length) return;

                confirmAction(
                    'Deactivate users?',
                    `Deactivate ${ids.length} selected users.`,
                    'Yes, deactivate',
                    function() {
                        ajaxAction("{{ route('user.bulk-status') }}", {
                            user_ids: ids,
                            is_active: 0
                        });
                    }
                );
            });

        });
    </script>
@endpush
