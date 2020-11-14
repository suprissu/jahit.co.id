@extends('layouts.base')

@section('title', 'Dashboard Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script src="{{ asset('js/userProject.js') }}"></script>
    <script>
        const dummyData = [
            {
                id: "12d11dx",
                name: "Relawan Covid A",
                category: "Seragam Kantoran",
                order: "8",
                quotation: "0",
                address: "Jl. Jambu 9 No.112 Sukatani, Tapos, Depok",
                vendor: "",
                start_date: "10/05/2020, 12:38:00 AM",
                end_date: "10/30/2020, 12:38:00 AM",
                note: "Jangan pake tanya",
                picture: ["https://www.heddels.com/wp-content/uploads/2019/11/how-to-find-a-tailor.jpg"]
            },
            {
                id: "12d11da",
                name: "Demo Omnibus Law A",
                category: "Seragam Putih",
                order: "12",
                quotation: "0",
                address: "Jl. Haji 12 No.50 Sukatani, Tapos, Depok",
                vendor: "",
                start_date: "10/05/2020, 12:38:00 AM",
                end_date: "10/30/2020, 12:38:00 AM",
                note: "Lanjut",
                picture: ["https://www.heddels.com/wp-content/uploads/2019/11/how-to-find-a-tailor.jpg"]
            },
        ]

        function getProjectData(id) {

            const data = dummyData.find((data) => data.id == id);

            const name = data.name
            const category = data.category
            const order = data.order
            const quotation = data.quotation
            const address = data.address
            const vendor = data.vendor
            const start_date = new Date(data.start_date)
            const end_date = new Date(data.end_date)
            const note = data.note
            const picture = data.picture

            return {
                name,
                category,
                order,
                quotation,
                address,
                vendor,
                start_date,
                end_date,
                note,
                picture
            }
        }
    </script>
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/userProject.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('content')
@include('layouts/modalAddProject')
@include('layouts/modalEditProject')

<div class="userProject">
    <div class="userProject__container">
        <div class="userProject__header">
            <h2 class="userProject__title">Proyek</h2>
            <button class="userProject__addProject btn btn-danger" data-toggle="modal" data-target="#addProject">Tambah Proyek</button>
        </div>
        <div class="userProject__projects">
            <div class="userProject__projects__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Semua</a>
                <a class="list-group-item list-group-item-action" id="list-open-quotation-list" data-toggle="list" href="#list-open-quotation" role="tab" aria-controls="open-quotation">Penawaran Terbuka</a>
                <a class="list-group-item list-group-item-action" id="list-progress-list" data-toggle="list" href="#list-progress" role="tab" aria-controls="progress">Dalam Pengerjaan</a>
                <a class="list-group-item list-group-item-action" id="list-finish-list" data-toggle="list" href="#list-finish" role="tab" aria-controls="finish">Selesai</a>
                <a class="list-group-item list-group-item-action" id="list-cancel-list" data-toggle="list" href="#list-cancel" role="tab" aria-controls="cancel">Dibatalkan</a>
            </div>
            <div class="userProject__projects__list header tab-content" id="nav-tabContent">
                
                <!-- Semua Proyek -->
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: For loop List Item -->
                    @foreach ($projects_all as $project)
                        <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="@if($project->cost != null) {{ $project->cost }} @else - @endif" amount="{{ $project->count }}" quotation="13" status="0" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-open-quotation" role="tabpanel" aria-labelledby="list-open-quotation-list">
                </div>
                
                <!-- Proyek Dalam Pengerjaan -->
                <div class="tab-pane fade" id="list-progress" role="tabpanel" aria-labelledby="list-progress-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Proyek Selesai -->
                <div class="tab-pane fade" id="list-finish" role="tabpanel" aria-labelledby="list-finish-list">
                    <!-- TODO: Make List Item -->
                </div>
                
                <!-- Proyek Dibatalkan -->
                <div class="tab-pane fade" id="list-cancel" role="tabpanel" aria-labelledby="list-cancel-list">
                    <!-- TODO: Make List Item -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/form.js') }}"></script>
<script>
$("project-item").on("click", (e) => {
    const projectData = getProjectData(e.target.getAttribute("data-modalId"));

    $("#edit-project-name").val(projectData.name);
    $("#edit-project-category").val(projectData.category);
    $("#edit-project-order").val(projectData.order);
    $("#edit-project-quotation").val(projectData.quotation);
    $("#edit-project-address").val(projectData.address);
    $("#edit-project-vendor").val(projectData.vendor);
    $("#edit-project-startDate").val(projectData.start_date.toISOString().split("T")[0]);
    $("#edit-project-endDate").val(projectData.end_date.toISOString().split("T")[0]);
    $("#edit-project-note").val(projectData.note);

    for (let i = 0; i < projectData.picture.length; i++) {
        const div = document.createElement("img");
        div.setAttribute("src", `${projectData.picture[i]}`);
        $(".upload-files__preview--edit").html(div);
    }

    $(".upload-files__wrapper--edit").css("display", "none");
    $(".upload-files__preview--edit").css("display", "flex");
})
</script>
@endsection
