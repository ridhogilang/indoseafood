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
                    <h5 class="m-b-10">Leads</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Leads</li>
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
                            <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter me-2"></i>
                                <span>Filter</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- POTENTIAL LEADS -->
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="filterPotential"
                                            name="potential_leads" value="1" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="filterPotential">
                                            Potential Leads
                                        </label>
                                    </div>
                                </div>

                                <!-- NON POTENTIAL LEADS -->
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="filterNonPotential"
                                            name="non_potential_leads" value="1" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="filterNonPotential">
                                            Non Potential Leads
                                        </label>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- CAMPAIGN LEADS -->
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="filterCampaign"
                                            name="is_campaign" value="1" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="filterCampaign">
                                            Campaign Leads
                                        </label>
                                    </div>
                                </div>

                                <!-- NON CAMPAIGN LEADS -->
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="filterNonCampaign"
                                            name="is_campaign" value="0" checked="checked" />
                                        <label class="custom-control-label c-pointer" for="filterNonCampaign">
                                            Non-Campaign Leads
                                        </label>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <!-- COUNTRY FILTER -->
                                <div class="dropdown-item">
                                    <select class="custom-control" data-select2-selector="status" id="filterCountry"
                                        name="country">
                                        <option value="" data-bg="bg-success" selected>
                                            All Country
                                        </option>
                                        @foreach ($countries as $ItemCountries)
                                            <option value="{{ $ItemCountries }}" data-bg="bg-warning">
                                                {{ $ItemCountries }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <a href="javascript:void(0);"
                            class="btn btn-success d-flex flex-row align-items-center justify-content-center"
                            style="gap: 6px !important;" data-bs-toggle="modal" data-bs-target="#ImportLead">
                            <i class="feather-plus"></i>
                            <span>Import Lead</span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#AddLead">
                            <i class="feather-plus me-2"></i>
                            <span>Add Lead</span>
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
        <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
            <div class="accordion-body pb-2">
                <div class="row">
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-users"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Total Leads</span>
                                            <span
                                                class="fs-24 fw-bolder d-block">{{ number_format($totalLeads, 0, ',', '.') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-check"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Potential Leads</span>
                                            <span
                                                class="fs-24 fw-bolder d-block">{{ number_format($potentialLeads, 0, ',', '.') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-plus"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Non Potential Leads</span>
                                            <span
                                                class="fs-24 fw-bolder d-block">{{ number_format($nonPotentialLeads, 0, ',', '.') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-text avatar-xl rounded">
                                            <i class="feather-user-minus"></i>
                                        </div>
                                        <a href="javascript:void(0);" class="fw-bold d-block">
                                            <span class="d-block">Inactive Leads</span>
                                            <span
                                                class="fs-24 fw-bolder d-block">{{ number_format($inactiveLeads, 0, ',', '.') }}</span>
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
                                <div id="leadBulkActionWrapper" class="d-none">
                                    <button class="btn btn-danger btn-sm" id="btnLeadBulkDelete">Delete</button>
                                </div>
                                <table class="table table-hover" id="LeadTable">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="custom-control custom-checkbox ms-1">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="checkAllLeadTable">
                                                    <label class="custom-control-label" for="checkAllLeadTable"></label>
                                                </div>
                                            </th>
                                            <th>No</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Contact</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
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
    <div class="modal fade-scale" id="ImportLead" tabindex="-1" aria-labelledby="ImportLead" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Import Leads</span>
                        <small class="d-block fs-11 fw-normal text-muted">Import your new leads</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="mb-5 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0 me-4">
                                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Download the
                                                    lead
                                                    import template here, if it doesn't match the template, leads cannot be
                                                    imported.</span>
                                            </h5>
                                            <a href="{{ asset('admin/download/Template Import Leads.xlsx') }}"
                                                class="btn btn-light-brand" download="Template_Import_Leads.xlsx">
                                                Download Template
                                            </a>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mb-4">
                                                <label class="form-label">Upload Your Lead (file .xsl .xlsx)</label>
                                                <input type="file"
                                                    accept=".xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                    class="form-control" name="file" id="contactsFile">
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
    <div class="modal fade-scale" id="AddLead" tabindex="-1" aria-labelledby="AddLead" aria-hidden="true"
        data-bs-dismiss="ou">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!--! BEGIN: [modal-header] !-->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Add Lead</span>
                        <small class="d-block fs-11 fw-normal text-muted">Add your new lead</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>
                <!--! BEGIN: [modal-body] !-->
                <div class="modal-body p-0">
                    <form action="{{ route('leads.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Company</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-regular fa-building"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="Company"
                                                        name="company" placeholder="Company Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Country</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-globe"></i></div>
                                                    <input type="text" class="form-control" id="country"
                                                        name="country" placeholder="Country">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Website</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-link"></i></div>
                                                    <input type="text" class="form-control" id="Website"
                                                        name="website" placeholder="Website Company">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" id="kirim"
                                                        name="kirim" placeholder="Email Company">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Phone</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-phone"></i></div>
                                                    <input type="number" class="form-control" id="Phone"
                                                        name="phone" placeholder="Number of Phone">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Whatsapp</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i>
                                                    </div>
                                                    <input type="number" class="form-control" id="whatsapp"
                                                        name="whatsapp" placeholder="Number of Whatsapp">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Contact Person</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" id="contact_person"
                                                        name="contact_person" placeholder="Contact Person Company">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status"
                                                    data-select2-selector="status">
                                                    <option value="active" data-bg="bg-success">Active</option>
                                                    <option value="inactive" data-bg="bg-danger">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Main Product</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-fish"></i></div>
                                                    <textarea class="form-control" id="MainProductInput" name="main_product" cols="30" rows="5"
                                                        placeholder="Main Product"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Notes</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-type"></i></div>
                                                    <textarea class="form-control" id="descriptionInput" name="notes" cols="30" rows="5"
                                                        placeholder="Description"></textarea>
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
    <div class="modal fade-scale" id="viewContactModal" tabindex="-1" aria-labelledby="viewContactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">View Lead</span>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>

                <!-- Body -->
                <div class="modal-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card stretch">
                                <div class="card-body lead-status">
                                    <div class="row">
                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Company</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa-regular fa-building"></i></div>
                                                <input type="text" class="form-control" id="view-company"
                                                    placeholder="Company Name" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Country</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-globe"></i></div>
                                                <input type="text" class="form-control" id="view-country"
                                                    placeholder="Country" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Website</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-link"></i></div>
                                                <input type="text" class="form-control" id="view-website"
                                                    placeholder="Website Company" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-mail"></i></div>
                                                <input type="email" class="form-control" id="view-kirim"
                                                    placeholder="Email Company" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Phone</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-phone"></i></div>
                                                <input type="text" class="form-control" id="view-phone"
                                                    placeholder="Number of Phone" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Whatsapp</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i></div>
                                                <input type="text" class="form-control" id="view-whatsapp"
                                                    placeholder="Number of Whatsapp" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Contact Person</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-user"></i></div>
                                                <input type="text" class="form-control" id="view-contact_person"
                                                    placeholder="Contact Person Company" disabled>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4">
                                            <label class="form-label">Status</label>
                                            <select class="form-control" id="view-status" disabled>
                                                <option value="active" data-bg="bg-success">Active</option>
                                                <option value="inactive" data-bg="bg-danger">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Main Product</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fa-solid fa-fish"></i></div>
                                                <textarea class="form-control" id="view-main_product" cols="30" rows="5" placeholder="Main Product"
                                                    disabled></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-4 align-items-center">
                                            <label class="form-label">Notes</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="feather-type"></i></div>
                                                <textarea class="form-control" id="view-notes" cols="30" rows="5" placeholder="Description" disabled></textarea>
                                            </div>
                                        </div>
                                    </div> <!-- row -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade-scale" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h2 class="d-flex flex-column mb-0">
                        <span class="fs-18 fw-bold mb-1">Edit Lead</span>
                        <small class="d-block fs-11 fw-normal text-muted">Update your lead information</small>
                    </h2>
                    <a href="javascript:void(0)" class="avatar-text avatar-md bg-soft-danger close-icon"
                        data-bs-dismiss="modal">
                        <i class="feather-x text-danger"></i>
                    </a>
                </div>

                <!-- Body -->
                <div class="modal-body p-0">
                    <form id="editContactForm" action="" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Company</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa-regular fa-building"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="edit-company"
                                                        name="company" placeholder="Company Name" required>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Country</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-globe"></i></div>
                                                    <input type="text" class="form-control" id="edit-country"
                                                        name="country" placeholder="Country">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Website</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-link"></i></div>
                                                    <input type="text" class="form-control" id="edit-website"
                                                        name="website" placeholder="Website Company">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" id="edit-kirim"
                                                        name="kirim" placeholder="Email Company">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Phone</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-phone"></i></div>
                                                    <input type="text" class="form-control" id="edit-phone"
                                                        name="phone" placeholder="Number of Phone">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Whatsapp</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="edit-whatsapp"
                                                        name="whatsapp" placeholder="Number of Whatsapp">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Contact Person</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" id="edit-contact_person"
                                                        name="contact_person" placeholder="Contact Person Company">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status" id="edit-status"
                                                    data-select2-selector="status">
                                                    <option value="active" data-bg="bg-success">Active</option>
                                                    <option value="inactive" data-bg="bg-danger">Inactive</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Main Product</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-solid fa-fish"></i></div>
                                                    <textarea class="form-control" id="edit-main_product" name="main_product" cols="30" rows="5"
                                                        placeholder="Main Product"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Notes</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-type"></i></div>
                                                    <textarea class="form-control" id="edit-notes" name="notes" cols="30" rows="5"
                                                        placeholder="Description"></textarea>
                                                </div>
                                            </div>
                                        </div> <!-- .row -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center"></div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Save changes
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
    <script src="https://kit.fontawesome.com/d61a3422c6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-delete-contact');
            if (!btn) return;

            e.preventDefault();
            const form = btn.closest('form');
            if (!form) return;

            Swal.fire({
                title: 'Delete contact?',
                text: 'Are you sure you want to delete this data? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-view-contact');
            if (!btn) return;

            const data = btn.dataset;

            const setValue = (id, value) => {
                const el = document.getElementById(id);
                if (!el) return;
                el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' ?
                    el.value = value || '' :
                    el.textContent = value || '';
            };

            setValue('view-company', data.company);
            setValue('view-country', data.country);
            setValue('view-website', data.website);
            setValue('view-kirim', data.kirim);
            setValue('view-phone', data.phone);
            setValue('view-whatsapp', data.whatsapp);
            setValue('view-contact_person', data.contact_person);
            setValue('view-main_product', data.main_product);
            setValue('view-notes', data.notes);

            const status = document.getElementById('view-status');
            if (status) {
                status.value = data.status || 'active';
                status.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-edit-contact');
            if (!btn) return;

            const data = btn.dataset;
            const form = document.getElementById('editContactForm');
            if (!form) return;

            form.action = data.updateUrl;

            const setValue = (id, value) => {
                const el = document.getElementById(id);
                if (el) el.value = value || '';
            };

            setValue('edit-company', data.company);
            setValue('edit-country', data.country);
            setValue('edit-website', data.website);
            setValue('edit-kirim', data.kirim);
            setValue('edit-phone', data.phone);
            setValue('edit-whatsapp', data.whatsapp);
            setValue('edit-contact_person', data.contact_person);
            setValue('edit-main_product', data.main_product);
            setValue('edit-notes', data.notes);

            const status = document.getElementById('edit-status');
            if (status) {
                status.value = data.status || 'active';
                status.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }
        });
    </script>
    <script>
        const leadTable = $('#LeadTable').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('leads.datatable') }}",
                data: function(d) {

                    /* POTENTIAL / NON POTENTIAL */
                    d.potential_leads = $('#filterPotential').is(':checked') ? 1 : 0;
                    d.non_potential_leads = $('#filterNonPotential').is(':checked') ? 1 : 0;

                    /* CAMPAIGN / NON CAMPAIGN
                       (jika dua-duanya dicentang → kirim null) */
                    const campaignChecked = $('#filterCampaign').is(':checked');
                    const nonCampaignChecked = $('#filterNonCampaign').is(':checked');

                    if (campaignChecked && !nonCampaignChecked) {
                        d.is_campaign = 1;
                    } else if (!campaignChecked && nonCampaignChecked) {
                        d.is_campaign = 0;
                    } else {
                        d.is_campaign = '';
                    }

                    /* COUNTRY */
                    d.country = $('#filterCountry').val();
                }
            },

            order: [
                [2, 'asc']
            ],

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
                    data: 'company'
                },
                {
                    data: 'email'
                },
                {
                    data: 'country'
                },
                {
                    data: 'contact_person'
                },
                {
                    data: 'main_product'
                },
                {
                    data: 'status',
                    orderable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],

            drawCallback: function() {
                toggleLeadBulkButton();
            }
        });

        /* TRIGGER RELOAD SAAT FILTER DIUBAH */
        $('#filterPotential, #filterNonPotential, #filterCampaign, #filterNonCampaign, #filterCountry')
            .on('change', function() {
                leadTable.ajax.reload();
            });

        /* PINDAHKAN BULK BUTTON */
        if ($('#leadBulkActionWrapper').length) {
            $('.bulk-actions').append($('#leadBulkActionWrapper'));
        }
    </script>

    <script>
        "use strict";

        $(document).ready(function() {

            function getSelectedLeadIds() {
                return $('.checkbox-user:checked').map(function() {
                    return $(this).val();
                }).get();
            }

            function toggleLeadBulkButton() {
                $('#leadBulkActionWrapper').toggleClass(
                    'd-none',
                    getSelectedLeadIds().length === 0
                );
            }

            function csrf() {
                return $('meta[name="csrf-token"]').attr('content');
            }

            /* CHECK ALL — SCOPED KE TABLE */
            $(document).on('change', '#checkAllLeadTable', function() {
                $(this)
                    .closest('table')
                    .find('.checkbox-user')
                    .prop('checked', this.checked);

                toggleLeadBulkButton();
            });

            /* SINGLE CHECKBOX */
            $(document).on('change', '.checkbox-user', function() {
                const table = $(this).closest('table');

                table.find('#checkAllLeadTable').prop(
                    'checked',
                    table.find('.checkbox-user').length ===
                    table.find('.checkbox-user:checked').length
                );

                toggleLeadBulkButton();
            });

            /* BULK DELETE */
            $('#btnLeadBulkDelete').on('click', function() {
                const ids = getSelectedLeadIds();
                if (!ids.length) return;

                Swal.fire({
                    title: 'Delete selected leads?',
                    text: `You are about to delete ${ids.length} lead(s). This action cannot be undone.`,
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
                        url: "{{ route('leads.bulk-delete') }}",
                        type: "POST",
                        data: {
                            ids: ids,
                            _token: csrf()
                        },
                        success: function(res) {
                            Swal.fire('Deleted', res.message, 'success');
                            $('#checkAllLeadTable').prop('checked', false);
                            $('#leadBulkActionWrapper').addClass('d-none');
                            $('#LeadTable').DataTable().ajax.reload(null, false);
                        }
                    });
                });
            });

        });
    </script>
@endpush
