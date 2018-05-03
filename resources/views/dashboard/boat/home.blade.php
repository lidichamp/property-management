@extends('dashboard.boat.layout')
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\Boat::count() }}</h2>
                    <small>All Boats</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-green">
                <div class="quick-stats__info">
                    <h2>{{ \App\Boat::where('active', 1)->count() }}</h2>
                    <small>Active Boats</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-red">
                <div class="quick-stats__info">
                    <h2>{{ \App\Boat::where('active', 0)->count() }}</h2>
                    <small>Inactive Boats</small>
                </div>
            </div>
        </div>
    </div>
	  <div class="col-sm-12">
	<div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
                            		{!! Charts::assets() !!}
                    {!! $chart->render() !!}
                        </div>
                    </div>
                </div>
				</div>
@endsection
 {!! $chart->script() !!}
