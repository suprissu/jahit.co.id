class TransactionItem extends HTMLElement {
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
    get amount() {
        return this.getAttribute("amount");
    }
    get startDate() {
        return this.getAttribute("startDate");
    }
    get endDate() {
        return this.getAttribute("endDate");
    }
    get category() {
        return this.getAttribute("category");
    }
    get paidStatus() {
        return this.getAttribute("paidStatus");
    }
    get preview() {
        return this.getAttribute("preview");
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

    get percentage() {
        const startDate = new Date(this.startDate).getTime();
        const endDate = new Date(this.endDate).getTime();
        const today = new Date().getTime();
        const total = endDate - startDate;
        const indicator = today - startDate;
        const progress = indicator / total;
        return progress.toFixed(2) * 100;
    }

    get paymentProgress() {
        if (this.paidStatus !== "SUDAH DIBAYAR")
            return `<div class="transactionItem__status--progress progress"><div class="progress-bar" role="progressbar" style="width: ${this.percentage}%;" aria-valuenow="${this.percentage}" aria-valuemin="0" aria-valuemax="100"><p>${this.remainingDay}</p></div></div>`;
        else return `<span></span>`;
    }

    connectedCallback() {
        this.render();
    }

    render() {
        this.shadow.innerHTML = `
            <link rel="stylesheet" href=${this.css} crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

            <div class="transactionItem transactionItem--quotation">
                <div class="transactionItem--left">
                    <div class="transactionItem__header">
                        <p class="transactionItem__name">${this.name}</p>
                        <p class="transactionItem__amount">${
                            this.amount
                        } buah</p>
                        <div class="transactionItem__content">
                            <div class="transactionItem__image"><img src=${
                                this.preview
                            } alt="project-image"/></div>
                            <div class="transactionItem__description">
                                <p><span>Mulai Pengerjaan :</span> ${new Date(
                                    this.startDate
                                ).toLocaleDateString()}</p>
                                <p><span>Selesai Pengerjaan :</span> ${new Date(
                                    this.endDate
                                ).toLocaleDateString()}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transactionItem--right">
                    <div class="transactionItem__label">
                        <p class="transactionItem__category__paidStatus">${
                            this.category
                        } - ${this.paidStatus}</p>
                        ${this.paymentProgress}
                    </div>
                    <div class="transactionItem__credential">
                        <button class="btn btn-outline-danger">Unggah bukti pembayaran</button>
                        <button class="btn btn-outline-danger">Unduh Invoice</button>
                    </div>
                </div>
            </div>
        `;
    }
}

window.customElements.define("transaction-item", TransactionItem);
