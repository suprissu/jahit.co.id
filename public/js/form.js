var tempFileUpload = {};

$(".input-files").each((e, node) => {
    node.children.item(0).innerHTML = "Upload file di sini";
    node.children.item(1).addEventListener("change", (e) => {
        const filenameArray = e.currentTarget.value.split("\\");
        node.children.item(0).innerHTML =
            filenameArray[filenameArray.length - 1];
    });
});

$(".upload-files__preview").hide();

$(".upload-files__input").change((e) => {
    $(".upload-files__add").removeClass("hover");
    $(".upload-files__preview").html("");

    const fileArray = e.target.files;

    for (let i = 0; i < fileArray.length; i++) {
        const file = fileArray[i];
        const div = document.createElement("span");
        const urlFile = URL.createObjectURL(file);
        div.style.backgroundImage = `url(${urlFile})`;
        $(".upload-files__preview").prepend(div);
    }

    e.target.parentElement.style.display = "none";
    e.target.parentElement.nextElementSibling.style.display = "flex";
});

$(".upload-files__preview").click((e) => {
    e.target.previousElementSibling.children[0].value = "";
    e.target.previousElementSibling.style.display = "flex";
    e.target.style.display = "none";
});

var dragTimer;
$(".upload-files__input").on("dragover", (e) => {
    var dt = e.originalEvent.dataTransfer;
    if (
        dt.types &&
        (dt.types.indexOf
            ? dt.types.indexOf("Files") != -1
            : dt.types.contains("Files"))
    ) {
        $(".upload-files__add").addClass("hover");
        window.clearTimeout(dragTimer);
    }
});

$(".upload-files__input").on("dragleave", () => {
    dragTimer = window.setTimeout(function () {
        $(".upload-files__add").removeClass("hover");
    }, 25);
});

function showPage(page_no) {
    _PDF_DOC.getPage(page_no).then(function (page) {
        // set the scale of viewport
        var scale_required = _CANVAS.width / page.getViewport(1).width;

        // get viewport of the page at required scale
        var viewport = page.getViewport(scale_required);

        // set canvas height
        _CANVAS.height = viewport.height;

        var renderContext = {
            canvasContext: _CANVAS.getContext("2d"),
            viewport: viewport,
        };

        // render the page contents in the canvas
        page.render(renderContext).then(function () {
            document.querySelector("#pdf-preview").style.display =
                "inline-block";
            document.querySelector("#pdf-loader").style.display = "none";
        });
    });
}
