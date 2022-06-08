<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/backend/assets/images/logo-sm.png" alt="logo-sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/backend/assets/images/logo-dark.png" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/backend/assets/images/logo-sm.png" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/backend/assets/images/logo-light.png" alt="logo-light" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            {{-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div> --}}

            @php
            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);
            @endphp

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ (!empty($adminData->profile_image) ? asset('upload/profile_images/'. $adminData->profile_image) : '/backend/assets/images/no_image.jpg' ) }}"
                        alt="Header Avatar">
                    {{-- @if ($adminData->profile_image)
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('upload/profile_images/'. $adminData->profile_image) }}" alt="Header Avatar">
                    @else
                    <img class="rounded-circle header-profile-user" src="/backend/assets/images/no_image.jpg"
                        alt="Header Avatar">
                    @endif --}}
                    <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('change.password') }}"><i
                            class="ri-lock-password-line align-middle me-1"></i> Change Password</a>
                    <a class="dropdown-item d-block" href="#"><i class="ri-settings-2-line align-middle me-1"></i>
                        Settings</a>
                    <div class="dropdown-divider"></div>

                    {{-- first option --}}
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                    </a>

                    {{-- second option --}}
                    {{-- <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="dropdown-item text-danger" href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout
                        </a>
                    </form> --}}
                </div>
            </div>

        </div>
    </div>
</header>