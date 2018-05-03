@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.layout');

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
							@foreach($trip_staff as $staff)
							<div class="col-sm-6">
							{{\App\User::find($staff->staff_id)->name}}
							</div>
							@endforeach
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