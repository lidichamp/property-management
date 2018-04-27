@extends('dashboard.project.layout')
    @section('sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Filter Projects</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['projects.manage'], 'method'=>'get']) !!}
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Region</label>
                                        {!! Form::select('region', array_merge([''=>'All'], $regions), null, ['class'=>'select2 select2-hidden-accessible', 'tabindex'=>'-1', 'aria-hidden'=>'true']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Office Incharge</label>
                                        {!! Form::select('office', array_merge([''=>'All'], $offices), null, ['class'=>'select2 select2-hidden-accessible', 'tabindex'=>'-1', 'aria-hidden'=>'true']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Project Type</label>
                                        {!! Form::select('project_type', array_merge([''=>'All'], $project_types), null, ['class'=>'select2 select2-hidden-accessible', 'tabindex'=>'-1', 'aria-hidden'=>'true']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Project Status</label>
                                        {!! Form::select('status', array_merge([''=>'All'], $project_status), null, ['class'=>'select2 select2-hidden-accessible', 'tabindex'=>'-1', 'aria-hidden'=>'true']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Search projects by title or description</label>
                                        {!! Form::text('keyword', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card-block center-block text-left align-content-center">
                                        <input type="submit" value="Filter Result" class="btn btn-primary waves-effect" />
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    {{--<div class="card-header">--}}
                        {{--<h2 class="card-title">Manage Offices</h2>--}}
                        {{--<small class="card-subtitle"></small>--}}
                    {{--</div>--}}

                    <div class="card-block">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@push('styles')
    <link href="{{ asset('datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush