@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.operator_layout');

    @section('sub-body')
        <div class="row">
		<div class="col-sm-1">
		</div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Trip</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                

                            <div class="form-group form-group--float">
							<div class="row">
							<div class="col-sm-6">
                                <label>Depature Type: 
                               @if($trip->departure_type==1)
							    Depart When full
							   @elseif($trip->departure_type==2)
							    Depart at Exact Time
							   @endif </label><br />
							   <br/>
							   </div>
							<div class="col-sm-6">
							<label>From Jetty: {{\App\Jetty::find($trip->from_jetty)->name}} </label><br />
								
                               <br/>
							   
							   </div>
                            </div>
							
							
							<div class="row">
							<div class="col-sm-6">
                                <label>To Jetty: {{\App\Jetty::find($trip->to_jetty)->name}} </label><br />
                                
								
                            </div>
							<div class="col-sm-6">
                                <label>Boat</label><br />
								<br/>
                            </div>
							</div>
							
							 
                           
							<div class="row">
							<div class="col-sm-6">
                                <label>Depature Time</label><br />
                                  {{$trip->departure_time}}
								  <i class="form-group__bar"></i>
                            </div>
							</div>
							
							<div class="row">
							<div class="col-sm-4">
							</div>
							<div class="col-sm-4">
							STAFF ON BOARD
							
							</div>
							
							<div class="col-sm-4">
							</div>
							<div class="col-sm-12">
							<hr/>
							</div>
							<div class="col-sm-12">
							<ol>
							@foreach($trip_staff as $staff)
							<li>
							<div class="col-sm-10">
							{{\App\User::find($staff->staff_id)->name}} - 
							   
							{{\App\User::getRoleName(\App\User::find($staff->staff_id)->role)}}
							</div>
							</li>
							@endforeach
							<ol>
							</div>
                          </div>
						  <div class="row">
							<div class="col-sm-4">
							</div>
							<div class="col-sm-6">
							PASSENGERS ON BOARD
							
							</div>
							
							<div class="col-sm-2">
							</div>
							<div class="col-sm-12">
							<hr/>
							</div>
							<div class="col-sm-2">
							<b>S/N</b>
							</div>
							<div class="col-sm-4">
							<b>Passenger Name</b>
							</div>
								<div class="col-sm-3">
							<b>Passenger Telephone</b>
							</div>
								<div class="col-sm-3">
							<b>Next of Kin Contact</b>
							</div>
							@foreach($trip_passenger as $passenger)
							<div class="col-sm-2">
							{{$sn++}}
							</div>
							<div class="col-sm-4">
							{{\App\Passenger::find($passenger->passenger_id)->name}}
						
							</div>
							<div class="col-sm-3">
							{{\App\Passenger::find($passenger->passenger_id)->phone}}
							</div>
							<div class="col-sm-3">
							{{\App\Passenger::find($passenger->passenger_id)->kin_phone}}
							</div>
							
							@endforeach
							
                          </div>
						
						  
            </div>
			  <div class="row">
			   <a href="{{ route('trip.overview',request()->route('id')) }}" class="col-sm-4">
						<button class="btn btn-warning ">Back to Trip</button>
						</a>@if($trip->status==0)
						 <a href="{{  route('trip.start', $trip->id) }}" class="col-sm-4">
						<button class="btn btn-success">Start Trip</button>
						</a>
						@elseif($trip->status==1)
						 <a href="{{  route('trip.complete', $trip->id) }}" class="col-sm-4">
						 <button class="btn btn-danger ">
						End Trip
						</button>
						</a>
							@else
								<div class="col-sm-4"></div>
						@endif
						<a href="{{  route('trip.passenger',[request()->route('id'),request()->route('trip_id')]) }}" class="col-sm-4">
						<button class="btn btn-primary ">
						Add Passengers
						</button>
						</a>
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