$(".input-files").each((e, node) => {
    console.log(node);
    node.children.item(0).innerHTML = "Upload file di sini";
    node.children.item(1).addEventListener("change", (e) => {
        const filenameArray = e.currentTarget.value.split("\\");
        node.children.item(0).innerHTML =
            filenameArray[filenameArray.length - 1];
    });
});
