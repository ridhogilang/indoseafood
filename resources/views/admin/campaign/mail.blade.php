@extends('layout.admin')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/tagify.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/tagify-data.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/quill.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2-theme.min.css">
@endpush

@section('main')
    <div class="nxl-content">
        <form id="campaign-form" action="{{ route('update_mail.campaign') }}" method="POST">
            @csrf
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Campaign Mail</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Campaign Mail</li>
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
                            <a href="javascript:void(0);" class="btn btn-light-brand" data-bs-toggle="offcanvas"
                                data-bs-target="#proposalSent">
                                <i class="feather-layers me-2"></i>
                                <span>Save & Send</span>
                            </a>
                            <button type="submit" class="btn btn-primary"> <i class="feather-send me-2"></i> Update Email
                            </button>
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
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="title" name="title"
                                                        placeholder="Title Campaign"
                                                        value="{{ old('title', $campaign->title) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Subject</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-solid fa-quote-left"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="subject" name="subject"
                                                        placeholder="Subject Campaign"
                                                        value="{{ old('subject', $campaign->subject) }}" required>
                                                </div>
                                            </div>
                                            {{-- <div>{!! $campaign->body_html !!}</div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <h5 class="card-title">Body Email</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div id="editor-proposal" class="ht-300 font-inter botder-top-0"></div>
                                        <input type="hidden" name="body_html" id="body-input">
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

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/tagify.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/tagify-data.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/quill.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/proposal-view-init.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editorElement = document.querySelector('#editor-proposal');

            const quill = new Quill(editorElement, {
                theme: 'snow',
                placeholder: 'Body Email...',
            });

            // ISI AWAL DARI DATABASE (ID = 1)
            const initialBody = @json(old('body_html', $campaign->body_html));
            if (initialBody) {
                quill.root.innerHTML = initialBody;
            }

            const form = document.getElementById('campaign-form');
            form.addEventListener('submit', function() {
                const hiddenInput = document.getElementById('body-input');
                hiddenInput.value = quill.root.innerHTML;
            });
        });
    </script>
@endpush
