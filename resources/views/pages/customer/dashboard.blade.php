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
                amount: "@if($project->cost != null) Rp {{ number_format($project->cost, 0, ',', '.') }} @else - @endif",
                quotation: "-",
                address: "{{ $project->address }}",
                vendor: @if($project->partner != null) "{{ $project->partner->company_name }}" @else "-" @endif,
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

<div class="custom-container">
    <div class="custom-wrapper">
        <div id="projects" ></div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
window.props = {
    projects: {
        all:"{{$projectsAll}}",
        request:"{{$projectsRequest}}",
        inProgress:"{{$projectsInProgress}}",
        done:"{{$projectsDone}}",
        rejected:"{{$projectsRejected}}",
    },
    samples: {
        all:"{{$samplesAll}}",
        request:"{{$samplesRequest}}",
        inProgress:"{{$samplesInProgress}}",
        done:"{{$samplesDone}}",
        rejected:"{{$samplesRejected}}"
    }
}
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script>

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
