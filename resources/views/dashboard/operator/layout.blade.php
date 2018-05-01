@extends('layouts.common.dashboard')
@section('body')
    <div class="row">
        <div class="col-sm-3">
            <div class="user">
                <div class="user__info" data-toggle="dropdown">
                    <img class="user__img" src="{{ asset('img/assets/profile_pics_placeholder.jpg') }}" alt="">
                    <div>
                        <div class="user__name">{{ Auth::user()->name }}</div>
                        <div class="user__email">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <ul class="navigation">
				@if(Auth::user()->role == 1)
                <li class="{{ str_contains(request()->path(), 'home')?'navigation__active':'' }}"><a href="{{ route('operator.home') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                <li class="{{ str_contains(request()->path(), 'manage')?'navigation__active':'' }}"><a href="{{ route('operator.manage') }}"><i class="zmdi zmdi-storage"></i> Manage</a></li>
				@else
				<li class="{{ str_contains(request()->path(), 'administration')?'navigation__active':'' }}" ><a href="{{ route('operator.dashboard',Auth::user()->operator) }}"><i class="zmdi zmdi-desktop-mac"></i> Dashboard</a></li>
				<li class="{{ str_contains(request()->path(), 'manage_boat')?'navigation__active':'' }}"><a href="{{ route('operator.assign.boat',Auth::user()->operator) }}"> <i class="zmdi zmdi-boat"></i>Boats</a></li>
				<li class="{{ str_contains(request()->path(), 'users/manage')?'navigation__active':'' }}"><a href="{{ route('admin.manage',Auth::user()->operator) }}"><i class="zmdi zmdi-accounts"></i> Staff</a></li>
				<li class="{{ str_contains(request()->path(), 'trip')?'navigation__active':'' }}"><a href="{{ route('trip.home',Auth::user()->operator) }}"><i class="zmdi zmdi-swap"></i> Trips</a></li>
				@endif
			</ul>

        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection