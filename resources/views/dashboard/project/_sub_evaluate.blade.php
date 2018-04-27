@extends('dashboard.project.sub_layout')
    @section('sub-sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Project Reviews</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['projects.evaluators', $project->id], 'method'=>'get']) !!}
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Date Range</label>
                                    {!! Form::text('date_between', null, ['class'=>'form-control', 'id'=>'daterangepicker']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card-block center-block text-left align-content-center">
                                    <input type="submit" value="Filter Result" class="btn btn-primary waves-effect" />
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush
@push('scripts')
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script>
        $(document).ready(function(){
            $('#daterangepicker').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                startDate: '{{ \App\Core\Helpers::dbFriendlyToPickerDate($project->start_date) }}',
                endDate: '{{ date('d/m/Y') }}'
            });
        });
    </script>
@endpush