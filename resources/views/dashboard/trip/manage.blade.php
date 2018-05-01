@extends(Auth::trip()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.layout');

    @section('sub-body')
        <div class="row">
		<div class="col-sm-1">
		</div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Create Trip</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['trip.home', $trip?$trip->id:null]]) !!}
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
                                <label>Depature Type</label><br />
                                {!! Form::select('depature_type', ['Depart When full','Depart at Exact Time'], $trip?$trip->depature_type:null,['placeholder'=>'choose a depature jetty ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							<div class="form-group form-group--float">
                                <label>From Jetty</label><br />
                                {!! Form::select('from_jetty', \App\Jetty::getJetty(), $trip?$trip->from_jetty:null, ['placeholder'=>'choose a depature jetty ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
							<div class="form-group form-group--float">
                                <label>To Jetty</label><br />
                                {!! Form::select('to_jetty', \App\Jetty::getJetty(), $trip?$trip->to_jetty:null, ['placeholder'=>'choose an arrival jetty ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                <label>Boat</label><br />
                                {!! Form::select('boat', \App\Boat::getBoat(), $trip?$trip->boat:null, ['class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
							<div class="form-group form-group--float">
                                <label>Depature Time</label><br />
                                  {!! Form::date('depature_time', $trip?$trip->depature_time:null, ['class'=>'form-control']) !!}
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Invite/Update" class="btn btn-default waves-effect" />
                            </div>
                            @if($trip)
                                <p class="text-right">User access is currently <strong>{{ $trip->active?'Active':'Disabled' }}</strong></p>
                                <hr>
                                <p class="text-right text-danger"><a href="{{ route('admin.manage') }}" class="text-danger">cancel edit here</a></p>
                            @endif

                        {!! Form::close() !!}
                    </div>
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

@endpush