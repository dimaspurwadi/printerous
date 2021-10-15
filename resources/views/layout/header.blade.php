<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
        <!--begin::Container-->
        <div class="container d-flex align-items-stretch justify-content-between">
            <!--begin::Left-->
            <div class="d-flex align-items-stretch mr-3">
                <!--begin::Header Logo-->
                <div class="header-logo">
                    <a href="{{ route('index') }}">
                        <img alt="Logo" src="{{ asset('assets/media/logos/stars.png') }}" class="logo-default max-h-40px" />
                        <img alt="Logo" src="{{ asset('assets/media/logos/stars.png') }}" class="logo-sticky max-h-40px" />
                    </a>
                </div>
                <!--end::Header Logo-->
                <!--begin::Header Menu Wrapper-->
                <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                    <!--begin::Header Menu-->
                    <div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                        <ul class="menu-nav">
                            <li class="menu-item menu-item-submenu menu-item-rel">
                                <a href="{{ route("organization.index") }}" class="menu-link">
                                    <span class="menu-text">Organization</span>
                                    <i class="menu-arrow"></i>
                                </a>
                            </li>
                            @if ($dataSession['data']['level'] == 1)
                                <li class="menu-item menu-item-submenu menu-item-rel">
                                    <a href="{{ route("user.index") }}" class="menu-link">
                                        <span class="menu-text">User Account Manager</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <!--end::Header Nav-->
                    </div>
                    <!--end::Header Menu-->
                </div>
                <!--end::Header Menu Wrapper-->
            </div>
            <!--end::Left-->
            <!--begin::Topbar-->
            <div class="topbar">
                <!--begin::User-->
                <div class="dropdown">
                    <!--begin::Toggle-->
                    <div class="topbar-item">
                        <div class="btn btn-icon btn-hover-transparent-white d-flex align-items-center btn-lg px-md-2 w-md-auto" id="kt_quick_user_toggle">
                            <span class="text-white opacity-70 font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                            <span class="text-white opacity-90 font-weight-bolder font-size-base d-none d-md-inline mr-4">{{ $dataSession['data']['name'] }}</span>
                            <span class="symbol symbol-35">
                                <span class="symbol-label text-white font-size-h5 font-weight-bold bg-white-o-30"><i class="fa fa-bars" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <!--end::Toggle-->
                </div>
                <!--end::User-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->