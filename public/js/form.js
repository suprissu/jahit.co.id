var tempFileUpload = {};

document.querySelectorAll(".input-files").forEach(node => {
    node.children.item(0).innerHTML = "Upload file di sini";
    node.children.item(1).addEventListener("change", e => {
        const filenameArray = e.currentTarget.value.split("\\");
        node.children.item(0).innerHTML =
            filenameArray[filenameArray.length - 1];
    });
});
const preview = document.querySelector(".upload-files__preview");
const filesInput = document.querySelector(".upload-files__input");

document.querySelector(".upload-files__input");
document.querySelector(".upload-files__input");
if (filesInput) {
    preview.style.display = "none";

    filesInput.addEventListener("change", e => {
        document.querySelector(".upload-files__add").classList.remove("hover");
        document.querySelector(".upload-files__preview").innerHTML = "";

        const fileArray = e.target.files;

        for (let i = 0; i < fileArray.length; i++) {
            const file = fileArray[i];
            const div = document.createElement("img");
            const urlFile = URL.createObjectURL(file);
            div.setAttribute("src", `${urlFile}`);
            document.querySelector(".upload-files__preview").prepend(div);
        }

        e.target.parentElement.style.display = "none";
        e.target.parentElement.nextElementSibling.style.display = "flex";
    });

    preview.addEventListener("click", e => {
        e.target.previousElementSibling.children[0].value = "";
        e.target.previousElementSibling.style.display = "flex";
        e.target.style.display = "none";
    });

    var dragTimer;
    filesInput.addEventListener("dragover", e => {
        var dt = e.originalEvent.dataTransfer;
        if (
            dt.types &&
            (dt.types.indexOf
                ? dt.types.indexOf("Files") != -1
                : dt.types.contains("Files"))
        ) {
            document.querySelector(".upload-files__add").classList.add("hover");
            window.clearTimeout(dragTimer);
        }
    });

    filesInput.addEventListener("dragleave", () => {
        dragTimer = window.setTimeout(function() {
            document
                .querySelector(".upload-files__add")
                .classList.remove("hover");
        }, 25);
    });
}

function showPage(page_no) {
    _PDF_DOC.getPage(page_no).then(function(page) {
        // set the scale of viewport
        var scale_required = _CANVAS.width / page.getViewport(1).width;

        // get viewport of the page at required scale
        var viewport = page.getViewport(scale_required);

        // set canvas height
        _CANVAS.height = viewport.height;

        var renderContext = {
            canvasContext: _CANVAS.getContext("2d"),
            viewport: viewport
        };

        // render the page contents in the canvas
        page.render(renderContext).then(function() {
            document.querySelector("#pdf-preview").style.display =
                "inline-block";
            document.querySelector("#pdf-loader").style.display = "none";
        });
    });
}
