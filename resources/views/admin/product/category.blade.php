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
                    <h5 class="m-b-10">Category Products</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Category Products List</li>
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
                            data-bs-target="#AddCategoryProductModal">
                            <i class="feather-plus me-2"></i>
                            <span>Add New Category</span>
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
                                            <th>Category</th>
                                            <th>Fish Count</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $CategoriesItem)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input checkbox"
                                                            id="checkBox_{{ $CategoriesItem->id }}">
                                                        <label class="custom-control-label"
                                                            for="checkBox_{{ $CategoriesItem->id }}"></label>
                                                    </div>
                                                </td>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $CategoriesItem->name ?? '-' }}
                                                </td>
                                                <td>{{ $CategoriesItem->products_count }}</td>
                                                <td class="text-center align-middle">
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-view-inquiry"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#EditCategoryProductModal"
                                                            data-id="{{ $CategoriesItem->id }}"
                                                            data-name="{{ $CategoriesItem->name }}">
                                                            <i class="feather-edit-3"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md text-danger btn-delete-categoryProduct"
                                                            data-id="{{ $CategoriesItem->id }}">
                                                            <i class="feather-trash"></i>
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
    <div class="modal fade-scale" id="AddCategoryProductModal" tabindex="-1" aria-labelledby="AddCategoryProductModal"
        aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Category Product</span>
                        <small class="d-block fs-11 fw-normal text-muted">New Category Product Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('product-category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-12 mb-4 align-items-center">
                                                <label class="form-label">Category Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ old('name') }}"
                                                        placeholder="Category Name" required>
                                                </div>
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
    <div class="modal fade-scale" id="EditCategoryProductModal" tabindex="-1"
        aria-labelledby="EditCategoryProductModal" aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Category Product</span>
                        <small class="d-block fs-11 fw-normal text-muted">Edit Category Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="product_id">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-12 mb-4 align-items-center">
                                                <label class="form-label">Category Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ old('name') }}"
                                                        placeholder="Category Name" required>
                                                </div>
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
    <script src="{{ asset('') }}admin/js/customers-create-init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('EditCategoryProductModal');

            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');

                // set input value
                editModal.querySelector('input[name="name"]').value = name;

                // set form action
                editModal.querySelector('form').action =
                    `/admin/product-category/${id}/update`;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // SweetAlert custom bootstrap buttons
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            document.querySelectorAll('.btn-delete-categoryProduct').forEach(button => {
                button.addEventListener('click', function() {

                    const categoryId = this.dataset.id;

                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: 'This category will be permanently deleted.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/admin/product-category/${categoryId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document
                                            .querySelector('meta[name="csrf-token"]')
                                            .content,
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        swalWithBootstrapButtons.fire(
                                            'Deleted!',
                                            data.message,
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        swalWithBootstrapButtons.fire(
                                            'Failed!',
                                            data.message,
                                            'error'
                                        );
                                    }
                                })
                                .catch(() => {
                                    swalWithBootstrapButtons.fire(
                                        'Error!',
                                        'Something went wrong. Please try again.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });

        });
    </script>
@endpush
