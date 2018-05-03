@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.operator_layout');

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
                

                            <div class="form-group form-group--float">
                                <label>Depature Type</label><br />
                               {{$trip->departure_type}} <i class="form-group__bar"></i>
                            </div>
							<div class="form-group form-group--float">
                                <label>From Jetty</label><br />
                               {{$trip->from_jetty}}
							   <i class="form-group__bar"></i>
                            </div>
							
							<div class="form-group form-group--float">
                                <label>To Jetty</label><br />
                                {{$trip->to_jetty}}
								<i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                <label>Boat</label><br />
                                {{$trip->boat}}
                                <i class="form-group__bar"></i>
                            </div>
							
							 
                           
							<div class="form-group form-group--float">
                                <label>Depature Time</label><br />
                                  {{$trip->departure_time}}
								  <i class="form-group__bar"></i>
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