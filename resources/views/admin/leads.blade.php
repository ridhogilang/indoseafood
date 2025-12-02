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
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-primary rounded-circle d-inline-block me-3"></span>
                                    <span>New</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                    <span>Working</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                    <span>Qualified</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-danger rounded-circle d-inline-block me-3"></span>
                                    <span>Declined</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-teal rounded-circle d-inline-block me-3"></span>
                                    <span>Customer</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-indigo rounded-circle d-inline-block me-3"></span>
                                    <span>Contacted</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-warning rounded-circle d-inline-block me-3"></span>
                                    <span>Pending</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-success rounded-circle d-inline-block me-3"></span>
                                    <span>Approved</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <span class="wd-7 ht-7 bg-teal rounded-circle d-inline-block me-3"></span>
                                    <span>In Progress</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-paperclip"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-pdf me-3"></i>
                                    <span>PDF</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-csv me-3"></i>
                                    <span>CSV</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-xml me-3"></i>
                                    <span>XML</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-txt me-3"></i>
                                    <span>Text</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-exe me-3"></i>
                                    <span>Excel</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-printer me-3"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                        </div>
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
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Contact</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr class="single-item">
                                                <td>
                                                    <div class="item-checkbox ms-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input checkbox"
                                                                id="checkBox_1">
                                                            <label class="custom-control-label" for="checkBox_1"></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="hstack gap-5 btn-view-contact"
                                                        data-bs-toggle="modal" data-bs-target="#viewContactModal"
                                                        data-company="{{ $contact->company }}"
                                                        data-main_product="{{ $contact->main_product }}"
                                                        data-website="{{ $contact->website }}"
                                                        data-kirim="{{ $contact->kirim }}"
                                                        data-country="{{ $contact->country }}"
                                                        data-phone="{{ $contact->phone }}"
                                                        data-whatsapp="{{ $contact->whatsapp }}"
                                                        data-contact_person="{{ $contact->contact_person }}"
                                                        data-notes="{{ $contact->notes }}"
                                                        data-status="{{ $contact->status }}">
                                                        <div>
                                                            <span
                                                                class="text-truncate-1-line">{{ $contact->company }}</span>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ trim($contact->kirim) ?: '-' }}</td>
                                                <td><a href="javascript:void(0)" class="btn-view-contact" data-bs-toggle="modal"
                                                        data-bs-target="#viewContactModal"
                                                        data-company="{{ $contact->company }}"
                                                        data-main_product="{{ $contact->main_product }}"
                                                        data-website="{{ $contact->website }}"
                                                        data-kirim="{{ $contact->kirim }}"
                                                        data-country="{{ $contact->country }}"
                                                        data-phone="{{ $contact->phone }}"
                                                        data-whatsapp="{{ $contact->whatsapp }}"
                                                        data-contact_person="{{ $contact->contact_person }}"
                                                        data-notes="{{ $contact->notes }}"
                                                        data-status="{{ $contact->status }}">{{ $contact->country }}</a>
                                                </td>
                                                <td>{{ $contact->contact ?? '-' }}</td>
                                                <td class="truncate-text">{{ $contact->main_product ?? '-' }}</td>
                                                @php
                                                    $status = $contact->status; // active / inactive

                                                    $statusMap = [
                                                        'active' => [
                                                            'label' => 'Active',
                                                            'color' => 'bg-success',
                                                        ],
                                                        'inactive' => [
                                                            'label' => 'Inactive',
                                                            'color' => 'bg-danger',
                                                        ],
                                                    ];
                                                @endphp
                                                <td>
                                                    <span class="d-inline-flex align-items-center gap-2">
                                                        <span class="status-dot {{ $statusMap[$status]['color'] }}"
                                                            style="width:10px; height:10px; border-radius:50%; display:inline-block;"></span>

                                                        {{ $statusMap[$status]['label'] }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="javascript:void(0)"
                                                            class="avatar-text avatar-md btn-view-contact"
                                                            data-bs-toggle="modal" data-bs-target="#viewContactModal"
                                                            data-company="{{ $contact->company }}"
                                                            data-main_product="{{ $contact->main_product }}"
                                                            data-website="{{ $contact->website }}"
                                                            data-kirim="{{ $contact->kirim }}"
                                                            data-country="{{ $contact->country }}"
                                                            data-phone="{{ $contact->phone }}"
                                                            data-whatsapp="{{ $contact->whatsapp }}"
                                                            data-contact_person="{{ $contact->contact_person }}"
                                                            data-notes="{{ $contact->notes }}"
                                                            data-status="{{ $contact->status }}">
                                                            <i class="feather feather-eye"></i>
                                                        </a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                                data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                <i class="feather feather-more-horizontal"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item btn-edit-contact"
                                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#editContactModal"
                                                                        data-update-url="{{ route('leads.update', $contact->id) }}"
                                                                        data-id="{{ $contact->id }}"
                                                                        data-company="{{ $contact->company }}"
                                                                        data-main_product="{{ $contact->main_product }}"
                                                                        data-website="{{ $contact->website }}"
                                                                        data-kirim="{{ $contact->kirim }}"
                                                                        data-country="{{ $contact->country }}"
                                                                        data-phone="{{ $contact->phone }}"
                                                                        data-whatsapp="{{ $contact->whatsapp }}"
                                                                        data-contact_person="{{ $contact->contact_person }}"
                                                                        data-notes="{{ $contact->notes }}"
                                                                        data-status="{{ $contact->status }}">
                                                                        <i class="feather feather-edit-3 me-3"></i>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('leads.destroy', $contact->id) }}"
                                                                        method="POST"
                                                                        class="delete-contact-form m-0 p-0">
                                                                        @csrf
                                                                        @method('DELETE')

                                                                        <a href="javascript:void(0)"
                                                                            class="dropdown-item btn-delete-contact">
                                                                            <i class="feather feather-trash-2 me-3"></i>
                                                                            <span>Delete</span>
                                                                        </a>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger me-2', // margin-right 0.5rem
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            });

            const deleteButtons = document.querySelectorAll('.btn-delete-contact');

            deleteButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('form');
                    if (!form) return;

                    swalWithBootstrapButtons.fire({
                        title: 'Delete contact?',
                        text: 'Are you sure you want to delete this data? This action cannot be undone.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel',
                        reverseButtons: false // ubah ke true kalau mau posisi dibalik
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.btn-view-contact');

            viewButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const data = this.dataset;

                    // Simple helper
                    const setValue = (id, value) => {
                        const el = document.getElementById(id);
                        if (!el) return;
                        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' || el
                            .tagName === 'SELECT') {
                            el.value = value || '';
                        } else {
                            el.textContent = value || '';
                        }
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

                    // Status select
                    const statusSelect = document.getElementById('view-status');
                    if (statusSelect) {
                        statusSelect.value = data.status || 'active';

                        // Kalau pakai select2 atau plugin lain, bisa trigger change:
                        const event = new Event('change', {
                            bubbles: true
                        });
                        statusSelect.dispatchEvent(event);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.btn-edit-contact');

            editButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const data = this.dataset;
                    const form = document.getElementById('editContactForm');

                    if (!form) return;

                    // Set URL action ke route update yg dikirim dari data-update-url
                    form.action = data.updateUrl;

                    // Helper isi value
                    const setValue = (id, value) => {
                        const el = document.getElementById(id);
                        if (!el) return;
                        el.value = value || '';
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

                    const statusSelect = document.getElementById('edit-status');
                    if (statusSelect) {
                        statusSelect.value = data.status || 'active';
                        // Kalau pakai select2, trigger change:
                        const event = new Event('change', {
                            bubbles: true
                        });
                        statusSelect.dispatchEvent(event);
                    }
                });
            });
        });
    </script>
@endpush
