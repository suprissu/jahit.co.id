function review(color) {
    return `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.8225 7.5L9 1.5L7.1775 7.5H1.5L6.135 10.8075L4.3725 16.5L9 12.9825L13.635 16.5L11.8725 10.8075L16.5 7.5H10.8225Z" fill="${color}"/></svg>`;
}

function reviews(stars) {
    const colors = ["#D52047", "#000000"];
    let result = `<div class="userCustomerProject__project__status userCustomerProject__project__status--review">`;
    for (let i = 0; i < 5; i++) {
        if (i < stars) result += review(colors[0]);
        else result += review(colors[1]);
    }
    result += "</div>";
    return result;
}

class ProjectItem extends HTMLElement {
    constructor() {
        super();
        this.shadow = this.attachShadow({ mode: "open" });
    }

    get css() {
        return this.getAttribute("css");
    }
    get name() {
        return this.getAttribute("name").slice(0, 40);
    }
    get price() {
        return this.getAttribute("price");
    }
    get amount() {
        return this.getAttribute("amount");
    }
    get quotation() {
        return this.getAttribute("quotation");
    }
    get startDate() {
        return this.getAttribute("startDate");
    }
    get endDate() {
        return this.getAttribute("endDate");
    }

    get review() {
        return this.getAttribute("review");
    }

    get rating() {
        console.log("masuk");
        return this.getAttribute("rating");
    }

    get remainingDay() {
        const endDate = new Date(this.endDate).getTime();
        const today = new Date().getTime();
        const difference = endDate - today;
        const remainingDay = difference / (1000 * 3600 * 24);
        if (remainingDay > 1) return Math.round(remainingDay) + " hari lagi";
        else if (remainingDay * 24 > 1)
            return Math.round(remainingDay * 24) + " jam lagi";
        else return Math.round(remainingDay * 24 * 60) + "menit lagi";
    }

    get progress() {
        const startDate = new Date(this.startDate).getTime();
        const endDate = new Date(this.endDate).getTime();
        const today = new Date().getTime();
        const total = endDate - startDate;
        const indicator = today - startDate;
        const progress = indicator / total;
        return progress.toFixed(2) * 100;
    }

    get status() {
        const status = {
            1: `<div class="userCustomerProject__project__status">Penawaran Terbuka</div>`,
            2: `<div class="userCustomerProject__project__status">Mengirimkan Sample</div>`,
            3: `<div class="userCustomerProject__project__status--progress progress"><div class="progress-bar" role="progressbar" style="width: ${this.progress}%;" aria-valuenow="${this.progress}" aria-valuemin="0" aria-valuemax="100"><p>${this.remainingDay}</p></div></div>`,
            4: `<div class="userCustomerProject__project__status userCustomerProject__project__status--finish">Siap Mengirim</div>`,
            5: reviews(this.rating),
            6: `<div class="userCustomerProject__project__status userCustomerProject__project__status--cancel">Dibatalkan</div>`,
        };
        return status[this.getAttribute("status")];
    }

    connectedCallback() {
        this.render();
    }

    render() {
        this.shadow.innerHTML = `
            <link rel="stylesheet" href=${this.css} crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <div class="userCustomerProject__project userCustomerProject__project--quotation">
                <div class="userCustomerProject__project--left">
                    <p class="userCustomerProject__project__name">${
                        this.name
                    }</p>
                    <p class="userCustomerProject__project__price">Rp.${
                        this.price
                    }</p>
                    <p class="userCustomerProject__project__amount">${
                        this.amount
                    } buah</p>
                </div>
                <div class="userCustomerProject__project--right">
                    <p class="userCustomerProject__project__quotation">${
                        this.review !== null
                            ? '"' + this.review + '"'
                            : this.quotation + " Quotation"
                    }</p>
                    ${this.status}
                </div>
            </div>
        `;
    }
}

window.customElements.define("project-item", ProjectItem);
