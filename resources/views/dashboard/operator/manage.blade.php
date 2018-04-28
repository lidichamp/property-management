@extends('dashboard.operator.layout')
    @section('sub-body')
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add/Edit An Operator</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['operator.save', $operator?$operator->id:null]]) !!}
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

                            <div class="form-group form-group--float">
                                {!! Form::text('name', $operator?$operator->name:null, ['class'=>'form-control']) !!}
                                <label>Name</label>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group form-group--float">
                                {!! Form::text('cac', $operator?$operator->cac:null, ['class'=>'form-control']) !!}
                                <label>CAC Registration Number</label>
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                {!! Form::text('registered_name', $operator?$operator->registered_name:null, ['class'=>'form-control']) !!}
                                <label>Registered Name</label>
                                <i class="form-group__bar"></i>
                            </div>
                            
                            <div class="form-group form-group--float">
							 <label>Registration Date</label><br>
                                {!! Form::date('registration_date', $operator?$operator->registration_date:null, ['class'=>'form-control']) !!}
                               
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Add /Edit operator" class="btn btn-default waves-effect" />
                            </div>
                            @if($operator)
                                <p class="text-right">This operator is currently <strong>{{ $operator->active?'Active':'Disabled' }}</strong></p>
                                <hr>
                                <p class="text-right text-danger"><a href="{{ route('operator.manage') }}" class="text-danger">cancel edit here</a></p>
                            @endif

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">

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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush