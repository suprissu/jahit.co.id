@extends('layouts.base')

@section('title', 'Dashboard Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
const dummyData = [
    @foreach( $projectsAll as $project )
    {
        category: "{{ $project->category }}",
        vendor: "{{ $project->partner }}",
        images: "{{ $project->images }}"
    },
    @endforeach,
    @foreach( $projectsRequest as $project )
    {
        category: "{{ $project->category }}",
        vendor: "{{ $project->partner }}",
        images: "{{ $project->images }}"
    },
    @endforeach,
    @foreach( $projectsInProgress as $project )
    {
        category: "{{ $project->category }}",
        vendor: "{{ $project->partner }}",
        images: "{{ $project->images }}"
    },
    @endforeach,
    @foreach( $projectsDone as $project )
    {
        category: "{{ $project->category }}",
        vendor: "{{ $project->partner }}",
        images: "{{ $project->images }}"
    },
    @endforeach,
    @foreach( $projectsRejected as $project )
    {
        category: "{{ $project->category }}",
        vendor: "{{ $project->partner }}",
        images: "{{ $project->images }}"
    },
    @endforeach,
]

window.props = {
    categories: @json($categories),
    projects: {
        all: @json($projectsAll),
        request: @json($projectsRequest),
        inProgress: @json($projectsInProgress),
        done: @json($projectsDone),
        rejected: @json($projectsRejected)
    },
    samples: {
        all: @json($samplesAll),
        request: @json($samplesRequest),
        inProgress: @json($samplesInProgress),
        done: @json($samplesDone),
        rejected: @json($samplesRejected)
    }
}
</script>
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
@include('layouts/modalAddProject')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="projects" ></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
