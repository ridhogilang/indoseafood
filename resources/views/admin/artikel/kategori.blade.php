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
                    <h5 class="m-b-10">Article</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Article List</li>
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
                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" id="addCategoryBtn"
                            data-bs-target="#AddCategory">
                            <i class="feather-plus me-2"></i>
                            Add New Category
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
                                            <th>Category Name</th>
                                            <th>Article Count</th>
                                            <th>Created At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $categoryItem)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="leadCheck{{ $categoryItem->id }}">
                                                        <label class="custom-control-label"
                                                            for="leadCheck{{ $categoryItem->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $categoryItem->name }}</td>
                                                <td>{{ $categoryItem->articles_count ?? '0' }} Articles</td>
                                                <td>{{ $categoryItem->created_at->format('d M Y') }}</td>
                                                <td class="text-center">
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-edit-category"
                                                            data-bs-toggle="modal" data-bs-target="#EditCategory"
                                                            data-id="{{ $categoryItem->id }}"
                                                            data-name="{{ $categoryItem->name }}"
                                                            data-slug="{{ $categoryItem->slug }}"
                                                            data-description="{{ $categoryItem->description }}">
                                                            <i class="feather-edit-3"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md text-danger btn-delete-category"
                                                            data-id="{{ $categoryItem->id }}">
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
    <div class="modal fade-scale" id="EditCategory" tabindex="-1" data-mode="edit" aria-labelledby="EditCategory"
        aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Category</span>
                        <small class="d-block fs-11 fw-normal text-muted">Edit Category Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form id="edit-category-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Category Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control category-name"
                                                        id="category-name" name="name" placeholder="Category Name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Slug</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control category-slug"
                                                        id="category-slug" name="slug" placeholder="Category Slug"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Description</label>
                                                <textarea rows="6" class="form-control" name="description" id="category-description" placeholder="Category Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="">
                                    <span class="btn btn-light-danger" data-bs-trigger="hover"
                                        title="Send Message">Close</span>
                                </a>
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
    <div class="modal fade-scale" id="AddCategory" tabindex="-1" data-mode="add" aria-labelledby="AddCategory"
        aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Category</span>
                        <small class="d-block fs-11 fw-normal text-muted">Add Category Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('article-category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Category Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control category-name"
                                                        id="category-name" name="name" placeholder="Category Name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Slug</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control category-slug"
                                                        id="category-slug" name="slug" placeholder="Category Slug"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Description</label>
                                                <textarea rows="6" class="form-control" name="description" id="category-description" placeholder="Category Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="">
                                    <span class="btn btn-light-danger" data-bs-trigger="hover"
                                        title="Send Message">Close</span>
                                </a>
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
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-delete-category');
            if (!btn) return;

            e.preventDefault();

            const categoryId = btn.dataset.id;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Delete category?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
            }).then(async (result) => {
                if (!result.isConfirmed) return;

                try {
                    const response = await fetch(`/admin/article-category/${categoryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        swalWithBootstrapButtons.fire(
                            'Failed',
                            data.message,
                            'error'
                        );
                        return;
                    }

                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        data.message,
                        'success'
                    ).then(() => location.reload());

                } catch (err) {
                    swalWithBootstrapButtons.fire(
                        'Error',
                        'Something went wrong.',
                        'error'
                    );
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-edit-category').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const slug = this.dataset.slug;
                    const description = this.dataset.description ?? '';

                    // set value ke form
                    document.getElementById('category-name').value = name;
                    document.getElementById('category-slug').value = slug;
                    document.getElementById('category-description').value = description;

                    // set action form
                    const form = document.getElementById('edit-category-form');
                    form.action = `/admin/article-category/${id}`;

                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.modal').forEach(modal => {

                modal.addEventListener('shown.bs.modal', function() {

                    const nameInput = modal.querySelector('.category-name');
                    const slugInput = modal.querySelector('.category-slug');

                    if (!nameInput || !slugInput) return;

                    let slugTouched = false;

                    // reset state tiap buka modal
                    slugTouched = false;

                    slugInput.addEventListener('input', () => {
                        slugTouched = true;
                    });

                    nameInput.addEventListener('input', () => {
                        if (slugTouched) return;
                        slugInput.value = generateSlug(nameInput.value);
                    });

                });

            });

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }

        });
    </script>
@endpush
