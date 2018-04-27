@extends('dashboard.project.layout')
@section('sub-body')
    <section class="row">
        <div class="col-sm-12">
            @if($project)
                <header class="content__title text-center">
                    <h1><strong>{{ $project->title }}</strong></h1>
                    <p>GEO - <strong>{!! \App\Core\Helpers::convertPointsToDegree($project->location) !!} </strong> </p>
                </header>

                <div class="profile" style="margin-bottom: 10px;">
                    <div class="profile__img col-sm-5">
                        <div class="card widget-ratings">
                            <div class="card-header text-center">
                                @php
                                    $index=0;
                                    $loop_pick=0;
                                    $total = 5;
                                    $average_rating = $project->getAverageRating();
                                    $rating_grouping = $project->getCountRatingContributors();
                                @endphp
                                <h2 class="card-title">Project Rating <strong>{{ $average_rating }}</strong></h2>

                                <div class="widget-ratings__star">
                                    @while($index < $total)
                                        <i class="zmdi zmdi-star {{ $loop_pick<intval($average_rating)?'active':'' }}"></i>
                                        @php
                                            $index++;
                                            $loop_pick++;
                                        @endphp
                                    @endwhile
                                </div>
                            </div>

                            <div class="card-block">

                                @foreach($rating_grouping as $key=>$value)
                                    <div class="widget-ratings__item">
                                        <div class="float-left">{{ $key }} <i class="zmdi zmdi-star"></i></div>
                                        <div class="float-right">{{ $value['count'] }}</div>

                                        <div class="widget-ratings__progress">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $value['percent'] }}%;" aria-valuenow="{{ $value['percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                    <div class="profile__info col-sm-7" style="padding: 42px;">
                        <div id="bg-googlemaps"></div>
                        <div id="project-details-content">

                            <dl class="row">
                                <dt class="col-sm-4">State</dt>
                                <dd class="col-sm-8">{{ $project->state_start == $project->state_end?'in '.$project->state_start:$project->state_start.' - '.$project->state_end }}.</dd>

                                <dt class="col-sm-4">Region</dt>
                                <dd class="col-sm-8">{{ $project->region_start == $project->region_end?'in '.$project->region_start:$project->region_start.' - '.$project->region_end }}.</dd>

                                <dt class="col-sm-4 text-truncate">Distance Estimate</dt>
                                <dd class="col-sm-8">{{ $project->km_estimate ?: '-' }} km.</dd>

                                <dt class="col-sm-4 text-truncate">Project Type</dt>
                                <dd class="col-sm-8">{{ $project->project_type ?: '-' }}.</dd>

                                <dt class="col-sm-4 text-truncate">Last Updated</dt>
                                <dd class="col-sm-8">{{ $project->updated_at ?: '-' }} <small><em>by</em> {{ $project->user->name }}.</small></dd>

                                @if(config('roadzoft.pdms'))
                                    <dt class="col-sm-4 text-truncate"><i class="zmdi zmdi-link"></i> PDMS</dt>
                                    <dd class="col-sm-8"><a href="">click me</a> </dd>
                                @endif

                                <dt class="col-sm-12 text-center">
                                    <a target="_blank" href="https://www.google.com/maps/?q={{ $project->location }}"><i class="zmdi zmdi-map"></i> view on google map</a>
                                </dt>

                            </dl>
                        </div>
                        {{--<ul class="icon-list">--}}
                        {{--<li><i class="zmdi zmdi-phone"></i> 308-360-8938</li>--}}
                        {{--<li><i class="zmdi zmdi-email"></i> malinda@inbound.plus</li>--}}
                        {{--<li><i class="zmdi zmdi-twitter"></i> @mallinda-hollaway</li>--}}
                        {{--</ul>--}}
                    </div>
                </div>

                <div class="toolbar">
                    <nav class="toolbar__nav">
                        <a class="{{ !str_contains(request()->path(), 'monitors') && !str_contains(request()->path(), 'evaluators') && !str_contains(request()->path(), 'history')?'active':'' }}" href="{{ route('projects.view', $project->id) }}">About</a>
                        <a class="{{ str_contains(request()->path(), 'monitors')?'active':'' }}" href="{{ route('projects.monitors', $project->id) }}">Monitoring</a>
                        <a class="{{ str_contains(request()->path(), 'evaluators')?'active':'' }}" href="{{ route('projects.evaluators', $project->id) }}">Reviews</a>
                        <a class="{{ str_contains(request()->path(), 'history')?'active':'' }}" href="{{ route('projects.status.history', $project->id) }}">History</a>
                        <a class="{{ str_contains(request()->path(), 'report')?'active':'' }}" href="{{ route('projects.report.all', $project->id) }}">Report</a>
                        <a class="text-warning" href="{{ route('projects.edit', $project->id) }}"><i class="zmdi zmdi-edit zmdi-hc-fw"></i> Edit</a>
                        <a class="text-info" href="{{ back()->getTargetUrl() }}"><i class="zmdi zmdi-arrow-back"></i> Back</a>
                    </nav>

                    <div class="actions" style="width:150px">
                        <button type="button" id="change-status" class="btn btn-primary waves-effect pull-right" data-toggle="button" aria-pressed="false" autocomplete="off">
                            Update Project Status
                        </button>
                        {{--{!! Form::select('status', array_combine(\App\Core\ProjectAttributes::getStatus(), \App\Core\ProjectAttributes::getStatus()), $project->status, ['class'=>'form-control', 'id'=>'change-status']) !!}--}}
                        {{--<i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>--}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-block">
                        @yield('sub-sub-body')
                    </div>
                </div>
            @else
                <header class="content__title">
                    <h1>Not Found</h1>
                    <small>Project could not be found or located at the moment. It has either been removed or locked</small>
                </header>
            @endif
        </div>
    </section>
    <div class="modal fade" id="modal-change-progect-status" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left">Project Status Change Remark</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Change From <em><strong id="status-from"></strong></em> to (if change)</label>
                        {!! Form::select('status', array_combine(\App\Core\ProjectAttributes::getStatus(), \App\Core\ProjectAttributes::getStatus()), $project->status, ['class'=>'form-control', 'id'=>'project-status']) !!}
                    </div>
                    <div class="col-sm-12 mt-2">
                        <h4 class="card-block__title">Project Completion Estimate (%)</h4>

                        <div id="input-slider"></div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::text('completion_estimate', $project?$project->completion_estimate:'0.00', ['class'=>'form-control', 'id'=>'input-slider-value']) !!}
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @php
                            $p_financials = $project?$project->statuses->last():null;
                        @endphp
                        <label>Financial (%) </label><span class="text-danger">*</span>
                        {!! Form::text('financials_percentage', is_object($p_financials)?$p_financials->financials_percentage:'0', ['class'=>'form-control', 'id'=>'financials_percentage']) !!}
                    </div>
                    <div class="form-group">
                        <label>Change Remark </label>
                        {!! Form::textarea('remark', null, ['class'=>'form-control', 'id'=>'remark-textarea', 'rows'=>'3']) !!}
                    </div>
                    <label class="custom-control custom-checkbox">
                        {!! Form::checkbox('push_notification', 'true', true, ['class'=>'custom-control-input', 'id'=>'toggle-push-notification']) !!}
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Send Push Notification</span>
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" id="save-change-btn">Save changes</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        #bg-googlemaps {
            height: 89%;
            width: 100%;
            position:absolute;
            top: 0;
            left: 0;
            z-index: 0; /* Set z-index to 0 as it will be on a layer below the contact form */
        }

        #project-details-content {
            position: relative;
            z-index: 1; /* The z-index should be higher than Google Maps */
            width: 87%;
            margin: 40px auto 0;
            padding: 10px;
            background: black;
            height: auto;
            opacity: .45; /* Set the opacity for a slightly transparent Google Form */
            color: white;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/lodash.min.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=showGoogleMaps"></script>
    <script>
        var position = [{{ $project->location }}];

        function showGoogleMaps() {

            var latLng = new google.maps.LatLng(position[0], position[1]);

            var mapOptions = {
                zoom: 16, // initialize zoom level - the max value is 21
                streetViewControl: false, // hide the yellow Street View pegman
                scaleControl: true, // allow users to zoom the Google Map
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: latLng
            };

            map = new google.maps.Map(document.getElementById('bg-googlemaps'),
                mapOptions);

            // Show the default red marker at the location
            marker = new google.maps.Marker({
                position: latLng,
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP
            });
        }
        var currentValue = $('#project-status').find(":selected").text();
        $(document).ready(function(){
            $('#change-status').on('click', function(ev){
                $('#status-from').html(currentValue);
                // $('#status-to').html($('#').find(":selected").text());
                $('#modal-change-progect-status').modal();

                // var confirmStatus = confirm('Sure the project status has changed ?');
                // if(confirmStatus){
                //     $.LoadingOverlay("show");
                // }
            });
            $('#modal-change-progect-status').on('hide.bs.modal', function(){
                // $("#project-status").val(currentValue);
            });
            $('#save-change-btn').on('click', function(ev){
                $.LoadingOverlay("show");
                var newStatus = $('#project-status').find(":selected").text();
                var remark = $('#remark-textarea').val();
                var completionEstimate = $('#input-slider-value').val();
                var financialsPercentage = $('#financials_percentage').val();
                var token = "{{ csrf_token() }}";
                //toggle-push-notification
                var pushNotification = $('#toggle-push-notification').is(':checked');
                // console.log(newStatus, remark, token);
                $.post("{{ route('projects.change.status', ['id'=>$project->id]) }}",
                {
                    '_token': '{{ csrf_token() }}',
                    'remark': remark,
                    'new_status': newStatus,
                    'completion_estimate': completionEstimate,
                    'financials_percentage': financialsPercentage,
                    'push_notification': pushNotification?1:0
                }).done(function(data){
                    console.log(data);
                    if(data.error){
                        roadzoftNotify('danger', 'An Error occurred : '+data.message);
                    }
                    else {
                        roadzoftNotify('info', 'Status Changed Successfully');
                        currentValue = newStatus;
                        $("#project-status").val(newStatus);
                    }

                }).fail(function(err){
                    console.log(err);
                    roadzoftNotify('danger', 'Operation failed: '+err.toString());
                    $("#project-status").val(currentValue);
                }).always(function(){
                    $.LoadingOverlay("hide");
                    $('#remark-textarea').val('');
                    $('#modal-change-progect-status').modal('toggle');
                });
            });
        });
    </script>
@endpush