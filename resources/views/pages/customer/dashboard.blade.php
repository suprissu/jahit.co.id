@extends('layouts.base')

@section('title', 'Dashboard Customer')

@section('extra-fonts')

@endsection

@section('prerender-js')
    <script src="{{ asset('js/userProject.js') }}"></script>
    <script>
        const dummyData = [
            @foreach( $projectsAll as $project )
            {
                id: "{{ $project->id }}",
                name: "{{ $project->name }}",
                status: "Segera Dikontak",
                category: "{{ $project->category->id }}",
                order: "{{ $project->count }}",
                amount: "Rp @if($project->cost != null) {{ $project->cost }} @else - @endif",
                quotation: "-",
                address: "{{ $project->address }}",
                vendor: @if($project->partner != null) "{{ $project->partner->name }}" @else "-" @endif,
                start_date: "{{ $project->start_date }}",
                end_date: "{{ $project->deadline }}",
                note: "{{ $project->note }}",
                picture: [
                    @foreach($project->images as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                ]
            },
            @endforeach
        ]

        function getProjectData(id) {

            const data = dummyData.find((data) => data.id == id);

            const name = data.name
            const status = data.status
            const category = data.category
            const order = data.order
            const amount = data.amount
            const quotation = data.quotation
            const address = data.address
            const vendor = data.vendor
            const start_date = data.start_date !== "" ? new Date(data.start_date) : null
            const end_date = data.end_date !== "" ? new Date(data.end_date) : null
            const note = data.note
            const picture = data.picture

            return {
                id,
                name,
                status,
                category,
                order,
                amount,
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
@inject('sampleStatusConstant', 'App\Constant\SampleStatusConstant')
@inject('projectStatusConstant', 'App\Constant\ProjectStatusConstant')

<div class="userProject">
    <div class="userProject__container">
        <div class="userProject__header">
            <h2 class="userProject__title">Proyek</h2>
            <button class="userProject__addProject btn btn-danger" data-toggle="modal" data-target="#addProject">Tambah Proyek</button>
        </div>
        <div class="userProject__projects">
            <div class="userProject__projects__header list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-all-list" data-toggle="list" href="#list-all" role="tab" aria-controls="all">Project</a>
                <a class="list-group-item list-group-item-action" id="list-sample-list" data-toggle="list" href="#list-sample" role="tab" aria-controls="sample">Sampel</a>
                <a class="list-group-item list-group-item-action" id="list-open-quotation-list" data-toggle="list" href="#list-open-quotation" role="tab" aria-controls="open-quotation">Pesanan</a>
                <a class="list-group-item list-group-item-action" id="list-progress-list" data-toggle="list" href="#list-progress" role="tab" aria-controls="progress">Dalam Pengerjaan</a>
                <a class="list-group-item list-group-item-action" id="list-finish-list" data-toggle="list" href="#list-finish" role="tab" aria-controls="finish">Selesai</a>
                <a class="list-group-item list-group-item-action" id="list-cancel-list" data-toggle="list" href="#list-cancel" role="tab" aria-controls="cancel">Dibatalkan</a>
            </div>
            <div class="userProject__projects__list header tab-content" id="nav-tabContent">
                
                <!-- Semua Proyek -->
                <div class="tab-pane fade show active" id="list-all" role="tabpanel" aria-labelledby="list-all-list">
                    <!-- TODO: For loop List Item -->
                    @foreach ($projectsAll as $project)
                        @if ($project->status == $projectStatusConstant::PROJECT_DEALT)
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="0" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @elseif ($project->status == $projectStatusConstant::PROJECT_WORK_IN_PROGRESS)
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="3" startDate="{{ $project->start_date }}" endDate="{{ $project->deadline }}" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item> 
                        @elseif ($project->status == $projectStatusConstant::PROJECT_FAILED || $project->status == $projectStatusConstant::PROJECT_CANCELED)
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="2" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @else
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="1" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @endif
                    @endforeach
                </div>
                
                <!-- Sample -->
                <div class="tab-pane fade" id="list-sample" role="tabpanel" aria-labelledby="list-sample-list">
                    <!-- TODO: Make List Item -->
                    @foreach ($samplesAll as $project)
                        @if ($project->sample->status == $sampleStatusConstant::SAMPLE_WAIT_PAYMENT || $project->sample->status == $sampleStatusConstant::SAMPLE_WORK_IN_PROGRESS)
                            <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="0" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @elseif ($project->sample->status == $sampleStatusConstant::SAMPLE_REJECTED)
                            <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="2" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @else
                            <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="1" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @endif
                    @endforeach  
                </div>
                
                <!-- Penawaran Terbuka -->
                <div class="tab-pane fade" id="list-open-quotation" role="tabpanel" aria-labelledby="list-open-quotation-list">
                    <!-- TODO: Make List Item -->
                    @foreach ($samplesRequest as $project)
                        @if ($project->sample->status == $sampleStatusConstant::SAMPLE_WAIT_PAYMENT)
                            <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="0" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @elseif ($project->sample->status == $sampleStatusConstant::SAMPLE_PAYMENT_OK)
                            <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="1" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @endif
                    @endforeach
                    @foreach ($projectsRequest as $project)
                        @if ($project->status == $projectStatusConstant::PROJECT_DEALT)
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="0" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @elseif ($project->status == $projectStatusConstant::PROJECT_DP_OK)
                            <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="1" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                        @endif
                    @endforeach
                </div>

                <!-- Proyek Dalam Pengerjaan -->
                <div class="tab-pane fade" id="list-progress" role="tabpanel" aria-labelledby="list-progress-list">
                    <!-- TODO: Make List Item -->
                    @foreach ($samplesInProgress as $project)
                        <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="0" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                    @foreach ($projectsInProgress as $project)
                        <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="3" startDate="{{ $project->start_date }}" endDate="{{ $project->deadline }}" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                </div>
                
                <!-- Proyek Selesai -->
                <div class="tab-pane fade" id="list-finish" role="tabpanel" aria-labelledby="list-finish-list">
                    <!-- TODO: Make List Item -->
                    @foreach ($samplesDone as $project)
                        <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="1" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                    @foreach ($projectsDone as $project)
                        <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="{{ $project->count }}" status="1" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                </div>
                
                <!-- Proyek Dibatalkan -->
                <div class="tab-pane fade" id="list-cancel" role="tabpanel" aria-labelledby="list-cancel-list">
                    <!-- TODO: Make List Item -->
                    @foreach ($samplesRejected as $project)
                        <project-item data-modalId="{{ $project->id }}" name="[SAMPEL] {{ $project->project->name }}" price="{{ $project->cost }}" amount="1" status="2" statusText="{{ $project->sample->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach
                    @foreach ($projectsRejected as $project)
                        <project-item data-modalId="{{ $project->id }}" name="{{ $project->name }}" price="{{ $project->cost }}" amount="1" status="2" statusText="{{ $project->status }}" data-toggle="modal" data-target="#editProject" css="{{ asset('css/projectItem.css') }}"></project-item>
                    @endforeach   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/form.js') }}"></script>
<script>

const priceFormat = (num) => {
  const numberFormat = new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  });
  const price = numberFormat.format(num);
  return price.split(",")[0];
};

$("project-item").on("click", (e) => {
    const projectData = getProjectData(e.target.getAttribute("data-modalId"));

    $("#edit-project-title").html(projectData.name);
    $("#edit-project-id").val(projectData.id);
    $("#edit-project-name").val(projectData.name);
    $("#edit-project-status").html(projectData.status);
    $("#edit-project-category").val(projectData.category);
    $("#edit-project-order").val(projectData.order);
    $("#edit-project-amount").html(projectData.amount);
    $("#edit-project-quotation").val(projectData.quotation);
    $("#edit-project-address").val(projectData.address);
    $("#edit-project-vendor").val(projectData.vendor);
    if (projectData.start_date !== null) $("#edit-project-startDate").val(projectData.start_date.toISOString().split("T")[0]);
    if (projectData.end_date !== null) $("#edit-project-endDate").val(projectData.end_date.toISOString().split("T")[0]);
    $("#edit-project-note").val(projectData.note);

    let previewEdit = document.createElement("div");
    previewEdit.classList.add("upload-files__preview--edit");
    for (let i = 0; i < projectData.picture.length; i++) {
        const image = document.createElement("img");
        image.setAttribute("src", projectData.picture[i]);
        previewEdit.append(image);
    }
    $(".upload-files__container").html(previewEdit);

    $(".upload-files__wrapper--edit").css("display", "none");
    $(".upload-files__preview--edit").css("display", "flex");
})
</script>
@endsection
