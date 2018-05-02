@extends('layouts.common.dashboard')
    @section('body')
        
        <div class="col-sm-12">
            <div class="card widget-visitors">
                <div class="card-header pull-right">
                    <div class="card-title pull-right">
                        <div class="form-group">
                            <label>Analytic Date Range</label>
                            {!! Form::text('date_between', null, ['class'=>'form-control', 'id'=>'daterangepicker']) !!}
                        </div>
                    </div>
                </div>

                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
                            {!! $chart->html() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    @endsection
@push('styles')
    {{--<link href='https://api.mapbox.com/mapbox-gl-js/v0.42.0/mapbox-gl.css' rel='stylesheet' />--}}
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    {!! Charts::styles() !!}
@endpush
@push('scripts_header')
    {{--<script src='https://api.mapbox.com/mapbox-gl-js/v0.42.0/mapbox-gl.js'></script>--}}
@endpush
@push('scripts')
    {!! Charts::scripts() !!}
    {!! $chart->script() !!}
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script>
        $(document).ready(function(){
            $('#daterangepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                startDate: '{{ $date_from }}',
                endDate: '{{ $date_to }}'
            });
            $('#daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                location.href = '{{ request()->getBaseUrl() }}?start='+picker.startDate.format('DD/MM/YYYY')+
                    '&end='+picker.endDate.format('DD/MM/YYYY');
                // console.log(picker.startDate.format('YYYY-MM-DD'));
                // console.log(picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>
    {{--<script>--}}
        {{--mapboxgl.accessToken = 'pk.eyJ1IjoibG9mdHlpbmMiLCJhIjoiY2piemp1dHY1M2tpeTJxcWhrYm4ycWI0YiJ9.oba3jiSSLGhWk7hq0nXzsA';--}}
        {{--var map = new mapboxgl.Map({--}}
            {{--container: 'map',--}}
            {{--style: 'mapbox://styles/mapbox/satellite-streets-v10'--}}
        {{--});--}}
    {{--</script>--}}
@endpush
