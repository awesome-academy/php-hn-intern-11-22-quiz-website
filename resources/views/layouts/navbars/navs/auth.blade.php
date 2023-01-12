<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block mr-5" href="{{ route('quizzes.index') }}">{{ __('temp.qz') }}</a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto" action="{{ route('quizzes.search') }}">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-link btn-sm btn-primary">
                            <span class="input-group-text" ><i class="fas fa-search"></i></span>
                        </button>
                    </div>
                    <input class="form-control" placeholder="{{ session('alert') ? session('alert') : __('temp.enc')}} " type="text" name="search" >
                </div>
            </div>
        </form>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold"> 
                                {{ __('temp.lang') }} 
                                @switch(session()->get('locale'))
                                    @case('en')
                                        {{ __('temp.en') }}
                                        @break
                                    @case('vi')
                                        {{ __('temp.vi') }}
                                        @break
                                    @default
                                        {{ __('temp.en') }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('lang', ['en']) }}" class="dropdown-item">
                        <span>{{ __('temp.en') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('lang', ['vi']) }}" class="dropdown-item">
                        <span>{{ __('temp.vi') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->username }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('temp.wel') }}</h6>
                    </div>
                    <a href="{{ route('users.show', auth()->user()->id) }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('temp.prof') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('temp.out') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
