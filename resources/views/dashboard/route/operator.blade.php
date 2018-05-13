@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.route.layout');

    @section('sub-body')
        <div class="row">
		<div class="col-sm-1">
		</div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Assign Operator to Route ( {{App\Route::find(request()->route('id'))->first()->name}})</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['route.save.operator',request()->route('trip_id')]]) !!}
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
                                <label>Operator</label><br />
                                {!! Form::select('operator', \App\Operator::getOperators(),[ ], ['class'=>'select2']) !!} 
								<i class="form-group__bar"></i>
                            </div>
							
                      {!! Form::hidden('route',request()->route('id'))!!}
			  <div class="row">
			   <a href="{{ route('route.manage') }}" class="col-sm-4">
						<button class="btn btn-warning "type="button"> << Back to Routes</button>
						</a>
						<div class="col-sm-4"></div>
                                <button type="submit" class="btn btn-success waves-effect col-sm-4"><b>+</b> Assign to Route</button>
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