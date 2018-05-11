@extends(Auth::user()->role !=1 ? 'dashboard.operator.layout' : 'dashboard.admin.operator_layout');
    @section('sub-body')
        <div class="row">
             <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\Trip::where('status',0)->count() }}</h2>
                    <small>Created Trips</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-green">
                <div class="quick-stats__info">
                    <h2>{{ \App\Trip::where('status',1)->count() }}</h2>
                    <small>Ongoing Trips</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-red">
                <div class="quick-stats__info">
                    <h2>{{ \App\Trip::where('status',3)->count() }}</h2>
                    <small>Ended Trips</small>
                </div>
            </div>
        </div>
		  <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-yellow">
                <div class="quick-stats__info">
                    <h2>{{ \App\Trip::where('status',4)->count() }}</h2>
                    <small>Cancelled Trips</small>
                </div>
            </div>
        </div>
            <div class="col-sm-12">
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
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush