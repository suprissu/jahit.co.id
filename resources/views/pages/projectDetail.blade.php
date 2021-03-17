@extends('layouts.base')

@section('extra-fonts')

@endsection

@section('prerender-js')

@endsection

@section('extra-css')
<script>
    window.props = {
        project: @json($project)
    }
    console.log(window.props)
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="project-detail"></div>
    </div>
</div>
@endsection

@section('extra-js')
@endsection
