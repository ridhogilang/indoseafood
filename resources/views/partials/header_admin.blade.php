 <!--! ================================================================ !-->
 <!--! [Start] Navigation Manu !-->
 <!--! ================================================================ !-->
 <nav class="nxl-navigation">
     <div class="navbar-wrapper">
         <div class="m-header">
             <a href="{{ route('admin.dashboard') }}" class="b-brand protect-leave">
                 <!-- ========   change your logo hear   ============ -->
                 <img src="{{ asset('home/img/logo.png') }}" style="width: 80%;" alt="" class="logo logo-lg" />
                 <img src="{{ asset('home/img/logo icon.png') }}" alt="" class="logo logo-sm" />
             </a>
         </div>
         <div class="navbar-content">
             <ul class="nxl-navbar">
                 <li class="nxl-item nxl-caption">
                     <label>Navigation</label>
                 </li>
                 <li class="nxl-item"><a class="nxl-link protect-leave" href="{{ route('admin.dashboard') }}"><span
                             class="nxl-micon"><i class="feather-airplay"></i></span>
                         <span class="nxl-mtext">Dashboards</span></a>
                 </li>
                 <li class="nxl-item"><a class="nxl-link protect-leave" href="{{ route('leads') }}"><span
                             class="nxl-micon"><i class="feather-users"></i></span>
                         <span class="nxl-mtext">Leads</span></a>
                 </li>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link protect-leave">
                         <span class="nxl-micon"><i class="feather-mail"></i></span>
                         <span class="nxl-mtext">Mail</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link protect-leave" href="{{ route('campaign') }}">Campaign
                                 Contact</a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('status.campaign') }}">Campaign
                                 Status</a></li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('mail.campaign') }}">Campaign Mail</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link protect-leave">
                         <span class="nxl-micon"><i class="feather-clipboard"></i></span>
                         <span class="nxl-mtext">Inquiries</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('inquiry.list') }}">New</a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('inquiry.archived') }}">Archive</a></li>
                     </ul>
                 </li>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link protect-leave">
                         <span class="nxl-micon"><i class="fa-solid fa-fish"></i></span>
                         <span class="nxl-mtext">Product</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('inquiry.list') }}">Product List</a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('inquiry.archived') }}">Category Product</a></li>
                     </ul>
                 </li>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link protect-leave">
                         <span class="nxl-micon"><i class="feather-book"></i></span>
                         <span class="nxl-mtext">Article</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link protect-leave" href="{{ route('article.new') }}">New
                                 Article</a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('article.list') }}">Article
                                 List</a></li>
                         <li class="nxl-item"><a class="nxl-link protect-leave"
                                 href="{{ route('article.category') }}">Category
                                 Article</a></li>
                     </ul>
                 </li>
                 @if (auth()->check() && auth()->user()->is_superadmin == 1)
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link protect-leave">
                             <span class="nxl-micon"><i class="feather-settings"></i></span>
                             <span class="nxl-mtext">Setting</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link protect-leave"
                                     href="{{ route('user.setting') }}">Setting</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link protect-leave"
                                     href="{{ route('user.list') }}">List
                                     User</a></li>
                         </ul>
                     </li>
                 @else
                     <li class="nxl-item">
                         <a class="nxl-link protect-leave" href="">
                             <span class="nxl-micon">
                                 <i class="feather-settings"></i>
                             </span>
                             <span class="nxl-mtext">Setting</span>
                         </a>
                     </li>
                 @endif
             </ul>
         </div>
     </div>
 </nav>
 <!--! ================================================================ !-->
 <!--! [Start] Header !-->
 <!--! ================================================================ !-->
 <header class="nxl-header">
     <div class="header-wrapper">
         <!--! [Start] Header Left !-->
         <div class="header-left d-flex align-items-center gap-4">
             <!--! [Start] nxl-head-mobile-toggler !-->
             <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                 <div class="hamburger hamburger--arrowturn">
                     <div class="hamburger-box">
                         <div class="hamburger-inner"></div>
                     </div>
                 </div>
             </a>
             <!--! [Start] nxl-head-mobile-toggler !-->
             <!--! [Start] nxl-navigation-toggle !-->
             <div class="nxl-navigation-toggle">
                 <a href="javascript:void(0);" id="menu-mini-button">
                     <i class="feather-align-left"></i>
                 </a>
                 <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                     <i class="feather-arrow-right"></i>
                 </a>
             </div>
             <!--! [End] nxl-navigation-toggle !-->
             <!--! [Start] nxl-lavel-mega-menu-toggle !-->
             <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                 <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                     <i class="feather-align-left"></i>
                 </a>
             </div>
             <!--! [End] nxl-lavel-mega-menu-toggle !-->

         </div>
         <!--! [End] Header Left !-->
         <!--! [Start] Header Right !-->
         <div class="header-right ms-auto">
             <div class="d-flex align-items-center">
                 <div class="dropdown nxl-h-item nxl-header-language d-none d-sm-flex">
                     <a href="javascript:void(0);" class="nxl-head-link me-0 nxl-language-link"
                         data-bs-toggle="dropdown" data-bs-auto-close="outside">
                         <img src="admin/vendors/img/flags/4x3/us.svg" alt="" class="img-fluid wd-20" />
                     </a>
                     <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-language-dropdown">
                         <div class="dropdown-divider mt-0"></div>
                         <div class="language-items-wrapper">
                             <div class="select-language px-4 py-2 hstack justify-content-between gap-4">
                                 <div class="lh-lg">
                                     <h6 class="mb-0">Select Language</h6>
                                     <p class="fs-11 text-muted mb-0">12 languages avaiable!</p>
                                 </div>
                                 <a href="javascript:void(0);" class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                     title="Add Language">
                                     <i class="feather-plus"></i>
                                 </a>
                             </div>
                             <div class="dropdown-divider"></div>
                             <div class="row px-4 pt-3">
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/sa.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Arabic</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/bd.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Bengali</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/ch.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Chinese</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/nl.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Dutch</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select active">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/us.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>English</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/fr.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>French</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/de.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>German</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/in.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Hindi</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/ru.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Russian</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/es.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Spanish</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/tr.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Turkish</span>
                                     </a>
                                 </div>
                                 <div class="col-sm-4 col-6 language_select">
                                     <a href="javascript:void(0);" class="d-flex align-items-center gap-2">
                                         <div class="avatar-image avatar-sm"><img
                                                 src="admin/vendors/img/flags/1x1/pk.svg" alt=""
                                                 class="img-fluid" /></div>
                                         <span>Urdo</span>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="nxl-h-item d-none d-sm-flex">
                     <div class="full-screen-switcher">
                         <a href="javascript:void(0);" class="nxl-head-link me-0"
                             onclick="$('body').fullScreenHelper('toggle');">
                             <i class="feather-maximize maximize"></i>
                             <i class="feather-minimize minimize"></i>
                         </a>
                     </div>
                 </div>
                 <div class="nxl-h-item dark-light-theme">
                     <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                         <i class="feather-moon"></i>
                     </a>
                     <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                         <i class="feather-sun"></i>
                     </a>
                 </div>
                 <div class="dropdown nxl-h-item nxl-header-search">
                     @php
                         use App\Models\Article;
                         use App\Models\EmailCampaignContact;

                         $userId = auth()->id();

                         // Artikel yang dibuat oleh user
                         $userArticles = Article::with('category')
                             ->where('user_id', $userId)
                             ->where('status', 'draft')
                             ->get();
                         $userDraftCount = Article::where('user_id', $userId)->where('status', 'draft')->count();

                         // Campaign yang statusnya pending tapi sudah lewat waktu
                         $expiredCampaigns = EmailCampaignContact::with('contact')
                             ->where('status', 'pending')
                             ->whereNotNull('sent_at')
                             ->where('sent_at', '<', now())
                             ->get();
                         $expiredCampaignsCount = $expiredCampaigns->count();
                         $countAll = $userDraftCount + $expiredCampaignsCount;
                     @endphp
                     <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown"
                         data-bs-auto-close="outside">
                         <i class="feather-clock"></i>
                         @if ($countAll > 0)
                             <span class="badge bg-success nxl-h-badge">{{ $countAll }}</span>
                         @endif
                     </a>
                     <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                         <div class="input-group search-form">
                             <span class="input-group-text">
                                 <h6 class="fw-bold text-dark mb-0">Timesheets</h6>
                             </span>
                             <input type="text" class="form-control search-input-field" readonly />
                             <span class="input-group-text fs-11 text-success text-end ms-auto">
                                 <i class="feather-bell"></i>
                                 <span>{{ $countAll }} Upcoming</span> </span>
                         </div>
                         <div class="dropdown-divider mt-0"></div>
                         <div class="search-items-wrapper">
                             @if ($countAll > 0)
                                 @if ($expiredCampaignsCount > 0)
                                     <div class="users-result px-4 py-2">
                                         <h4 class="fs-13 fw-normal text-gray-600 mb-3">Campaign Failed <span
                                                 class="badge small bg-gray-200 rounded ms-1 text-danger">{{ $expiredCampaignsCount }}</span>
                                         </h4>
                                         @foreach ($expiredCampaigns as $campaign)
                                             <div class="d-flex align-items-center justify-content-between mb-4">
                                                 <div class="d-flex align-items-center gap-3">
                                                     <div>
                                                         <a href="{{ route('status.campaign') }}"
                                                             class="font-body fw-bold d-block mb-1"> Company :
                                                             {{ $campaign->contact->company ?? 'Unknown Company' }}
                                                             <br>
                                                             {{ $campaign->contact->kirim ?? 'Unknown Email' }}
                                                         </a>
                                                         <p class="fs-11 text-muted mb-0">
                                                             {{ $campaign->sent_at->diffForHumans() }}
                                                             <span
                                                                 class="badge bg-soft-danger text-danger">Failed</span>
                                                         </p>
                                                     </div>
                                                 </div>
                                                 <a href="{{ route('status.campaign') }}"
                                                     class="avatar-text avatar-md">
                                                     <i class="feather-chevron-right"></i>
                                                 </a>
                                             </div>
                                         @endforeach
                                     </div>
                                     <div class="dropdown-divider my-3"></div>
                                 @endif
                                 @if ($userDraftCount > 0)
                                     <div class="users-result px-4 py-2">
                                         <h4 class="fs-13 fw-normal text-gray-600 mb-3">Article Draft <span
                                                 class="badge small bg-gray-200 rounded ms-1 text-warning">{{ $userDraftCount }}</span>
                                         </h4>
                                         @foreach ($userArticles as $article)
                                             <div class="d-flex align-items-center justify-content-between mb-4">
                                                 <div class="d-flex align-items-center gap-3">
                                                     <div>
                                                         <a href="{{ route('article.edit', ['slug' => $article->slug]) }}"
                                                             class="font-body d-block mb-1 text-decoration-none">
                                                             <span class="fw-bold">
                                                                 {{ $article->title ?? 'Unknown Title' }}
                                                             </span>
                                                             <br>
                                                             <span class="small text-muted">
                                                                 Category :
                                                                 {{ $article->category->name ?? 'Unknown Category' }}
                                                             </span>
                                                         </a>

                                                         <p class="fs-11 text-muted mb-0">
                                                             {{ $article->created_at->diffForHumans() }}
                                                             <span
                                                                 class="badge bg-soft-warning text-warning">Draft</span>
                                                         </p>
                                                     </div>
                                                 </div>
                                                 <a href="{{ route('article.edit', ['slug' => $article->slug]) }}"
                                                     class="avatar-text avatar-md">
                                                     <i class="feather-chevron-right"></i>
                                                 </a>
                                             </div>
                                         @endforeach
                                     </div>
                                     <div class="dropdown-divider mt-1 mb-3"></div>
                                 @endif
                             @else
                                 <div class="users-result px-4 py-2">
                                     <div
                                         class="d-flex justify-content-between align-items-center flex-column timesheets-body">
                                         <i class="feather-bell-off fs-1 mb-4 mt-4"></i>
                                         <p class="text-muted mb-4">No Timesheet notifications!</p>
                                     </div>
                                 </div>
                             @endif
                         </div>
                     </div>
                 </div>
                 <div class="dropdown nxl-h-item nxl-header-search">
                     @php
                         $newInquiriesCount = \App\Models\Inquiry::where('status', 'new')->count();
                         $newInquiries = \App\Models\Inquiry::where('status', 'new')->get();
                         //  dd($newInquiries);
                     @endphp
                     <a href="javascript:void(0);" class="nxl-head-link me-3" data-bs-toggle="dropdown"
                         data-bs-auto-close="outside">
                         <i class="feather-bell"></i>
                         @if ($newInquiriesCount > 0)
                             <span class="badge bg-danger nxl-h-badge">{{ $newInquiriesCount }}</span>
                         @endif
                     </a>
                     <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                         <div class="input-group search-form">
                             <span class="input-group-text">
                                 <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                             </span>
                             <input type="text" class="form-control search-input-field" readonly />
                             <span class="input-group-text fs-11 text-success text-end ms-auto">
                                 <i class="feather-bell"></i>
                                 <span>{{ $newInquiriesCount }} Notifications</span> </span>
                         </div>
                         <div class="dropdown-divider mt-0"></div>
                         <div class="search-items-wrapper">
                             <div class="users-result px-4 py-2">
                                 <h4 class="fs-13 fw-normal text-gray-600 mb-3">Users <span
                                         class="badge small bg-gray-200 rounded ms-1 text-dark">5</span></h4>
                                 @if ($newInquiriesCount > 0)
                                     @foreach ($newInquiries as $inquiry)
                                         <div class="d-flex align-items-center justify-content-between mb-4">
                                             <div class="d-flex align-items-center gap-3">
                                                 <div>
                                                     <a href="{{ route('inquiry.list') }}"
                                                         class="font-body fw-bold d-block mb-1">New inquiry received
                                                         from
                                                         {{ $inquiry->company_name ?? 'Unknown Company' }}
                                                         <br>Regarding
                                                         {{ $inquiry->fish_name ?? 'Unknown Fish' }}, Quantity:
                                                         {{ $inquiry->qty ?? 'N/A' }} Kg
                                                     </a>
                                                     <p class="fs-11 text-muted mb-0">
                                                         {{ $inquiry->created_at->diffForHumans() }}
                                                     </p>
                                                 </div>
                                             </div>
                                             <a href="{{ route('inquiry.list') }}" class="avatar-text avatar-md">
                                                 <i class="feather-chevron-right"></i>
                                             </a>
                                         </div>
                                     @endforeach
                                 @else
                                     <div
                                         class="d-flex justify-content-between align-items-center flex-column timesheets-body">
                                         <i class="feather-bell-off fs-1 mb-4 mt-4"></i>
                                         <p class="text-muted mb-4">No recent notifications!</p>
                                     </div>
                                 @endif
                             </div>
                             <div class="dropdown-divider mt-0 mb-0"></div>
                         </div>
                     </div>
                 </div>
                 <div class="dropdown nxl-h-item">
                     @php
                         $user = Auth::user();
                         $avatar = $user->avatar ? asset('storage/' . $user->avatar) : asset('admin/user.jpg');
                     @endphp
                     <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                         data-bs-auto-close="outside">
                         <img src="{{ $avatar }}" alt="user-image" class="img-fluid user-avtar me-0"
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                     </a>
                     <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                         <div class="dropdown-header">
                             <div class="d-flex align-items-center">
                                 <img src="{{ $avatar }}" alt="user-image" class="img-fluid user-avtar"
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                                 <div>
                                     <h6 class="text-dark mb-0">{{ $user->name }}
                                         {{-- <span class="badge bg-soft-success text-success ms-1">PRO</span> --}}
                                     </h6>
                                     <span class="fs-12 fw-medium text-muted">{{ $user->email }}</span>
                                 </div>
                             </div>
                         </div>
                         <a href="{{ route('user.setting') }}" class="dropdown-item">
                             <i class="feather-user"></i>
                             <span>Profile Details</span>
                         </a>
                         <a href="#" class="dropdown-item"
                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                             <i class="feather-log-out"></i>
                             <span>Logout</span>
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST"
                             style="display: none;">
                             @csrf
                         </form>
                     </div>
                 </div>

             </div>
         </div>
         <!--! [End] Header Right !-->
     </div>
 </header>
 <!--! ================================================================ !-->
 <!--! [End] Header !-->
 <!--! ================================================================ !-->
