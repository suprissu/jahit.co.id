const imageCanFullscreen = document.querySelectorAll(
    "img[data-target='#image-fullscreen']"
);

imageCanFullscreen.forEach((e) => {
    e.addEventListener("click", (image) => {
        const previewContainer = document.querySelector(
            ".modal .modal-preview"
        );
        const newImageNode = document.createElement("img");
        newImageNode.classList.add("w-100");
        newImageNode.classList.add("mt-4");
        newImageNode.classList.add("rounded");
        newImageNode.setAttribute("src", image.currentTarget.currentSrc);
        newImageNode.setAttribute("alt", "Preview Fullscreen");
        previewContainer.innerHTML = newImageNode.outerHTML;
    });
});
