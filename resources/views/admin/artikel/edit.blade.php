@extends('layout.admin')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/tagify.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/tagify-data.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/quill.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2-theme.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 1000px;
            /* setara ± rows 15 */
        }
    </style>
@endpush

@section('main')
    <div class="nxl-content">
        <form id="article-form" method="POST" action="{{ route('article.update', $article->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Article</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('article.list') }}">Article List</a></li>
                        <li class="breadcrumb-item">Edit Article</li>
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
                            <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                                <button type="submit" name="action" value="draft" class="btn btn-light-brand">
                                    <i class="feather-archive me-2"></i>
                                    Save a Draft
                                </button>
                            </div>
                            <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                                <button type="submit" name="action" value="publish" class="btn btn-primary">
                                    <i class="feather-send me-2"></i>
                                    Publish Article
                                </button>
                            </div>
                            <button type="submit" name="action" value="draft" id="hiddenDraftSubmit" hidden></button>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="proposalTab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Thumbnail<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                                        <div
                                                            class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">

                                                            <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('admin/images/avatar/1.png') }}"
                                                                class="upload-pic img-fluid rounded h-100 w-100"
                                                                alt="Thumbnail">

                                                            <div
                                                                class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                                <i class="feather feather-camera" aria-hidden="true"></i>
                                                            </div>

                                                            <input class="file-upload" type="file" name="thumbnail"
                                                                accept="image/*">
                                                        </div>
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fs-11 text-gray-500 mt-2"># Upload your thumbnail
                                                                arcticle
                                                                here
                                                            </div>
                                                            <div class="fs-11 text-gray-500"># thumbnail size 387x240</div>
                                                            <div class="fs-11 text-gray-500"># Max upload size 2mb</div>
                                                            <div class="fs-11 text-gray-500"># Allowed file types: png, jpg,
                                                                jpeg</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <input type="hidden" name="auto_draft" id="auto_draft" value="0">
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Title<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="title"
                                                        name="title" value="{{ old('title', $article->title) }}"
                                                        placeholder="Title Article" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Slug</label>
                                                    <div class="avatar-text avatar-sm" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        title="The URL-friendly version of the page title used in the page link. Usually generated automatically but can be edited.">
                                                        <i class="feather feather-info"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="slug"
                                                        name="slug" value="{{ old('slug', $article->slug) }}"
                                                        placeholder="Slug can be entered manually or generated automatically by the system."
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Meta Title</label>
                                                    <div class="avatar-text avatar-sm" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        title="The page title shown in search results and browser tabs. Can be customized or auto-generated.">
                                                        <i class="feather feather-info"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        name="meta_title"
                                                        value="{{ old('meta_title', $article->meta_title) }}"
                                                        placeholder="Meta title can be entered manually or generated automatically by the system."
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Meta Description</label>
                                                    <div class="avatar-text avatar-sm" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        title="A short summary of the page content used by search engines">
                                                        <i class="feather feather-info"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="meta_description"
                                                        name="meta_description"
                                                        value="{{ old('meta_description', $article->meta_description) }}"
                                                        placeholder="Meta description can be entered manually or generated automatically by the system."
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex align-items-center mb-2 gap-2">
                                                    <label class="form-label mb-0">Meta Keywords</label>
                                                    <div class="avatar-text avatar-sm" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover"
                                                        title="Keywords related to the page content to help search engines understand the topic.">
                                                        <i class="feather feather-info"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="meta_keywords"
                                                        name="meta_keywords"
                                                        value="{{ old('meta_keywords', $article->meta_keywords) }}"
                                                        placeholder="Meta keywords can be entered manually or generated automatically by the system."
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="form-label mb-0">Category</label>
                                                    <a href="javascript:void(0)" style="font-size: 10px;"
                                                        data-bs-toggle="modal" id="addCategoryBtn"
                                                        data-bs-target="#AddCategory">Add New
                                                        Category</a>
                                                </div>
                                                <select class="form-control" name="article_category_id"
                                                    data-select2-selector="status">
                                                    @foreach ($category as $categoryItem)
                                                        <option value="{{ $categoryItem->id }}" data-bg="bg-success"
                                                            {{ old('article_category_id', $article->article_category_id) == $categoryItem->id ? 'selected' : '' }}>
                                                            {{ $categoryItem->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 mb-4 align-items-center">
                                                <label class="form-label"></label>
                                                <a href="javascript:void(0)" class="btn btn-light-brand"
                                                    id="generateSeoBtn">
                                                    <i class="fa-solid fa-bolt me-2"></i> Generate SEO </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title">Body Article</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <textarea id="body-editor" class="form-control" rows="15">
                                        {{ old('body', $article->body) }} </textarea>

                                        <input type="hidden" name="body" id="body-html-hidden"
                                            value="{{ old('body', $article->body) }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </form>
    </div>
@endsection

@section('modal')
    <div class="modal fade-scale" id="AddCategory" data-mode="add" tabindex="-1" aria-labelledby="AddCategory"
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
                                                <textarea rows="6" class="form-control" id="category-description" placeholder="Category Description"></textarea>
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
    <script src="{{ asset('') }}admin/vendors/js/tagify.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/tagify-data.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/quill.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/proposal-view-init.min.js"></script>
    <script src="{{ asset('') }}admin/js/customers-create-init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        const ARTICLE_ID = '{{ $article->id }}'; // artikel sudah ada ID
        const uploadFolder = 'articles/' + ARTICLE_ID; // folder gambar langsung ke artikel ID

        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);
                        data.append('folder', uploadFolder);

                        fetch('/admin/article/' + ARTICLE_ID + '/upload-image', {
                                method: 'POST',
                                body: data,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(res => res.json())
                            .then(res => {
                                if (res.url) {
                                    resolve({
                                        default: res.url
                                    });
                                } else {
                                    reject(res.message || 'Upload failed');
                                }
                            })
                            .catch(() => reject('Upload failed'));
                    }));
            }

            abort() {}
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor.create(document.querySelector('#body-editor'), {
                licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3OTc0NjU1OTksImp0aSI6IjRlMWUwOGEyLWQ3YzAtNGM5MS1hYWNmLTRjZmRmZWI3NzFhNyIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJyZW1vdmVGZWF0dXJlcyI6WyJQQiIsIlJGIiwiU0NIIiwiVENQIiwiVEwiLCJUQ1IiLCJJUiIsIlNVQSIsIkI2NEEiLCJMUCIsIkhFIiwiUkVEIiwiUEZPIiwiV0MiLCJGQVIiLCJCS00iLCJGUEgiLCJNUkUiXSwidmMiOiJiYWFhN2FkNyJ9.8vzjZPaokEDTVlxxC985CZKjaZiDDM3dNiB_jY6mYFutpyWNUIWcHXdnJDPRTWAprGTxN7-iygSGu5uqR0kt8w',
                toolbar: {
                    items: [
                        'heading', '|', 'bold', 'italic', 'underline', 'strikethrough',
                        'link', '|', 'bulletedList', 'numberedList', 'outdent', 'indent', '|',
                        'alignment', 'blockQuote', 'codeBlock', 'horizontalLine',
                        'insertTable', 'imageUpload', 'mediaEmbed', '|', 'undo', 'redo'
                    ],
                    shouldNotGroupWhenFull: true
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:alignLeft',
                        'imageStyle:alignCenter',
                        'imageStyle:alignRight',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                },
                placeholder: 'Write your article content here...',
                extraPlugins: [MyCustomUploadAdapterPlugin]
            })
            .then(editor => {
                // Update hidden input setiap kali konten berubah
                editor.model.document.on('change:data', () => {
                    document.getElementById('body-html-hidden').value = editor.getData();
                });
            })
            .catch(error => console.error(error));
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const metaTitleInput = document.getElementById('meta_title');

            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }

            // Mark slug as manual if user edits it
            slugInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });

            // Mark meta title as manual if user edits it
            metaTitleInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });

            titleInput.addEventListener('input', function() {
                const titleValue = this.value.trim();

                // Auto-generate slug if NOT manually edited
                if (!slugInput.dataset.manual) {
                    slugInput.value = generateSlug(titleValue);
                }

                // Auto-generate meta title if NOT manually edited
                if (!metaTitleInput.dataset.manual) {
                    metaTitleInput.value = titleValue;
                }
            });
        });
    </script>
    <script>
        function cleanText(text) {
            return text
                .replace(/<[^>]*>/g, ' ') // hapus HTML
                .replace(/\s+/g, ' ')
                .trim();
        }

        function extractKeywords(text, limit = 8) {
            const stopWords = [
                'dan', 'yang', 'untuk', 'dari', 'dengan', 'adalah', 'ini', 'itu',
                'pada', 'sebagai', 'juga', 'akan', 'dalam', 'oleh', 'karena'
            ];

            const words = text.toLowerCase()
                .replace(/[^a-zA-Z0-9\s]/g, '')
                .split(' ')
                .filter(w => w.length > 3 && !stopWords.includes(w));

            const freq = {};
            words.forEach(w => freq[w] = (freq[w] || 0) + 1);

            return Object.entries(freq)
                .sort((a, b) => b[1] - a[1])
                .slice(0, limit)
                .map(item => item[0]);
        }

        document.getElementById('generateSeoBtn').addEventListener('click', function(e) {
            e.preventDefault();

            const title = document.getElementById('title').value.trim();
            const bodyRaw = document.getElementById('body-html-hidden').value;

            if (!title || !bodyRaw) {
                alert('Judul dan artikel wajib diisi');
                return;
            }

            const body = cleanText(bodyRaw);

            // META TITLE
            let metaTitle = `${title} | IndoSeafood`;
            if (metaTitle.length > 60) {
                metaTitle = metaTitle.substring(0, 57) + '...';
            }

            // META DESCRIPTION (ambil kalimat pertama yang layak)
            let metaDescription = body.split('. ')
                .find(s => s.length > 80) || body;

            metaDescription = metaDescription.substring(0, 155);
            if (!metaDescription.endsWith('.')) metaDescription += '...';

            // META KEYWORDS (DINAMIS)
            const keywords = extractKeywords(title + ' ' + body);
            keywords.push('seafood indonesia', 'indoseafood');

            document.getElementById('meta_title').value = metaTitle;
            document.getElementById('meta_description').value = metaDescription;
            document.getElementById('meta_keywords').value = [...new Set(keywords)].join(', ');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('article-form');
            const addCategoryBtn = document.querySelector('[data-bs-target="#AddCategory"]');

            if (!form || !addCategoryBtn) return;

            addCategoryBtn.addEventListener('click', async function(e) {
                if (!isFormDirty) return;

                // 🔥 JIKA BERUBAH → STOP BOOTSTRAP
                e.preventDefault();

                // 🔥 JIKA ADA PERUBAHAN → MINTA KONFIRMASI
                const result = await Swal.fire({
                    title: 'Save as draft?',
                    text: 'To add a new category, this article must be saved as a draft first.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, save draft',
                });

                if (!result.isConfirmed) return;

                // 🔥 FLAG WAJIB
                isAutoDraft = true;
                isFormDirty = false;
                isSubmitting = true;

                // Tutup modal jika kebuka (safety)
                const modalEl = document.getElementById('AddCategory');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();

                const formData = new FormData(form);
                formData.append('auto_draft', 1);
                formData.append('_method', 'PUT');

                try {
                    const response = await fetch(
                        "{{ route('article.update', $article->id) }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: formData
                        }
                    );

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Invalid server response');
                    }

                    const data = await response.json();

                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    }

                } catch (err) {
                    Swal.fire('Error', err.message, 'error');
                }
            });

        });
    </script>
    <script>
        let isFormDirty = false;
        let isSubmitting = false;
        let isAutoDraft = false;
        // deteksi perubahan form
        document.querySelectorAll('input, textarea, select').forEach(el => {
            el.addEventListener('change', () => {
                if (!isAutoDraft) isFormDirty = true;
            });
            el.addEventListener('keyup', () => {
                if (!isAutoDraft) isFormDirty = true;
            });
        });

        // MATIKAN dirty saat submit manual
        document.querySelectorAll('button[type="submit"]').forEach(btn => {
            btn.addEventListener('mousedown', () => {
                isSubmitting = true;
                isFormDirty = false;
            });
        });

        // submit fallback
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => {
                isSubmitting = true;
                isFormDirty = false;
            });
        });

        // cegah close / reload
        window.addEventListener('beforeunload', function(e) {
            if (isAutoDraft) return; // 🔥 PENGECUALIAN
            if (!isFormDirty || isSubmitting) return;

            e.preventDefault();
            e.returnValue = '';
        });
    </script>
    <script>
        document.querySelectorAll('a.protect-leave').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!isFormDirty) return;

                e.preventDefault();
                const url = this.href;

                Swal.fire({
                    title: 'Are you sure you want to leave?',
                    text: 'Your changes will not be saved.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, leave page',
                    cancelButtonText: 'Stay on this page'
                }).then((result) => {
                    if (result.isConfirmed) {
                        isFormDirty = false;
                        window.location.href = url;
                    }
                });
            });
        });
    </script>
    <script>
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            if (form.dataset.confirmed === 'true') return;

            e.preventDefault();

            const actionBtn = document.activeElement;
            const action = actionBtn?.value;

            if (!action) {
                form.submit();
                return;
            }

            Swal.fire({
                title: action === 'publish' ? 'Publish article?' : 'Save as draft?',
                text: action === 'publish' ?
                    'This article will be visible to the public.' :
                    'Your changes will be saved as a draft.',
                icon: action === 'publish' ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    isFormDirty = false;
                    form.dataset.confirmed = 'true';
                    form.submit();
                }
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
