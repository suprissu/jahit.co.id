const timelineProject = [
    {
        img: "/img/step-1.svg",
        title: "Upload RFP",
        description:
            "Upload Detail Project dengan Format yang Ditentukan untuk disebar ke 2000 Partner kami."
    },
    {
        img: "/img/step-2.svg",
        title: "Sample & Select",
        description:
            "Partner kami akan mengirimkan sample dan akan dipilih yang terbaik sesuai pilihan anda."
    },
    {
        img: "/img/step-3.svg",
        title: "Sign Contract",
        description:
            "Tanda tangan SPK kedua belah pihak dan penyelesaian  Deposit Pembayaran di website JAHIT.CO.ID."
    },
    {
        img: "/img/step-4.svg",
        title: "Delivery",
        description:
            "Pengerjaan Selesai Tepat waktu dan barang siap dikirim. Vendor tidak akan mendapatkan uang sebelum pembeli menerima barang yang sesuai dengan SPK."
    }
];

const step = (img, title, description) => {
    return `
    
        <img class="step__image" src=${img} alt="step-image">
        <h4 class="step__title">${title}</h4>
        <p class="step__description">${description}</p>
    </div>
    `;
};

// const timelineContainer = '<div class="timeline__steps"></div>';
const timelineContainer = document.createElement("div");
timelineContainer.classList.add("timeline__steps");

for (let i = 0; i < timelineProject.length; i++) {
    const stepWrapper = document.createElement("div");
    stepWrapper.classList.add("step");
    stepWrapper.innerHTML = step(
        timelineProject[i].img,
        timelineProject[i].title,
        timelineProject[i].description
    );
    timelineContainer.append(stepWrapper);
}

document.querySelector(".timeline__container").append(timelineContainer);
