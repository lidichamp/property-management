@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.layout');

    @section('sub-body')
        <div class="row">
		<div class="col-sm-1">
		</div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add Passengers</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['trip.manage', $trip?$trip->id:null]]) !!}
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
                                {!! Form::text('name', $passenger?$passenger->name:null, ['class'=>'form-control']) !!}
                                <label>Passenger's Name</label>
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                {!! Form::text('kin_name', $passenger?$passenger->kin_name:null, ['class'=>'form-control']) !!}
                                <label>Next of Kin Name</label>
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                {!! Form::text('kin_phone', $passenger?$passenger->kin_phone:null, ['class'=>'form-control']) !!}
                                <label>Next of Kin Phone</label>
                                <i class="form-group__bar"></i>
                            </div>
							
							 <div class="form-group form-group--float">
                                <label>Age Range</label><br />
                                {!! Form::select('age_range', [1=>'under 10',2=>'10 to 20',3=>'above 20'], $passenger?$passenger->age_range:null,['class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
                      
                            <div class="form-group form-group--float">
                                {!! Form::text('phone', $passenger?$passenger->phone:null, ['class'=>'form-control']) !!}
                                <label>Passenger's Phone</label>
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Add to trip" class="btn btn-default waves-effect" />
                            </div>
                            
							
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
	<script>
	   <script>
        $(document).ready(function(){
            $('#depature_time')..datetimepicker({
                locale: {
                    format: 'DD/MM/YYYY HH:MM:SS'
                }
	</script>
@endpush