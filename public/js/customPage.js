class customPage extends HTMLElement {
    constructor() {
        super();
        this.shadow = this.attachShadow({ mode: "open" });
    }

    get title() {
        return this.getAttribute("title");
    }
    get image() {
        return this.getAttribute("image");
    }
    get message() {
        return this.getAttribute("message");
    }

    connectedCallback() {
        this.render();
    }

    render() {
        this.shadow.innerHTML = `
            <style>
                .blankPage {
                    min-height: 70vh;
                }

                .blankPage__container {
                    width: 80%;
                    margin: 12vh auto;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .blankPage__image {
                    max-width: 100%;
                    max-height: 100%;
                }

                .blankPage__title {
                    margin-top: 2rem;
                    margin-bottom: 0;
                }

                .blankPage__message {
                    margin-top: 1rem;
                }

            </style>

            <div class="blankPage">
                <div class="blankPage__container">
                    <img class="blankPage__image" src=${this.image} alt="info-image"/>
                    <h1 class="blankPage__title">${this.title}</h1>
                    <p class="blankPage__message">${this.message}</p>
                </div>
            </div>
        `;
    }
}

window.customElements.define("custom-page", customPage);
