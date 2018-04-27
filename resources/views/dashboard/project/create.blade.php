@extends('dashboard.project.layout')
@section('sub-body')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ config('roadzoft.client') }} Project {!! $project?': <span class="text-success">'.$project->title.'</span>':'' !!}</h2>
                    <div class="card-subtitle text-center">
                        @if($project)
                            <hr>
                            <a class="btn btn-warning btn--icon-text waves-effect" href="{{ route('projects.view', $project->id) }}"><i class="zmdi zmdi-arrow-back"></i> Back</a>
                            <a class="btn btn-info btn--icon-text waves-effect" href="{{ route('projects.edit', $project->id) }}"><i class="zmdi zmdi zmdi-refresh"></i> Refresh</a>
                            <hr>
                        @endif
                    </div>
                </div>

                <div class="card-block">
                    {!! Form::open(['route'=>['projects.save', $project?$project->id:null]]) !!}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(old('success'))
                        <div class="alert alert-success text-center">Request was Successful</div>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon">Select Office in-Charge (Reporting to:)</span>
                        <div class="form-group">
                            {!! Form::select('office_id', $offices, $project?$project->office_id:null, ['class'=>'select2']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    @if(config('roadzoft.pdms'))
                        <div class="input-group">
                            <span class="input-group-addon">PDMS Linkage ID</span>
                            <div class="form-group">
                                {!! Form::text('pdms_id', $project?$project->pdms_id:null, ['class'=>'form-control']) !!}
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                    @endif
                    <div class="input-group">
                        <span class="input-group-addon">Project REF </span><span class="text-danger">*</span>
                        <div class="form-group">
                            {!! Form::text('ref', $project?$project->ref:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Project Title </span><span class="text-danger">*</span>
                        <div class="form-group">
                            {!! Form::text('title', $project?$project->title:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group {{ $project?'hidden':'' }}">
                        <span class="input-group-addon">Project Status </span><span class="text-danger">*</span>
                        <div class="form-group">
                            {!! Form::select('status', $project_status, $project?$project->status:null, ['class'=>'select2']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon">Project Completion Estimate (%) </span><span class="text-danger">*</span>--}}
                        {{--<div class="form-group">--}}
                            {{--{!! Form::text('completion_estimate', $project?$project->completion_estimate:'0.00', ['class'=>'form-control']) !!}--}}
                            {{--<i class="form-group__bar"></i>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="input-group">
                        <span class="input-group-addon">Project Kind (Road, Infrastucture, Vegetation and etc)</span>
                        <div class="form-group">
                            {!! Form::text('project_kind', $project?$project->project_kind:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Financial Budget</span>
                        <div class="form-group">
                            {!! Form::text('budget', $project?$project->budget:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    @if(is_null($project))
                        <div class="col-sm-12 mt-2">
                            <h4 class="card-block__title">Project Completion Estimate (%)</h4>

                            <div id="input-slider"></div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        {!! Form::text('completion_estimate', $project?$project->completion_estimate:'0.00', ['class'=>'form-control', 'id'=>'input-slider-value']) !!}
                                        <i class="form-group__bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="input-group">
                        <div class="form-group">
                            <label>Project Description (Scope of Work) <sup class="text-danger">*</sup></label>
                            {!! Form::textarea('description', $project?$project->description:null, ['class'=>'form-control',
                            'placeholder'=>'', 'rows'=>'4']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label>Project Impact <sup class="text-danger">*</sup></label>
                            {!! Form::textarea('impact', $project?$project->impact:null, ['class'=>'form-control',
                            'placeholder'=>'', 'rows'=>'3']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label>Physical (Quantity of work done)</label>
                            {!! Form::textarea('work_done', $project?$project->work_done:null, ['class'=>'form-control',
                            'placeholder'=>'', 'rows'=>'3']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="form-group">
                            <label>Project Note (Internal)</label>
                            {!! Form::textarea('note', $project?$project->note:null, ['class'=>'form-control',
                            'placeholder'=>'', 'rows'=>'3']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12 alert alert-info">
                            If project is executed within a state; Select same state as start and end state<br/>
                            If project crosses states border; Specify the start state and end state
                        </div>
                        <div class="col-sm-6">
                            <label>Start State</label>

                            <div class="input-group">
                                <span class="input-group-addon">Start</span>
                                <div class="form-group">
                                    {!! Form::select('state_start', $states, $project?$project->state_start:null, ['class'=>'select2']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>End State</label>

                            <div class="input-group">
                                <span class="input-group-addon">End</span>
                                <div class="form-group">
                                    {!! Form::select('state_end', $states, $project?$project->state_end:null, ['class'=>'select2']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                    </div><hr/><br />
                    <div class="input-group">
                        <span class="input-group-addon">Project Type</span><span class="text-danger">*</span>
                        <div class="form-group">
                            {!! Form::select('project_type', $project_types, $project?$project->project_type:null, ['class'=>'select2']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Distance Estimate (km) </span>
                        <div class="form-group">
                            {!! Form::number('km_estimate', $project?$project->km_estimate:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Contractor REF </span><span class="text-danger">*</span>
                        <div class="form-group">
                            {!! Form::text('contractor_reference', $project?$project->contractor_reference:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Project Duration (Months)</span>
                        <div class="form-group">
                            {!! Form::number('duration_months', $project?$project->duration_months:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12 alert alert-info">
                            (Optional) Specify Start data and Estimated end date of this project.
                        </div>
                        <div class="col-sm-6">
                            <label>Start Date</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="form-group">
                                    {!! Form::text('start_date', $project?\App\Core\Helpers::dbFriendlyToRoadZoftFriendlyDate($project->start_date):null, ['class'=>'form-control date-picker flatpickr-input', 'readonly']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Estimated End Date</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                <div class="form-group">
                                    {!! Form::text('end_date_estimate', $project?\App\Core\Helpers::dbFriendlyToRoadZoftFriendlyDate($project->end_date_estimate):null, ['class'=>'form-control date-picker flatpickr-input', 'readonly']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                    </div><hr/><br />

                    <div class="input-group">
                        <span class="input-group-addon">Road REF </span>
                        <div class="form-group">
                            {!! Form::text('road', $project?$project->road:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Route REF </span>
                        <div class="form-group">
                            {!! Form::text('route', $project?$project->route:null, ['class'=>'form-control']) !!}
                            <i class="form-group__bar"></i>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-sm-12 alert alert-info">
                            (Optional) Enter the longitude and latitude of area where the project is.
                        </div>
                        <div class="col-sm-6">
                            <label>Latitude</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
                                <div class="form-group">
                                    {!! Form::text('latitude', $project?\App\Core\Helpers::parseGeolocationPoint($project->location)['latitude']:null, ['class'=>'form-control']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Longitude</label>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-map"></i></span>
                                <div class="form-group">
                                    {!! Form::text('longitude', $project?\App\Core\Helpers::parseGeolocationPoint($project->location)['longitude']:null, ['class'=>'form-control']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                    </div><hr/><br />
                    <div class="card-block center-block text-center align-content-center">
                        <input type="submit" value="Save Project" class="btn btn-default waves-effect" />
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush