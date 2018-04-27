@extends('dashboard.project.sub_layout')
    @section('sub-sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @if($monitoring)
                        <div class="card-header">
                            <h2 class="card-title">Project Monitorings Details <small><em>by:</em> {{ $monitoring->user->name }}</small></h2>
                            <small class="card-subtitle">{{ $monitoring->remark }}</small>
                        </div>

                        <div class="card-block">
                            <nav class="card-block__nav text-center">
                                <a class="btn btn-info text-white" href=""><i class="zmdi zmdi-twitter"></i> Tweet</a>
                                <a class="btn btn-primary text-white" href=""><i class="zmdi zmdi-facebook"></i> Facebook</a>
                            </nav>

                            <div class="row lightbox photos">

                                @foreach($monitoring->media as $media)
                                    <a href="{{ asset($media->url) }}" class="col-md-2 col-4">
                                        <div class="lightbox__item photos__item">
                                            <img src="{{ asset($media->url) }}" alt="{{ \App\Core\Helpers::projectImageAttributeTitle($media->remark, $media->location) }}" width="100" height="150"/>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <h2 class="text-center">Monitoring Not Found</h2>
                    @endif
                </div>
            </div>
        </div>
    @endsection
@push('styles')

@endpush
@push('scripts')

@endpush