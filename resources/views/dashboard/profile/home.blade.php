@extends('dashboard.profile.layout')
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::getRoleName($found_user->role) }}</h2>
                    <small>Role</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\Office::getName($found_user->office) }}</h2>
                    <small>Office</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2><small>{{ $found_user->created_at }}</small></h2>
                    <small>Admin Since</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ $found_user->monitoring->count() }}</h2>
                    <small>Monitoring</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ $found_user->project->count() }}</h2>
                    <small>Projects Managed</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ $found_user->project_status->count() }}</h2>
                    <small>Projects Status Updated</small>
                </div>
            </div>
        </div>

        @php
            $mobile_auth = \App\User::mobile_auth($found_user->id);
        @endphp
        <div class="col-sm-6">
            <div class="quick-stats__item bg-orange">
                <div class="quick-stats__info">
                    <h2>{{ $mobile_auth->last()?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $mobile_auth->last()->created_at)->diffForHumans():'None' }}</h2>
                    <small>Last Login on mobile</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="quick-stats__item bg-orange">
                <div class="quick-stats__info">
                    <h2>{{ $found_user->monitoring->last()?\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $found_user->monitoring->last()->created_at)->diffForHumans():'None' }}</h2>
                    <small>Last monitoring submitted</small>
                </div>
            </div>
        </div>

    </div>
@endsection
