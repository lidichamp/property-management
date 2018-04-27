@extends('dashboard.project.layout')
@section('sub-body')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                <h2 class="card-title">Reporting and Evaluation of projects</h2>
                <small class="card-subtitle">
                    <div class="form-group">
                        <label>Report Date Range</label>
                        {!! Form::text('date_between', null, ['class'=>'form-control', 'id'=>'daterangepicker']) !!}
                    </div>
                </small>
                </div>

                <div class="card-block">
                    <div class="row quick-stats">
                        <div class="col-sm-6">
                            <div class="quick-stats__item bg-light-blue">
                                <div class="quick-stats__info">
                                    <h2>-</h2>
                                    <small>-</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="quick-stats__item bg-light-blue">
                                <div class="quick-stats__info">
                                    <h2>-</h2>
                                    <small>-</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endpush
@push('scripts')
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
@endpush