@extends('dashboard.project.sub_layout')
    @section('sub-sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info card-inverse">
                    <div class="card-header">
                        <h2 class="card-title">Project Status Change History</h2>
                        <small class="card-subtitle">Detailed change in project status from time to time.</small>
                    </div>
                    <div class="card-block">
                        <div class="listview listview--bordered">
                            @foreach($project->statuses as $status)
                                <div class="listview__item">
                                    <div class="listview__content">
                                        <div class="listview__heading text-white">{{ $status->new_status }}</div>
                                        <p class="text-white">{{ $status->remark }}</p>
                                        <div class="listview__attrs text-gray-dark">
                                            <span>Completion: {{ $status->new_completion_estimate }} %</span>
                                            <span>Financial: {{ $status->financials_percentage }} %</span>
                                            <span>Logged Date: {{ \App\Core\Helpers::getTimeInZone($status->created_at) }}</span>
                                            <span>Logged By: {{ $status->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
@push('styles')

@endpush
@push('scripts')

@endpush