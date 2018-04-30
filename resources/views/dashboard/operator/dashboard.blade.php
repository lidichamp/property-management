@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.operator_layout');
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-6 col-md-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\Boat::where('operator',$id)->where('active', 1)->count() }}</h2>
                    <small>Boats</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="quick-stats__item bg-light-green">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::where('operator',$id)->where('active', 1)->count() }}</h2>
                    <small>Users</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="quick-stats__item bg-red">
                <div class="quick-stats__info">
                    <h2>{{ \App\Jetty::where('operator',$id)->count() }}</h2>
                    <small>Jetties</small>
                </div>
            </div>
        </div>
		</div>
		<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"></h2>
                    <small class="card-subtitle"></small>
						{!! Charts::assets() !!}
                    {!! $chart->render() !!}
                </div>
                <div class="card-block">

                </div>
            </div>
        </div>
    </div>
@endsection
 {!! $chart->script() !!}
