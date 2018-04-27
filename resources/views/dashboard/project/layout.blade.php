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
                <li class="{{ str_contains(request()->path(), 'new') || str_contains(request()->path(), 'edit')?'navigation__active':'' }}"><a href="{{ route('projects.new') }}"><i class="zmdi zmdi-save"></i> Add/Edit</a></li>
                <li class="{{ str_contains(request()->path(), 'manage')?'navigation__active':'' }}"><a href="{{ route('projects.manage') }}"><i class="zmdi zmdi-storage"></i> Manage</a></li>
                <li class="{{ str_contains(request()->path(), 'report')?'navigation__active':'' }}"><a href="{{ route('projects.report.all') }}"><i class="zmdi zmdi-collection-pdf"></i> Report & Evaluation</a></li>
                <li class="{{ str_contains(request()->path(), 'monitoring')?'navigation__active':'' }}"><a href="{{ route('projects.live.monitoring') }}"><i class="zmdi zmdi-globe"></i> Map Monitoring</a></li>
            </ul>

        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>
@endpush