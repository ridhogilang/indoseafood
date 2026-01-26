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
                        <div class="dropdown filter-dropdown">
                            <form method="GET" action="{{ route('article.list') }}" id="filterForm">

                                <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                    data-bs-auto-close="outside">
                                    <i class="feather-filter me-2"></i>
                                    <span>Filter</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">

                                    <!-- POTENTIAL LEADS -->
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="DraftArticles"
                                                name="draft_articles" value="1"
                                                {{ request()->has('draft_articles') || request()->query() == [] ? 'checked' : '' }} />
                                            <label class="custom-control-label c-pointer" for="DraftArticles">
                                                Draft Articles
                                            </label>
                                        </div>
                                    </div>

                                    <!-- NON POTENTIAL LEADS -->
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="PublishedArticles"
                                                name="published_articles" value="1"
                                                {{ request()->has('published_articles') || request()->query() == [] ? 'checked' : '' }} />
                                            <label class="custom-control-label c-pointer" for="PublishedArticles">
                                                Published Articles
                                            </label>
                                        </div>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="ArchivedArticles"
                                                name="archived_articles" value="1"
                                                {{ request()->has('archived_articles') || request()->query() == [] ? 'checked' : '' }} />
                                            <label class="custom-control-label c-pointer" for="ArchivedArticles">
                                                Archived Articles
                                            </label>
                                        </div>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <!-- CATEGORY FILTER -->
                                    <div class="dropdown-item">
                                        <select class="custom-control" data-select2-selector="status" id="filterCategory"
                                            name="category">
                                            <option value="" data-bg="bg-success"
                                                {{ request()->filled('category') ? '' : 'selected' }}>
                                                All Categories
                                            </option>
                                            @foreach ($categories as $ItemCategories)
                                                <option value="{{ $ItemCategories->id }}" data-bg="bg-warning"
                                                    {{ request('category') == $ItemCategories->id ? 'selected' : '' }}>
                                                    {{ $ItemCategories->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <a href="{{ route('article.new') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            Add New Article
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
                                            <th>Title</th>
                                            <th>Writer</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $articlesItem)
                                            <tr>
                                                <td>
                                                    <div class="btn-group mb-1">
                                                        <div class="custom-control custom-checkbox ms-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="checkAllLead">
                                                            <label class="custom-control-label"
                                                                for="checkAllLead"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $articlesItem->title }}</td>
                                                <td>{{ $articlesItem->author->name }}</td>
                                                <td>{{ $articlesItem->category->name ?? '-' }}</td>
                                                <td>
                                                    @if ($articlesItem->status === 'published')
                                                        <div class="badge bg-soft-success text-success">Published</div>
                                                    @elseif ($articlesItem->status === 'draft')
                                                        <div class="badge bg-soft-warning text-warning">Draft</div>
                                                    @else
                                                        <div class="badge bg-soft-secondary text-muted">
                                                            {{ ucfirst($articlesItem->status) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{ $articlesItem->created_at->translatedFormat('d M Y') }}</td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route('article.edit', ['slug' => $articlesItem->slug]) }}"
                                                            class="avatar-text avatar-md btn-view-inquiry"><i
                                                                class="feather-edit-3"></i></a>
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md text-danger btn-delete-article"
                                                            data-id="{{ $articlesItem->id }}">
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

            document.querySelectorAll('.btn-delete-article').forEach(btn => {
                btn.addEventListener('click', function() {

                    const articleId = this.dataset.id;

                    swalWithBootstrapButtons.fire({
                        title: 'Delete article?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel'
                    }).then(async (result) => {

                        if (!result.isConfirmed) return;

                        const response = await fetch(`/admin/article/${articleId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                data.message,
                                'success'
                            );

                            setTimeout(() => {
                                window.location.reload();
                            }, 800);
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Error',
                                'Failed to delete article',
                                'error'
                            );
                        }
                    });

                });
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('filterForm');

            // checkbox (native)
            document.querySelectorAll('#filterForm input[type="checkbox"]').forEach(el => {
                el.addEventListener('change', function() {
                    form.submit();
                });
            });

            // select2 (WAJIB pakai jQuery event)
            if (window.jQuery) {
                $('#filterCategory').on('change.select2', function() {
                    form.submit();
                });
            }
        });
    </script>
@endpush
