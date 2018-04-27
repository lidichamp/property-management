@extends('dashboard.jetty.layout')
    @section('sub-body')
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add/Edit A Jetty</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['jetty.save', $jetty?$jetty->id:null]]) !!}
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
                                {!! Form::text('name', $jetty?$jetty->name:null, ['class'=>'form-control']) !!}
                                <label>Name</label>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group form-group--float">
							<label>Address</label>
							<br>
                                {!! Form::text('address', $jetty?$jetty->address:null, ['class'=>'form-control','autocomplete'=>'on' ,'runat'=>'server','id'=>'address']) !!}
                                
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                {!! Form::hidden('latitude', $jetty?$jetty->latitude:null, ['class'=>'form-control','id'=>'latitude']) !!}
                               
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group form-group--float">
                                {!! Form::hidden('longitude', $jetty?$jetty->longitude:null, ['class'=>'form-control','id'=>'longitude']) !!}
                                
                                <i class="form-group__bar"></i>
                            </div>
                           
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Add /Edit Jetty" class="btn btn-default waves-effect" />
                            </div>
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
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdPuT9tawnuhygYPncDc6RVAbXB3DYXI0&libraries=places"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('address');
		var options = {
  componentRestrictions: {country: 'nga'}
};

        var autocomplete = new google.maps.places.Autocomplete(input,options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();


        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush