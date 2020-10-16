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
    get price() {
        return this.getAttribute("price");
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

    get paymentProgress() {
        if (this.paidStatus !== "SUDAH_DIBAYAR")
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
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

            <div class="transactionItem transactionItem--quotation">
                <div class="transactionItem--left">
                    <div class="transactionItem__header">
                        <h6 class="transactionItem__name" data-toggle="modal" data-target="#editTransaction">${
                            this.name
                        }</h6>
                        <p class="transactionItem__price">Rp.${this.price}</p>
                        <p class="transactionItem__amount">${
                            this.amount
                        } buah</p>
                    </div>
                </div>
                <div class="transactionItem--right">
                    <div class="transactionItem__label">
                        <p class="transactionItem__category">${
                            this.category
                        }</p>
                        <p class="transactionItem__paidStatus">${this.paidStatus
                            .split("_")
                            .join(" ")}</p>
                    </div>
                </div>
            </div>
        `;
    }
}

window.customElements.define("transaction-item", TransactionItem);
