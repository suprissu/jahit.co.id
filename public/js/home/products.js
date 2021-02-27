const productsProject = [
    {
        img: "/img/uniform.webp",
        title: "Seragam (Kantor, Sekolah, Organisasi)",
        description:
            "Seragam Sekolah, Rumah Sakit, Kantor, Organisasi, Tambang, Hotel, Pabrik, Satpam, Teknisi, SPBU, Satpam, dsb,."
    },
    {
        img: "/img/jeans.webp",
        title: "Fashion (Pria, Wanita, Anak)",
        description:
            "Kaos, Kemeja, Jacket,Jeans, Denim, Chino, Celana Pendek, Rok, Dress, Cardigan, Blazer, Polo Shirtt, Dsb."
    },
    {
        img: "/img/officer.webp",
        title: "Others (Safety, Medical, Sport, Etc.)",
        description:
            "Pakaian Rumah Sakit ataupun Pakaian Keselamatan yang membutuhkan Uji Test Lab dapat kami penuhi."
    }
];

const card = (img, title, description) => {
    return `
        <img class="custom-card__image" src=${img} alt="custom-card-image"/>
        <div class="custom-card__wrapper">
            <h4 class="custom-card__title">${title}</h4>
            <p class="custom-card__description">${description}</p>
        </div>
    `;
};

const productsContainer = document.createElement("div");
productsContainer.classList.add("products__wrapper");

for (let i = 0; i < productsProject.length; i++) {
    const cardWrapper = document.createElement("div");
    cardWrapper.classList.add("custom-card");
    cardWrapper.innerHTML = card(
        productsProject[i].img,
        productsProject[i].title,
        productsProject[i].description
    );
    productsContainer.append(cardWrapper);
}

document.querySelector(".products__container").append(productsContainer);
