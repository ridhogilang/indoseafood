@extends('layout.admin')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/daterangepicker.min.css') }}" />
@endpush

@section('main')
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
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
                        <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                            <span id="reportrangeText" class="reportrange-picker-field"></span>
                        </div>
                        <div class="dropdown filter-dropdown">
                            <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span>Filter</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Role"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Role">Role</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Team"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Team">Team</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Email"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Email">Email</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Member"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer" for="Member">Member</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Recommendation"
                                            checked="checked" />
                                        <label class="custom-control-label c-pointer"
                                            for="Recommendation">Recommendation</label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-plus me-3"></i>
                                    <span>Create New</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-filter me-3"></i>
                                    <span>Manage Filter</span>
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
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <!-- [Invoices Awaiting Payment] start -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-mail"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $campaignSent }}</span> /
                                            <span class="counter">{{ $campaignTotal }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">
                                            Campaign Progress
                                        </h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted text-truncate-1-line">
                                        Waiting Campaigns
                                    </span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark">{{ $campaignWaiting }}</span>
                                        <span class="fs-11 text-muted">({{ $campaignPercent }}%)</span>
                                    </div>
                                </div>

                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $campaignPercent }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Converted Leads] start -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-book"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $articlePublished }}</span> /
                                            <span class="counter">{{ $articleTotal }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">
                                            Article Writing Progress
                                        </h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted text-truncate-1-line">
                                        Draft Articles
                                    </span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark">
                                            {{ $articleWaiting }} Waiting
                                        </span>
                                        <span class="fs-11 text-muted">
                                            ({{ $articlePercent }}%)
                                        </span>
                                    </div>
                                </div>

                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $articlePercent }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Projects In Progress] start -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between mb-4">
                                <div class="d-flex gap-4 align-items-center">
                                    <div class="avatar-text avatar-lg bg-gray-200">
                                        <i class="feather-clipboard"></i>
                                    </div>
                                    <div>
                                        <div class="fs-4 fw-bold text-dark">
                                            <span class="counter">{{ $inquiryCompleted }}</span> /
                                            <span class="counter">{{ $inquiryTotal }}</span>
                                        </div>
                                        <h3 class="fs-13 fw-semibold text-truncate-1-line">
                                            Inquiries In Progress
                                        </h3>
                                    </div>
                                </div>
                                <a href="javascript:void(0);">
                                    <i class="feather-more-vertical"></i>
                                </a>
                            </div>

                            <div class="pt-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fs-12 fw-medium text-muted text-truncate-1-line">
                                        Completed Inquiries
                                    </span>
                                    <div class="w-100 text-end">
                                        <span class="fs-12 text-dark">
                                            {{ $inquiryCompleted }} Completed
                                        </span>
                                        <span class="fs-11 text-muted">
                                            ({{ $inquiryPercent }}%)
                                        </span>
                                    </div>
                                </div>

                                <div class="progress mt-2 ht-3">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $inquiryPercent }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [Mini] start -->
                <div class="col-lg-6">
                    <div class="card mb-4 stretch stretch-full">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="avatar-text">
                                    <i class="feather-mail"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">Campaign Completed</div>
                                </div>
                            </div>
                            <div class="fs-12 text-muted text-nowrap">
                                <span class="fw-semibold text-primary">{{ $trendText }}</span><br />
                                <span>from last 30 days</span>
                            </div>
                        </div>
                        <div class="card-body align-items-center justify-content-between gap-4">
                            <div id="task-completed-area-chart-costum"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4 stretch stretch-full">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <div class="avatar-text">
                                    <i class="feather feather-file-text"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">New Inquiries</div>
                                </div>
                            </div>
                            <div class="fs-12 text-muted text-nowrap">
                                <span class="fw-semibold text-success">{{ $inquiriesTrendText }}</span><br />
                                <span>from last 30 days</span>
                            </div>
                        </div>
                        <div class="card-body align-items-center justify-content-between gap-4">
                            <div id="new-tasks-area-chart-costum"></div>
                        </div>
                    </div>
                </div>
                <!-- [Mini] end !-->
                <!-- [Latest Leads] start -->
                <div class="col-xxl-6">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Campaign Failed</h5>
                            <div class="card-header-action">
                                <div class="card-header-btn">
                                    <div data-bs-toggle="tooltip" title="Delete">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                            data-bs-toggle="remove"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                            data-bs-toggle="refresh"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                            data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                                        data-bs-offset="25, 25">
                                        <div data-bs-toggle="tooltip" title="Options">
                                            <i class="feather-more-vertical"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('status.campaign') }}" class="dropdown-item"><i
                                                class="feather-send"></i>See Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            <th scope="row">Company</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($campaignTable->total() > 0)
                                            @foreach ($campaignTable as $campaignTableItem)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <a href="{{ route('status.campaign') }}">
                                                                <span
                                                                    class="d-block">{{ $campaignTableItem->contact->company }}</span>
                                                                <span
                                                                    class="fs-12 d-block fw-normal text-muted">{{ $campaignTableItem->contact->email }}</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>{{ $campaignTableItem->sent_at->format('d/m/Y H:i') ?? '-' }}</td>
                                                    <td>
                                                        <span class="badge bg-soft-danger text-danger">Failed</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="hstack gap-2 justify-content-center">
                                                            <form
                                                                action="{{ route('delete.campaign', $campaignTableItem->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-icon btn-danger">
                                                                    <i class="feather feather-trash-2"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No data available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($campaignTable->total() > 0)
                                <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                                    {{-- Previous Page --}}
                                    <li class="{{ $campaignTable->onFirstPage() ? 'disabled' : '' }}">
                                        <a href="{{ $campaignTable->previousPageUrl() ?? 'javascript:void(0);' }}">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </li>

                                    {{-- Page Numbers --}}
                                    @foreach ($campaignTable->getUrlRange(1, $campaignTable->lastPage()) as $page => $url)
                                        <li>
                                            <a href="{{ $url }}"
                                                class="{{ $campaignTable->currentPage() == $page ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page --}}
                                    <li class="{{ $campaignTable->hasMorePages() ? '' : 'disabled' }}">
                                        <a href="{{ $campaignTable->nextPageUrl() ?? 'javascript:void(0);' }}">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">New Inquiries</h5>
                            <div class="card-header-action">
                                <div class="card-header-btn">
                                    <div data-bs-toggle="tooltip" title="Delete">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-danger"
                                            data-bs-toggle="remove"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Refresh">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-warning"
                                            data-bs-toggle="refresh"> </a>
                                    </div>
                                    <div data-bs-toggle="tooltip" title="Maximize/Minimize">
                                        <a href="javascript:void(0);" class="avatar-text avatar-xs bg-success"
                                            data-bs-toggle="expand"> </a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="dropdown"
                                        data-bs-offset="25, 25">
                                        <div data-bs-toggle="tooltip" title="Options">
                                            <i class="feather-more-vertical"></i>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('inquiry.list') }}" class="dropdown-item"><i
                                                class="feather-send"></i>See Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body custom-card-action p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr class="border-b">
                                            <th scope="row">Company</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($inquiriesTable->total() > 0)
                                            @foreach ($inquiriesTable as $inquiryItem)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <a href="{{ route('inquiry.list') }}">
                                                                <span
                                                                    class="d-block">{{ $inquiryItem->company_name }}</span>
                                                                <span
                                                                    class="fs-12 d-block fw-normal text-muted">{{ $inquiryItem->email }}</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $inquiryItem->fish_name }}
                                                    </td>
                                                    <td>{{ number_format($inquiryItem->qty, 0, ',', '.') }} Kg</td>
                                                    <td>{{ $inquiryItem->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-soft-success text-success">{{ $inquiryItem->status }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-center">No data available.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($inquiriesTable->total() > 0)
                                <ul class="list-unstyled d-flex align-items-center gap-2 mb-0 pagination-common-style">
                                    {{-- Previous --}}
                                    <li class="{{ $inquiriesTable->onFirstPage() ? 'disabled' : '' }}">
                                        <a href="{{ $inquiriesTable->previousPageUrl() ?? 'javascript:void(0);' }}">
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </li>

                                    {{-- Page Numbers --}}
                                    @foreach ($inquiriesTable->getUrlRange(1, $inquiriesTable->lastPage()) as $page => $url)
                                        <li>
                                            <a href="{{ $url }}"
                                                class="{{ $inquiriesTable->currentPage() == $page ? 'active' : '' }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endforeach

                                    {{-- Next --}}
                                    <li class="{{ $inquiriesTable->hasMorePages() ? '' : 'disabled' }}">
                                        <a href="{{ $inquiriesTable->nextPageUrl() ?? 'javascript:void(0);' }}">
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- [Latest Leads] end -->
                <!--! BEGIN: [Upcoming Schedule] !-->
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack justify-content-between">
                                <div>
                                    <h4 class="text-success">
                                        {{ number_format($pageViewsCurrent) }}
                                    </h4>
                                    <div class="text-muted">Page Views</div>
                                </div>
                                <div class="text-end">
                                    <i class="feather-eye fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-success py-3">
                            <div class="hstack justify-content-between">
                                <p class="text-white mb-0">
                                    {{ $pageViewsTrendText }}
                                </p>
                                <div class="text-end">
                                    <i class="feather {{ $pageViewsTrendIcon }} text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack justify-content-between">
                                <div>
                                    <h4 class="text-warning">
                                        {{ number_format($totalLeadsCurrent) }}
                                    </h4>
                                    <div class="text-muted">Total Leads</div>
                                </div>
                                <div class="text-end">
                                    <i class="feather-pie-chart fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-warning py-3">
                            <div class="hstack justify-content-between">
                                <p class="text-white mb-0">
                                    {{ $totalLeadsTrendText }}
                                </p>
                                <div class="text-end">
                                    <i class="feather {{ $totalLeadsTrendIcon }} text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack justify-content-between">
                                <div>
                                    <h4 class="text-primary">
                                        {{ $campaignSuccessCurrent ?? ($campaignSuccessLast30Days ?? 0) }}
                                    </h4>
                                    <div class="text-muted">Total Campaigns</div>
                                </div>
                                <div class="text-end">
                                    <i class="feather-shopping-bag fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-primary py-3">
                            <div class="hstack justify-content-between">
                                <p class="text-white mb-0">
                                    {{ abs($campaignPercentChange) }}% change
                                </p>
                                <div class="text-end">
                                    <i class="{{ $campaignTrendIcon }} text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="hstack justify-content-between">
                                <div>
                                    <h4 class="text-danger">
                                        {{ $inquiriesCurrent ?? ($inquiriesLast30Days ?? 0) }}
                                    </h4>
                                    <div class="text-muted">Total Inquiries</div>
                                </div>
                                <div class="text-end">
                                    <i class="feather-shopping-cart fs-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-danger py-3">
                            <div class="hstack justify-content-between">
                                <p class="text-white mb-0">{{ abs($inquiriesPercentChange) }}% change</p>
                                <div class="text-end">
                                    <i class="{{ $inquiriesTrendIcon }} text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/daterangepicker.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/apexcharts.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/circle-progress.min.js"></script>
    <script src="{{ asset('') }}admin/js/dashboard-init.min.js"></script>
    <script>
        window.campaignSentDailyLabels = @json($campaignSentDailyLabels);
        window.campaignSentDailyData = @json($campaignSentDailyData);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const el = document.querySelector("#task-completed-area-chart-costum");
            if (!el) return;

            // destroy chart lama kalau ada (important)
            el.innerHTML = "";

            new ApexCharts(el, {
                series: [{
                    name: "Campaign Sent",
                    data: window.campaignSentDailyData
                }],
                chart: {
                    type: "area",
                    height: 100,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    } // 🔥 ini yg bikin clean
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.2,
                        opacityTo: 0.75,
                        stops: [0, 90, 100]
                    }
                },
                colors: ["#3454d1"],
                grid: {
                    show: false
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },

                xaxis: {
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },

                tooltip: {
                    x: {
                        formatter: function(_, opts) {
                            return window.campaignSentDailyLabels[opts.dataPointIndex];
                        }
                    },
                    y: {
                        formatter: function(val) {
                            return val + " Campaigns Sent";
                        }
                    },
                    style: {
                        fontSize: "12px",
                        fontFamily: "Inter"
                    }
                }
            }).render();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const el = document.querySelector("#new-tasks-area-chart-costum");
            if (!el) return;

            el.innerHTML = "";

            window.inquiriesDailyLabels = @json($inquiriesDailyLabels);
            window.inquiriesDailyData = @json($inquiriesDailyData);

            new ApexCharts(el, {
                series: [{
                    name: "New Inquiries",
                    data: window.inquiriesDailyData
                }],
                chart: {
                    type: "area",
                    height: 100,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.2,
                        opacityTo: 0.75,
                        stops: [0, 90, 100]
                    }
                },
                colors: ["#25b865"],
                grid: {
                    show: false
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    labels: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                tooltip: {
                    x: {
                        formatter: function(_, opts) {
                            return window.inquiriesDailyLabels[opts.dataPointIndex];
                        }
                    },
                    y: {
                        formatter: function(val) {
                            return val + " New Inquiries";
                        }
                    },
                    style: {
                        fontSize: "12px",
                        fontFamily: "Inter"
                    }
                }
            }).render();
        });
    </script>
    <script>
        $(document).ready(function() {

            // =============================
            // DEFAULT / REQUEST VALUE
            // =============================
            const url = new URLSearchParams(window.location.search);

            let start = url.get('start_date') ?
                moment(url.get('start_date')) :
                moment().subtract(29, 'days');

            let end = url.get('end_date') ?
                moment(url.get('end_date')) :
                moment();

            // =============================
            // INIT DATERANGEPICKER
            // =============================
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                autoUpdateInput: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [
                        moment().subtract(1, 'month').startOf('month'),
                        moment().subtract(1, 'month').endOf('month')
                    ]
                }
            });

            // =============================
            // SET TEXT (AWAL)
            // =============================
            $('#reportrangeText').html(
                start.format('MMM D, YY') + ' - ' + end.format('MMM D, YY')
            );

            // =============================
            // APPLY → REDIRECT
            // =============================
            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

                $('#reportrangeText').html(
                    picker.startDate.format('MMM D, YY') +
                    ' - ' +
                    picker.endDate.format('MMM D, YY')
                );

                window.location.href =
                    "{{ route('dashboard.filter') }}" +
                    "?start_date=" + picker.startDate.format('YYYY-MM-DD') +
                    "&end_date=" + picker.endDate.format('YYYY-MM-DD');
            });

        });
    </script>
@endpush
