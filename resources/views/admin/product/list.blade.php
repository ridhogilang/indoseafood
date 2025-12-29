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
                    <h5 class="m-b-10">Products</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Products List</li>
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
                            data-bs-target="#AddProductModal">
                            <i class="feather-plus me-2"></i>
                            <span>Add New Product</span>
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
                                            <th>Fish</th>
                                            <th>Latin Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $ProductsItem)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input checkbox"
                                                            id="checkBox_{{ $ProductsItem->id }}">
                                                        <label class="custom-control-label"
                                                            for="checkBox_{{ $ProductsItem->id }}"></label>
                                                    </div>
                                                </td>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $ProductsItem->name ?? '-' }}
                                                </td>
                                                <td>{{ $ProductsItem->latin_name ?? '-' }}</td>
                                                <td>
                                                    <select class="form-control status-select"
                                                        data-select2-selector="status" data-id="{{ $ProductsItem->id }}"
                                                        data-current="{{ $ProductsItem->product_category_id }}">

                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" data-bg="bg-success"
                                                                {{ $ProductsItem->product_category_id == $category->id ? 'selected' : '' }}>
                                                                {{ ucfirst($category->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input toggle-active" type="checkbox"
                                                            data-id="{{ $ProductsItem->id }}"
                                                            {{ $ProductsItem->is_active == 1 ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="hstack gap-2 justify-content-center">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-view-inquiry"
                                                            data-bs-toggle="modal" data-bs-target="#EditProductModal"
                                                            data-id="{{ $ProductsItem->id }}"
                                                            data-name="{{ $ProductsItem->name }}"
                                                            data-latin_name="{{ $ProductsItem->latin_name }}"
                                                            data-description="{{ $ProductsItem->description }}"
                                                            data-category-id="{{ $ProductsItem->product_category_id }}"
                                                            data-image="{{ asset('storage/' . $ProductsItem->image) }}">
                                                            <i class="feather-edit-3"></i>
                                                        </a>
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md text-danger btn-delete-product"
                                                            data-id="{{ $ProductsItem->id }}">
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
    <div class="modal fade-scale" id="AddProductModal" tabindex="-1" aria-labelledby="AddProductModal" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Product</span>
                        <small class="d-block fs-11 fw-normal text-muted">New Product Form</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Product Photo<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                                        <div
                                                            class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                            <img src="{{ asset('admin/images/avatar/1.png') }}"
                                                                class="upload-pic img-fluid rounded h-100 w-100"
                                                                alt="">
                                                            <div
                                                                class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                                <i class="feather feather-camera" aria-hidden="true"></i>
                                                            </div>
                                                            <input class="file-upload" type="file" name="image"
                                                                accept="image/*">
                                                        </div>
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fs-11 text-gray-500 mt-2"># Upload your product
                                                                photo
                                                                here
                                                            </div>
                                                            <div class="fs-11 text-gray-500"># photo size 232x150</div>
                                                            <div class="fs-11 text-gray-500"># Max upload size 2mb</div>
                                                            <div class="fs-11 text-gray-500"># Allowed file types: png,
                                                                jpg,
                                                                jpeg</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Product Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ old('name') }}"
                                                        placeholder="Product Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Latin Name</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-fish"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="latin_name"
                                                        name="latin_name" value="{{ old('latin_name') }}"
                                                        placeholder="Latin name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Description</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <textarea class="form-control" id="description" name="description" cols="30" rows="5"
                                                        placeholder="Description Product"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Category</label>
                                                </div>
                                                <select class="form-control" name="product_category_id"
                                                    data-select2-selector="status">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" data-bg="bg-success">
                                                            {{ ucfirst($category->name) }}
                                                        </option>
                                                    @endforeach
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
    <div class="modal fade-scale" id="EditProductModal" tabindex="-1" aria-labelledby="EditProductModal"
        aria-hidden="true" data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Product</span>
                        <small class="d-block fs-11 fw-normal text-muted">New Product Form</small>
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
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Product Photo<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                                        <div
                                                            class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                            <img src="{{ asset('admin/images/avatar/1.png') }}"
                                                                class="upload-pic img-fluid rounded h-100 w-100"
                                                                alt="">
                                                            <div
                                                                class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                                <i class="feather feather-camera" aria-hidden="true"></i>
                                                            </div>
                                                            <input class="file-upload" type="file" name="image"
                                                                accept="image/*">
                                                        </div>
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fs-11 text-gray-500 mt-2"># Upload your product
                                                                photo
                                                                here
                                                            </div>
                                                            <div class="fs-11 text-gray-500"># photo size 232x150</div>
                                                            <div class="fs-11 text-gray-500"># Max upload size 2mb</div>
                                                            <div class="fs-11 text-gray-500"># Allowed file types: png,
                                                                jpg,
                                                                jpeg</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Product Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ old('name') }}"
                                                        placeholder="Product Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Latin Name</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-fish"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="latin_name"
                                                        name="latin_name" value="{{ old('latin_name') }}"
                                                        placeholder="Latin name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Description</label>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <textarea class="form-control" id="description" name="description" cols="30" rows="5"
                                                        placeholder="Description Product"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Category</label>
                                                </div>
                                                <select class="form-control" name="product_category_id"
                                                    data-select2-selector="status">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" data-bg="bg-success">
                                                            {{ ucfirst($category->name) }}
                                                        </option>
                                                    @endforeach
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
        document.addEventListener('change', function(e) {
            if (!e.target.classList.contains('toggle-active')) return;

            const checkbox = e.target;
            const productId = checkbox.dataset.id;
            const isChecked = checkbox.checked;

            // Kembalikan dulu ke posisi awal (biar nunggu konfirmasi)
            checkbox.checked = !isChecked;

            let title = isChecked ?
                'Aktifkan Produk?' :
                'Nonaktifkan Produk?';

            let text = isChecked ?
                'Produk akan ditampilkan kembali.' :
                'Produk akan disembunyikan dari sistem.';

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/products/${productId}/toggle-active`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                is_active: isChecked ? 1 : 0
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                checkbox.checked = isChecked;

                                Swal.fire(
                                    'Berhasil',
                                    res.message,
                                    'success'
                                );
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan', 'error');
                            }
                        });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('change', function(e) {
            if (!e.target.classList.contains('status-select')) return;

            const select = e.target;
            const productId = select.dataset.id;
            const newCategoryId = select.value;
            const oldCategoryId = select.dataset.current;

            // rollback dulu
            select.value = oldCategoryId;

            Swal.fire({
                title: 'Ganti kategori?',
                text: 'Apakah Anda yakin ingin mengganti kategori produk ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, ganti',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/products/${productId}/change-category`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                product_category_id: newCategoryId
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                select.value = newCategoryId;
                                select.dataset.current = newCategoryId;

                                Swal.fire('Berhasil', res.message, 'success');
                            } else {
                                Swal.fire('Gagal', 'Gagal mengubah kategori', 'error');
                            }
                        });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-delete-product');
            if (!btn) return;

            const productId = btn.dataset.id;

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Delete Product?',
                text: 'This product will be permanently deleted and cannot be recovered!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/products/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(res => {
                            if (res.success) {
                                swalWithBootstrapButtons.fire(
                                    'Terhapus!',
                                    res.message,
                                    'success'
                                );

                                // hapus row table
                                btn.closest('tr')?.remove();
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Gagal',
                                    'Produk gagal dihapus',
                                    'error'
                                );
                            }
                        });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view-inquiry');
            if (!btn) return;

            const modal = document.querySelector('#EditProductModal');
            const form = modal.querySelector('form');

            // set action update
            form.action = `/admin/products/${btn.dataset.id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            // isi text input
            form.querySelector('input[name="name"]').value = btn.dataset.name ?? '';
            form.querySelector('input[name="latin_name"]').value = btn.dataset.latin_name ?? '';
            form.querySelector('textarea[name="description"]').value = btn.dataset.description ?? '';

            // set category
            const categorySelect = form.querySelector('[name="product_category_id"]');
            categorySelect.value = btn.dataset.categoryId;
            categorySelect.dispatchEvent(new Event('change'));

            // set image preview (jika ada)
            if (btn.dataset.image) {
                form.querySelector('.upload-pic').src = btn.dataset.image;
            }
        });
    </script>
@endpush
