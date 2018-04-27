@extends('layouts.common.dashboard')
    @section('body')
        {{--<header class="content__title">--}}
            {{--<h1>Analytics</h1>--}}
            {{--<small>For the <strong>Month</strong> of <strong>January 2018</strong></small>--}}

            {{--<div class="actions">--}}

                {{--<div class="dropdown actions__item">--}}
                    {{--<i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>--}}
                    {{--<div class="dropdown-menu dropdown-menu-right">--}}
                        {{--<a href="" class="dropdown-item active">This Month, {{ date('M,  Y') }}</a>--}}
                        {{--<a href="" class="dropdown-item">This Year {{ date('Y') }}</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</header>--}}
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

        {{--<div class="row quick-stats">--}}
            {{--<div class="col-sm-6 col-md-3">--}}
                {{--<div class="quick-stats__item bg-light-blue">--}}
                    {{--<div class="quick-stats__info">--}}
                        {{--<h2>987,459</h2>--}}
                        {{--<small>Total Website Traffics</small>--}}
                    {{--</div>--}}

                    {{--<div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-sm-6 col-md-3">--}}
                {{--<div class="quick-stats__item bg-amber">--}}
                    {{--<div class="quick-stats__info">--}}
                        {{--<h2>356,785K</h2>--}}
                        {{--<small>Total Website Impressions</small>--}}
                    {{--</div>--}}

                    {{--<div class="quick-stats__chart sparkline-bar-stats">4,7,6,2,5,3,8,6,6,4,8,6</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-sm-6 col-md-3">--}}
                {{--<div class="quick-stats__item bg-purple">--}}
                    {{--<div class="quick-stats__info">--}}
                        {{--<h2>$58,778</h2>--}}
                        {{--<small>Total Total Sales</small>--}}
                    {{--</div>--}}

                    {{--<div class="quick-stats__chart sparkline-bar-stats">9,4,6,5,6,4,5,7,9,3,6,5</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-sm-6 col-md-3">--}}
                {{--<div class="quick-stats__item bg-red">--}}
                    {{--<div class="quick-stats__info">--}}
                        {{--<h2>214</h2>--}}
                        {{--<small>Total Support Tickets</small>--}}
                    {{--</div>--}}

                    {{--<div class="quick-stats__chart sparkline-bar-stats">5,6,3,9,7,5,4,6,5,6,4,9</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                    {{--<div class="card widget-visitors">--}}
                        {{--<div class="card-header">--}}
                            {{--<h2 class="card-title">Data Overview</h2>--}}
                        {{--</div>--}}

                        {{--<div class="card-block">--}}


                            {{--<div id='map' style='width: 100%; height: 500px;'></div>--}}
                            {{--<div class="widget-visitors__map map-visitors">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

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
