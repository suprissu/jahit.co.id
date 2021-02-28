@extends('layouts.base')

@section('title', 'Dashboard Administrator')

@section('extra-fonts')

@endsection

@section('prerender-js')
<script>
window.props = {
    customer: [
        {
            name: "Aktif",
            data: @json($activeCustomers)
        },
        {
            name: "Belum Aktif",
            data: @json($inactiveCustomers)
        }
    ],
    partner: [
        {
            name: "Aktif",
            data: @json($activePartners)
        },
        {
            name: "Belum Aktif",
            data: @json($inactivePartners)
        }
    ],
    categories: @json($categories)
}
</script>
<script src="{{ asset('js/App.js') }}" defer></script>
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="custom-container">
    <div class="custom-wrapper">
        <div id="admin-dashboard"></div>
    </div>
</div>
@endsection

@section('extra-js')

@endsection
