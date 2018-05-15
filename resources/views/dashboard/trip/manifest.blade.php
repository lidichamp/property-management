@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.operator_layout');

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
                        {!! Form::open(['route'=>['trip.passenger.save',request()->route('trip_id')]]) !!}
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
                                <div class="alert alert-success text-center">Passenger added to the manifest</div>
                            @endif
							
                       <div class="form-group form-group--float">
                                <label>Passenger</label><br />
                                {!! Form::select('passenger_id', \App\Passenger::getPassenger(), [], ['placeholder'=>' ','class'=>'select2']) !!}
                                {{ Form::hidden('trip_id', 'secret')}}
								<i class="form-group__bar"></i>
                            </div>
							<div class="row">
			   <a href="{{ route('trip.overview',request()->route('id')) }}" class="col-sm-4">
						<button class="btn btn-warning" type="button"><b><<</b> Back to Trip</button>
						</a>
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-success waves-effect"><b>+</b> Add to Trip</button>
                            </div>
                            </div>
							
                        {!! Form::close() !!}
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