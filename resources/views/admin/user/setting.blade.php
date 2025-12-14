@extends('layout.admin')

@push('header')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/dataTables.bs5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/select2-theme.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}admin/vendors/css/datepicker.min.css">
@endpush

@section('main')
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Setting</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Setting</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-xxl-4 col-xl-6">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="mb-4 text-center">
                                <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                    <div class="avatar-image wd-150 ht-150 border border-5 border-gray-3">
                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('admin/user.jpg') }}"
                                            class="img-fluid" alt="avatar">
                                    </div>

                                    <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle"
                                        style="top: 76%; right: 10px">
                                        @if ($user->email_verified_at)
                                            <i class="bi bi-patch-check-fill"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <a href="javascript:void(0);" class="fs-14 fw-bold d-block">
                                        {{ $user->name ?? '-' }}</a>
                                    <a href="javascript:void(0);"
                                        class="fs-12 fw-normal text-muted d-block">{{ $user->email ?? '-' }}</a>
                                </div>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i
                                            class="feather-map-pin"></i>Location</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->lokasi ?? '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-4">
                                    <span class="text-muted fw-medium hstack gap-3"><i
                                            class="feather-phone"></i>Whatsapp</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->wa ?? '-' }}</a>
                                </li>
                                <li class="hstack justify-content-between mb-0">
                                    <span class="text-muted fw-medium hstack gap-3"><i class="feather-mail"></i>Email</span>
                                    <a href="javascript:void(0);" class="float-end">{{ $user->email ?? '-' }}</a>
                                </li>
                            </ul>
                            <div class="d-flex gap-2 text-center pt-4">
                                <a href="javascript:void(0);" class="w-100 btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#UpdateUser"><i class="feather-edit me-2"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-6">
                    <div class="card border-top-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                                <div class="profile-details mb-5">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Profile Details:</h5>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-light-brand"
                                            data-bs-toggle="modal" data-bs-target="#UpdateUser">Edit Profile</a>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Full Name:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->name }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Surname:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->surname ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Date of Birth:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Whatsapp:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->wa ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Email Address:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->email ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Location:</div>
                                        <div class="col-sm-6 fw-semibold">{{ $user->lokasi ?? '-' }}</div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Joining Date:</div>
                                        <div class="col-sm-6 fw-semibold">
                                            {{ $user->created_at ? $user->created_at->translatedFormat('d F Y H:i') : '-' }}
                                        </div>
                                    </div>
                                    <div class="row g-0 mb-4">
                                        <div class="col-sm-6 text-muted">Type Account:</div>
                                        <div class="col-sm-6 fw-semibold">
                                            {{ $user->is_superadmin == 1 ? 'Super Admin' : 'Admin' }}
                                        </div>
                                    </div>
                                </div>
                                @if (is_null($user->surname) || is_null($user->wa) || is_null($user->birth) || is_null($user->lokasi))
                                    <div class="alert alert-dismissible mb-4 p-4 d-flex alert-soft-warning-message profile-overview-alert"
                                        role="alert">
                                        <div class="me-4 d-none d-md-block">
                                            <i class="feather feather-alert-triangle fs-1"></i>
                                        </div>
                                        <div>
                                            <p class="fw-bold mb-1 text-truncate-1-line">
                                                Your profile has not been updated yet!!!
                                            </p>
                                            <p class="fs-10 fw-medium text-uppercase text-truncate-1-line">
                                                Please complete your profile information
                                            </p>
                                            <a href="javascript:void(0);"
                                                class="btn btn-sm bg-soft-warning text-warning d-inline-block"
                                                data-bs-toggle="modal" data-bs-target="#UpdateUser">
                                                Update Now
                                            </a>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @else
                                    <br><br><br><br><br><br><br><br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade-scale" id="UpdateUser" tabindex="-1" aria-labelledby="UpdateUser" aria-hidden="true"
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
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch">
                                    <div class="card-body lead-status">
                                        <div class="row">

                                            {{-- AVATAR --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Avatar</label>
                                                <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                                    <div
                                                        class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('admin/images/avatar/1.png') }}"
                                                            class="upload-pic img-fluid rounded h-100 w-100"
                                                            alt="">
                                                        {{-- <img src="assets/images/avatar/1.png" class="upload-pic img-fluid rounded h-100 w-100" alt=""> --}}
                                                        <div
                                                            class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                            <i class="feather feather-camera" aria-hidden="true"></i>
                                                        </div>
                                                        <input class="file-upload" type="file" name="avatar"
                                                            accept="image/*">
                                                    </div>
                                                    <div class="d-flex flex-column gap-1">
                                                        <div class="fs-11 text-gray-500 mt-2"># Upload your profile</div>
                                                        <div class="fs-11 text-gray-500"># Avatar size 150x150</div>
                                                        <div class="fs-11 text-gray-500"># Max upload size 2mb</div>
                                                        <div class="fs-11 text-gray-500"># png, jpg, jpeg</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4"></div>

                                            {{-- NAME --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" value="{{ old('name', $user->name) }}"
                                                        placeholder="Full name">
                                                </div>
                                            </div>

                                            {{-- SURNAME --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Surname</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user-check"></i>
                                                    </div>
                                                    <input type="text" class="form-control" name="surname"
                                                        id="surname" value="{{ old('surname', $user->surname) }}"
                                                        placeholder="Surname">
                                                </div>
                                            </div>

                                            {{-- EMAIL --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Email</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" name="email"
                                                        id="email" value="{{ old('email', $user->email) }}"
                                                        placeholder="Email">
                                                </div>
                                            </div>

                                            {{-- BIRTH --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label" for="dateofBirth">Date of Birth</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" id="dateofBirth" name="birth"
                                                        id="birth" value="{{ old('birth', $user->birth) }}"
                                                        placeholder="Pick date of birth">
                                                </div>
                                            </div>

                                            {{-- WHATSAPP --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Whatsapp</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fa-brands fa-whatsapp"></i>
                                                    </div>
                                                    <input type="number" class="form-control" name="wa"
                                                        id="wa" value="{{ old('wa', $user->wa) }}"
                                                        placeholder="Whatsapp number">
                                                </div>
                                            </div>

                                            {{-- LOCATION --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Location</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                                    <input type="text" class="form-control" name="lokasi"
                                                        id="lokasi" value="{{ old('lokasi', $user->lokasi) }}"
                                                        placeholder="Location">
                                                </div>
                                            </div><br>

                                            <hr class="my-4"><br>

                                            {{-- RESET PASSWORD --}}
                                            <div class="mb-4">
                                                <h5 class="fw-bold">Reset Password (Optional)</h5>
                                            </div>

                                            {{-- PREVIOUS PASSWORD --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Previous Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="current_password"
                                                        placeholder="Previous Password">
                                                    <div
                                                        class="input-group-text border-start bg-gray-2 c-pointer show-pass1">
                                                        <i class="feather-eye"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-4"></div>

                                            {{-- NEW PASSWORD --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">New Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="New Password">
                                                    <div
                                                        class="input-group-text border-start bg-gray-2 c-pointer show-pass1">
                                                        <i class="feather-eye"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- CONFIRM PASSWORD --}}
                                            <div class="col-lg-6 mb-4 align-items-center">
                                                <label class="form-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation" placeholder="Confirm Password">
                                                    <div
                                                        class="input-group-text border-start bg-gray-2 c-pointer show-pass1">
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
@endsection

@push('footer')
    <script src="{{ asset('') }}admin/vendors/js/lslstrength.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/dataTables.bs5.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/select2-active.min.js"></script>
    <script src="{{ asset('') }}admin/js/common-init.min.js"></script>
    <script src="{{ asset('') }}admin/js/customers-view-init.min.js"></script>
    <script src="{{ asset('') }}admin/js/theme-customizer-init.min.js"></script>
    <script src="{{ asset('') }}admin/js/customers-create-init.min.js"></script>
    <script src="{{ asset('') }}admin/vendors/js/datepicker.min.js"></script>
    <script src="{{ asset('') }}admin/js/leads-init.min.js"></script>

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
@endpush
