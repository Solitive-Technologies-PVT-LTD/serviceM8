<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ url('/') }}" class="logo logo-dark">
            <span class="logo-sm">
            @if(empty(get_setting('company_logo')))
            <!-- <img src="{{ url('/assets/images/favicon.jpeg') }}" alt="Logo" height="50" width="50"> -->
            @else
            <!-- <img src="{{ url('/storage/'.get_setting('company_logo_sm')) }}" alt="Logo" height="50" width="50"> -->
            @endif
            </span>
            <span class="logo-lg">
            @if(empty(get_setting('company_logo')))
            <!-- <img src="{{ url('/assets/images/favicon.jpeg') }}" alt="Logo" height="60"> -->
            @else
            <!-- <img src="{{ url('/storage/'.get_setting('company_logo')) }}" alt="Logo" height="60"> -->
            @endif
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ url('/') }}" class="logo logo-light">
            <span class="logo-sm">
            @if(empty(get_setting('company_logo')))
            <!-- <img src="{{ url('/assets/images/favicon.jpeg') }}" alt="Logo" height="50" width="50"> -->
            @else
            <!-- <img src="{{ url('/storage/'.get_setting('company_logo_sm')) }}" alt="Logo" height="50" width="50"> -->
            @endif
            </span>
            <span class="logo-lg">
            @if(empty(get_setting('company_logo')))
            <!-- <img src="{{ url('/assets/images/favicon.jpeg') }}" alt="Logo" height="60"> -->
            @else
            <!-- <img src="{{ url('/storage/'.get_setting('company_logo')) }}" alt="Logo" height="60"> -->
            @endif
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
           
                <li class="menu-title"><span >@lang('translation.menu')</span></li>

               
                {!! create_menus() !!}
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
