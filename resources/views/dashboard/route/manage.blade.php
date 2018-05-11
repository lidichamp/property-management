@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.route.layout');

    @section('sub-body')
        <div class="row">
		<div class="col-sm-1">
		</div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Create Route</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['route.add_update', $route?$route->id:null]]) !!}
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
                                <label>Name</label><br />
                                {!! Form::text('name', $route?$route->name:null,['class'=>'form-control']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							<div class="form-group form-group--float">
                                <label>From Jetty</label><br />
                                {!! Form::select('from_jetty', \App\Jetty::getJetty(), $route?$route->from_jetty:null, ['placeholder'=>'choose a depature jetty ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
							<div class="form-group form-group--float">
                                <label>To Jetty</label><br />
                                {!! Form::select('to_jetty', \App\Jetty::getJetty(), $route?$route->to_jetty:null, ['placeholder'=>'choose an arrival jetty ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                <label>Refrence Number</label><br />
                                {!! Form::text('ref' ,$route?$route->ref:null,['class'=>'form-control']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
							 <div class="form-group form-group--float">
                                <label>Estimated Distance in Km</label><br />
                                {!! Form::number('km_estimate', $route?$route->km_estimate:null, ['class'=>'form-control']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							
                                {!! Form::hidden('creator',Auth::user()->id) !!}
                           
							<div class="form-group form-group--float">
                                <label>Note</label><br />
                                 {!! Form::text('note', $route?$route->note:null, ['class'=>'form-control']) !!}
                             <i class="form-group__bar"></i>
                            </div>
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Invite/Update" class="btn btn-default waves-effect" />
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
        $(document).ready(function(){
            $('#depature_time').datetimepicker({
                locale: {
                   language: 'pt-BR'
                }
				
});
	</script>
@endpush