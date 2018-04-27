@extends('dashboard.project.sub_layout')
    @section('sub-sub-body')
        <div>
            <h4 class="card-block__title mb-4">About Project</h4>

            <dl class="row">
                {{--<dt class="col-sm-3 text-truncate">Project Type</dt>--}}
                {{--<dd class="col-sm-9">{{ $project->project_type ?: '-' }}.</dd>--}}

                <dt class="col-sm-3 text-truncate">Contractor REF</dt>
                <dd class="col-sm-9">{{ $project->contractor_reference ?: '-' }}.</dd>

                <dt class="col-sm-3 text-truncate">Managing Office</dt>
                <dd class="col-sm-9">{{ $project->office->name ?: '-' }}.</dd>

                <dt class="col-sm-3 text-truncate">Proposed Duration</dt>
                <dd class="col-sm-9">{{ $project->duration_months ?: '-' }} months.</dd>

                <dt class="col-sm-3 text-truncate">Budget</dt>
                <dd class="col-sm-9">{{ number_format($project->budget) ?: '-' }}</dd>

                <dt class="col-sm-3 text-truncate">Financials (%)</dt>
                @php
                    $p_financials = $project?$project->statuses->last():null;
                @endphp
                <dd class="col-sm-9">{{ is_object($p_financials)?$p_financials->financials_percentage: '-' }} %</dd>

                <dt class="col-sm-3 text-truncate">Start Date</dt>
                <dd class="col-sm-9">{{ \App\Core\Helpers::dbFriendlyToRoadZoftFriendlyDate($project->start_date) ?: '-' }}.</dd>

                <dt class="col-sm-3 text-truncate">Expected End Date</dt>
                <dd class="col-sm-9">{{ \App\Core\Helpers::dbFriendlyToRoadZoftFriendlyDate($project->end_date_estimate) ?: '-' }}.</dd>

                <dt class="col-sm-3 text-truncate">Current Status</dt>
                <dd class="col-sm-9">{{ $project->status }}.</dd>

                <dt class="col-sm-3 text-truncate">Project Completion Estimate (%)</dt>
                <dd class="col-sm-9">{{ $project->completion_estimate }} %</dd>
            </dl>

            <div class="card card-outline-primary">
                <div class="card-header">
                    <h2 class="card-title">Project Description</h2>
                    <small class="card-subtitle">Scope of Work</small>
                </div>
                <div class="card-block">
                    <p class="card-text">{!! $project->description ?: '-' !!}</p>
                </div>
            </div>
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h2 class="card-title">Project Impact</h2>
                </div>
                <div class="card-block">
                    <p class="card-text">{!! $project->impact ?: '-' !!}</p>
                </div>
            </div>
            <div class="card card-outline-info">
                <div class="card-header">
                    <h2 class="card-title">Project Note</h2>
                    {{--<small class="card-subtitle">Praesent commodo cursus magna scelerisque consectetur.</small>--}}
                </div>
                <div class="card-block">
                    <p class="card-text">{{ $project->note ?: '-' }}</p>
                </div>
            </div>

        </div>

    @endsection