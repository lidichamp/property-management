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
			
				<li class="{{ str_contains(request()->path(), 'administration')?'navigation__active':'' }}" ><a href="{{ route('operator.dashboard',Auth::user()->operator) }}"><i class="zmdi zmdi-desktop-mac"></i> Dashboard</a></li>
				<li class="{{ str_contains(request()->path(), 'manage_boat')?'navigation__active':'' }}"><a href="{{ route('operator.assign.boat',Auth::user()->operator) }}"> <i class="zmdi zmdi-boat"></i>Boats</a></li>
				<li class="{{ str_contains(request()->path(), 'users/manage')?'navigation__active':'' }}"><a href="{{ route('admin.manage',Auth::user()->operator) }}"><i class="zmdi zmdi-accounts"></i> Staff</a></li>
				<li class="{{ str_contains(request()->path(), 'trips')?'navigation__active':'' }}"><a href="{{ route('operator.assign.boat',Auth::user()->operator) }}"><i class="zmdi zmdi-swap"></i> Trips</a></li>
			
			</ul>
			   <div class="user">
                <div class="user__info" data-toggle="dropdown">
				<img class="user__img" src="{{ asset('img/assets/operator.jpg') }}" alt="">
                    <div>
                        <div class="user__name">{{ \App\Operator::find(request()->route('id'))->name }}</div>
                        <div class="user__email">{{ \App\Operator::find(request()->route('id'))->cac }}</div>
						<div class="user__email">{{ \App\Boat::where('operator',request()->route('id'))->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection