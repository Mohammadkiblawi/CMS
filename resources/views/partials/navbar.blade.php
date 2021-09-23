<a class="navbar-brand" href="{{ url('/') }}">
    {{ config('app.name', 'Laravel') }}
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}"><i class="fa fa-home fa-fw"></i>{{__('site.Home')}}</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false" role="button" id="navbarDropdown">
                <i class="fa fa-file fa-fw"></i>{{__('site.Pages')}}
            </a>

            <div class="dropdown-menu text-right" aria-labelledby="navDropdown">
                @foreach($pages as $page)
                <a class="dropdown-item" href="{{route('page.show',$page->slug)}}">{{$page->title}}</a>
                @endforeach
            </div>
        </li>
    </ul>

    <ul class="navbar nav">
        @auth
        <li class="nav-item ml-3">
            <a href="{{route('post.create')}}" class="nav-link"><i class="fa fa-plus fa-fw"></i>موضوع جديد</a>
        </li>
        @endauth
        <!--Search box-->
        <li class="nav-item ml-3">
            <form method="post" action="{{route('search')}}">
                @csrf
                <div class="input-group col-sm-12 mt-1">
                    <input type="text" class="form-control form-control-sm" name="keyword" placeholder="بحث" />
                    <button class="btn bt-sm btn-outline-white" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </li>


        <!-- Right Side Of Navbar -->


        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @admin
                <a class="dropdown-item" href="{{route('dashboard')}}"><i class="fas fa-cog fa fw"></i>{{__('site.Dashboard')}}</a>
                @endadmin
                <a class="dropdown-item" href="{{ route('profile',Auth::user()->id) }}"><i class="far fa-user fa fw"></i>{{__('site.Profile')}}</a>
                <a class="dropdown-item" href="{{route('settings')}}"><i class="fas fa-cog fa fw"></i>{{__('site.Settings')}}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>